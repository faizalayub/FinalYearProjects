<?php
    include 'config.php';

    $isEdit = (isset($_GET['id']));

    if(!isset($_SESSION['account_admin'])){
        header("Location: auth-login.php");
        exit();
    }

    if($isEdit){
        $profile = fetchRow("SELECT * FROM login WHERE id =".$_GET['id']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'header.php'; ?>
</head>
<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Add</strong> Staff</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Creation Form -->
                    <div class="row">
						<div class="col-xl-8 col-xxl-8">
							<div class="card flex-fill">

                                <!--#START Content -->
								<div class="card-body pt-4 pb-3">

                                    <form method="POST" enctype="multipart/form-data">
                                       <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input required type="text" name="staff_name" placeholder="Name" class="form-control" value="<?php echo (!empty($profile['name']) ? $profile['name'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input required type="email" name="staff_email" placeholder="Emaill" class="form-control" value="<?php echo (!empty($profile['email']) ? $profile['email'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input required type="text" name="staff_phone" placeholder="Phone" class="form-control" value="<?php echo (!empty($profile['phone']) ? $profile['phone'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea name="staff_address" class="form-control" placeholder="Address" rows="1"><?php echo (!empty($profile['address']) ? $profile['address'] : ''); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input required type="text" name="staff_password" placeholder="Password" class="form-control" value="<?php echo (!empty($profile['password']) ? $profile['password'] : ''); ?>"/>
                                        </div>
                                       
                                        <div class="mb-3">
                                            <a href="admin-users.php">
                                                <button type="button" class="btn btn-secondary">Cancel</button>
                                            </a>
                                            <button type="submit" name="create_account" class="btn btn-primary"><?php echo ($isEdit ? 'Save Change' : 'Add Staff'); ?></button>
                                        </div>
                                    </form>

								</div>
                                <!--#END Content -->

                                <!--#START Footer -->
								<div class="card-footer"></div>
                                <!--#END Footer -->

							</div>
						</div>
					</div>
                    <!--#END Creation Form -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php
        if(isset($_POST['create_account'])){
            $name      = addslashes($_POST['staff_name']);
            $phone     = addslashes($_POST['staff_phone']);
            $address   = addslashes($_POST['staff_address']);
            $password  = addslashes($_POST['staff_password']);
            $email     = addslashes($_POST['staff_email']);
    
            if($isEdit){
                runQuery("UPDATE `login` SET `name` = '$name', `email` = '$email', `password` = '$password', `phone` = '$phone', `address` = '$address' WHERE `id` = ".$_GET['id']);

                ToastMessage('Success', 'User Updated!', 'success', 'admin-users.php');
            }else{
                runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`) VALUES (NULL, '$name', '$email', '$password', '2', '$phone', '$address')");

                ToastMessage('Success', 'User Added!', 'success', 'admin-users.php');
            }
        }
    ?>
</body>
</html>