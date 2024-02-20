<?php
include('koneksi.php');
$id=$_POST['id'];
$nama	= $_POST['nama'];
$alamat = $_POST['alamat'];
$nomer_telepon = $_POST['nomer'];
$sql 	= "UPDATE pelanggan SET NamaPelanggan='$nama',Alamat = '$alamat', NomorTelepon= '$nomer_telepon' where PelangganID='$id'";;
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil edit data.'); 
			document.location = 'member.php'; 
		</script>";

}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'edit_member.php'; 
		</script>";

}
?>