<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload gambar Php mysql</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

	<?php
	// start session
		session_start();

		// jika ada session result dan pesan ter set
		if (isset($_SESSION['result']) && isset($_SESSION['pesan'])) {
			$hasil = $_SESSION['result'];
			if ($hasil == "sukses") {
				echo "<script>
				swal({
					title : 'Berhasil !',
					text  : '".$_SESSION['pesan']."',
					icon  : 'success',
					button: false,
					timer : 3000
					})
				</script>";
			} else {
				echo "<script>
				swal({
					title : 'Gagal !',
					text  : '".$_SESSION['pesan']."',
					icon  : 'error',
					button: false,
					timer : 3000
					})
				</script>";
			}

			// unset session
			session_unset();	
		} 	
	?>

	<div class="container">
		<h1>Upload Gambar menggunakan php mysql</h1>
		<br>
		<h3>Silahkan Pilih Gambar</h3>
		<form method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Gambar</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Gambar</label>
				<div class="col-sm-10">
					<div class="custom-file">
						<input type="file" name="gambar" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
						<label class="custom-file-label" for="inputGroupFile01">Pilih Gambar</label>
					</div>
				</div>
			</div>
			<input type="submit" name="btnsubmit" value="Simpan" class="btn btn-primary">
		</form>
		<br><br>
		<div class="row">
		<?php
			if (isset($_POST['btnsubmit'])) {
				$nama   = $_POST['nama']; 
				$gambar = $_FILES['gambar']['name'];
				$dir    = $_FILES['gambar']['tmp_name'];

				$query = "INSERT INTO gambar VALUES ('', '$nama', '$gambar') ";
				$conn->query($query);
				if (move_uploaded_file($dir, "gambar/".$gambar)) {
					echo "<script>
					swal({
						title : 'Berhasil !',
						text  : 'Berhasil mengunggah gambar',
						icon  : 'success',
						button: false,
						timer : 3000
						})
					</script>";
				} else {
					echo "<script>
					swal({
						title : 'Gagal !',
						text  : 'Gagal mengunggah gambar',
						icon  : 'error',
						button: false,
						timer : 3000
						})
					</script>";
				}
				
			}
			$query = "SELECT * FROM gambar";
			$tampil = $koneksi->query($query);
			while ($has = $tampil->fetch_assoc()) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="card">
					  <img class="img-thumbnail" src="gambar/<?php echo $has['gambar']; ?>" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title"><?php echo $has['nama']; ?></h5>
					    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
					    <a href="edit.php?id=<?php echo $has['id']; ?>" class="btn btn-primary">Edit</a>
					  </div>
					</div>	
				</div>
		<?php } ?>
			</div>
	</div>

		
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>