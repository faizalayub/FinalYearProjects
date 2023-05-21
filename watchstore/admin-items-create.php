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
</head>
<body class="h-screen surface-0 p-8">
    <div class="surface-0 border-round-2xl h-full shadow-3 content-paper-bg p-3">
        <a href="./navigation-admin.php" class="p-3 surface-900 border-circle">
            <i class="fa fa-home text-0 text-6xl" aria-hidden="true"></i>
        </a>

        <!-- START Content-->
        <form method="POST" class="h-full w-full flex align-items-center justify-content-center flex-column gap-5">
            <div class="uppercase text-2xl bg-yellow-500 py-4 px-6 border-3 border-yellow-600 text-yellow-800 border-round-3xl h-1rem flex align-items-center justify-content-center">User Login Form</div>

            <div class="flex flex-column gap-3">
                <div class="flex align-items-center gap-3">
                    <span class="uppercase w-10rem text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3">Name</span>
                    <input type="text" name="" class="uppercase text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3" autocomplete="off" />
                </div>

                <div class="flex align-items-center gap-3">
                    <span class="uppercase w-10rem text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3">Picture</span>
                    <input type="file" name="" class="uppercase text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3" autocomplete="off" />
                </div>

                <div class="flex align-items-center gap-3">
                    <span class="uppercase w-10rem text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3">Price</span>
                    <input type="number" name="" class="uppercase text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3" autocomplete="off" />
                </div>

                <div class="flex align-items-center gap-3">
                    <span class="uppercase w-10rem text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3">Description</span>
                    <textarea name="" class="uppercase text-xl bg-yellow-500 py-3 px-4 border-3 border-yellow-600 border-round-3xl border-3"></textarea>
                </div>
            </div>

            <button class="no-underline uppercase text-2xl bg-yellow-500 cursor-pointer py-2 px-6 h-4rem border-3 border-yellow-600 hover:border-yellow-800 border-circle border-3 text-yellow-900 flex align-items-center justify-content-center">Submit</button>
        </div>
        <!-- END Content-->


    </div>
</body>
</html>