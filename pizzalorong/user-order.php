<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: login.php");
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
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <!--#START Profile -->
                            <div class="row">
                                <div class="col-xl-12 col-xxl-12">
                                    <div class="card flex-fill w-100">

                                        <div class="card-header">
                                            <h1 class="h3">Customer Order</h1>
                                        </div>

                                        <div class="card-body pt-2 pb-3">
                                            <div class="table-responsive">
                                                <table class="w-100 table table-bordered table-striped">
                                                    <tr>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">No.</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Products</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Invoice Number</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Time</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Delivery</th>
                                                        <th class="py-2 surface-0 px-3 border-bottom-1 border-300 bg-yellow-400">Status</th>
                                                        <th class="py-2 surface-0 px-3 white-space-nowrap">Set Status</th>
                                                    </tr>

                                                    <?php
                                                        $counter = 0;
                                                        $userrecord = fetchRows("SELECT * FROM `user_order` WHERE user_id = ".$_SESSION['account_session']." ORDER BY created_date DESC");

                                                        foreach($userrecord as $key => $value){

                                                            $menuList = '<ol class="p-3 m-0">';
                                                            $menuorder = json_decode($value['menu_id']);
                                                            $menusize = json_decode($value['size']);

                                                            foreach($menuorder as $key => $m){
                                                                $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                                                $menuList .= "<li style='text-align: initial; padding: 0 .3rem;'>
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
                                                        <td class="py-2 surface-0 px-3 flex flex-column gap-2 align-items-center justify-content-center h-full">
                                                            <a class="white-space-nowrap no-underline" href="user-order-status.php?id=<?php echo $value['id']; ?>&status=2">Prepared</a> |
                                                            <a class="white-space-nowrap no-underline" href="user-order-status.php?id=<?php echo $value['id']; ?>&status=3">Ready</a> | 
                                                            <a class="white-space-nowrap no-underline" href="user-order-status.php?id=<?php echo $value['id']; ?>&status=4">Completed</a>
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