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
    <div class="surface-0 border-round-2xl shadow-3 content-concreate-bg p-3">

        <!-- START Content-->
        <div class="w-full flex flex-column">

            <!-- HEADER -->
            <div class="flex align-items-center justify-content-center py-3 px-6 gap-3 flex-wrap-reverse">
                <h3 class="text-0 text-3xl m-0">Choose Product To Compare</h3>
            </div>

            <div class="flex border-top-1 border-0 mt-3 p-3 gap-3">
                <!-- COMPARE ITEM 1 -->
                <div class="flex-1 surface-0 p-3 border-round-xl shadow-6">
                    <div class="w-full text-xl border-bottom-1 border-300 pb-3">Choose Watch 1</div>

                    <div class="w-full flex flex-column flex-1">
                        <ol class="w-full p-3 m-0 list-none overflow-y-auto" style="max-height: 60vh;">
                            <?php
                                if(!empty($product)){
                                    foreach($product as $c){
                                        echo '
                                        <li class="flex flex-column align-items-center justify-content-center gap-3 p-3">
                                            <div class="w-full flex align-items-center">
                                                <span class="surface-0 p-3 text-800 text-xl flex-1">'.$c['name'].'</span>
                                                <input type="radio" name="compare_one" value="'.$c['id'].'"/>
                                            </div>
                                            <img src="images/'.$c['image'].'" class="w-15rem h-15rem border-circle"/>
                                        </li>';
                                    }
                                }
                            ?>
                        </ol>
                    </div>
                </div>

                <!-- COMPARE ITEM 2 -->
                <div class="flex-1 surface-0 p-3 border-round-xl shadow-6">
                    <div class="w-full text-xl border-bottom-1 border-300 pb-3">Choose Watch 1</div>

                    <div class="w-full flex flex-column flex-1">
                        <ol class="w-full p-3 m-0 list-none overflow-y-auto" style="max-height: 60vh;">
                            <?php
                                if(!empty($product)){
                                    foreach($product as $c){
                                        echo '
                                        <li class="flex flex-column align-items-center justify-content-center gap-3 p-3">
                                            <div class="w-full flex align-items-center">
                                                <span class="surface-0 p-3 text-800 text-xl flex-1">'.$c['name'].'</span>
                                                <input type="radio" name="compare_two" value="'.$c['id'].'"/>
                                            </div>
                                            <img src="images/'.$c['image'].'" class="w-15rem h-15rem border-circle"/>
                                        </li>';
                                    }
                                }
                            ?>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="w-full h-full flex gap-6 align-items-center justify-content-center">
                <button onclick="actionGoBack()" class="no-underline uppercase text-2xl bg-bluegray-500 cursor-pointer py-2 px-6 h-4rem border-3 border-bluegray-600 border-circle border-3 text-0 flex align-items-center justify-content-center">Go Back</button>
                <button onclick="actionProceed()" class="no-underline uppercase text-2xl bg-blue-500 cursor-pointer py-2 px-6 h-4rem border-3 border-blue-600 border-circle border-3 text-0 flex align-items-center justify-content-center">Compare</button>
            </div>
        </div>
        <!-- END Content-->

    </div>

    <script>
        function actionGoBack(){
            window.location.href="user-shop.php";
        }

        function actionProceed(){
            const $firstwatch = document.querySelector('[name="compare_one"]:checked');
            const $secondwatch = document.querySelector('[name="compare_two"]:checked');

            if($firstwatch && $secondwatch){
                window.location.href = `user-compare-result.php?one=${ $firstwatch.value }&two=${ $secondwatch.value }`;
            }else{
                alert('Please select items to compare');
            }
        }
    </script>
</body>
</html>