<?php
    include 'config.php';

    if($_GET['status'] == 1){
        runQuery("UPDATE `article_permission` SET `status` = '1' WHERE `article_permission`.`id` = ".$_GET['id']);

        echo "<script>alert('Approved');window.location.href='list-request-material.php'</script>";
    }

    if($_GET['status'] == 0){
        runQuery("DELETE FROM `article_permission` WHERE `article_permission`.`id` = ".$_GET['id']);

        echo "<script>alert('Rejected');window.location.href='list-request-material.php'</script>";
    }
?>