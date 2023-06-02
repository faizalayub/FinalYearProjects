<?php
    include 'config.php';

    $action = $_GET['action'];
    $menu = $_GET['menu'];
    $userid = $_SESSION['account_user'];

    $userdata = fetchRow("SELECT * FROM `login` WHERE id = ".$userid);

    runQuery("INSERT INTO `user_order` (`id`, `menu_id`, `payment_method`, `user_id`) VALUES (NULL, '".$menu."', '".$action."', '".$userid."')");
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
    <div class="surface-0 border-round-2xl h-full shadow-3 content-concreate-bg p-3">

        <!-- START Content-->
        <div class="h-full w-full flex align-items-center justify-content-center">

            <div class="h-full flex align-items-centet justify-content-center flex-column gap-4 p-3">
                <a href="user-shop.php" class="border-circle h-10rem w-10rem surface-0 p-4 flex align-items-center justify-content-center">
                    <img src="./asset/home.jpeg" class="h-8rem border-circle">
                </a>

                <a href="user-shop.php" class="text-800 no-underline border-circle h-10rem w-10rem surface-0 p-4 flex align-items-center justify-content-center text-8xl">
                    <?php echo substr($userdata['name'], 0, 1); ?>
                </a>

                <a href="user-shop.php" class="border-circle h-10rem w-10rem surface-0 p-4">
                    <img src="./asset/invoice.png" class="h-full w-full border-circle">
                </a>
            </div>

            <div class="h-full flex-1 flex align-items-center justify-content-center">
                <div class="border-3 border-600 border-round-3xl surface-0 p-6">
                    <table width="100%">
                        <tr><td align="center"><img src="asset/green-check.jpeg" height="200"/></td></tr>
                        <tr><td align="center" class="text-3xl">ORDER RECORDED!!!</td></tr>
                    </table>
                </div>
            </div>

            <div class="p-3 h-full flex align-items-center">
                <div class="surface-500 vertical-text p-3 text-center text-2xl">VISIT US AGAIN!!!</div>
            </div>
        </div>
        <!-- END Content-->

    </div>
</body>
</html>