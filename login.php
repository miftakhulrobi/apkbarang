<?php
session_start(); // memulai session
if(@$_SESSION['id_user']) {
	echo "<script>window.location='dashboard';</script>";
} else {
require_once "config/koneksi.php"; // memanggil file koneksi
?>

<!DOCTYPE html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Aplikasi Barang</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="template/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="template/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="template/assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="template/assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="template/assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="template/assets/css/css.css" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="template/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="template/assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div style="background-color: #07bffc;" id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div style="background-color: #b8b9b9;" class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="template/assets/img/logo-dark.png" alt="Klorofil Logo"></div>
								<p class="lead">Login to your account</p>
							</div>
							<form class="form-auth-small" action="" method="post">
								<div class="form-group">
									<label for="username" class="control-label sr-only">Username</label>
									<input type="text" class="form-control" id="" name="username" placeholder="Username" required autofocus>
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="signin-password" name="password" placeholder="Password" required>
								</div>
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										
									</label>
								</div>
								<button type="submit" name="login" class="btn btn-primary btn-lg btn-block"> LOGIN </button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> Forgot password?</span>
                                </div>
                                <?php
                                if(isset($_POST['login'])) {
                                    $user = $_POST['username'];
                                    $pass = $_POST['password'];

                                    $query = $con->prepare("SELECT * FROM user WHERE username = :user AND password = :pass");
                                    $query->bindValue(':user', $user);
                                    $query->bindValue(':pass', $pass);
                                    $query->execute();
                                    $cek = $query->rowCount();
                                    if($cek > 0) {
                                        $data = $query->fetch(PDO::FETCH_ASSOC);
                                        $_SESSION['id_user'] = $data['id_user'];
                                        $_SESSION['username'] = $data['level'];
                                    

                                        echo "<script>window.location='dashboard/index.php';</script>";
                                    } else {
                                        echo "<script>alert('Login gagal. Username / Password Salah !');</script>";
                                    }

                                }
                                ?>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Aplikasi Barang</h1>
							<p>By Miftakhul Muqorobin</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>
<?php
}
?>