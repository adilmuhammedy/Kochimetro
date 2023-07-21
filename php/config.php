<?php

	$servername = 'localhost:3307';
	$user = 'root';
	$pass = '';
	$dbname = 'metro';

	$conn = mysqli_connect($servername,$user,$pass,$dbname);

	if(!$conn){
		die("Could Not Connect to the database".mysqli_connect_error());
	}

?>