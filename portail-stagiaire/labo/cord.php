<?php
include "../connexion.php";
// Données à envoyer

$json = file_get_contents('php://input');
$obj = json_decode($json,true);
$sentence = $obj['sentence'];
$data = array('sentence' => $sentence);
$data_string = json_encode($data);
//word json form
$wd = $obj['word'];
$wd_array = array('word' => $wd);
$wd_string = json_encode($wd_array);



$showConcord= showConcord($sentence,$wd);//count word in text
$concord= json_decode($showConcord, true); 
$myresult = array(
    $concord
);
echo json_encode($myresult);//final response
function showConcord($sentence, $wd) {
    $url = 'http://146.59.159.57:5051/listconcord';
    $ch = curl_init($url);
    
    // Créer un tableau de données à envoyer en POST
    $post_data = array(
        'sentence' => $sentence,
        'word' => $wd
    );
    
    $post_fields = json_encode($post_data);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($post_fields)
    ));
    
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

?>
