<?php
include "../koneksi.php";
$query = "SELECT * FROM menu"; // Query untuk mengambil data dari tabel menu
$result = mysqli_query($koneksi, $query);
?>
<?php
session_start();

// Check if the 'cart' key exists in the session and if it's an array
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Initialize an empty cart if it doesn't exist
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = '../' . $_POST['product_image'];
    
    // Tambahkan produk ke dalam session keranjang belanja
    $_SESSION['cart'][] = array(
        'id' => $product_id,
        'nama' => $product_name,
        'harga' => $product_price,
        'gambar' => $product_image,
        'quantity' => 1
    );
}

if (!isset($_SESSION['next_order_number'])) {
    $_SESSION['next_order_number'] = 1; // Atur nilai awal sesuai dengan kebutuhan Anda
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
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
    <br>
            <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shopping Cart</h1><br><br>

    <div class="container">

        <?php
        // Cek apakah keranjang belanja kosong atau tidak
        if (empty($_SESSION['cart'])) {
            echo '<div class="alert alert-info">Keranjang belanja kosong.</div>';
        } else {
            echo '<div class="row">';
            foreach ($_SESSION['cart'] as $product) {
                echo '<div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="' . $product['gambar'] . '" class="card-img-top" alt="Gambar Menu">
                            <div class="card-body">
                                <h5 class="card-title">' . $product['nama'] . '</h5>
                                <p class="card-text">Harga: ' . $product['harga'] . '</p>
                                <p class="card-text">Jumlah: ' . $product['quantity'] . '</p>
                                <form method="post" action="prosesupdate.php">
                                    <input type="hidden" name="product_id" value="' . $product['id'] . '">
                                    <div class="form-group">
                                        <label for="quantity">Ubah Jumlah:</label>
                                        <input type="number" class="form-control" name="quantity" id="quantity" value="' . $product['quantity'] . '">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="update_cart">Update</button>
                                    <button type="submit" class="btn btn-danger" name="remove_cart">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>';
            }
            echo '</div>';
        }
        $total = 0;

foreach ($_SESSION['cart'] as $product) {
    $subtotal = $product['harga'] * $product['quantity'];
    $total += $subtotal;
}

echo '<h3>Total Belanja: Rp ' . $total . '</h3>';

        ?>
        <!-- Tambahkan formulir pembayaran sebelum tombol Checkout -->
<form method="POST" action="checkout.php">
    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="form-group">
        <label for="metode_pembayaran">Metode Pembayaran</label>
        <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
            <option value="kartu_kredit">Kartu Kredit</option>
            <option value="cash">Cash</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Checkout</button>
    &nbsp;
   <a href="../index.php" class="btn btn-danger">
        Kembali
    </a>
</form>


    </button>

    </div>
    

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
