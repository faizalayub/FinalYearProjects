<?php
    include 'config.php';

    if(!isset($_GET['id'])){
        header("Location: admin_dashboard.php");exit;
    }

    runQuery("UPDATE `adopt` SET `status` = '1' WHERE `adopt`.`id` = ".$_GET['id']);

    echo "<script>alert('Adopt Approved!');</script>";
    echo "<script>window.location.href='admin_dashboard.php'</script>";
?>