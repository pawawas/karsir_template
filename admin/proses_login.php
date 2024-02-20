<?php
session_start();
include('koneksi.php');
$nama=$_POST['username'];
$password=md5($_POST['password']);
$sql = "SELECT * FROM user WHERE username='$nama' AND password='$password'";
$query = mysqli_query($koneksidb,$sql);
$results = mysqli_fetch_array($query);
if(mysqli_num_rows($query)>0){
	if ($results['level']=="pegawai") {
		$_SESSION['alogin']=$_POST['username'];
	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
	}elseif ($results['level']=="admin") {
		$_SESSION['alogin']=$_POST['username'];
	echo "<script type='text/javascript'> document.location = 'admin/index.php'; </script>";
	}else{
		echo "<script>alert('Data Login Tidak Valid');</script>";
        echo "<script type='text/javascript'> document.location = 'login.php'; </script>";

	}
	
} else{
	echo "<script>alert('Data Login Tidak Valid');</script>";
    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";

}