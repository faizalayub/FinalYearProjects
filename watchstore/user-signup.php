<?php
    include 'config.php';
    
    if(isset($_POST['signup_submit'])){
        $username = $_POST['signup_username'];
        $phone    = $_POST['signup_phone'];
        $address  = $_POST['signup_address'];
        $email    = $_POST['signup_email'];
        $password = $_POST['signup_password'];

        $result = runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`) VALUES (NULL, '$username', '$email', '$password', '2', '$phone', '$address')");

        if(!empty($result)){
            echo '<script>alert("Success");window.location.href="login-user.php"</script>';
        }else{
            echo '<script>alert("Invalid credential, Please try again");window.location.href="user-signup.php"</script>';
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
            <div class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3 w-8 h-5rem flex align-items-center justify-content-center">Registration Form</div>

            <div class="flex align-items-center gap-3 w-10">
                <span class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3">Name</span>
                <input type="text" name="signup_username" placeholder="Enter username" class="cursor-pointer flex align-items-center justify-content-center text-2xl surface-500 py-4 px-6 flex-1 border-3 border-900 border-round-3xl" autocomplete="off" />
            </div>

            <div class="flex align-items-center gap-3 w-10">
                <span class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3">Phone</span>
                <input type="tel" name="signup_phone" placeholder="Enter Address" class="cursor-pointer flex align-items-center justify-content-center text-2xl surface-500 py-4 px-6 flex-1 border-3 border-900 border-round-3xl" autocomplete="off" />
            </div>

            <div class="flex align-items-center gap-3 w-10">
                <span class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3">Email</span>
                <input type="email" name="signup_email" placeholder="Enter Email" class="cursor-pointer flex align-items-center justify-content-center text-2xl surface-500 py-4 px-6 flex-1 border-3 border-900 border-round-3xl" autocomplete="off" />
            </div>

            <div class="flex align-items-center gap-3 w-10">
                <span class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3">Address</span>
                <input type="text" name="signup_address" placeholder="Enter Address" class="cursor-pointer flex align-items-center justify-content-center text-2xl surface-500 py-4 px-6 flex-1 border-3 border-900 border-round-3xl" autocomplete="off" />
            </div>

            <div class="flex align-items-center gap-3 w-10">
                <span class="uppercase text-2xl surface-500 py-4 px-6 border-3 border-900 border-round-3xl border-3">Password</span>
                <input type="password" name="signup_password" placeholder="Enter password" class="cursor-pointer flex align-items-center justify-content-center text-2xl surface-500 py-4 px-6 flex-1 border-3 border-900 border-round-3xl" autocomplete="off" />
            </div>

            <div class="w-10 flex align-items-center justify-content-center">
                <button type="submit" name="signup_submit" class="uppercase text-2xl surface-500 hover:surface-400 cursor-pointer py-4 px-6 h-10rem border-3 border-900 border-circle border-3 w-8 h-5rem flex align-items-center justify-content-center">Signup</button>
            </div>
        </div>
        <!-- END Content-->

    </div>
</body>
</html>