<?php
include "../koneksi.php"; // Sambungkan ke database

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $newStatus = $_GET['status'];

    // Lakukan validasi terhadap nilai $newStatus di sini
    // Pastikan hanya 'paid' atau 'unpaid' yang diterima

    // Perbarui status pembayaran dalam database
    $query = "UPDATE transaksi SET statuspembayaran = '$newStatus' WHERE nomortransaksi = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect kembali ke halaman utama atau tampilkan pesan sukses
        header("Location: cektransaksiadmin.php");
        exit();
    } else {
        echo 'Gagal memperbarui status pembayaran.';
    }
} else {
    echo 'Parameter tidak valid.';
}
?>
