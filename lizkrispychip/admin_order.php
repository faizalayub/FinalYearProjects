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
<body class="h-screen">
    <div class="sticky top-0 w-full flex align-items-center flex-column">
        <h1 class="m-0 p-0 w-full text-center bg-yellow-600 p-3 text-0 text-xl">Admin Dashboard</h1>
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
                    <li class="p-3 text-0 border-1 border-300 bg-yellow-500">Order <span class="text-sm py-1 px-2 border-round ml-auto bg-yellow-800 text-0"><?php echo $totalorder; ?></span></li>
                </a>

                <a href="admin_userlist" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">User List</li>
                </a>

                <a href="admin_staff" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">List Of Admin</li>
                </a>

                <a href="account_logout" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Log Out</li>
                </a>
            </ol>
        </div>
        <div class="col-8 px-4">
            <div class="p-3 surface-ground border-1 border-300">
                <h3 class="m-0 p-0">Order</h3>
            </div>

            <div class="w-full h-full mt-3 overflow-auto">
                <table class="w-full surface-0">
                    <tr class="shadow-1 border-1">
                        <th class="py-2 surface-0 px-3 white-space-nowrap">No.</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">Kerepek</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">Order Number</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">Payment Receipt</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">Payment Method</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">Delivery Method</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">User Name</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">User Email</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">User Phone</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">User Address</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">Status</th>
                        <th class="py-2 surface-0 px-3 white-space-nowrap">Set Status As</th>
                    </tr>

                    <?php
                        $userrecord = fetchRows("SELECT * FROM `user_order`");

                        foreach($userrecord as $key => $value){

                            $menuList = '<ol>';
                            $userdata = fetchRow("SELECT * FROM `login` WHERE id=".$value['user_id']);
                            $menuorder = json_decode($value['menu_id']);

                            foreach($menuorder as $m){
                                $bobo = fetchRow("SELECT * FROM menu WHERE id=".$m);

                                $menuList .= "<li class='white-space-nowrap'>".$bobo['name']."</li>";
                            }

                            $menuList .= '</ol>';
                    ?>
                    <tr>
                        <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo ($key + 1); ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $menuList; ?></td>
                        <td class="py-2 surface-0 px-3 text-center"><?php echo $value['unique_number']; ?></td>
                        <td class="py-2 surface-0 px-3 text-center">
                            <?php
                                if(!empty($value['payment_receipt'])){
                                    echo '<a href="./images/'.$value['payment_receipt'].'" download>Download Receipt</a>';
                                }else{
                                    echo '-';
                                }
                            ?>
                        </td>
                        <td class="py-2 surface-0 px-3 text-center">
                            <?php
                                if($value['payment_method'] == 1) echo 'Online Transfer';

                                if($value['payment_method'] == 2) echo 'Cash';
                            ?>    
                        </td>
                        <td class="py-2 surface-0 px-3 text-center">
                            <?php
                                if($value['delivery_method'] == 1) echo 'Pick-Up';

                                if($value['delivery_method'] == 2) echo 'Delivery';
                            ?>
                        </td>
                        <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo $userdata['name']; ?></td>
                        <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo $userdata['email']; ?></td>
                        <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo $userdata['phone']; ?></td>
                        <td class="py-2 surface-0 px-3 white-space-nowrap"><?php echo $userdata['address']; ?></td>
                        <td class="py-2 surface-0 px-3">
                            <?php
                                if($value['status'] == 1){
                                    echo '<span class="text-700 font-italic">Pending</span>';
                                }

                                if($value['status'] == 2){
                                    echo '<span class="text-blue-700 font-italic">Preparing</span>';
                                }

                                if($value['status'] == 3){
                                    echo '<span class="text-blue-700 font-italic">Shipping</span>';
                                }

                                if($value['status'] == 4){
                                    echo '<span class="text-green-700 font-italic">Completed</span>';
                                }
                            ?>    
                        </td>

                        <td class="py-2 surface-0 px-3 flex flex-column gap-2 align-items-center justify-content-center h-full">
                            <a class="white-space-nowrap no-underline" href="admin_order_status.php?id=<?php echo $value['id']; ?>&status=2">Preparing</a>
                            <a class="white-space-nowrap no-underline" href="admin_order_status.php?id=<?php echo $value['id']; ?>&status=3">Shipping</a>
                            <a class="white-space-nowrap no-underline" href="admin_order_status.php?id=<?php echo $value['id']; ?>&status=4">Completed</a>
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