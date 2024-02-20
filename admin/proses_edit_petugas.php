<?php
include('koneksi.php');
$id = $_POST['id'];
$nama	= $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$sql 	= "UPDATE user SET nama='$nama',username = '$username',password= '$password' where id='$id'";;
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil edit data.'); 
			document.location = 'petugas.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'edit_petugas.php'; 
		</script>";

}
?>