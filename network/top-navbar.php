<?php
    $useAuth = (object) [];
    $hasSession = (isset($_SESSION['login_session']) && !empty($_SESSION['login_session']));

    if($hasSession){
        $useAuth = ($_SESSION['login_session']);
    }
?>

<style>
@font-face {
    font-family: logofont;
    src: url('./Bitcheese.otf');
}
</style>

<nav class="navbar navbar-expand navbar-light navbar-bg">

    <a class="nav-icon pe-md-0 dropdown-toggle p-0" href="#" style="font-family: logofont; color: #2a6eb8;">Network Research Group</a>
    
    <a class="sidebar-toggle js-sidebar-toggle m-0 ms-3 d-none">
        <i class="hamburger align-self-center"></i>
    </a>
    
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <li class="nav-item dropdown <?php echo ($hasSession ? '' : 'd-none'); ?>">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark"><?php echo (!empty($useAuth->name) ? $useAuth->name : '') ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="./auth-logout.php"><i class="align-middle me-1" data-feather="log-out"></i> Log Out</a>
                </div>
            </li>

        </ul>
    </div>
</nav>