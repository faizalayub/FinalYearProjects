<div class="sticky top-0 w-full flex align-items-center flex-column">
    <h1 class="m-0 p-0 w-full text-center bg-indigo-600 p-3 text-0" style="font-family: cursive;">
        <?php
            if($isAdmin){
                echo "Mawar Restaurant Admin";
            }else{
                echo "Mawar Restaurant";
            }
        ?>
    </h1>

    <ul class="m-0 flex align-items-center justify-content-center list-none gap-3 border-none w-full bg-indigo-600 p-3 border-bottom-1 shadow-1 border-300 border-bottom-3 border-indigo-700">
        <li class="bg-indigo-800 border-round cursor-pointer hover:bg-indigo-500 h-2rem flex align-items-center justify-content-center">
            <a href="./index.php" class="px-3 py-2 no-underline text-indigo-100">Home</a>
        </li>

        <li class="bg-indigo-800 border-round cursor-pointer hover:bg-indigo-500 h-2rem flex align-items-center justify-content-center">
            <a href="./menu_list.php" class="px-3 py-2 no-underline text-indigo-100">Order Now!</a>
        </li>

        <?php if(!isset($_SESSION['account_session'])){ ?>

            <li class="bg-indigo-800 border-round cursor-pointer hover:bg-indigo-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_login.php" class="px-3 py-2 no-underline text-indigo-100">Login</a>
            </li>
            <li class="bg-indigo-800 border-round cursor-pointer hover:bg-indigo-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_create.php" class="px-3 py-2 no-underline text-indigo-100">Signup</a>
            </li>

        <?php }else{ ?>

            <li class="bg-indigo-800 border-round cursor-pointer hover:bg-indigo-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_dashboard.php" class="px-3 py-2 no-underline text-indigo-100">Profile</a>
            </li>

            <li class="bg-indigo-800 border-round cursor-pointer hover:bg-indigo-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_logout.php" class="px-3 py-2 no-underline text-indigo-100">Log Out</a>
            </li>

        <?php } ?>
    </ul>
</div>