<?php
    $categories = fetchRows("SELECT * FROM category");

    $hasSession = (isset($_SESSION) && !empty($_SESSION));
    $accountData = [];
    $hiddenForAdmin = '';
    $hiddenNotification = '';
    $authProfileID = null;

    if($hasSession){
        if(isset($_SESSION['account_admin'])){
            $authProfileID = $_SESSION['account_admin'];
        }
    
        if(isset($_SESSION['customer_session'])){
            $authProfileID = $_SESSION['customer_session'];
        }

        if(isset($_SESSION['staff_session'])){
            $authProfileID = $_SESSION['staff_session'];
        }

        if(!empty($authProfileID)){
            $profiledata = fetchRow("SELECT * FROM `login` WHERE id = '$authProfileID'");

            $accountData = $profiledata;

            if($profiledata['type'] == 1){
                $hiddenForAdmin = 'd-none';
            }
        }

        if($profiledata['type'] == 2){
            $hiddenNotification = 'd-none';
        }
    }

    //# Notification
    $totalNotification = 0;

    if(!empty($authProfileID) && $hiddenNotification == ''){
        $notiCollection = fetchRows("SELECT * FROM `notification` WHERE `user_id` = '".$authProfileID."'");

        foreach($notiCollection as $n){
            if($n['status'] == null){
                $totalNotification++;
            }
        }
    }
?>

<style>
@font-face {
    font-family: logofont;
    src: url('./Bitcheese.otf');
}
</style>

<nav class="navbar navbar-expand navbar-light navbar-bg">

    <a class="nav-icon pe-md-0 dropdown-toggle p-0 <?php echo $hiddenForAdmin; ?>" href="#" style="font-family: logofont; color: #2a6eb8;">Makan Sini</a>
    
    <a class="sidebar-toggle js-sidebar-toggle m-0 ms-3 d-none">
        <i class="hamburger align-self-center"></i>
    </a>
    
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <?php
                if(!empty($profiledata) && $profiledata['type'] == 3){
                    echo '
                    <li class="nav-item px-2 dropdown"><a class="nav-link" href="user-menu.php">Menu</a></li>
                    <li class="nav-item px-2 dropdown"><a class="nav-link" href="user-cart.php">Menu Cart</a></li>
                    <li class="nav-item px-2 dropdown"><a class="nav-link" href="customer-order-progress.php">Order Progress</a></li>';
                }
            ?>

            <li class="nav-item dropdown <?php echo $hiddenNotification; ?>">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <?php echo ($totalNotification == 0 ? '' : '<span class="indicator">'.$totalNotification.'</span>'); ?>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        <?php echo $totalNotification; ?> New Notifications
                    </div>

                    <div class="list-group">
                        <?php 
                            foreach($notiCollection as $n){
                                $notiRedirect = '#';

                                if($n['status'] != null){
                                    continue;
                                }

                                if($n['type'] == "customer_order_status"){
                                    $notiRedirect = 'customer-order-progress.php';
                                }

                                if($n['type'] == "admin_order_status"){
                                    $notiRedirect = 'admin-order.php';
                                }

                                echo '<a href="'.$notiRedirect.'" class="list-group-item">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-2">
                                            <i class="text-warning" data-feather="bell"></i>
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">'.$n['message'].'</div>
                                            <div class="text-muted small mt-1">'.$n['created_date'].'</div>
                                        </div>
                                    </div>
                                </a>';
                            }
                        ?>
                    </div>

                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Showed all notifications</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown <?php echo ($hasSession ? '' : 'd-none'); ?>">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark"><?php echo (!empty($accountData) ? $accountData['name'] : '') ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="./auth-logout.php"><i class="align-middle me-1" data-feather="log-out"></i> Log Out</a>
                </div>
            </li>

        </ul>
    </div>
</nav>