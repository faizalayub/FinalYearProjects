<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
        header("Location: account_login");
        exit();
    }

    $getBankinfo = fetchRow("SELECT * FROM `payment_account`");
    $totalorder = numRows("SELECT * FROM `user_order` WHERE status = 1");

    for($i = 1; $i <= 12; $i++){
        $totalCollection = 0;
        $mon = sprintf("%02d", $i);
        $fetchMonthly = fetchRows("SELECT * FROM `user_order` WHERE MONTH(`created_date`) =".$mon);

        if(!empty($fetchMonthly)){
            foreach($fetchMonthly as $sale){
                $productID = json_decode($sale['menu_id']);

                foreach($productID as $menu_id){
                    $itemprice = fetchRow("SELECT price FROM `menu` WHERE id=".$menu_id);
                    $totalCollection = ($totalCollection + $itemprice['price']);
                }
            }
        }

        $collection[] = $totalCollection;
    }

    if(isset($_POST['payment_bankinfo'])){
        $bankinfo_type = $_POST['bankinfo_type'];
        $bankinfo_holder = $_POST['bankinfo_holder'];
        $bankinfo_account = $_POST['bankinfo_account'];

        if(!empty($getBankinfo)){
            runQuery("UPDATE `payment_account` SET `type` = '$bankinfo_type', `holder_name` = '$bankinfo_holder', `account_number` = '$bankinfo_account' WHERE `payment_account`.`id` = ".$getBankinfo['id']);
        }else{
            runQuery("INSERT INTO `payment_account` (`id`, `type`, `holder_name`, `account_number`) VALUES (NULL, '$bankinfo_type', '$bankinfo_holder', '$bankinfo_account')");
        }

        echo "<script>alert('Account saved!'); window.location.href='admin_report';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body class="h-screen">
    <div class="sticky top-0 w-full flex align-items-center flex-column">
        <h1 class="m-0 p-0 w-full text-center bg-yellow-600 p-3 text-0 text-xl">Admin Dashboard</h1>
    </div>

    <div class="grid py-6">
        <div class="col-4">
            <ol class="list-none flex flex-column gap-2 m-0">
                <a href="admin_report" class="no-underline">
                    <li class="p-3 text-0 border-1 border-300 bg-yellow-500">Dashboard</li>
                </a>

                <a href="admin_dashboard" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Manage Product</li>
                </a>

                <a href="admin_order" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Order <span class="text-sm py-1 px-2 border-round ml-auto bg-yellow-600 text-0"><?php echo $totalorder; ?></span></li>
                </a>

                <a href="admin_userlist" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">User List</li>
                </a>

                <a href="admin_staff" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">List Of Admin</li>
                </a>

                <a href="account_logout" class="no-underline">
                    <li class="p-3 surface-ground border-1 border-300 cursor-pointer hover:surface-hover">Log Out</li>
                </a>
            </ol>
        </div>
        <div class="col-8 pr-6 pl-4">
            <div class="flex align-items-center justify-content-between p-3 surface-ground border-1 border-300">
                <h3 class="m-0 p-0">Dashboard</h3>
            </div>

            <div class="w-full h-full mt-3 shadow-1 border-1 border-300 border-round p-3 flex align-items-center gap-3 justify-content-center flex-column">
                <!-- ACCOUNT PAYMENT -->
                <form method="POST" class="w-full flex flex-column gap-3">
                <div class="w-full flex justify-content-between align-items-center border-bottom-1 border-200 surface-ground p-3 gap-3">
                    <span class="text-2xl w-full text-left">Setup Payment Account</span>
                    <button type="submit" name="payment_bankinfo" class="border-1 border-300 white-space-nowrap px-3 py-2 bg-yellow-400 border-round border-yellow-400 cursor-pointer">Update Bank Account</button> 
                </div>

                <div class="w-full flex flex-wrap gap-3">
                    <?php $defaultBankType = (!empty($getBankinfo['type']) ? $getBankinfo['type'] : ''); ?>
                    
                    <div class="flex flex-column flex-1 surface-0 gap-2 p-3 border-1 border-300 shadow-2 border-round">
                        <span class="w-full text-sm text-900">Bank</span>
                        <select name="bankinfo_type" required class="surface-0 animation-duration-300 fadein w-full border-none p-0 border-bottom-1 border-300 h-3rem px-3">
                            <option <?php echo ($defaultBankType == 'maybank' ? 'selected' : ''); ?> value="maybank">Maybank</option>

                            <option <?php echo ($defaultBankType == 'bankislam' ? 'selected' : ''); ?> value="bankislam">Bank Islam</option>

                            <option <?php echo ($defaultBankType == 'bsn' ? 'selected' : ''); ?> value="bsn">BSN</option>
                        </select>
                    </div>

                    <div class="flex flex-column flex-1 surface-0 gap-2 p-3 border-1 border-300 shadow-2 border-round">
                        <span class="w-full text-sm text-900">Account Holder Name</span>
                        <input value="<?php echo (!empty($getBankinfo) ? $getBankinfo['holder_name'] : ''); ?>" name="bankinfo_holder" required type="text" class="surface-0 animation-duration-300 fadein w-full border-none p-0 border-bottom-1 border-300 h-3rem px-3" placeholder="Enter your name"/>
                    </div>

                    <div class="flex flex-column flex-1 surface-0 gap-2 p-3 border-1 border-300 shadow-2 border-round">
                        <span class="w-full text-sm text-900">Account Number</span>
                        <input value="<?php echo (!empty($getBankinfo) ? $getBankinfo['account_number'] : ''); ?>" name="bankinfo_account" required type="number" class="surface-0 animation-duration-300 fadein w-full border-none p-0 border-bottom-1 border-300 h-3rem px-3" placeholder="Enter your name"/>
                    </div>
                </div>
                </form>

                <!-- REPORT CHART -->
                <div class="mt-4 w-full flex justify-content-between align-items-center border-bottom-1 border-200 surface-ground p-3 gap-3">
                    <span class="text-2xl w-full text-left">Total Sales 2023</span>

                    <!-- <button class="border-1 border-300 white-space-nowrap px-3 py-2 bg-yellow-400 border-round border-yellow-400 cursor-pointer">Export as PDF</button> -->
                </div>
                <canvas id="chart" class="w-10 h-30rem"></canvas>

                <table class="w-full border-1 border-300 mt-4">
                    <thead>
                        <tr>
                            <th class="border-1 border-300 p-1">No.</th>
                            <th class="border-1 border-300 p-1">Item</th>
                            <th class="border-1 border-300 p-1">Total Unit Sold</th>
                            <th class="border-1 border-300 p-1">2023 Collection</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            //# Collect Order Product
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

                            //# Menu Record
                            $productKerepek = fetchRows("SELECT * FROM menu");

                            if(!empty($productKerepek)){
                                foreach($productKerepek as $key => $c){

                                    $id = $c['id'];
                                    $totalOrdered = 0;
                                    $categoryname = fetchRow("SELECT * from category WHERE id = ".$c['category']);
                                    // $fetchOrder = fetchRows("SELECT * FROM `user_order` WHERE JSON_CONTAINS(menu_id, '[$id]')");
                                    // $calculateTotalOrder = count($fetchOrder);

                                    if(isset($productOrder[$id])){
                                        $totalOrdered = explode(',',$productOrder[$id]);
                                        $totalOrdered = count($totalOrdered);
                                    }

                                    echo '
                                        <tr>
                                            <td class="p-2 border-1 border-300 text-center">'.($key + 1).'.</td>
                                            <td class="p-2 border-1 border-300">
                                                <div class="gap-3 flex">
                                                    <img class="h-4rem w-4rem" src="images/'.$c['image'].'">
                                                    <div class="flex flex-column gap-1">
                                                        <span class="text-800">'.$c['name'].'</span>
                                                        <span class="text-600 text-sm">('.$categoryname['name'].')</span>
                                                        <span class="text-700">RM '.$c['price'].'/unit</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-2 border-1 border-300 text-center">'.$totalOrdered.'</td>
                                            <td class="p-2 border-1 border-300 text-center">RM '.($c['price'] * $totalOrdered).'</td>
                                        </tr>
                                    ';

                                }
                            }
                        ?>
                    </tbody>
                    <caption class="py-2 surface-ground shadow-1 text-700 font-italic">Total item sold calculated from january until december for each kerepek</caption>
                </table>
            </div>
        </div>
    </div>

    <script src="./asset/chart.js"></script>

    <script>
        let data = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Total Sale",
                backgroundColor: "rgba(213,163,38,1)",
                borderColor: "rgba(213,163,38,1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(213,163,38,0.4)",
                hoverBorderColor: "rgba(213,163,38,1)",
                data: JSON.parse(`<?php echo json_encode($collection); ?>`),
            }]
        };

        let options = {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                y: {
                    ticks: {
                        callback: function(value, index, ticks) {
                            return 'RM ' + value;
                        }
                    },
                    stacked: true,
                    grid: { display: true, color: "rgba(213,163,38,0.2)" }
                },
                x: {
                    grid: { display: false }
                }
            },
            animation: {
                duration: 1,
                onComplete: function({ chart }) {
                    const ctx = chart.ctx;

                    chart.config.data.datasets.forEach(function(dataset, i) {
                        const meta = chart.getDatasetMeta(i);

                        meta.data.forEach(function(bar, index) {
                            const data = dataset.data[index];

                            ctx.fillText(data, bar.x, bar.y - 5);
                        });
                    });
                }
            }
        };

        new Chart('chart', {
            type: 'bar',
            options: options,
            data: data
        });
    </script>
</body>
</html>