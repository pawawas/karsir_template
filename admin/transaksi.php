<<?php
	session_start();
	error_reporting(0);
	include('koneksi.php');
	if (strlen($_SESSION['alogin']) == 0) {
		header('location:login.php');
	} else {


		$jum = 0;
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $key => $value) {
				$jum += $value['Harga'] * $value['JumlahProduk'];
				# code...
			}
		}

	?> <!doctype html>
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
					<div class="profile-usertitle-name">admin</div>
					<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="divider"></div>
			<form role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
			</form>
			<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="produk.php"><em class="fa fa-list">&nbsp;</em> Produk</a></li>
			<li class="active"><a href="transaksi.php"><em class="fa fa-shopping-cart">&nbsp;</em> Kasir</a></li>
			<li><a href="petugas.php"><em class="fa fa-user">&nbsp;</em> Petugas</a></li>
			<li><a href="member.php"><em class="fa fa-users">&nbsp;</em> Member</a></li>
			<li><a href="laporan.php"><em class="fa fa-bar-chart">&nbsp;</em> Laporan</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
		</div><!--/.sidebar-->
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


		<main class="container">

<div class="row g-5 mb-4">
	<div class="col-md-12">
		<div class="col-md-6">

			<div class="card mt-2">
				<div class="card-body">


					<h1 class="text-center">Total Belanja: Rp. <?php echo number_format($jum) ?>.</h1>

					<form action="proses_transaksi.php" method="post">
						<input type="hidden" name="total" value="<?php echo number_format($jum) ?>">
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">Pelanggan</label>
								<select class="form-control" name="pelanggan" required="" data-parsley-error-message="Field ini harus diisi">
									<option value="">== Pilih Pelanggan ==</option>
									<?php
									$mySql = "SELECT * FROM pelanggan ORDER BY PelangganID";
									$myQry = mysqli_query($koneksidb, $mySql);
									while ($myData = mysqli_fetch_array($myQry)) {
										if ($myData['PelangganID'] == $dataMerek) {
											$cek = " selected";
										} else {
											$cek = "";
										}
										echo "<option value='$myData[PelangganID]' $cek>$myData[NamaPelanggan] </option>";
									}
									?>
								</select>

							</div>
							<div class="mb-3 mt-2">
								<label class="form-label">Bayar</label>

								<input type="number" name="total" class="form-control" value="<?php $total ?>" id="satuan" required>
								<button type="submit" class="btn btn-primary mt-2 ">Bayar</button>
							</div>


					</form>
				</div>
			</div>

		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="card mt-2">
		<div class="card-body">
			<table class="table" id="dt">
				<thead class="text-center">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama Produk</th>
						<th scope="col">Harga Produk</th>
						<th scope="col">Stok</th>
						<th scope="col">Subtotal</th>
					</tr>
				</thead>
				
				<tbody class="text-center"><?php
				
				
											$no = 0;
											foreach ($_SESSION['cart'] as $key => $value) {
												$no++; ?>
						
						<tr>
							<td><?php echo $no ?></td>
							<td><?= $value['NamaProduk'] ?></td>
							<td>Rp. <?= number_format($value['Harga']) ?></td>
							<td><?= $value['JumlahProduk'] ?></td>
							<td>Rp. <?= number_format($value['JumlahProduk'] * $value['Harga']) ?></td>
						</tr>

					<?php } ?>
					<tr>
						<form action="aksi_keranjang.php" method="post">
							<div class="mb-3">
								<label class="form-label">Produk</label>
								<select class="form-control" name="produk" required="" data-parsley-error-message="Field ini harus diisi">
									<option value="">== Pilih Produk ==</option>
									<?php
									$mySql = "SELECT * FROM produk ORDER BY ProdukID";
									$myQry = mysqli_query($koneksidb, $mySql);
									while ($myData = mysqli_fetch_array($myQry)) {
										if ($myData['ProdukID'] == $dataMerek) {
											$cek = " selected";
										} else {
											$cek = "";
										}
										echo "<option value='$myData[ProdukID]' $cek>$myData[NamaProduk] </option>";
									}
									?>
								</select>
							</div>
							<div class="mb-3">
								<label class="form-label">Jumlah</label>
								<input type="number" name="JumlahProduk" class="form-control" value="<?php $total ?>" id="satuan" required>
								<button type="submit" class="btn btn-primary mt-2">Tambah</button>
								<a href="reset_keranjang.php" class="btn btn-danger mt-2" onclick="return confirm('Apakah anda Yakin akan mereset Keranjang?')">Reset Keranjang</a>
							</div>

						</form>


				</tbody>


			</table>


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
			<form method="post" action="proses_tambah_member.php">
				<div class="mb-3">


					<label class="form-label">Produk</label>
					<select class="form-control" name="produk" required="" data-parsley-error-message="Field ini harus diisi">
						<option value="">== Pilih Produk ==</option>
						<?php
						$mySql = "SELECT * FROM produk ORDER BY ProdukID";
						$myQry = mysqli_query($koneksidb, $mySql);
						while ($myData = mysqli_fetch_array($myQry)) {
							if ($myData['ProdukID'] == $dataMerek) {
								$cek = " selected";
							} else {
								$cek = "";
							}
							echo "<option value='$myData[ProdukID]' $cek>$myData[NamaProduk] </option>";
						}
						?>
					</select>
				</div>
				<?php

				$sql = "SELECT * from  produk ";
				$query = mysqli_query($koneksidb, $sql);
				$result = mysqli_fetch_array($query);
				$total = 0;
				$hargaitem = $result['Harga'];
				foreach ($hargaitem as $harga) {
					$total += $harga;
				}
				?>

				<div class="mb-3">
					<label class="form-label">Jumlah Produk</label>
					<input type="text" name="alamat" class="form-control" id="alamat" required>
				</div>
				<div class="mb-3">
					<label class="form-label">Subtotal</label>
					<input type="text" name="Subtotal" class="form-control" value="<?php $total ?>" id="satuan" required>
				</div>

		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
		</form>
	</div>
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