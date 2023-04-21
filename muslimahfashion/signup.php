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
                                            <div class="mb-4">
                                                <h1 class="h3 d-inline align-middle">Create Account</h1>
                                            </div>
                                            <!--#END Header -->

                                            <!--#START Form -->
											<form method="POST">
                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Name" name="fullname">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" placeholder="Email" name="email">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input type="tel" class="form-control" placeholder="Phone" name="phone">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Address</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" placeholder="Address" rows="3" name="address"></textarea>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <div class="col-sm-10 ms-sm-auto">
                                                        <button type="submit" class="btn btn-primary">Register Now</button>
                                                        <div class="mt-3">
                                                            <a href="login.php" class="text-left w-100 m-1">Already have account?</a>
                                                        </div>
                                                    </div>
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
    }
?>
</html>
