<?php
// Connexion à la base de données
require_once('db_connect.php');

if (isset($_POST['num_traversee']) && isset($_POST['id_utilisateurs']) && isset($_POST['quantite'])){
	
	$num_traversee = $_POST['num_traversee'];
	$id_utilisateurs = $_POST['id_utilisateurs'];
	$quantite = $_POST['quantite'];

	$sql = "INSERT INTO reservation(num_reservation, num_traversee, id_utilisateurs, quantite) values (NULL, '$num_traversee', '$id_utilisateurs', '$quantite')";
	$req = get_bdd()->prepare($sql);
	$req->execute();

}

header('Location: mes-reservations.php');