<div class="fixed z-5 top-0 w-full flex align-items-center bg-yellow-600 shadow-1 border-bottom-1 border-yellow-700">
    <a href="./index" class="w-full flex no-underline">
        <img src="./asset/logo/imagelogo.jpeg" class="w-4rem p-1 border-round">

        <span class="m-0 w-full text-left p-3 text-0 text-2xl h-full">
            <?php
                if($isAdmin){
                    echo "Lizkrispychip Kerepek Admin";
                }else{
                    echo "Lizkrispychip Kerepek";
                }
            ?>
        </span>
    </a>

    <ul class="p-3 m-0 flex align-items-center justify-content-end list-none gap-3 border-none w-full h-full">
        <li class="bg-yellow-800 border-round cursor-pointer hover:bg-yellow-500 h-2rem flex align-items-center justify-content-center">
            <a href="./index" class="px-3 py-2 no-underline text-yellow-100">Home</a>
        </li>

        <li class="bg-yellow-800 border-round cursor-pointer hover:bg-yellow-500 h-2rem flex align-items-center justify-content-center">
            <a href="./menu_list" class="px-3 py-2 no-underline text-yellow-100 white-space-nowrap">Kerepek</a>
        </li>

        <?php if(!isset($_SESSION['account_session'])){ ?>

            <li class="bg-yellow-800 border-round cursor-pointer hover:bg-yellow-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_login" class="px-3 py-2 no-underline text-yellow-100">Login</a>
            </li>
            <li class="bg-yellow-800 border-round cursor-pointer hover:bg-yellow-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_create" class="px-3 py-2 no-underline text-yellow-100">Signup</a>
            </li>

        <?php }else{ ?>

            <li class="bg-yellow-800 border-round cursor-pointer hover:bg-yellow-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_dashboard" class="px-3 py-2 no-underline text-yellow-100">Profile</a>
            </li>

            <li class="bg-yellow-800 border-round cursor-pointer hover:bg-yellow-500 h-2rem flex align-items-center justify-content-center">
                <a href="./account_logout" class="px-3 py-2 no-underline text-yellow-100">Log Out</a>
            </li>

        <?php } ?>
    </ul>
</div>