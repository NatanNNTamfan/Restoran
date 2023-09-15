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
    <title>Edit Data Karyawan</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                    // Tampilan jika sudah login
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
                    // Tampilkan jika belum login
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
    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            include "koneksi.php";

            $id = $_GET['id']; // id karyawan

            $query_cek = "SELECT * FROM karyawan WHERE id=" . $id;
            $result_cek = mysqli_query($koneksi, $query_cek);

            // cek eror
            if (!$result_cek) {
                die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            } else {
                // jika query tidak ada yang error
                if (mysqli_num_rows($result_cek) == 0) {
                    echo "Data tidak tersedia";
                } else {
                    $data = mysqli_fetch_array($result_cek);
        ?>
                    <form action="proses_edit.php" method="post">
                        <div class="form-group">
                            <label for="id">ID Karyawan:</label>
                            <input type="text" class="form-control" name="id" value="<?= $data['id'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" name="nama" value="<?= $data['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea class="form-control" name="alamat"><?= $data['alamat']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nomor">No HP:</label>
                            <input type="number" class="form-control" name="nomor" value="<?= $data['nomor']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" value="<?= $data['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="Pria" <?= ($data['gender'] == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                                <option value="Wanita" <?= ($data['gender'] == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan:</label>
                            <select class="form-control" name="jabatan" id="jabatan">
                                <option value="Manager" <?= ($data['jabatan'] == 'Manager') ? 'selected' : ''; ?>>Manager</option>
                                <option value="koki" <?= ($data['jabatan'] == 'koki') ? 'selected' : ''; ?>>Koki</option>
                                <option value="kasir" <?= ($data['jabatan'] == 'kasir') ? 'selected' : ''; ?>>Kasir</option>
                                <option value="Pelayan" <?= ($data['jabatan'] == 'Pelayan') ? 'selected' : ''; ?>>Pelayan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                            <a class="btn btn-secondary" href="lihat_data.php">Kembali</a>
                        </div>
                    </form>
        <?php
                }
            }
        } else {
            echo 'Tidak dapat menampilkan form edit karyawan <a href="lihat_data.php">klik disini</a> untuk kembali';
        }
        ?>
    </div>
    </body>

</html>
