<?php
	include "koneksi.php";



	$query = "DELETE FROM karyawan WHERE id=".$_GET['id'];
	$result = mysqli_query($koneksi, $query);

	if(!$result){
		die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
	}else{
		header("Location:lihat_data.php");
	}

?>