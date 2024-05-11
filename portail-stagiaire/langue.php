<?php
include "connexion.php";
 $json = file_get_contents('php://input');
 $obj = json_decode($json);
$stmt = $mysqli->prepare("select id from langage_list where abrev=? ");
$stmt->bind_param("s",$obj->PickerValueHolder);
$stmt->execute();
$result = $stmt->get_result();
$json='';
while($row = $result->fetch_assoc()) {
    $tem = array_map('utf8_encode', $row);
    $json= $tem;
    }
echo json_encode($json);
 $stmt->close();
?>