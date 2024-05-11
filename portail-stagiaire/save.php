
<?php
include "connexion.php";
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$id = $obj['id'];
	$expres = $obj['expres'];
	$traduction = $obj['traduction'];
	$category = $obj['category'];
	mysqli_set_charset($mysqli,"utf8");
	$text1 = mysqli_real_escape_string($mysqli, $expres);
	$text2 = mysqli_real_escape_string($mysqli, $traduction );
	$PickerValueHolder = $obj['PickerValueHolder'];
	$Sql_Query = "insert into expressions_stagiaires (id_stagiaire, id_category, target_langue_cible,content_langue_origine,content_langue_cible,date_creation)  values ('$id',$category ,'$PickerValueHolder','$text1 ','$text2',now())";
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
