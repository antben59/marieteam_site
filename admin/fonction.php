<?php 

function getNomPort($id){
    $sql = get_bdd()->prepare("SELECT nom FROM port WHERE id_port ='$id'");
    $sql->execute();
    $get_infos = $sql->fetch();
    return $get_infos['nom'];
}

?>
