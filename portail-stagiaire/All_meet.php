<?php
include "connexion.php";
            $json = file_get_contents('php://input');
            $obj = json_decode($json);
            $dateR= date('Y-m-d');
$stmt = $mysqli->prepare("select * from test_reunion");
$stmt->execute();
            $result = $stmt->get_result();
            $json=[];
    while($row = $result->fetch_assoc()) {
$tem = array_map('utf8_encode', $row);
            $json[]= $tem;
        }
    echo json_encode($json);
$stmt->close();
?>