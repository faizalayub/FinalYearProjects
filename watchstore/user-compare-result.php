<?php
    include 'config.php';
    
    $product_first = fetchRow("SELECT * FROM menu WHERE id=".$_GET['one']);
    $product_second = fetchRow("SELECT * FROM menu WHERE id=".$_GET['two']);
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

            <!-- HEADER -->
            <div class="flex align-items-center justify-content-center py-3 px-6 gap-3 flex-wrap-reverse">
                <h3 class="text-0 text-3xl m-0">Compare Result</h3>
            </div>

            <div class="flex border-top-1 border-0 mt-3 p-3 gap-3">
                <!-- COMPARE ITEM 1 -->
                <div class="flex-1 surface-0 p-3 border-round-xl shadow-6">
                    <div class="w-full flex flex-column flex-1">
                        <ol class="w-full p-3 m-0 list-none overflow-y-auto" style="max-height: 60vh;">
                            <?php
                                echo '
                                <li class="flex flex-column align-items-center justify-content-center gap-3 p-3">
                                    <div class="w-full flex align-items-center">
                                        <span class="surface-0 p-3 text-800 text-xl flex-1">'.$product_first['name'].'</span>
                                    </div>

                                    <img src="images/'.$product_first['image'].'" class="w-15rem h-15rem border-circle"/>

                                    <span class="text-red-500 text-2xl font-bold text-center w-full">RM '.$product_first['price'].'</span>

                                    <p class="p-3 m-0 surface-ground w-30rem" style="white-space: pre-line;">'.$product_first['description'].'</p>
                                </li>';
                            ?>
                        </ol>
                    </div>
                </div>

                <!-- COMPARE ITEM 2 -->
                <div class="flex-1 surface-0 p-3 border-round-xl shadow-6">
                    <div class="w-full flex flex-column flex-1">
                        <ol class="w-full p-3 m-0 list-none overflow-y-auto" style="max-height: 60vh;">
                            <?php
                                echo '
                                <li class="flex flex-column align-items-center justify-content-center gap-3 p-3">
                                    <div class="w-full flex align-items-center">
                                        <span class="surface-0 p-3 text-800 text-xl flex-1">'.$product_second['name'].'</span>
                                    </div>

                                    <img src="images/'.$product_second['image'].'" class="w-15rem h-15rem border-circle"/>

                                    <span class="text-red-500 text-2xl font-bold text-center w-full">RM '.$product_second['price'].'</span>

                                    <p class="p-3 m-0 surface-ground w-30rem" style="white-space: pre-line;">'.$product_second['description'].'</p>
                                </li>';
                            ?>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="w-full h-full flex gap-6 align-items-center justify-content-center">
                <button onclick="actionGoBack()" class="no-underline uppercase text-2xl bg-bluegray-500 cursor-pointer py-2 px-6 h-4rem border-3 border-bluegray-600 border-circle border-3 text-0 flex align-items-center justify-content-center">Go Back</button>
                <button onclick="actionDone()" class="no-underline uppercase text-2xl bg-blue-500 cursor-pointer py-2 px-6 h-4rem border-3 border-blue-600 border-circle border-3 text-0 flex align-items-center justify-content-center">Done</button>
            </div>
        </div>
        <!-- END Content-->

    </div>

    <script>
        function actionGoBack(){
            window.location.href="user-compare.php";
        }

        function actionDone(){
            window.location.href="user-shop.php";
        }
    </script>
</body>
</html>