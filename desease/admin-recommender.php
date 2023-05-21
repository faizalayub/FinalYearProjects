<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
        header("Location: login-account.php");
        exit();
    }

    $mode = (isset($_GET['id']) ? 'update' : 'create');
    $bodylist = fetchRows("SELECT * from body");
    $syntomlist = fetchRows("SELECT * from syntom");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'inc/header.php'; ?>

    <style>
        .disease-list-possible:empty ~ .container-submit [type="submit"]{
            display: none;
        }
        
        .disease-list-possible:empty:after{
            content: 'No disease added'
        }
    </style>
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
                                    <li class="breadcrumb-item active">Compute disease</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--#END Breadscum -->

                    <!--#START Headline -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Computed</strong> Disease</h3>
                        </div>
                    </div>
                    <!--#END Headline -->

                    <!--#START Content -->
                    <div class="row">
						<div class="col-xl-8 col-xxl-8">
                            
                            <form method="POST" class="accordion" id="accordionExample">

                                <!--#STEP 1 -->
								<div class="card">
									<div class="card-header" id="headingOne">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#diseaseSelector" aria-expanded="false" aria-controls="diseaseSelector" class="collapsed">
												Step 1: Choose Body Part Of Symptom
											</a>
										</h5>
									</div>
									<div id="diseaseSelector" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
										<div class="card-body">
											<ol class="p-0 d-flex flex-column gap-2">
                                                <?php
                                                    if(!empty($bodylist)){
                                                        $bodypartValue = [];

                                                        if($mode == 'update'){
                                                            $bodypartDB = fetchRow("SELECT body FROM `possible_disease` WHERE id=".$_GET['id']);
                                                            $bodypartValue = json_decode($bodypartDB['body']);
                                                        }

                                                        foreach($bodylist as $key => $value){
                                                            $checked = (in_array($value['id'], $bodypartValue) ? 'checked' : '');

                                                            echo '
                                                            <li class="cursor-pointer border border-1 form-check d-flex align-items-center gap-3 p-0 bg-light rounded-3">
                                                                <input '.$checked.' name="possiblebody[]" class="cursor-pointer form-check-input p-3 ms-2 mt-0" type="checkbox" value="'.$value['id'].'" id="bodypart_'.$key.'">
                                                                <label class="cursor-pointer form-check-label py-3 text-lg fw-bold" for="bodypart_'.$key.'">'.$value['name'].'</label>
                                                            </li>';
                                                        }
                                                    }
                                                ?>
                                            </ol>
										</div>
									</div>
								</div>

                                <!--#STEP 2 -->
								<div class="card">
									<div class="card-header" id="headingTwo">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="diseaseSelector" class="collapsed">
                                                Step 2: Disease Symptom
											</a>
										</h5>
									</div>
									<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
										<div class="card-body">
                                            <ol class="p-0 d-flex flex-column gap-2">
                                                <?php
                                                    $syntomValue = [];

                                                    if($mode == 'update'){
                                                        $syntomDB = fetchRow("SELECT syntom FROM `possible_disease` WHERE id=".$_GET['id']);
                                                        $syntomValue = json_decode($syntomDB['syntom']);
                                                    }
                                                    
                                                    if(!empty($syntomlist)){
                                                        foreach($syntomlist as $key => $value){
                                                            $checked = (in_array($value['id'], $syntomValue) ? 'checked' : '');

                                                            echo '
                                                            <li class="cursor-pointer border border-1 form-check d-flex align-items-center gap-3 p-0 bg-light rounded-3">
                                                                <input '.$checked.' name="possiblesyntom[]" class="cursor-pointer form-check-input p-3 ms-2 mt-0" type="checkbox" value="'.$value['id'].'" id="syntompart_'.$key.'">
                                                                <label class="cursor-pointer form-check-label py-3 text-lg fw-bold" for="syntompart_'.$key.'">'.$value['name'].'</label>
                                                            </li>';
                                                        }
                                                    }
                                                ?>
                                            </ol>
                                        </div>
									</div>
								</div>

                                <!--#STEP 3 -->
								<div class="card">
									<div class="card-header" id="headingThree">
										<h5 class="card-title my-2">
											<a href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="diseaseSelector" class="">
												Step 3: Possible Disease
											</a>
										</h5>
									</div>
									<div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
										<div class="card-body">

                                            <div class="alert alert-success" role="alert">
                                                <div class="alert-message">
                                                    <h4 class="alert-heading fw-bold">Disease suggestion</h4>
                                                    <p class="m-0">Please write the possible disease based on symptom.</p>
                                                </div>
                                            </div>

                                            <?php
                                                if($mode == 'update'){
                                                    $diseaseInputs = '';
                                                    $possibleDB = fetchRow("SELECT possible FROM `possible_disease` WHERE id=".$_GET['id']);
                                                    $possibleValue = json_decode($possibleDB['possible']);

                                                    foreach($possibleValue as $d){
                                                        $diseaseInputs .= '
                                                        <li class="list-group-item d-flex w-100 gap-3 p-0">
                                                            <span class="w-100 d-flex align-items-center">
                                                                <input type="text" name="disease_possible[]" class="form-control border-0 p-2" placeholder="Describe.." required value="'.$d.'">
                                                            </span>
                                                            <button class="btn remove"><i class="fas fa-times"></i></button>
                                                        </li>';
                                                    }

                                                    echo '<ul class="list-group disease-list-possible mb-4">'.$diseaseInputs.'</ul>';
                                                }else{
                                                    echo '<ul class="list-group disease-list-possible mb-4"></ul>';
                                                }
                                            ?>

                                            <div class="w-100 d-flex align-items-center gap-2 container-submit">
                                                <button class="btn btn-secondary disease-row-insert" type="button">Add Row</button>

                                                <?php 
                                                    if($mode == 'create'){
                                                        echo '<button class="btn btn-success" type="submit" name="save-disease-possible">Save</button>';
                                                    }

                                                    if($mode == 'update'){
                                                        echo '<button class="btn btn-primary" type="submit" name="save-disease-possible">Save Changes</button>';
                                                    }
                                                ?>
                                            </div>
                                            
										</div>
									</div>
								</div>

							</form>

						</div>
					</div>
                    <!--#END Content -->

                </div>
            </main>

            <?php include 'inc/footer.php'; ?>
        </div>
    </div>

    <?php
        if(isset($_POST['save-disease-possible'])){
            $datasetdisease = (isset($_POST['disease_possible']) ? $_POST['disease_possible'] : []);
            $datasetsyntom = (isset($_POST['possiblesyntom']) ? $_POST['possiblesyntom'] : []);
            $datasetbody = (isset($_POST['possiblebody']) ? $_POST['possiblebody'] : []);

            if(!$datasetbody){
                echo '<script>alert("Please select symptoms body part")</script>';
            } else if(!$datasetsyntom){
                echo '<script>alert("Please select syntom")</script>';
            }else if(!$datasetdisease){
                echo '<script>alert("Please describe possible disease")</script>';
            }else{

                if($mode == 'create'){
                    runQuery("INSERT INTO `possible_disease` (`id`, `possible`, `body`, `syntom`) VALUES (NULL, '".json_encode($datasetdisease)."', '".json_encode($datasetbody)."', '".json_encode($datasetsyntom)."')");
                }

                if($mode == 'update'){
                    runQuery("UPDATE `possible_disease` SET `possible` = '".json_encode($datasetdisease)."', `body` = '".json_encode($datasetbody)."', `syntom` = '".json_encode($datasetsyntom)."' WHERE `possible_disease`.`id`=".$_GET['id']);
                }

                echo '<script>alert("Success save record!");window.location.href="admin-index.php"</script>';
            }
        }
    ?>

    <script src="./js/jquery.min.js"></script>
    <script>
        const $listcontainer = $('.disease-list-possible');

        $('.disease-row-insert').on('click', function(){
            const $list = $('<li/>', {
                class: 'list-group-item d-flex w-100 gap-3 p-0',
                html: `
                    <span class="w-100 d-flex align-items-center">
                        <input type="text" name="disease_possible[]" class="form-control border-0 p-2" placeholder="Describe.." required>
                    </span>
                    <button class="btn remove"><i class="fas fa-times"></i></button>
                `
            });

            $list.find('.remove').on('click', function(){
                $list.remove();
            });

            $listcontainer.append($list);
        })
    </script>
</body>
</html>