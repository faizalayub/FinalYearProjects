<?php
    include 'config.php';

    if(!isset($_SESSION['staff_session']) && !isset($_SESSION['customer_session'])){
        header("Location: auth-login.php");
        exit();
    }

    $collection = [];
    $user = null;
    $goBack = '';
    $defaultAddress = 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh';
    $placeholder_payername = '';
    $placeholder_payerphone = '';

    if(isset($_SESSION['staff_session'])){
        $goBack = './user-index.php';
        $user = $_SESSION['staff_session'];
    }

    if(isset($_SESSION['customer_session'])){
        $goBack = './user-menu.php';
        $user = $_SESSION['customer_session'];

        $customerdata = fetchRow("SELECT * FROM `login` WHERE id = '$user'");
        $placeholder_payername = ($customerdata['name']);
        $placeholder_payerphone = ($customerdata['phone']);

        if($customerdata['type'] == 4){
            $goBack = '';
        }
    }

    $sizeChart = array(
        array( 'size'=> 'Hot' ),
        array( 'size'=> 'Cold' ),
        array( 'size'=> 'Warm' )
    );
    
    foreach($sizeChart as $_){
        $size = ($_['size']);
        $items = fetchRows("SELECT * FROM `menu`");

        foreach($items as $p){
            $ids = ($p['id']);
            $cartcollection = fetchRows("SELECT * FROM `user_cart` WHERE `size` = '".$size."' AND `menu` = '".$ids."' AND `user` = '".$user."'");
            $totalcart = (count($cartcollection));

            if($totalcart > 0){
                $trolleyID = [];
                $categoryinfo = [];

                foreach($cartcollection as $m){
                    $trolleyID[] = ($m['id']);
                }

                if(!empty($p['category'])){
                    $categoryinfo = fetchRow("SELECT * from `category` WHERE id = ".$p['category']);
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
                    'subtotal'    => (($p['price'] ?? 0) * $totalcart)
                ];

            }
        }
    }

    if(isset($_POST['pay_cash'])){
        $delivery_method = ($_POST['delivery_method'] ?? '');
        $delivery_address = ($_POST['delivery_address'] ?? '');
        $customer_name = ($_POST['customer_name'] ?? '');
        $customer_phone = ($_POST['customer_phone'] ?? '');

        if($delivery_method == 1){
            $delivery_address = $defaultAddress;
        }

        echo "<script>window.location.href = `user-cart-final.php?phone=".$customer_phone."&name=".$customer_name."&method=".$delivery_method."&address=".$delivery_address."`;</script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'header.php'; ?>

    <?php
    if(isset($_SESSION['customer_session']) && $customerdata['type'] == 4){
        echo '<style>.customer-info{ display: none !important; }</style>';
    }
    ?>
</head>
<body>
    <div class="wrapper">

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <?php
                        if(!empty($accountData) && $accountData['type'] == 2){
                            echo '
                            <div class="row mb-2 mb-xl-3">
                                <div class="col-auto d-none d-sm-block">
                                    <h3>Welcome back, '.$accountData['name'].'</h3>
                                </div>
                            </div>';
                        }
                    ?>
                    <!--#END HEADER -->

                    <!--#START CONTENT -->
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">

                            <!--#START Table -->
                            <div class="row">
                                <div class="col-xl-12 col-xxl-12">

                                    <div class="card flex-fill w-100">
                                        <div class="card-header">
                                            <h1 class="h3">Menu Cart</h1>
                                        </div>
                                        <div class="card-body pt-0 pb-0">
                                            <form method="POST">
                                                <table class="table table-striped table-bordered">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Name</th>
                                                        <th>Total</th>
                                                        <th>Size</th>
                                                        <th>Price</th>
                                                        <th>Category</th>
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

                                                            <tr class="customer-info">
                                                                <td colspan="'.$totalCol.'">
                                                                    <label class="form-label fw-bold">Customer Name</label>
                                                                    <input type="text" name="customer_name" class="form-control" placeholder="Enter customer name" required value="'.$placeholder_payername.'" />
                                                                </td>
                                                            </tr>

                                                            <tr class="customer-info">
                                                                <td colspan="'.$totalCol.'">
                                                                    <label class="form-label fw-bold">Customer Phone</label>
                                                                    <input type="text" name="customer_phone" class="form-control" placeholder="Enter customer phone" required value="'.$placeholder_payerphone.'" />
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="'.$totalCol.'">
                                                                    <div class="d-flex justify-content-end">
                                                                        <input type="hidden" name="delivery_address" value=""/>
                                                                        <input type="hidden" name="delivery_method" value="1"/>
                                                                        <input type="submit" name="pay_cash" value="Order Now" class="btn btn-primary" />
                                                                    </div>
                                                                </td>
                                                            </tr>';
                                                        }
                                                    ?>

                                                </table>
                                            </form>
                                        </div>
                                        <div class="card-footer pt-0">
                                            <?php if($goBack != ''){ ?>
                                            <a href="<?php echo $goBack; ?>" type="button" class="btn btn-secondary">Go Back</a>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--#END Table -->
                            
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <!--#END CONTENT -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>