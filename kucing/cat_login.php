<?php
    include 'config.php';

    if(isset($_POST['login_account'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = fetchRow("SELECT * FROM `login` WHERE email = '$email' AND password = '$password'");

        if($result){
            switch($result['type']){
                case 1:
                    $_SESSION['account_admin'] = $result['id'];

                    echo "<script>alert('Successfully login');</script>";
                    echo "<script>window.location.href='admin_dashboard.php'</script>";
                break;
                case 2:
                    $_SESSION['account_session'] = $result['id'];

                    echo "<script>alert('Successfully login');</script>";
                    echo "<script>window.location.href='cat_dashboard.php'</script>";
                break;
            }
        }else{
            echo "<script>alert('Invalid credential');</script>";
            echo "<script>window.location.href='cat_login.php'</script>";
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
        <form method="POST" class="surface-0 border-round-3xl flex flex-column py-6 px-8 align-items-center justify-content-center gap-3">
            <img src="./asset/asset_10.jpeg" class="shadow-1 w-13rem h-13rem border-circle border-1 border-200" style="object-fit: cover;" />

            <input type="text" class="w-full border-3 border-800 border-round" placeholder="email" name="email"/>

            <input type="password" class="w-full border-3 border-800 border-round" placeholder="Password" name="password"/>
            
            <button type="submit" name="login_account" class="cursor-pointer border-1 surface-900 text-0 uppercase p-3 border-round-3xl w-full">Sign In</button>

            <a href="./cat_signup.php" class="text-600 cursor-pointer text-center no-underline">New user press here</a>
        </form>
    </div>
</body>
</html>