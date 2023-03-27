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
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover flex align-items-center">My Cart <span class="text-sm py-1 px-2 border-round-2xl ml-auto bg-blue-600 text-0"><?php echo $totalCart; ?></span></li>
                </a>

                <a href="account_orderhistory.php" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-indigo-500">Order History</li>
                </a>
            </ol>
        </div>
        <div class="col-8">
            <div class="p-3 surface-ground border-1 border-300">
                <h3 class="m-0">Order History</h3>
            
            </div>
        </div>
    </div>
</body>
</html>