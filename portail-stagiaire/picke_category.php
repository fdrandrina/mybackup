<?php
include "connexion.php";
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    $stmt = $mysqli->prepare("SELECT * FROM category_expression where id_groupe=? ");
    $stmt->bind_param("s",$obj->id_groupe);
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