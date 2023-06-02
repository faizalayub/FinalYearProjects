<?php
    include 'config.php';

    $id = $_GET['id'];

    $productdata = fetchRow("SELECT * FROM `menu` WHERE id = ".$id);
?>

<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MAGICAL WATCHES OF M'SIA</title>

    <link rel="stylesheet" href="asset/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="asset/style.css">
    <link rel="stylesheet" href="asset/custom-style.css">
</head>
<body class="h-screen surface-0 p-8">
    <div class="surface-0 border-round-2xl h-full shadow-3 content-concreate-bg p-3">

        <!-- START Content-->
        <div class="h-full w-full flex align-items-center justify-content-center flex-column gap-6">
            <div class="flex-1 flex align-items-center">
                <div class="flex-1">
                    <img src="images/<?php echo $productdata['image']; ?>" class="w-15rem h-15rem border-circle shadow-3 p-3"/>
                </div>
                <div class="flex-1 surface-0 p-3 border-round-2xl flex flex-column gap-2">
                    <h3 class="flex-1 text-center text-2xl"><?php echo $productdata['name']; ?></h3>

                    <span class="text-red-500 text-2xl font-bold text-center w-full">RM <?php echo $productdata['price']; ?></span>

                    <p class="p-3 m-0 surface-ground w-30rem text-2xl max-h-30rem overflow-auto" style="white-space: pre-line;"><?php echo $productdata['description']; ?></p>

                    <div class="mt-3 w-full flex align-items-center justify-content-center">
                        <input type="text" class="flex-1 border-3 px-3 py-2 text-2xl" placeholder="SHOP VOUCHER"/>
                        <button type="button" class="no-underline border-3 border-600 font-bold text-700 px-3 py-2 cursor-pointers text-2xl">VERIFY</button>
                    </div>

                    <div class="mt-3 w-full flex align-items-center justify-content-center gap-3">
                        <a href="user-order-finish.php?action=online&menu=<?php echo $id; ?>" class="no-underline border-3 border-600 font-bold text-700 border-round-3xl px-3 py-2 cursor-pointers text-2xl">ONLINE</a>
                        <a href="user-order-finish.php?action=cod&menu=<?php echo $id; ?>" class="no-underline border-3 border-600 font-bold text-700 border-round-3xl px-3 py-2 cursor-pointers text-2xl">COD</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Content-->

    </div>
</body>
</html>