<?php
    include 'config.php';

    $product = fetchRows("SELECT * FROM menu WHERE is_active = 1");
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
    <div class="surface-0 border-round-2xl h-full shadow-3 content-paper-bg p-3">

        <!-- START Content-->
        <div class="h-full w-full grid">
            <div class="col-6 flex align-items-center">
                <div class="w-full h-full overflow-auto" style="max-height: 80vh; overscroll-behavior: contain;">
                    <ol class="w-full h-full flex flex-column p-0 m-0 list-none align-items-center justify-content-center gap-3">
                        <?php
                            foreach($product as $c){
                                echo '
                                <li class="flex flex-column gap-3 p-3 surface-0 border-1 border-300 shadow-4 border-round">
                                    <div class="w-full flex align-items-center">
                                        <span class="surface-0 p-3 text-800 text-xl flex-1">'.$c['name'].'</span>
                                        <input type="checkbox" />
                                    </div>
                                    <img src="images/'.$c['image'].'" class="w-10rem h-10rem border-circle"/>
                                </li>';
                            }
                        ?>
                    </ol>
                </div>
            </div>

            <div class="col-4">
                <div class="w-full h-full flex flex-column gap-6 align-items-center justify-content-center">
                    <button class="no-underline uppercase text-2xl bg-yellow-500 cursor-pointer py-4 px-6 h-6rem border-3 border-yellow-600 hover:border-yellow-800 border-circle border-3 text-yellow-900 flex align-items-center justify-content-center">Edit item</button>
                    <button class="no-underline uppercase text-2xl bg-yellow-500 cursor-pointer py-4 px-6 h-6rem border-3 border-yellow-600 hover:border-yellow-800 border-circle border-3 text-yellow-900 flex align-items-center justify-content-center">Remove item</button>
                    <a href="./admin-items-create.php" class="no-underline uppercase bg-green-500 cursor-pointer h-4rem w-4rem border-3 border-green-500 hover:border-green-600 border-circle border-3 text-yellow-900 flex align-items-center justify-content-center">
                        <i class="text-3xl text-0 fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Content-->


    </div>
</body>
</html>