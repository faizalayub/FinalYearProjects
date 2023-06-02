<?php
    include 'config.php';

    $menuorder = fetchRows("SELECT * FROM `user_order`");
?>

<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MAGICAL WATCHES OF M'SIA</title>

    <link rel="stylesheet" href="asset/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="asset/style.css">
    <link rel="stylesheet" href="asset/custom-style.css">

    <style>
        td, th{
            padding: 14px;
        }
    </style>
</head>
<body class="h-screen surface-0 p-8">
    <div class="surface-0 border-round-2xl h-full shadow-3 content-paper-bg p-3">

        <!-- START Content-->
        <div class="h-full w-full flex align-items-center justify-content-center flex-column gap-3">
            <div class="max-h-30rem overflow-auto">
                <table border="1" cellspacing="0" class="surface-0">
                    <tr>
                        <th>No.</th>
                        <th>Watch</th>
                        <th>Buyer Info</th>
                        <th>Payment Method</th>
                    </tr>
                    <?php
                        if(!empty($menuorder)){
                            foreach($menuorder as $key => $value){
                                $menu = fetchRow("SELECT * FROM `menu` WHERE id =".$value['menu_id']);
                                $user = fetchRow("SELECT * FROM `login` WHERE id =".$value['user_id']);

                                echo "
                                <tr>
                                    <td>".($key + 1)."</td>
                                    <td align='center'>
                                        <div class='w-full text-center'>".$menu['name']."</div><br>
                                        <img src='./images/".$menu['image']."' class='h-6rem'/>
                                    </td>
                                    <td>".$user['name']." - ".$user['email']." - ".$user['phone']."</td>
                                    <td class='uppercase text-center'>".$value['payment_method']."</td>
                                </tr>";
                            }
                        }else{
                            echo '<tr><td align="center" colspan="4">No Buyer Yet</td></tr>';
                        }
                    ?>
                </table>    
            </div>

            <a href="navigation-admin.php" class="no-underline text-2xl bg-bluegray-500 cursor-pointer py-2 px-6 h-4rem border-3 border-bluegray-600 hover:border-bluegray-800 border-circle border-3 text-0 flex align-items-center justify-content-center">Go Back</a>
        </div>
        <!-- END Content-->

    </div>
</body>
</html>