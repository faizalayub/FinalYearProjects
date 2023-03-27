<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'config.php';
        include './metaheader.php';

        $searchKey = ($_GET['searchkey'] ?? '');
        $searchcategory = ($_GET['searchcategory'] ?? '');
        $searchgenres = ($_GET['searchgenres'] ?? '');
    ?>
</head>

<body class="flex-column-center">
    <?php include './landingNavbar.php'; ?>

    <h3>Read Material</h3>

    <img src="./logo.jpeg" height="120"/>

    <form action="" method="GET">
        <input type="hidden" value="login_account"/>

        <table>
            <tr>
                <td>
                    <select name="searchcategory" placeholder="Select Category">
                        <option value="">--- No Section Selected ---</option>
                        <?php
                            $categories = fetchRows("SELECT * FROM category");

                            foreach($categories as $c){
                                echo '<option '.($searchcategory == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="searchgenres" placeholder="Select Genres">
                        <option value="">--- No Genres Selected ---</option>
                        <?php
                            $categories = fetchRows("SELECT * FROM genres");

                            foreach($categories as $c){
                                echo '<option '.($searchgenres == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="searchkey" placeholder="Search Name" value="<?php echo $searchKey; ?>"/>
                </td>
                <td>
                    <input type="submit" value="Search"/>
                </td>
            </tr>
        </table>
    </form>

    <div class="flex-row-center">

        <?php
            $alreadypush = [];
            $searchquery = '';

            if(!empty($searchKey)){
                $searchquery .= "article.headline LIKE '%$searchKey%'";
                $searchquery .= " OR article.content LIKE '%$searchKey%'";
            }

            if(!empty($searchcategory)){
                if(!empty($searchKey)){
                    $searchquery .= " AND ";
                }

                $searchquery .= "article.category = ".$searchcategory;
            }

            if(!empty($searchgenres)){
                if(!empty($searchcategory) || !empty($searchKey)){
                    $searchquery .= " AND ";
                }

                $searchquery .= "article.genres = ".$searchgenres;
            }

            if(empty($searchKey) && empty($searchcategory) && empty($searchgenres)){
                $searchquery = '(1=1)';
            }

            $article = fetchRows("SELECT article.id as aid, article.headline as aheadline, article.posted_by as aposted_by, article.is_restricted as ais_restricted, article.category as acategory, article.genres as agenres, article.image as aimage, article.content as acontent FROM `article` JOIN category ON(category.id = article.category) WHERE $searchquery");
            
            if(!empty($article)){
                foreach($article as $c){
                    $categoryname = fetchRow("SELECT * from category WHERE id = ".$c['acategory']);
                    $genresname = fetchRow("SELECT * from genres WHERE id = ".$c['agenres']);

                    $postedby = fetchRow("SELECT * from login WHERE id = ".$c['aposted_by']);

                    $editButton = '<a href="./account_materialupload.php?id='.$c['aid'].'" class="relative"><button class="cursor-pointer">Edit</button></a>';

                    if(!isset($_SESSION['account_session'])){
                        $editButton = '';
                    }else{
                        if($c['aposted_by'] != $_SESSION['account_session']){
                            $editButton = '';
                        }
                    }

                    if(!in_array($c['aid'], $alreadypush)){
                        echo '<div class="flex-column-center card no-gap relative '.($c['ais_restricted'] == 1 ? 'underage-content' : '').'">
                            <span>'.$c['aheadline'].'</span>

                            <span class="text-sm py-2 px-3 uppercase text-center text-600">'.$categoryname['name'].'</span>

                            <span class="text-sm py-2 px-3 text-center text-500">'.$genresname['name'].'</span>

                            <img src="images/'.$c['aimage'].'" class="w-full h-10rem"/>

                            <p class="truncate-line text-sm">'.$c['acontent'].'</p>

                            <div class="w-full flex align-items-center justify-content-center gap-3">
                                '.$editButton.'

                                <a href="./article_details.php?id='.$c['aid'].'" class="relative">
                                    <button class="cursor-pointer">Read More</button>
                                </a>
                            </div>

                            <br>

                            <span class="text-sm text-600">Uploaded By: '.$postedby['email'].'</span>
                        </div>';

                        $alreadypush[] = $c['aid'];
                    }
                }
            }else{
                echo 'No record found';
            }
        ?>

    </div>
</body>

<style>
    .flex-column-center{
        display: flex; 
        align-items:center;
        justify-content: center;
        flex-direction: column;
        gap: 1em;
    }

    .no-gap{
        gap: unset !important;
    }

    .flex-row-center{
        display: flex; 
        align-items:center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1em;
    }

    .card{
        height: 400px;
        width: 240px;
        background: #f4f4f4;
        border: solid 1px #ddd;
        border-radius: 2px;
        padding: 1em;
    }

    .truncate-line{
        overflow:hidden;
        max-height:7rem;
        -webkit-box-orient: vertical;
        display: block;
        display: -webkit-box;
        overflow: hidden !important;
        text-overflow: ellipsis;
        -webkit-line-clamp: 4;
    }

    img{
        object-fit: cover;
    }

    .underage-content:before{
        content: 'Under 18';
        position: absolute;
        height: 100%;
        width: 100%;
        background: #01010161;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        color: #fff;
    }
</style>
</html>