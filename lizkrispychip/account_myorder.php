<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: account_login.php");
        exit();
    }

    $totalCart = numRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <div class="grid py-8">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="account_dashboard" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">My Profile</li>
                </a>
                
                <a href="account_cart" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">My Cart <span class="text-sm py-1 px-2 border-round ml-auto bg-yellow-600 text-0"><?php echo $totalCart; ?></span></li>
                </a>

                <a href="account_myorder" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-yellow-500 flex align-items-center">My History</li>
                </a>
            </ol>
        </div>
        <div class="col-8">
            <div class="p-3 surface-200 border-1 border-300">
                <h3 class="m-0">My History</h3>
                
                <table class="w-full surface-0 mt-3">
                    <tr>
                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">No.</th>
                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Menu ID</th>
                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Order Number</th>
                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Order Time</th>
                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Delivery</th>
                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Payment</th>
                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Status</th>
                    </tr>

                    <?php
                        $userrecord = fetchRows("SELECT * FROM `user_order` WHERE user_id = ".$_SESSION['account_session']." ORDER BY status DESC");

                        foreach($userrecord as $key => $value){

                            $menuList = '<ul class="p-0 m-0">';
                            $menuorder = json_decode($value['menu_id']);

                            foreach($menuorder as $m){
                                $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                $menuList .= "<li class='text-left'>".$bobo['name']."</li>";
                            }

                            $menuList .= '</ul>';
                    ?>
                    <tr>
                        <td class="py-2 surface-0 px-3 text-center border-bottom-1 border-300"><?php echo ($key + 1); ?></td>
                        <td class="py-2 surface-0 px-3 text-center border-bottom-1 border-300 flex align-items-center justify-content-center"><?php echo $menuList; ?></td>
                        <td class="py-2 surface-0 px-3 text-center border-bottom-1 border-300"><?php echo $value['unique_number']; ?></td>
                        <td class="py-2 surface-0 px-3 text-center border-bottom-1 border-300"><?php echo date_format(date_create($value['created_date']),"d F Y h:i A"); ?></td>
                        <td class="py-2 surface-0 px-3 text-center border-bottom-1 border-300">
                            <?php
                                if($value['delivery_method'] == 1) echo 'Pick-Up';

                                if($value['delivery_method'] == 2) echo 'Delivery';
                            ?>
                        </td>
                        <td class="py-2 surface-0 px-3 text-center border-bottom-1 border-300">
                            <?php
                                if($value['payment_method'] == 1) echo 'Online Transfer';

                                if($value['payment_method'] == 2) echo 'Cash';
                            ?>
                        </td>
                        <td class="py-2 surface-0 px-3 text-center border-bottom-1 border-300">
                            <?php
                                if($value['status'] == 1) echo '<span class="text-700 font-italic">Pending</span>';

                                if($value['status'] == 2) echo '<span class="text-blue-700 font-italic">Preparing</span>';

                                if($value['status'] == 3) echo '<span class="text-blue-700 font-italic">Shipping</span>';

                                if($value['status'] == 4) echo '<span class="text-green-700 font-italic">Completed</span>';
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if(empty($userrecord)){ ?>
                    <tr><td class="p-3" colspan="6">No Record Yet</td></tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>