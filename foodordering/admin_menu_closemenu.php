<?php
    include 'config.php';

    $getmenu = fetchRow("SELECT * FROM menu where id =".$_GET['id']);
    $flag = ($getmenu['in_stock'] == '0' ? '1' : '0');

    runQuery("UPDATE `menu` SET `in_stock` = $flag WHERE `menu`.`id` =".$_GET['id']);

    echo "<script>window.location.href='admin_dashboard.php'</script>";
?>