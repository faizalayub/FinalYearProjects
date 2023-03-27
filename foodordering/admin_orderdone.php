<?php
    include 'config.php';

    runQuery("UPDATE `user_order` SET `status` = '0' WHERE `user_order`.`id`=".$_GET['id']);

    echo "<script>alert('Order Updated');</script>";
    echo "<script>window.location.href='admin_order.php'</script>";
?>