<?php
include 'config.php';

$receiptname = '';
$cartCollection = [];
$FourDigitRandomNumber = rand(1231,7879);
$profiledata = fetchRow("SELECT * FROM login WHERE id = ".$_SESSION['account_session']);

$payer_name = (isset($_POST['payer_name']) ? $_POST['payer_name'] : null);
$payer_method = (isset($_POST['payer_method']) ? $_POST['payer_method'] : null);
$payer_address = (isset($_POST['payer_address']) ? $_POST['payer_address'] : null);
$payer_receipt = (isset($_FILES['payer_receipt']) ? $_FILES['payer_receipt'] : null);

$temp_path = $payer_receipt['tmp_name'];
$file = pathinfo($payer_receipt['name']);
$fileType = $file["extension"];
$fileName = rand(222, 888).time().".$fileType";

$allcartMenu = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);

if(empty($allcartMenu)){
    header("Location: account_cart");
    exit();
}

foreach($allcartMenu as $m){
    $cartIDStore[] = $m['menu'];

    runQuery("DELETE FROM `user_cart` WHERE `user_cart`.`id`=".$m['id']);
}

move_uploaded_file($temp_path,"images/".$fileName);

runQuery("INSERT INTO `user_order` (`id`, `user_id`, `menu_id`, `status`, `unique_number`, `created_date`, `address`, `payment_method`, `delivery_method`, `payment_receipt`, `payer_name`) VALUES (NULL, '".$_SESSION['account_session']."', '".json_encode($cartCollection)."', '1', '$FourDigitRandomNumber', current_timestamp(), '$payer_address', '1', '$payer_method', '$fileName', '$payer_name')");
echo "<script>alert('Order added!'); window.location.href='account_cart';</script>";
?>