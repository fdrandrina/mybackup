<?php
 $con = new mysqli("localhost", "root", "dev456root", "db_el2016");
	$text = $_POST['text'];
	$id_stag = "001";
	$domain_name = "https://demo.forma2plus.com/portail-stagiaire" ;
	// Image uploading folder.
	$target_dir = "uploads_video";
	$target_dir = $target_dir . "/" .$id_stag. "_" . time() .$text. ".webm";
	$nom_image=$id_stag. "_".time().".webm";
	if(move_uploaded_file($_FILES['video']['tmp_name'], $target_dir)){
		// Adding domain name with image random name.
		$target_dir = $domain_name . $target_dir ;
			$MSG = 'image uploaded and saved on database';
			$json = json_encode($MSG);
			 echo $json ;
	}
	mysqli_close($con);
?>