<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_session'])){
        header("Location: login.php");
        exit();
    }

    if(!isset($_GET['method'])){
        header("Location: user-cart.php");exit();
    }

    if(!isset($_GET['address'])){
        header("Location: user-cart.php");exit();
    }

    $methodID    = ($_GET['method'] == 1 ? 'Pick-Up' : 'Delivery');
    $addressID   = $_GET['address'];
    $cartIDStore = [];
    $allcartMenu = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);

    if(empty($allcartMenu)){
        header("Location: user-cart.php");
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
	<?php include 'header.php'; ?>
</head>
<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START content -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Body -->
								<div class="card-body pt-6 pb-6">
                                    <div class="w-full d-flex align-items-center justify-content-center flex-column py-8 gap-3">
                                        <h3 class="capitalize text-green-600">We have received your purchase, Thank You!</h3>
                                        <h4 class="m-0 capitalize">Here is your purchase number</h4>
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

                                        <h4 class="w-20rem line-height-3 text-center">Please keep your purchase number, we will verify it later</h4>
                                        <a href="user-history.php">
                                            <button class="btn btn-primary">DONE</button>
                                        </a>
                                    </div>
								</div>
                                <!--#END Body -->

							</div>
						</div>
					</div>
                    <!--#END content -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>