<?php
    include 'config.php';

    $isEdit = (isset($_GET['id']));
    $userAuth = ($_SESSION['login_session']);

    if($userAuth->type != 1){
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
                            <h3><strong>Add</strong> Student</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Creation Form -->
                    <div class="row">
						<div class="col-xl-8 col-xxl-8">
							<form class="card flex-fill" method="POST" enctype="multipart/form-data">

                                <!--#START Content -->
								<div class="card-body pt-4 pb-3">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input required type="text" name="student_name" placeholder="Lecturer name" class="form-control" value="<?php echo (!empty($profile['name']) ? $profile['name'] : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input required type="email" name="student_email" placeholder="Lecturer email" class="form-control" value="<?php echo (!empty($profile['email']) ? $profile['email'] : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input required type="text" name="student_phone" placeholder="Lecturer phone number" class="form-control" value="<?php echo (!empty($profile['phone']) ? $profile['phone'] : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="student_address" class="form-control" placeholder="Lecturer address" rows="2"><?php echo (!empty($profile['address']) ? $profile['address'] : ''); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input required type="text" name="student_password" placeholder="Password" class="form-control" value="<?php echo (!empty($profile['password']) ? $profile['password'] : 'abcd123'); ?>"/>
                                        <small>Default password is 'abcd123' as a fresh account</small>
                                    </div>
								</div>
                                <!--#END Content -->

                                <!--#START Footer -->
								<div class="card-footer">
                                    <a href="admin-manage-lecturer.php">
                                        <button type="button" class="btn btn-secondary">Cancel</button>
                                    </a>

                                    <button type="submit" name="create_account" class="btn btn-primary"><?php echo ($isEdit ? 'Save Change' : 'Add Student'); ?></button>
                                </div>
                                <!--#END Footer -->

							</form>
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
            $id       = addslashes($_POST['studentid']);
            $name      = addslashes($_POST['student_name']);
            $phone     = addslashes($_POST['student_phone']);
            $address   = addslashes($_POST['student_address']);
            $password  = addslashes($_POST['student_password']);
            $email     = addslashes($_POST['student_email']);
    
            if($isEdit){
                runQuery("UPDATE `login` SET `name` = '$name', `email` = '$email', `password` = '$password', `phone` = '$phone', `address` = '$address', `studentID` = '$id' WHERE `id` = ".$_GET['id']);

                ToastMessage('Success', 'User Updated!', 'success', 'admin-users.php');
            }else{
                runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`, `studentID`) VALUES (NULL, '$name', '$email', '$password', '2', '$phone', '$address', '$id')");

                ToastMessage('Success', 'User Added!', 'success', 'admin-users.php');
            }
        }
    ?>
</body>
</html>