<?php
	include "connexion.php";
	 $json = file_get_contents('php://input');
	 $obj = json_decode($json,true);
	$myFile = $obj['f_name'];
	$id_groupe = $obj['id_groupe'];
	$folder_dir = "/var/www/html/elearning2021/groupes/GRP".$id_groupe;
	$removable = $folder_dir."/".$myFile;
	$sql2= " DELETE FROM file_stag  WHERE f_name='$myFile' ";
	$mysqli -> query($sql2);
	if(mysqli_query($mysqli,$sql1) || mysqli_query($mysqli,$sql2) ){
		if (is_file($removable)){
			unlink($removable);
		}else
			{
				echo json_encode("file not existing");
			}
			$MSG = 'File and expression deleted succesfuly!';
			$json = json_encode($MSG);
			echo $json ;
	 }
	 else{
			$er='';
			$temp = json_encode($er);
			echo $temp ;
	 }
	mysqli_close($mysqli);
?>