<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_session'])){
        header("Location: login-account.php");
        exit();
    }

    $bodylist = fetchRows("SELECT * from body");
    $syntomlist = fetchRows("SELECT * from syntom");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'inc/header.php'; ?>
</head>
<body>
    <div class="wrapper">
        <?php include 'inc/sidebar.php'; ?>

        <div class="main">
            <?php include 'inc/top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Chat</strong> doctor</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chat -->
                    <div class="card" id="chat-container"></div>
                    <!--#END Chat -->

                </div>
            </main>

            <?php include 'inc/footer.php'; ?>
        </div>
    </div>

    <script src="./js/chatapp.js"></script>
    <script>
        var myProfileID = parseInt(`<?php echo $_SESSION['account_session']; ?>`);
        chatmodule('#chat-container');
    </script>
</body>
</html>