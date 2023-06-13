<?php
    include 'config.php';

    $status = $_GET['status'];
    $pic = $_GET['pic'];
    $ordernumber = $_GET['ordernumber'];
    $orderMessage = '';
    $adminMessage = '';
    $currentAuth = ($_SESSION['staff_session']);

    runQuery("UPDATE `user_order` SET `status` = '$status' WHERE `user_order`.`id`=".$_GET['id']);

    if($status == 1){
        $adminMessage = 'has change #'.$ordernumber.' status to Preparing';
        $orderMessage = 'We are preparing your order, Thank you for you purchase!';
    }

    if($status == 2){
        $adminMessage = 'has change #'.$ordernumber.' status to Prepared';
        $orderMessage = 'Your order has been prepared!';
    }

    if($status == 3){
        $adminMessage = 'has change #'.$ordernumber.' status to Ready';
        $orderMessage = 'Your order is ready!';
    }

    if($status == 4){
        $adminMessage = 'has change #'.$ordernumber.' status to Completed';
        $orderMessage = 'Your order has complete!';
    }

    runQuery("INSERT INTO `notification` (`id`, `user_id`, `message`, `created_date`, `status`, `type`) VALUES (NULL, '$pic', 'Order ID #$ordernumber: $orderMessage', current_timestamp(), '0', 'customer_order_status')");
    runQuery("INSERT INTO `notification` (`id`, `user_id`, `message`, `created_date`, `status`, `type`) VALUES (NULL, '2', 'Staff ID: $currentAuth $adminMessage!', current_timestamp(), '0', 'admin_order_status')");

    echo "<script>window.location.href='user-order.php'</script>";
?>