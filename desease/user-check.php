<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_session'])){
        header("Location: login-account.php");
        exit();
    }

    $profiledata = fetchRow("SELECT * FROM login WHERE id = ".$_SESSION['account_session']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'inc/header.php'; ?>

    <style>
        #progress-bar-container li::after{
            margin-top: 47px !important;
        }

        #progress-content-section{
            background: #fff !important;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include 'inc/sidebar.php'; ?>

        <div class="main">
            <?php include 'inc/top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Check</strong> health and disease</h3>
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

                                <!--#START Content -->
								<div class="card-body pt-2 pb-3 vh-100">

                                    <div class="progress-wrapper">
                                        <div id="progress-bar-container">
                                            <ul>
                                                <li class="step step01 active">
                                                    <div class="step-inner">Body Part</div>
                                                </li>
                                                <li class="step step02">
                                                    <div class="step-inner">Syntom</div>
                                                </li>
                                                <li class="step step03">
                                                    <div class="step-inner">Result</div>
                                                </li>
                                            </ul>

                                            <div id="line">
                                                <div id="line-progress"></div>
                                            </div>
                                            
                                            <div id="progress-content-section">
                                                <div class="section-content step1 active">
                                                    <h2 class="pb-4">Choose parts of the body affected by diseases</h2>

                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <input type="checkbox" />
                                                                    <span class="px-3 text-mute">1.</span>
                                                                    <span class="fw-bold">Head</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <input type="checkbox" />
                                                                    <span class="px-3 text-mute">2.</span>
                                                                    <span class="fw-bold">Mouth</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <input type="checkbox" />
                                                                    <span class="px-3 text-mute">3.</span>
                                                                    <span class="fw-bold">Skin Bottom Lower</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <input type="checkbox" />
                                                                    <span class="px-3 text-mute">4.</span>
                                                                    <span class="fw-bold">Skin Back</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="section-content step2">
                                                    <h2 class="pb-4">Choose symptoms that affecting you</h2>

                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <input type="checkbox" />
                                                                    <span class="px-3 text-mute">1.</span>
                                                                    <span class="fw-bold">Cough</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <input type="checkbox" />
                                                                    <span class="px-3 text-mute">2.</span>
                                                                    <span class="fw-bold">Headache</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <input type="checkbox" />
                                                                    <span class="px-3 text-mute">3.</span>
                                                                    <span class="fw-bold">Achnee Skin</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <input type="checkbox" />
                                                                    <span class="px-3 text-mute">4.</span>
                                                                    <span class="fw-bold">Bumb</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="section-content step3">
                                                    <h2 class="pb-4">Hi Mr. Faizal, based on your information, we can conclude may be affecting by these following issues</h2>
                                                    
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <span class="px-3 text-mute">1.</span>
                                                                    <span class="fw-bold">Fever</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <span class="px-3 text-mute">2.</span>
                                                                    <span class="fw-bold">Stomach Freeze</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <span class="px-3 text-mute">3.</span>
                                                                    <span class="fw-bold">Flu</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="d-flex justify-content-start">
                                                                    <span class="px-3 text-mute">4.</span>
                                                                    <span class="fw-bold">Bumb</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

								</div>
                                <!--#END Content -->

							</div>
						</div>
					</div>
                    <!--#END Content -->

                </div>
            </main>

            <?php include 'inc/footer.php'; ?>
        </div>
    </div>

    <script ssrc="./js/jquery.min.js"></script>
    <script>
        $(".step").click(function () {
            $(this).addClass("active").prevAll().addClass("active");
            $(this).nextAll().removeClass("active");
        });

        $(".step01").click(function () {
            $("#line-progress").css("width", "8%");
            $(".step1").addClass("active").siblings().removeClass("active");
        });

        $(".step02").click(function () {
            $("#line-progress").css("width", "50%");
            $(".step2").addClass("active").siblings().removeClass("active");
        });

        $(".step03").click(function () {
            $("#line-progress").css("width", "100%");
            $(".step3").addClass("active").siblings().removeClass("active");
        });

    </script>
</body>
</html>