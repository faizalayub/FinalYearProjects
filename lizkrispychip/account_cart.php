<?php
    include 'config.php';

    $defaultAddress = 'Lot PT17178, Jalan Tun Abdul Razak, Hang Tuah Jaya, 75450 Ayer Keroh';

    if(!isset($_SESSION['account_session'])){
        header("Location: account_login");
        exit();
    }

    if(isset($_POST['pay_cash'])){
        $delivery_method = ($_POST['delivery_method'] ?? '');
        $delivery_address = ($_POST['delivery_address'] ?? '');

        if($delivery_method == 1){
            $delivery_address = $defaultAddress;
        }

        echo "<script>window.location.href = `checkout_cash.php?method=".$delivery_method."&address=".$delivery_address."`;</script>";
        exit();
    }

    if(isset($_POST['pay_online'])){
        $delivery_method = ($_POST['delivery_method'] ?? '');
        $delivery_address = ($_POST['delivery_address'] ?? '');

        if($delivery_method == 1){
            $delivery_address = $defaultAddress;
        }

        echo "<script>window.location.href = `checkout_online.php?method=".$delivery_method."&address=".$delivery_address."`;</script>";
        exit();
    }

    $totalCart = numRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);
    $profiledata = fetchRow("SELECT * FROM login WHERE id = ".$_SESSION['account_session']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <div class="grid py-8">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="account_dashboard" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">My Profile</li>
                </a>
                
                <a href="account_cart" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-yellow-500 flex align-items-center">My Cart <span class="text-sm py-1 px-2 border-round ml-auto bg-yellow-600 text-0"><?php echo $totalCart; ?></span></li>
                </a>

                <a href="account_myorder" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover flex align-items-center">My History</li>
                </a>
            </ol>
        </div>
        <div class="col-8 px-6">
            <div class="p-3 surface-200 border-1 border-300">
                <h3 class="m-0">My Cart</h3>

                <form method="POST">
                    <table class="w-full surface-200 mt-3">
                        <tr class="border-1">
                            <th class="py-2 surface-0 px-3"></th>
                            <th class="py-2 surface-0 px-3">Name</th>
                            <th class="py-2 surface-0 px-3">Total</th>
                            <th class="py-2 surface-0 px-3">Price</th>
                            <th class="py-2 surface-0 px-3">Category</th>
                            <th class="py-2 surface-0 px-3">Action</th>
                        </tr>

                        <?php
                            $allCartCollection = [];
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

                                $allCartCollection[] = array(
                                    'id' => $value['id'],
                                    'quantity' => $totalCart,
                                );
                        ?>
                        <tr>

                            <td class="py-2 surface-0 px-3">
                                <div class="flex align-items-center justify-content-center gap-2">
                                    <img src="images/<?php echo $value['image']; ?>" class="border-1 border-0 border-round shadow-2 w-5rem h-5rem" style="object-fit: cover;"/>
                                </div>
                            </td>

                            <td class="py-2 surface-0 px-3"><?php echo $value['name']; ?></td>

                            <td class="py-2 surface-0 px-3">
                                <div class="w-full flex align-items-center justify-content-center gap-3 surface-100 py-2">
                                    <a href="account_cartcountadjust?action=minus&id=<?php echo $value['id']; ?>" class="no-underline p-2 surface-500 text-0 font-bold cursor-pointer border-round">-</a>
                                    <span><?php echo $totalCart; ?></span>
                                    <a href="account_cartcountadjust?action=add&id=<?php echo $value['id']; ?>" class="no-underline p-2 surface-500 text-0 font-bold cursor-pointer border-round">+</a>
                                </div>
                            </td>

                            <td class="py-2 surface-0 px-3">
                                <div class="flex align-items-center gap-3">
                                    <span class="font-bold white-space-nowrap">RM <?php echo $value['price']; ?></span>
                                    <span>x</span>
                                    <span class="text-500"><?php echo $totalCart; ?></span>
                                    <span class="text-500">=</span>
                                    <span class="text-500 white-space-nowrap">RM <?php echo $value['price'] * $totalCart; ?></span>
                                </div>
                            </td>

                            <td class="py-2 surface-0 px-3"><?php echo $categoryname['name']; ?></td>

                            <td class="py-2 surface-0 px-3">
                                <div class="w-full flex flex-column gap-2">
                                    <a class="text-sm bg-red-50 p-2 no-underline text-red-500" href="account_cartremove?id=<?php echo implode(',',$cartIDStore); ?>">Remove</a>
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
                                <th colspan="6" class="text-right p-3 surface-0">
                                    Total Price : RM <?php echo $totalPrice; ?><br>
                                    <span class="font-italic text-600 text-right w-full">For delivery, we will charge for RM 20</span>
                                </th>
                            </tr>

                            <tr>
                                <td colspan="6" class="py-3">
                                    <label class="w-full font-normal text-left h-3rem">Delivery Method</label>
                                    <select name="delivery_method" class="w-full shadow-1 text-base mt-2" required>
                                        <option value="0" disabled="">Choose</option>
                                        <option value="1">Pick-Up</option>
                                        <option value="2" selected>Delivery</option>
                                    </select>
                                </td>
                            </tr>

                            <tr id="delivery_address_field">
                                <td colspan="6" class="py-3">
                                    <label class="w-full font-normal text-left">Enter Delivery Address</label>
                                    <textarea name="delivery_address" class="w-full shadow-1 text-base mt-2"><?php echo $profiledata['address']; ?></textarea>
                                </td>
                            </tr>

                            <tr id="pickup_address_field">
                                <td colspan="6" class="py-3">
                                    <label class="w-full font-normal text-left">Pickup Address</label><br>
                                    <small class="mt-2">Kindly please pickup to the below address anytime</small><br>
                                    <address class="text-600 w-full surface-100 p-3 border-1 border-300 border-round border-dashed mt-2"><?php echo $defaultAddress; ?></address>
                                </td>
                            </tr>

                            <tr>
                                <td class="py-3 flex align-items-center gap-3">
                                    <input type="submit" name="pay_cash" value="Cash On Delivery" class="border-round white-space-nowrap cursor-pointer hover:bg-yellow-500 bg-yellow-600 text-0 border-noround px-3 py-2 border-1 border-yellow-600" />
                                    <input type="submit" name="pay_online" value="Online Transfer" class="border-round white-space-nowrap cursor-pointer hover:bg-yellow-500 bg-yellow-600 text-0 border-noround px-3 py-2 border-1 border-yellow-600"/>
                                    
                                    <!-- <div class="relative">
                                        <div id="paypal-button-container" class="w-full flex align-items-center justify-content-center flex-column pointer-events-none select-none"></div>
                                        <input type="submit" name="pay_online" value="Online Transfer" class="absolute top-0 left-0 z-5 w-full h-full"/>
                                    </div> -->
                                </td>
                            </tr>

                        <?php } ?>

                    </table>
                </form>
            </div>
        </div>
    </div>

    <script src="https://www.paypal.com/sdk/js?client-id=test&disable-funding=card"></script>
    <script>
        let cartItems = JSON.parse(`<?php echo json_encode($allCartCollection); ?>`);

        let onChangeCallback = function(value){
            let addressField = document.querySelector('#delivery_address_field');
            let pickupField = document.querySelector('#pickup_address_field');

            if(value == 1){
                if(addressField) addressField.style.display = 'none';
                if(pickupField) pickupField.style.display = '';
            }else{
                if(addressField) addressField.style.display = '';
                if(pickupField) pickupField.style.display = 'none';
            }
        };

        if(document.querySelector('[name="delivery_method"]')){
            document.querySelector('[name="delivery_method"]').addEventListener('change', function(e){
                onChangeCallback(e.target.value);
            });
        }

        onChangeCallback(2);

        if(document.querySelector('#paypal-button-container')){
            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    color:  'gold',
                    tagline: false,
                    label:  'checkout'
                }
            }).render('#paypal-button-container');
        }
    </script>
</body>
</html>