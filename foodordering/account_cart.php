<?php
    include 'config.php';

    if(!isset($_SESSION['account_session'])){
        header("Location: account_login.php");
        exit();
    }

    $totalCart = numRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <div class="grid py-6">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="account_dashboard.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">My Profile</li>
                </a>
                
                <a href="account_cart.php" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-indigo-500 flex align-items-center">My Cart <span class="text-sm py-1 px-2 border-round-2xl ml-auto bg-blue-600 text-0"><?php echo $totalCart; ?></span></li>
                </a>

                <a href="account_myorder.php" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover flex align-items-center">My History</li>
                </a>
            </ol>
        </div>
        <div class="col-8">
            <div class="p-3 surface-ground border-1 border-300">
                <h3 class="m-0">My Cart</h3>
                
                <table class="w-full surface-ground mt-3">
                    <tr class="shadow-1 border-1">
                        <th class="py-2 surface-0 px-3">Menu</th>
                        <th class="py-2 surface-0 px-3">Name</th>
                        <th class="py-2 surface-0 px-3">Total</th>
                        <th class="py-2 surface-0 px-3">Price</th>
                        <th class="py-2 surface-0 px-3">Category</th>
                        <th class="py-2 surface-0 px-3">Action</th>
                    </tr>

                    <?php
                        $totalPrice = 0;
                        $showed = 0;
                        $menurecord = fetchRows("SELECT * FROM menu");

                        foreach($menurecord as $key => $value){
                            
                            $cartIDStore = [];
                            $categoryname = fetchRow("SELECT * from category WHERE id = ".$value['category']);
                            $totalCart = numRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']." AND menu=".$value['id']);

                            if($totalCart == 0){
                                continue;
                            }

                            $allcartMenu = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']." AND menu=".$value['id']);

                            foreach($allcartMenu as $m){
                                $cartIDStore[] = $m['id'];
                            }

                            $showed++;

                            $totalPrice = ($totalPrice + ($value['price'] * $totalCart));
                    ?>
                    <tr>

                        <td class="py-2 surface-0 px-3">
                            <div class="flex align-items-center justify-content-center gap-2">
                                <img src="images/<?php echo $value['image']; ?>" class="w-5rem h-5rem" style="object-fit: cover;"/>
                            </div>
                        </td>

                        <td class="py-2 surface-0 px-3"><?php echo $value['name']; ?></td>

                        <td class="py-2 surface-0 px-3">
                            <div class="w-full flex align-items-center justify-content-center gap-3">
                                <a href="account_cartcountadjust.php?action=minus&id=<?php echo $value['id']; ?>" class="no-underline p-2 bg-blue-500 text-0 font-bold cursor-pointer">-</a>
                                <span><?php echo $totalCart; ?></span>
                                <a href="account_cartcountadjust.php?action=add&id=<?php echo $value['id']; ?>" class="no-underline p-2 bg-blue-500 text-0 font-bold cursor-pointer">+</a>
                            </div>
                        </td>

                        <td class="py-2 surface-0 px-3">
                            <div class="flex align-items-center gap-3">
                                <span class="font-bold">RM <?php echo $value['price']; ?></span>
                                <span>x</span>
                                <span class="text-500"><?php echo $totalCart; ?></span>
                                <span class="text-500">=</span>
                                <span class="text-500">RM <?php echo $value['price'] * $totalCart; ?></span>
                            </div>
                        </td>

                        <td class="py-2 surface-0 px-3"><?php echo $categoryname['name']; ?></td>

                        <td class="py-2 surface-0 px-3">
                            <div class="w-full flex flex-column gap-2">
                                <a class="text-sm bg-red-50 p-2 no-underline text-red-500" href="account_cartremove.php?id=<?php echo implode(',',$cartIDStore); ?>">Remove</a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if(empty($showed)){ ?>

                        <tr>
                            <td class="p-3" colspan="6">No Item Yet</td>
                        </tr>

                    <?php }else{ ?>

                        <tr>
                            <th colspan="6" class="text-right pt-3">
                                Total Price : RM <?php echo $totalPrice; ?>
                            </th>
                        </tr>

                        <tr>
                            <td>
                                <a href="account_cartcheckout.php">
                                    <button class="cursor-pointer hover:bg-green-500 bg-green-600 text-0 border-noround px-3 py-2 border-1 border-green-600">Checkout</button>
                                </a>
                            </td>
                        </tr>

                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</body>
</html>