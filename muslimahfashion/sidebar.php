<?php
    $sidebarMenu = [];
    $currentFile = constant("currentFile");

    $sidebarMenu[] = (object) ['label' => 'Home', 'icon' => 'file-text', 'path' => 'cipta-borang.php'];
    $sidebarMenu[] = (object) ['label' => 'Shop', 'icon' => 'file-text', 'path' => 'lihat-borang.php'];
    $sidebarMenu[] = (object) ['label' => 'Bestsellers', 'icon' => 'file-text', 'path' => 'lihat-borang.php'];
    $sidebarMenu[] = (object) ['label' => 'Collection', 'icon' => 'file-text', 'path' => 'lihat-borang.php'];
    $sidebarMenu[] = (object) ['label' => 'Discover', 'icon' => 'file-text', 'path' => 'lihat-borang.php'];
?>

<nav id="sidebar" class="sidebar js-sidebar collapsed">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.php"><span class="align-middle"></span></a>

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