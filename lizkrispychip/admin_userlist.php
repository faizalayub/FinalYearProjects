<?php
    include 'config.php';

    if(!isset($_SESSION['account_admin'])){
        header("Location: account_login");
        exit();
    }

    $totalorder = numRows("SELECT * FROM `user_order` WHERE status = 1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <div class="sticky top-0 w-full flex align-items-center flex-column">
        <h1 class="m-0 p-0 w-full text-center bg-yellow-600 p-3 text-0 text-xl" >Admin Dashboard</h1>
    </div>

    <div class="grid py-6">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="admin_report" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Dashboard</li>
                </a>

                <a href="admin_dashboard" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Manage Product</li>
                </a>

                <a href="admin_order" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Order <span class="text-sm py-1 px-2 border-round ml-auto bg-yellow-600 text-0"><?php echo $totalorder; ?></span></li>
                </a>

                <a href="admin_userlist" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-yellow-500">User List</li>
                </a>

                <a href="admin_staff" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">List Of Admin</li>
                </a>

                <a href="account_logout" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Log Out</li>
                </a>
            </ol>
        </div>
        <div class="col-8">
            <div class="p-3 surface-ground border-1 border-300">
                <h3 class="m-0 p-0">User List</h3>
            </div>

            <div class="w-full h-full mt-3">
                <table class="w-full surface-ground">
                    <tr class="shadow-1 border-1">
                        <th class="py-2 surface-0 px-3">No.</th>
                        <th class="py-2 surface-0 px-3">Name</th>
                        <th class="py-2 surface-0 px-3">Email</th>
                        <th class="py-2 surface-0 px-3">Phone</th>
                        <th class="py-2 surface-0 px-3">Address</th>
                    </tr>

                    <?php
                        $userrecord = fetchRows("SELECT * FROM login WHERE type=2");

                        foreach($userrecord as $key => $value){
                    ?>
                    <tr>
                        <td class="py-2 surface-0 px-3"><?php echo ($key + 1); ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $value['name']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $value['email']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $value['phone']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $value['address']; ?></td>
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