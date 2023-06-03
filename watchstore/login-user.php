<?php
    include 'config.php';
    
    if(isset($_POST['login_submit'])){
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $result = fetchRow("SELECT * FROM `login` WHERE type = 2 AND email = '$email' AND password = '$password'");

        if(!empty($result)){
            $_SESSION['account_user'] = $result['id'];
            echo '<script>alert("Success");window.location.href="user-shop.php"</script>';
        }else{
            echo '<script>alert("Invalid credential, Please try again");window.location.href="login-user.php"</script>';
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
    <div class="surface-0 border-round-2xl h-full shadow-3 content-watch-bg p-3">

        <!-- START Content-->
        <form method="POST" class="h-full w-full flex align-items-center justify-content-center flex-column gap-6">
            <div class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3 w-8 h-5rem flex align-items-center justify-content-center">User Login Form</div>

            <div class="flex align-items-center gap-3 w-10">
                <span class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3">Username</span>
                <input type="text" name="login_email" placeholder="Enter username" class="cursor-pointer flex align-items-center justify-content-center text-2xl surface-500 py-4 px-6 flex-1 border-3 border-900 border-round-3xl" autocomplete="off" />
            </div>

            <div class="flex align-items-center gap-3 w-10">
                <span class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3">Password</span>
                <input type="password" name="login_password" placeholder="Enter password" class="cursor-pointer flex align-items-center justify-content-center text-2xl surface-500 py-4 px-6 flex-1 border-3 border-900 border-round-3xl" autocomplete="off" />
            </div>

            <div class="w-10 flex align-items-center justify-content-center">
                <button type="submit" name="login_submit" class="uppercase text-2xl surface-500 hover:surface-400 cursor-pointer py-4 px-6 h-10rem border-3 border-900 border-circle border-3 w-8 h-5rem flex align-items-center justify-content-center">Login</button>
            </div>
        </div>
        <!-- END Content-->

    </div>
</body>
</html>