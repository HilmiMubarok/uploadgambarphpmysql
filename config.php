<?php 
	$username = "root";
	$password = "";
	$server   = "localhost";
	$database = "uploadgambar";

	$conn = new mysqli($server, $username, $password, $database);

	// cek error
	if ($conn->connect_error) {
		die('Gagal koneksi karena : ' . $conn->connect_error);
	}
 ?>