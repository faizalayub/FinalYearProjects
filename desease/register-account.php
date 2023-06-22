<?php
    include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/animations.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/signup.css">
        <title>Create Account</title>
        <style>
            .container{
                animation: transitionIn-X 0.5s;
            }
        </style>
    </head>
    <body>
        <center>
            <form class="container" action="" method="POST">
                <table border="0" style="width: 69%;">
                    <tr>
                        <td colspan="2">
                            <p class="header-text">Let's Get Started</p>
                            <p class="sub-text">You are not alone. Create your user account.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="newemail" class="form-label">Email: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="email" name="email" class="input-text" placeholder="Email Address" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="newemail" class="form-label">MyKad Number: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="text" name="ic" class="input-text" placeholder="My Kad" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="newemail" class="form-label">Birthday Date: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="date" name="birthdate" class="input-text" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="newemail" class="form-label">Full Name: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="text" name="fullname" class="input-text" placeholder="Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="newemail" class="form-label">Age: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="text" name="age" class="input-text" placeholder="Age" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label class="form-label">Category of Health Concern: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input required class="input-text" placeholder="Category of Health Concern" name="healthyconcern" list="HealthConcern"></input>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label class="form-label">Experienced Symptom: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input required class="input-text" placeholder="Experienced Symptom" name="healthyexperince" list="ExperiencedSymptom"></input>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="tele" class="form-label">Mobile Number: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="tel" name="phone" class="input-text"  placeholder="ex: 01712345678" >
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="tele" class="form-label">Address: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <textarea class="input-text" placeholder="Address" rows="3" name="address"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="newpassword" class="form-label">Password: </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <input type="password" name="password" class="input-text" placeholder="New Password" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                        </td>
                        <td>
                            <input type="submit" value="Sign Up" name="create_account" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                            <a href="login-account.php" class="hover-link1 non-style-link">Login</a>
                            <br><br><br>
                        </td>
                    </tr>
                    </tr>
                </table>
            </form>
        </center>

        <datalist id="ExperiencedSymptom">
            <?php 
                $expSyntom = fetchRows("SELECT * FROM `experience_syntom`");

                if(!empty($expSyntom)){
                    foreach($expSyntom as $exp){
                        echo "<option value='".$exp['name']."'>";
                    }
                }
            ?>
        </datalist>

        <datalist id="HealthConcern">
            <?php 
                $expSyntom = fetchRows("SELECT * FROM `health_concern`");

                if(!empty($expSyntom)){
                    foreach($expSyntom as $exp){
                        echo "<option value='".$exp['name']."'>";
                    }
                }
            ?>
        </datalist>
    </body>

    <?php
        if(isset($_POST['create_account'])){
            $name           = addslashes($_POST['fullname']);
            $email          = addslashes($_POST['email']);
            $password       = addslashes($_POST['password']);
            $phone          = addslashes($_POST['phone']);
            $address        = addslashes($_POST['address']);
            $ic             = addslashes($_POST['ic']);
            $age            = addslashes($_POST['age']);
            $healthyconcern = addslashes($_POST['healthyconcern']);
            $healthyexperince = addslashes($_POST['healthyexperince']);
            $birthdate      = addslashes($_POST['birthdate']);

            $result = runQuery("INSERT INTO `login` (`id`, `name`, `email`, `password`, `type`, `phone`, `address`, `ic`, `age`, `birthdate`, `healthyconcern`, `experience_syntom`) VALUES (NULL, '$name', '$email', '$password', '2', '$phone', '$address', '$ic', '$age', '$birthdate', '$healthyconcern', '$healthyexperince')");

            echo '<script>alert("Account created successfully");window.location.href="login-account.php"</script>';
        }
    ?>
</html>