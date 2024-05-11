<?php
require_once __DIR__ . '/speech/vendor/autoload.php';
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
include "connexion.php";
			$id_stag = $_POST['id_stag'];
			$targL = $_POST['targL'];
			$domain_name = "http://vps339112.ovh.net/portail-stagiaire" ;
			$id_groupe= $_POST['id_groupe'];
			$idecate= $_POST['idecate'];
            $transaudio= $_POST['transaudio'];
            $targTEXT= $_POST['targTEXT'];
			$folder_dir = "/var/www/html/elearning2021/groupes/GRP".$id_groupe;
			if (!is_dir($folder_dir)) {
				mkdir("/var/www/html/elearning2021/groupes/GRP".$id_groupe, 0777, true);
			}
			$target_dir = $folder_dir . "/" .$id_stag. "_" . time() . ".wav";
			$nom_audio=$id_stag. "_" . time() . ".wav";
			$infolangue= $_POST['infolangue'];	
	  if(move_uploaded_file($_FILES['recording']['tmp_name'], $target_dir)){
			$target_dir = $domain_name . $target_dir ;
			mysqli_set_charset($mysqli,"utf8");
			$lien = mysqli_real_escape_string($mysqli, $nom_audio);
			$audioFile = $folder_dir."/".$nom_audio;
			$Sql_Query = "insert into expressions_stagiaires (id_stagiaire,id_category,target_langue_cible,content_langue_origine,content_langue_cible,audio_langue_origine,date_creation)  values ('$id_stag','$idecate','$targL','$transaudio','$targTEXT','$lien',now())";
            if(mysqli_query($mysqli,$Sql_Query)){
			  $MSG = 'Expression saved';
			  echo json_encode($MSG);
			;
	   }
	   else{
        $er='Something Went Wrong'.$transaudio.'and'.$targTEXT.' '.'cat='.$idecate.' '.$targL;
			  $temp = json_encode($er);
			  echo $temp ;
	        }
	  }
      mysqli_close($mysqli);
     ?>