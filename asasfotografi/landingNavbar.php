<div class="sticky top-0 w-full flex align-items-center flex-column">
    <h1 class="m-0 p-0 w-full text-center bg-blue-500 p-3 text-0 capitalize" style="font-family: tahoma;">
        <?php
            echo "Asas fotografi";
        ?>
    </h1>

    <ul class="m-0 flex align-items-center justify-content-center list-none gap-3 border-none w-full bg-blue-500 p-3 border-bottom-1 shadow-1 border-300">
        <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
            <a href="./article_maklumat.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Maklumat</a>
        </li>

        <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
            <a href="./article_synopsis.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Sinopsis</a>
        </li>

        <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
            <a href="./about_us.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Tentang Kami</a>
        </li>
        
        <?php if(!isset($_SESSION['account_session'])){ ?>

            <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_login.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Log Masuk</a>
            </li>

            <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_create.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Daftar Akaun</a>
            </li>

        <?php }else{ ?>

            <?php if(!$isAdmin){ ?>
                <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
                    <a href="./article_list.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Bacaan</a>
                </li>

                <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
                    <a href="./account_materialupload.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Muat Naik Bahan</a>
                </li>

                <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
                    <a href="./account_editprofile.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Kemaskini Profil</a>
                </li>
            <?php } ?>

            <li class="bg-blue-800 border-round cursor-pointer hover:bg-blue-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_logout.php" class="px-3 py-2 no-underline text-blue-100 white-space-nowrap">Log Keluar</a>
            </li>

        <?php } ?>
    </ul>
</div>