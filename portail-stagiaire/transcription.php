<?php
	// Include Google Cloud dependendencies using Composer
require_once __DIR__ . '/speech/vendor/autoload.php';

# [START speech_transcribe_sync]
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
include "connexion.php";
			$id_stag = $_POST['id_stag'];
			$targL = $_POST['targL'];
			$domain_name = "http://vps339112.ovh.net/portail-stagiaire" ;
			$id_groupe= $_POST['id_groupe'];
			$folder_dir = "audio";
			if (!file_exists($folder_dir)) {
				mkdir($folder_dir, 0777, true);
			}
			$target_dir = $folder_dir . "/" .$id_stag. "_" . time() . ".wav";
			$nom_audio=$id_stag. "_" . time() . ".wav";
			$infolangue= $_POST['infolangue'];	
	  if(move_uploaded_file($_FILES['recording']['tmp_name'], $target_dir)){
		  // Adding domain name with image random name.
			$target_dir = $domain_name . $target_dir ;
			$audioFile = $folder_dir."/".$nom_audio;
			$text=transcript($audioFile,$infolangue);
	   else{
		$res = json_encode($text);
			  $er='Something Went Wrong';
			  $temp = json_encode($er);
			  echo $res ;
	        }
	  }
	  mysqli_close($mysqli);	


function transcript($audioFile,$infolangue){
/** Uncomment and populate these variables in your code */
//  $audioFile = './uploads_audio/10304_1594896468.wav';
 if (!is_file($audioFile)){
 return false;
 }
// change these variables if necessary
$encoding = AudioEncoding::LINEAR16;
$sampleRateHertz = 32000;
$languageCode = $infolangue;
// get contents of a file into a string
$content = file_get_contents($audioFile);
// set string as audio content
$audio = (new RecognitionAudio())
    ->setContent($content);
// set config
$config = (new RecognitionConfig())
    ->setEncoding($encoding)
    ->setSampleRateHertz($sampleRateHertz)
    ->setLanguageCode($languageCode);
	putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/html/portail-stagiaire/env/formatrad-7ed5e4c68b97.json');

// create the speech client
$client = new SpeechClient();
$confidence = 0;
# Detects speech in the audio file
$response = $client->recognize($config, $audio);

# Print most likely transcription
foreach ($response->getResults() as $result) {
    $alternatives = $result->getAlternatives();
    $mostLikely = $alternatives[0];
    $trancriptFinal .= " " .$mostLikely->getTranscript();
}
$data = array(
    'message' => "Operation reussit",
     'status'=>true,
     'result'=>$trancriptFinal
);
echo json_encode($data);

$client->close();
return $trancriptFinal;

}
 
?>