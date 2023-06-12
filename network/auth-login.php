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
                                            <h1 class="h3 w-100 text-center">Sign In Your Account</h1>
                                            <!--#END Header -->

											<!--#START Form -->
											<form method="POST">
												<div class="mb-3">
													<label class="form-label">Email</label>
													<input class="form-control form-control-lg" type="email" name="login_email" placeholder="Enter your email">
													<small>You can login as Admin, Lecturer or Student</small>
												</div>
												<div class="mb-3">
													<label class="form-label">Password</label>
													<input class="form-control form-control-lg" type="password" name="login_password" placeholder="Enter your password">
													<small>Enter correct password as registered</small>
												</div>
												<div class="text-center mt-3">
													<button type="submit" name="login_submit" class="btn btn-lg btn-primary w-100">Sign-in</button>
													<div class="text-mute pt-3">Register as new student <a href="./auth-signup.php">Click Here</a></div>
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
        $email = addslashes($_POST['login_email']);
        $password = $_POST['login_password'];

        $result = fetchRow("SELECT * FROM `login` WHERE email = '$email' AND password = '$password'");

        if($result){
            switch($result['type']){
                case 1:
					ToastMessage('Success', 'Successfully login as admin', 'success', 'admin-manage-student.php');
                break;
				case 2:
					ToastMessage('Success', 'Successfully login as lecturer', 'success', 'lecturer-profile.php');
                break;
				case 3:
					ToastMessage('Success', 'Successfully login as student', 'success', 'student-index.php');
				break;
            }

			$_SESSION['login_session'] = (object) $result;
        }else{
			ToastMessage('Invalid credential', 'Please try again', 'error', 'auth-login.php');
        }
    }
?>
</html>
