<?php
session_start();
if(!isset($_SESSION['id_user'])) {
	echo "<script>window.location='../login.php';</script>";
}
require_once "../config/c_barang.php";
require_once "../config/c_user.php";
require_once "../config/c_transaksi.php";
?>

<!doctype html>
<html lang="en">

<head>
	<title>Aplikasi Barang</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="../template/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../template/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../template/assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="../template/assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="../template/assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="../template/assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="../template/assests/css/css.css" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="../template/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../template/assets/img/favicon.png">

	<link href="../template/assets/libs/DataTables/datatables.min.css" rel="stylesheet">
</head>

<body>
	<script src="../template/assets/vendor/jquery/jquery.min.js"></script>
	<script src="../template/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../template/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../template/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="../template/assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="../template/assets/scripts/klorofil-common.js"></script>

	<script src="../template/assets/libs/DataTables/datatables.min.js"></script>

	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="../dashboard/index.php"><img src="../template/assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				
				<div class="navbar-btn navbar-btn-right">
					<a class="btn btn-danger update-pro" href="../logout.php"><i class="glyphicon glyphicon-off"></i><span> LOGOUT</span></a>
				</div>

                <div style="margin-right: 10px;" class="navbar-btn navbar-btn-right">
					<a class="btn btn-info update-pro" href=""><i class="glyphicon glyphicon-refresh"></i><span> </span></a>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						
					</ul>	
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="../dashboard/index.php" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="../tabel_user/data.php" class=""><i class="lnr lnr-user"></i> <span>Table User</span></a></li>

						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="fa fa-shopping-bag"></i> <span>Barang</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="../barang/data.php" class="">Data Barang</a></li>
									<li><a href="../barang/grafik.php" class="">Grafik</a></li>
								</ul>
							</div>
						</li>
						<li><a href="../transaksi/data.php" class=""><i class="fa fa-shopping-cart"></i> <span>Transaksi</span></a></li>
						
						<li><a href="../grafik/data.php" class=""><i class="lnr lnr-chart-bars"></i> <span>Laporan</span></a></li>
						
						<li><a href="../keuangan/data.php" class=""><i class="fa fa-line-chart"></i> <span>Keuangan</span></a></li>
						
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">


    <h4>
        <small>Tambah Data Barang</small>
        <div class="pull-right">
            <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
        </div>
    </h4>
    <?php
    $db = new PDO ('mysql:host=localhost;dbname=apkbarang;','root','');
    $sql = $db->prepare("SELECT max(id_barang) FROM barang");
    $sql->execute();
    $datakode = $sql->fetch();
    if($datakode) {
        $nilaikode = substr($datakode[0], 1);
        $kode = (int) $nilaikode;
        $kode = $kode + 1;
        $hasilkode = "B" .str_pad($kode, 3, "0", STR_PAD_LEFT);
    } else {
        $hasilkode = "B001";
    }
    ?>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="proses.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="id_barang">ID Barang</label>
                    <input type="text" name="id_barang" id="id_barang" class="form-control" value="<?=$hasilkode?>" required>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="harga_barang">Harga Barang</label>
                    <input type="number" name="harga_barang" id="harga_barang" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="stok_barang">Stok Barang</label>
                    <input type="number" name="stok_barang" id="stok_barang" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="gambar_barang">Gambar</label>
                    <input type="file" name="gambar_barang" id="gambar_barang" class="form-control" required>
                </div>
                <div class="form-group pull-right">
                    <input type="submit" name="add" value="Simpan" class="btn btn-primary">
                </div>
            </form>
           
        </div>
    </div>
<?php
include_once "../index/footer.php";
?>