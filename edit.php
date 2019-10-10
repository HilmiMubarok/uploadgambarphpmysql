<?php 
include 'config.php';

$id    = $_GET['id'];
$query = "SELECT * FROM gambar WHERE id = '$id' ";
$tampil_data = $koneksi->query($query);
$hasil = $tampil_data->fetch_assoc();


?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div class="container">
	<h1>Edit gambar</h1>
	<form method="post" enctype="multipart/form-data">
		<form method="post" enctype="multipart/form-data">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Nama</label>
					<div class="col-sm-10">
						<input type="text" name="nama" class="form-control" value="<?php echo $hasil['nama']; ?>">
					</div>
				</div>

				<img src="gambar/<?php echo $hasil['gambar']; ?>" width="100">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Gambar</label>
					<div class="col-sm-10">
						<div class="custom-file">
							<input type="file" name="gambar" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
							<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
						</div>
					</div>
				</div>
				<input type="submit" name="btnsubmit" value="Simpan" class="btn btn-primary">
			</form>
	</form>
</div>
	
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php 
	session_start();
	if (isset($_POST['btnsubmit'])) {
		$nama   = $_POST['nama']; 
		$gambar = $_FILES['gambar']['name'];
		$dir    = $_FILES['gambar']['tmp_name'];

		if (empty($gambar)) {
			$query = "UPDATE gambar SET nama = '$nama' WHERE id = '$id' ";
			if ($koneksi->query($query)) {
				$_SESSION["pesan"]  = "sukses menyimpan data";
				$_SESSION["result"] = "sukses";
			} else {
				$_SESSION["pesan"]  = "Gagal menyimpan data dengan pesan error : " . $koneksi->error;
				$_SESSION["result"] = "gagal,silahkan coba lagi";
			}
			header("location:index.php");
		} else {
			$query = "UPDATE gambar SET nama = '$nama', gambar = '$gambar' WHERE id = '$id' ";
			if ($koneksi->query($query)) {
				$_SESSION["pesan"]  = "sukses menyimpan data";
				$_SESSION["result"] = "sukses";
			} else {
				$_SESSION["pesan"]  = "Gagal menyimpan data dengan pesan error : " . $koneksi->error;
				$_SESSION["result"] = "gagal, silahkan coba lagi";
			}
			move_uploaded_file($dir, "gambar/".$gambar);
			header("location:index.php");
		}
	}
?>