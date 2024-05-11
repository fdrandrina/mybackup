<?php
include "connexion.php";
    $text = $_POST['text'];
    $targL = 1;
    $mot = $_POST['mot'];
    $targTEXT = $_POST['targTEXT'];
    $idecat = $_POST['idecat'];
    $id_stag = $_POST['id_stag'];
	$id_groupe = $_POST['id_groupe'];
    $name = $_POST['name'];
	mysqli_set_charset($mysqli,"utf8");
	$lien = mysqli_real_escape_string($mysqli, $name);
	$targTEXT = mysqli_real_escape_string($mysqli, $targTEXT);
	$text = mysqli_real_escape_string($mysqli, $text);
	$mot = mysqli_real_escape_string($mysqli, $mot);
	$Sql_Query = "insert into expressions_stagiaires (id_stagiaire,id_category,target_langue_cible,content_langue_origine,content_langue_cible,date_creation)  values ($id_stag,$idecat,'$targL','$mot ','$targTEXT',now())";
	 if(mysqli_query($mysqli,$Sql_Query)){
		$last_id = mysqli_insert_id($mysqli);
		$mysqli -> query("INSERT INTO file_stag (id_exp,f_name,legende_f,type_file,date_creat)  VALUES ($last_id,'$lien','$text','image',now())");
		$MSG = 'image uploaded and saved ondatabase and ID is: '.$last_id ;
		$json = json_encode($MSG);
		echo $json ;
	 }
	 else{
	 
		$er='Something Went Wrong'.'  '.'mot'.' :'.$mot.'text'.' :'.$text.'lien'.' :'.$lien.'targL'.' :'.$targL.'targtext'.' :'.$targTEXT.'idecat'.' :'.$idecat;
		$temp = json_encode($er);
		echo $temp ;
	 }
	mysqli_close($mysqli);
?>