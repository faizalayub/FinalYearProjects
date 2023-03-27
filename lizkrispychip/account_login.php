<?php
    include 'config.php';

    if(isset($_POST['login_account'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = fetchRow("SELECT * FROM `login` WHERE email = '$email' AND password = '$password'");

        if($result){
            switch($result['type']){
                case 1:
                    $_SESSION['account_admin'] = $result['id'];

                    echo "<script>alert('Successfully login');</script>";
                    echo "<script>window.location.href='admin_report'</script>";
                break;
                case 2:
                    $_SESSION['account_session'] = $result['id'];

                    echo "<script>alert('Successfully login');</script>";
                    echo "<script>window.location.href='account_dashboard'</script>";
                break;
            }
        }else{
            echo "<script>alert('Invalid credential');</script>";
            echo "<script>window.location.href='account_login'</script>";
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

    <div class="surface-ground w-full flex flex-column align-items-center py-8 gap-3 background-image h-screen">
        <h3 class="text-center">Login Account</h3>

        <form method="POST" class="flex align-items-center justify-content-center flex-column gap-3 surface-0 border-round border-1 border-300 shadow-1 p-3">
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
                <input type="submit" value="Submit" class="w-full bg-yellow-600 text-0"/>
                <a href="./account_create" class="no-underline">Create account</a>
            </div>
        </form>
    </div>
</body>
</html>