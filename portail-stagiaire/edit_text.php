<?php
    include "connexion.php";
    $org = $_POST['org'];
    $id = $_POST['id'];
    mysqli_set_charset($mysqli,"utf8");
    $org = mysqli_real_escape_string($mysqli, $obs);
    $Sql_Query = "UPDATE expressions_stagiaires SET content_langue_origine='$org' WHERE id_exp='$id' ";
    if(mysqli_query($mysqli,$Sql_Query)){		
           $MSG = 'expression updated saved';
           $json = json_encode($MSG);
            echo $json ;	 
    }
    else{ 
           $er='Something Went Wrong'.$id.' and '.$org;
           $temp = json_encode($er);
           echo $temp ; 
    }
   mysqli_close($mysqli);
    ?>