<?php
    include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>

    <style>
        @font-face {
            font-family: sriracha;
            src: url('./fonts/Sriracha-Regular.ttf');
            font-weight: bold;
        }

        .font-header{
            font-family: sriracha;
        }

        .red-curve{
            clip-path: ellipse(70% 75% at 50% 100%);
        }

        .header-text{
            text-shadow: 3px 4px 2px var(--surface-0);
        }

        .cat-background{
            background-image: url(./asset/asset_1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 30em;
        }

        .image-fit{
            object-fit: cover;
            clip-path: polygon(50% 0%, 90% 20%, 100% 60%, 75% 100%, 25% 100%, 0% 60%, 10% 20%);
        }
    </style>
</head>
<body class="h-screen m-0 p-0 flex w-full flex-column">
    <?php include './navigator.php'; ?>

    <div class="surface-300 flex-1 w-full relative flex align-items-start justify-content-center" style="min-height: 26em;">
        <h1 class="m-0 uppercase py-2 header-text text-900 font-header text-5xl z-1">Let's change together</h1>
        
        <div class="bg-red-400 absolute w-full bottom-0 left-0 h-full red-curve flex align-items-end justify-content-between py-4">
            <img src="./asset/asset_2.jpeg" class="image-fit h-15rem w-15rem border-circle mx-6"/>
            <img src="./asset/asset_3.jpeg" class="image-fit h-15rem w-15rem border-circle mx-6"/>
            <img src="./asset/asset_4.webp" class="image-fit h-15rem w-15rem border-circle mx-6"/>
            <img src="./asset/asset_5.jpeg" class="image-fit h-15rem w-15rem border-circle mx-6"/>
        </div>
    </div>

    <div class="w-full flex-1 relative cat-background flex flex-column justify-content-center gap-6">
        <h1 class="m-0 text-0 px-8 text-7xl line-height-2 font-header">Be gentle with <br> these furries</h1>

        <div class="px-8 mb-6">
            <a href="./cat_listing.php">
                <button class="cursor-pointer px-6 shadow-1 bg-red-400 uppercase py-4 border-1 border-red-400 border-round-3xl font-bold text-0 text-2xl">Adopt Here</button>
            </a>
        </div>
    </div>
</body>
</html>