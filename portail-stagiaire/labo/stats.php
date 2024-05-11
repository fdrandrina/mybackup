<?php
include "../connexion.php";
$data = json_decode('{
    "adjectives": [
        "presidential",
        "hight",
        "many"
    ],
    "hapaxes": [
        "stand",
        "today"
    ],
    "verbs": [
        "stand",
        "humbled"
    ]
}', true);

// Récupère les valeurs des clés adjectives, hapaxes et verbs
$adjectives = $data['adjectives'];
$hapaxes = $data['hapaxes'];
$verbs = $data['verbs'];
// $sql = "INSERT INTO textstats (adjective, hapax, verb) VALUES (?, ?, ?)";
// ADJECTIVES

// Préparation de la requête SQL
$stmt = $mysqli->prepare("INSERT INTO textstats (id_expw, word, typestat) VALUES (?, ?, ?)");
// $stmt = mysqli_prepare($conn, $sql);

// Boucle sur les adjectifs, hapaxes et verbes pour les insérer dans la base de données
$id_expw=223;
$adj = "adjective";
foreach ($adjectives as $word ) {
    mysqli_stmt_bind_param($stmt, "iss", $id_expw, $word, $adj);
    mysqli_stmt_execute($stmt);
}

// Fermeture de la requête préparée
mysqli_stmt_close($stmt);
// VERBS

$stmtvb = $mysqli->prepare("INSERT INTO textstats (id_expw, word, typestat) VALUES (?, ?, ?)");
// $stmt = mysqli_prepare($conn, $sql);

// Boucle sur les adjectifs, hapaxes et verbes pour les insérer dans la base de données
$id_expw=223;
$vb = "verb";
foreach ($verbs as $word ) {
    mysqli_stmt_bind_param($stmtvb, "iss", $id_expw, $word, $vb);
    mysqli_stmt_execute($stmtvb);
}
// Fermeture de la requête préparée
mysqli_stmt_close($stmtvb);
// HAPAXES

$stmthap = $mysqli->prepare("INSERT INTO textstats (id_expw, word, typestat) VALUES (?, ?, ?)");
// $stmt = mysqli_prepare($conn, $sql);

// Boucle sur les adjectifs, hapaxes et verbes pour les insérer dans la base de données
$id_expw=223;
$hap = "hapax";
foreach ($hapaxes as $word ) {
    mysqli_stmt_bind_param($stmthap, "iss", $id_expw, $word, $hap);
    mysqli_stmt_execute($stmthap);
}
// Fermeture de la requête préparée
mysqli_stmt_close($stmthap);


?>