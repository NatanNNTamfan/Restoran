<?php
include "koneksi.php";
?>
<?php
session_start();
if(!isset($_SESSION['username'])){
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Menu</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
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
                    // Tampilkan menu ini jika sudah login
                    echo '
                    <li class="nav-item active mr-4">
                        <a class="nav-link" href="lihat_data.php">Lihat Data</a>
                    </li>
                    <li class="nav-item mr-4">
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
                    // Tampilkan menu ini jika belum login
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
<div class="container mt-4">
    <h1>Data Menu</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Menu</th>
                <th>Nama Menu</th>
                <th>Harga Menu</th>
                <th>Tipe Menu</th>
                <th>Status Menu</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM menu";
            $result = mysqli_query($koneksi, $query);

            if (!$result) {
                die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            if (mysqli_num_rows($result) == 0) {
                echo '<tr><td colspan="7">Tidak Ada Data</td></tr>';
            } else {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                        <tr>
                            <td>' . $no++ . '</td>
                            <td>' . $row["id"] . '</td>
                            <td>' . $row["nama"] . '</td>
                            <td>' . number_format($row["harga"], 0, ",", ".") . '</td>
                            <td>' . $row["tipe"] . '</td>
                            <td>' . $row["statusmenu"] . '</td>
                            <td>
                                <a href="edit_data.php?id=' . $row["id"] . '" class="btn btn-warning">Edit</a>
                                <a href="hapus_data.php?id=' . $row["id"] . '" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>';
                }
            }
            ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-primary">Kembali</a>
    <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
</div>

<div class="container mt-5">
    <div class="row">
        <?php
        $result = mysqli_query($koneksi, $query); // Mengambil data ulang

        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="' . $row['gambar'] . '" class="card-img" alt="Gambar Menu">
                        <div class="card-body">
                            <h5 class="card-title">' . $row['nama'] . '</h5>
                            <p class="card-text">
                                <span class="badge badge-' . ($row['tipe'] == 'Makanan' ? 'warning' : 'primary') . '">' . $row['tipe'] . '</span>&nbsp;
                                <span class="badge badge-' . ($row['statusmenu'] == 'Tersedia' ? 'success' : 'danger') . '">' . $row['statusmenu'] . '</span>
                            </p>
                            <p class="card-text">Rp. ' . number_format($row['harga'], 0, ",", ".") . '</p>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>
</div>

</body>
</html>
