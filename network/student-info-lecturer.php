<?php
    include 'config.php';

    $isEdit = (isset($_GET['id']));
    $userAuth = ($_SESSION['login_session']);

    if($userAuth->type != 3){
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
                            <h3><strong>View</strong> Lecturer</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Creation Form -->
                    <div class="row">
						<div class="col-xl-8 col-xxl-8">
							<div class="card flex-fill">

                                <!--#START Content -->
								<div class="card-body pt-4 pb-3">
                                    <div class="mb-3 text-center">
                                        <img
                                            alt="Student Profile"
                                            src="<?php echo (!empty($profile['picture']) ? 'images/'.$profile['picture'] : 'img/default_avatar.jpeg'); ?>"
                                            class="rounded-circle img-responsive mt-2"
                                            width="128"
                                            height="128" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input disabled type="text" placeholder="Lecturer name" class="form-control" value="<?php echo (!empty($profile['name']) ? $profile['name'] : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input disabled type="email" placeholder="Lecturer email" class="form-control" value="<?php echo (!empty($profile['email']) ? $profile['email'] : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input disabled type="text" placeholder="Lecturer phone number" class="form-control" value="<?php echo (!empty($profile['phone']) ? $profile['phone'] : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <textarea disabled name="lecturer_address" class="form-control" placeholder="Lecturer address" rows="2"><?php echo (!empty($profile['address']) ? $profile['address'] : ''); ?></textarea>
                                    </div>
								</div>
                                <!--#END Content -->

                                <!--#START Footer -->
								<div class="card-footer text-center">
                                    <a href="student-view-lecturer.php">
                                        <button type="button" class="btn btn-secondary">Back</button>
                                    </a>
                                </div>
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
</body>
</html>