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

    <div class="w-full flex flex-column align-items-center py-8 gap-3 background-image h-screen">
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
                        <a class="cursor-pointer" href="menu_list">
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

                $productKerepek = fetchRows("SELECT * FROM menu WHERE $searchquery AND is_active = 1");
                
                if(!empty($productKerepek)){
                    //# Collect Order Product
                    $productOrder = [];
                    $orderFetch = fetchRows("SELECT * FROM `user_order`");

                    foreach($orderFetch as $order){
                        $itemorder = json_decode($order['menu_id']);

                        foreach($itemorder as $o){
                            if(isset($productOrder[$o])){
                                $productOrder[$o] = $productOrder[$o].",".$o;
                            }else{
                                $productOrder[$o] = $o;
                            }
                        } 
                    }

                    //# Loop Product
                    foreach($productKerepek as $c){
                        $totalOrdered = 0;
                        $categoryname = fetchRow("SELECT * from category WHERE id = ".$c['category']);
                        $stockbalance = $c['in_stock'];

                        if(isset($productOrder[$c['id']])){
                            $totalOrdered = explode(',',$productOrder[$c['id']]);
                            $totalOrdered = count($totalOrdered);
                        }

                        if(($stockbalance - $totalOrdered) <= 0){
                            continue;
                        }

                        if(!in_array($c['id'], $alreadypush)){
                            echo '<div class="flex-column-center card no-gap relative justify-content-start">
                                <img src="images/'.$c['image'].'" class="w-full h-15rem"/>

                                <span class="font-bold p-3">'.$c['name'].'</span>

                                <span class="text-sm text-center w-full uppercase">'.$categoryname['name'].'</span>

                                <span class="text-sm text-center w-full uppercase py-2 w-full font-italic">Stock: '.($stockbalance - $totalOrdered).'</span>

                                <div class="mt-auto border-top-1 border-300 w-full flex">
                                    <p class="p-2 truncate-line text-md font-bold text-green-800 flex-1 m-0">RM '.$c['price'].'</p>

                                    <a href="./admin_menu_addcart?id='.$c['id'].'" class="p-2 relative">
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
        height: 380px;
        width: 240px;
        background: #fff;
        border: solid 1px #ddd;
        border-radius: 2px;
        padding: 0;
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