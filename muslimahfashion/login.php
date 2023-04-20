<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		include 'config.php';
        include 'header.php';
    ?>
</head>

<body>
	<div class="wrapper">
		<?php include 'sidebar.php'; ?>

		<div class="main">
			<?php include 'top-navbar.php'; ?>

			<main class="content">
				<div class="container-fluid p-0">

					<!--#START Login Container -->
					<div class="row">
						<div class="col-sm-10 col-md-5 col-lg-5 mx-auto d-table h-100">
							<div class="d-table-cell align-middle">

								<div class="card">
									<div class="card-body">
										<div class="m-sm-4">

											<div class="text-center">
												<h1>User Login</h1>
											</div>
											
											<div class="text-center">
												<img src="img/login-illustration.svg" height="400"/>
											</div>

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
					<!--#END Login Container -->

				</div>
			</main>

			<?php include 'footer.php'; ?>
		</div>
	</div>
</body>

<?php
	if(isset($_POST['logmasuk_submit'])){
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $result = fetchRow("SELECT * FROM `login` WHERE email = '$email' AND password = '$password'");

        if($result){
            switch($result['type']){
                case 1:
                    $_SESSION['account_admin'] = $result['id'];

					ToastMessage('Success', 'Successfully login as admin', 'success', 'index.php');
                break;
                case 2:
                    $_SESSION['account_session'] = $result['id'];

					ToastMessage('Success', 'Successfully login as user', 'success', 'index.php');
                break;
            }
        }else{
			ToastMessage('Invalid credential', 'Please try again', 'error', 'login.php');
        }
    }
?>
</html>
