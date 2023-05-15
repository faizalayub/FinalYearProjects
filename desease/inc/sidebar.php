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
            $sidebarMenu[] = (object) ['label' => 'Computed Disease', 'icon' => 'activity', 'path' => 'admin-recommender.php'];
            $sidebarMenu[] = (object) ['label' => 'Add Body Part', 'icon' => 'user', 'path' => 'admin-create-body.php'];
            $sidebarMenu[] = (object) ['label' => 'Add Syntom', 'icon' => 'plus-square', 'path' => 'admin-create-syntom.php'];
            $sidebarMenu[] = (object) ['label' => 'Chat', 'icon' => 'message-square', 'path' => 'admin-chat.php'];
            $sidebarMenu[] = (object) ['label' => 'Log Out', 'icon' => 'user', 'path' => 'logout-account.php'];
        }

        //# User
        if($accountType == 2){
            $sidebarMenu[] = (object) ['label' => 'My Profile', 'icon' => 'user', 'path' => 'user-index.php'];
            $sidebarMenu[] = (object) ['label' => 'Check Now', 'icon' => 'refresh-cw', 'path' => 'user-check.php'];
            $sidebarMenu[] = (object) ['label' => 'Log Out', 'icon' => 'user', 'path' => 'logout-account.php'];
            $sidebarMenu[] = (object) ['label' => 'Log Out', 'icon' => 'user', 'path' => 'logout-account.php'];
        }
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