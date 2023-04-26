<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		include 'config.php';
        include 'header.php';

		$searchKey = ($_GET['searchkey'] ?? '');
        $searchcategory = ($_GET['searchcategory'] ?? '');
    ?>
</head>

<body>
	<div class="wrapper">
		<?php include 'sidebar.php'; ?>

		<div class="main">
			<?php include 'top-navbar.php'; ?>

			<main class="content">
				<div class="container-fluid p-0">

					<!--#START Filter --->
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body pt-3 pb-3">

									<label class="fw-bold pb-2">Search:</label>

									<form method="GET" class="d-flex gap-3">
										<select name="searchcategory" class="form-control">
											<option value="">-- Select Category --</option>
											<?php
												$categories = fetchRows("SELECT * FROM category");

												foreach($categories as $c){
													echo '<option '.($searchcategory == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
												}
											?>
										</select>

										<input type="text" name="searchkey" class="form-control" placeholder="Search" value="<?php echo $searchKey; ?>"/>

										<input type="submit" value="Search" class="btn btn-success"/>

										<a href="main-shop.php">
											<input class="btn btn-warning" type="button" value="Reset"/>
										</a>
									</form>

								</div>
							</div>
						</div>
					</div>
					<!--#END Filter --->
											
					<!--#START Product List --->
					<div class="row">
						<?php
							$alreadypush = [];
							$searchquery = '';

							if(!empty($searchKey)){
								$searchquery .= "name LIKE '%$searchKey%'";
							}

							if(!empty($searchcategory)){
								if(!empty($searchKey)){
									$searchquery .= " AND ";
								}

								$searchquery .= "category = ".$searchcategory;
							}

							if(empty($searchKey) && empty($searchcategory)){
								$searchquery = '(1=1)';
							}

							$productPreview = fetchRows("SELECT * FROM menu WHERE $searchquery AND is_active = 1");
							
							if(!empty($productPreview)){
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

								//# Loop Product
								foreach($productPreview as $c){
									$totalOrdered = 0;
									$categoryname = fetchRow("SELECT * from category WHERE id = ".$c['category']);
									$stockbalance = $c['in_stock'];

									if(isset($productOrder[$c['id']])){
										$totalOrdered = explode(',',$productOrder[$c['id']]);
										$totalOrdered = count($totalOrdered);
									}

									if(($stockbalance - $totalOrdered) <= 0){
										continue;
									}

									//# Product Card
									if(!in_array($c['id'], $alreadypush)){
										echo '
											<div class="col-2">
												<div class="card">

													<div class="card-body pt-3 pb-3">
														<img src="images/'.$c['image'].'" class="img img-thumbnail img-responsive"/>

														<div class="w-100 d-flex flex-column gap-2 pt-2 ">
															<span class="w-100 fw-bold">'.$c['name'].'</span>

															<span class="w-100 text-nowrap">'.$categoryname['name'].'</span>

															<span class="w-100 text-muted text-nowrap">Stock: '.($stockbalance - $totalOrdered).'</span>

															<span class="w-100 fst-italic text-success fw-bold text-nowrap">RM '.$c['price'].'</span>

															<a href="./main-shop-addcart.php?id='.$c['id'].'" class="btn btn-primary text-nowrap">Add Cart</a>
														</div>
													</div>

												</div>
											</div>
										';

										$alreadypush[] = $c['id'];
									}
								}
							}else{
								echo 'No record found';
							}
						?>
					</div>
					<!--#END Product List --->

				</div>
			</main>

			<?php include 'footer.php'; ?>
		</div>
	</div>
</body>
</html>
