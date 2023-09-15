<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Karyawan</title>
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
    <div class="container mt-4">
        <h1>Tambah Data Karyawan</h1>
        <form action="proses_tambah.php" method="post">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="nomor">No HP:</label>
                <input type="number" name="nomor" id="nomor" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <select name="jabatan" id="jabatan" class="form-control">
                    <option value="Manager">Manager</option>
                    <option value="koki">Koki</option>
                    <option value="kasir">Kasir</option>
                    <option value="Pelayan">Pelayan</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                <input type="reset" name="reset" class="btn btn-secondary">
                <a href="lihat_data.php" class="btn btn-danger">Kembali</a>
            </div>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
