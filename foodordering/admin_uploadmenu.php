<?php
    include 'config.php';

    if(!isset($_SESSION['account_admin'])){
        header("Location: account_login.php");
        exit();
    }

    if(isset($_GET['id'])){
        $article = fetchRow("SELECT * FROM menu WHERE id =".$_GET['id']);
    }

    if(isset($_POST['materialupload'])){
        $imagename = ($article['image'] ?? null);
        $menu_name = ($_POST['menu_name'] ?? '');
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
            runQuery("UPDATE `menu` SET `name` = '$menu_name', `image` = '$imagename', `category` = '$menu_category', `price` = '$menu_price' WHERE `menu`.`id` = ".$_GET['id']);

            echo "<script>alert('Menu Updated!');</script>";
            echo "<script>window.location.href='admin_dashboard.php'</script>";
        }else{
            runQuery("INSERT INTO `menu` (`id`, `name`, `category`, `image`, `price`, `in_stock`, `is_active`) VALUES (NULL, '$menu_name', '$menu_category', '$imagename', '$menu_price', '1', '1')");

            echo "<script>alert('Menu Added!');</script>";
            echo "<script>window.location.href='admin_dashboard.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <div class="sticky top-0 w-full flex align-items-center flex-column">
        <h1 class="m-0 p-0 w-full text-center bg-indigo-600 p-3 text-0" style="font-family: cursive;">Mawar Restaurant Admin</h1>
    </div>

    <div class="grid py-6">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="admin_dashboard.php" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-indigo-500">Manage Menu</li>
                </a>

                <a href="admin_order.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Order</li>
                </a>

                <a href="admin_userlist.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">User List</li>
                </a>

                <a href="account_logout.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Log Out</li>
                </a>
            </ol>
        </div>
        <div class="col-8">

            <div class="flex align-items-center justify-content-between p-3 surface-ground border-1 border-300">
                <h3 class="m-0 p-0">Create Menu</h3>

                <a href="admin_dashboard.php" class="no-underline">
                    <button class="py-2 px-3 bg-grey-600 text-700 border-grey-600 border-round hover:bg-grey-500 border-noround border-1 border-300 cursor-pointer">Go Back</button>
                </a>
            </div>

            <form class="w-full h-full surface-ground border-1 border-300 mt-3 py-3" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="materialupload"/>

                <table class="w-full">
                    <?php if(isset($_GET['id']) && !empty($article['image'])){ ?>
                        <tr>
                            <td colspan="2">
                                <img style="object-fit: contain;" src="images/<?php echo (!empty($article['image']) ? $article['image'] : ''); ?>" class="w-full h-10rem"/>
                            </td>
                        </tr>
                    <?php } ?>
            
                    <tr>
                        <td class="px-3">Name</td>
                        <td><input required type="text" name="menu_name" placeholder="Menu Name" class="w-25rem" value="<?php echo (!empty($article['name']) ? $article['name'] : ''); ?>"/></td>
                    </tr>

                    <tr>
                        <td class="px-3">Picture</td>
                        <td>
                            <input type="file" name="fileToUpload" placeholder="Choose Picture" class="w-25rem"/>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-3">Price</td>
                        <td><input required type="number" name="menu_price" placeholder="Menu Price" class="w-25rem" value="<?php echo (!empty($article['price']) ? $article['price'] : ''); ?>"/></td>
                    </tr>

                    <tr>
                        <td class="px-3">Category</td>
                        <td>
                            <select required name="menu_category" placeholder="Menu Category" class="w-25rem">
                                <option value="">Nothing Selected</option>
                                <?php
                                    $categories = fetchRows("SELECT * FROM category");

                                    foreach($categories as $c){
                                        echo '<option '.(!empty($article['category']) && $article['category'] == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <a href="admin_dashboard.php" class="no-underline">
                                <button type="button" class="py-2 px-3 bg-grey-600 text-700 border-grey-600 border-round hover:bg-grey-500 border-noround border-1 border-300 cursor-pointer">Go Back</button>
                            </a>
                            <input type="submit" value="Submit" class="py-2"/>
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
</body>
</html>