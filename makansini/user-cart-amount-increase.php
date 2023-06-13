<?php
    include 'config.php';

    $user = null;

    if(isset($_SESSION['staff_session'])){
        $user = $_SESSION['staff_session'];
    }

    if(isset($_SESSION['customer_session'])){
        $user = $_SESSION['customer_session'];
    }

    $getmenu = fetchRow("SELECT * FROM menu where id =".$_GET['id']);
    
    runQuery("INSERT INTO `user_cart` (`id`, `menu`, `user`, `size`) VALUES (NULL, '".$_GET['id']."', '".$user."', '".$_GET['size']."')");

    $totalitem = numRows("SELECT * FROM user_cart where menu=".$_GET['id']." AND user=".$user);

    echo "<script>window.location.href='user-cart.php'</script>";
?>