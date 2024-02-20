<?php
include('koneksi.php');
$produk	= $_POST['produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$sql 	= "INSERT INTO produk (NamaProduk, Harga, Stok) VALUES ('$produk','$harga','$stok')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'produk.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'produk.php'; 
		</script>";

}
?>