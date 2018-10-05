<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload gambar</title>
</head>
<body>

	<h1>upload gambar</h1>
	<form method="post" enctype="multipart/form-data">
		Nama : <input type="text" name="nama"> <br>
		Gambar : <input type="file" name="gambar"> <br>
		<input type="submit" name="btnsubmit" value="Simpan">
	</form>
	<?php
		if (isset($_POST['btnsubmit'])) {
			$nama   = $_POST['nama']; 
			$gambar = $_FILES['gambar']['name'];
			$dir    = $_FILES['gambar']['tmp_name'];

			$query = "INSERT INTO gambar VALUES ('', '$nama', '$gambar') ";
			$koneksi->query($sql);
			if (move_uploaded_file($dir, "gambar/".$gambar)) {
				echo "Sukses Uplaod Gambar";
			} else {
				echo "Gagal Upload Gambar";
			}
			
		}
		$query = "SELECT * FROM gambar";
		$tampil = $koneksi->query($query);
		while ($has = $tampil->fetch_assoc()) { ?>
		<p><?php echo $has['nama']; ?></p>
 		<img src="gambar/<?php echo $has['gambar']; ?>" width="100" style="float: left;">
 		<a href="edit.php?id=<?php echo $has['id']; ?>">Edit</a>
	<?php } ?>
</body>
</html>