<?php
$path2 ="mytest2.wav";
$moveCommand = "ffmpeg -i mytest2.wav  -ss 00:00:00 -to 00:00:02 -c copy cuttest.wav ";
$output = exec($moveCommand);
echo json_encode("reussi !");
    ?>