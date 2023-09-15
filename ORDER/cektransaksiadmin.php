<?php
session_start();
if (!isset($_SESSION['username'])) {
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
    </div>
    <!-- Hasil semua data pesan akan ditampilkan di sini -->
    <div class="container mt-4">
        <?php
        include "../koneksi.php"; // Sambungkan ke database

        // Mengambil semua data pesan dari tabel
        $query = "SELECT * FROM transaksi";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo '<h1 class="text-center">Semua Data Pesan</h1>';
            echo '<table class="table table-bordered">';
            echo '<tr><th>Nomor Pesanan</th><th>Nama</th><th>Waktu Pemesanan</th><th>Metode Pembayaran</th><th>Status Pembayaran</th><th>Status Pesanan</th></tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['nomortransaksi'] . '</td>';
                echo '<td>' . $row['nama'] . '</td>';
                echo '<td>' . $row['waktutransaksi'] . '</td>';
                echo '<td>' . $row['metodepembayaran'] . '</td>';
                echo '<td><span class="badge ' . ($row['statuspembayaran'] === 'paid' ? 'badge-success' : 'badge-danger') . '">' . $row['statuspembayaran'] . '</span></td>';
                $badge_class = '';
                if ($row['statuspesanan'] === 'ready') {
                    $badge_class = 'badge-success';
                } elseif ($row['statuspesanan'] === 'reject') {
                    $badge_class = 'badge-danger';
                } elseif ($row['statuspesanan'] === 'pending' || $row['statuspesanan'] === '') {
                    $badge_class = 'badge-secondary';
                }
                echo '<td><span class="badge ' . $badge_class . '">' . $row['statuspesanan'] . '</span></td>';
                echo '<td>';
                if ($row['statuspembayaran'] === 'paid') {
                    echo '<span class="badge badge-success">Paid</span>';
                } else {
                    echo '<a href="update_status_pembayaran.php?id=' . $row['nomortransaksi'] . '&status=paid" class="btn btn-success">Mark as Paid</a>';
                }
                echo '</td>';
                echo '<td>';
                if ($row['statuspembayaran'] === 'unpaid') {
                    echo '<span class="badge badge-danger">Unpaid</span>';
                } else {
                    echo '<a href="update_status_pembayaran.php?id=' . $row['nomortransaksi'] . '&status=unpaid" class="btn btn-danger">Mark as Unpaid</a>';
                }
                echo '</td>';
                echo '<td>';
                if ($row['statuspesanan'] === 'ready') {
                    echo '<span class="badge badge-success">Ready</span>';
                } else {
                    echo '<a href="update_status_pesanan.php?id=' . $row['nomortransaksi'] . '&status=ready" class="btn btn-success">Mark as Ready</a>';
                }
                echo '</td>';
                echo '<td>';
                if ($row['statuspesanan'] === 'reject') {
                    echo '<span class="badge badge-danger">Reject</span>';
                } else {
                    echo '<a href="update_status_pesanan.php?id=' . $row['nomortransaksi'] . '&status=reject" class="btn btn-danger">Mark as Reject</a>';
                }
                echo '</td>';
                echo '<td>';
                if ($row['statuspesanan'] === 'pending') {
                    echo '<span class="badge badge-warning">Pending</span>';
                } else {
                    echo '<a href="update_status_pesanan.php?id=' . $row['nomortransaksi'] . '&status=pending" class="btn btn-warning">Mark as Pending</a>';
                }
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'Gagal mengambil data pesan.';
        }
        ?>
    </div>
    <!-- Menggunakan Bootstrap JavaScript (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
