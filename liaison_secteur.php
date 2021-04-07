<?php

	$conn = mysqli_connect("localhost","root","","marieteam") or die("Connection failed");

	if($_POST['type'] == ""){
		$sql = "SELECT * FROM secteur";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['id_secteur']}'>{$row['nom']}</option>";
		}
	}else if($_POST['type'] == "stateData"){

		$sql = "SELECT * FROM liaison WHERE id_secteur = {$_POST['id']}";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['id']}'>{$row['nom']}</option>";
		}
	}

	echo $str;
 ?>
