<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		include 'config.php';
        include 'header.php';
    ?>
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center"><h1>User Login</h1></div>
									
									<div class="text-center"><img src="img/login-illustration.svg" height="400"/></div>

									<form method="POST">
										<div class="input-group mb-3" style="height: 42px;">
											<span class="input-group-text">Email Address</span>
											<input type="text" class="form-control" autocomplete="off" placeholder="Enter Your Email" name="login_email">
										</div>
										<div class="input-group mb-3" style="height: 42px;">
											<span class="input-group-text">Password</span>
											<input type="password" class="form-control" autocomplete="off" placeholder="Password" name="login_password">
										</div>
										<div class="text-center mt-3">
											<button type="submit" name="logmasuk_submit" class="btn btn-lg btn-info w-100">Login</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
</body>

<?php
    if(isset($_POST['logmasuk_submit'])){
		$utils = new Controller('RETURN');
        $login_email     = $_POST['login_email'];
        $login_password  = $_POST['login_password'];
		$checkCredential = $utils->fetchRow("SELECT * FROM `pengguna` WHERE `username` = '".$login_email."' AND password = '".$login_password."'");

		if(!empty($checkCredential)){
			$rolename = $utils->fetchRow("SELECT * FROM `role` WHERE id = ".$checkCredential->role);

			$_SESSION['id']       = $checkCredential->id;
			$_SESSION['role']     = $checkCredential->role;
			$_SESSION['fullname'] = $checkCredential->fullname;

			ToastMessage('Berjaya Masuk!', 'Berjaya masuk sebagai '.$rolename->role, 'success', 'index.php');
		}else{
			ToastMessage('Daftar Masuk Gagal', 'Maaf! Anda bukan pengguna berdaftar', 'warning', 'login.php');
		}
    }
?>
</html>
