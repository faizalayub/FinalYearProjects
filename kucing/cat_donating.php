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

        .red-circle:before{
            content: '';
            position: absolute;
            height: 100%;
            width: 100%;
            clip-path: ellipse(100% 65% at 15% 70%);
            background: var(--red-400);
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

    <?php if(!isset($_GET['account'])){ ?>
    <div class="surface-300 flex-1 w-full relative flex align-items-start justify-content-center" style="min-height: 26em;">
        <h1 class="m-0 uppercase py-2 header-text text-900 font-header text-5xl z-1">Let's change together</h1>
        
        <div class="bg-red-400 absolute w-full bottom-0 left-0 h-full red-curve flex align-items-end justify-content-between py-4">
            <img src="./asset/asset_6.jpeg" class="image-fit h-15rem w-15rem border-circle mx-6"/>
            <img src="./asset/asset_7.webp" class="image-fit h-15rem w-15rem border-circle mx-6"/>
            <img src="./asset/asset_8.jpeg" class="image-fit h-15rem w-15rem border-circle mx-6"/>
            <img src="./asset/asset_9.jpeg" class="image-fit h-15rem w-15rem border-circle mx-6"/>
        </div>
    </div>

    <div class="w-full flex-1 relative cat-background flex flex-column justify-content-center gap-6">
        <h1 class="m-0 text-0 px-8 text-7xl line-height-2 font-header">Help us to save <br> more furries</h1>

        <div class="px-8 mb-6">
            <a href="./cat_donating.php?account">
                <button class="cursor-pointer px-6 shadow-1 bg-red-400 uppercase py-4 border-1 border-red-400 border-round-3xl font-bold text-0 text-2xl">Donate Here</button>
            </a>
        </div>
    </div>
    <?php } ?>

    <?php if(isset($_GET['account'])){ ?>
    <div class="h-full w-full surface-300 flex align-items-center justify-content-between flex-wrap">
        <div class="flex-1 relative h-full flex align-items-center red-circle">
            <h1 class="z-1 m-0 font-header text-0 text-center text-6xl px-3">With you donation we can provide more facilities for these stray cats</h1>
        </div>

        <div class="flex flex-column align-items-center justify-content-center flex-1 px-3 h-full">
            <h1 class="m-0 p-0 uppercase font-header text-900 text-0 white-space-nowrap text-8xl font-bold">Donate Here</h1>
            <h1 class="m-0 p-0 uppercase font-header text-900 text-0 white-space-nowrap text-7xl">1010 3232 1144 99</h1>
            <h1 class="m-0 p-0 uppercase font-header text-900 text-0 white-space-nowrap text-6xl">SCMAA SYSTEM</h1>

            <div class="w-4 flex flex-column py-3">
                <span class="bg-yellow-500 uppercase text-900 p-3 text-5xl text-center font-bold white-space-nowrap">JunBank</span>
                <span class="surface-900 text-yellow-500 p-3 text-3xl text-center font-bold white-space-nowrap">JUNbank2u.com</span>
            </div>
        </div>
    </div>
    <?php } ?>

</body>
</html>