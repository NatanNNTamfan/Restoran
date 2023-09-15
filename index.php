<?php
include "koneksi.php";
$query = "SELECT * FROM menu"; 
$result = mysqli_query($koneksi, $query);
?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <style>
        .card-img {
            width: 348px;
            height: 196px;
        }
    </style>
	<title></title>
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
                <li class="nav-item active mr-4 ">
                    <a class="nav-link" href="index.php">Menu <span class="sr-only">(current)</span></a>
                </li>
                <?php
                if (isset($_SESSION['username'])) {
                    // Tampillanjika sudah login
                    echo '
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="lihat_data.php">Lihat Data</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="tambah.php">Tambah Data</a>
                    </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="ORDER/cektransaksiadmin.php">Cek Transaksi</a>
                </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="karyawan/lihat_data.php">Karyawan</a>
                </li>
                    <li class="nav-item mr-4">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                
                    ';
                } else {
                    // Tampilan belum login
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

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-6">Selamat Datang di Restauran Binfor !</h1>
    <p class="lead">Pangeran Natanael Napitupulu.</p>
  </div>
</div>
<h1>&nbsp;&nbsp;&nbsp;MENU</h1>
<div class="container mt-5">
    <div class="row">

    <?php
while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="<?php echo $row['gambar']; ?>" class="card-img" alt="Gambar Menu">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                <p class="card-text">
                    <?php
                    // Tipe makanan ditandai dengan badge warning, minuman dengan badge primary
                    $badgeClass = ($row['tipe'] == 'Makanan') ? 'badge badge-warning' : 'badge badge-primary';
                    echo "<span class='$badgeClass'>" . $row['tipe'] . "</span>&nbsp;";
                    
                    // Status tersedia ditandai dengan badge success, tidak tersedia dengan badge danger
                    $statusBadgeClass = ($row['statusmenu'] == 'Tersedia') ? 'badge badge-success' : 'badge badge-danger';
                    echo "<span class='$statusBadgeClass'>" . $row['statusmenu'] . "</span>";
                    ?>
                </p>
                <p class="card-text">Harga: <?php echo $row['harga']; ?></p>
                <p class="card-text"><?php echo $row['deskripsi']; ?></p>
                <?php
                // Cek apakah status menu adalah "Tersedia" atau "Tidak Tersedia"
                if ($row['statusmenu'] == 'Tersedia') {
                    echo '<form method="post" action="ORDER/detail.php">
                            <input type="hidden" name="product_id" value="' . $row['id'] . '">
                            <input type="hidden" name="product_name" value="' . $row['nama'] . '">
                            <input type="hidden" name="product_price" value="' . $row['harga'] . '">
                            <input type="hidden" name="product_image" value="' . $row['gambar'] . '">
                            <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
                          </form>';
                } else {
                    echo '<button class="btn btn-danger" disabled>Out of Stock</button>';
                }
                ?>
            </div>
        </div>
    </div>

<?php
}
?>


                        
                    </div>
                </div>
            </div>

            <?php
        
        ?>

    </div>
</div>


    </div>
</div>


</body>
</html>