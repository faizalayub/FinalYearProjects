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
                            <h3><strong>Manage</strong> Student</h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
							<a href="admin-add-student.php" class="btn btn-primary">Invite Student</a>
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
                                                    <th align="left">Student ID</th>
                                                    <th align="left">Picture</th>
                                                    <th align="left">Phone</th>
                                                    <th align="left">Name</th>
                                                    <th align="left">Email</th>
                                                    <th align="left">Address</th>
                                                    <th align="center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                    $userrecord = fetchRows("SELECT * FROM login WHERE type = 3 ORDER BY type DESC");

                                                    foreach($userrecord as $key => $value){
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo ($key + 1); ?></td>
                                                    <td align="left"><?php echo $value['studentID']; ?></td>
                                                    <td align="left">
                                                        <img
                                                            src="<?php echo (!empty($value['picture']) ? 'images/'.$value['picture'] : 'img/default_avatar.jpeg');?>"
                                                            width="48"
                                                            height="48"
                                                            class="rounded-circle me-2"
                                                            alt="Avatar">
                                                    </td>
                                                    <td align="left"><?php echo $value['phone']; ?></td>
                                                    <td align="left"><?php echo $value['name']; ?></td>
                                                    <td align="left"><?php echo $value['email']; ?></td>
                                                    <td align="left"><?php echo (!empty($value['address']) ? $value['address'] : '-'); ?></td>
                                                    <td align="left">
                                                        <a href="./admin-add-student.php?id=<?php echo $value['id']; ?>">
                                                            <i class="align-middle" data-feather="edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            
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