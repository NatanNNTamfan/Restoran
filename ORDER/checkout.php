<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1, h3 {
            text-align: center;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 5px;
        }
        p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        session_start();
        include "../koneksi.php"; // Sambungkan ke database

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Terima data dari formulir pembayaran
            $nama = $_POST['nama'];
            $metode_pembayaran = $_POST['metode_pembayaran'];

            // Hitung total harga dari produk yang ada di keranjang belanja
            $total_harga = 0;
            foreach ($_SESSION['cart'] as $product) {
                $subtotal = $product['harga'] * $product['quantity'];
                $total_harga += $subtotal;
            }

            // Membuat nomor pesanan dengan format P001, P002, dst.
            $nomor_pesanan = 'P' . str_pad($_SESSION['next_order_number'], 3, '0', STR_PAD_LEFT);
            $_SESSION['next_order_number']++; // Tingkatkan nomor pesanan untuk pesanan berikutnya

            // Simpan data pembayaran ke tabel `transaksi` dalam database
            $query = "INSERT INTO transaksi (nomortransaksi, nama, waktutransaksi, metodepembayaran, statuspembayaran, statuspesanan) VALUES (?, ?, NOW(), ?, 'unpaid', 'pending')";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "sss", $nomor_pesanan, $nama, $metode_pembayaran);
            if (mysqli_stmt_execute($stmt)) {
                // Data berhasil disimpan ke tabel `transaksi`
                // Dapatkan ID transaksi yang baru saja dimasukkan
                $id_transaksi = mysqli_insert_id($koneksi);

                // Simpan detail pembelian ke tabel lain jika Anda memiliki tabel untuk detail pembelian
                foreach ($_SESSION['cart'] as $product) {
                    $id_produk = $product['id'];
                    $jumlah = $product['quantity'];

                    // Simpan detail pembelian ke tabel lain sesuai struktur yang Anda miliki
                    // Anda perlu menyesuaikan tabel dan kolom yang sesuai
                    // Misalnya, jika Anda memiliki tabel `detail_transaksi`, Anda dapat menambahkannya di sini
                }

                // Tampilkan struk pembayaran
                echo '<h1>Struk Pembayaran</h1>';
                echo '<p>Nomor Pesanan: ' . $nomor_pesanan . '</p>';
                echo '<p>Nama: ' . $nama . '</p>';
                echo '<p>Metode Pembayaran: ' . $metode_pembayaran . '</p>';
                
                echo '<h3>Detail Pesanan:</h3>';
                echo '<ul>';
                foreach ($_SESSION['cart'] as $product) {
                    echo '<li>' . $product['nama'] . ' - Rp ' . $product['harga'] . ' x ' . $product['quantity'] . '</li>';
                }
                echo '</ul>';

                echo '<p>Total Harga: Rp ' . $total_harga . '</p>';
            } else {
                echo 'Gagal menyimpan data ke database.';
            }
            mysqli_stmt_close($stmt);
        } else {
            echo 'Permintaan tidak valid.';
        }
        ?>
<br>
        <a href="../index.php">kembali</a>
    </div>
</body>
</html>
