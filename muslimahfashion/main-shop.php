<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		include 'config.php';
        include 'header.php';

		$searchKey = ($_GET['searchkey'] ?? '');
        $searchcategory = ($_GET['searchcategory'] ?? '');
        $searchtype = ($_GET['searchtype'] ?? '');

		$sizeChart = array(
			array( 'size'=> 'XS', 'Length'=> 27, 'Width'=> 16.5, 'Sleeve'=> 8, 'Weight'=> 40 ),
			array( 'size'=> 'S', 'Length'=> 28, 'Width'=> 18, 'Sleeve'=> 8.25, 'Weight'=> 50 ),
			array( 'size'=> 'M', 'Length'=> 29, 'Width'=> 20, 'Sleeve'=> 8.63, 'Weight'=> 60 ),
			array( 'size'=> 'L', 'Length'=> 30, 'Width'=> 22, 'Sleeve'=> 9.13, 'Weight'=> 70 ),
			array( 'size'=> 'XL', 'Length'=> 31, 'Width'=> 24, 'Sleeve'=> 9.63, 'Weight'=> 80 ),
			array( 'size'=> 'XXL', 'Length'=> 32, 'Width'=> 26, 'Sleeve'=> 10.25, 'Weight'=> 90 ),
			array( 'size'=> 'XXXL', 'Length'=> 33, 'Width'=> 28, 'Sleeve'=> 10.25, 'Weight'=> 100 )
		);
    ?>
</head>

<body>
	<div class="wrapper">
		<?php include 'sidebar.php'; ?>

		<div class="main">
			<?php include 'top-navbar.php'; ?>

			<main class="content">
				<div class="container-fluid p-0">

					<!--#START Content --->
					<div class="row">
						<div class="col-3">
							<div class="card">
								<div class="card-body pt-3 pb-3">

									<label class="fw-bold pb-2">Search:</label>

									<form method="GET" class="d-flex flex-column gap-3">
										<select name="searchcategory" class="form-control">
											<option value="">-- Select Category --</option>
											<?php
												$categories = fetchRows("SELECT * FROM category");

												foreach($categories as $c){
													echo '<option '.($searchcategory == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
												}
											?>
										</select>

										<select name="searchtype" class="form-control">
											<option value="">-- Select Type --</option>
											<?php
												$bodyparts = fetchRows("SELECT * FROM body_part");

												foreach($bodyparts as $c){
													echo '<option '.($searchtype == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
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
						<div class="col-9 row">
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

								if(!empty($searchtype)){
									if(!empty($searchKey)){
										$searchquery .= " AND ";
									}
									$searchquery .= "body_type = ".$searchtype;
								}

								if(empty($searchKey) && empty($searchcategory) && empty($searchtype)){
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
										$isOutstock = FALSE;
										$totalOrdered = 0;
										$totalCart = 0;
										$bodytype = [];
										$categoryname = [];
										$stockbalance = $c['in_stock'];

										if(isset($_SESSION['account_session'])){
											$totalCart = numRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']." AND menu=".$c['id']);
										}

										if(!empty($c['category'])){
											$categoryname = fetchRow("SELECT * from category WHERE id = ".$c['category']);
										}
	
										if(!empty($c['body_type'])){
											$bodytype = fetchRow("SELECT * from body_part WHERE id = ".$c['body_type']);
										}

										if(isset($productOrder[$c['id']])){
											$totalOrdered = explode(',',$productOrder[$c['id']]);
											$totalOrdered = count($totalOrdered);
										}

										if(($stockbalance - $totalOrdered - $totalCart) <= 0){
											$isOutstock = TRUE;
										}

										if($isOutstock == FALSE){
											$sizeOptions = '';

											foreach($sizeChart as $size){
												$sizeOptions .= '<option class="'.$size['size'].'">'.$size['size'].'</option>';
											}

											$addCartButton = '
												<form method="GET" action="./main-shop-addcart.php" class="input-group">
													<select name="size" class="form-select flex-grow-1">'.$sizeOptions.'</select>

													<input type="hidden" name="id" value="'.$c['id'].'"/>

													<button class="btn btn-primary" type="submit">Add Cart</button>
												</form>

												<a href="#" class="text-muted d-flex justify-content-end" data-bs-toggle="modal" data-bs-target="#size-chart-modal">Size guide</a>
											';
										}

										if($isOutstock == TRUE){
											$addCartButton = '<span class="text-danger fw-bold">No Stock</span>';
										}

										//# Product Card
										if(!in_array($c['id'], $alreadypush)){
											echo '
												<div class="col-4">
													<div class="card">

														<div class="card-body pt-3 pb-3">
															<img src="images/'.$c['image'].'" class="img img-thumbnail img-responsive"/>

															<div class="w-100 d-flex flex-column gap-2 pt-2">
																<span class="w-100 fw-bold">'.$c['name'].'</span>
																
																'.(!empty($bodytype['name']) ? '<span class="w-100 text-nowrap text-primary fw-bold">'.$bodytype['name'].'</span>' : '').'

																<span class="w-100 text-nowrap">'.$categoryname['name'].'</span>

																<span class="w-100 text-muted text-nowrap">Stock: '.($stockbalance - $totalOrdered).'</span>

																<span class="w-100 fst-italic text-success fw-bold text-nowrap">RM '.$c['price'].'</span>

																'.$addCartButton.'
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
					</div>
					<!--#END Content --->

				</div>
			</main>

			<!--#START size guide modal -->
			<div class="modal fade" id="size-chart-modal" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Size Guid Table</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body m-3">

							<div class="row">
								<div class="col-12">
									<img class="img img-responsive img-thumbnail" src="img/size-guide.png"/>
								</div>

								<div class="col-12 input-group py-3">
									<input id="height-input" type="number" class="form-control" placeholder="Your Height (CM)">
									<input id="weight-input" type="number" class="form-control" placeholder="Your Weight (KG)">
									<button onclick="findSize()" class="btn btn-success" type="button">Find My Size</button>
								</div>

								<div class="col-12">
									<table class="table">
										<thead>
											<tr>
												<th>Size</th>
												<th>Body Length</th>
												<th>Body Width</th>
												<th>Sleeve Length</th>
											</tr>
										</thead>
										<tbody id="table-chart-content"></tbody>
									</table>
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!--#END size guide modal -->

			<?php include 'footer.php'; ?>
		</div>
	</div>

	<script>
		let chartTableEl = document.querySelector('#table-chart-content');
		let bodyWeightEl   = document.querySelector('#weight-input');
		let bodyHeightEl   = document.querySelector('#height-input');

		let defaultTable = JSON.parse('<?php echo json_encode($sizeChart); ?>');

		let suggestSize = function(weight, height){
			if(weight > 0 && height > 0){
				let finalBmi = weight / (height / 100 * height / 100);

				if(finalBmi < 18.5){
					return ['XS','S'];
				}else if(finalBmi > 18.5 && finalBmi < 25){
					return ['S','M','L'];
				}else if(finalBmi > 25){
					return ['XL','XXL','XXXL'];
				}else{
					return [];
				}
			}
			
			return [];
		};
		
		let applyTable = function ({ weight = null, height = null}){
			let collection = '';
			let restrictSize = null;

			if(weight && height){
				let findBMI = suggestSize(weight, height);

				if(findBMI.length > 0){
					restrictSize = findBMI;
				}
			}

			defaultTable.forEach(c => {
				let highlightClass = '';
				
				if(restrictSize && restrictSize.includes(c.size)){
					highlightClass = 'bg-warning';
				}

				collection += `
					<tr class="${ highlightClass }">
						<td>${ c.size }</td>
						<td>${ c.Length }</td>
						<td>${ c.Width }</td>
						<td>${ c.Sleeve }</td>
					</tr>
				`;
			});
			
			chartTableEl.innerHTML = collection;
		};

		function findSize(){
			if(bodyWeightEl.value.trim() == '' || bodyHeightEl.value.trim() == ''){
				applyTable({ weight: null, height: null });
			}else{
				applyTable({ weight: bodyWeightEl.value, height: bodyHeightEl.value });
			}
		}

		applyTable({ weight: null, height: null });
	</script>
</body>
</html>
