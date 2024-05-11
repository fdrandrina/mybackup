<?php
include "connexion.php";
 $id = $_POST['id'];	
 $id_groupe = $_POST['id_groupe'];	
 $name = $_POST['name'];	
 $idecat = $_POST['idecat'];
 $infolangue = $_POST['infolangue'];
 $ext = $_POST['ext'];
 $fname = $id."test"."_".time().".mp4";
 $finalpath="/var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$id."test"."_".time().".mp4";
 $audio = "extracted by video";	
 $folder_dir = "/var/www/html/elearning2021/groupes/GRP".$id_groupe;
 if (!is_dir($folder_dir)) {
	 mkdir("/var/www/html/elearning2021/groupes/GRP".$id_groupe, 0777, true);
 }
	if(move_uploaded_file($_FILES['recording']['tmp_name'], $finalpath)){
		$text = getnewlongtranscription($finalpath);
		$newtext = substr($text, 8);
		mysqli_set_charset($mysqli,"utf8");
		$newtext1 = mysqli_real_escape_string($mysqli, $newtext);
		$Sql_Query = "insert into expressions_stagiaires (id_stagiaire,id_category,content_langue_origine,audio_langue_origine,date_creation)  values ('$id','$idecat','$newtext1 ','$audio',now())";
		if(mysqli_query($mysqli,$Sql_Query)){
			$last_id = mysqli_insert_id($mysqli);
			$sql1= "INSERT INTO file_stag (id_exp,f_name,legende_f,type_file,date_creat)  VALUES ($last_id,'$fname','recorded File','video',now())";
		$mysqli -> query($sql1);
		}	
		$datatrans = array(
				'message' => "Operation reussit",
				'status'=>true,
				'path' =>$finalpath,
				'textvideo' => $newtext,
				'fname' => $fname
			);
			echo json_encode($datatrans);
	}
	mysqli_close($mysqli);
	function getlongtranscription($finalpath,$audio_name,$infolangue){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://elprod.forma2plus.com:5012/transcriptionopenai");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
					"url=".$finalpath.");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		return $server_output;
	}
	function getnewlongtranscription($finalpath){
		$url = "https://elprod.forma2plus.com:5012/transcriptionopenai?url=" .$finalpath;
		$curl = curl_init($url);

		// Configuration des options de requête
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		// Exécution de la requête
		$response = curl_exec($curl);
		
		// Vérification des erreurs
		if ($response === false) {
			$error = curl_error($curl);
			// Gérer l'erreur selon vos besoins
		}
		
		// Fermeture de la session cURL
		curl_close($curl);
		$json_res = json_decode($response, true);
		// Affichage de la réponse
		// echo $response;
	return $json_res;
	}
?>