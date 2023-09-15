<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>
<body>
<?php
session_start();
if(!isset($_SESSION['username'])){
	header("location:login.php");
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand mr-4" href="#">Resto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4 ">
                    <a class="nav-link" href="index.php">Menu </a>
                </li>
                <?php
                if (isset($_SESSION['username'])) {
                    // Tampilkan menu ika sudah login
                    echo '
                    <li class="nav-item  mr-4">
                        <a class="nav-link" href="lihat_data.php">Lihat Data</a>
                    </li>
                    <li class="nav-item active mr-4">
                        <a class="nav-link" href="tambah.php">Tambah Data</a>
                    </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="karyawan/lihat_data.php">Karyawan</a>
                </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                
                    ';
                } else {
                    // Tampilan menu jika belum login
                    echo '
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="ORDER/cektransaksi.php">Cek Status Order</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="ORDER/detail.php">Cart</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    ';
                }
                ?>
            </ul>
        </div>
    </nav>
	<div class="container mt-5">
	<form action="proses_tambah.php" method="post" enctype="multipart/form-data">
		<div class="form-group">
	<p>
	Nama: <input type="text" name="nama" class="form-control" placeholder="Masukkan nama makanan atau minuman disini!">
	</p>
</div>
<div>
	<p>
	Harga: <input type="number" name="harga" class="form-control" placeholder="Masukkan harga menu!">
	</p>
</div>
<div class="form-group">	
<p>
	<label for="tipe">Tipe Menu :</label>
            <select name="tipe" id="tipe" class="form-control">
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
            </select>
	</p>
</div>
<div class="form-group">
	<p>
	<label for="statusmenu">Status Menu :</label>
            <select name="statusmenu" id="statusmenu" class="form-control">
                <option value="Tersedia">Tersedia</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>	</p>

			<label>Upload gambar :</label>
			<div class="input-group mb-3">
  <div class="custom-file">
    <input type="file" name="berkas" class="custom-file-input" id="inputGroupFile02">
    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
  </div>
</div>

		<p>
			<input type="submit" name="submit" value="Tambah" class="btn btn-success">
			<input type="reset" name="reset" class="btn btn-warning">
			<a href="lihat_data.php"><button type="button" class="btn btn-primary">Kembali</button></a>
		</p>
	</form>
</div>
</body>
</html>