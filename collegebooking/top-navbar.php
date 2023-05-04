<?php
    $Auth = ($_SESSION['student'] ?? null);

    $adminEmail = '';
    $totalNotification = 0;
    $profilePicture = 'img/photos/default_avatar.jpeg';

    if(!empty($Auth)){
        $profile = fetchRow("SELECT * FROM `student` WHERE `matricno` = '".$Auth->matricno."'");
        $notiCollection = fetchRows("SELECT * FROM `notification` WHERE `matricno` = '".$Auth->matricno."'");

        if($profile){
            $profile = json_decode(json_encode($profile), false);

            if(isset($profile->profile_picture) && !empty($profile->profile_picture)){
                $profilePicture = 'img/photos/'.$profile->profile_picture;
            }
        }

        foreach($notiCollection as $n){
            if($n['status'] == null){
                $totalNotification++;
            }
        }
    }

    if(isset($_SESSION['admin'])){
        $adminEmail = $_SESSION['admin']->email;
    }
?>
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <?php if(!$isAdmin){ ?>
                <li class="nav-item dropdown">

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
                                    if($n['status'] != null){
                                        continue;
                                    }

                                    echo '<a href="./student-readnoti?id='.$n['id'].'" class="list-group-item">
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
                            <a href="#" class="text-muted">Show all notifications</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img style="object-fit: cover;" src="<?php echo $profilePicture; ?>" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                    <span class="text-dark"><?php echo (!empty($profile->matricno) ? $profile->matricno : $adminEmail); ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <?php if(!$isAdmin){ ?>
                        <a class="dropdown-item" href="./student-profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="./student-login"><i class="align-middle me-1" data-feather="log-out"></i> Log Out</a>
                    <?php }else{ ?>
                        <a class="dropdown-item" href="./admin-logout"><i class="align-middle me-1" data-feather="log-out"></i> Log Out</a>
                    <?php } ?>
                </div>
            </li>
        </ul>
    </div>
</nav>