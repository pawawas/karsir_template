<?php
include('koneksi.php');
session_start();



if(isset($_POST['produk'])){
    $id_produk = $_POST['produk'];
    $jumlah = $_POST['JumlahProduk'];

    $data = mysqli_query($koneksidb, "SELECT * FROM produk WHERE ProdukID = '$id_produk'");
    $b = mysqli_fetch_assoc($data);

     $barang = [
        'ProdukID' => $b['ProdukID'],
        'NamaProduk' => $b['NamaProduk'],
        'Harga' => $b['Harga'],
        'JumlahProduk' => $jumlah
    ];

    $_SESSION['cart'][]=$barang;
    header('location:transaksi.php');
}


  
?>  