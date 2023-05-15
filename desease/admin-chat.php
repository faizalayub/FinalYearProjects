<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
        header("Location: login-account.php");
        exit();
    }
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

                    <!--#START Breadscum -->
                    <div class="row">
                        <div class="col-auto d-none d-sm-block">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>
                                    <li class="breadcrumb-item">Chat</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--#END Breadscum -->

                    <!--#START Headline -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Live</strong> chat</h3>
                        </div>
                    </div>
                    <!--#END Headline -->

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
        chatmodule('#chat-container');
    </script>
</body>
</html>