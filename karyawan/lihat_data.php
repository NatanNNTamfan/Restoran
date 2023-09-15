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
    <title>Daftar Karyawan</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
                    <a class="nav-link" href="../index.php">Menu <span class="sr-only">(current)</span></a>
                </li>
                <?php
                if (isset($_SESSION['username'])) {
                    // Tampilan setelah login
                    echo '
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="lihat_data.php">Lihat Data</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="tambah.php">Tambah Data</a>
                    </li>
                    <li class="nav-item active mr-4">
                    <a class="nav-link" href="../ORDER/cektransaksiadmin.php">Cek Transaksi</a>
                </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="lihat_data.php">Karyawan</a>
                </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
                
                    ';
                } else {
                    // Tampilan sebelum login
                    echo '
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="cektransaksi.php">Cek Status Order</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="detail.php">Cart</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="../login.php">Login</a>
                    </li>
                    ';
                }
                ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <a href="../index.php" class="btn btn-secondary mb-2">Kembali</a>
        <a href="tambah.php" class="btn btn-primary mb-2">Tambah Menu</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Jabatan</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM karyawan";
                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    }

                    if (mysqli_num_rows($result) == 0) {
                        echo '
                            <tr>
                                <td colspan="9"><center>Tidak Ada Data</center></td>
                            </tr>';
                    } else {
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <tr>
                                    <td>' . $no++ . '</td>
                                    <td>' . $row["id"] . '</td>
                                    <td>' . $row["nama"] . '</td>
                                    <td>' . $row["alamat"] . '</td>
                                    <td>' . $row["nomor"] . '</td>
                                    <td>' . $row["email"] . '</td>
                                    <td>' . $row["gender"] . '</td>
                                    <td>' . $row["jabatan"] . '</td>
                                    <td>
                                        <a href="edit_data.php?id=' . $row["id"] . '" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="hapus_data.php?id=' . $row["id"] . '" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
