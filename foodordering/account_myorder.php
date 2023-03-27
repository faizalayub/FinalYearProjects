<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: account_login.php");
        exit();
    }

    $totalCart = numRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <div class="grid py-6">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="account_dashboard.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">My Profile</li>
                </a>
                
                <a href="account_cart.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">My Cart <span class="text-sm py-1 px-2 border-round-2xl ml-auto bg-blue-600 text-0"><?php echo $totalCart; ?></span></li>
                </a>

                <a href="account_myorder.php" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-indigo-500 flex align-items-center">My History</li>
                </a>
            </ol>
        </div>
        <div class="col-8">
            <div class="p-3 surface-ground border-1 border-300">
                <h3 class="m-0">My History</h3>
                
                <table class="w-full surface-ground mt-3">
                    <tr class="shadow-1 border-1">
                        <th class="py-2 surface-0 px-3">No.</th>
                        <th class="py-2 surface-0 px-3">Menu ID</th>
                        <th class="py-2 surface-0 px-3">Order Code</th>
                        <th class="py-2 surface-0 px-3">Order Time</th>
                    </tr>

                    <?php
                        $userrecord = fetchRows("SELECT * FROM `user_order` WHERE user_id = ".$_SESSION['account_session']);

                        foreach($userrecord as $key => $value){

                            $menuList = '<ol>';
                            $menuorder = json_decode($value['menu_id']);

                            foreach($menuorder as $m){
                                $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                $menuList .= "<li>".$bobo['name']."</li>";
                            }

                            $menuList .= '</ol>';
                    ?>
                    <tr>
                        <td class="py-2 surface-0 px-3"><?php echo ($key + 1); ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $menuList; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $value['unique_number']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo date_format(date_create($value['created_date']),"d F Y h:i A"); ?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if(empty($userrecord)){ ?>
                    <tr><td class="p-3" colspan="6">No Record Yet</td></tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>