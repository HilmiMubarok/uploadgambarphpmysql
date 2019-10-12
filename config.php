<?php 
	$username = "root";
	$password = "";
	$server   = "localhost";
	$database = "uploadgambar";

	$conn = new mysqli($server, $username, $password, $database);

	// cek error
	if ($conn->connect_error) {
		die('Gagal Koneksi Karena : ' . $conn->connect_error);
	}
 ?>