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
            <div class="col-6 flex align-items-center justify-content-center">
                <ol class="w-full p-3 m-0 list-none overflow-y-auto" style="max-height: 60vh;">
                    <?php
                        foreach($product as $c){
                            echo '
                            <li class="flex flex-column align-items-center justify-content-center gap-3 p-3 surface-0 border-1 border-300 shadow-4 border-round">
                                <div class="w-full flex align-items-center border-bottom-1 border-300">
                                    <span class="surface-0 p-3 text-800 text-xl flex-1">'.$c['name'].'</span>
                                    <input type="radio" name="watch_items" value="'.$c['id'].'"/>
                                </div>
                                <img src="images/'.$c['image'].'" class="w-15rem h-15rem border-circle"/>
                            </li>';
                        }
                    ?>
                </ol>
            </div>

            <div class="col-4">
                <div class="w-full h-full flex flex-column gap-6 align-items-center justify-content-center">
                    <button onclick="actionEdit()" class="no-underline uppercase text-2xl bg-yellow-500 cursor-pointer py-4 px-6 h-6rem border-3 border-yellow-600 hover:border-yellow-800 border-circle border-3 text-yellow-900 flex align-items-center justify-content-center">Edit item</button>

                    <button onclick="actionRemove()" class="no-underline uppercase text-2xl bg-yellow-500 cursor-pointer py-4 px-6 h-6rem border-3 border-yellow-600 hover:border-yellow-800 border-circle border-3 text-yellow-900 flex align-items-center justify-content-center">Remove item</button>

                    <button onclick="actionAdd()" class="no-underline uppercase text-2xl bg-yellow-500 cursor-pointer py-4 px-6 h-6rem border-3 border-yellow-600 hover:border-yellow-800 border-circle border-3 text-yellow-900 flex align-items-center justify-content-center">Add item</button>

                    <button onclick="actionGoBack()" class="no-underline uppercase text-2xl bg-bluegray-500 cursor-pointer py-2 px-6 h-4rem border-3 border-bluegray-600 hover:border-bluegray-800 border-circle border-3 text-0 flex align-items-center justify-content-center">Go Back</button>
                </div>
            </div>
        </div>
        <!-- END Content-->

    </div>

    <script>
        function actionEdit(){
            const $watch = document.querySelector('[type="radio"]:checked');

            if($watch){
                window.location.href = `admin-items-create.php?id=${ $watch.value }`;
            }else{
                alert('Please select an item');
            }   
        }

        function actionGoBack(){
            window.location.href="navigation-admin.php";
        }

        function actionAdd(){
            window.location.href="admin-items-create.php";
        }

        function actionRemove(){
            const $watch = document.querySelector('[type="radio"]:checked');

            if($watch){
                window.location.href = `admin-items-remove.php?id=${ $watch.value }`;
            }else{
                alert('Please select an item');
            }
        }
    </script>
</body>
</html>