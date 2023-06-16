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
                            <h3><strong>Users</strong> List</h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
							<a href="admin-invite-user.php" class="btn btn-primary">Register Staff</a>
						</div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chart -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Table -->
								<div class="card-body pt-4 pb-3">

                                    <div class="table-responsive px-3">
                                        <table class="table table-bordered table-striped">
                                            <tr class="shadow-1 border-1">
                                                <th align="center">No.</th>
                                                <th align="left">Role</th>
                                                <th align="left">Phone</th>
                                                <th align="left">Name</th>
                                                <th align="left">Email</th>
                                                <th align="left">Address</th>
                                                <th align="left">Password</th>
                                                <th align="center">Action</th>
                                            </tr>

                                            <?php
                                                $userrecord = fetchRows("SELECT * FROM login WHERE `type` != 1 AND `type` != 4 ORDER BY `type` DESC");

                                                foreach($userrecord as $key => $value){
                                                    $roleType = '';
                                                    $actionButtons = '';

                                                    switch($value['type']){
                                                        case 2:
                                                            $roleType = '<span class="badge badge-success-light">Staff</span>';

                                                            $actionButtons = '
                                                            <a href="./admin-invite-user.php?id='.$value['id'].'"><button class="btn btn-primary btn-sm" type="button">Edit</button></a>
                                                            <form method="POST"><button class="btn btn-danger btn-sm" type="submit" name="action_delete" value="'.$value['id'].'">Delete</button></form>';
                                                        break;
                                                        case 3:
                                                            $roleType = '<span class="badge badge-primary-light">Customer</span>';

                                                            $actionButtons = 'None editable';
                                                        break;
                                                    }
                                            ?>
                                            <tr>
                                                <td align="center"><?php echo ($key + 1); ?></td>
                                                <td align="left"><?php echo $roleType; ?></td>
                                                <td align="left"><?php echo $value['phone']; ?></td>
                                                <td align="left"><?php echo $value['name']; ?></td>
                                                <td align="left"><?php echo $value['email']; ?></td>
                                                <td align="left"><?php echo (!empty($value['address']) ? $value['address'] : '-'); ?></td>
                                                <td align="left"><?php echo $value['password']; ?></td>
                                                <td align="left"><div class="d-flex gap-1"><?php echo $actionButtons; ?></div></td>
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