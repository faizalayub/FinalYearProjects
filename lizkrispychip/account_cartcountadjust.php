<?php
    include 'config.php';

    $id = ($_GET['id']);
    $totalCart = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']." AND menu=".$id);

    //# Get Kerepek Stock
    $totalOrdered = 0;
    $totalCurrentcart = 0;
    $kerepek = fetchRow("SELECT * FROM menu WHERE id =".$id);
    $kerepekStock = $kerepek['in_stock'];

    //# Collect Cart Count
    $totalCurrentcart = numRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']." AND menu=".$id);

    //# Collect Order Count
    $productOrder = [];
    $orderFetch = fetchRows("SELECT * FROM `user_order`");

    foreach($orderFetch as $order){
        $itemorder = json_decode($order['menu_id']);

        foreach($itemorder as $o){
            if(isset($productOrder[$o])){
                $productOrder[$o] = $productOrder[$o].",".$o;
            }else{
                $productOrder[$o] = $o;
            }
        } 
    }

    //# Current Order For Single Kerepek
    if(isset($productOrder[$id])){
        $totalOrdered = explode(',',$productOrder[$id]);
        $totalOrdered = count($totalOrdered);
    }

    //# Conclusion
    if(!empty($totalCart)){
        switch($_GET['action']){

            case 'add':
                if(($kerepekStock - $totalOrdered - $totalCurrentcart) <= 0){
                    echo '<script>alert("Sorry, this product is out of stock"); window.location.href="account_cart"</script>';
                }else{
                    header("Location: admin_menu_addcart?tocartpage&id=".$id);
                }
            break;

            case 'minus':
                header("Location: account_cartremove?id=".$totalCart[0]['id']);
            break;

        }
    } 
?>