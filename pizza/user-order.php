<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: login.php");
        exit();
    }
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
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3>Welcome back, <?php echo (!empty($accountData) ? $accountData['name'] : '') ?></h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START CONTENT -->
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <!--#START Profile -->
                            <div class="row">
                                <div class="col-xl-12 col-xxl-12">
                                    <div class="card flex-fill w-100">

                                        <div class="card-header">
                                            <h1 class="h3">Customer Order</h1>
                                        </div>

                                        <div class="card-body pt-2 pb-3">
                                            content
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--#END Profile -->
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <!--#END CONTENT -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>