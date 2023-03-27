<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: account_login.php");
        exit();
    }

    if(isset($_POST['update_account'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = runQuery("UPDATE `login` SET `name` = '$name', `email` = '$email', `password` = '$password' WHERE `login`.`id` = ".$_SESSION['account_session']);

        echo "<script>alert('Account updated, please login again');</script>";
        echo "<script>window.location.href='account_logout.php'</script>";
    }

    $profiledata = fetchRow("SELECT * FROM login WHERE id = ".$_SESSION['account_session']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
    include './metaheader.php';
?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <h3 class="text-center">Edit Profile</h3>

    <form method="POST" class="flex align-items-center justify-content-center">
        <input type="hidden" name="update_account"/>

        <table>
            <tr>
                <td>Name</td>
                <td>
                    <input required type="text" name="name" placeholder="Enter Name" value="<?php echo $profiledata['name']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input required type="text" name="email" placeholder="Enter Email" value="<?php echo $profiledata['email']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>MyKad/IC Number</td>
                <td>
                    <input required type="text" disabled readonly value="<?php echo $profiledata['age']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input required type="password" name="password" placeholder="Enter Password" value="<?php echo $profiledata['password']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="./index.php">
                        <button type="button">Cancel</button>
                    </a>
                </td>
                <td>
                    <input type="submit" value="Submit"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>