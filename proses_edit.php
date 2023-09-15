<?php

	if(isset($_POST['id'])){
		include "koneksi.php";

		$id_menu		= $_POST['id'];
		$nama_menu 		= $_POST['nama'];
		$harga_menu 	= $_POST['harga'];
		$tipe_menu 		= $_POST['tipe'];
		$status_menu 	= $_POST['statusmenu'];

		

		$query = "UPDATE menu SET nama='".$nama_menu."', harga='".$harga_menu."', tipe='".$tipe_menu."', statusmenu='".$status_menu."' WHERE id=".$id_menu;
		$result = mysqli_query($koneksi, $query);

		//cek errorr
		if(!$result){
			die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
		}else{
			header("Location:lihat_data.php"); 
		}

	}else{
		echo "form edit menu harus di isi";
	}	

?>