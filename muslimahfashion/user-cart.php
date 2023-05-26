<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: login.php");
        exit();
    }

    $collection = [];
    $user = ($_SESSION['account_session']);
    $defaultAddress = 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh';

    $sizeChart = array(
        array( 'size'=> 'XS', 'Length'=> 27, 'Width'=> 16.5, 'Sleeve'=> 8, 'Weight'=> 40 ),
        array( 'size'=> 'S', 'Length'=> 28, 'Width'=> 18, 'Sleeve'=> 8.25, 'Weight'=> 50 ),
        array( 'size'=> 'M', 'Length'=> 29, 'Width'=> 20, 'Sleeve'=> 8.63, 'Weight'=> 60 ),
        array( 'size'=> 'L', 'Length'=> 30, 'Width'=> 22, 'Sleeve'=> 9.13, 'Weight'=> 70 ),
        array( 'size'=> 'XL', 'Length'=> 31, 'Width'=> 24, 'Sleeve'=> 9.63, 'Weight'=> 80 ),
        array( 'size'=> 'XXL', 'Length'=> 32, 'Width'=> 26, 'Sleeve'=> 10.25, 'Weight'=> 90 ),
        array( 'size'=> 'XXXL', 'Length'=> 33, 'Width'=> 28, 'Sleeve'=> 10.25, 'Weight'=> 100 )
    );

    foreach($sizeChart as $_){
        $size = ($_['size']);
        $items = fetchRows("SELECT * FROM `menu`");

        foreach($items as $p){
            $ids = ($p['id']);
            $cartcollection = fetchRows("SELECT * FROM `user_cart` WHERE `size` = '".$size."' AND `menu` = '".$ids."' AND `user` = ".$user);
            $totalcart = (count($cartcollection));

            if($totalcart > 0){
                $trolleyID = [];
                $categoryinfo = [];
                $typeinfo = [];

                foreach($cartcollection as $m){
                    $trolleyID[] = ($m['id']);
                }

                if(!empty($p['category'])){
                    $categoryinfo = fetchRow("SELECT * from `category` WHERE id = ".$p['category']);
                }

                if(!empty($p['body_type'])){
                    $typeinfo = fetchRow("SELECT * from `body_part` WHERE id = ".$p['body_type']);
                }

                $collection[] = (object) [
                    'cartid'      => ($trolleyID),
                    'productid'   => ($ids),
                    'productname' => ($p['name'] ?? ''),
                    'image'       => ($p['image'] ?? ''),
                    'quantity'    => ($totalcart),
                    'size'        => ($size),
                    'price'       => ($p['price'] ?? 0),
                    'category'    => ($categoryinfo['name'] ?? '-'),
                    'type'        => ($typeinfo['name'] ?? '-'),
                    'subtotal'    => (($p['price'] ?? 0) * $totalcart)
                ];

            }
        }
    }

    if(isset($_POST['pay_cash'])){
        $delivery_method = ($_POST['delivery_method'] ?? '');
        $delivery_address = ($_POST['delivery_address'] ?? '');

        if($delivery_method == 1){
            $delivery_address = $defaultAddress;
        }

        echo "<script>window.location.href = `user-cart-final.php?method=".$delivery_method."&address=".$delivery_address."`;</script>";
        exit;
    }

    if(isset($_POST['pay_online'])){
        $delivery_method = ($_POST['delivery_method'] ?? '');
        $delivery_address = ($_POST['delivery_address'] ?? '');

        if($delivery_method == 1){
            $delivery_address = $defaultAddress;
        }

        echo "<script>window.location.href = `checkout_online.php?method=".$delivery_method."&address=".$delivery_address."`;</script>";
        exit();
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
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>

                                            <?php
                                                $totalCol = 8;
                                                $totalPrice = 0;

                                                //# CART ITEMS
                                                if(!empty($collection)){
                                                    foreach($collection as $key => $item){
                                                        echo '
                                                        <tr>
                                                            <td align="center">
                                                                <img src="images/'.$item->image.'" class="img img-bordered img-responsive" height="80"/>
                                                            </td>
        
                                                            <td align="center">'.$item->productname.'</td>
        
                                                            <td align="center">
                                                                <div class="w-full flex align-items-center justify-content-center gap-3 surface-100 py-2">
                                                                    <a href="user-cart-amount-switch.php?action=minus&id='.$item->productid.'&size='.$item->size.'" class="no-underline p-2 surface-500 text-0 font-bold cursor-pointer border-round">-</a>
                                                                    <span>'.$item->quantity.'</span>
                                                                    <a href="user-cart-amount-switch.php?action=add&id='.$item->productid.'&size='.$item->size.'" class="no-underline p-2 surface-500 text-0 font-bold cursor-pointer border-round">+</a>
                                                                </div>
                                                            </td>
        
                                                            <td align="center">'.$item->size.'</td>
        
                                                            <td align="center">
                                                                <div class="flex align-items-center gap-3">
                                                                    <span class="font-bold white-space-nowrap">RM '.$item->price.'</span>
                                                                    <span>x</span>
                                                                    <span class="text-500">'.$item->quantity.'</span>
                                                                    <span class="text-500">=</span>
                                                                    <span class="text-500 white-space-nowrap">RM '.$item->subtotal.'</span>
                                                                </div>
                                                            </td>
        
                                                            <td align="center">'.$item->category.'</td>

                                                            <td align="center">'.$item->type.'</td>
        
                                                            <td align="center">
                                                                <div class="w-full flex flex-column gap-2">
                                                                    <a href="user-cart-remove-all.php?id='.implode(',', $item->cartid).'" class="btn btn-danger">
                                                                        <i class="align-middle" data-feather="trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>';

                                                        $totalPrice = ($totalPrice + $item->subtotal);
                                                    }
                                                }else{
                                                    echo '
                                                    <tr>
                                                        <td class="p-3" colspan="'.$totalCol.'">No Item Yet</td>
                                                    </tr>';
                                                }
                                                
                                                //# SUMMARY
                                                if(!empty($collection)){
                                                    echo '
                                                    <tr>
                                                        <th colspan="'.$totalCol.'" class="text-right p-3 surface-0">
                                                            Total Price : RM '.$totalPrice.'
                                                        </th>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="'.$totalCol.'">
                                                            <label class="form-label">Delivery Method</label>

                                                            <select name="delivery_method" class="form-control" required>
                                                                <option value="0" disabled="">Choose</option>
                                                                <option value="1">Pick-Up</option>
                                                                <option value="2" selected>Delivery</option>
                                                            </select>
                                                        </td>
                                                    </tr>

                                                    <tr id="delivery_address_field">
                                                        <td colspan="'.$totalCol.'" class="py-3">
                                                            <label class="form-label">Enter Delivery Address</label>
                                                            <textarea name="delivery_address" class="form-control" placeholder="Enter delivery address">'.$profiledata['address'].'</textarea>
                                                        </td>
                                                    </tr>

                                                    <tr id="pickup_address_field">
                                                        <td colspan="'.$totalCol.'" class="py-3">
                                                            <label class="form-label">Pickup Address</label>

                                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                                <div class="alert-message">
                                                                    <strong>Note: </strong> Kindly please pickup to the below address anytime
                                                                </div>
                                                            </div>

                                                            <address class="form-control">'.$defaultAddress.'</address>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="'.$totalCol.'">
                                                            <input type="submit" name="pay_cash" value="Cash On Delivery" class="btn btn-secondary" />
                                                            <input type="submit" name="pay_online" value="Online Transfer" class="btn btn-success"/>
                                                        </td>
                                                    </tr>';
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

    <script>
        let onChangeCallback = function(value){
            let addressField = document.querySelector('#delivery_address_field');
            let pickupField = document.querySelector('#pickup_address_field');

            if(value == 1){
                if(addressField) addressField.style.display = 'none';
                if(pickupField) pickupField.style.display = '';
            }else{
                if(addressField) addressField.style.display = '';
                if(pickupField) pickupField.style.display = 'none';
            }
        };

        if(document.querySelector('[name="delivery_method"]')){
            document.querySelector('[name="delivery_method"]').addEventListener('change', function(e){
                onChangeCallback(e.target.value);
            });
        }

        onChangeCallback(2);
    </script>
</body>
</html>