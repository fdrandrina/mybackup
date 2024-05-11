

<?php
include "connexion.php";
	$id_stag = $_POST['id_stag'];
    $targL = $_POST['targL'];
    $id_groupe = $_POST['id_groupe'];
    $idecate = $_POST['idecate'];
    $transaudioin = $_POST['transaudio'];
    $targTEXTin = $_POST['targTEXT'];
    $pathaudio = $_POST['pathaudio'];
    $infolangue = $_POST['infolangue'];
    $duration = $_POST['duration'];
	mysqli_set_charset($mysqli,"utf8");
    $lien = mysqli_real_escape_string($mysqli, $pathaudio);
    $transaudio = mysqli_real_escape_string($mysqli, $transaudioin);
    $targTEXT = mysqli_real_escape_string($mysqli, $targTEXTin);
	$posted = array(
        'id' => $id_stag,
        'tagetL' => $targL,
        'id_groupe' => $id_groupe,
        'idecate' => $idecate,
        'transaudio' => $transaudio,
        'targtext'=> $targTEXT,
        'pathaudio' => $pathaudio,
        'infolangue' => $infolangue,
        'lien' => $lien,
        'duration' => $duration
	);
	$Sql_Query = "insert into expressions_stagiaires (id_stagiaire,id_category,target_langue_cible,content_langue_origine,content_langue_cible,audio_langue_origine,date_creation,duree_audio)  values ('$id_stag','$idecate','$targL','$transaudio','$targTEXT','$lien',now(),'$duration')";
	 if(mysqli_query($mysqli,$Sql_Query)){	
			$last_id = mysqli_insert_id($mysqli);
            $testtxt = "The best time in life is when you become yourself. I agree that the greatest accomplishment, is when you be yourself in a world that constantly trying to make you something else. Because you make your own choices, you become more happy, and you respect others.First, you make your own choices by being yourself. Becoming yourself means that you should be able to make your own choices and not be shy or afraid of what you're doing. Because you're defining yourself by doing those things that you want. Some people follow others, therefore, they do not make their own choices.";
            $posted = array(
                'id' => $id_stag,
                'tagetL' => $targL,
                'id_groupe' => $id_groupe,
                'idecate' => $idecate,
                'transaudio' => $transaudio,
                'targtext'=> $targTEXT,
                'pathaudio' => $pathaudio,
                'infolangue' => $infolangue,
                'lien' => $lien,
                'idexp' => $last_id,
                'test_txt' => $testtxt
            );
		$json = json_encode($posted);
		echo $json ;		 
	 }
	 else{ 
        $er='Something Went Wrong';
        $temp = json_encode($er);
        echo $temp ; 
	 }
	mysqli_close($mysqli);	
?>