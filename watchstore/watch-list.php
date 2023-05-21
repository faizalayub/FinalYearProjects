<?php
    include 'config.php';
    
    if(!isset($_SESSION['account_user'])){
        echo '<script>window.location.href="user-login.php"</script>';
    }

    $userdata = fetchRow("SELECT * FROM `login` WHERE id = ".$_SESSION['account_user']);
    $productdata = fetchRows("SELECT * FROM `menu` WHERE is_active = 1");
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
    <div class="surface-0 border-round-2xl shadow-3 content-concreate-bg p-3">

        <!-- START Content-->
        <div class="w-full flex flex-column">

            <div class="flex align-items-center justify-content-center py-3 px-6 gap-3 flex-wrap-reverse">
                <div class="flex-1 flex align-items-center justify-content-center">
                    <div class="flex align-items-center relative w-30rem surface-0 border-round border-1 border-300 shadow-3">
                        <span class="flex align-items-center justify-content-center px-3 absolute left-0">
                            <i class="fa fa-search text-2xl text-600" aria-hidden="true"></i>
                        </span>
                        <input type="search" class="flex-1 py-3 px-6 text-center border-round text-2xl border-round border-1 border-300 shadow-3" placeholder="Search"/>
                    </div>
                </div>

                <div class="flex align-items-center justify-content-center surface-0 h-4rem w-4rem border-circle text-3xl font-bold shadow-4">
                    <?php echo substr($userdata['name'], 0, 1); ?>
                </div>
            </div>

            <div class="grid border-top-1 border-0 mt-3">

                <?php
                    if(!empty($productdata)){
                        foreach($productdata as $prod){

                            echo '
                            <div class="col-12 md:col-4 lg:col-3 p-3">
                                <div style="aspect-ratio: 1/1;" class="p-3 border-circle flex align-items-center justify-content-center border-3 cursor-pointer border-900 hover:border-blue-400 hover:shadow-6">CONTENT</div>
                            </div>';

                        }
                    }else{
                        echo 'No record';
                    }
                ?>

            </div>
        </div>
        <!-- END Content-->

    </div>
</body>
</html>