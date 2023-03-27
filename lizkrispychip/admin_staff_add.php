<?php
    include 'config.php';

    if(!isset($_SESSION['account_admin'])){
        header("Location: account_login");
        exit();
    }

    $totalorder = numRows("SELECT * FROM `user_order` WHERE status = 1");

    if(isset($_GET['id'])){
        $profile = fetchRow("SELECT * FROM login WHERE id =".$_GET['id']);
    }

    if(isset($_POST['materialupload'])){
        $menu_name = ($_POST['menu_name'] ?? '');
        $menu_email = ($_POST['menu_email'] ?? '');
        $menu_password = ($_POST['menu_password'] ?? '');

        if(isset($_GET['id'])){
            runQuery("UPDATE `login` SET `name` = '$menu_name', `email` = '$menu_email', `password` = '$menu_password' WHERE `login`.`id` = ".$_GET['id']);

            echo "<script>alert('Staff Updated!');</script>";
            echo "<script>window.location.href='admin_staff'</script>";
        }else{
            runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`) VALUES (NULL, '$menu_name', '$menu_email', '$menu_password', '1', NULL, NULL)");

            echo "<script>alert('Staff Added!');</script>";
            echo "<script>window.location.href='admin_staff'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body class="h-screen">
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
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">User List</li>
                </a>

                <a href="admin_staff" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-yellow-500">List Of Admin</li>
                </a>

                <a href="account_logout" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Log Out</li>
                </a>
            </ol>
        </div>
        <div class="col-8 px-3">

            <div class="flex align-items-center justify-content-between p-3 surface-ground border-1 border-300">
                <h3 class="m-0 p-0 font-normal">
                    <span class="text-600">List Of Admin</span>
                    <span class="text-600 px-2 text-sm">/</span>
                    <span class="font-bold">Create</span>
                </h3>

                <a href="admin_staff" class="no-underline">
                    <button class="py-2 px-3 bg-grey-600 text-700 border-grey-600 border-round hover:bg-grey-500 border-noround border-1 border-300 cursor-pointer">Go Back</button>
                </a>
            </div>

            <form class="w-full h-full surface-0 border-round shadow-1 border-1 border-300 mt-3 p-3" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="materialupload"/>

                <table class="w-full h-full">
                    <tr>
                        <td class="px-3">Name</td>
                        <td><input required type="text" name="menu_name" placeholder="Enter name" class="w-25rem" value="<?php echo (!empty($profile['name']) ? $profile['name'] : ''); ?>"/></td>
                    </tr>

                    <tr>
                        <td class="px-3">Email</td>
                        <td><input required type="email" name="menu_email" placeholder="Enter email address" class="w-25rem" value="<?php echo (!empty($profile['email']) ? $profile['email'] : ''); ?>"/></td>
                    </tr>

                    <tr>
                        <td class="px-3">Password</td>
                        <td><input required type="text" name="menu_password" placeholder="Enter password" class="w-25rem" value="<?php echo (!empty($profile['password']) ? $profile['password'] : ''); ?>"/></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <a href="admin_staff" class="no-underline">
                                <button type="button" class="py-2 px-3 bg-grey-600 text-700 border-grey-600 border-round hover:bg-grey-500 border-noround border-1 border-300 cursor-pointer">Go Back</button>
                            </a>
                            <input type="submit" value="Submit" class="py-2"/>
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
</body>
</html>