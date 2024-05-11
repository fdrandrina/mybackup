<?php
include "connexion.php";
$json = file_get_contents('php://input');
$obj = json_decode($json);
$stm = $mysqli->set_charset("utf8");
$stmt = $mysqli->prepare("select * from membres where login=? AND password=? ");
$stmt->bind_param("ss",$obj->login,$obj->password);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows >= 1){
    while($row = $result->fetch_assoc()) 
    {
    $json= array_map("utf8_encode",$row);
    echo json_encode($json);
    }
}
else{
    echo json_encode("null");
}
 $stmt->close();
?>