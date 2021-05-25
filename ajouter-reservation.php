<?php
// Connexion à la base de données
require_once('db_connect.php');
var_dump($_POST['num_traversee']);
var_dump($_POST['id_utilisateurs']);
var_dump($_POST['1']);
var_dump($_POST['2']);
var_dump($_POST['3']);
var_dump($_POST['4']);
var_dump($_POST['5']);
var_dump($_POST['6']);
var_dump($_POST['7']);
var_dump($_POST['8']);

if (isset($_POST['num_traversee']) && isset($_POST['id_utilisateurs']) && isset($_POST['1']) && isset($_POST['2']) && isset($_POST['3']) && isset($_POST['4']) && isset($_POST['5']) && isset($_POST['6']) && isset($_POST['7']) && isset($_POST['8'])){

	$num_traversee = $_POST['num_traversee'];
	$id_utilisateurs = $_POST['id_utilisateurs'];

	$quantite_Adulte = explode(";", $_POST['1']);
	$quantite_Junior = explode(";", $_POST['2']);
	$quantite_Enfant = explode(";", $_POST['3']);
	$quantite_VoitureInf4m = explode(";", $_POST['4']);
	$quantite_VoitureInf5m = explode(";", $_POST['5']);
	$quantite_Fourgon = explode(";", $_POST['6']);
	$quantite_CampingCar = explode(";", $_POST['7']);
	$quantite_Camion = explode(";", $_POST['8']);
	$prix = $quantite_Adulte[0]*$quantite_Adulte[1]+$quantite_Junior[0]*$quantite_Junior[1]+$quantite_Enfant[0]*$quantite_Enfant[1]+$quantite_VoitureInf4m[0]*$quantite_VoitureInf4m[1]+$quantite_VoitureInf5m[0]*$quantite_VoitureInf5m[1]+$quantite_Fourgon[0]*$quantite_Fourgon[1]+$quantite_CampingCar[0]*$quantite_CampingCar[1]+$quantite_Camion[0]*$quantite_Camion[1];
	$etat = 0;

	// Si l'utilisateur ne rempli pas le formulaire de réservation il est redirigé vers la page liaison
	// Sinon on va chercher le nombre de point de fidelité et si il en a plus de 100 il obtient la remise de 25% sur sa réservation
	if(intval($quantite_Adulte[0]) == 0 && intval($quantite_Junior[0]) == 0 && intval(quantite_Enfant[0]) == 0 && intval($quantite_VoitureInf4m[0]) == 0 && intval($quantite_VoitureInf5m[0]) == 0 && intval($quantite_Fourgon[0]) == 0 && intval($quantite_CampingCar[0]) == 0 && intval($quantite_Camion[0]) == 0){
		header('Location: liaisons.php');
	}else{
		$point = get_bdd()->query("SELECT point_fidelite FROM utilisateurs where id='$id_utilisateurs'")->fetch();
		var_dump($point);
		if($point[0]>=100){
			$reduction = ($prix/4);
			$prix = (($prix/4)*3);
			$nouveauSolde = $point[0]-100;
			$sqlMiseAJourSolde = "UPDATE utilisateurs SET point_fidelite = '$nouveauSolde' WHERE id='$id_utilisateurs'";
			$req1 = get_bdd()->prepare($sqlMiseAJourSolde);
			$req1->execute();
		}else{
			$reduction = 0;
		}
		// On créer la réservation
		$sqlInsertionReservation = "INSERT INTO `reservation` (`num_reservation`, `num_traversee`, `id_utilisateurs`, `quantiteAdulte`, `quantiteJunior`, `quantiteEnfant`, `quantiteVoitureInf4m`, `quantiteVoitureInf5m`, `quantiteFourgon`, `quantiteCampingCar`, `quantiteCamion`, `prix`, `reduction`, `etat`) 
		VALUES (NULL, '$num_traversee', '$id_utilisateurs', '$quantite_Adulte[0]', '$quantite_Junior[0]', '$quantite_Enfant[0]', '$quantite_VoitureInf4m[0]', '$quantite_VoitureInf5m[0]', '$quantite_Fourgon[0]', '$quantite_CampingCar[0]', '$quantite_Camion[0]', '$prix', '$reduction', '$etat'); ";
		$req2 = get_bdd()->prepare($sqlInsertionReservation);
		$req2->execute();

		//Différence entre deux dates (Si il y a plus de 60 jours, l'utilisateurs obtient 25 points)

		$dateTraversee = get_bdd()->query("SELECT date FROM traversee where num_traversee='$num_traversee'")->fetch();	
		$date1 = new DateTime('now');

		$date2 = new DateTime($dateTraversee['date']);
		$diff = $date2->diff($date1)->format("%a");

		if($diff>=60){
			$point2 = get_bdd()->query("SELECT point_fidelite FROM utilisateurs where id='$id_utilisateurs'")->fetch();
			$nouveauSolde = $point2[0]+25;
			$sqlMiseAJourSolde2 = "UPDATE utilisateurs SET point_fidelite = '$nouveauSolde' WHERE id='$id_utilisateurs'";
			$req3 = get_bdd()->prepare($sqlMiseAJourSolde2);
			$req3->execute();
	}
	}
}
//header('Location: mes-reservations.php');