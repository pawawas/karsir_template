<?php
session_start();
include('koneksi.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:login.php');
}
else{
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino UI Elements</title>
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
		
		<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="active"><a href="produk.php"><em class="fa fa-list">&nbsp;</em> Produk</a></li>
			<li><a href="transaksi.php"><em class="fa fa-shopping-cart">&nbsp;</em> Kasir</a></li>
			<li><a href="petugas.php"><em class="fa fa-user">&nbsp;</em> Petugas</a></li>
			<li><a href="member.php"><em class="fa fa-users">&nbsp;</em> Member</a></li>
			<li><a href="laporan.php"><em class="fa fa-bar-chart">&nbsp;</em> Laporan</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Produk</h1>
			</div>
		</div><!--/.row-->
				
		
		<main class="container">

    <div class="row g-5 mb-4">
      <div class="col-md-12">

        <div class="row justify-content-end">
          <div class="col-md-6">
            <a href="tambah_produk.php" class="btn btn-primary float-end" id="addBarangBtn"><i class="bi bi-plus-lg"></i> Tambah
              Data</a>
          </div>
        </div>

        <div class="card mt-2">
          <div class="card-body">
            <table class="table" id="dt">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Stok</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php
                $no = 0;
                $sql = "SELECT * from produk";
                $query = mysqli_query($koneksidb, $sql);
                while ($result = mysqli_fetch_array($query)) {
                  $no++;
                ?>
                  <tr id="table-data">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $result['NamaProduk']; ?></td>
                    <td><?php echo $result['Harga']; ?></td>
                    <td><?php echo $result['Stok']; ?></td>
                    <td>
                      <a href="edit_produk.php?id=<?php echo $result['ProdukID']; ?>" class="fa fa-pencil-square"></a>
                      <a href="hapus_produk.php?id=<?php echo $result['ProdukID']; ?>" onclick="return confirm('Apakah anda akan menghapus <?php echo $result['NamaProduk']; ?>?')" class="fa fa-trash"></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>

	<div class="modal fade" id="addBarang" tabindex="-1" aria-labelledby="addBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBarangLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="proses_tambah_produk.php">
            <div class="mb-3">
              <label class="form-label">Nama Produk</label>
              <input type="text" name="produk" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Harga</label>
              <input type="text" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Stok</label>
              <input type="text" name="stok" class="form-control" required>
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      var dt = $('#dt').DataTable({
        bInfo: false,
        pageLength: 10,
        lengthChange: false,
        deferRender: true,
        processing: true,
      });

      $('#addBarangBtn').click(function() {
        $('#addBarang').modal('show');
      })
    });
  </script>
</body>
</html>
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
<?php } ?>