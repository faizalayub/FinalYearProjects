<div class="sticky top-0 w-full flex align-items-center flex-column">
    <h1 class="m-0 p-0 w-full text-center bg-bluegray-500 p-3 text-0" style="font-family: cursive;">
        <?php
            if($isAdmin){
                echo "D ' scholarbookzz Admin";
            }else{
                echo "D ' scholarbookzzz";
            }
        ?>
    </h1>

    <ul class="m-0 flex align-items-center justify-content-center list-none gap-3 border-none w-full bg-bluegray-600 p-3 border-bottom-1 shadow-1 border-300">
        <li class="bg-bluegray-800 border-round cursor-pointer hover:bg-bluegray-500 h-2rem flex align-items-center justify-content-center">
            <a href="./index.php" class="px-3 py-2 no-underline text-bluegray-100">Home</a>
        </li>

        <li class="bg-bluegray-800 border-round cursor-pointer hover:bg-bluegray-500 h-2rem flex align-items-center justify-content-center">
            <a href="./article_list.php" class="px-3 py-2 no-underline text-bluegray-100">Read Material</a>
        </li>

        <?php if(!isset($_SESSION['account_session'])){ ?>

            <li class="bg-bluegray-800 border-round cursor-pointer hover:bg-bluegray-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_login.php" class="px-3 py-2 no-underline text-bluegray-100">Login</a>
            </li>
            <li class="bg-bluegray-800 border-round cursor-pointer hover:bg-bluegray-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_create.php" class="px-3 py-2 no-underline text-bluegray-100">Signup</a>
            </li>

        <?php }else{ ?>

            <?php if(!$isAdmin){ ?>
                <li class="bg-bluegray-800 border-round cursor-pointer hover:bg-bluegray-500 h-2rem flex align-items-center justify-content-center">
                    <a href="./account_editprofile.php" class="px-3 py-2 no-underline text-bluegray-100">Edit Profile</a>
                </li>

                <li class="bg-bluegray-800 border-round cursor-pointer hover:bg-bluegray-500 h-2rem flex align-items-center justify-content-center">
                    <a href="./account_materialupload.php" class="px-3 py-2 no-underline text-bluegray-100">Upload Material</a>
                </li>
            <?php } ?>

            <li class="bg-bluegray-800 border-round cursor-pointer hover:bg-bluegray-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_logout.php" class="px-3 py-2 no-underline text-bluegray-100">Log Out</a>
            </li>

        <?php } ?>
    </ul>
</div>