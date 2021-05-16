<?php

function getIdPort($nom){
   $sql = get_bdd()->prepare("SELECT id_port FROM port WHERE nom ='$nom'");
   $sql->execute();
   $get_infos = $sql->fetch();
   return $get_infos['id_port'];
}
function getIdSecteur($nom){
    $sql = get_bdd()->prepare("SELECT id_secteur FROM secteur WHERE nom ='$nom'");
    $sql->execute();
    $get_infos = $sql->fetch();
    return $get_infos['id_secteur'];
}


// $sql = get_bdd()->prepare("SELECT * FROM utilisateurs WHERE mail ='$mail'");
// $sql->execute();
// $n_id = $sql->rowCount();

// if($n_id > 0){

//     $get_infos = $sql->fetch();
//     $pwd_hash = $get_infos['mot_de_passe'];

//         if($pwd == $pwd_hash){
//                 $_SESSION['id_utilisateur'] = $get_infos['id'];
//                 $_SESSION['grade_utilisateur'] = $get_infos['grade'];