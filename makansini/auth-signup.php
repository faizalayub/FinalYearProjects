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
                                            <h1 class="h3 w-100 text-center">Register New Account</h1>
                                            <!--#END Header -->

											<!--#START Form -->
											<form method="POST">
												<div class="mb-3">
													<label class="form-label">Name</label>
													<input class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name">
												</div>
                                                <div class="mb-3">
													<label class="form-label">Email</label>
													<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email">
												</div>
                                                <div class="mb-3">
													<label class="form-label">Phone</label>
													<input class="form-control form-control-lg" type="tel" name="phone" placeholder="Enter your phone">
												</div>
                                                <div class="mb-3">
													<label class="form-label">Address</label>
                                                    <textarea name="address" placeholder="Enter your address" class="form-control"></textarea>
												</div>
												<div class="mb-3">
													<label class="form-label">Password</label>
													<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password">
												</div>
												<div class="text-center mt-3">
													<button type="submit" name="create_account" class="btn btn-lg btn-primary w-100">Register Now</button>
													<div class="text-mute pt-3">Already register an account? <a href="./auth-login.php">Login now</a></div>
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

    <?php
        if(isset($_POST['create_account'])){
            $name     = addslashes($_POST['name']);
            $email    = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $phone    = addslashes($_POST['phone']);
            $address  = addslashes($_POST['address']);
    
            $result = runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`) VALUES (NULL, '$name', '$email', '$password', '3', '$phone', '$address')");
    
            ToastMessage('Success', 'Account created successfully', 'success', 'auth-login.php');
        }
    ?>
</body>
</html>
