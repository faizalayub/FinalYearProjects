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
                                        <tr>
                                            <th>No.</th>
                                            <th>Kerepek</th>
                                            <th>Purchase Number</th>
                                            <th>Status</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>User Phone</th>
                                            <th>User Address</th>
                                            <th>Set Status As</th>
                                        </tr>

                                        <?php
                                            $userrecord = fetchRows("SELECT * FROM `user_order`");

                                            foreach($userrecord as $key => $value){

                                                $productList = '<ol>';
                                                $userdata = fetchRow("SELECT * FROM `login` WHERE id=".$value['user_id']);
                                                $menuorder = json_decode($value['menu_id']);

                                                foreach($menuorder as $m){
                                                    $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                                    $productList .= "<li>".$bobo['name']."</li>";
                                                }

                                                $productList .= '</ol>';
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo ($key + 1); ?></td>
                                            <td align="center"><?php echo $productList; ?></td>
                                            <td align="center"><?php echo $value['unique_number']; ?></td>
                                            <td align="center">
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
                                            <td align="center"><?php echo $userdata['name']; ?></td>
                                            <td align="center"><?php echo $userdata['email']; ?></td>
                                            <td align="center"><?php echo $userdata['phone']; ?></td>
                                            <td align="center"><?php echo $userdata['address']; ?></td>
                                            <td class="py-2 surface-0 px-3 flex flex-column gap-2 align-items-center justify-content-center h-full">
                                                <a class="white-space-nowrap no-underline" href="admin-order-status.php?id=<?php echo $value['id']; ?>&status=2">Preparing</a> |
                                                <a class="white-space-nowrap no-underline" href="admin-order-status.php?id=<?php echo $value['id']; ?>&status=3">Shipping</a> |
                                                <a class="white-space-nowrap no-underline" href="admin-order-status.php?id=<?php echo $value['id']; ?>&status=4">Completed</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                        <?php 
                                            if(empty($userrecord)){
                                                echo '<tr><td class="p-3" colspan="6">No Record Yet</td></tr>';
                                            }
                                        ?>
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