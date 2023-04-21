<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
        header("Location: login.php");
        exit();
    }

    if(isset($_GET['id'])){
        $article = fetchRow("SELECT * FROM menu WHERE id =".$_GET['id']);
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
                            <h3><strong>Create</strong> Product</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Creation Form -->
                    <div class="row">
						<div class="col-xl-8 col-xxl-8">
							<div class="card flex-fill">

                                <!--#START Header -->
								<div class="card-header"></div>
                                <!--#END Header -->

                                <!--#START Content -->
								<div class="card-body pt-2 pb-3">

                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="materialupload"/>

                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input required type="text" name="menu_name" placeholder="Product Name" class="form-control" value="<?php echo (!empty($article['name']) ? $article['name'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Price</label>
                                            <input required type="number" name="menu_price" placeholder="Product Price" class="form-control" value="<?php echo (!empty($article['price']) ? $article['price'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Stock Amount</label>
                                            <input required type="number" name="menu_stock" placeholder="Product Stock" class="form-control" value="<?php echo (!empty($article['in_stock']) ? $article['in_stock'] : ''); ?>"/>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select required name="menu_category" placeholder="Product Category" class="form-control">
                                                <option value="">Nothing Selected</option>
                                                <?php
                                                    $categories = fetchRows("SELECT * FROM category");

                                                    foreach($categories as $c){
                                                        echo '<option '.(!empty($article['category']) && $article['category'] == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label w-100">Picture</label>
                                            <input type="file" name="fileToUpload" placeholder="Choose Picture"/>
                                            <small class="form-text text-muted">Select picture of the product (JPG or JPEG)</small>
                                        </div>
                                       
                                        <button type="submit" class="btn btn-success">Save</button>
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
        if(isset($_POST['materialupload'])){
            $imagename = ($article['image'] ?? null);
            $menu_name = ($_POST['menu_name'] ?? '');
            $menu_stock = ($_POST['menu_stock'] ?? '');
            $menu_price = ($_POST['menu_price'] ?? '');
            $menu_category = ($_POST['menu_category'] ?? '');

            if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["size"])){
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

                if(!$check) {
                    echo "File is not an image."; exit;
                }

                if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                    // echo "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
                }else{
                    echo "Sorry, there was an error uploading your file.";
                }

                $imagename = $_FILES["fileToUpload"]["name"];
            }

            if(isset($_GET['id'])){
                runQuery("UPDATE `menu` SET `name` = '$menu_name', `image` = '$imagename', `category` = '$menu_category', `price` = '$menu_price', `in_stock` = '$menu_stock' WHERE `menu`.`id` = ".$_GET['id']);

                ToastMessage('Success', 'Product Saved', 'success', 'admin-product.php');
            }else{
                runQuery("INSERT INTO `menu` (`id`, `name`, `category`, `image`, `price`, `in_stock`, `is_active`) VALUES (NULL, '$menu_name', '$menu_category', '$imagename', '$menu_price', '$menu_stock', '1')");

                ToastMessage('Success', 'Product Added', 'success', 'admin-product.php');
            }
        }
    ?>
</body>
</html>