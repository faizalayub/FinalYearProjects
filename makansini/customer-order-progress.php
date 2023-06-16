<?php
    include 'config.php';

    if(!isset($_SESSION['staff_session']) && !isset($_SESSION['customer_session'])){
        header("Location: auth-login.php");
        exit();
    }

    $authProfileID = null;
    $goBack = '';

    if(isset($_SESSION['staff_session'])){
        $goBack = './user-index.php';
        $authProfileID = $_SESSION['staff_session'];
    }

    if(isset($_SESSION['customer_session'])){
        $goBack = './user-menu.php';
        $authProfileID = $_SESSION['customer_session'];
    }

    $profiledata = fetchRow("SELECT * FROM login WHERE id = ".$authProfileID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'header.php'; ?>

    <style>
        #bar-progress {
            width: 100%;
            display: inline-flex;
            justify-content: center;
            flex-direction: column;
            gap: 1rem;
        }

        #bar-progress .step {
            display: inline-flex;
        }

        #bar-progress .step .number-container {
            display: inline-block;
            border: solid 1px #000;
            border-radius: 50%;
            width: 24px;
            height: 24px;
        }

        #bar-progress .step.step-active .number-container {
            background-color: #000;
        }

        #bar-progress .step .number-container .number {
            font-weight: 700;
            font-size: .8em;
            line-height: 1.75em;
            display: block;
            text-align: center;
        }

        #bar-progress .step.step-active .number-container .number {
            color: white;
        }

        #bar-progress .step h5 {
            display: inline;
            font-weight: 100;
            font-size: .8em;
            margin-left: 10px;
            text-transform: uppercase;
        }

        #bar-progress .seperator {
            display: block;
            width: 20px;
            height: 1px;
            background-color: rgba(0, 0, 0, .2);
            margin: auto 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <?php
                        if(!empty($accountData) && $accountData['type'] == 2){
                            echo '
                            <div class="row mb-2 mb-xl-3">
                                <div class="col-auto d-none d-sm-block">
                                    <h3>Welcome back, '.$accountData['name'].'</h3>
                                </div>
                            </div>';
                        }
                    ?>
                    <!--#END HEADER -->

                    <!--#START CONTENT -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <!--#START Profile -->
                            <div class="row">

                                <?php
                                    if($accountData['type'] != 4){
                                        echo '
                                        <div class="col-xl-12 col-xxl-12">
                                            <div class="card flex-fill w-100">
                                                <div class="card-header">
                                                    <span class="h3">Order Progress</span>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                ?>

                                <?php
                                    $counter = 0;
                                    $userrecord = fetchRows("SELECT * FROM `user_order` WHERE user_id = ".$authProfileID." ORDER BY created_date DESC");

                                    foreach($userrecord as $key => $value){

                                        $method = '';
                                        $progress = '';
                                        $menuList = '<ol class="p-3 m-0">';
                                        $menuorder = json_decode($value['menu_id']);
                                        $menusize = json_decode($value['size']);

                                        if($value['delivery_method'] == 1){
                                            $method = 'Pick-Up';
                                        }

                                        if($value['delivery_method'] == 2){
                                            $method = 'Delivery';
                                        }

                                        switch($value['status']){
                                            case 1:
                                                $progress = '
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">1</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Preparing</span>
                                                </div>
                                                
                                                <div class="step">
                                                    <span class="number-container">
                                                        <span class="number">2</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span>Prepared</span>
                                                </div>
                                                
                                                <div class="step">
                                                    <span class="number-container">
                                                        <span class="number">3</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span>Ready</span>
                                                </div>
                                                
                                                <div class="step">
                                                    <span class="number-container">
                                                        <span class="number">4</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span>Completed</span>
                                                </div>';
                                            break;
                                            case 2:
                                                $progress = '
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">1</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Preparing</span>
                                                </div>
                                                
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">2</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Prepared</span>
                                                </div>
                                                
                                                <div class="step">
                                                    <span class="number-container">
                                                        <span class="number">3</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span>Ready</span>
                                                </div>
                                                
                                                <div class="step">
                                                    <span class="number-container">
                                                        <span class="number">4</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span>Completed</span>
                                                </div>';
                                            break;
                                            case 3:
                                                $progress = '
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">1</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Preparing</span>
                                                </div>
                                                
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">2</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Prepared</span>
                                                </div>
                                                
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">3</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Ready</span>
                                                </div>
                                                
                                                <div class="step">
                                                    <span class="number-container">
                                                        <span class="number">4</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span>Completed</span>
                                                </div>';
                                            break;
                                            case 4:
                                                $progress = '
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">1</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Preparing</span>
                                                </div>
                                                
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">2</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Prepared</span>
                                                </div>
                                                
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">3</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Ready</span>
                                                </div>
                                                
                                                <div class="step step-active">
                                                    <span class="number-container">
                                                        <span class="number">4</span>
                                                    </span>
                                                    <div class="seperator"></div>
                                                    <span class="fw-bold">Completed</span>
                                                </div>';
                                            break;
                                        }

                                        foreach($menuorder as $key => $m){
                                            $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                            $menuList .= "
                                                <div class='dropdown-item p-0' style='pointer-events:none;'>
                                                    <span class='fw-bold'>".($key + 1).". ".$menusize[$key]."</span> - ".$bobo['name']."
                                                </div>";
                                        }

                                        echo '
                                        <div class="col-xl-6 col-xxl-6">
                                            <div class="card flex-fill w-100">
                                                <div class="card-header d-flex flex-column">
                                                    <span class="h3">Order Number: #'.$value['unique_number'].'</span>
                                                    <span class="text-mute h4">'.date_format(date_create($value['created_date']),"d F Y h:i A").'</span>
                                                    <span class="text-mute">('.$method.')</span>
                                                </div>
                                                <div class="card-body p-1">
                                                    <div class="dropdown-menu p-0 m-0" style="position:static;display:block;">'.$menuList.'</div>
                                                    <div id="bar-progress" class="p-3">'.$progress.'</div>
                                                </div>
                                            </div>
                                        </div>';

                                        $counter++;
                                    }
                                ?>

                                <?php
                                    if($accountData['type'] != 4){
                                        echo '
                                        <div class="col-xl-12 col-xxl-12">
                                            <div class="card">
                                                <div class="card-footer">
                                                    <a href="./user-menu.php" type="button" class="btn btn-secondary">Go Back</a>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                ?>
                            </div>
                            <!--#END Profile -->
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <!--#END CONTENT -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>