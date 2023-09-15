<?php
if (isset($_POST['nama'])) {
    include "koneksi.php";

    $nama_karyawan = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat_karyawan  = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $nomor_karyawan = mysqli_real_escape_string($koneksi, $_POST['nomor']);
    $email_karyawan = mysqli_real_escape_string($koneksi, $_POST['email']);
    $gender_karyawan = mysqli_real_escape_string($koneksi, $_POST['gender']);
    $jabatan_karyawan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);

    $query = "INSERT INTO karyawan(nama, alamat, nomor, email, gender, jabatan) VALUES('" . $nama_karyawan . "', '" . $alamat_karyawan . "', 
        '" . $nomor_karyawan . "', '" . $email_karyawan . "', '" . $gender_karyawan . "', '" . $jabatan_karyawan . "')";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        header("Location: lihat_data.php");
    }
} else {
    echo "Form tambah menu harus di isi";
}
?>
