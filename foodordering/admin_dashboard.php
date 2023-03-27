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
                    <li class="p-3 text-0 border-1 border-300 bg-indigo-500">Manage Menu</li>
                </a>

                <a href="admin_order.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Order <span class="text-sm py-1 px-2 border-round-2xl ml-auto bg-blue-600 text-0"><?php echo $totalorder; ?></span></li>
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
            <div class="flex align-items-center justify-content-between p-3 surface-ground border-1 border-300">
                <h3 class="m-0 p-0">Manage Menu</h3>

                <a href="admin_uploadmenu.php" class="no-underline">
                    <button class="py-2 px-3 bg-green-600 text-0 border-green-600 border-round hover:bg-green-500 border-noround border-1 border-300 cursor-pointer">Add Menu</button>
                </a>
            </div>

            <div class="w-full h-full mt-3">
                <table class="w-full surface-ground">
                    <tr class="shadow-1 border-1">
                        <th class="py-2 surface-0 px-3">No.</th>
                        <th class="py-2 surface-0 px-3">Picture</th>
                        <th class="py-2 surface-0 px-3">Name</th>
                        <th class="py-2 surface-0 px-3">Price</th>
                        <th class="py-2 surface-0 px-3">Category</th>
                        <th class="py-2 surface-0 px-3">Stock Status</th>
                        <th class="py-2 surface-0 px-3">Active</th>
                        <th class="py-2 surface-0 px-3">Action</th>
                    </tr>

                    <?php
                        $menurecord = fetchRows("SELECT * FROM menu");

                        foreach($menurecord as $key => $value){

                            $categoryname = fetchRow("SELECT * from category WHERE id = ".$value['category']);
                    ?>
                    <tr>
                        <td class="py-2 surface-0 px-3"><?php echo ($key + 1); ?></td>
                        <td class="py-2 surface-0 px-3">
                            <img src="images/<?php echo $value['image']; ?>" class="w-5rem h-5rem" style="object-fit: cover;"/>
                        </td>
                        <td class="py-2 surface-0 px-3"><?php echo $value['name']; ?></td>
                        <td class="py-2 surface-0 px-3">RM <?php echo $value['price']; ?></td>
                        <td class="py-2 surface-0 px-3"><?php echo $categoryname['name']; ?></td>
                        <td class="py-2 surface-0 px-3">
                            <?php
                                if($value['in_stock'] == 1){
                                    echo '<span class="border-round text-sm bg-green-50 text-green-500 px-3 py-2">In Stock</span>';
                                }else{
                                    echo '<span class="border-round text-sm bg-red-50 text-red-500 px-3 py-2">Out Of Stock</span>';
                                }
                            ?>
                        </td>
                        <td class="py-2 surface-0 px-3">
                            <?php
                                if($value['is_active'] == 1){
                                    echo '<span class="border-round text-sm bg-blue-50 text-blue-500 px-3 py-2">Active</span>';
                                }else{
                                    echo '<span class="border-round text-sm bg-red-50 text-red-500 px-3 py-2">Inactive</span>';
                                }
                            ?>
                        </td>
                        <td class="py-2 surface-0 px-3">
                            <div class="w-full flex flex-column gap-2">
                                <a class="text-sm surface-100 p-2 no-underline" href="admin_menu_closemenu.php?id=<?php echo $value['id']; ?>">Toggle Close Menu</a>
                                <a class="text-sm surface-100 p-2 no-underline" href="admin_menu_deactivate.php?id=<?php echo $value['id']; ?>">Toggle Active</a>
                                <a class="text-sm surface-100 p-2 no-underline" href="admin_uploadmenu.php?id=<?php echo $value['id']; ?>">Edit</a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if(empty($menurecord)){ ?>
                    <tr><td class="p-3" colspan="6">No Record Yet</td></tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>