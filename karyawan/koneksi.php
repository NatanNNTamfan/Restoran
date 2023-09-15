<?php
  $host = "localhost";  // alamat server
  $user = "root"; // username database
  $pass = ""; // password database
  $nama_db = "restoran"; //nama database
  
  $koneksi = mysqli_connect($host,$user,$pass,$nama_db); //pastikan urutan nya seperti ini, jangan tertukar

  if(!$koneksi){ //jika tidak terkoneksi maka akan tampil error
    die ("Koneksi dengan database gagal: ".mysql_connect_error());
  }
?>