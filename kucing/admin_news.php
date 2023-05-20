<?php
    include 'config.php';

    if(!isset($_SESSION['account_admin'])){
        header("Location: cat_login.php");
        exit();
    }

    $newsdataset = fetchRow("SELECT * FROM news ORDER BY id DESC LIMIT 1");

    if(isset($_POST['publish_cats'])){
        $newsvalue = addslashes($_POST['news_input']);

        runQuery("INSERT INTO `news` (`id`, `textarea`) VALUES (NULL, '".$newsvalue."')");
        echo "<script>alert('News published!');window.location.href='admin_news.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body class="m-0 p-0 w-full flex flex-column align-items-center justify-content-start pt-3 surface-300 gap-4">
    <a href="./index.php" class="no-underline text-800"><h1 class="text-center w-full">Welcome To Admin Dashboard</h1></a>

    <ol class="list-none flex align-items-center justify-content-enter p-0 m-0 gap-3">
        <li>
            <a class="no-underline p-3 surface-0 border-round-3xl border-3 border-700 cursor-pointer shadow-3" href="./admin_dashboard.php" class="no-underline text-800">Manage Cats</a>
        </li>
        <li>
            <a class="no-underline p-3 surface-0 border-round-3xl border-3 border-700 cursor-pointer shadow-3" href="./admin_vets.php" class="no-underline text-800">Manage Vets</a>
        </li>
        <li>
            <a class="no-underline p-3 surface-900 text-0 font-bold border-round-3xl border-3 border-900 cursor-pointer shadow-3" href="./admin_news.php" class="no-underline text-800">Publish News</a>
        </li>
        <li>
            <a class="no-underline p-3 surface-0 border-round-3xl border-3 border-700 cursor-pointer shadow-3" href="./cat_logout.php" class="no-underline text-800">Logout</a>
        </li>
    </ol>

    <form method="POST" class="mt-6 w-8 surface-0 shadow-3 border-round-xl flex flex-column pt-6 pb-6 px-8 align-items-center justify-content-center gap-3 ">
        <span class="p-3 font-bold text-xl">Publish News</span>

        <textarea name="news_input" class="w-full h-10rem border-round border-1 border-300 shadow-2" placeholder="Descript cat news"><?php echo (!empty($newsdataset) ? $newsdataset['textarea'] : ''); ?></textarea>
        
        <button type="submit" name="publish_cats" class="cursor-pointer border-1 surface-900 text-0 uppercase p-3 border-round-3xl w-4">Submit</button>
    </form>
</body>
</html>