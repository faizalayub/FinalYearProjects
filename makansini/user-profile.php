<?php
    include 'config.php';

    if(!isset($_SESSION['staff_session']) && !isset($_SESSION['customer_session'])){
        header("Location: auth-login.php");
        exit();
    }

    $authProfileID = null;
    $goBack = '';

    if(isset($_SESSION['staff_session'])){
        $goBack = './user-index.php';
        $authProfileID = $_SESSION['staff_session'];
    }

    if(isset($_SESSION['customer_session'])){
        $goBack = './user-menu.php';
        $authProfileID = $_SESSION['customer_session'];
    }

    $profiledata = fetchRow("SELECT * FROM login WHERE id = ".$authProfileID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'header.php'; ?>
</head>
<body>
    <div class="wrapper">

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <?php
                        if(!empty($accountData) && $accountData['type'] == 2){
                            echo '
                            <div class="row mb-2 mb-xl-3">
                                <div class="col-auto d-none d-sm-block">
                                    <h3>Welcome back, '.$accountData['name'].'</h3>
                                </div>
                            </div>';
                        }
                    ?>
                    <!--#END HEADER -->

                    <!--#START CONTENT -->
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <!--#START Profile -->
                            <div class="row">
                                <div class="col-xl-12 col-xxl-12">
                                    <div class="card flex-fill w-100">

                                        <div class="card-header">
                                            <h1 class="h3">My Profile</h1>
                                        </div>

                                        <div class="card-body pt-2 pb-3">
                                            <form method="POST">

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $profiledata['name']; ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $profiledata['email']; ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input type="tel" class="form-control" placeholder="Phone" name="phone" value="<?php echo $profiledata['phone']; ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Address</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="address" placeholder="Address" rows="3"><?php echo $profiledata['address']; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-form-label col-sm-2 text-sm-end">Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $profiledata['password']; ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <div class="col-sm-10 ms-sm-auto">
                                                        <a href="<?php echo $goBack; ?>" type="button" class="btn btn-secondary">Go Back</a>
                                                        <button type="submit" name="update_account" class="btn btn-success">Confirm Update Profile</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--#END Profile -->
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <!--#END CONTENT -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php
        if(isset($_POST['update_account'])){
            $name     = addslashes($_POST['name']);
            $email    = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $phone    = addslashes($_POST['phone']);
            $address  = addslashes($_POST['address']);
    
            runQuery("UPDATE `login` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `address` = '$address', `password` = '$password' WHERE `id` = ".$authProfileID);

            ToastMessage('Success', 'Profile details updated!', 'success', 'user-index.php');
        }
    ?>
</body>
</html>