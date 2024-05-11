<?php
	include "connexion.php";
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$id = $obj['id'];
	$sql1= " DELETE FROM expressions_stagiaires  WHERE id_expression='$id' ";
    $mysqli -> query($sql1);
	if(mysqli_query($mysqli,$sql1)){
			$MSG = 'Expression deleted succesfuly';
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