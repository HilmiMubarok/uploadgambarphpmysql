<?php 
	$username = "root";
	$password = "";
	$server   = "localhost";
	$database = "uploadgambar";

	$koneksi = new mysqli($server, $username, $password, $database);

	// cek error
	if ($koneksi->connect_error) {
		die('Gagal koneksi karena : ' . $koneksi->connect_error);
	}
 ?>