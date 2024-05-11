<?php
	include "connexion.php";
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$id = $obj['id'];
	$intitule= $obj['intitule'];
    $description= $obj['description'];
	$Sql_Query = "UPDATE category_expression set intitule='$intitule', description='$description' WHERE id='$id' ";
	 if(mysqli_query($mysqli,$Sql_Query)){		
			$MSG = 'Category updated';
			$json = json_encode($MSG);
			 echo $json ;	 
	 }
	 else{ 
			$er='Something Went Wrong';
			$temp = json_encode($er);
			echo $temp ; 
	 }
	mysqli_close($mysqli);	
?>
