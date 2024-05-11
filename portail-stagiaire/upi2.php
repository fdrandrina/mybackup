<?php
include "connexion.php";
	$id = $_POST['id'];	
	$id_groupe = $_POST['id_groupe'];	
	$name = $_POST['name'];	
	$ext = $_POST['ext'];
	$fname = $id."test"."_".time().".".$ext;
	$finalpath="/var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$id."test"."_".time().".".$ext;
	$audio = "extracted by video";	
		if(move_uploaded_file($_FILES['recording']['tmp_name'], $finalpath)){
			$datatrans = array(
				'message' => "Operation reussit",
				'status'=>true,
				'path' =>$finalpath,
				'fname' => $fname
				);
				echo json_encode($datatrans);
		}
		mysqli_close($mysqli);
?>