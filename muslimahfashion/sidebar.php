<?php
    $sidebarLabel = '';
    $isCollapsed = 'collapsed';
    $sidebarMenu = [];
    $currentFile = constant("currentFile");
    $hasSession = (isset($_SESSION) && !empty($_SESSION));

    if($hasSession){
        $profileid    = (isset($_SESSION['account_admin']) ? $_SESSION['account_admin'] : $_SESSION['account_session']);
        $profiledata  = fetchRow("SELECT * FROM `login` WHERE id = '$profileid'");
        $accountType  = ($profiledata['type']);
        $accountData  = $profiledata;
        $isCollapsed  = '';
        $sidebarLabel = ($accountType == 1 ? 'Admin Dashboard' : 'User Dashboard');

        //# Admin
        if($accountType == 1){
            $sidebarMenu[] = (object) ['label' => 'Dashboard', 'icon' => 'table', 'path' => 'admin-index.php'];
            $sidebarMenu[] = (object) ['label' => 'Manage Product', 'icon' => 'box', 'path' => 'admin-product.php'];
            $sidebarMenu[] = (object) ['label' => 'Create Product', 'icon' => 'plus-circle', 'path' => 'admin-create-product.php'];
            $sidebarMenu[] = (object) ['label' => 'Order', 'icon' => 'shopping-cart', 'path' => 'admin-order.php'];
            $sidebarMenu[] = (object) ['label' => 'User List', 'icon' => 'users', 'path' => 'admin-users.php'];
            $sidebarMenu[] = (object) ['label' => 'Log Out', 'icon' => 'log-out', 'path' => 'logout.php'];
        }

        //# User
        if($accountType == 2){
            $sidebarMenu[] = (object) ['label' => 'My Profile', 'icon' => 'user', 'path' => 'user-index.php'];
            $sidebarMenu[] = (object) ['label' => 'My Cart', 'icon' => 'shopping-cart', 'path' => 'user-cart.php'];
            $sidebarMenu[] = (object) ['label' => 'My History', 'icon' => 'clock', 'path' => 'user-history.php'];
            $sidebarMenu[] = (object) ['label' => 'Log Out', 'icon' => 'log-out', 'path' => 'logout.php'];
        }
    }

    if(empty($sidebarMenu)){
        $sidebarMenu[] = (object) ['label' => 'Home', 'icon' => 'home', 'path' => 'cipta-borang.php'];
        $sidebarMenu[] = (object) ['label' => 'Shop', 'icon' => 'shopping-cart', 'path' => 'lihat-borang.php'];
        $sidebarMenu[] = (object) ['label' => 'Bestsellers', 'icon' => 'tag', 'path' => 'lihat-borang.php'];
        $sidebarMenu[] = (object) ['label' => 'Collection', 'icon' => 'box', 'path' => 'lihat-borang.php'];
        $sidebarMenu[] = (object) ['label' => 'Discover', 'icon' => 'airplay', 'path' => 'lihat-borang.php'];
    }
?>

<nav id="sidebar" class="sidebar js-sidebar <?php echo $isCollapsed; ?>">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.php">
            <span class="align-middle"><?php echo $sidebarLabel; ?></span>
        </a>

        <ul class="sidebar-nav">
        <?php
            $hasActiveTab = false;

            foreach($sidebarMenu as $menu){
                $isActive = ($currentFile == $menu->path ? 'active' : '');

                if($currentFile == $menu->path){
                    $hasActiveTab = true;
                }

                echo '<li class="sidebar-item '.$isActive.'">
                    <a class="sidebar-link" href="'.$menu->path.'">
                        <i class="align-middle" data-feather="'.$menu->icon.'"></i>
                        <span class="align-middle">'.$menu->label.'</span>
                    </a>
                </li>';
            }
        ?>
        </ul>
    </div>
</nav>