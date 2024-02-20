<?php
include('koneksi.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#">KASIR</a>
				
                <body>
  <section id="header-kop">
    <div class="container-fluid">
      <table class="table table-borderless">
        <tbody>
          <tr>
            <td rowspan="3" width="16%" class="text-center">

            </td>
            <td class="text-center">
              <h2>KASIR</h2>
            </td>
            <td rowspan="3" width="16%">&nbsp;</td>
          </tr>
          <tr>
            <td class="text-center">Jl.Garbo, RT.21/RW.06, Gembongan , Kec Gedeg, kab Mojokerto </td>
          </tr>
        </tbody>
      </table>
      <hr class="line-top" />
    </div>
  </section>
  <?php
  if (isset($_POST['cetak'])) {
    $no = 0;
    $mulai    = $_GET['awal'];
    $selesai = $_GET['akhir'];
    $sqlsewa =  "SELECT produk.*,penjualan.*,detailpenjualan.*,pelanggan.* FROM produk,penjualan,detailpenjualan,pelanggan WHERE produk.ProdukID=detailpenjualan.ProdukID
    AND pelanggan.PelangganID = penjualan.PelangganID AND detailpenjualan.PenjualanID = penjualan.PenjualanID
    AND penjualan.TanggalPenjualan BETWEEN '$mulai' AND '$selesai'";
    $querysewa = mysqli_query($koneksidb, $sqlsewa);
  ?>
    <section id="body-of-report">
      <div class="container-fluid">
        <h4 class="text-center">Detail Laporan</h4>
        <h5 class="text-center">Tanggal <?php echo $mulai . " s/d " . $selesai; ?></h5>
        <br />
        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode transaksi</th>
              <th>Nama_produk</th>
              <th>Tanggal penjualan</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 0;
            $pemasukan = 0;
            while ($result = mysqli_fetch_array($querysewa)) {
              $biayamobil = $result['JumlahProduk'] * $result['Harga'];
              $total = $biayamobil;
              $pemasukan += $total;
              $no++;
            ?>
              <tr align="center">
												<td><?php echo $no; ?></td>
												<td><?php echo htmlentities($result['PenjualanID']); ?></td>
												<td><?php echo htmlentities($result['NamaProduk']); ?></td>
												<td><?php echo htmlentities($result['TanggalPenjualan']); ?></td>
												<td><?php echo "Rp.   ".number_format($result['Subtotal']); ?></td>
											</tr>
            <?php } ?>
          </tbody>
          <tfoot>
            <?php
            echo '<tr>';
            echo '<th></th>';
            echo '<th colspan="3" class="text-center">Total Pemasukan</th>';
            
            echo '<th class="text-center">' . number_format($pemasukan) . '</th>';
            echo '</tr>';
            ?>
          </tfoot>
        </table>
      <?php }
      ?>
</div>
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>