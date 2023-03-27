<?php
    include 'config.php';

    if(!isset($_SESSION['account_admin'])){
        header("Location: account_login.php");
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
        <h1 class="m-0 p-0 w-full text-center bg-indigo-600 p-3 text-0" style="font-family: cursive;">Mawar Restaurant Admin</h1>
    </div>

    <div class="grid py-6">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="admin_dashboard.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Manage Menu</li>
                </a>

                <a href="admin_order.php" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-indigo-500">Order <span class="text-sm py-1 px-2 border-round-2xl ml-auto bg-blue-600 text-0"><?php echo $totalorder; ?></span></li>
                </a>

                <a href="admin_userlist.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">User List</li>
                </a>

                <a href="account_logout.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Log Out</li>
                </a>
            </ol>
        </div>
        <div class="col-8">
            <div class="p-3 surface-ground border-1 border-300">
                <h3 class="m-0 p-0">Order</h3>
            </div>

            <div class="w-full h-full mt-3">
                <table class="w-full surface-ground">
                    <tr class="shadow-1 border-1">
                        <th class="py-2 surface-0 px-3">No.</th>
                        <th class="py-2 surface-0 px-3">User Name</th>
                        <th class="py-2 surface-0 px-3">User Email</th>
                        <th class="py-2 surface-0 px-3">User Phone</th>
                        <th class="py-2 surface-0 px-3">User Address</th>
                        <th class="py-2 surface-0 px-3">Menu ID</th>
                        <th class="py-2 surface-0 px-3">Order Code</th>
                        <th class="py-2 surface-0 px-3">Action</th>
                    </tr>

                    <?php
                        $userrecord = fetchRows("SELECT * FROM `user_order` WHERE status = 1");

                        foreach($userrecord as $key => $value){

                            $menuList = '<ol>';
                            $userdata = fetchRow("SELECT * FROM `login` WHERE id=".$value['user_id']);
                            $menuorder = json_decode($value['menu_id']);

                            foreach($menuorder as $m){
                                $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                $menuList .= "<li>".$bobo['name']."</li>";
                            }

                            $menuList .= '</ol>';
                    ?>
                    <tr>
                        <td class="py-2 surface-0 px-3"><?php echo ($key + 1); ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $userdata['name']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $userdata['email']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $userdata['phone']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $userdata['address']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $menuList; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $value['unique_number']; ?></td>
                        <td class="py-2 surface-0 px-3">
                            <a href="admin_orderdone.php?id=<?php echo $value['id']; ?>">Set as Completed</a>
                        </td>
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