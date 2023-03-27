<?php
    include 'config.php';

    $article = null;

    if(!isset($_SESSION['account_session'])){
        header("Location: account_login.php");
        exit();
    }

    if(isset($_GET['id'])){
        $article = fetchRow("SELECT * FROM article WHERE id =".$_GET['id']);
    }

    if(isset($_POST['materialupload'])){
        $imagename = ($article['image'] ?? null);
        $readingmaterialname = ($article['image'] ?? null);

        $title = ($_POST['title'] ?? '');
        $content = htmlentities($_POST['content'] ?? '');
        $underage = ($_POST['underage'] ?? 0);

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

        if(isset($_FILES["readingMaterial"]) && !empty($_FILES["readingMaterial"]["size"])){
            $target_dir = "files/";
            $target_file = $target_dir . basename($_FILES["readingMaterial"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if(move_uploaded_file($_FILES["readingMaterial"]["tmp_name"], $target_file)){
                // echo "The file ". htmlspecialchars( basename($_FILES["readingMaterial"]["name"])). " has been uploaded.";
            }else{
                echo "Sorry, there was an error uploading your file.";
            }

            $readingmaterialname = $_FILES["readingMaterial"]["name"];
        }

        if(isset($_GET['id'])){
            runQuery("UPDATE `article` SET `headline` = '$title', `content` = '$content', `image` = '$imagename', `reading_path` = '$readingmaterialname' WHERE `article`.`id` = ".$_GET['id']);

            echo "<script>alert('Content Updated!');</script>";
            echo "<script>window.location.href='article_list.php'</script>";
        }else{
            runQuery("INSERT INTO `article` (`id`, `headline`, `content`, `image`, `posted_by`, `reading_path`) VALUES (NULL, '$title', '$content', '$imagename', '".$_SESSION['account_session']."', '$readingmaterialname')");

            echo "<script>alert('Content Added!');</script>";
            echo "<script>window.location.href='article_list.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <h3 class="text-center">
        <?php 
            if(!isset($_GET['id'])){
                echo 'Muat Naik Bahan';
            }else{
                echo 'Kemaskini Bahan';
            }
        ?>
    </h3>

    <form method="POST" enctype="multipart/form-data"  class="flex align-items-center justify-content-center">
        <input type="hidden" name="materialupload"/>

        <table cellpadding="10">
            <?php if(isset($_GET['id'])){ ?>
            <tr>
                <td colspan="2">
                    <b>Muka Hadapan :</b>
                    <br>
                    <hr>
                    <img style="object-fit: contain;" src="images/<?php echo (!empty($article['image']) ? $article['image'] : ''); ?>" class="w-full w-30rem border-3 border-0 shadow-1 border-round"/>
                    <br>
                    <br>
                    <br>
                    <b>Info :</b>
                    <hr>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td>Title</td>
                <td>
                    <input required class="w-25rem" type="text" name="title" placeholder="Enter Title" value="<?php echo (!empty($article['headline']) ? $article['headline'] : ''); ?>"/>
                </td>
            </tr>

            <tr>
                <td>Front Picture</td>
                <td>
                    <input type="file" name="fileToUpload" placeholder="Choose Picture" class="w-25rem"/>
                </td>
            </tr>

            <tr>
                <td>Reading Material</td>
                <td>
                    <input type="file" name="readingMaterial" placeholder="Choose File" class="w-25rem"/>
                </td>
            </tr>

            <tr>
                <td>Description</td>
                <td>
                    <textarea rows="10" class="w-25rem" required name="content" placeholder="Enter Content"><?php echo (!empty($article['content']) ? $article['content'] : ''); ?></textarea>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <input type="submit" value="Submit"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>