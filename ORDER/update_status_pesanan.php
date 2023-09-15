<?php
include "../koneksi.php"; // Sambungkan ke database

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $newStatus = $_GET['status'];

    // Lakukan validasi terhadap nilai $newStatus di sini
    // Pastikan hanya 'ready', 'reject', atau 'pending' yang diterima

    // Perbarui status pesanan dalam database
    $query = "UPDATE transaksi SET statuspesanan = '$newStatus' WHERE nomortransaksi = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect kembali ke halaman utama atau tampilkan pesan sukses
        header("Location: cektransaksiadmin.php");
        exit();
    } else {
        echo 'Gagal memperbarui status pesanan.';
    }
} else {
    echo 'Parameter tidak valid.';
}
?>
