<?php
// Connexion à la base de données
require_once('db_connect.php');
if (isset($_POST['num_traversee']) && isset($_POST['id_utilisateurs']) && isset($_POST['1']) && isset($_POST['2']) && isset($_POST['3']) && isset($_POST['4']) && isset($_POST['5']) && isset($_POST['6']) && isset($_POST['7']) && isset($_POST['8'])){

	$num_traversee = $_POST['num_traversee'];
	$id_utilisateurs = $_POST['id_utilisateurs'];
	$quantiteAdulte = $_POST['1'];
	$quantiteJunior = $_POST['2'];
	$quantiteEnfant = $_POST['3'];
	$quantiteVoitureInf4m = $_POST['4'];
	$quantiteVoitureInf5m = $_POST['5'];
	$quantiteFourgon = $_POST['6'];
	$quantiteCampingCar = $_POST['7'];
	$quantiteCamion = $_POST['8'];
	$etat = 0;
	$prix = 0;


	$sql = "INSERT INTO reservation(num_reservation, num_traversee, id_utilisateurs, quantiteAdulte, quantiteJunior, quantiteEnfant, quantiteVoitureInf4m, quantiteVoitureInf5m, quantiteFourgon, quantiteCampingCar, quantiteCamion, prix, etat)
	 values (NULL, '$num_traversee', '$id_utilisateurs', '$quantiteAdulte', '$quantiteJunior', '$quantiteEnfant', '$quantiteVoitureInf4m', '$quantiteVoitureInf5m', '$quantiteFourgon', '$quantiteCampingCar', '$quantiteCamion', '$prix' '$etat')";
	$req = get_bdd()->prepare($sql);
	$req->execute();

}

header('Location: mes-reservations.php');