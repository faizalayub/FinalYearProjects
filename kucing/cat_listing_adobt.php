<?php
    include 'config.php';

    if(!isset($_GET['id'])){
        header("Location: cat_login.php");exit;
    }

    runQuery("INSERT INTO `adopt` (`id`, `cat_id`, `user_id`, `status`) VALUES (NULL, '".$_GET['id']."', '".$_SESSION['account_session']."', 0)");

    echo "<script>alert('Cat adobted!');</script>";
    echo "<script>window.location.href='account_doptcat.php'</script>";
?>