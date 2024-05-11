<?php
include "connexion.php";
// and fs.file_ref = fs.id_exp 
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    $stmt = $mysqli->prepare("select c.id,intitule,e.id_expression,id_category,id_stagiaire,id_tuteur,langue,content_langue_origine,content_langue_cible,audio_langue_origine,audio_langue_cible,e.date_creation,fs.id_files,id_exp,f_name,legende_f,type_file,date_creat from category_expression c right JOIN expressions_stagiaires e ON e.id_category=c.id LEFT JOIN file_stag  fs ON e.id_expression=fs.id_exp where e.id_stagiaire=? and type_file='video' order by e.date_creation DESC");
    $stmt->bind_param("i",$obj->id);
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