<?php
require_once 'AloAPI/MyStats.php';
require_once 'AloAPI/Alo.php';
include "../connexion.php";
// *** instanciation du classe mystats
$myStats = new MyStats($mysqli);
$alo = new Alo();
// Appel de la méthode getstat()
$result = $alo->getstat('i like to move it', "listverb");

// Utilisation du résultat retourné
var_dump($result);

?>
