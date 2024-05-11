<?php
 require_once __DIR__ . '/speech/vendor/autoload.php';
 use Google\Cloud\Speech\V1\SpeechClient;
 use Google\Cloud\Speech\V1\RecognitionAudio;
 use Google\Cloud\Speech\V1\RecognitionConfig;
 use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
//  $idex=$_POST['idex'];  
$id_stag = $_POST['id_stag'];
$id_groupe = $_POST['id_groupe'];
$infolangue= $_POST['infolangue'];	
	
	$domain_name = "https://demo.forma2plus.com/portail-stagiaire" ;
	
	// Image uploading folder.
	$folder_dir = "/var/www/html/elearning2021/groupes/GRP".$id_groupe;
			if (!is_dir($folder_dir)) {
				mkdir("/var/www/html/elearning2021/groupes/GRP".$id_groupe, 0777, true);
			}


	$target_dir = "audio";
	
	$target_dir = $folder_dir. "/".$id_stag."test"."_".time().".wav";
	$finalpath="/var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$id_stag."test"."_".time().".wav";
	
	$audio_name = $id_stag."test"."_".time().".wav";
	$urlaudio = 'https://elprod.forma2plus.com/elearning2021/groupes/GRP'.$id_groupe.'/'.$audio_name;
	$nom_audio=$id_stag."test.wav";
	$nom_audio1=$id_stag."test1.wav";
	$nom_audio2=$id_stag."test2.wav";
	$nom_audio3=$id_stag."test3.wav";
	$nom_audio4=$id_stag."test4.wav";
		
	if(move_uploaded_file($_FILES['recording']['tmp_name'], $target_dir)){
		$path = $target_dir;
		// $time = exec("ffmpeg -i " . escapeshellarg($path) . " 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
		// list($hms, $milli) = explode('.', $time);
		// list($hours, $minutes, $seconds) = explode(':', $hms);
		// $total_seconds = $seconds;
		// $path2 ="mytest2.wav";
		$ffprobe    = \FFMpeg\FFProbe::create();
		$durationaudio   = $ffprobe->format($path)->get('duration');
		// if ($durationaudio <=50){
			$text = getnewlongtranscription($urlaudio);
			// $text = " nkjhk jbhkhi jnbkihi jkkjhk jkhjh jhohouh";
			$newtext = substr($text, 26);
		$res1 = str_replace( array( '%', '@', '\'', ';', '<', '{', '"', '}' ), ' ', $newtext);
		$res2 = substr($res1, 0, -1);
		$texte_utf8 = utf8_encode($res2);
			$datatrans = array(
				'message' => "Operation reussit",
				'status'=>true,
				'result'=>$text,
				 'path' =>$finalpath,
				 'audio' => $audio_name
			);
			// $text=transcript($target_dir,$infolangue);
			$ser="audio: Normal length ".$durationaudio;
			echo json_encode($datatrans);
		// } elseif ($durationaudio <=100) {
		// 	$moveCommand1 = "ffmpeg -i " . escapeshellarg($path) . " -ss 00:00:00 -to 00:00:50 -c copy " . escapeshellarg($nom_audio1);
		// 	$moveCommand2 = "ffmpeg -i " . escapeshellarg($path) . " -ss 00:00:00 -to 00:00:20 -c copy " . escapeshellarg($nom_audio2);
		// 	$output = exec($moveCommand1." && ".$moveCommand2);
		// 	$text1=transcript($nom_audio1,$infolangue);
		// 	$text2=transcript($nom_audio2,$infolangue);

		// 	$ser="audio: too long".$durationaudio." de longuer";
		// 	echo json_encode($text1 ." " .$text2);
		// }
		// elseif ($durationaudio >100) {
		// 	$moveCommand1 = "ffmpeg -i " . escapeshellarg($path) . " -ss 00:00:00 -to 00:00:30 -c copy " . escapeshellarg($nom_audio1);
		// 	$output = exec($moveCommand1);
		// 	$ser="audio: too long: ".$durationaudio;
		// 	echo json_encode($ser);
		// }

		// $moveCommand1 = "ffmpeg -i " . escapeshellarg($path) . " -ss 00:00:00 -to 00:00:02 -c copy " . escapeshellarg($nom_audio1);
		// $output = exec($moveCommand1);
		// $output = exec($moveCommand);
		// echo "$total_seconds\n";
		// $ser="audio: ".$durationaudio." de longuer";
		// echo json_encode($ser."d ty n info langue".$infolangue);
		// $text=transcript($target_dir,$infolangue);
		// transcript($target_dir,$infolangue);
		// if (file_exists($target_dir)) {
		// 	unlink($target_dir);
			
		// }
	   // echo json_encode($ser);
		// Adding domain name with image random name.
		// $target_dir = $domain_name . $target_dir ;
		// mysqli_set_charset($con,"utf8");
		// $lien = mysqli_real_escape_string($con, $nom_audio);
		// Inserting data into MySQL database.
		// $Sql_Query = "insert into expressions_stagiaires (id_stagiaire,target_langue_cible,	audio_langue_origine,date_creation)  values ('$id_stag','$targL','$lien',now())";
    //     $Sql_Query = "UPDATE expressions_stagiaires set audio_langue_origine='$lien' WHERE id_expression='$idex' ";
    //     if(mysqli_query($con,$Sql_Query)){
	 
			
	// 		$MSG = 'Audio uploaded and saved on database';
	// 		$json = json_encode($MSG);
	// 		 echo $json ;
	 
	//  }
	//  else{
	 
	// 		$er='Something Went Wrong';
	// 		$temp = json_encode($er);
	// 		echo $temp ;
	 
	//  }
		
	}
	function getlongtranscription($finalpath,$audio_name,$infolangue){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://146.59.159.57:5005/gettranscription");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
					"video_path_initial=".$finalpath."&video_name=".$audio_name."&video_interlocutor=1&video_langue=".$infolangue);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);
		return $server_output;
	}
	function getnewlongtranscription($urlaudio){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://elprod.forma2plus.com:5012/transcriptionopenai");
		curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
			"url=".$urlaudio);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
		return $server_output;
	}
	function transcript($target_dir,$infolangue){
		/** Uncomment and populate these variables in your code */
		//  $audioFile = './uploads_audio/10304_1594896468.wav';
		 if (!is_file($target_dir)){
		 return false;
		 }
		// change these variables if necessary
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
		// var_dump($audioFile);
		// die;
		// $trancriptFinal = "";
		$confidence = 0;
		# Detects speech in the audio file
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