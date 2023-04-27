<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		include 'config.php';
        include 'header.php';
    ?>

	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/landing-page.css">
</head>

<body>
	<div class="wrapper">
		<?php include 'sidebar.php'; ?>

		<div class="main">
			<?php include 'top-navbar.php'; ?>

			<main class="content p-0">
				<div class="container-fluid p-0">

					<div class="slider-area position-relative" style="height: 90vh;">
						<div class="slider-active">
							<!-- Single Slider -->
							<div class="single-slider position-relative hero-overly slider-height  d-flex align-items-center" data-background="img/hero/h1_hero.jpeg">
								<div class="container">
									<div class="row">
										<div class="col-xl-6 col-lg-6">
											<div class="hero-caption">
												<img class="rotateme" src="img/hero/hero-icon.png" alt="" data-animation="zoomIn" data-delay="1s">
												<h1 data-animation="fadeInLeft" data-delay=".4s">We make cloths that suit you</h1>
												<p data-animation="fadeInLeft" data-delay=".6s">Brand new & exclusively designed Muslimah fashion for your Muslimah wear collection. Free delivery in Malaysia available for all purchases of Muslimah fashion. Clothing. Bestsellers.</p>
												<!-- Hero Btn -->
												<a href="main-shop.php" class="btn btn-primary btn-lg" data-animation="fadeInLeft" data-delay=".8s">Shop Now</a>
											</div>
										</div>
									</div>
								</div>
								<!-- Left img -->
								<div class="hero-img">
									<img src="img/hero/h2_hero2.jpeg" alt="" data-animation="fadeInRight" data-transition-duration="5s">
								</div>
							</div>
							<!-- Single Slider -->
							<div class="single-slider position-relative hero-overly slider-height  d-flex align-items-center" data-background="img/hero/h1_hero.jpeg">
								<div class="container">
									<div class="row">
										<div class="col-xl-6">
											<div class="hero-caption">
												<img class="rotateme" src="img/hero/hero-icon.png" alt="" data-animation="zoomIn" data-delay="1s">
												<h1 data-animation="fadeInLeft" data-delay=".4s">We make cloths that suit you</h1>
												<p data-animation="fadeInLeft" data-delay=".6s">Brand new & exclusively designed Muslimah fashion for your Muslimah wear collection. Free delivery in Malaysia available for all purchases of Muslimah fashion. Clothing. Bestsellers.</p>
												<!-- Hero Btn -->
												<a href="main-shop.php" class="btn btn-primary btn-lg" data-animation="fadeInLeft" data-delay=".8s">Shop Now</a>
											</div>
										</div>
									</div>
								</div>
								<!-- Left img -->
								<div class="hero-img">
									<img src="img/hero/h2_hero2.jpeg" alt="" data-animation="fadeInRight" data-transition-duration="5s">
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<?php include 'footer.php'; ?>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/landing-page.js"></script>
</body>
</html>
