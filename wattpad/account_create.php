<?php
    include 'config.php';

    if(isset($_POST['create_account'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $password = $_POST['password'];

        $checkExist = fetchRow("SELECT * FROM `login` WHERE age='".$age."'");

        if($checkExist){
            echo "<script>alert('IC already exist, please try again');</script>";
        }else{
            if(!is_numeric($age)){
                echo "<script>alert('Invalid IC Number');</script>";
            }else{
                $result = runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `age`) VALUES (NULL, '$name', '$email', '$password', '$age')");

                echo "<script>alert('Account created successfully');</script>";
                echo "<script>window.location.href='account_login.php'</script>";
            }
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

    <h3 class="text-center w-full">Register Account</h3>

    <form method="POST" class="flex align-items-center justify-content-center flex-column gap-3">
        <input type="hidden" name="create_account"/>

        <table>
            <tr>
                <td colspan="2">
                    <img src="./logo.jpeg" height="150" style="margin-left: 3em;"/>
                </td>
            </tr>
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
                <td>MyKad/IC Number <br><span class="text-600 text-sm">(No space & symbol)</span></td>
                <td>
                    <input required minlength="12" maxlength="12" type="text" name="age" placeholder="Enter IC Number"/>
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