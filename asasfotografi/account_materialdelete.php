<?php
    include 'config.php';
    
    runQuery("DELETE FROM `article` WHERE `article`.`id`=".$_GET['id']);

    echo "<script>alert('Material Deleted!');</script>";
    echo "<script>window.location.href='article_list.php'</script>";
?>