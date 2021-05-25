<?php
    require_once('db_connect.php');
	$conn = mysqli_connect("localhost","root","","marieteam") or die("Connection failed");

	if($_POST['type'] == ""){
		$sql = "SELECT * FROM secteur ORDER BY nom ASC";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['id_secteur']}'>{$row['nom']}</option>";
		}
	}else if($_POST['type'] == "liaisonData"){

		$sql = "SELECT * FROM liaison WHERE id_secteur = {$_POST['id']} ORDER BY nom ASC";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['code_liaison']}'>{$row['nom']}</option>";
		}
	}
	echo $str;
?>
