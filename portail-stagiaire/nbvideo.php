<?php
include "connexion.php";
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    $stmt = $mysqli->prepare("select 
        (SELECT COUNT(*)  from category_expression c right JOIN expressions_stagiaires e
        ON e.id_category=c.id LEFT JOIN file_stag  fs ON e.id_expression=fs.id_exp where e.id_stagiaire=?
        and (type_file='video' or type_file='image')  order by e.date_creation DESC) AS nbvideo,
        (SELECT COUNT(*) FROM expressions_stagiaires WHERE id_stagiaire=? and audio_langue_origine IS NOT NULL)  AS nbaudio ,
        (SELECT COUNT(*) FROM expressions_stagiaires WHERE id_stagiaire=? and content_langue_origine IS NOT NULL)  AS nbtext,
        (SELECT COUNT(*) FROM category_expression where id_groupe=? ) AS nbcat
    ");
    $stmt->bind_param("iiii",$obj->id,$obj->id,$obj->id,$obj->id_groupe);
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