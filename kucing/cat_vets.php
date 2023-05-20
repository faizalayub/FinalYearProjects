<?php
    include 'config.php';
    $vetsdataset = fetchRows("SELECT * FROM vet");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>
</head>
<body class="h-screen m-0 p-0 flex w-full flex-column relative">
    <?php include './navigator.php'; ?>

    <div class="surface-400 h-screen flex align-items-center justify-content-center">
        <div class="grid w-10 p-6">

        <?php
            if(!empty($vetsdataset)){
                foreach($vetsdataset as $value){
                    echo '
                    <div class="col-12 md:col-4 lg:col-4 p-3">
                        <div class="bg-red-400 border-3 border-800 border-round-xl p-4 flex flex-column gap-3 shadow-3 overflow-auto" style="min-height:15rem">
                            <div class="text-left font-bold text-3xl text-800">'.$value['description'].'</div>
        
                            <div class="flex gap-3">
                                <span class="font-bold text-xl text-800 white-space-nowrap">Address:</span>
                                <span class="text-xl text-800 max-w-10rem">'.$value['address'].'</span>
                            </div>
        
                            <div class="flex gap-3">
                                <span class="font-bold text-xl text-800 white-space-nowrap">Phone:</span>
                                <span class="text-xl text-800 max-w-10rem">'.$value['phone'].'</span>
                            </div>
                        </div>
                    </div>';
                }
            }else{
                echo 'No vet added';
            }
        ?>
        </div>
    </div>
</body>
</html>