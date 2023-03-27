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
        echo "<script>window.location.href='account_login.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <h3 class="text-center w-full">Register Account</h3>

    <form method="POST" class="flex align-items-center justify-content-center flex-column gap-3">
        <input type="hidden" name="create_account"/>

        <table>
            <tr>
                <td>Name</td>
                <td>
                    <input required type="text" name="name" placeholder="Enter Name"/>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input required type="text" name="email" placeholder="Enter Email"/>
                </td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>
                    <input required type="number" name="phone" placeholder="Enter Phone"/>
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <textarea required name="address" placeholder="Enter Address"></textarea>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input required type="password" name="password" placeholder="Enter Password"/>
                </td>
            </tr>
        </table>

        <div class="w-full flex align-items-center justify-content-center flex-column gap-3">
            <input type="submit" value="Submit"/>
            <a href="./account_login.php">Login here</a>
        </div>
    </form>
</body>
</html>