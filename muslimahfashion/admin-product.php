<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_admin'])){
        header("Location: login.php");
        exit();
    }

    $totalorder = numRows("SELECT * FROM `user_order` WHERE status = 1");
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
                            <h3><strong>Manage</strong> Product</h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">
							<a href="admin-create-product.php" class="btn btn-primary">Create Product</a>
						</div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START BODY -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Content -->
								<div class="card-body pt-4 pb-3">
                                
                                    <table class="table table-bordered table-md w-100">
                                        <tr class="shadow-1 border-1">
                                            <th>No.</th>
                                            <th>Picture</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Stock</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>

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
                                            $menurecord = fetchRows("SELECT * FROM menu");

                                            foreach($menurecord as $key => $value){

                                                $totalOrdered = 0;
                                                $isOutofstock = false;
                                                $categoryname = fetchRow("SELECT * from category WHERE id = ".$value['category']);

                                                if(isset($productOrder[$value['id']])){
                                                    $totalOrdered = explode(',',$productOrder[$value['id']]);
                                                    $totalOrdered = count($totalOrdered);
                                                }

                                                $isOutofstock = (($value['in_stock'] - $totalOrdered) <= 0);
                                        ?>
                                        <tr>
                                            <td align="center">
                                                <?php echo ($key + 1); ?>
                                            </td>
                                            <td align="center">
                                                <img src="images/<?php echo $value['image']; ?>" class="img-fluid pe-2" style="height: 200px;"/>
                                            </td>
                                            <td align="center">
                                                <?php echo $value['name']; ?>
                                            </td>
                                            <td>
                                                RM <?php echo $value['price']; ?>
                                            </td>
                                            <td align="center">
                                                <?php echo $categoryname['name']; ?>
                                            </td>
                                            <td>
                                                <span class="<?php echo ($isOutofstock ? 'text-red-600' : ''); ?> font-bold">
                                                    <?php echo $totalOrdered; ?> / <?php echo $value['in_stock']; ?>
                                                </span>
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if($value['is_active'] == 1){
                                                        echo '<a class="badge bg-success">Showing</a>';
                                                    }else{
                                                        echo '<a class="badge bg-secondary">Hidden</a>';
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <div class="w-full flex flex-column gap-2">
                                                    <a class="text-sm surface-100 p-2 no-underline" href="admin-product-deactive.php?id=<?php echo $value['id']; ?>">
                                                        <i class="align-middle" data-feather="eye"></i>
                                                    </a>

                                                    <a class="text-sm surface-100 p-2 no-underline" href="admin-create-product.php?id=<?php echo $value['id']; ?>">
                                                        <i class="align-middle" data-feather="edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                        <?php if(empty($menurecord)){ ?>
                                            <tr><td class="p-3" colspan="10">No Record Yet</td></tr>
                                        <?php } ?>
                                    </table>

								</div>
                                <!--#END Content -->

							</div>
						</div>
					</div>
                    <!--#END BODY -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>