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
                            <h3><strong>Category</strong> List</h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
							<a href="admin-categories-create.php" class="btn btn-primary">Add category</a>
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
                                            <th align="left">ID</th>
                                            <th align="left">Name</th>
                                            <th align="center">Action</th>
                                        </tr>

                                        <?php
                                            $userrecord = fetchRows("SELECT * FROM `category`");

                                            foreach($userrecord as $key => $value){
                                        ?>
                                        <tr>
                                            <td align="left"><?php echo $value['id']; ?></td>
                                            <td align="left"><?php echo $value['name']; ?></td>
                                            <td align="center">
                                                <div class="d-flex gap-1">
                                                    <a href="./admin-categories-create.php?id=<?php echo $value['id']; ?>">
                                                        <button class="btn btn-primary btn-sm" type="button">Edit</button>
                                                    </a>
                                                    <form method="POST">
                                                        <button class="btn btn-danger btn-sm" type="submit" name="action_delete" value="<?php echo $value['id']; ?>">Delete</button>
                                                    </form>
                                                </div>
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
                    <!--#END Sales Chart -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php 
        if(isset($_POST['action_delete'])){
            runQuery("DELETE FROM `category` WHERE `category`.`id` = ".$_POST['action_delete']);

            ToastMessage('Success', 'Category deleted!', 'success', 'admin-categories.php');
        }
    ?>
</body>
</html>