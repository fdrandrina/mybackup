
<?php
$con = new mysqli("localhost", "root", "dev456root", "db_el2016");
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
$id = $obj['id'];
$expres = $obj['expres'];
$traduction = $obj['traduction'];
mysqli_set_charset($con,"utf8");
$text1 = mysqli_real_escape_string($con, $expres);
$text2 = mysqli_real_escape_string($con, $traduction );
$PickerValueHolder = $obj['PickerValueHolder'];
$Sql_Query = "insert into expressions_stagiaires (id_stagiaire, target_langue_cible,content_langue_origine,content_langue_cible,date_creation)  values ('$id','$PickerValueHolder','$text1 ','$text2',now())";
	 if(mysqli_query($con,$Sql_Query)){		
		$MSG = 'Expression saved ';
		$json = json_encode($MSG);
			echo $json ;	 
	 }
	 else{ 
		$er='Something Went Wrong';
		$temp = json_encode($er);
		echo $temp ; 
	 }
mysqli_close($con);	
?>
