<?php 
include 'config.php';

$id    = $_GET['id'];
$query = mysql_query("SELECT * FROM gambar WHERE id = '$id' ");
$hasil = mysql_fetch_array($query);


?>
<h1>Edit gambar</h1>
<form method="post" enctype="multipart/form-data">
	Nama : <input type="text" name="nama" value="<?php echo $hasil['nama']; ?>"> <br>
	<img src="gambar/<?php echo $hasil['gambar']; ?>" width="100">
	Gambar : <input type="file" name="gambar"> <br>
	<input type="submit" name="btnsubmit" value="Simpan">
</form>
<?php 

if (isset($_POST['btnsubmit'])) {
	$nama   = $_POST['nama']; 
	$gambar = $_FILES['gambar']['name'];
	$dir    = $_FILES['gambar']['tmp_name'];

	if (empty($gambar)) {
		mysql_query("UPDATE gambar SET nama = '$nama' WHERE id = '$id' ");
		header("location:index.php");
	} else {
		mysql_query("UPDATE gambar SET nama = '$nama', gambar = '$gambar' WHERE id = '$id' ");
		move_uploaded_file($dir, "gambar/".$gambar);
		header("location:index.php");
	}
}



 ?>