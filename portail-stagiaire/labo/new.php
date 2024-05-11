<?php
  // Chemin du fichier vidéo
$video_path = '/var/www/html/elearning2021/groupes/GRP10013/4626_1681902586.mp4';

// Exécute la commande FFmpeg pour récupérer la durée de la vidéo
$command = 'ffmpeg -i ' . $video_path . ' 2>&1 | grep Duration | cut -d \' \' -f 4 | sed s/,//';
exec($command, $output);

// Récupère la durée sous forme de chaîne de caractères
$duration_str = $output[0];

// Convertit la durée en secondes
list($hours, $minutes, $seconds) = explode(':', $duration_str);
$duration = $hours * 3600 + $minutes * 60 + $seconds;

$hours = gmdate("H", $duration);
$minutes = gmdate("i", $duration);
$seconds = gmdate("s", $duration);
// Affiche la durée en secondes
 echo "$hours:$minutes:$seconds";


?>
