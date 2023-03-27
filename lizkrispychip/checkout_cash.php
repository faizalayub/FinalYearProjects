<?php
    include 'config.php';

    if(!isset($_GET['method'])){
        header("Location: account_cart");exit();
    }

    if(!isset($_GET['address'])){
        header("Location: account_cart");exit();
    }

    $methodID = ($_GET['method'] == 1 ? 'Pick-Up' : 'Delivery');
    $addressID = $_GET['address'];
    $cartIDStore = [];
    $allcartMenu = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);

    if(empty($allcartMenu)){
        header("Location: account_cart");
        exit();
    }

    foreach($allcartMenu as $m){
        $cartIDStore[] = $m['menu'];

        runQuery("DELETE FROM `user_cart` WHERE `user_cart`.`id`=".$m['id']);
    }

    $FourDigitRandomNumber = rand(1231,7879);
    $profiledata = fetchRow("SELECT * FROM login WHERE id = ".$_SESSION['account_session']);

    runQuery("INSERT INTO `user_order` (`id`, `user_id`, `menu_id`, `status`, `unique_number`, `address`, `payment_method`, `delivery_method`) VALUES (NULL, '".$_SESSION['account_session']."', '".json_encode($cartIDStore)."', '1', '$FourDigitRandomNumber', '$addressID', '2', '".$_GET['method']."')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <div class="w-full flex align-items-center justify-content-center flex-column py-8">
        <h3 class="capitalize text-green-600">We have received your order, Thank You!</h3>
        <h4 class="m-0 capitalize">Here is your order number</h4>
        <h1><?php echo $FourDigitRandomNumber; ?></h1>

        <table class="w-30rem">
            <tbody>
                <tr class="py-3">
                    <td class="px-3 font-bold uppercase">Payment Method</td>
                    <td class=""><?php echo $methodID;?></td>
                </tr>
                <tr class="py-3">
                    <td class="px-3 font-bold uppercase">Name</td>
                    <td class=""><?php echo $profiledata['name'];?></td>
                </tr>
                <tr class="py-3">
                    <td class="px-3 font-bold uppercase">Phone</td>
                    <td class=""><?php echo $profiledata['phone'];?></td>
                </tr>
                <tr class="py-3">
                    <td class="px-3 font-bold uppercase">Address</td>
                    <td class=""><?php echo $addressID;?></td>
                </tr>
            </tbody>
        </table>

        <h4 class="w-20rem line-height-3 text-center">Please keep your order number, we will verify it later</h4>
        <a href="account_cart">
            <button class="cursor-pointer hover:bg-blue-500 bg-blue-600 text-0 border-noround px-3 py-2 border-1 border-blue-600">DONE</button>
        </a>
    </div>
</body>
</html>