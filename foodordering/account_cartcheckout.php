<?php
    include 'config.php';

    $cartIDStore = [];
    $allcartMenu = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);

    if(empty($allcartMenu)){
        header("Location: account_cart.php");
        exit();
    }

    foreach($allcartMenu as $m){
        $cartIDStore[] = $m['menu'];

        runQuery("DELETE FROM `user_cart` WHERE `user_cart`.`id`=".$m['id']);
    }

    $FourDigitRandomNumber = rand(1231,7879);
    $profiledata = fetchRow("SELECT * FROM login WHERE id = ".$_SESSION['account_session']);

    runQuery("INSERT INTO `user_order` (`id`, `user_id`, `menu_id`, `status`, `unique_number`) VALUES (NULL, '".$_SESSION['account_session']."', '".json_encode($cartIDStore)."', '1', '$FourDigitRandomNumber')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <div class="w-full flex align-items-center justify-content-center flex-column">
        <h3 class="capitalize text-green-600">Order successfully added!</h3>
        <h4 class="capitalize">Your order number is</h4>
        <h1><?php echo $FourDigitRandomNumber; ?></h1>

        <table>
            <tbody>
                <tr>
                    <td class="px-3 font-bold uppercase">Name</td>
                    <td class="uppercase"><?php echo $profiledata['name'];?></td>
                </tr>
                <tr>
                    <td class="px-3 font-bold uppercase">Phone</td>
                    <td class="uppercase"><?php echo $profiledata['phone'];?></td>
                </tr>
            </tbody>
        </table>

        <h4 class="w-20rem line-height-3 text-center">please show your order number at the counter to pickup your food</h4>
        <a href="account_cart.php">
            <button class="cursor-pointer hover:bg-blue-500 bg-blue-600 text-0 border-noround px-3 py-2 border-1 border-blue-600">DONE</button>
        </a>
    </div>
</body>
</html>