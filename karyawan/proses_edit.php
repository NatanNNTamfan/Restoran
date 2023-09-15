<?php

	if(isset($_POST['id'])){
		include "koneksi.php";

		$id_karyawan        = $_POST['id'];
		$nama_karyawan      = $_POST['nama'];
        $alamat_karyawan    = $_POST['alamat'];
        $nomor_karyawan    = $_POST['nomor'];
        $email_karyawan     = $_POST['email'];
        $gender_karyawan    = $_POST['gender'];
        $jabatan_karyawan   = $_POST['jabatan'];

		$query = "UPDATE karyawan SET nama='".$nama_karyawan."', alamat='".$alamat_karyawan."', nomor='".$nomor_karyawan."',
		email='".$email_karyawan."', gender='".$gender_karyawan."', jabatan='".$jabatan_karyawan."' WHERE id=".$id_karyawan;
		$result = mysqli_query($koneksi, $query);

		//mengecek apakah ada error ketika menjalankan query
		if(!$result){
			die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
		}else{
			header("Location:lihat_data.php"); 
		}

	}else{
		echo "form edit menu harus di isi";
	}	

?>