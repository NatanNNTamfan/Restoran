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
    <title>Edit Menu</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <?php
            if(isset($_GET['id'])){
                include "koneksi.php";

                $id = $_GET['id']; // id menu

                $query_cek = "SELECT * FROM menu WHERE id=".$id;
                $result_cek = mysqli_query($koneksi,$query_cek);

                //cek error
                if(!$result_cek){
                    die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                } else {
                    if(mysqli_num_rows($result_cek) == 0){
                        echo "Data tidak tersedia";
                    } else {
                        $data = mysqli_fetch_array($result_cek);
        ?>
                        <form action="proses_edit.php" method="post">
                            <div class="form-group">
                                <label for="id">ID Menu:</label>
                                <input type="text" class="form-control" name="id" value="<?= $data['id'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" name="nama" value="<?= $data['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <input type="number" class="form-control" name="harga" value="<?= $data['harga']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tipe">Tipe Menu:</label>
                                <select class="form-control" name="tipe" id="tipe">
                                    <option value="Makanan" <?= ($data['tipe'] == 'Makanan') ? 'selected' : ''; ?>>Makanan</option>
                                    <option value="Minuman" <?= ($data['tipe'] == 'Minuman') ? 'selected' : ''; ?>>Minuman</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="statusmenu">Status Menu:</label>
                                <select class="form-control" name="statusmenu" id="statusmenu">
                                    <option value="Tersedia" <?= ($data['statusmenu'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                                    <option value="Tidak Tersedia" <?= ($data['statusmenu'] == 'Tidak Tersedia') ? 'selected' : ''; ?>>Tidak Tersedia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                <a href="lihat_data.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
        <?php
                    }
                }
            } else {
                echo 'Tidak dapat menampilkan form edit menu <a href="lihat_data.php" class="btn btn-secondary">Klik disini</a> untuk kembali';
            }
        ?>
    </div>

</body>
</html>
