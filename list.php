<?php
require('bddTools.php');

$type = empty($_GET['type']) ? 'liaison' : $_GET['type'];

if($type === 'liaison'){
    $table = 'liaison';
    $foreign = 'id_secteur';
} else{
    throw new Exception('type incorrect' . $type);
}

$query = $dbco->prepare('SELECT id, nom FROM $table WHERE $foreign = ?');
$query->execute([$_GET['filter']]);
$items = $query->fetchAll();
var_dump(array_map(function ($item){
    return [
        'label' => $item['nom'],
        'value' => $item['id_secteur']
    ];
},$items)) ;
?>
