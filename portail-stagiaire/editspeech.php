<?php
    include "connexion.php";
    $trad = $_POST['trad'];
    $id = $_POST['id'];
    mysqli_set_charset($mysqli,"utf8");
    $trad = mysqli_real_escape_string($mysqli, $trad);
    $Sql_Query = "UPDATE expressions_stagiaires SET content_langue_origine='$trad' WHERE id_expression='$id' ";
    if(mysqli_query($mysqli,$Sql_Query)){		
           $MSG = 'expression modified';
           $json = json_encode($MSG);
            echo $json ;	 
    }
    else{ 
           $er='Something Went Wrong'.$trad;
           $temp = json_encode($er);
           echo $temp ; 
    }
   mysqli_close($mysqli);
    ?>