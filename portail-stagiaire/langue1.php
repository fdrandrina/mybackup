<?php
include "connexion.php";
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$abrev = $obj['picIdlangue'];
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
   } 
   $sql = "SELECT id FROM `langage_list` where abrev like '$abrev%'";
   $result = $mysqli->query($sql);
if ($result->num_rows >0) {
    while($row = $result->fetch_assoc()) {
    $tem = array_map('utf8_encode', $row);
    $json=$tem;
    echo json_encode($json);
    }
   } else {
    echo "No Results Found.";
   }
   $mysqli->close();
   ?>