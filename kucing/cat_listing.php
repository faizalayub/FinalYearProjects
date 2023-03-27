<?php
    include 'config.php';

    $searchMode = (isset($_GET['key']));
    $searchKey = ($searchMode ? $_GET['key'] : '');
    $isLoggedIn = (isset($_SESSION['account_session']) ? 1 : 0);
    $dataset = fetchRows("SELECT * FROM `cat` WHERE name LIKE '%".$searchKey."%'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>

    <style>
        .screenshot_slider .owl-nav {
            text-align: center;
        }

        .screenshot_slider .owl-nav button {
            font-size: 24px !important;
            margin: 10px;
            color: #033aff !important;
        }
    </style>
</head>
<body class="m-0 p-0 w-full surface-300">
    <?php include './navigator.php'; ?>

    <h2 class="uppercase p-0 m-0 w-full text-center text-5xl py-4 mt-8">Press Profile To Adopt</h2>

    <div class="w-full h-full flex align-items-center justify-content-center p-3 mb-3 mt-4">
        <div class="screenshot_slider owl-carousel h-full" style="width: 1200px;">
            <?php
                foreach($dataset as $key => $value){

                    $isDisabled = '';
                    $statusTag = '<span class="text-base text-0 bg-blue-400 border-round p-2">Available</span>';
                    $status = fetchRow("SELECT * FROM `adopt` WHERE `adopt`.`cat_id` = ".$value['id']);

                    if(!empty($status)){
                        $statusTag = '<span class="text-base text-0 bg-orange-400 border-round p-2">Owned By Someone</span>';
                        $isDisabled = 'pointer-events-none';
                    }

                    echo '
                        <div class="hover:bg-yellow-500 cursor-pointer item bg-yellow-400 p-5 shadow-1 border-round-2xl flex align-items-center justify-content-center flex-column '.$isDisabled.'" onclick="confirmAdobt('.$value['id'].')">
                            <img style="object-fit: cover;" class="h-15rem w-15rem border-round-2xl" src="images/'.$value['picture'].'" alt="" title="">

                            <div class="px-2">
                                <ul class="m-3 p-3 w-full">
                                    <li class="px-4 py-2 text-2xl">'.$value['name'].'</li>
                                    <li class="px-4 py-2 text-2xl">'.$value['race'].'</li>
                                    <li class="px-4 py-2 text-2xl">'.$value['food'].'</li>
                                    <li class="px-4 py-2 text-2xl">'.$value['gender'].'</li>
                                    <li class="px-4 py-2 text-2xl">'.$value['age'].' Years</li>
                                    <li class="px-4 py-2 text-2xl">'.$value['maintenance'].'</li>
                                    <li class="px-4 py-2 text-2xl">'.$value['description'].'</li>
                                    <li class="px-4 py-2 text-2xl">Status : '.$statusTag.'</li>
                                </ul>
                            </div>
                        </div>
                    ';
                }
            ?>
        </div>

        <?php 
            if($searchMode && empty($dataset)){
                echo '
                    <div class="h-30rem flex-column gap-6 surface-0 flex align-items-center justify-content-center w-5 text-center">
                        No result found!
                        <a href="./cat_listing.php">Reset</a>
                    </div>';
            }
        ?>
    </div>

    <?php if(!empty($dataset)){ ?>
    <script>
        let isLogin = '<?php echo $isLoggedIn; ?>';
        let sliderEl = $('.screenshot_slider');

        if(sliderEl.length > 0){
            let owl = sliderEl.owlCarousel({
                loop: true,
                responsiveClass: true,
                nav: true,
                items: 3,
                margin: 30,    
                autoplayTimeout: 4000,
                smartSpeed: 400,
                center: true,
                navText: ['&#8592;', '&#8594;']
            });

            jQuery(document.documentElement).keydown(function (event) {    
                if(event.keyCode == 37){

                    owl.trigger('prev.owl.carousel', [400]);

                }else if (event.keyCode == 39){

                    owl.trigger('next.owl.carousel', [400]);

                }
            });
        }

        function confirmAdobt(id){
            if(isLogin == 0){
                alert("Please login first!"); return;
            }
            if(confirm('Are you sure to adopt this cat?')){
                window.location.href=`cat_listing_adobt.php?id=${ id }`;
            }
        }
    </script>
    <?php } ?>
</body>
</html>