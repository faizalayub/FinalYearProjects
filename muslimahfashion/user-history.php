<?php
    include 'config.php';

    $collection = [];

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
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>My Purchase</strong> History</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Body Content -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Table -->
								<div class="card-body pt-4 pb-3">

                                    <table class="w-100 table table-bordered table-striped">
                                        <tr>
                                            <th>No.</th>
                                            <th>Menu ID</th>
                                            <th>Purchase Number</th>
                                            <th>Purchase Time</th>
                                            <th>Status</th>
                                        </tr>

                                        <?php
                                            $userrecord = fetchRows("SELECT * FROM `user_order` WHERE user_id = ".$_SESSION['account_session']." ORDER BY status DESC");

                                            foreach($userrecord as $key => $value){

                                                $menuList = '<ol>';
                                                $menuorder = json_decode($value['menu_id']);

                                                foreach($menuorder as $m){
                                                    $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                                    $menuList .= "<li>".$bobo['name']."</li>";
                                                }

                                                $menuList .= '</ol>';
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo ($key + 1); ?></td>
                                            <td align="center"><?php echo $menuList; ?></td>
                                            <td align="center"><?php echo $value['unique_number']; ?></td>
                                            <td align="center"><?php echo date_format(date_create($value['created_date']),"d F Y h:i A"); ?></td>
                                            <td align="center">
                                                <?php
                                                    if($value['status'] == 1) echo '<span class="badge bg-secondary">Pending</span>';

                                                    if($value['status'] == 2) echo '<span class="badge bg-primary">Preparing</span>';

                                                    if($value['status'] == 3) echo '<span class="badge bg-warning">Shipping</span>';

                                                    if($value['status'] == 4) echo '<span class="badge bg-success">Completed</span>';
                                                ?>
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
                                <!--#END Table -->

							</div>
						</div>
					</div>
                    <!--#END Body Content -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>