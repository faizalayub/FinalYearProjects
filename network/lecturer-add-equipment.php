<?php
    include 'config.php';

    $isEdit = (isset($_GET['id']));
    $userAuth = ($_SESSION['login_session']);

    if($userAuth->type != 2){
        header("Location: auth-login.php");
        exit();
    }

    if($isEdit){
        $profile = fetchRow("SELECT * FROM equipment WHERE id =".$_GET['id']);
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
                            <h3><strong>Register </strong> Equipment</h3>
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
                                            <input required type="text" name="equipment_name" placeholder="Enter equipment name" class="form-control" value="<?php echo (!empty($profile['name']) ? $profile['name'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <input required type="text" name="equipment_type" placeholder="Enter equipment type" class="form-control" value="<?php echo (!empty($profile['type']) ? $profile['type'] : ''); ?>"/>
                                        </div>
                                       
                                        <div class="mb-3">
                                            <a href="lecturer-view-equipment.php">
                                                <button type="button" class="btn btn-secondary">Cancel</button>
                                            </a>
                                            <button type="submit" name="add_equipment" class="btn btn-primary">Add</button>
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
        if(isset($_POST['add_equipment'])){
            $name = addslashes($_POST['equipment_name']);
            $type = addslashes($_POST['equipment_type']);

            if($isEdit){
                runQuery("UPDATE `equipment` SET `name` = '$name', `type` = '$type', `publisher` = '$userAuth->id' WHERE `id` = ".$_GET['id']);

                ToastMessage('Success', 'User Updated!', 'success', 'lecturer-view-equipment.php');
            }else{
                runQuery("INSERT INTO `equipment` (`id`, `name`, `publisher`, `status`, `type`) VALUES (NULL, '$name', '$userAuth->id', '1', '$type')");

                ToastMessage('Success', 'User Added!', 'success', 'lecturer-view-equipment.php');
            }
        }
    ?>
</body>
</html>