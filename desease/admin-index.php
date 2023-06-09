<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
        header("Location: login-account.php");
        exit();
    }

    $usersData = fetchRows("SELECT * FROM `login` WHERE type=2");
    $diseaseData = fetchRows("SELECT * FROM `possible_disease`");
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

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Admin</strong> Dashboard</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START User table list -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
                            <div class="card">
								<div class="card-header pb-0">
									<h5 class="card-title">Registered Users</h5>
								</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>MyKad Number</th>
                                                <th>Birthday Date</th>
                                                <th>Full Name</th>
                                                <th>Age</th>
                                                <th>Category of Health Concern</th>
                                                <th>Experienced Symptom</th>
                                                <th>Mobile Number</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($usersData)){
                                                    foreach($usersData as $key => $value){
                                                        echo '
                                                        <tr>
                                                            <td>'.$value['email'].'</td>
                                                            <td>'.$value['ic'].'</td>
                                                            <td>'.date("Y-m-d", strtotime($value['birthdate'])).'</td>
                                                            <td>'.$value['name'].'</td>
                                                            <td>'.$value['age'].'</td>
                                                            <td>'.$value['healthyconcern'].'</td>
                                                            <td>'.$value['experience_syntom'].'</td>
                                                            <td>'.$value['phone'].'</td>
                                                            <td>'.$value['address'].'</td>
                                                        </tr>
                                                        ';
                                                    }
                                                }else{
                                                    echo '<tr><td colspan="4">No user yet</td></tr>';
                                                }
                                            ?>
                                        </tbody>
                                        <caption>Total records showing: <?php echo count($usersData); ?></caption>
                                    </table>
                                    </div>
							    </div>
							</div>
						</div>
					</div>
                    <!--#END User table list -->

                    <!--#START Disease Predictor -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
                            <div class="card">
								<div class="card-header pb-0">
									<h5 class="card-title">Recommender List</h5>
								</div>
								<div class="card-body">
                                    <ul class="list-group mb-4">
                                        <?php
                                            if(!empty($diseaseData)){
                                                foreach($diseaseData as $key => $value){
                                                    $diseaseList = '';

                                                    $disease = json_decode($value['possible'] ?? []);
                                                    $body = json_decode($value['body'] ?? []);
                                                    $syntom = json_decode($value['syntom'] ?? []);

                                                    foreach($disease as $c){
                                                        $diseaseList .= '<li style="white-space: pre-line;">'.$c.'</li>';
                                                    }

                                                    echo '
                                                    <li class="list-group-item d-flex w-100 gap-3">
                                                        <span class="stat">
                                                            <i class="align-middle" data-feather="activity"></i>
                                                        </span>
                                                        <ol class="p-0 m-0 px-3" style="flex: 1;">'.$diseaseList.'</ol>
                                                        <div class="d-flex flex-column">
                                                            <span class="text-muted">Total symptoms: '.count($body) + count($syntom).'</span>
                                                            <a href="admin-recommender.php?id='.$value['id'].'" class="btn btn-primary">Update Symptoms</a>
                                                        </div>
                                                    </li>';
                                                }
                                            }else{
                                                echo 'No record found';
                                            }
                                        ?>
                                    </ul>
                                </div>
							</div>
						</div>
					</div>
                    <!--#END Disease Predictor -->

                </div>
            </main>

            <?php include 'inc/footer.php'; ?>
        </div>
    </div>
</body>
</html>