<?php
    include 'config.php';

    if(isset($_GET['id'])){
        $article = fetchRow("SELECT * FROM menu WHERE id =".$_GET['id']);
    }

    if(isset($_POST['productupload'])){
        $imagename = ($article['image'] ?? null);
        $menu_name = ($_POST['menu_name'] ?? '');
        $menu_price = ($_POST['menu_price'] ?? '');
        $menu_description = addslashes($_POST['menu_description'] ?? '');

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
            runQuery("UPDATE `menu` SET `name` = '$menu_name', `image` = '$imagename', `price` = '$menu_price', `description` = '$menu_description' WHERE `menu`.`id` = ".$_GET['id']);

            echo "<script>alert('Product Updated!');</script>";
            echo "<script>window.location.href='admin-items.php'</script>";
        }else{
            runQuery("INSERT INTO `menu` (`id`, `name`, `image`, `price`, `description`, `is_active`) VALUES (NULL, '$menu_name', '$imagename', '$menu_price', '$menu_description', '1')");

            echo "<script>alert('Product Added!');</script>";
            echo "<script>window.location.href='admin-items.php'</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MAGICAL WATCHES OF M'SIA</title>

    <link rel="stylesheet" href="asset/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="asset/style.css">
    <link rel="stylesheet" href="asset/custom-style.css">
</head>
<body class="h-screen surface-0 p-8">
    <div class="surface-0 border-round-2xl h-full shadow-3 content-paper-bg p-3">
        <a href="./navigation-admin.php" class="p-3 surface-900 border-circle">
            <i class="fa fa-home text-0 text-6xl" aria-hidden="true"></i>
        </a>

        <!-- START Content-->
        <form method="POST" enctype="multipart/form-data" class="h-full w-full flex align-items-center justify-content-center flex-column gap-5">
            <div class="uppercase text-2xl bg-yellow-500 py-4 px-6 border-3 border-yellow-600 text-yellow-800 border-round-3xl h-1rem flex align-items-center justify-content-center">User Login Form</div>

            <div class="flex flex-column gap-3">
                <?php if(isset($_GET['id']) && !empty($article['image'])){ ?>
                    <img style="object-fit: contain;" src="images/<?php echo (!empty($article['image']) ? $article['image'] : ''); ?>" class="w-full h-10rem"/>
                <?php } ?>
                
                <div class="flex align-items-center gap-3">
                    <span class="uppercase w-10rem text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3">Name</span>
                    <input type="text" name="menu_name" class="uppercase text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3" autocomplete="off" value="<?php echo (!empty($article['name']) ? $article['name'] : ''); ?>" />
                </div>

                <div class="flex align-items-center gap-3">
                    <span class="uppercase w-10rem text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3">Picture</span>
                    <input type="file" name="fileToUpload" class="uppercase text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3" autocomplete="off" />
                </div>

                <div class="flex align-items-center gap-3">
                    <span class="uppercase w-10rem text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3">Price</span>
                    <input type="number" name="menu_price" class="uppercase text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3" autocomplete="off" value="<?php echo (!empty($article['price']) ? $article['price'] : ''); ?>" />
                </div>

                <div class="flex align-items-start gap-3">
                    <span class="uppercase w-10rem text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3">Description</span>
                    <textarea name="menu_description" rows="7" cols="30" class="uppercase text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3"><?php echo (!empty($article['description']) ? $article['description'] : ''); ?></textarea>
                </div>
            </div>

            <button name="productupload" type="submit" class="no-underline uppercase text-2xl bg-yellow-500 cursor-pointer py-2 px-6 h-4rem border-3 border-yellow-600 hover:border-yellow-800 border-circle border-3 text-yellow-900 flex align-items-center justify-content-center">Submit</button>
        </div>
        <!-- END Content-->


    </div>
</body>
</html>