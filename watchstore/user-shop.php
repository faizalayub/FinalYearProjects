<?php
    include 'config.php';

    $searchkey = '';
    $userdata  = fetchRow("SELECT * FROM `login` WHERE id = ".$_SESSION['account_user']);
    $menuQuery = "SELECT * FROM `menu` WHERE is_active = 1";

    if(isset($_GET['key'])){
        $searchkey = $_GET['key'];

        $menuQuery .= " AND `name` LIKE '%".$searchkey."%'";
    }
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
                
                <a href="./user-compare.php" class="text-800 font-bold p-3 border-1 border-300 surface-0 border-round-3xl no-underline text-xl">Compare Watch</a>
                
                <a href="./user-invoice.php" class="text-800 font-bold p-3 border-1 border-300 surface-0 border-round-3xl no-underline text-xl">My Order</a>

                <div class="flex-1 flex align-items-center justify-content-center">
                    <form method="GET" class="flex align-items-center relative w-30rem surface-0 border-round border-1 border-300 shadow-3">
                        <span class="flex align-items-center justify-content-center px-3 absolute left-0">
                            <i class="fa fa-search text-2xl text-600" aria-hidden="true"></i>
                        </span>

                        <input
                            type="search"
                            name="key"
                            value="<?php echo $searchkey; ?>"
                            class="flex-1 py-3 px-6 text-center border-round text-2xl border-round border-1 border-300 shadow-3"
                            placeholder="Search" />
                    </form>
                </div>

                <a href="./logout.php" class="text-800 font-bold p-3 border-1 border-300 surface-0 border-round-3xl no-underline text-xl">Logout</a>

                <div class="flex align-items-center justify-content-center surface-0 h-4rem w-4rem border-circle text-3xl font-bold shadow-4">
                    <?php echo substr($userdata['name'], 0, 1); ?>
                </div>
            </div>

            <div class="grid border-top-1 border-0 mt-3">

                <?php
                    $productdata = fetchRows($menuQuery);

                    if(!empty($productdata)){
                        foreach($productdata as $prod){

                            echo '
                            <div class="col-12 md:col-4 lg:col-3 p-3" onclick="openPreview('.$prod['id'].')">
                                <div style="aspect-ratio: 1/1;" class="p-3 border-circle flex align-items-center justify-content-center border-3 cursor-pointer border-900 hover:border-blue-400 hover:shadow-6">
                                    <img src="images/'.$prod['image'].'" class="w-15rem h-15rem border-circle shadow-3"/>
                                </div>
                            </div>

                            <div id="modal'.$prod['id'].'" class="modal">
                                <div class="modal-content flex align-items-center justify-content-center">

                                    <div class="flex align-items-center justify-content-center flex-column surface-0 p-3 border-round-xl shadow-3 gap-3">
                                        <div class="w-full flex align-items-center justify-content-center">
                                            <h3 class="flex-1 text-center">'.$prod['name'].'</h3>
                                            <button onclick="modalClose('.$prod['id'].')" class="surface-ground border-circle h-3rem w-3rem border-1 border-300 text-4xl text-600 hover:text-800 cursor-pointer">&times;</button>
                                        </div>

                                        <img src="images/'.$prod['image'].'" class="w-15rem h-15rem border-circle shadow-3 p-3"/>

                                        <span class="text-red-500 text-2xl font-bold text-center w-full">RM '.$prod['price'].'</span>

                                        <p class="p-3 m-0 surface-ground w-30rem" style="white-space: pre-line;">'.$prod['description'].'</p>

                                        <div class="w-full flex align-items-center justify-content-center sticky bottom-0 surface-0 p-3 gap-3">
                                            <a href="#" class="no-underline text-800 font-bold cursor-pointer text-lg py-2 px-4 border-round-3xl surface-300 border-1 shadow-1 border-400">Chart</a>
                                            <a href="user-order-confirm.php?id='.$prod['id'].'" class="no-underline text-800 font-bold cursor-pointer text-lg py-2 px-4 border-round-3xl surface-300 border-1 shadow-1 border-400">Buy</a>
                                        </div>
                                    </div>

                                </div>
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

    <script>
        function openPreview(target){
            const $modal = document.getElementById(`modal${ target }`);

            $modal.style.display = "block";
        }

        function modalClose(target){
            const $modal = document.getElementById(`modal${ target }`);

            $modal.style.display = "none";
        }
    </script>
</body>
</html>