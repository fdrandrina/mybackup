<?php
    include "connexion.php";
    $obs = $_POST['obs'];
    $id = $_POST['id'];
    mysqli_set_charset($mysqli,"utf8");
    $obs = mysqli_real_escape_string($mysqli, $obs);
    $Sql_Query = "UPDATE file_stag SET file_obs='$obs' WHERE id_exp='$id' ";
    if(mysqli_query($mysqli,$Sql_Query)){		
       $MSG = 'Observation saved';
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