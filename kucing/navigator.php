<?php
    $filePath = $_SERVER['SCRIPT_FILENAME'];
    $fileName = basename($filePath);
?>

<div class="sticky top-0 w-full flex align-items-center flex-column z-5">
    <ul class="px-4 py-3 m-0 flex align-items-center justify-content-start list-none gap-3 border-none w-full surface-0 border-bottom-1 border-300 border-bottom-1 z-5">
        <li>
            <form method="GET" class="px-3" action="./cat_listing.php">
                <input type="search" placeholder="Search" class="border-round-3xl h-3rem w-15rem border-1 border-600" name="key" value="<?php echo (isset($_GET['key']) ? $_GET['key'] : ''); ?>"/>
            </form>
        </li>

        <li class="surface-300 border-round-3xl cursor-pointer h-3rem flex align-items-center justify-content-center <?php echo ($fileName == 'index.php' ? 'surface-500' : '')?>">
            <a href="./index.php" class="px-4 py-2 no-underline text-900">Home</a>
        </li>

        <li class="surface-300 border-round-3xl cursor-pointer h-3rem flex align-items-center justify-content-center <?php echo ($fileName == 'cat_listing.php' ? 'surface-500' : '')?>">
            <a href="./cat_listing.php" class="px-4 py-2 no-underline text-900">Cats</a>
        </li>

        <li class="surface-300 border-round-3xl cursor-pointer h-3rem flex align-items-center justify-content-center <?php echo ($fileName == 'cat_donating.php' ? 'surface-500' : '')?>">
            <a href="./cat_donating.php" class="px-4 py-2 no-underline text-900">Donate</a>
        </li>

        <li class="surface-300 border-round-3xl cursor-pointer h-3rem flex align-items-center justify-content-center <?php echo ($fileName == 'cat_news.php' ? 'surface-500' : '')?>">
            <a href="./cat_news.php" class="px-4 py-2 no-underline text-900">News</a>
        </li>

        <?php if(!isset($_SESSION['account_session'])){ ?>

            <li class="surface-300 border-round-3xl cursor-pointer h-3rem flex align-items-center justify-content-center <?php echo ($fileName == 'cat_login.php' ? 'surface-500' : '')?>">
                <a href="./cat_login.php" class="px-4 py-2 no-underline text-900">Login</a>
            </li>
            <li class="surface-300 border-round-3xl cursor-pointer h-3rem flex align-items-center justify-content-center <?php echo ($fileName == 'cat_signup.php' ? 'surface-500' : '')?>">
                <a href="./cat_signup.php" class="px-4 py-2 no-underline text-900">Signup</a>
            </li>

        <?php }else{ ?>

            <?php
                $profilePicture = './images/default_avatar.jpeg';
                $profile = fetchRow("SELECT * FROM `login` WHERE `id` = '".$_SESSION['account_session']."'");
            
                if($profile){
                    $profile = json_decode(json_encode($profile), false);

                    if(!empty($profile->picture)){
                        $profilePicture = './images/'.$profile->picture;
                    }
                }  
            ?>

            <li class="surface-300 border-round-3xl cursor-pointer h-3rem flex align-items-center justify-content-center <?php echo ($fileName == 'cat_dashboard.php' ? 'surface-500' : '')?>">
                <a href="./cat_dashboard.php" class="px-4 py-2 no-underline text-900">Profile</a>
            </li>

            <li class="surface-300 border-round-3xl cursor-pointer h-3rem flex align-items-center justify-content-center">
                <a href="./cat_logout.php" class="px-4 py-2 no-underline text-900">Log Out</a>
            </li>

            <li class="ml-auto">
                <a href="./cat_dashboard.php" class="flex align-items-center gap-2 px-3 no-underline">
                    <img style="object-fit: cover;" src="<?php echo $profilePicture; ?>" class="h-3rem w-3rem" />
                    <span><?php echo $profile->name; ?></span>
                </a>
            </li>

        <?php } ?>
    </ul>
</div>