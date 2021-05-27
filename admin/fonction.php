<?php 

function getNomPort($id){
    $sql = get_bdd()->prepare("SELECT nom FROM port WHERE id_port ='$id'");
    $sql->execute();
    $get_infos = $sql->fetch();
    return $get_infos['nom'];
}
function date_outil($date,$nombre_jour) {
 
    $year = substr($date, 0, -6);   
    $month = substr($date, -5, -3);   
    $day = substr($date, -2);   
 
    // récupère la date du jour
    $date_string = mktime(0,0,0,$month,$day,$year);
 
    // Supprime les jours
    $timestamp = $date_string - ($nombre_jour * 86400);
    $nouvelle_date = date("Y-m-d", $timestamp); 
 
    // pour afficher
   return $nouvelle_date;
 
    }
?>
