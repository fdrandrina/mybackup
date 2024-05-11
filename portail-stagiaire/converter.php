<?php
require_once 'videoconverter/vendor/autoload.php'; 
// Include Google Cloud dependendencies using Composer
require_once __DIR__ . '/speech/vendor/autoload.php';
# [START speech_transcribe_sync]
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
$videofile='uploads_video/9423_1606228333.mp4';
$audio=convert($videofile);
function convert($videofile){
  $ffmpeg = FFMpeg\FFMpeg::create();
  $format = new FFMpeg\Format\Audio\Wav();  
  $format		
    ->setAudioChannels(1)
    ->setAudioKiloBitrate(48000);  
  $audioname="new.wav";
  $audioObj = $ffmpeg->open($videofile);    
  $audioObj->save($format,$audioname);
  return $audioname;
}
$infolangue='en-US';
transcript($audio,$infolangue);
function transcript($audio,$infolangue){
		 if (!is_file($audio)){
		 return false;
		 }
		$encoding = AudioEncoding::LINEAR16;
		$sampleRateHertz = 48000;
		$languageCode = $infolangue;
		$content = file_get_contents($audio);
		$audioF = (new RecognitionAudio())
			->setContent($content);
		$config = (new RecognitionConfig())
				->setEncoding($encoding)
				->setSampleRateHertz($sampleRateHertz)
				->setLanguageCode($languageCode);
				putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/html/portail-stagiaire/env/formatrad-7ed5e4c68b97.json');
		$client = new SpeechClient();
		$confidence = 0;
		$response = $client->recognize($config, $audioF);
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