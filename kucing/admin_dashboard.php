<?php
    include 'config.php';

    if(!isset($_SESSION['account_admin'])){
        header("Location: cat_login.php");
        exit();
    }

    $editDataset = null;
    $dataset = fetchRows("SELECT * FROM `cat`");

    if(isset($_GET['id'])){
        $editDataset = fetchRow("SELECT * FROM `cat` WHERE id =".$_GET['id']);
    }

    if(isset($_POST['create_cat'])){
        $name        = $_POST['name'];
        $race        = $_POST['race'];
        $food        = $_POST['food'];
        $gender      = $_POST['gender'];
        $ageing      = $_POST['ageing'];
        $maintenance = $_POST['maintenance'];
        $description = $_POST['description'];

        if(isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["size"])){
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

            if(!$check) {
                echo "File is not an image."; exit;
            }

            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                // echo "The file ". htmlspecialchars( basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
            }else{
                echo "Sorry, there was an error uploading your file.";
            }

            $imagename = $_FILES["fileToUpload"]["name"];

            if(isset($_GET['id'])){
                runQuery("UPDATE `cat` SET `name` = '$name', `race` = '$race', `food` = '$food', `gender` = '$gender', `maintenance` = '$maintenance', `description` = '$description', `picture` = '$imagename' WHERE `cat`.`id` = ".$_GET['id']);

                echo "<script>alert('Menu Updated!');</script>";
            }else{
                runQuery("INSERT INTO `cat` (`id`, `name`, `race`, `food`, `gender`, `maintenance`, `age`, `description`, `picture`) VALUES (NULL, '$name', '$race', '$food', '$gender', '$maintenance', '$ageing', '$description', '$imagename')");

                echo "<script>alert('New cat published!');</script>";
            }
        }

        echo "<script>window.location.href='admin_dashboard.php'</script>";
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
            <a class="no-underline p-3 surface-900 text-0 font-bold border-round-3xl border-3 border-900 cursor-pointer shadow-3" href="./admin_dashboard.php" class="no-underline text-800">Manage Cats</a>
        </li>
        <li>
            <a class="no-underline p-3 surface-0 border-round-3xl border-3 border-700 cursor-pointer shadow-3" href="./admin_vets.php" class="no-underline text-800">Manage Vets</a>
        </li>
        <li>
            <a class="no-underline p-3 surface-0 border-round-3xl border-3 border-700 cursor-pointer shadow-3" href="./admin_news.php" class="no-underline text-800">Publish News</a>
        </li>
        <li>
            <a class="no-underline p-3 surface-0 border-round-3xl border-3 border-700 cursor-pointer shadow-3" href="./cat_logout.php" class="no-underline text-800">Logout</a>
        </li>
    </ol>

    <form method="POST" enctype="multipart/form-data" class="mt-6 w-8 surface-0 shadow-3 border-round-xl flex flex-column pt-6 pb-6 px-8 align-items-center justify-content-center gap-3 ">
        <div class="w-6 px-4 flex justify-content-center">
            <span class="p-3 font-bold text-xl">Create Cats</span>
        </div>

        <div class="w-6 flex gap-3">
            <input type="file" class="w-full border-3 border-800 border-round" required name="fileToUpload"/>
            <input type="text" class="w-full border-3 border-800 border-round" placeholder="Cat Name" required name="name" value="<?php echo (!empty($editDataset) ? $editDataset['name'] : ''); ?>"/>
        </div>

        <div class="w-6 flex gap-3">
            <input type="text" class="w-full border-3 border-800 border-round" placeholder="Cat Race" required name="race" value="<?php echo (!empty($editDataset) ? $editDataset['race'] : ''); ?>"/>
            <input type="text" class="w-full border-3 border-800 border-round" placeholder="Cat Gender" required name="gender" value="<?php echo (!empty($editDataset) ? $editDataset['gender'] : ''); ?>"/>
        </div>

        <div class="w-6 flex gap-3">
            <input type="text" class="w-full border-3 border-800 border-round" placeholder="Food Behavior" required name="food" value="<?php echo (!empty($editDataset) ? $editDataset['food'] : ''); ?>"/>
            <input type="text" class="w-full border-3 border-800 border-round" placeholder="Maintenance Info" required name="maintenance" value="<?php echo (!empty($editDataset) ? $editDataset['maintenance'] : ''); ?>"/>
            <input type="number" class="w-full border-3 border-800 border-round" placeholder="Age (Years)" required name="ageing" value="<?php echo (!empty($editDataset) ? $editDataset['age'] : ''); ?>"/>
        </div>

        <div class="w-6 flex">
            <textarea class="w-full border-3 border-800 border-round h-10rem" placeholder="Description" required name="description"><?php echo (!empty($editDataset) ? $editDataset['description'] : ''); ?></textarea>
        </div>
        
        <button type="submit" name="create_cat" class="cursor-pointer border-1 surface-900 text-0 uppercase p-3 border-round-3xl w-4">Submit</button>
    </form>

    <?php if(!empty($dataset)){ ?>
        <div class="mt-3 surface-0 shadow-3 border-round-xl flex flex-column pt-6 pb-6 px-8 align-items-center justify-content-center gap-3 w-8">
            <span class="p-3 font-bold text-xl">Cat List</span>
            <div class="overflow-auto h-full w-full">
                <table class="border-1 border-300 w-full">
                    <thead>
                        <tr class="surface-300">
                            <th class="p-3">#</th>
                            <th class="p-3">Picture</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Race</th>
                            <th class="p-3">Food</th>
                            <th class="p-3">Gender</th>
                            <th class="p-3">Age</th>
                            <th class="p-3">Maintenance</th>
                            <th class="p-3">Description</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($dataset as $key => $value){
                                $approvalButton = '';
                                $rejectButton = '';
                                $statusTag = '<span class="text-base text-0 bg-blue-400 border-round p-2">Available</span>';
                                $status = fetchRow("SELECT * FROM `adopt` WHERE `adopt`.`cat_id` = ".$value['id']);

                                if(!empty($status)){
                                    $profile = fetchRow("SELECT * FROM `login` WHERE id = ".$status['user_id']);

                                    if($status['status'] == 0){
                                        $statusTag = '<span class="text-base text-0 surface-400 border-round p-2 white-space-nowrap">Pending Approval</span>';
                                        $approvalButton = '<a href="admin_dashboard_approve.php?id='.$status['id'].'">Approve</a> | ';
                                        $rejectButton = '<a href="admin_dashboard_reject.php?id='.$status['id'].'">Reject</a> | ';
                                    }else{
                                        $statusTag = '<span class="text-base border-round p-2 white-space-nowrap">Owned By '.$profile['email'].'</span>';
                                    }
                                }

                                echo '<tr>
                                    <td class="p-3">'.($key + 1).'</td>
                                    <td class="p-3">
                                        <img src="images/'.$value['picture'].'" class="h-4rem w-4rem" />
                                    </td>
                                    <td class="p-3">'.$value['name'].'</td>
                                    <td class="p-3">'.$value['race'].'</td>
                                    <td class="p-3">'.$value['food'].'</td>
                                    <td class="p-3">'.$value['gender'].'</td>
                                    <td class="p-3 white-space-nowrap">'.$value['age'].' Years</td>
                                    <td class="p-3">'.$value['maintenance'].'</td>
                                    <td class="p-3"><p class="w-15rem">'.$value['description'].'</p></td>
                                    <td class="p-3">'.$statusTag.'</td>
                                    <td class="p-3 flex align-items-center gap-3">
                                        '.$approvalButton.'
                                        '.$rejectButton.'
                                        <a href="admin_dashboard.php?id='.$value['id'].'">Edit</a>
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