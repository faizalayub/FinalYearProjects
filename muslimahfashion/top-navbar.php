<?php
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

    <ul class="navbar-nav <?php echo $hiddenForAdmin; ?>">
        <li class="nav-item px-2 dropdown">
            <a class="nav-link" href="index.php">Home</a>
        </li>

        <li class="nav-item px-2 dropdown">
            <a class="nav-link" href="main-shop.php">Shop</a>
        </li>

        <!-- <li class="nav-item dropdown">
            <a class="nav-link" href="main-bestseller.php">Bestsellers</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" href="main-collection.php">Collection</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" href="main-discover.php">Discover</a>
        </li> -->

        <li class="nav-item dropdown <?php echo ($hasSession ? 'd-none' : ''); ?>">
            <a class="nav-link" href="login.php">Signin</a>
        </li>

        <li class="nav-item dropdown <?php echo ($hasSession ? 'd-none' : ''); ?>">
            <a class="nav-link" href="signup.php">Register</a>
        </li>
    </ul>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

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