<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'config.php';
        include './metaheader.php';

        $searchKey = ($_GET['searchkey'] ?? '');
        $searchcategory = ($_GET['searchcategory'] ?? '');
    ?>
</head>

<body class="flex-column-center">
    <?php include './landingNavbar.php'; ?>

    <form action="" method="GET">
        <input type="hidden" value="login_account"/>

        <table>
            <tr>
                <td>
                    <select name="searchcategory" placeholder="Select Category">
                        <option value="">Nothing Selected</option>
                        <?php
                            $categories = fetchRows("SELECT * FROM category");

                            foreach($categories as $c){
                                echo '<option '.($searchcategory == $c['id'] ? 'selected' : '').' value="'.$c['id'].'">'.$c['name'].'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="searchkey" placeholder="Search Menu" value="<?php echo $searchKey; ?>"/>
                </td>
                <td>
                    <input type="submit" value="Search"/>
                </td>
                <td>
                    <a class="cursor-pointer" href="menu_list.php">
                        <input class="cursor-pointer" type="button" value="Clear"/>
                    </a>
                </td>
            </tr>
        </table>
    </form>

    <div class="flex-row-center">

        <?php
            $alreadypush = [];
            $searchquery = '';

            if(!empty($searchKey)){
                $searchquery .= "name LIKE '%$searchKey%'";
            }

            if(!empty($searchcategory)){
                if(!empty($searchKey)){
                    $searchquery .= " AND ";
                }

                $searchquery .= "category = ".$searchcategory;
            }

            if(empty($searchKey) && empty($searchcategory)){
                $searchquery = '(1=1)';
            }

            $article = fetchRows("SELECT * FROM menu WHERE $searchquery AND is_active = 1 AND in_stock = 1");
            
            if(!empty($article)){
                foreach($article as $c){
                    $categoryname = fetchRow("SELECT * from category WHERE id = ".$c['category']);

                    if(!in_array($c['id'], $alreadypush)){
                        echo '<div class="flex-column-center card no-gap relative">
                            <span class="font-bold">'.$c['name'].'</span>

                            <span class="text-sm py-2 px-3 uppercase">'.$categoryname['name'].'</span>

                            <img src="images/'.$c['image'].'" class="w-full h-10rem"/>

                            <p class="truncate-line text-md font-bold text-green-800">RM '.$c['price'].'</p>

                            <div class="w-full flex align-items-center justify-content-center gap-3">
                                <a href="./admin_menu_addcart.php?id='.$c['id'].'" class="relative">
                                    <button class="cursor-pointer">Add Cart</button>
                                </a>
                            </div>
                        </div>';

                        $alreadypush[] = $c['id'];
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
        height: 300px;
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