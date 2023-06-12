<?php
    $sidebarLabel = '';
    $isCollapsed = 'collapsed';
    $sidebarMenu = [];
    $currentFile = constant("currentFile");
    $hasSession = (isset($_SESSION['login_session']) && !empty($_SESSION['login_session']));

    if($hasSession){
        $useAuth = ($_SESSION['login_session']);
        $isCollapsed = '';
        $sidebarLabel = '';

        //# Admin
        if($useAuth->type == 1){
            $sidebarLabel = 'Admin Dashboard';
            $sidebarMenu[] = (object) ['label' => 'Manage Student', 'icon' => 'users', 'path' => 'admin-manage-student.php'];
            $sidebarMenu[] = (object) ['label' => 'Manage Lecturer', 'icon' => 'user', 'path' => 'admin-manage-lecturer.php'];
            $sidebarMenu[] = (object) ['label' => 'Network Equipment', 'icon' => 'minimize-2', 'path' => 'admin-manage-equipment.php'];
            $sidebarMenu[] = (object) ['label' => 'Study Materials', 'icon' => 'clipboard', 'path' => 'admin-manage-material.php'];
            $sidebarMenu[] = (object) ['label' => 'Request', 'icon' => 'git-pull-request', 'path' => 'list-request-material.php'];
            $sidebarMenu[] = (object) ['label' => 'Log Out', 'icon' => 'log-out', 'path' => 'auth-logout.php'];
        }

        //# Lecturer
        if($useAuth->type == 2){
            $sidebarLabel = 'Lecturer Dashboard';
            $sidebarMenu[] = (object) ['label' => 'Profile', 'icon' => 'user', 'path' => 'lecturer-profile.php'];
            $sidebarMenu[] = (object) ['label' => 'Students', 'icon' => 'users', 'path' => 'lecturer-view-student.php'];
            $sidebarMenu[] = (object) ['label' => 'Network Equipment', 'icon' => 'minimize-2', 'path' => 'lecturer-view-equipment.php'];
            $sidebarMenu[] = (object) ['label' => 'Study Materials', 'icon' => 'clipboard', 'path' => 'lecturer-study-material.php'];
            $sidebarMenu[] = (object) ['label' => 'Request', 'icon' => 'git-pull-request', 'path' => 'list-request-material.php'];
            $sidebarMenu[] = (object) ['label' => 'Log Out', 'icon' => 'log-out', 'path' => 'auth-logout.php'];
        }

        //# Student
        if($useAuth->type == 3){
            $sidebarLabel = 'Student Dashboard';
            $sidebarMenu[] = (object) ['label' => 'My Profile', 'icon' => 'user', 'path' => '#'];
            $sidebarMenu[] = (object) ['label' => 'My Cart', 'icon' => 'shopping-cart', 'path' => '#'];
            $sidebarMenu[] = (object) ['label' => 'Log Out', 'icon' => 'log-out', 'path' => 'auth-logout.php'];
        }
    }
?>

<nav id="sidebar" class="sidebar js-sidebar <?php echo $isCollapsed; ?>">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
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