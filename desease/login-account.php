<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="css/animations.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/flex.css">
        <title>Login</title>
    </head>
    <body>
        <center>
            <form class="container pb-6" action="" method="POST">
                <table border="0" style="margin: 0;padding: 0;width: 60%;">
                    <tr>
                        <td>
                            <p class="header-text">Welcome Back!</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="sub-text">Login with your details to continue</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <label for="login_email" class="form-label">Email: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <input type="email" name="login_email" class="input-text" placeholder="Email Address" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <label for="login_password" class="form-label">Password: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <input type="Password" name="login_password" class="input-text" placeholder="Password" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Login" name="login_submit" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                            <a href="register-account.php" class="hover-link1 non-style-link">Sign Up</a>
                        </td>
                    </tr>
                </table>
            </form>
        </center>
    </body>

    <?php
        include 'config.php';
        
        if(isset($_POST['login_submit'])){
            $email = $_POST['login_email'];
            $password = $_POST['login_password'];

            $result = fetchRow("SELECT * FROM `login` WHERE email = '$email' AND password = '$password'");

            if($result){
                switch($result['type']){
                    case 1:
                        $_SESSION['account_admin'] = $result['id'];

                        echo '<script>alert("Successfully login as admin");window.location.href="admin-index.php"</script>';
                    break;
                    case 2:
                        $_SESSION['account_session'] = $result['id'];

                        echo '<script>alert("Successfully login as user");window.location.href="user-index.php"</script>';
                    break;
                }
            }else{
                echo '<script>alert("Invalid credential, Please try again");window.location.href="login-account.php"</script>';
            }
        }
    ?>
</html>