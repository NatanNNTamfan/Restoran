<?php
session_start();

if (isset($_POST['update_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Cari produk dalam session keranjang belanja berdasarkan ID
    foreach ($_SESSION['cart'] as &$product) {
        if ($product['id'] == $product_id) {
            // Update jumlah produk
            $product['quantity'] = $quantity;
            break;
        }
    }
} elseif (isset($_POST['remove_cart'])) {
    $product_id = $_POST['product_id'];

    // Hapus produk dari session keranjang belanja berdasarkan ID
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

// Redirect kembali ke halaman keranjang belanja
header('Location: detail.php');
exit;
?>
