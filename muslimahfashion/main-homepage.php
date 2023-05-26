<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		include 'config.php';
        include 'header.php';
    ?>

	<link rel="stylesheet" href="vendor/slick-slider/css/slick.css">

	<style>
		.fullscreen-carousel{
			position: relative;
		}

		.fullscreen-carousel .slick-prev,
		.fullscreen-carousel .slick-next{
			position: absolute;
			top: 0;
			z-index: 99;
			border: none;
			height: 100%;
			background: #fff0;
		}

		.fullscreen-carousel .slick-next{
			right: 0;
		}

		.fullscreen-carousel .slick-prev{
			left: 0;
		}

		.fullscreen-carousel .info-caption{
			position: absolute;
			z-index: 50;
			top: 0;
			left: 0;
		}

		.fullscreen-carousel .slick-slide {
			position: relative;
		}

		.card-product{
			position: relative;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<?php include 'sidebar.php'; ?>

		<div class="main">
			<?php include 'top-navbar.php'; ?>

			<main class="content p-0">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="fullscreen-carousel">

								<!-- Screen slider 1 -->
								<div class="vh-100">
									<img src="https://cdn.store-assets.com/s/834717/f/10497265.jpg?width=1500&format=webp" class="w-100"/>
									
									<div class="d-flex flex-column w-100 h-100 info-caption align-items-center justify-content-center">
										<h2 class="text-lg text-white">NEW Eid 2023</h2>
										<h1 class="text-xl text-white mt-2">MARIE COTTON/ MARIO DEPARTCIPTO</h1>
										<a href="./main-shop.php" class="btn btn-primary btn-lg mt-3">Shop Now</a>
									</div>
								</div>

								<!-- Screen slider 2 -->
								<div class="vh-100">
									<img src="https://cdn.store-assets.com/s/834717/f/8769763.jpeg?width=1500&format=webp" class="w-100"/>

									<div class="d-flex flex-column w-100 h-100 info-caption align-items-center justify-content-center">
										<h2 class="text-lg text-white">NEW Eid 2023</h2>
										<h1 class="text-xl text-white mt-2">MARIE COTTON/ MARIO DEPARTCIPTO</h1>
										<button class="btn btn-primary btn-lg mt-3">Shop Now</button>
									</div>
								</div>

								<!-- Screen slider 3 -->
								<div class="vh-100">
									<img src="https://cdn.store-assets.com/s/834717/f/9931234.jpg?width=1500&format=webp" class="w-100"/>

									<div class="d-flex flex-column w-100 h-100 info-caption align-items-center justify-content-center">
										<h2 class="text-lg text-white">NEW Eid 2023</h2>
										<h1 class="text-xl text-white mt-2">MARIE COTTON/ MARIO DEPARTCIPTO</h1>
										<button class="btn btn-primary btn-lg mt-3">Shop Now</button>
									</div>
								</div>

								<!-- Screen slider 4 -->
								<div class="vh-100">
									<img src="https://cdn.store-assets.com/s/834717/f/9858324.jpg?width=1500&format=webp" class="w-100"/>

									<div class="d-flex flex-column w-100 h-100 info-caption align-items-center justify-content-center">
										<h2 class="text-lg text-white">NEW Eid 2023</h2>
										<h1 class="text-xl text-white mt-2">MARIE COTTON/ MARIO DEPARTCIPTO</h1>
										<button class="btn btn-primary btn-lg mt-3">Shop Now</button>
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="row p-6">
						<div class="col-3">
							<img class="img img-responsize img-thumbnail" src="https://cdn.store-assets.com/s/834717/f/9931323.png?width=650&format=webp">
						</div>

						<div class="col-3">
							<img class="img img-responsize img-thumbnail" src="https://cdn.store-assets.com/s/834717/f/9931323.png?width=650&format=webp">
						</div>

						<div class="col-3">
							<img class="img img-responsize img-thumbnail" src="https://cdn.store-assets.com/s/834717/f/9858197.jpeg?width=650&format=webp">
						</div>

						<div class="col-3">
							<img class="img img-responsize img-thumbnail" src="https://cdn.store-assets.com/s/834717/f/9931323.png?width=650&format=webp">
						</div>
					</div>

					<div class="row p-6">
						<?php
							$alreadypush = [];
							$productPreview = fetchRows("SELECT * FROM menu WHERE is_active = 1");
							
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
								foreach($productPreview as $key => $c){
									$totalOrdered = 0;
									$bodytype = [];
									$categoryname = [];
									$stockbalance = $c['in_stock'];
									$salesTag = '';

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

									if(($stockbalance - $totalOrdered) <= 0){
										continue;
									}

									if($key <= 3){
										$salesTag = '<span class="badge bg-danger" style="position: absolute;">SALE</span>';
									}

									//# Product Card
									if(!in_array($c['id'], $alreadypush)){
										echo '
											<div class="col-md-3 col-lg-2 col-sm-6 col-xs-6">
												<div class="card">

													<div class="card-body pt-3 pb-3 card-product">
														'.$salesTag.'

														<a href="main-shop.php">
															<img src="images/'.$c['image'].'" class="img img-thumbnail img-responsive"/>
														</a>

														<div class="w-100 d-flex flex-column gap-1 pt-2">
															<span class="w-100 fw-bold">'.$c['name'].'</span>

															<span class="w-100 text-nowrap">'.$categoryname['name'].'</span>

															<span class="w-100 text-nowrap text-primary fw-bold">'.(!empty($bodytype['name']) ? $bodytype['name'] : '-').'</span>

															<h3 class="w-100 text-success text-xl fw-bold text-nowrap w-100">RM '.$c['price'].'</h3>
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
			</main>

			<?php include 'footer.php'; ?>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="vendor/slick-slider/js/slick.min.js"></script>

	<script>
		$('.fullscreen-carousel').slick({
            arrows: true,
			autoplay: false,
            prevArrow: `
				<button type='button' class='slick-prev'>
					<i class='align-middle text-muted' data-feather='chevron-left' style="height: 60px; width: 60px;"></i>
				</button>
			`,
            nextArrow: `
				<button type='button' class='slick-next'>
					<i class='align-middle text-muted' data-feather='chevron-right' style="height: 60px; width: 60px;"></i>
				</button>
			`
		});
	</script>
</body>
</html>
