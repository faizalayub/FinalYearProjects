<?php
    include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body>
    <?php include './landingNavbar.php'; ?>

    <div class="w-full flex flex-column py-8 background-image h-screen">
        <div class="surface-0 shadow-1 border-round pb-8 px-8 mx-auto flex flex-column align-items-center gap-3">
            <h3 class="text-center my-6">Welcome To Lizkrispychip Kerepek</h3>

            <div class="w-full flex align-items-center justify-content-center">
                <img src="./asset/background/wp4424209-snack-wallpapers.jpg" class="w-full h-30rem w-30rem mx-auto shadow-1 border-1 border-300 border-round"/>
            </div>

            <a href="./menu_list" class="no-underline px-3 py-2 border-round bg-yellow-700 border-1 text-0 text-xl border-yellow-600 cursor-pointer">Order Kerepek</a>
        </div>
    </div>

    <style>
        .background-image{
            background: url('./asset/background/435938wp8558372.jpg');
        }
    </style>
</body>
</html>