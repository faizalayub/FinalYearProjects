<?php
    $categories = fetchRows("SELECT * FROM category");
    $bodyparts = fetchRows("SELECT * FROM body_part");

    $hasSession = (isset($_SESSION) && !empty($_SESSION));
    $accountData = [];
    $hiddenForAdmin = '';

    if($hasSession){
        $profileid = (isset($_SESSION['account_admin']) ? $_SESSION['account_admin'] : $_SESSION['account_session']);
        $profiledata = fetchRow("SELECT * FROM `login` WHERE id = '$profileid'");
        $accountData = $profiledata;

        if($profiledata['type'] == 1){
            $hiddenForAdmin = 'd-none';
        }
    }
?>
<nav class="navbar navbar-expand navbar-light navbar-bg">

    <a class="nav-icon pe-md-0 dropdown-toggle p-0 <?php echo $hiddenForAdmin; ?>" href="index.php">
        <img src="<?php echo $logoicon; ?>" class="avatar img-fluid rounded" alt="logo">
    </a>
    
    <a class="sidebar-toggle js-sidebar-toggle m-0 ms-3 d-none">
        <i class="hamburger align-self-center"></i>
    </a>
    
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <li class="nav-item px-2 dropdown <?php echo $hiddenForAdmin; ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item px-2 dropdown">
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item px-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="megaDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Discover
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-mega" aria-labelledby="megaDropdown">
                            <div class="d-md-flex align-items-start justify-content-start">
                                <div class="dropdown-mega-list">
                                    <div class="dropdown-header">Category</div>
                                    <?php
                                        if(!empty($categories)){
                                            foreach($categories as $c){
                                                echo '<a class="dropdown-item" href="./main-shop.php?searchcategory='.$c['id'].'">'.$c['name'].'</a>';
                                            }
                                        }else{
                                            echo 'No category';
                                        }
                                    ?>
                                </div>
                                <div class="dropdown-mega-list">
                                    <div class="dropdown-header">Type</div>
                                    <?php
                                        if(!empty($bodyparts)){
                                            foreach($bodyparts as $c){
                                                echo '<a class="dropdown-item" href="./main-shop.php?searchtype='.$c['id'].'">'.$c['name'].'</a>';
                                            }
                                        }else{
                                            echo 'No type';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>

            <li class="nav-item px-2 dropdown <?php echo $hiddenForAdmin; ?>">
                <a class="nav-link" href="main-shop.php">Shop</a>
            </li>

            <li class="nav-item dropdown <?php echo $hiddenForAdmin; ?> <?php echo ($hasSession ? 'd-none' : ''); ?>">
                <a class="nav-link" href="login.php">Signin</a>
            </li>

            <li class="nav-item dropdown <?php echo $hiddenForAdmin; ?> <?php echo ($hasSession ? 'd-none' : ''); ?>">
                <a class="nav-link" href="signup.php">Register</a>
            </li>

            <li class="nav-item dropdown <?php echo ($hasSession ? '' : 'd-none'); ?>">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark"><?php echo (!empty($accountData) ? $accountData['name'] : '') ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="./logout.php"><i class="align-middle me-1" data-feather="log-out"></i> Log Out</a>
                </div>
            </li>

        </ul>
    </div>
</nav>