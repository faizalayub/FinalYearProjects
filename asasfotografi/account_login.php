<?php
    include 'config.php';

    if(isset($_SESSION['account_session'])){
        header("Location: article_list.php");
    }

    if(isset($_POST['login_account'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = fetchRow("SELECT * FROM `login` WHERE email = '$email' AND password = '$password'");

        if($result){
            $_SESSION['account_session'] = $result['id'];

            echo "<script>alert('Successfully login');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }else{
            echo "<script>alert('Invalid credential');</script>";
            echo "<script>window.location.href='account_login.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <h3 class="text-center">Log Masuk</h3>

    <form method="POST" class="flex align-items-center justify-content-center flex-column gap-3">
        <input type="hidden" name="login_account"/>

        <table>
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
            <a href="./account_create.php">Create account</a>
        </div>
    </form>

    <?php include './landingFooter.php'; ?>
</body>
</html>