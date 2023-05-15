<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: cat_login.php");
        exit();
    }

    $mycats = fetchRows("SELECT * FROM `adopt` WHERE user_id = ".$_SESSION['account_session']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body class="h-screen m-0 p-0 w-full surface-300">
    <?php include './navigator.php'; ?>

    <div class="grid py-6">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="account_dashboard.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover flex align-items-center">My Profile</li>
                </a>
                
                <a href="account_doptcat.php" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-indigo-500">My Cat</li>
                </a>

                <a href="cat_logout.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover flex align-items-center">Logout</li>
                </a>
            </ol>
        </div>
        <div class="col-8">
            <div class="p-3 surface-ground border-1 border-300">

                <h3 class="m-0">My Adopt Cats</h3>

                <div class="grid p-3 mt-4 gap-3">
                <?php
                    if(!empty($mycats)){
                        foreach($mycats as $key => $value){
                            $status = '';
                            $catinfo = fetchRow("SELECT * FROM cat WHERE id =".$value['cat_id']);

                            switch($value['status']){
                                case 0:
                                    $status = '<span class="text-base text-0 surface-400 border-round p-2">Pending Approve</span>';
                                break;
                                case 1:
                                    $status = '<span class="text-base text-0 bg-green-400 border-round p-2">Adopted</span>';
                                break;
                            }

                            echo '
                                <div class="col-4 bg-yellow-400 p-3 shadow-1 border-round-2xl flex align-items-center justify-content-center flex-column">
                                    <img style="object-fit: cover;" class="h-15rem w-15rem border-round-2xl" src="images/'.$catinfo['picture'].'" alt="" title="">

                                    <div class="px-2">
                                        <ul class="m-3 p-3 w-full">
                                            <li class="px-4 py-2 text-xl">'.$catinfo['name'].'</li>
                                            <li class="px-4 py-2 text-xl">'.$catinfo['race'].'</li>
                                            <li class="px-4 py-2 text-xl">'.$catinfo['food'].'</li>
                                            <li class="px-4 py-2 text-xl">'.$catinfo['gender'].'</li>
                                            <li class="px-4 py-2 text-xl">'.$catinfo['age'].' Years</li>
                                            <li class="px-4 py-2 text-xl">'.$catinfo['maintenance'].'</li>
                                            <li class="px-4 py-2 text-xl">'.$catinfo['description'].'</li>
                                            <li class="px-4 py-2 text-xl">'.$status.'</li>
                                        </ul>
                                    </div>
                                </div>
                            ';
                        }
                    }else{
                        echo '<div class="surface-300 p-3 col-12 text-center">No Cats Yet</div>';
                    }
                ?>
                </div>
            
            </div>
        </div>
    </div>
</body>
</html>