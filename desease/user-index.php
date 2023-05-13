<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_session'])){
        header("Location: login-account.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'inc/header.php'; ?>
</head>
<body>
    <div class="wrapper">
        <?php include 'inc/sidebar.php'; ?>

        <div class="main">
            <?php include 'inc/top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>My Profile</strong> Details</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chart -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Header -->
								<div class="card-header"></div>
                                <!--#END Header -->

                                <!--#START Content -->
								<div class="card-body pt-2 pb-3">
                                    <form method="POST">

                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-2 text-sm-end">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Name" name="fullname" value="<?php echo $profiledata['name']; ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-2 text-sm-end">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $profiledata['email']; ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-2 text-sm-end">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="tel" class="form-control" placeholder="Phone" name="phone" value="<?php echo $profiledata['phone']; ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-2 text-sm-end">Address</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" placeholder="Address" rows="3" name="address"><?php echo $profiledata['address']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-2 text-sm-end">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $profiledata['password']; ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-sm-10 ms-sm-auto">
                                                <button type="submit" name="update_account" class="btn btn-success">Confirm Update Profile</button>
                                            </div>
                                        </div>

                                    </form>
								</div>
                                <!--#END Content -->

							</div>
						</div>
					</div>
                    <!--#END Content -->

                </div>
            </main>

            <?php include 'inc/footer.php'; ?>
        </div>
    </div>

    <?php
        if(isset($_POST['update_account'])){
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $result = runQuery("UPDATE `login` SET `name` = '$name', `email` = '$email', `password` = '$password', `phone` = '$phone', `address` = '$address' WHERE `login`.`id` = ".$_SESSION['account_session']);

            echo '<script>alert("Account updated successfully");window.location.href="user-index.php"</script>';
        }
    ?>
</body>
</html>