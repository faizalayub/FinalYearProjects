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
        $category = $_POST['category'];
        $genres = $_POST['genres'];
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

        if(isset($_GET['id'])){
            runQuery("UPDATE `article` SET `headline` = '$title', `content` = '$content', `image` = '$imagename', `category` = '$category', `is_restricted` = '$underage', `genres` = '$genres' WHERE `article`.`id` = ".$_GET['id']);

            echo "<script>alert('Content Updated!');</script>";
            echo "<script>window.location.href='article_list.php'</script>";
        }else{
            runQuery("INSERT INTO `article` (`id`, `headline`, `content`, `category`, `is_restricted`, `image`, `posted_by`, `genres`) VALUES (NULL, '$title', '$content', '$category', '$underage', '$imagename', '".$_SESSION['account_session']."', '$genres')");

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
                echo 'Upload Material';
            }else{
                echo 'Edit Material Content';
            }
        ?>
    </h3>

    <form method="POST" enctype="multipart/form-data"  class="flex align-items-center justify-content-center">
        <input type="hidden" name="materialupload"/>

        <table cellpadding="10">
            <?php if(isset($_GET['id'])){ ?>
            <tr>
                <td colspan="2">
                    <img style="object-fit: contain;" src="images/<?php echo (!empty($article['image']) ? $article['image'] : ''); ?>" class="w-full h-30rem"/>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td>Genres</td>
                <td>
                    <select class="w-25rem" required name="genres" placeholder="Select Genres">
                        <option value="">Nothing Selected</option>
                        <?php
                            $genres = fetchRows("SELECT * FROM genres");

                            foreach($genres as $c){
                                echo '<option '.(!empty($article['category']) && $article['category'] == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>


            <tr>
                <td>Sections</td>
                <td>
                    <select class="w-25rem" required name="category" placeholder="Select Category">
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
                <td>Title</td>
                <td>
                    <input required class="w-25rem" type="text" name="title" placeholder="Enter Title" value="<?php echo (!empty($article['headline']) ? $article['headline'] : ''); ?>"/>
                </td>
            </tr>

            <tr>
                <td>Picture</td>
                <td>
                    <input type="file" name="fileToUpload" placeholder="Choose Picture" class="w-25rem"/>
                </td>
            </tr>

            <tr>
                <td>Content</td>
                <td>
                    <textarea rows="30" class="w-25rem" required name="content" placeholder="Enter Content"><?php echo (!empty($article['content']) ? $article['content'] : ''); ?></textarea>
                </td>
            </tr>

            <tr>
                <td colspan=2>
                    <input type="checkbox" id="underage" name="underage" value="1">
                    <label for="underage">Content suitable only ages 18 and up</label>
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