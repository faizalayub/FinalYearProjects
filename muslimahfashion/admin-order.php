<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
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
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Order</strong> List</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chart -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Chart Canvas -->
								<div class="card-body pt-4 pb-3">

                                <div class="w-100 table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tr class="shadow-1 border-1">
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">No.</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">Status</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">Products</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">Order Number</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">Payment Receipt</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">Payment Method</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">Delivery Method</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">User Name</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">User Email</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">User Phone</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">User Address</th>
                                            <th class="py-2 surface-0 px-3 white-space-nowrap">Set Status As</th>
                                        </tr>

                                        <?php
                                            $indexing = 0;
                                            $userrecord = fetchRows("SELECT * FROM `user_order`");

                                            foreach($userrecord as $key => $value){

                                                $menuList = '<ol>';
                                                $userdata = fetchRow("SELECT * FROM `login` WHERE id=".$value['user_id']);
                                                $menuorder = json_decode($value['menu_id']);
                                                $menusize = json_decode($value['size']);

                                                foreach($menuorder as $key => $m){
                                                    $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                                    $menuList .= "<li style='text-align: initial; padding: 0 .3rem;'>
                                                        <span class='fw-bold'>".$menusize[$key]."</span> - ".$bobo['name']."
                                                    </li>";
                                                }

                                                $menuList .= '</ol>';
                                                $indexing++;
                                        ?>
                                        <tr>
                                            <td class="py-2 surface-0 px-3 white-space-nowrap">
                                                <?php echo $indexing; ?>.
                                            </td>
                                            <td class="py-2 surface-0 px-3">
                                                <?php
                                                    if($value['status'] == 1){
                                                        echo '<span class="badge bg-secondary">Pending</span>';
                                                    }

                                                    if($value['status'] == 2){
                                                        echo '<span class="badge bg-primary">Preparing</span>';
                                                    }

                                                    if($value['status'] == 3){
                                                        echo '<span class="badge bg-warning">Shipping</span>';
                                                    }

                                                    if($value['status'] == 4){
                                                        echo '<span class="badge me-1 my-1 bg-success">Completed</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td class="py-2 surface-0 px-3"><?php echo $menuList; ?></td>
                                            <td class="py-2 surface-0 px-3 text-center"><?php echo $value['unique_number']; ?></td>
                                            <td class="py-2 surface-0 px-3 text-center">
                                                <?php
                                                    if(!empty($value['payment_receipt'])){
                                                        echo '<a href="./images/'.$value['payment_receipt'].'" download>Download Receipt</a>';
                                                    }else{
                                                        echo '-';
                                                    }
                                                ?>
                                            </td>
                                            <td class="py-2 surface-0 px-3 text-center">
                                                <?php
                                                    if($value['payment_method'] == 1) echo 'Online Transfer';

                                                    if($value['payment_method'] == 2) echo 'Cash';
                                                ?>    
                                            </td>
                                            <td class="py-2 surface-0 px-3 text-center">
                                                <?php
                                                    if($value['delivery_method'] == 1) echo 'Pick-Up';

                                                    if($value['delivery_method'] == 2) echo 'Delivery';
                                                ?>
                                            </td>
                                            <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo $userdata['name']; ?></td>
                                            <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo $userdata['email']; ?></td>
                                            <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo $userdata['phone']; ?></td>
                                            <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo $userdata['address']; ?></td>

                                            <td class="py-2 surface-0 px-3 flex flex-column gap-2 align-items-center justify-content-center h-full">
                                                <a class="white-space-nowrap no-underline" href="admin-order-status.php?id=<?php echo $value['id']; ?>&status=2">Preparing</a> |
                                                <a class="white-space-nowrap no-underline" href="admin-order-status.php?id=<?php echo $value['id']; ?>&status=3">Shipping</a> | 
                                                <a class="white-space-nowrap no-underline" href="admin-order-status.php?id=<?php echo $value['id']; ?>&status=4">Completed</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                        <?php if(empty($userrecord)){ ?>
                                        <tr><td class="p-3" colspan="6">No Record Yet</td></tr>
                                        <?php } ?>
                                    </table>
                                </div>

								</div>
                                <!--#END Chart Canvas -->

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