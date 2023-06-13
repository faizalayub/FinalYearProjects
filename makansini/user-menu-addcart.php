<?php
    include 'config.php';

    $authProfileID = null;

    if(isset($_SESSION['staff_session'])){
        $authProfileID = $_SESSION['staff_session'];
    }

    if(isset($_SESSION['customer_session'])){
        $authProfileID = $_SESSION['customer_session'];
    }

    $getmenu = fetchRow("SELECT * FROM menu where id =".$_GET['id']);
    
    runQuery("INSERT INTO `user_cart` (`id`, `menu`, `user`, `size`) VALUES (NULL, '".$_GET['id']."', '".$authProfileID."', '".$_GET['size']."')");

    $totalitem = numRows("SELECT * FROM user_cart where menu=".$_GET['id']." AND user=".$authProfileID);

    echo "<script>alert('Added to cart, total ".$totalitem." ".$getmenu['name']."');</script>";

    echo "<script>window.location.href='user-cart.php'</script>";
?>