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
                            <h3><strong>User</strong> List</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chart -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Table -->
								<div class="card-body pt-4 pb-3">

                                    <table class="table table-bordered table-striped">
                                        <tr class="shadow-1 border-1">
                                            <th align="center">No.</th>
                                            <th align="center">Name</th>
                                            <th align="center">Email</th>
                                            <th align="center">Phone</th>
                                            <th align="center">Address</th>
                                        </tr>

                                        <?php
                                            $userrecord = fetchRows("SELECT * FROM login WHERE type=2");

                                            foreach($userrecord as $key => $value){
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo ($key + 1); ?></td>
                                            <td align="center"><?php echo $value['name']; ?></td>
                                            <td align="center"><?php echo $value['email']; ?></td>
                                            <td align="center"><?php echo $value['phone']; ?></td>
                                            <td align="center"><?php echo (!empty($value['address']) ? $value['address'] : '-'); ?></td>
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
                    <!--#END Sales Chart -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>