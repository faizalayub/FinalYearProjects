<?php
    include 'config.php';

    $isEdit = (isset($_GET['id']));
    $userAuth = ($_SESSION['login_session']);

    if($userAuth->type != 3){
        header("Location: auth-login.php");
        exit();
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

                    <!--#START Creation Form -->
                    <div class="row">
                        <div class="col-md-3"></div>
						<div class="col-md-6">
							<form class="card flex-fill" method="POST" enctype="multipart/form-data">

                                <!--#START Content -->
								<div class="card-body pt-4 pb-3">
                                    <div class="mb-3 text-center">
                                        <img
                                            alt="Student Profile"
                                            src="<?php echo (!empty($userAuth->picture) ? 'images/'.$userAuth->picture : 'img/default_avatar.jpeg'); ?>"
                                            class="rounded-circle img-responsive mt-2"
                                            width="128"
                                            height="128" />

                                        <div class="mt-2">
                                            <label class="btn btn-primary" for="uploader"><i class="align-middle" data-feather="upload"></i> Upload</label>
                                            <input id="uploader" class="d-none" type="file" accept="image/png, image/gif, image/jpeg" name="fileToUpload">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Student ID</label>
                                        <input required type="text" disabled placeholder="Student name" class="form-control" value="<?php echo (!empty($userAuth->studentID) ? $userAuth->studentID : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input required type="text" name="student_name" placeholder="Student name" class="form-control" value="<?php echo (!empty($userAuth->name) ? $userAuth->name : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input required type="email" name="student_email" placeholder="Student email" class="form-control" value="<?php echo (!empty($userAuth->email) ? $userAuth->email : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input required type="text" name="student_phone" placeholder="Student phone number" class="form-control" value="<?php echo (!empty($userAuth->phone) ? $userAuth->phone : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea name="student_address" class="form-control" placeholder="Student address" rows="4"><?php echo (!empty($userAuth->address) ? $userAuth->address : ''); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input required type="text" name="student_password" placeholder="Password" class="form-control" value="<?php echo (!empty($userAuth->password) ? $userAuth->password : 'abcd123'); ?>"/>
                                    </div>
								</div>
                                <!--#END Content -->

                                <!--#START Footer -->
								<div class="card-footer text-center">
                                    <button type="submit" name="save_profile" class="btn btn-success">Save Change</button>
                                </div>
                                <!--#END Footer -->

							</form>
						</div>
                        <div class="col-md-3"></div>
					</div>
                    <!--#END Creation Form -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php
        if(isset($_POST['save_profile'])){
            $imagename = ($dataset['attachment'] ?? null);
            $name      = addslashes($_POST['student_name']);
            $phone     = addslashes($_POST['student_phone']);
            $address   = addslashes($_POST['student_address']);
            $password  = addslashes($_POST['student_password']);
            $email     = addslashes($_POST['student_email']);

            if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["size"])){
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                    // echo "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
                }else{
                    echo "Sorry, there was an error uploading your file.";
                }

                $imagename = $_FILES["fileToUpload"]["name"];
            }
    
            runQuery("UPDATE `login` SET `name` = '$name', `email` = '$email', `password` = '$password', `phone` = '$phone', `address` = '$address', `picture` = '$imagename' WHERE `id` = ".$userAuth->id);

            ToastMessage('Success', 'Please relogin!', 'success', 'auth-logout.php');
        }
    ?>
</body>
</html>