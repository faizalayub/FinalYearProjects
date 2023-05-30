<?php
    include 'config.php';

    $id = $_GET['id'];

    runQuery("UPDATE `menu` SET `is_active` = '0' WHERE `menu`.`id`=".$id);

    echo '<script>alert("Removed");window.location.href="admin-items.php"</script>';
?>