<?php
    include 'config.php';

    runQuery("UPDATE `article` SET `is_restricted` = '1' WHERE `article`.`id` =".$_GET['id']);

    echo "<script>alert('Article updated!');</script>";
    echo "<script>window.location.href='article_details.php?id=".$_GET['id']."'</script>";
?>