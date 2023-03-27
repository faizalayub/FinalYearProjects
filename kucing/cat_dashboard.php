<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: cat_login.php");
        exit();
    }

    if(isset($_POST['update_account'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $result = runQuery("UPDATE `login` SET `name` = '$name', `email` = '$email', `password` = '$password', `phone` = '$phone', `address` = '$address' WHERE `login`.`id` = ".$_SESSION['account_session']);

        echo "<script>alert('Account updated, please login again');</script>";
        echo "<script>window.location.href='cat_logout.php'</script>";
    }

    $profiledata = fetchRow("SELECT * FROM login WHERE id = ".$_SESSION['account_session']);
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
                    <li class="p-3 text-0 border-1 border-300 bg-indigo-500">My Profile</li>
                </a>
                
                <a href="account_doptcat.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover flex align-items-center">My Cat</li>
                </a>

                <a href="cat_logout.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover flex align-items-center">Logout</li>
                </a>
            </ol>
        </div>
        <div class="col-8">
            <div class="p-3 surface-ground border-1 border-300">

            <h3 class="m-0">Account Info</h3>

            <form method="POST" class="flex align-items-center justify-content-center">
                <input type="hidden" name="update_account"/>

                <table>
                    <tr>
                        <td class="px-3">Name</td>
                        <td>
                            <input class="w-25rem" required type="text" name="name" placeholder="Enter Name" value="<?php echo $profiledata['name']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3">Email</td>
                        <td>
                            <input class="w-25rem" required type="text" name="email" placeholder="Enter Email" value="<?php echo $profiledata['email']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3">Phone</td>
                        <td>
                            <input class="w-25rem" required type="text" name="phone" placeholder="Enter Phone" value="<?php echo $profiledata['phone']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3">Address</td>
                        <td>
                            <textarea class="w-25rem" required name="address" placeholder="Enter Address"><?php echo $profiledata['address']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-3">Password</td>
                        <td>
                            <input class="w-25rem" required type="password" name="password" placeholder="Enter Password" value="<?php echo $profiledata['password']; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <input type="submit" value="Confirm Update Profile"/>
                        </td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
    </div>
</body>
</html>