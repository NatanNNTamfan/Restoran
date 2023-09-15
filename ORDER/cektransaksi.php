<?php
session_start();
if(isset($_SESSION['username'])){
    header("location:cektransaksiadmin.php");
    exit(); // Add this to stop further execution
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Order</title>
    <!-- Menggunakan Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                    // Tampilkan menu ini jika sudah login
                    echo '
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="../lihat_data.php">Lihat Data</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="../tambah.php">Tambah Data</a>
                    </li>
                    <li class="nav-item active mr-4">
                    <a class="nav-link" href="cektransaksiadmin.php">Cek Transaksi</a>
                </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="../karyawan/lihat_data.php">Karyawan</a>
                </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
                
                    ';
                } else {
                    // Tampilkan menu ini jika belum login
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
        <h1 class="text-center">Cek Status Order</h1>
        <form action="" method="POST" class="form-inline justify-content-center mt-3">
            <div class="form-group">
                <label for="nomor_transaksi" class="mr-2">Nomor Transaksi:</label>
                <input type="text" name="nomor_transaksi" id="nomor_transaksi" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary ml-2">Cari</button>
        </form>
    </div>
    <!-- Hasil pencarian akan ditampilkan di sini -->
    <div class="container mt-4">
        <?php
        include "../koneksi.php"; // Sambungkan ke database

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomor_transaksi = $_POST['nomor_transaksi'];

            // Cari data transaksi berdasarkan nomor transaksi
            $query = "SELECT * FROM transaksi WHERE nomortransaksi = ?";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "s", $nomor_transaksi);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                if ($row) {
                    // Menampilkan informasi transaksi dalam tabel Bootstrap
                    echo '<h1 class="text-center">Informasi Status Order</h1>';
                    echo '<table class="table table-bordered">';
                    echo '<tr><th>Nomor Pesanan</th><th>Nama</th><th>Waktu Pemesanan</th><th>Metode Pembayaran</th><th>Status Pesanan</th></tr>';
                    echo '<tr>';
                    echo '<td>' . $row['nomortransaksi'] . '</td>';
                    echo '<td>' . $row['nama'] . '</td>';
                    echo '<td>' . $row['waktutransaksi'] . '</td>';
                    echo '<td>' . $row['metodepembayaran'] . '</td>';
                    $badge_class = '';
                    if ($row['statuspesanan'] === 'ready') {
                        $badge_class = 'badge-success';
                    } elseif ($row['statuspesanan'] === 'reject') {
                        $badge_class = 'badge-danger';
                    } elseif ($row['statuspesanan'] === 'pending' || $row['statuspesanan'] === '') {
                        $badge_class = 'badge-secondary';
                    }
                    
                    echo '<td><span class="badge ' . $badge_class . '">' . $row['statuspesanan'] . '</span></td>';                    echo '</tr>';
                    echo '</table>';
                } else {
                    echo '<p class="text-center">Nomor Transaksi tidak ditemukan.</p>';
                }
            } else {
                echo 'Gagal menjalankan pencarian.';
            }
            mysqli_stmt_close($stmt);
        } else {
            echo 'Silakan masukkan nomor transaksi untuk mencari informasi pesanan.';
        }
        ?>
    </div>
    <!-- Menggunakan Bootstrap JavaScript (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
