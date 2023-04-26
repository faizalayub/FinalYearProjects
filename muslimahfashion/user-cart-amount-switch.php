<?php
    include 'config.php';

    $totalCart = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']." AND menu=".$_GET['id']);

    if(!empty($totalCart)){
        switch($_GET['action']){
            case 'add':
                header("Location: user-cart-amount-increase.php?tocartpage&id=".$_GET['id']);
            break;
            case 'minus':
                header("Location: user-cart-amount-reduce.php?id=".$totalCart[0]['id']);
            break;
        }
    } 
?>