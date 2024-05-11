<?php
include "connexion.php";

// Récupérer les données JSON envoyées via POST
$json = file_get_contents('php://input');
$obj = json_decode($json);

// Préparer la requête SQL avec des alias pour les colonnes et une jointure explicite
$sql = "SELECT 
            c.id AS category_id, 
            c.intitule AS category_intitule, 
            e.id_expression AS expression_id, 
            e.id_category AS expression_category_id, 
            e.id_stagiaire AS expression_stagiaire_id, 
            e.id_tuteur AS expression_tuteur_id, 
            e.langue AS expression_langue,
            e.content_langue_origine AS expression_content_langue_origine, 
            e.content_langue_cible AS expression_content_langue_cible, 
            e.audio_langue_origine AS expression_audio_langue_origine, 
            e.audio_langue_cible AS expression_audio_langue_cible,
            e.date_creation AS expression_date_creation, 
            fs.id_files AS files_id, 
            fs.id_exp AS files_expression_id, 
            fs.f_name AS files_name, 
            fs.legende_f AS files_legend, 
            fs.type_file AS files_type, 
            fs.date_creat AS files_creation_date,
            COALESCE(a.link_transcpt, '') AS audio_transcription_link
        FROM category_expression c
        RIGHT JOIN expressions_stagiaires e ON e.id_category = c.id
        LEFT JOIN file_stag fs ON e.id_expression = fs.id_exp
        LEFT JOIN audio a ON e.id_expression = a.id_exp_audio
        WHERE e.id_stagiaire = ? 
        AND (fs.type_file = 'video' OR fs.type_file IS NULL)
        AND (fs.id_exp, fs.date_creat) IN (
            SELECT id_exp, MAX(date_creat)
            FROM file_stag
            GROUP BY id_exp
        )
        ORDER BY c.intitule ASC, e.date_creation DESC";



// Préparer la requête SQL et exécuter
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $obj->id);
$stmt->execute();
$result = $stmt->get_result();

// Stocker les résultats dans un tableau associatif
$json = [];
while ($row = $result->fetch_assoc()) {
    $row = array_map('utf8_encode', $row); // Convertir les valeurs en UTF-8 si nécessaire
    $json[] = $row;
}

// Renvoyer les données encodées en JSON
echo json_encode($json);

// Fermer la requête
$stmt->close();
?>

