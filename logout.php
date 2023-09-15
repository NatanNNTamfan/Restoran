<?php
session_start();

// Hapus semua data sesi
session_destroy();

header("location: login.php");
?>
