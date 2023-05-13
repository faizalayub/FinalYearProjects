<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
        header("Location: login-account.php");
        exit();
    }

    $mode = (isset($_GET['id']) ? 'update' : 'create');
    $dataset = fetchRows("SELECT * from syntom");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'inc/header.php'; ?>
</head>
<body>
    <div class="wrapper">
        <?php include 'inc/sidebar.php'; ?>

        <div class="main">
            <?php include 'inc/top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START Breadscum -->
                    <div class="row">
                        <div class="col-auto d-none d-sm-block">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="admin-recommender.php">Compute disease</a></li>
                                    <li class="breadcrumb-item active">Add update syntom</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--#END Breadscum -->

                    <!--#START Headline -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Manage</strong> syntom disease</h3>
                        </div>
                    </div>
                    <!--#END Headline -->

                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
                            <!--#START Form Added -->
                            <div class="card">
								<div class="card-header">
									<h5 class="card-title">Create new syntom prediction</h5>
									<h6 class="card-subtitle text-muted">Categorize the syntom base on body part</h6>
								</div>
								<div class="card-body">
									<form method="POST" class="row row-cols-md-auto align-items-center">
										<div class="col-12">
                                            <?php
                                                $inputvalue = '';
                                                if($mode == 'update'){
                                                    $info = fetchRow("SELECT * FROM syntom WHERE id =".$_GET['id']);
                                                    $inputvalue = ($info['name']);
                                                }
                                            ?>
											<label class="visually-hidden" for="add-body">Name</label>
											<input name="syntompart" type="text" class="form-control mb-2 me-sm-2" id="add-body" placeholder="Exp: Swallow" value="<?php echo $inputvalue; ?>">
										</div>

										<div class="col-12">
											<button type="submit" name="save-syntompart" class="btn btn-primary mb-2">
                                                <?php echo ($mode == 'create' ? 'Add' : 'Update'); ?>
                                            </button>

                                            <a class="btn btn-secondary mb-2 <?php echo ($mode == 'update' ? '' : 'd-none'); ?>" href="./admin-create-syntom.php">Cancel</a>
										</div>
									</form>
								</div>
							</div>
                            <!--#END Form Added -->
						</div>

                        <div class="col-xl-12 col-xxl-12">
                            <!--#START Table Content -->
							<div class="card">
                                <div class="card-body">
                                    <table class="table table-striped" id="table-dataset">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!empty($dataset)){
                                                foreach($dataset as $key => $value){
                                                    $deleteaction = '
                                                    <form method="POST">
                                                        <button class="btn" type="submit" name="action-delete" value="'.$value['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>
                                                    </form>';

                                                    $editction = '
                                                    <form method="POST">
                                                        <button class="btn" type="submit" name="action-update" value="'.$value['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></button>
                                                    </form>';

                                                    echo '
                                                    <tr>
                                                        <td>'.($key + 1).'</td>
                                                        <td>'.$value['name'].'</td>
                                                        <td class="table-action d-flex align-items-center gap-3">
                                                            '.$deleteaction.'
                                                            '.$editction.'
                                                        </td>
                                                    </tr>
                                                    ';
                                                }
                                            }else{
                                                echo '
                                                <tr>
                                                    <td colspan="3">No Record</td>
                                                </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
							</div>
                            <!--#END Table Content -->
						</div>
					</div>

                </div>
            </main>

            <?php include 'inc/footer.php'; ?>
        </div>
    </div>
    <?php
        if(isset($_POST['save-syntompart'])){
            $name = ($_POST['syntompart']);

            if($mode == 'create'){
                runQuery("INSERT INTO `syntom` (`id`, `name`) VALUES (NULL, '".$name."')");
            }

            if($mode == 'update'){
                runQuery("UPDATE `syntom` SET `name` = '".$name."' WHERE `syntom`.`id` =".$_GET['id']);
            }

            echo '<script>alert("Saved");window.location.href="admin-create-syntom.php"</script>';
        }

        if(isset($_POST['action-delete'])){
            $id = ($_POST['action-delete']);

           runQuery("DELETE FROM `syntom` WHERE `syntom`.`id`=".$id);

            echo '<script>alert("Syntom part deleted");window.location.href="admin-create-syntom.php"</script>';
        }

        if(isset($_POST['action-update'])){
            $id = ($_POST['action-update']);

            echo '<script>window.location.href="admin-create-syntom.php?id='.$id.'"</script>';
        }
    ?>

    <script src="./js/datatables.js"></script>
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Responsive
			$("#table-dataset").DataTable({
				responsive: true
			});
		});
    </script>
</body>
</html>