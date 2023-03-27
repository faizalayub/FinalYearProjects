<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'config.php';
        include './metaheader.php';

        // $mykad = '881216105225';
        // $yearOffset = (substr($mykad, -12, 1) != 0 ? '19' : '20');
        // $birthYear = (int) $yearOffset.substr($mykad, -12, 2);
        // $dateCurrent = (int) date('Y');
        // $ageCurrent = ($dateCurrent - $birthYear);

        // echo $ageCurrent;
        // exit;

        $article = fetchRow("SELECT * FROM article WHERE id=".$_GET['id']);

        if(!isset($_SESSION['account_session'])){
            echo "<script>alert('Please login first');</script>";
            echo "<script>window.location.href='article_list.php'</script>";
        }else{
            if($article['is_restricted']){
                $accountinfo = fetchRow("SELECT * from login WHERE id =".$_SESSION['account_session']);
                $mykad = $accountinfo['age'];

                $yearOffset = (substr($mykad, -12, 1) != 0 ? '19' : '20');
                $birthYear = (int) $yearOffset.substr($mykad, -12, 2);
                $dateCurrent = (int) date('Y');
                $ageCurrent = ($dateCurrent - $birthYear);

                if($ageCurrent <= 18){
                    echo "<script>alert('THIS SECTION RESTRICTED TO UNDER 18!');</script>";
                    echo "<script>window.location.href='article_list.php'</script>";
                }
            }
        }

        $categoryname = fetchRow("SELECT * from category WHERE id = ".$article['category']);
        $genresname = fetchRow("SELECT * from genres WHERE id = ".$article['genres']);
    ?>
</head>

<body class="flex-column-center">   
    <?php include './landingNavbar.php'; ?>

    <h3 class="text-center"><?php echo $article['headline']; ?></h3>

    <h4 class="text-center text-600">Sections: <?php echo $categoryname['name']; ?></h4>

    <h4 class="text-center text-600">Genre: <?php echo $genresname['name']; ?></h4>

    <div class="w-full flex align-items-center justify-content-center flex-column py-6 gap-3">
        <img src="images/<?php echo $article['image']; ?>" class="w-30rem h-full"/>

        <p class="px-6 line-height-3" style="white-space: pre-line;"><?php echo $article['content']; ?></p>

        <p class="text-400 text-sm">End Of Content</p>

        <?php
            if($isAdmin){
                echo '<input onclick="restrictedContent()" type="button" value="Set as under 18+ content" class="cursor-pointer"/>';
                echo '<a href="account_materialdelete.php?id='.$_GET['id'].'"><input type="button" value="Delete" class="bg-red-600 text-0 cursor-pointer"/></a>';
            }
        ?>

        <a href="./article_list.php" class="cursor-pointer">
            <button>Go Back</button>
        </a>
    </div>
</body>

<script>
    function restrictedContent(){
        if(confirm("Are you sure to set this article as restricted?")){
            window.location.href=`article_details_setrestrict.php?id=<?php echo $_GET['id']; ?>`;
        }
    }
</script>
</html>