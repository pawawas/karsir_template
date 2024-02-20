<?php
session_start();
include('koneksi.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:login.php');
} else {
?>
	<!doctype html>
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

				</div>
			</div><!-- /.container-fluid -->
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<div class="profile-sidebar">
				<div class="profile-userpic">
					<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">Username</div>
					<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="divider"></div>

			<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="produk.php"><em class="fa fa-list">&nbsp;</em> Produk</a></li>
			<li><a href="transaksi.php"><em class="fa fa-shopping-cart">&nbsp;</em> Kasir</a></li>
			<li><a href="petugas.php"><em class="fa fa-user">&nbsp;</em> Petugas</a></li>
			<li><a href="member.php"><em class="fa fa-users">&nbsp;</em> Member</a></li>
			<li class="active"><a href="laporan.php"><em class="fa fa-bar-chart">&nbsp;</em> Laporan</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
		</div><!--/.sidebar-->

		<main class="container">
			<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
				<div class="row">


					<h2 class="page-title">Laporan</h2>
					<div class="panel panel-default">
						<div class="panel-body">
							<form method="get" name="laporan" onSubmit="return valid();">
								<div class="form-group">
									<div class="col-sm-4 mt-2">
										<label>Tanggal Awal</label>
										<input type="date" class="form-control" name="awal" placeholder="From Date(dd/mm/yyyy)" required>
									</div>
									<div class="col-sm-4 mt-2">
										<label>Tanggal Akhir</label>
										<input type="date" class="form-control" name="akhir" placeholder="To Date(dd/mm/yyyy)" required>
									</div>

									<div class="col-sm-4 mt-2 mb-4  ">

										<input type="submit" name="submit" value="Lihat Laporan" class="btn btn-primary">
									</div>

							</form>
						</div>
					</div>
					<?php
					if (isset($_GET['submit'])) {
						$no = 0;
						$mulai 	 = $_GET['awal'];
						$selesai = $_GET['akhir'];

						$sqlsewa =  "SELECT produk.*,penjualan.*,detailpenjualan.*,pelanggan.* FROM produk,penjualan,detailpenjualan,pelanggan WHERE produk.ProdukID=detailpenjualan.ProdukID
												AND pelanggan.PelangganID = penjualan.PelangganID AND detailpenjualan.PenjualanID = penjualan.PenjualanID
												AND penjualan.TanggalPenjualan BETWEEN '$mulai' AND '$selesai'";
						$querysewa = mysqli_query($koneksidb, $sqlsewa);
					?>
						<!-- Zero Configuration Table -->
						<div class="col-mt-6">
							<div class="panel panel-default">
								<div class="panel-heading">Laporan Pembelian Tanggal <?php echo $mulai; ?> sampai <?php echo $selesai; ?></div>
								<div class="panel-body">
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
											while ($result = mysqli_fetch_array($querysewa)) {


												$no++;
											?>
												<tr>
													<td><?php echo $no; ?></td>
													<td><?php echo htmlentities($result['PenjualanID']); ?></td>
													<td><?php echo htmlentities($result['NamaProduk']); ?></td>
													<td><?php echo htmlentities($result['TanggalPenjualan']); ?></td>
													<td><?php echo "Rp.   " . number_format($result['Subtotal']); ?></td>
												</tr>
											<?php }
											?>

										</tbody>
									</table>

								</div>
							</div>
							<form action="laporan_cetak.php?awal=<?php echo $mulai; ?>&akhir=<?php echo $selesai; ?>&status=<?php echo $statt ?>" target="_blank" method="post">
								<div class="form-group">
									<input type="submit" name="cetak" value="Cetak" class="btn btn-primary">

								</div>
							</form>
						<?php } ?>


						</div>
				</div>
			</div>
			</div>
			</div>
		</main>
		<!-- Modal Add -->
		<div class="modal fade" id="addBarang" tabindex="-1" aria-labelledby="addBarangLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addBarangLabel">Tambah Data</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form method="post" action="proses_tambah_pelanggan.php">
							<div class="mb-3">
								<label class="form-label">Nama Pelanggan</label>
								<input type="text" name="nama" class="form-control" id="barang" required>
							</div>
							<div class="mb-3">
								<label class="form-label">Alamat</label>
								<input type="text" name="alamat" class="form-control" id="alamat" required>
							</div>
							<div class="mb-3">
								<label class="form-label">Nomor Telepon</label>
								<input type="text" name="nomer" class="form-control" id="satuan" required>
							</div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
		</div>
		</div><!--/.row-->
		</div> <!--/.main-->

		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/chart.min.js"></script>
		<script src="js/chart-data.js"></script>
		<script src="js/easypiechart.js"></script>
		<script src="js/easypiechart-data.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/custom.js"></script>
		<script>
			window.onload = function() {
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
<?php } ?>