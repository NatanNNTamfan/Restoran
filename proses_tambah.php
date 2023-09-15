<?php
// di cek apakah ada data post dengan nama index nya "nama"
if(isset($_POST['nama'])){
    include "koneksi.php";

    $nama_menu    = $_POST['nama'];
    $harga_menu   = $_POST['harga'];
    $tipe_menu    = $_POST['tipe'];
    $status_menu  = $_POST['statusmenu'];

    // ambil data file
    $namaFile = $_FILES['berkas']['name'];
    $namaSementara = $_FILES['berkas']['tmp_name'];

    // tentukan lokasi file akan dipindahkan
    $dirUpload = "fotocard/";

    // pindahkan file
    $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

    if ($terupload) {
        // jika sudah berhasil, lakukan insert data ke dalam database (yang di insert nama berkas nya saja)
        $path_file = $dirUpload.$namaFile;
        $query = "INSERT INTO menu(nama, harga, tipe, statusmenu, gambar) VALUES('" . $nama_menu . "', '" . $harga_menu . "', 
        '" . $tipe_menu . "', '" . $status_menu . "', '" . $path_file . "')";
        $result = mysqli_query($koneksi, $query);

        // mengecek apakah ada error ketika menjalankan query
        if(!$result){
            die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        } else {
            // apabila tambah data berhasil, maka redirect ke halaman lihat_data.php
            header("Location:lihat_data.php");
        }
    } else {
        echo "Upload Gagal!";
    }
} else {
    echo "Form tambah menu harus di isi";
}
?>
