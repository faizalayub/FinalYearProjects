<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_session'])){
        header("Location: login.php");
        exit();
    }

    if(isset($_POST['pay_cash'])){
        $defaultAddress   = 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh';
        $delivery_method  = 1;
        $delivery_address = ($_POST['delivery_address'] ?? '');

        if($delivery_method == 1){
            $delivery_address = $defaultAddress;
        }

        echo "<script>window.location.href = `user-cart-final.php?method=".$delivery_method."&address=".$delivery_address."`;</script>";
        exit;
    }
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

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>My Order Cart</strong> List</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chart -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Table -->
								<div class="card-body pt-3 pb-3">
                                    
                                    <form method="POST">
                                        <table class="table table-striped table-bordered">
                                            <tr>
                                                <th>Product</th>
                                                <th>Name</th>
                                                <th>Total</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>

                                            <?php
                                                $allCartCollection = [];
                                                $totalPrice = 0;
                                                $showed = 0;
                                                $menurecord = fetchRows("SELECT * FROM menu");

                                                foreach($menurecord as $key => $value){
                                                    
                                                    $cartIDStore = [];
                                                    $categoryname = fetchRow("SELECT * from category WHERE id = ".$value['category']);
                                                    $totalCart = numRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']." AND menu=".$value['id']);

                                                    if($totalCart == 0){
                                                        continue;
                                                    }

                                                    $allcartMenu = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']." AND menu=".$value['id']);

                                                    foreach($allcartMenu as $m){
                                                        $cartIDStore[] = $m['id'];
                                                    }

                                                    $showed++;

                                                    $totalPrice = ($totalPrice + ($value['price'] * $totalCart));

                                                    $allCartCollection[] = array(
                                                        'id' => $value['id'],
                                                        'quantity' => $totalCart,
                                                    );
                                            ?>
                                                <tr>
                                                    <td align="center">
                                                        <img src="images/<?php echo $value['image']; ?>" class="img img-bordered img-responsive" height="80"/>
                                                    </td>

                                                    <td align="center">
                                                        <?php echo $value['name']; ?>
                                                    </td>

                                                    <td align="center">
                                                        <div class="w-full flex align-items-center justify-content-center gap-3 surface-100 py-2">
                                                            <a href="user-cart-amount-switch.php?action=minus&id=<?php echo $value['id']; ?>" class="no-underline p-2 surface-500 text-0 font-bold cursor-pointer border-round">-</a>
                                                            <span><?php echo $totalCart; ?></span>
                                                            <a href="user-cart-amount-switch.php?action=add&id=<?php echo $value['id']; ?>" class="no-underline p-2 surface-500 text-0 font-bold cursor-pointer border-round">+</a>
                                                        </div>
                                                    </td>

                                                    <td align="center">
                                                        <div class="flex align-items-center gap-3">
                                                            <span class="font-bold white-space-nowrap">RM <?php echo $value['price']; ?></span>
                                                            <span>x</span>
                                                            <span class="text-500"><?php echo $totalCart; ?></span>
                                                            <span class="text-500">=</span>
                                                            <span class="text-500 white-space-nowrap">RM <?php echo $value['price'] * $totalCart; ?></span>
                                                        </div>
                                                    </td>

                                                    <td align="center">
                                                        <?php echo $categoryname['name']; ?>
                                                    </td>

                                                    <td align="center">
                                                        <div class="w-full flex flex-column gap-2">
                                                            <a href="account_cartremove?id=<?php echo implode(',',$cartIDStore); ?>" class="btn btn-danger">
                                                                <i class="align-middle" data-feather="trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                            
                                            <?php
                                                if(empty($showed)){
                                                    echo '<tr>';
                                                    echo '<td class="p-3" colspan="6">No Item Yet</td>';
                                                    echo '</tr>';
                                                }else{
                                                    echo '
                                                        <tr>
                                                            <th colspan="6" class="text-right p-3 surface-0">
                                                                Total Price : RM <?php echo $totalPrice; ?>
                                                            </th>
                                                        </tr>
                            
                                                        <tr>
                                                            <td colspan="6">
                                                                <label class="w-full font-normal text-left pb-2">Delivery Address</label>
                                                                <textarea name="delivery_address" class="form-control">'.$profiledata['address'].'</textarea>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="6">
                                                                <input type="submit" name="pay_cash" value="Cash On Delivery" class="btn btn-primary" />
                                                            </td>
                                                        </tr>
                                                    ';
                                                }
                                            ?>

                                        </table>
                                    </form>

								</div>
                                <!--#END Table -->

							</div>
						</div>
					</div>
                    <!--#END Sales Chart -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>