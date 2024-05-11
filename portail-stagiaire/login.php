<?php
include "connexion.php";
    $json = file_get_contents('php://input');
    $obj = json_decode($json,true);
    $login = $obj['login'];
    $password = $obj['password'];
    $Sql_Query = "select * from membres where login=$login";
    $result = $mysqli->query($Sql_Query);
if(isset($result)){
    $SuccessLoginMsg = 'Data Matched';
    $SuccessLoginJson = json_encode($SuccessLoginMsg);
    echo $SuccessLoginJson ; 
 }
 else{
    $InvalidMSG = 'Invalid Username or Password Please Try Again' ;
    $InvalidMSGJSon = json_encode($InvalidMSG);
    echo $InvalidMSGJSon ;
 }
 $mysqli->close();
?>