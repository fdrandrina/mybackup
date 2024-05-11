
<?php
include "connexion.php";
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$categ = $obj['categ'];
	$id_groupe = $obj['id_groupe'];
	$Sql_Query = "insert into category_expression(id_groupe,intitule,description) values ($id_groupe,'$categ','my description')";
	 if(mysqli_query($mysqli,$Sql_Query)){		
			$MSG = 'category added succesfuly';
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
