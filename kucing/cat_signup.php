<?php
    include 'config.php';

    if(isset($_POST['create_account'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if($confirmpassword == $password){
            runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`) VALUES (NULL, '$name', '$email', '$password', '2', '$phone', '$address')");

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
    
                runQuery("UPDATE `login` SET `picture`='$imagename' WHERE `email`='$email'");
            }

            echo "<script>alert('Account created successfully');</script>";
            echo "<script>window.location.href='cat_login.php'</script>";
        }else{
            echo "<script>alert('Password not match');</script>";
            echo "<script>window.location.href='cat_signup.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body class="h-screen m-0 p-0 w-full">
    <?php include './navigator.php'; ?>

    <div class="surface-300 w-full h-screen flex align-items-center justify-content-center">
        <form method="POST" enctype="multipart/form-data" class="surface-0 border-round-3xl flex flex-column pt-2 pb-6 px-8 align-items-center justify-content-center gap-3">
            <h2>Registration Form</h2>

            <span class="font-bold w-full">Profile Photo</span>

            <div class="w-full flex">
                <input type="file" class="w-full border-3 border-800 border-round" required name="fileToUpload"/>
            </div>

            <div class="w-full flex">
                <input type="text" class="w-full border-3 border-800 border-round" placeholder="Username" required name="name"/>
            </div>

            <div class="w-full flex gap-3">
                <input type="email" class=" border-3 border-800 border-round flex-1 px-3" placeholder="Email" required name="email"/>

                <input type="tel" class=" border-3 border-800 border-round flex-1 px-3" placeholder="Phone Number" required name="phone"/>
            </div>

            <div class="w-full flex">
                <input type="password" class="w-full border-3 border-800 border-round" placeholder="Password" required name="password"/>
            </div>

            <div class="w-full flex">
                <input type="password" class="w-full border-3 border-800 border-round" placeholder="Confirm Password" required name="confirmpassword"/>
            </div>

            <div class="w-full flex">
                <textarea class="w-full border-3 border-800 border-round" placeholder="Address" required name="address"></textarea>
            </div>
            
            <button type="submit" name="create_account" class="cursor-pointer border-1 surface-900 text-0 uppercase p-3 border-round-3xl w-full">Confirm</button>

            <a href="./cat_login.php" class="text-600 cursor-pointer text-center no-underline">To login press here</a>
        </form>
    </div>
</body>
</html>