<?php
include('koneksi.php');
$nama	= $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$sql 	= "INSERT INTO user (nama,username, password,level) VALUES ('$nama','$username','$password','pegawai')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'petugas.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
		document.location = 'petugas.php'; 
		</script>";

}
?>