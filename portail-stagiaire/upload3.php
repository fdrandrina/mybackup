<?php
    require_once __DIR__ . '/speech/vendor/autoload.php';
    use Google\Cloud\Speech\V1\SpeechClient;
    use Google\Cloud\Speech\V1\RecognitionAudio;
    use Google\Cloud\Speech\V1\RecognitionConfig;
    use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

    $id_stag = $_POST['id_stag'];
    $id_groupe = $_POST['id_groupe'];
    $infolangue= $_POST['infolangue'];	
	$domain_name = "https://demo.forma2plus.com/portail-stagiaire" ;
	$folder_dir = "/var/www/html/elearning2021/groupes/GRP".$id_groupe;
	if (!is_dir($folder_dir)) {
		mkdir("/var/www/html/elearning2021/groupes/GRP".$id_groupe, 0777, true);
	}
	$target_dir = "audio";
	$target_dir = $folder_dir. "/".$id_stag."test"."_".time().".wav";
	$finalpath="/var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$id_stag."test"."_".time().".wav";
    $txtpath = "/var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$id_stag."test"."_".time().".txt";
	$audio_name = $id_stag."test"."_".time().".wav";
	$nom_audio=$id_stag."test.wav";
	$nom_audio1=$id_stag."test1.wav";
	$nom_audio2=$id_stag."test2.wav";
	$nom_audio3=$id_stag."test3.wav";
	$nom_audio4=$id_stag."test4.wav";
	if(move_uploaded_file($_FILES['recording']['tmp_name'], $target_dir)){
		$path = $target_dir;
		$ffprobe    = \FFMpeg\FFProbe::create();
		$durationaudio   = $ffprobe->format($path)->get('duration');
        $text = getlongtranscription($finalpath,$audio_name,$infolangue);
        $datatrans = array(
            'message' => "Operation reussit",
            'status'=>true,
            'result'=>$text,
			'path' =>$finalpath,
			'audio' => $audio_name
        );
        $ser="audio: Normal length ".$durationaudio;
        echo json_encode($text);
	}

	function getlongtranscription($finalpath,$audio_name,$infolangue){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://149.202.58.189:5005/gettranscription");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
					"video_path_initial=".$finalpath."&video_name=".$audio_name."&video_interlocutor=1&video_langue=".$infolangue);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		return $server_output;
	}

	function transcript($target_dir,$infolangue){
		 if (!is_file($target_dir)){
		 return false;
		 }
		$encoding = AudioEncoding::LINEAR16;
		$sampleRateHertz = 44100;
		$languageCode = $infolangue;
		// get contents of a file into a string
		$content = file_get_contents($target_dir);
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
		$operation = $client->longRunningRecognize($config, $audio);
		$operation->pollUntilComplete();
		# Print most likely transcription
        if ($operation->operationSucceeded()) {
            $response = $operation->getResult();
            foreach ($response->getResults() as $result) {
            $alternatives = $result->getAlternatives();
            $mostLikely = $alternatives[0];
            $transcript = $mostLikely->getTranscript();
            }
		
		$client->close();
		return $transcript;
			}
		else{
            $transcript= "file too large";
            return $transcript;
			}	
		}
?>