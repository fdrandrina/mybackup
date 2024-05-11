
<?php
	include "connexion.php";
	$json = file_get_contents('php://input');
	$obj = json_decode($json);
	$stmt = $mysqli->prepare("DELETE  FROM category_expression where id=? ");
    $stmt->bind_param("i",$obj->id);
    $stmt->execute();
            $MSG = 'Category deleted';
			$json = json_encode($MSG);
			 echo $json ;	 
             $stmt->close();	
?>