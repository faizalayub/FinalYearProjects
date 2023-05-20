<?php
    include 'config.php';

    if(!isset($_SESSION['account_admin'])){
        header("Location: cat_login.php");
        exit();
    }

    $editDataset = null;
    $dataset = fetchRows("SELECT * FROM vet");

    if(isset($_GET['id'])){
        $editDataset = fetchRow("SELECT * FROM `vet` WHERE id =".$_GET['id']);
    }

    if(isset($_POST['create_vet'])){
        $vetname = ($_POST['vet_name']);
        $vetphone = ($_POST['vet_phone']);
        $vetaddress = ($_POST['vet_address']);

        if(isset($_GET['id'])){
            runQuery("UPDATE `vet` SET `description` = '$vetname', `address` = '$vetaddress', `phone` = '$vetphone' WHERE `vet`.`id` = ".$_GET['id']);

            echo "<script>alert('Vet Updated!');window.location.href='admin_vets.php';</script>";
        }else{
            runQuery("INSERT INTO `vet` (`id`, `description`, `address`, `phone`) VALUES (NULL, '".addslashes($vetname)."', '".addslashes($vetaddress)."', '".addslashes($vetphone)."')");

            echo "<script>alert('Vet Added!');window.location.href='admin_vets.php';</script>";
        }
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
            <a class="no-underline p-3 surface-900 text-0 font-bold border-round-3xl border-3 border-900 cursor-pointer shadow-3" href="./admin_vets.php" class="no-underline text-800">Manage Vets</a>
        </li>
        <li>
            <a class="no-underline p-3 surface-0 border-round-3xl border-3 border-700 cursor-pointer shadow-3" href="./admin_news.php" class="no-underline text-800">Publish News</a>
        </li>
        <li>
            <a class="no-underline p-3 surface-0 border-round-3xl border-3 border-700 cursor-pointer shadow-3" href="./cat_logout.php" class="no-underline text-800">Logout</a>
        </li>
    </ol>

    <form method="POST" class="mt-6 w-8 surface-0 shadow-3 border-round-xl flex flex-column pt-6 pb-6 px-8 align-items-center justify-content-center gap-3 w-8">
        <div class="w-6 px-4 flex justify-content-center">
            <span class="p-3 font-bold text-xl">Publish Cat Vets</span>
        </div>

        <div class="w-6 flex gap-3">
            <input type="text" class="w-full border-3 border-800 border-round" placeholder="Vet Name" required name="vet_name" value="<?php echo (!empty($editDataset) ? $editDataset['description'] : ''); ?>" />
            <input type="text" class="w-full border-3 border-800 border-round" placeholder="Vet Phone Number" required name="vet_phone" value="<?php echo (!empty($editDataset) ? $editDataset['phone'] : ''); ?>" />
        </div>

        <div class="w-6 flex">
            <textarea class="w-full border-3 border-800 border-round h-10rem" placeholder="Vet Address" required name="vet_address"><?php echo (!empty($editDataset) ? $editDataset['address'] : ''); ?></textarea>
        </div>
        
        <button type="submit" name="create_vet" class="cursor-pointer border-1 surface-900 text-0 uppercase p-3 border-round-3xl w-4">Submit</button>
    </form>

    <?php if(!empty($dataset)){ ?>
        <div class="mt-3 surface-0 shadow-3 border-round-xl flex flex-column pt-6 pb-6 px-8 align-items-center justify-content-center gap-3 w-8">
            <span class="p-3 font-bold text-xl">Cat List</span>
            <div class="overflow-auto h-full w-full">
                <table class="border-1 border-300 w-full">
                    <thead>
                        <tr class="surface-300">
                            <th class="p-3">#</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Phone</th>
                            <th class="p-3">Address</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($dataset as $key => $value){
                                echo '<tr>
                                    <td class="p-3">'.($key + 1).'</td>
                                    <td class="p-3">'.$value['description'].'</td>
                                    <td class="p-3">'.$value['phone'].'</td>
                                    <td class="p-3">'.$value['address'].'</td>
                                    <td class="p-3 flex align-items-center gap-3">
                                        <a href="admin_vets.php?id='.$value['id'].'">Edit</a>
                                    </td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>

</body>
</html>