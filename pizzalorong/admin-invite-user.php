<?php
    include 'config.php';

    $isEdit = (isset($_GET['id']));

    if(!isset($_SESSION['account_admin'])){
        header("Location: login.php");
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
                                            <label class="form-label">Staff ID</label>
                                            <input required type="text" name="staff_id" placeholder="Staff ID" class="form-control" value="<?php echo (!empty($profile['staff_id']) ? $profile['staff_id'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input required type="text" name="staff_name" placeholder="Name" class="form-control" value="<?php echo (!empty($profile['name']) ? $profile['name'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input required type="email" name="staff_email" placeholder="Emaill" class="form-control" value="<?php echo (!empty($profile['email']) ? $profile['email'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">MyKad / IC</label>
                                            <input required type="text" name="staff_mykad" placeholder="MyKad / IC" class="form-control" value="<?php echo (!empty($profile['ic']) ? $profile['ic'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Home Address</label>
                                            <textarea name="staff_address" class="form-control" placeholder="Home Address" rows="1"><?php echo (!empty($profile['address']) ? $profile['address'] : ''); ?></textarea>
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
            $mykad     = addslashes($_POST['staff_mykad']);
            $address   = addslashes($_POST['staff_address']);
            $password  = addslashes($_POST['staff_password']);
            $staffcode = addslashes($_POST['staff_id']);
            $email     = addslashes($_POST['staff_email']);
    
            if($isEdit){
                runQuery("UPDATE `login` SET `name` = '$name', `email` = '$email', `password` = '$password', `ic` = '$mykad', `staff_id` = '$staffcode', `address` = '$address' WHERE `id` = ".$_GET['id']);

                ToastMessage('Success', 'Staff details updated!', 'success', 'admin-users.php');
            }else{
                runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `ic`, `address`, `staff_id`) VALUES (NULL, '$name', '$email', '$password', '2', '$mykad', '$address', '$staffcode')");

                ToastMessage('Success', 'Staff added!', 'success', 'admin-users.php');
            }
        }
    ?>
</body>
</html>