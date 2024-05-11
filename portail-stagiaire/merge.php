<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");
ini_set('max_execution_time', 0);
include "connexion.php";
$fname = $_POST['fname'];
$audioname = $_POST['audioname'];
$legende_f = $_POST['legende_f'];
$mot = $_POST['mot'];
$id_groupe = $_POST['id_groupe'];
$id_stagiaire = $_POST['id_stagiaire'];
$out = "__".time()."output".$fname;
$new = strtok($fname, 'output.webm').".mp4";
$name = pathinfo($fname, PATHINFO_FILENAME);
$out1 = time().'output.mp4';
$out2 = pathinfo($out1, PATHINFO_FILENAME).'.webm';
$infolangue = $_POST['infolangue'];
$bandaudio = time().'outputmp4_final.wav';
$finalpath = "/var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$out1;
$urlaudio = 'https://elprod.forma2plus.com/recording/uploads/'.'/'.$audioname;
$cmd = "ffmpeg -i /var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$fname." -i /var/www/html/recording/uploads/".$audioname."  -c:v copy -c:a aac -strict -2  -map 0:v:0 -map 1:a:0 /var/www/html/elearning2021/groupes/GRP".$id_groupe."/".$out1;
shell_exec($cmd);
// $mytxt = getlongtranscription($finalpath,$out1,$infolangue);
$mytxt = getnewlongtranscription($urlaudio);
$text = substr($mytxt, 26);
$res1 = str_replace( array( '%', '@', '\'', ';', '<', '{', '"', '}' ), ' ', $text);
$res2 = substr($res1, 0, -1);
$Sql_Query = "insert into expressions_stagiaires (id_stagiaire,content_langue_origine,audio_langue_origine,date_creation)  values ('$id_stagiaire','$res2','$bandaudio',now())";
if(mysqli_query($mysqli,$Sql_Query)){
    $last_id = mysqli_insert_id($mysqli);
    $sql1= "INSERT INTO file_stag (id_exp,f_name,legende_f,type_file,date_creat)  VALUES ($last_id,'$out1','$legende_f','video',now())";
    $mysqli -> query($sql1);
    echo json_encode("finished".$audioname);
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
    mysqli_close($mysqli);
    ?>