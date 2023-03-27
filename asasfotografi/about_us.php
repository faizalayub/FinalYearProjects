<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'config.php';
        include './metaheader.php';
    ?>
</head>

<body class="flex-column-center">
    <?php include './landingNavbar.php'; ?>

    <h3 class="text-center my-6">Tentang Kami</h3>

    <div class="w-full flex justify-content-center align-items-center flex-wrap gap-4">
        <div class="flex flex-column justify-content-center align-items-center gap-3">
            <img class="border-3 border-round border-300 shadow-1 h-20rem" src="./images/person_1.png">
            <span class="capitalize">Aiman Najmi</span>
        </div>
        <div class="flex flex-column justify-content-center align-items-center gap-3">
            <img class="border-3 border-round border-300 shadow-1 h-20rem" src="./images/person_2.png">
            <span class="capitalize">christopher</span>
        </div>
        <div class="flex flex-column justify-content-center align-items-center gap-3">
            <img class="border-3 border-round border-300 shadow-1 h-20rem" src="./images/person_3.jpg">
            <span class="capitalize">hii li hua</span>
        </div>
        <div class="flex flex-column justify-content-center align-items-center gap-3">
            <img class="border-3 border-round border-300 shadow-1 h-20rem" src="./images/person_4.png">
            <span class="capitalize">Pavethran Rajandran</span>
        </div>
    </div>

    <?php include './landingFooter.php'; ?>
</body>
</html>