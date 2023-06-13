<?php
    include 'config.php';

    $collection = [];
    $userAuth = ($_SESSION['login_session']);

    if($userAuth->type != 1){
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
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Manage</strong> Equipment</h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
							<a href="admin-add-equipment.php" class="btn btn-primary">Register Equipment</a>
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
                                        <table id="table-content" class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="shadow-1 border-1">
                                                    <th align="center">No.</th>
                                                    <th align="left">Type</th>
                                                    <th align="left">Name</th>
                                                    <th align="left">Publisher</th>
                                                    <th align="left">Status</th>
                                                    <th align="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $userrecord = fetchRows("SELECT * FROM equipment");

                                                foreach($userrecord as $key => $value){
                                                    $profile = fetchRow("SELECT * FROM login WHERE id = ".$value['publisher']);
                                                    $statusTag = '<span class="badge badge-success-light">Available</span>';

                                                    if($value['status'] == 0){
                                                        $statusTag = '<span class="badge badge-danger-light">Not Available</span>';
                                                    }
                                            ?>

                                                <tr>
                                                    <td align="center"><?php echo ($key + 1); ?></td>
                                                    <td align="left"><?php echo $value['type']; ?></td>
                                                    <td align="left"><?php echo $value['name']; ?></td>
                                                    <td align="left">
                                                        <span class="badge bg-secondary">
                                                            <?php echo $profile['name']; ?>
                                                        </span>
                                                    </td>
                                                    <td align="left"><?php echo $statusTag; ?></td>
                                                    <td align="left">
                                                        <a href="./admin-add-equipment.php?id=<?php echo $value['id']; ?>">
                                                            <i class="align-middle" data-feather="edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $("#table-content").DataTable({
                responsive: false
            });
        });
    </script>
</body>
</html>