<?php
include('koneksi.php');
session_start();

$tanggal = date('Y-m-d');
$total = $_POST['total'];
$pelanggan = $_POST['pelanggan'];


mysqli_query($koneksidb, "insert into penjualan (
    PenjualanID,TanggalPenjualan,TotalHarga,PelangganID) values (NULL, '$tanggal','$total',
    '$pelanggan')");


    $id_transaksi = mysqli_insert_id($koneksidb);

    foreach ($_SESSION['cart'] as $key => $value) {
        $id_barang = $value['ProdukID'];
        $harga = $value['Harga'];
        $jumlah = $value['JumlahProduk'];
        $tot = $harga*$jumlah;

        mysqli_query($koneksidb, "insert into detailpenjualan (
            DetailID, PenjualanID,ProdukID,JumlahProduk,Subtotal) values (NULL, '$id_transaksi', '$id_barang', 
            '$jumlah', '$tot')");
            $sql = "SELECT * from  produk where ProdukID = '$id_barang' ";
                $query = mysqli_query($koneksidb, $sql);
                $result = mysqli_fetch_array($query);
            $stok = $result['Stok']-$jumlah;
            
            mysqli_query($koneksidb,  "update produk set stok = '$stok' where ProdukID = $id_barang");
        # code...
    }
    $_SESSION['cart'] = [];
    echo "<script type='text/javascript'>
    alert('Transaksi Berhasil.'); 
    document.location = 'transaksi.php';
    </script>";

?>