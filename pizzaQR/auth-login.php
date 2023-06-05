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

											<!--#START Header -->
                                            <h1 class="h3 w-100 text-center">Login Account</h1>
                                            <!--#END Header -->

											<!--#START Background -->
											<div class="text-center">
												<img src="<?php echo $logoicon; ?>" height="400"/>
											</div>
											<!--#END Background -->

											<!--#START Form -->
											<form method="POST">
												<div class="mb-3">
													<label class="form-label">Email</label>
													<input class="form-control form-control-lg" type="email" name="login_email" placeholder="Enter your email">
													<small>You can login as Admin, Staff or Customer</small>
												</div>
												<div class="mb-3">
													<label class="form-label">Password</label>
													<input class="form-control form-control-lg" type="password" name="login_password" placeholder="Enter your password">
													<small>Enter correct password as registered</small>
												</div>
												<div class="text-center mt-3">
													<button type="submit" name="login_submit" class="btn btn-lg btn-primary w-100">Sign-in</button>
													<div class="text-mute pt-3">Dont have account yet? <a href="./auth-signup.php">Register now</a></div>
												</div>
											</form>
											<!--#END Form -->

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
	if(isset($_POST['login_submit'])){
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $result = fetchRow("SELECT * FROM `login` WHERE email = '$email' AND password = '$password'");

        if($result){
            switch($result['type']){
                case 1:
                    $_SESSION['account_admin'] = $result['id'];

					ToastMessage('Success', 'Successfully login as admin', 'success', 'admin-product.php');
                break;
				case 2:
                    $_SESSION['staff_session'] = $result['id'];

					ToastMessage('Success', 'Successfully login as staff', 'success', 'user-index.php');
                break;
				case 3:
                    
				break;
            }
        }else{
			ToastMessage('Invalid credential', 'Please try again', 'error', 'auth-login.php');
        }
    }
?>
</html>
