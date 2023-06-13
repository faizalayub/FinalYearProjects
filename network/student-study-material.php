<?php
    include 'config.php';

    $collection = [];
    $userAuth = ($_SESSION['login_session']);

    if($userAuth->type != 3){
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
                            <h3><strong>Study</strong> Materials</h3>
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
                                                    <th align="left">Attachment</th>
                                                    <th align="left">Type</th>
                                                    <th align="left">Name</th>
                                                    <th align="left">Publisher</th>
                                                    <th align="left">Status</th>
                                                    <th align="center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $userrecord = fetchRows("SELECT * FROM article ORDER BY publisher DESC");

                                                foreach($userrecord as $key => $value){
                                                    $isOwner = ($value['publisher'] == $userAuth->id);
                                                    $statusTag = '<span class="badge badge-success-light">Active</span>';

                                                    $permission = fetchRow("SELECT * FROM `article_permission` WHERE `user_id` = ".$userAuth->id." AND `article_id` = ".$value['id']);
                                                    $publisherProfile = fetchRow("SELECT * FROM `login` WHERE `id` = ".$value['publisher']);

                                                    $editButton = '<a href="./student-add-material.php?id='.$value['id'].'"><i class="align-middle" data-feather="edit"></i></a>';
                                                    $attachmentButton = '<a target="_blank" href="images/'.$value['attachment'].'"><i class="align-middle" data-feather="paperclip"></i>'.$value['attachment'].'</a>';

                                                    if($value['is_active'] == 0){
                                                        $statusTag = '<span class="badge badge-danger-light">Inactive</span>';
                                                    }

                                                    if(!$isOwner){
                                                        $editButton = '-';

                                                        if(!empty($permission)){
                                                            if($permission['status'] == 0){
                                                                $editButton = 'Pending Approval';
                                                                $attachmentButton = '<span><i class="align-middle" data-feather="paperclip"></i>'.$value['attachment'].'</span>';
                                                            }
                                                        }else{
                                                            $editButton = '<a href="./student-request-material.php?id='.$value['id'].'&user='.$userAuth->id.'">Request Material</a>';
                                                            $attachmentButton = '<span><i class="align-middle" data-feather="paperclip"></i>'.$value['attachment'].'</span>';
                                                        }
                                                    }

                                                    echo '
                                                    <tr>
                                                        <td align="center">'.($key + 1).'</td>
                                                        <td align="left">'.$attachmentButton.'</td>
                                                        <td align="left">'.$value['type'].'</td>
                                                        <td align="left">'.$value['name'].'</td>
                                                        <td align="left">
                                                            <span class="badge bg-secondary">'.($isOwner ? 'you' : $publisherProfile['name']).'</span>
                                                        </td>
                                                        <td align="left">'.$statusTag.'</td>
                                                        <td align="left">'.$editButton.'</td>
                                                    </tr>';
                                                }
                                            ?>
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