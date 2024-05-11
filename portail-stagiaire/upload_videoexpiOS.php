<?php
 require_once 'videoconverter/vendor/autoload.php'; 
 require_once __DIR__ . '/speech/vendor/autoload.php';

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
include "connexion.php";
    $text = $_POST['text'];
    $targL = 1;
    $mot = $_POST['mot'];
    $targTEXT = $_POST['targTEXT'];
	$id_stag = $_POST['id_stag'];
	$infolangue="en-US";	
	$domain_name = "http://vps339112.ovh.net/portail-stagiaire" ;
	$id_groupe= $_POST['id_groupe'];
	$folder_dir = "/var/www/html/elearning2021/groupes/GRP".$id_groupe;
	if (!file_exists($folder_dir)) {
		mkdir($folder_dir, 0777, true);
	}
	$target_dir = $folder_dir . "/" .$id_stag. "_" . time() . ".mp4";
	$filename = $id_stag. "_".time();
	$nom_image=$filename.".mp4";
	$infolangue="en-US";	
	if(move_uploaded_file($_FILES['video']['tmp_name'], $target_dir)){
		$target_dir = $domain_name . $target_dir ;
		mysqli_set_charset($mysqli,"utf8");
		$lien = mysqli_real_escape_string($mysqli, $nom_image);
        $Sql_Query = "insert into expressions_stagiaires (id_stagiaire, target_langue_cible,content_langue_origine,content_langue_cible,date_creation)  values ('$id_stag','$targL','$mot ','$targTEXT',now())";
		if(mysqli_query($mysqli,$Sql_Query)){
		$last_id = mysqli_insert_id($mysqli);
		$videofile = $folder_dir."/".$nom_image;
		$audio = convert($videofile,$filename,$folder_dir);
		$sql1= "INSERT INTO file_stag (id_exp,f_name,legende_f,type_file,date_creat)  VALUES ($last_id,'$lien','$text','video',now())";
		$mysqli -> query($sql1);
		$audioFile = $folder_dir."/".$audio;
		$text = transcript($audioFile,$infolangue);
		$sql2= "UPDATE expressions_stagiaires set content_langue_origine='$text',audio_langue_origine='$audio'  WHERE id_expression='$last_id' ";
		$mysqli -> query($sql2);
		$MSG = 'video uploaded and saved on database and ID is: '.$last_id ;
		$json = json_encode($MSG);
		echo $json ;
	 }
	 else{
			$er='Something Went Wrong';
			$temp = json_encode($er);
			echo $temp;
		  }
	}
	mysqli_close($mysqli);
	function convert($videofile,$filename,$folder_dir){
		$ffmpeg = FFMpeg\FFMpeg::create();
		$format = new FFMpeg\Format\Audio\Wav();  
		$format		
			->setAudioChannels(1)
			->setAudioKiloBitrate(48000);  
		$audioname=$filename.".wav";
		$audioObj = $ffmpeg->open($videofile);    
		$audioObj->save($format,$folder_dir."/".$audioname);
		return $audioname;
	}

	function transcript($audioFile,$infolangue){
		 if (!is_file($audioFile)){
		 return false;
		 }
		$encoding = AudioEncoding::LINEAR16;
		$sampleRateHertz = 44100;
		$languageCode = $infolangue;
		$content = file_get_contents($audioFile);
		$audioF = (new RecognitionAudio())
			->setContent($content);
		$config = (new RecognitionConfig())
				->setEncoding($encoding)
				->setSampleRateHertz($sampleRateHertz)
				->setLanguageCode($languageCode);
				putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/html/portail-stagiaire/env/formatrad-7ed5e4c68b97.json');
		$client = new SpeechClient();
		$confidence = 0;
		$response = $client->recognize($config, $audioF);
		foreach ($response->getResults() as $result) {
			$alternatives = $result->getAlternatives();
			$mostLikely = $alternatives[0];
			$trancriptFinal .= " " .$mostLikely->getTranscript();	
		}
		$client->close();
		return $trancriptFinal;
		}
?>