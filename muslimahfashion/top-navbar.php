<?php
    $utils = new Controller('RETURN');
    $accountID = ($_SESSION['id'] ?? null);
    $profilePicture = 'img/default_avatar.jpeg';
    $accountData = $utils->fetchRow("SELECT * FROM `pengguna` WHERE `id` = '".$accountID."'");
?>
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">            
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img style="object-fit: cover;" src="<?php echo $profilePicture; ?>" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                    <span class="text-dark"><?php echo (!empty($accountData) ? $accountData->fullname : '') ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="./logout.php"><i class="align-middle me-1" data-feather="log-out"></i> Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>