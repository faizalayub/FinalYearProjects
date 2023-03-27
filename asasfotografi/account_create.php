<?php
    include 'config.php';

    if(isset($_POST['create_account'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`) VALUES (NULL, '$name', '$email', '$password')");

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
    <?php
        include './landingNavbar.php'; 
        
        if(isset($_SESSION['account_session'])){
            header("Location: account_editprofile.php");
        }
    ?>

    <h3 class="text-center w-full">Daftar Akaun</h3>

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

    <?php include './landingFooter.php'; ?>
</body>
</html>