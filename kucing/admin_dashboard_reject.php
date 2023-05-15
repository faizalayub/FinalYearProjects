<?php
    include 'config.php';

    if(!isset($_GET['id'])){
        header("Location: admin_dashboard.php");exit;
    }

    runQuery("DELETE FROM `adopt` WHERE `adopt`.`id` = ".$_GET['id']);

    echo "<script>alert('Adopt Rejected!');</script>";
    echo "<script>window.location.href='admin_dashboard.php'</script>";
?>