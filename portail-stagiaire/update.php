
<?php
	include "connexion.php";
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
$id = $obj['id'];
$idexp= $obj['idexp'];
$expres = $obj['expres'];
$idecat = $obj['idecat'];
$traduction = $obj['traduction'];
mysqli_set_charset($mysqli,"utf8");
$text1 = mysqli_real_escape_string($mysqli, $expres);
$text2 = mysqli_real_escape_string($mysqli, $traduction );
$PickerValueHolder = $obj['PickerValueHolder'];
$Sql_Query = "UPDATE expressions_stagiaires set target_langue_cible='$PickerValueHolder',id_category='$idecat',content_langue_origine='$text1',content_langue_cible='$text2' WHERE id_expression='$idexp' ";
	if(mysqli_query($mysqli,$Sql_Query)){		
		$MSG = 'Expression saved ';
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