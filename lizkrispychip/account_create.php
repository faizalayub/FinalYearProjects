<?php
    include 'config.php';

    if(isset($_POST['create_account'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $result = runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`) VALUES (NULL, '$name', '$email', '$password', '2', '$phone', '$address')");

        echo "<script>alert('Account created successfully');</script>";
        echo "<script>window.location.href='account_login'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <div class="w-full flex flex-column surface-ground align-items-center py-8 gap-3 background-image h-screen">
        <h3 class="text-center w-full">Register Account</h3>

        <form method="POST" class="flex align-items-center justify-content-center flex-column gap-3 surface-0 border-round border-1 border-300 shadow-1 p-3">
            <input type="hidden" name="create_account"/>

            <table>
                <tr>
                    <td class="py-1">Name</td>
                    <td class="py-1">
                        <input required type="text" name="name" placeholder="Enter Name" class="w-full"/>
                    </td>
                </tr>
                <tr>
                    <td class="py-1">Email</td>
                    <td class="py-1">
                        <input required type="text" name="email" placeholder="Enter Email" class="w-full"/>
                    </td>
                </tr>
                <tr>
                    <td class="py-1">Phone</td>
                    <td class="py-1">
                        <input required type="number" name="phone" placeholder="Enter Phone" class="w-full"/>
                    </td>
                </tr>
                <tr>
                    <td class="py-1">Address</td>
                    <td class="py-1">
                        <textarea required name="address" placeholder="Enter Address" class="w-full"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="py-1">Password</td>
                    <td class="py-1">
                        <input required type="password" name="password" placeholder="Enter Password" class="w-full"/>
                    </td>
                </tr>
            </table>

            <div class="w-full flex align-items-center justify-content-center flex-column gap-3">
                <input type="submit" value="Register Account" class="w-full bg-yellow-600 text-0"/>
                <a href="./account_login" class="no-underline">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>