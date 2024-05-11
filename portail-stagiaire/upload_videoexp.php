<?php
 ini_set('max_execution_time', 0);
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
	$infolangue= $_POST['infolangue'];
	$domain_name = "http://vps339112.ovh.net/portail-stagiaire" ;
	$id_groupe= $_POST['id_groupe'];
	$folder_dir = "/var/www/html/elearning2021/groupes/GRP".$id_groupe;
	if (!is_dir($folder_dir)) {
		mkdir("/var/www/html/elearning2021/groupes/GRP".$id_groupe, 0777, true);
	}
	$target_dir = $folder_dir . "/" .$id_stag. "_" . time() . ".mp4";
	$filename = $id_stag. "_".time();
	$nom_image=$filename.".mp4";
	$webfile = $filename."output.webm";
	$finalpath="/var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$nom_image;
	
	if(move_uploaded_file($_FILES['video']['tmp_name'], $target_dir)){


		// Exécute la commande FFmpeg pour récupérer la durée de la vidéo
		$commandTime = 'ffmpeg -i ' . $finalpath . ' 2>&1 | grep Duration | cut -d \' \' -f 4 | sed s/,//';
		exec($commandTime, $output);

		// Récupère la durée sous forme de chaîne de caractères
		$duration_str = $output[0];

		// Convertit la durée en secondes
		list($hours, $minutes, $seconds) = explode(':', $duration_str);
		$duration = $hours * 3600 + $minutes * 60 + $seconds;

		$hoursTime = gmdate("H", $duration);
		$minutesTime = gmdate("i", $duration);
		$secondsTime = gmdate("s", $duration);
		// Affiche la durée en secondes
		$finalTime =  "$hoursTime:$minutesTime:$secondsTime";


		$target_dir = $domain_name . $target_dir ;
		mysqli_set_charset($mysqli,"utf8");
		$lien = mysqli_real_escape_string($mysqli, $nom_image);
        $Sql_Query = "insert into expressions_stagiaires (id_stagiaire, target_langue_cible,content_langue_origine,content_langue_cible,date_creation,duree_audio)  values ('$id_stag','$targL','$mot ','$targTEXT',now(),'$finalTime')";
		
		if(mysqli_query($mysqli,$Sql_Query)){
		$last_id = mysqli_insert_id($mysqli);
		$videofile = $folder_dir."/".$nom_image;
		$audio = $filename."mp4_final.wav";
		
		$audioFile = $folder_dir."/".$audio;
		// $newtext = getlongtranscription($finalpath,$nom_image,$infolangue);
		$newaudio = convert($finalpath, $filename, $folder_dir);
		$urlaudio = 'https://elprod.forma2plus.com/elearning2021/groupes/GRP'.$id_groupe.'/'.$newaudio;
		// $newtext = getnewlongtranscription($finalpath,$nom_image,$infolangue);
		$tempsDebut = microtime(true);
		$newtext = getnewlongtranscription($urlaudio);
		$tempsFin = microtime(true);

		// Calcul de la durée écoulée en millisecondes
		$dureerec = ($tempsFin - $tempsDebut);
		list($hours, $minutes, $seconds) = explode(':', $dureerec);
		$durationT = $hours * 3600 + $minutes * 60 + $seconds;

		$hoursTime = gmdate("H", $durationT);
		$minutesTime = gmdate("i", $durationT);
		$secondsTime = gmdate("s", $durationT);
		// Affiche la durée en secondes
		$finalTimeT =  "$hoursTime:$minutesTime:$secondsTime";
		$sql1= "INSERT INTO file_stag (id_exp,f_name,legende_f,type_file,date_creat,file_obs,time_rec)  VALUES ($last_id,'$lien','$text','video',now(),null,'$finalTimeT')";
		$mysqli -> query($sql1);


		$text = substr($newtext, 26);
		$res1 = str_replace( array( '%', '@', '\'', ';', '<', '{', '"', '}' ), ' ', $text);
		$res2 = substr($res1, 0, -1);
		$sql2= "UPDATE expressions_stagiaires set content_langue_origine='$newtext',audio_langue_origine='$newaudio'  WHERE id_expression='$last_id' ";
		$mysqli -> query($sql2);
		if (mysqli_query($con,$Sql1)){
			$con -> query("UPDATE expressions_stagiaires set audio_langue_origine='$audio' WHERE id_expression='$last_id' ");
		}
		$MSG = 'video uploaded and saved on database and ID is: '.$last_id ;


// // stats

// 		$urlstat = "https://elprod.forma2plus.com/portail-stagiaire/labo/test.php";

// 		// Données à envoyer
// 		$datastats = array(
// 			'sentence' => $res2,
// 			'word' => 'fly',
// 			'idexp' =>$last_id
// 		);

// 		// Initialisation de cURL
// 		$curl = curl_init($urlstat);

// 		// Configuration des options de cURL
// 		curl_setopt($curl, CURLOPT_POST, true);
// 		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($datastats));
// 		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// 		// Exécution de la requête
// 		$response = curl_exec($curl);

// 		// Vérification des erreurs
// 		if ($response === false) {
// 			$error = curl_error($curl);
// 			// Gérer l'erreur selon vos besoins
// 		}

// 		// Fermeture de la session cURL
// 		curl_close($curl);




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
	function getlongtranscription($finalpath,$nom_image,$infolangue){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://146.59.159.57:5005/gettranscription");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
			"video_path_initial=".$finalpath."&video_name=".$nom_image."&video_interlocutor=1&video_langue=".$infolangue);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	return $server_output;
	}
	function getnewlongtranscription($urlaudio){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://elprod.forma2plus.com:5012/transcriptionopenai");
		curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
			"url=".$urlaudio);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
		return $server_output;
	}

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
		$sampleRateHertz = 48000;
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