<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * For instructions on how to run the full sample:
 *
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/speech/README.md
 */

// Include Google Cloud dependendencies using Composer
require_once __DIR__ . '/speech/vendor/autoload.php';
# [START speech_transcribe_sync]
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
/** Uncomment and populate these variables in your code */
$audioFile = '10304_1603180849.wav';
 if (!is_file($audioFile)){
    $error = array(
        'message' => "Audio introuvable",
         'status'=>false,
         'result'=>""
    );
    echo json_encode($error);
    die;
 }
// change these variables if necessary
$encoding = AudioEncoding::LINEAR16;
$sampleRateHertz = 48000;
$languageCode = 'en-US';
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
$client = new SpeechClient();
$confidence = 0;
$response = $client->recognize($config, $audio);
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
?>