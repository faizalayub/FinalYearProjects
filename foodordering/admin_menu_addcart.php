<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        echo "<script>alert('Please login first');</script>";
        echo "<script>window.location.href='menu_list.php'</script>";
        exit;
    }

    $getmenu = fetchRow("SELECT * FROM menu where id =".$_GET['id']);
    
    runQuery("INSERT INTO `user_cart` (`id`, `menu`, `user`) VALUES (NULL, '".$_GET['id']."', '".$_SESSION['account_session']."')");

    $totalitem = numRows("SELECT * FROM user_cart where menu=".$_GET['id']." AND user=".$_SESSION['account_session']);

    echo "<script>alert('Added to cart, total ".$totalitem." ".$getmenu['name']."');</script>";

    if(isset($_GET['tocartpage'])){
        echo "<script>window.location.href='account_cart.php'</script>";
    }else{
        echo "<script>window.location.href='menu_list.php'</script>";
    }
?>