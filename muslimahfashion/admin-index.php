<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
        header("Location: login.php");
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
	<?php include 'header.php'; ?>
</head>
<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>

        <div class="main">
            <?php include 'top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Yearly Sales</strong> Product</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chart -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Header -->
								<div class="card-header"></div>
                                <!--#END Header -->

                                <!--#START Chart Canvas -->
								<div class="card-body pt-2 pb-3">
                                    <canvas id="chart" class="w-100"></canvas>
								</div>
                                <!--#END Chart Canvas -->

							</div>
						</div>
					</div>
                    <!--#END Sales Chart -->

                    <!--#START Sales Table -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Header -->
								<div class="card-header"></div>
                                <!--#END Header -->

                                <!--#START Content -->
								<div class="card-body pt-2 pb-3">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Item</th>
                                                <th>Total Unit Sold</th>
                                                <th>2023 Collection</th>
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
                                                $productProduct = fetchRows("SELECT * FROM menu");

                                                if(!empty($productProduct)){
                                                    foreach($productProduct as $key => $c){

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
                                                                <td>'.($key + 1).'.</td>
                                                                <td>
                                                                    <div class="gap-3 d-flex">
                                                                        <img class="avatar img-fluid rounded me-1" src="images/'.$c['image'].'">

                                                                        <div class="d-flex flex-column gap-1">
                                                                            <span>'.$c['name'].'</span>
                                                                            <span>('.$categoryname['name'].')</span>
                                                                            <span>RM '.$c['price'].'/unit</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>'.$totalOrdered.'</td>
                                                                <td>RM '.($c['price'] * $totalOrdered).'</td>
                                                            </tr>
                                                        ';

                                                    }
                                                }else{
                                                    echo '<tr><td colspan="10">No Record</td></tr>';
                                                }
                                            ?>
                                        </tbody>
                                        <caption class="py-2 surface-ground shadow-1 text-700 font-italic">Total item sold calculated from january until december for each product</caption>
                                    </table>
								</div>
                                <!--#END Content -->

							</div>
						</div>
					</div>
                    <!--#END Sales Table -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <script src="./chart.js"></script>
    <script>
        let data = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Total Sale",
                backgroundColor: "rgba(34,46,60,1)",
                borderColor: "rgba(34,46,60,1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(34,46,60,0.4)",
                hoverBorderColor: "rgba(34,46,60,1)",
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
                    grid: { display: true, color: "rgba(34,46,60,0.2)" }
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