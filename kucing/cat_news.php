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
<body class="h-screen m-0 p-0 flex w-full flex-column relative">
    <?php include './navigator.php'; ?>

    <div class="surface-300 flex-1 w-full relative flex align-items-start justify-content-center" style="min-height: 26em;">
        <div class="bg-red-400 absolute w-full bottom-0 left-0 h-full red-curve flex align-items-end justify-content-between py-4"></div>
    </div>

    <div class="w-full flex-1 relative cat-background flex flex-column justify-content-center gap-6">
    </div>

    <div class="absolute top-0 left-0 w-full h-full flex align-items-center justify-content-center z-1">
        <div class="py-8 w-6 surface-0 shadow-4 border-round-3xl text-center flex align-items-center text-2xl px-8 justify-content-center line-height-3">
            The newest recognized breed of domestic cat is the Selkirk rex, also known as the poodle cat, on account of its thick curly fur, which is composed of three separate layers. It arose from a spontaneous genetic mutation originating in Montana, USA, in 1987, from which the breed was developed. In 2013, it was officially recognized as a genetically distinct line by the University of Veterinary Medicine in the USA, and as a valid separate breed it has been recognized by the International Cat Association, the American Cat Fanciers Association, and the Cat Fanciers' Association.
        </div>
    </div>
</body>
</html>