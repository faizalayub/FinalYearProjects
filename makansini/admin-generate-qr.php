<?php
    include 'config.php';

    $isEdit = (isset($_GET['id']));

    if(!isset($_SESSION['account_admin'])){
        header("Location: login.php");
        exit();
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
                            <h3><strong>Generate</strong> QR</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Creation Form -->
                    <div class="row">
						<div class="col-xl-8 col-xxl-8">
							<div class="card flex-fill">

                                <!--#START Content -->
                                <div class="card-header">
									<h5 class="card-title mb-0">Create QR</h5>
								</div>
								<div class="card-body pt-0">
                                    
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Table No</label>
                                            <input type="number" placeholder="Table No" name="keyin-table" class="form-control url-table" required />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Domain</label>
                                            <input type="text" placeholder="Domain URL" name="keyin-domain" class="form-control url-domain" required value="localhost"/>
                                        </div>

                                        <div class="mb-3">
                                            <div id="qrcode" class="mb-1" style="width: 100px; height: 100px; background: #ddd;"></div>
                                            <span id="qr-display"></span>

                                            <input type="hidden" class="form-control url-final-image" name="final_image" />
                                            <input type="hidden" class="form-control url-final" name="final_url" />
                                        </div>
                                       
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-success" name="generate_now">Generate</button>
                                        </div>
                                    </form>

								</div>
                                <!--#END Content -->

							</div>
						</div>
					</div>
                    <!--#END Creation Form -->

                    <!--#START Chart -->
                    <div class="row">
                        <div class="col-xl-8 col-xxl-8">
							<div class="card flex-fill w-100">

                                <!--#START Table -->
								<div class="card-body pt-4 pb-3">

                                    <table class="table table-bordered table-sm table-striped">
                                        <tr class="shadow-1 border-1">
                                            <th>No.</th>
                                            <th>QR</th>
                                            <th>URL</th>
                                            <th>Action</th>
                                        </tr>

                                        <?php
                                            $qrrecord = fetchRows("SELECT * FROM qr");

                                            foreach($qrrecord as $key => $value){
                                        ?>
                                        <tr>
                                            <td><?php echo ($key + 1); ?></td>
                                            <td><img style="height: 50px; width: 50px;" src="<?php echo $value['image']; ?>" /></td>
                                            <td>
                                                <a href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['url']; ?></a>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="<?php echo $value['image']; ?>" target="_blank" download>
                                                        <button type="button" class="btn btn-primary btn-sm">Download</button>
                                                    </a>
                                                    <form method="POST">
                                                        <button class="btn btn-danger btn-sm" type="submit" name="action_delete" value="<?php echo $value['id']; ?>">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                        <?php
                                            if(empty($qrrecord)){
                                                echo '<tr><td class="p-3" colspan="6">No QR Yet</td></tr>';
                                            }
                                        ?>
                                    </table>

								</div>
                                <!--#END Table -->

							</div>
						</div>
					</div>
                    <!--#END Sales Chart -->

                </div>
            </main>

            <?php include 'footer.php'; ?>
        </div>
    </div>

    <?php
        if(isset($_POST['generate_now'])){
            $baseImage  = addslashes($_POST['final_image']);
            $baseURL = addslashes($_POST['final_url']);

            runQuery("INSERT INTO `qr` (`id`, `image`, `url`) VALUES (NULL, '".$baseImage."', '".$baseURL."')");

            ToastMessage('Success', 'QR added!', 'success', 'admin-generate-qr.php');
        }

        if(isset($_POST['action_delete'])){
            runQuery("DELETE FROM `qr` WHERE `qr`.`id` = ".$_POST['action_delete']);

            ToastMessage('Success', 'QR deleted!', 'success', 'admin-generate-qr.php');
        }
    ?>

    <script>
        const qrcode = new QRCode(document.getElementById("qrcode"), { width: 100, height: 100 });
        const $display = $('#qr-display');
        const $table = $('.url-table');
        const $domain  = $('.url-domain');
        const $final = $('.url-final');
        const $finalQR = $('.url-final-image');

        const concatURL = function(){
            const $generate = (`${ $domain.val() }/dinein-menu.php?table=${ $table.val() }`);

            qrcode.makeCode($generate);

            $final.val($generate);

            $finalQR.val(qrcode._oDrawing._elCanvas.toDataURL());

            $display.html($generate);
        };

        $table.on('input', concatURL);
        $domain.on('input', concatURL);
    </script>
</body>
</html>