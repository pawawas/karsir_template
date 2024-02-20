<?php
include('koneksi.php');
$nama	= $_POST['nama'];
$alamat = $_POST['alamat'];
$nomer_telepon = $_POST['nomer'];
$sql 	= "INSERT INTO pelanggan (NamaPelanggan, Alamat, NomorTelepon) VALUES ('$nama','$alamat','$nomer_telepon')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'member.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'member.php'; 
		</script>";

}
?>