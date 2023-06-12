<?php
    include 'config.php';

    $collection = [];
    $userAuth = ($_SESSION['login_session']);
    $collection = [];
    $dataRecord = fetchRows("SELECT * FROM `article` WHERE `publisher` =".$userAuth->id);
    
    if(!empty($dataRecord)){
        foreach($dataRecord as $key => $value){

            $mypermission = fetchRow("SELECT * FROM `article_permission` WHERE `status` = 0 AND `article_id` = ".$value['id']);

            if(!empty($mypermission)){
                $collection[] = (object)[
                    'id' => $mypermission['id'],
                    'name' => $value['name'],
                    'type' => $value['type'],
                    'attachment' => $value['attachment'],
                    'owner' => $value['publisher'],
                    'requester' => fetchRow("SELECT `name` FROM `login` WHERE id = ".$mypermission['user_id'])
                ];
            }
        }
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
                            <h3><strong>Material</strong> Request</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chart -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Table -->
								<div class="card-body pt-4 pb-3">

                                    <div class="px-3">
                                        <div class="dropdown-menu mb-2" style="position:static;display:block;">
                                        <?php
                                            if(!empty($collection)){
                                                foreach($collection as $value){
                                                    echo '
                                                    <div class="px-3 py-1 d-flex">
                                                        <div class="d-flex flex-column gap-1 flex-grow-1">
                                                            <h4 class="m-0">'.$value->name.'</h4>
                                                            <span class="m-0 text-mute fw-bold">'.$value->type.'</span>
                                                            <i class="m-0 text-mute">'.$value->requester['name'].' has request to access you material</i>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <div class="btn-group" role="group" aria-label="Small button group">
                                                                <a href="list-request-material-update.php?status=1&id='.$value->id.'" type="button" class="btn btn-success">Approve</a>
                                                                <a href="list-request-material-update.php?status=0&id='.$value->id.'" type="button" class="btn btn-danger">Reject</a>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }
                                            }else{
                                                echo '<div class="dropdown-item disabled">No request yet</div>';
                                            }
                                        ?>
                                        </div>
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