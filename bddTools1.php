<?php

function getJsonElements($chemin, $nameTab, $element){
    $data = file_get_contents($chemin); 
    // décoder le flux JSON
    $obj = json_decode($data); 
    // accéder à l'élément approprié
    return $obj->{$nameTab}[0]->{$element};

    // ex : echo getJsonElement("../log.json", "BDDlog", "mdp");
}

$servname = getJsonElements('../log.json','BDDlog','serveurname');
$dbname = getJsonElements('../log.json','BDDlog','dbname');
$user = getJsonElements('../log.json','BDDlog','login');
$pass = getJsonElements('../log.json','BDDlog','mdp');
$dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);

?>
