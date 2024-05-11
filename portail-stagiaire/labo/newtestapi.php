<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Content-Length, X-JSON");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");
 require_once 'AloAPI/MyStats.php';
 require_once 'AloAPI/Alo.php';
 include "../connexion.php";
 // *** instanciation du classe mystats
 $myStats = new MyStats($mysqli);
 // ** instanciation du classe alo
 // $ip = '146.59.159.57';
 $AloStats = new Alo('146.59.159.57', '5051');
 // Données reçue
 $json = file_get_contents('php://input');
 $obj = json_decode($json,true);
 $sentence = $obj['sentence'];
 $wd = $obj['word'];
 $idexp = $obj['idexp'];
 $data = array('sentence' => $sentence);
 $data_string = json_encode($data);
// *** getting stats ***/  
 $verbs = $AloStats->getstat($data_string, 'listverb');
 
 $adj = $AloStats->getstat($data_string, 'listadj');
 $hapaxes = $AloStats->getstat($data_string, 'listhapax'); //
 $vbpos = $AloStats->getstat($data_string, 'listverbPos');//count word in text
 $sentform = $AloStats->getstat($data_string, 'sentenceform');//count word in text
 
 $countword = $AloStats->getstat($data_string , 'countword');//count word in text
// $showConcord= $AloStats->getstat($sentence, 'listconcord', $wd);//count word in text listexp
 $mycolocation= $AloStats->getstat($data_string, 'listexp'); //Collocation trigram 
 $service = 'aloservice.service'; // Remplacez "nom_du_service" par le nom réel de votre service Systemd, y compris l'extension .service
 $Sql_Query = "select duree_audio from expressions_stagiaires WHERE id_expression='$idexp' ";
 $result = $mysqli->query($Sql_Query);
 $duree = $result->fetch_assoc();
 
 $duree_audio = $duree['duree_audio'];
 if (is_null($duree_audio)) { //l'expression n'a pas de duré enregistré
    $type_exp = array('type' => 'pas de duree');
    
    $Sqlid_Query = "SELECT COUNT(*) FROM textstats WHERE id_expw='$idexp'";
    $res_stat = $mysqli->query($Sqlid_Query);
    $count_stat = $res_stat->fetch_assoc();
    $stats_inDB = $count_stat['COUNT(*)'];
    
    if($stats_inDB !=0){// si les stats sont deja enregistrés
        $state = "deja";
        $sqlQr = "SELECT typestat, GROUP_CONCAT(word SEPARATOR ', ') AS words FROM textstats WHERE id_expw = $idexp GROUP BY typestat ORDER BY FIELD(typestat, 'nbwords', 'glossaire_adjectivs', 'stats_nbadj', 'glossaire_verbs', 'stats_nbverb', 'glossaire_hapaxes', 'stats_nbhapax', 'conjugaison_presentVerb', 'conjugaison_pastParticipe', 'conjugaison_ingVerb', 'conjugaison_modalVerb', 'conjugaison_pastVerb','phrase_active', 'stats_nbact', 'phrase_passive', 'stats_nbpass' )";

        $resultQr = $mysqli->query($sqlQr);
       
        if ($resultQr->num_rows > 0) {
            // Tableau pour stocker les résultats
            $results = array();
        
            // Parcourir les lignes de résultats
            while ($row = $resultQr->fetch_assoc()) {
                // Récupérer le nom du typestat
                    $typestat = $row['typestat'];
                    $wordsArray = explode(', ', $row['words']);
                    // Créer un tableau avec le nom du typestat et les mots associés
                    $resultRow = array(
                        $typestat => $wordsArray
                    );
                    $results[] = $resultRow;
                    $adjstats = array(
                        "glossaire_adjectivs" => $results[1]['glossaire_adjectivs'],
                        "stats_nbadj" => intval(implode('', $results[2]['stats_nbadj']))
                    );
                    $vbstats = array(
                        "glossaire_verbs" => $results[3]['glossaire_verbs'],
                        "stats_nbverb" => intval(implode('', $results[4]['stats_nbverb']))
                    );
                    $hapaxes_stats = array(
                        "glossaire_hapaxes" => $results[5]['glossaire_hapaxes'],
                        "stats_nbhapax" => intval(implode('', $results[6]['stats_nbhapax']))
                    );
                    $conjugaison_stats = array(
                        "conjugaison_presentVerb" => $results[7]['conjugaison_presentVerb'],
                        "conjugaison_modalVerb" => $results[10]['conjugaison_modalVerb'],
                        "conjugaison_ingVerb" => $results[9]['conjugaison_ingVerb'],
                        "conjugaison_pastParticipe" => $results[8]['conjugaison_pastParticipe'],
                        "conjugaison_pastVerb" => $results[11]['conjugaison_pastVerb'],
                    );
                    $phrase_stats = array(
                        "phrase_active" => $results[12]['phrase_active'],
                        "phrase_passive" => $results[14]['phrase_passive'],
                        "stats_nbact" => intval(implode('', $results[13]['stats_nbact'])),
                        "stats_nbpass" => intval(implode('', $results[15]['stats_nbpass'])),
                    );

                    $debits = array('stats_debits' => $debitsaud);
                    $countword = array('stats_nbwords' => intval(implode('', $results[0]['nbwords'])));
                    $duree_audio = array('stats_duree' => $duree_aud);
                    $stateOfStates = array('state_db' => $state);

                    $Sqlid_Query2 = "SELECT * FROM `file_stag` WHERE `id_exp` = '$idexp'";
                    
                    $res_orig = $mysqli->query($Sqlid_Query2);

                    if ($res_orig->num_rows > 0) {
                        $nresults = array();

                        while ($nrow = $res_orig->fetch_assoc()) {
                            $nresults[] = $nrow;
                            $ref = $nresults[0]['file_ref'];
                            if (is_null($ref)) {
                                $ref = $idexp;
                            }
                        }
                    } else {
                        $ref = $idexp;
                    }

                    $Sqlid_Query3 = "SELECT content_langue_origine FROM `expressions_stagiaires` where id_expression = '$ref'";
                    $txt_orig = $mysqli->query($Sqlid_Query3);
                    if ($txt_orig->num_rows > 0) {
                        $txresults = array();
                        while ($txrow = $txt_orig->fetch_assoc()) {
                            $txresults[] = $txrow;
                            $reftxt = $txresults[0]['content_langue_origine'];
                        }
                    } else {
                        $reftxt = " ";
                    } 
                    $myref = array(
                        'ref' => $ref,
                        'text_reference' => strval($reftxt)
                    );   
                    $ver = array('version' => 'original');
                    $result4 = array(
                        $duree_audio,
                        $countword,
                        $debits,
                        $adjstats,
                        $vbstats,
                        $hapaxes_stats,
                        $phrase_stats,
                        $conjugaison_stats,
                        $stateOfStates,
                        $type_exp,
                        $myref
                    );
            }
            $jsonResult = json_encode($result4);
            echo $jsonResult;
        } else {
            echo "Aucun résultat trouvé.";
        }
    }else{
        $state = "premier fois";
                // *** glossaire ***
        $myStats->savestats($adj, 'glossaire_adjectivs', 'glossaire_adjectivs', $idexp);
        $myStats->savestats($verbs, 'glossaire_verbs', 'glossaire_verbs', $idexp);
        $myStats->savestats($hapaxes, 'glossaire_hapaxes', 'glossaire_hapaxes', $idexp);
        $myStats->savestats($vbpos, 'conjugaison_presentVerb', 'conjugaison_presentVerb', $idexp);
        $myStats->savestats($vbpos, 'conjugaison_ingVerb', 'conjugaison_ingVerb', $idexp);
        $myStats->savestats($vbpos, 'conjugaison_pastParticipe', 'conjugaison_pastParticipe', $idexp);
        $myStats->savestats($vbpos, 'conjugaison_pastVerb', 'conjugaison_pastVerb', $idexp);
        $myStats->savestats($vbpos, 'conjugaison_modalVerb', 'conjugaison_modalVerb', $idexp);
        $myStats->savestats($sentform, 'phrase_active', 'phrase_active', $idexp);
        $myStats->savestats($sentform, 'phrase_passive', 'phrase_passive', $idexp);
         // // *** stats comptage ***
        $myStats->nbstats($sentform, 'stats_nbact', 'stats_nbact', $idexp);
        $myStats->nbstats($sentform, 'stats_nbpass', 'stats_nbpass', $idexp);
        $myStats->nbstats($countword, 'nbwords', 'nbwords', $idexp);
        $myStats->nbstats($verbs, 'stats_nbverb', 'stats_nbverb', $idexp);
        $myStats->nbstats($adj, 'stats_nbadj', 'stats_nbadj', $idexp);
        $myStats->nbstats($hapaxes, 'stats_nbhapax', 'stats_nbhapax', $idexp);
        $stateOfStates = array('state_db' => $state);
        $duree_audio = array('stats_duree' => null);
        $debits = array('stats_debits' => null);
        $Sqlid_Query2 = "SELECT * FROM `file_stag` WHERE `id_exp` = '$idexp'";
        $res_orig = $mysqli->query($Sqlid_Query2);
        if ($res_orig->num_rows > 0) {
            $nresults = array();

            while ($nrow = $res_orig->fetch_assoc()) {
                $nresults[] = $nrow;
                $ref = $nresults[0]['file_ref'];
                if (is_null($ref)) {
                    $ref = $idexp;
                }
            }
        } else {
            $ref = $idexp;
        }
        $Sqlid_Query3 = "SELECT content_langue_origine FROM `expressions_stagiaires` where id_expression = '$ref'";
        $txt_orig = $mysqli->query($Sqlid_Query3);
        if ($txt_orig->num_rows > 0) {
            $txresults = array();

            while ($txrow = $txt_orig->fetch_assoc()) {
                $txresults[] = $txrow;
                $reftxt = $txresults[0]['content_langue_origine'];
                
            }
        } else {
            $reftxt = " ";
        } 
        $myref = array(
            'ref' => $ref,
            'text_reference' => strval($reftxt)
        );   
        $countword = array('stats_nbwords' => $countword['nbwords']);


        $myresult = array(
            $duree_audio,
            $countword,
            $debits,
            $adj,
            $verbs,
            $hapaxes,
            // $mycolocation,
            $sentform,
            $vbpos,
            // $stats_inDB,
            $stateOfStates,
            $type_exp,
            $myref
        );
        echo json_encode($myresult);
    }

}else{ // l'expression est enregistré avec durré

    $Sqlid_Query = "SELECT COUNT(*) FROM textstats WHERE id_expw='$idexp'";
    $res_stat = $mysqli->query($Sqlid_Query);
    $count_stat = $res_stat->fetch_assoc();
    $stats_inDB = $count_stat['COUNT(*)'];
    if($stats_inDB != 0){// si les stats sont deja enregistrés
        $state = "deja";
    }else{
        $state = "premier fois";
        // *** glossaire ***
        $myStats->savestats($adj, 'glossaire_adjectivs', 'glossaire_adjectivs', $idexp);
        $myStats->savestats($verbs, 'glossaire_verbs', 'glossaire_verbs', $idexp);
        $myStats->savestats($verbs, 'glossaire_hapaxes', 'glossaire_hapaxes', $idexp);
        $myStats->savestats($sentform, 'phrase_active', 'phrase_active', $idexp);
        $myStats->savestats($sentform, 'phrase_passive', 'phrase_passive', $idexp);
            // *** stats comptage ***
        $myStats->nbstats($sentform, 'stats_nbact', 'stats_nbact', $idexp);
        $myStats->nbstats($sentform, 'stats_nbpass', 'stats_nbpass', $idexp);
        $myStats->nbstats($countword, 'nbwords', 'nbwords', $idexp);
        $myStats->nbstats($verbs, 'stats_nbverb', 'stats_nbverb', $idexp);
        $myStats->nbstats($adj, 'stats_nbadj', 'stats_nbadj', $idexp);
        $myStats->nbstats($hapaxes, 'stats_nbhapax', 'stats_nbhapax', $idexp);

       
    }
    $seconds = strtotime("1970-01-01 $duree_audio UTC");
    $debits = $countword['nbwords']/$seconds;
    $debits = array('stats_debits' => $debits);
    $countword = array('stats_nbwords' => $countword['nbwords']);
    $duree_audio = array('stats_duree' => $duree_audio);
    $type_exp = array('type' => 'avec duree');
    $ver = array('version' => 'original');
    $stateOfStates = array('state_db' => $state);
    $Sqlid_Query2 = "SELECT * FROM `file_stag` WHERE `id_exp` = '$idexp'";
    $res_orig = $mysqli->query($Sqlid_Query2);

    if ($res_orig->num_rows > 0) {
        $nresults = array();
        while ($nrow = $res_orig->fetch_assoc()) {
            $nresults[] = $nrow;
            $ref = $nresults[0]['file_ref'];
            if (is_null($ref)) {
                $ref = $idexp;
            }
        }
    } else {
        $ref = $idexp;
    }
    $Sqlid_Query3 = "SELECT content_langue_origine FROM `expressions_stagiaires` where id_expression = '$ref'";
    $txt_orig = $mysqli->query($Sqlid_Query3);
    if ($txt_orig->num_rows > 0) {
        $txresults = array();

        while ($txrow = $txt_orig->fetch_assoc()) {
            $txresults[] = $txrow;
            $reftxt = strval($txresults[0]['content_langue_origine']);
            // ini_set('xdebug.var_display_max_data', -1);
            // var_dump($reftxt);
        }
        
    } else {
        $reftxt = " ";
    } 
    // var_dump($reftxt);
    $myref = array(
        'ref' => $ref,
        'text_reference' => $reftxt
    );         
    $myresult = array(
    $duree_audio,
    $countword,
    $debits,
    $adj,
    $verbs,
    $hapaxes,
    // $mycolocation,
    $sentform,
    $vbpos,
    $stateOfStates,
    $type_exp,
    $myref,
    // $stats_inDB
);
echo json_encode($myresult);
}

$mysqli->close();
?>

