
<?php
	include "connexion.php";
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$ca = $obj['ca'];
	$ex= $obj['ex'];
	$Sql_Query = "UPDATE expressions_stagiaires set id_category='$ca' WHERE id_expression='$ex' ";
	 if(mysqli_query($mysqli,$Sql_Query)){		
			$MSG = 'Category changed  ';
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