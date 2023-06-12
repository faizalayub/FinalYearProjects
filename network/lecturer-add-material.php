<?php
    include 'config.php';

    $isEdit = (isset($_GET['id']));
    $userAuth = ($_SESSION['login_session']);

    if($userAuth->type != 2){
        header("Location: auth-login.php");
        exit();
    }

    if($isEdit){
        $dataset = fetchRow("SELECT * FROM article WHERE id =".$_GET['id']);
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
                            <h3><strong>Add</strong> Materials</h3>
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
                                        <input required type="text" name="material_name" placeholder="Material name" class="form-control" value="<?php echo (!empty($dataset['name']) ? $dataset['name'] : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Type</label>
                                        <input required type="text" name="material_type" placeholder="Material type" class="form-control" value="<?php echo (!empty($dataset['type']) ? $dataset['type'] : ''); ?>"/>
                                    </div>

                                    <div class="mb-3">
                                        <label class="btn btn-info" for="uploader">
                                            <i class="align-middle" data-feather="upload"></i> Add Attachment
                                        </label><br>

                                        <?php echo (!empty($dataset['attachment']) ? '<small>'.$dataset['attachment'].'</small>' : ''); ?>

                                        <input id="uploader" class="d-none" type="file" accept="application/pdf" name="fileToUpload">
                                    </div>

                                    <div class="mb-3">
                                        <a href="lecturer-study-material.php">
                                            <button type="button" class="btn btn-secondary">Cancel</button>
                                        </a>

                                        <button type="submit" name="upload_material" class="btn btn-primary"><?php echo ($isEdit ? 'Save Change' : 'Add Material'); ?></button>
                                    </div>
								</div>
                                <!--#END Content -->

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
        if(isset($_POST['upload_material'])){
            $imagename = ($dataset['attachment'] ?? null);
            $materialname = ($_POST['material_name'] ?? '');
            $materialtype = ($_POST['material_type'] ?? '');

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

            if(isset($_GET['id'])){
                runQuery("UPDATE `article` SET `name` = '$materialname', `attachment` = '$imagename', `type` = '$materialtype' WHERE `menu`.`id` = ".$_GET['id']);

                ToastMessage('Success', 'Material Saved', 'success', 'lecturer-study-material.php');
            }else{
                runQuery("INSERT INTO `article` (`id`, `name`, `publisher`, `date_publish`, `type`, `attachment`, `is_active`) VALUES (NULL, '$materialname', '$userAuth->id', current_timestamp(), '$materialtype', '$imagename', '1')");

                ToastMessage('Success', 'Material Added', 'success', 'lecturer-study-material.php');
            }
        }
    ?>
</body>
</html>