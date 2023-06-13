<?php
    include 'config.php';

    if(!isset($_SESSION['staff_session'])){
        header("Location: auth-login.php");
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

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3>Welcome back, <?php echo (!empty($accountData) ? $accountData['name'] : '') ?></h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START CONTENT -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <!--#START Profile -->
                            <div class="row">
                                <div class="col-xl-12 col-xxl-12">
                                    <div class="card flex-fill w-100">

                                        <div class="card-header">
                                            <h1 class="h3">Customer Order</h1>
                                        </div>

                                        <div class="card-body pt-2 pb-3">
                                            <div class="table-responsive">
                                                <table class="w-100 table table-bordered table-striped table-hover">
                                                    <tr>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">No.</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Products</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Invoice Number</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Time</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Delivery</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Status</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">PIC</th>
                                                        <th class="py-2 surface-0 px-3 white-space-nowrap">Set Status</th>
                                                    </tr>

                                                    <?php
                                                        $counter = 0;
                                                        $currentAuth = ($_SESSION['staff_session']);
                                                        $customers = fetchRows("SELECT `id` FROM `login` WHERE `type` = 3");
                                                        $customersID = [$currentAuth];

                                                        if(!empty($customers)){
                                                            foreach($customers as $cust){
                                                                $customersID[] = $cust['id'];
                                                            }
                                                        }

                                                        $customersID = implode(',',$customersID);
                                                        $userrecord = fetchRows("SELECT * FROM `user_order` WHERE `user_id` IN ($customersID) ORDER BY created_date DESC");

                                                        foreach($userrecord as $key => $value){

                                                            $menuList = '<ol class="p-3 m-0">';
                                                            $menuorder = json_decode($value['menu_id']);
                                                            $menusize = json_decode($value['size']);
                                                            $orderuser = fetchRow("SELECT * FROM `login` WHERE id = ".$value['user_id']);

                                                            if($orderuser['id'] == $currentAuth){
                                                                $orderuser['name'] = 'You'; 
                                                            }

                                                            foreach($menuorder as $key => $m){
                                                                $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                                                $menuList .= "
                                                                <li style='text-align: initial; padding: 0 .3rem;'>
                                                                    <span class='fw-bold'>".$menusize[$key]."</span> - ".$bobo['name']."
                                                                </li>";
                                                            }

                                                            $menuList .= '</ol>';
                                                            $counter++;
                                                    ?>
                                                    <tr>
                                                        <td class="py-2 surface-0 px-3 text-center border-bottom-1 border-300"><?php echo ($counter); ?></td>
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
                                                                if($value['status'] == 1){
                                                                    echo '<span class="badge bg-secondary">Preparing</span>';
                                                                }

                                                                if($value['status'] == 2){
                                                                    echo '<span class="badge bg-warning">Prepared</span>';
                                                                }

                                                                if($value['status'] == 3){
                                                                    echo '<span class="badge bg-success">Ready</span>';
                                                                }

                                                                if($value['status'] == 4){
                                                                    echo '<span class="badge me-1 my-1 bg-primary">Completed</span>';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td align="left" class="py-2 surface-0 px-3 border-bottom-1 border-300">
                                                            <?php
                                                                switch($orderuser['type']){
                                                                    case 1:
                                                                        echo '
                                                                        <span class="badge badge-secondary-light">Admin</span>
                                                                        <span class="text-mute">'.$orderuser['name'].'</span>';
                                                                    break;
                                                                    case 2:
                                                                        echo '
                                                                        <span class="badge badge-primary-light">Staff</span>
                                                                        <span class="text-mute">'.$orderuser['name'].'</span>';
                                                                    break;
                                                                    case 3:
                                                                        echo '
                                                                        <span class="badge badge-success-light">Customer</span>
                                                                        <span class="text-mute">'.$orderuser['name'].'</span>';
                                                                    break;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="py-2 surface-0 px-3 flex flex-column gap-2 align-items-center justify-content-center h-full">
                                                            <a class="white-space-nowrap no-underline" href="user-order-status.php?id=<?php echo $value['id']; ?>&status=2&pic=<?php echo $orderuser['id']; ?>&ordernumber=<?php echo $value['unique_number']; ?>">Prepared</a> |
                                                            <a class="white-space-nowrap no-underline" href="user-order-status.php?id=<?php echo $value['id']; ?>&status=3&pic=<?php echo $orderuser['id']; ?>&ordernumber=<?php echo $value['unique_number']; ?>">Ready</a> | 
                                                            <a class="white-space-nowrap no-underline" href="user-order-status.php?id=<?php echo $value['id']; ?>&status=4&pic=<?php echo $orderuser['id']; ?>&ordernumber=<?php echo $value['unique_number']; ?>">Completed</a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    
                                                    <?php
                                                        if(empty($userrecord)){
                                                            echo '
                                                            <tr>
                                                                <td class="p-3" colspan="6">No Record Yet</td>
                                                            </tr>';
                                                        }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card-footer pt-0">
                                            <a href="./user-index.php" type="button" class="btn btn-secondary">Go Back</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!--#END Profile -->
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <!--#END CONTENT -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>