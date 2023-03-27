<?php
    include 'config.php';

    if(!isset($_GET['method'])){
        header("Location: account_cart");exit();
    }

    if(!isset($_GET['address'])){
        header("Location: account_cart");exit();
    }

    $bankDisplay = array('image' => 'maybank_logo.png', 'color' => 'yellow-500');
    $methodID = ($_GET['method'] == 1 ? 'Pick-Up' : 'Delivery');
    $addressID = $_GET['address'];

    $cartIDStore = [];
    $getBankinfo = fetchRow("SELECT * FROM `payment_account`");
    $allcartMenu = fetchRows("SELECT * FROM user_cart where user=".$_SESSION['account_session']);

    if(empty($allcartMenu)){
        header("Location: account_cart");
        exit();
    }

    foreach($allcartMenu as $m){
        $cartIDStore[] = fetchRow("SELECT * FROM `menu` WHERE id=".$m['menu']);
    }

    if(isset($getBankinfo['type'])){
        switch($getBankinfo['type']){
            case 'maybank':
                $bankDisplay['image'] = 'maybank_logo.png';
                $bankDisplay['color'] = 'yellow-500';
            break;
            case 'bankislam':
                $bankDisplay['image'] = 'bimb_logo.jpeg';
                $bankDisplay['color'] = 'red-800';
            break;
            case 'bsn':
                $bankDisplay['image'] = 'bsn_logo.png';
                $bankDisplay['color'] = 'cyan-600';
            break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './metaheader.php'; ?>

    <style>
        .card {
            background-color: #fff;
            width: 100%;
            float: left;
            margin-top: 0;
            border-radius: 5px;
            box-sizing: border-box;
            padding: 80px 30px 25px 30px;
            text-align: center;
            position: relative;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }
        .card__success {
            position: absolute;
            top: -50px;
            left: 12rem;
            width: 100px;
            height: 100px;
            border-radius: 100%;
            background-color: #60c878;
            border: 5px solid #fff;
        }
        .card__success i {
            color: #fff;
            line-height: 100px;
            font-size: 45px;
        }
        .card__msg {
            text-transform: uppercase;
            color: #55585b;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .card__submsg {
            color: #959a9e;
            font-size: 16px;
            font-weight: 400;
            margin-top: 0px;
        }
        .card__body {
            background-color: #f8f6f6;
            border-radius: 4px;
            width: 100%;
            margin-top: 30px;
            float: left;
            box-sizing: border-box;
            padding: 30px;
        }
        .card__avatar {
            width: 50px;
            height: 50px;
            border-radius: 100%;
            display: inline-block;
            margin-right: 10px;
            position: relative;
            top: 7px;
        }
        .card__recipient-info {
            display: inline-block;
        }
        .card__recipient {
            color: #232528;
            text-align: left;
            margin-bottom: 5px;
            font-weight: 600;
        }
        .card__email {
            color: #838890;
            text-align: left;
            margin-top: 0px;
        }
        .card__price {
            color: #232528;
            font-size: 70px;
            margin-top: 25px;
            margin-bottom: 30px;
        }
        .card__price span {
            font-size: 60%;
        }
        .card__method {
            color: #d3cece;
            text-transform: uppercase;
            text-align: left;
            font-size: 11px;
            margin-bottom: 5px;
        }
        .card__payment {
            background-color: #fff;
            border-radius: 4px;
            width: 100%;
            height: 100px;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card__credit-card {
            width: 50px;
            display: inline-block;
            margin-right: 15px;
        }
        .card__card-details {
            display: inline-block;
            text-align: left;
        }
        .card__card-type {
            text-transform: uppercase;
            color: #232528;
            font-weight: 600;
            font-size: 12px;
            margin-bottom: 3px;
        }
        .card__card-number {
            color: #838890;
            font-size: 12px;
            margin-top: 0px;
        }
        .card__tags {
            clear: both;
            padding-top: 15px;
        }
        .card__tag {
            text-transform: uppercase;
            background-color: #f8f6f6;
            box-sizing: border-box;
            padding: 3px 5px;
            border-radius: 3px;
            font-size: 10px;
            color: #d3cece;
        }

        .spinner.loading {
            padding: 50px;
            position: relative;
            text-align: center;
        }

        .spinner.loading:before {
            content: "";
            height: 160px;
            width: 160px;
            margin: -100px auto auto -100px;
            position: absolute;
            top: 50%;
            left: 50%;
            border-width: 8px;
            border-style: solid;
            border-color: #2180c0 #ccc #ccc;
            border-radius: 100%;
            animation: rotation .7s infinite linear;
        }

        @keyframes rotation {
            from {
                transform: rotate(0deg);
            } to {
                transform: rotate(359deg);
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" type="text/css" media="all">
</head>
<body class="surface-800 flex align-items-center justify-content-center relative h-screen">

    <div id="main-container" class="surface-0 z-2 w-full flex align-items-center justify-content-center flex-column gap-3 w-30rem border-round shadow-3"></div>

    <div id="loading-container" class="transition-all transition-duration-300 fixed top-0 left-0 spinner flex align-items-center justify-content-center surface-0 h-full w-full">
        <div class="spinner loading"></div>
    </div>

    <script>
        let $body = document.body;
        let mainContainer = document.querySelector('#main-container');
        let loaderEl = document.querySelector('#loading-container');
        let cartItems = JSON.parse(`<?php echo json_encode($cartIDStore); ?>`);
        let amount = 0;

        let $date = new Date();
        let monthNames = ["Jan", "Feb", "Mac", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let billdate = `${ monthNames[$date.getMonth()] } ${ $date.getDate() }, ${ $date.getFullYear() }`;

        cartItems.forEach(c => {
            amount = amount + (+c.price);
        });

        let step1 = `
        <div class="h-full w-full flex flex-column">
            <div class="flex w-full p-3 bg-blue-600 border-round-top">
                <h3 class="text-2xl m-0 text-0 font-bold animation-duration-300 fadein border-round-top w-full flex align-items-center">Online Transfer Pay</h3>
                <div class="flex flex-column gap-1">
                    <span class="white-space-nowrap text-4xl text-0">RM ${amount}</span>
                    <span class="white-space-nowrap text-200">${ billdate }</span>
                </div>
            </div>

            <span class="m-2 border-dashed border-1 border-round border-400 animation-duration-300 fadein text-600 px-3 py-2 surface-ground line-height-3">Kindly please transfer the amount to provide bank account and attach evidence</span>

            <img src="./images/<?php echo $bankDisplay['image']; ?>" class="h-6rem" style="object-fit: contain;"/>

            <div class="w-full flex flex-column p-2 gap-1">
                <div class="flex border-1 border-<?php echo $bankDisplay['color']; ?> border-round">

                    <span class="flex-1 p-2 text-0 bg-<?php echo $bankDisplay['color']; ?> font-bold">Account No</span>

                    <span class="flex-1 p-2"><?php echo $getBankinfo['account_number']; ?></span>

                </div>
                
                <div class="flex border-1 border-<?php echo $bankDisplay['color']; ?> border-round">

                    <span class="flex-1 p-2 text-0 bg-<?php echo $bankDisplay['color']; ?> font-bold">Account Holder</span>

                    <span class="flex-1 p-2"><?php echo $getBankinfo['holder_name']; ?></span>

                </div>
            </div>

            <form enctype="multipart/form-data" method="POST" class="w-full flex flex-column px-3 gap-3 py-3" action="checkout_online_save.php">
                <span class="border-dashed border-1 border-round border-400 animation-duration-300 fadein text-600 px-3 py-2 surface-ground line-height-3">Please fillup all the form below</span>

                <div class="flex flex-column w-full surface-0 gap-2">
                    <span class="w-full text-sm text-900">Payer Name</span>
                    <input name="payer_name" required type="text" class="animation-duration-300 fadein w-full border-none p-0 border-bottom-1 border-300 h-3rem px-3 surface-100" placeholder="Enter your name"/>
                </div>

                <div class="flex flex-column w-full surface-0 gap-2">
                    <span class="w-full text-sm text-900">Payment Receipt</span>
                    <input name="payer_receipt" accept="application/pdf" required type="file" class="animation-duration-300 fadein w-full border-none p-0 border-bottom-1 border-300 flex align-items-center px-3 surface-100 py-2" placeholder="Payment Receipt" />
                </div>

                <div class="flex flex-column w-full surface-0 gap-2">
                    <span class="w-full text-sm text-900">Address</span>
                    <textarea name="payer_address" required rows="4" class="animation-duration-300 fadein w-full border-none p-0 border-bottom-1 border-300 flex align-items-center px-3 surface-100 py-2"><?php echo $addressID; ?></textarea>
                    <input type="hidden" name="payer_method" value="<?php echo $_GET['method']; ?>">
                </div>

                <div class="w-full flex flex-column gap-2">
                    <button type="submit" class="cursor-pointer w-full border-round-3xl animation-duration-300 fadein text-0 border-1 h-3rem text-xl bg-blue-600 border-blue-500">Submit</button>
                    
                    <a href="./account_cart">
                        <button type="button" class="cursor-pointer w-full border-round-3xl animation-duration-300 fadein text-0 border-1 h-3rem text-xl surface-600 border-500">Cancel</button>
                    </a>
                </div>
            </form>
        </div>`;

        let step1_bk = `
            <div class="h-full w-full flex flex-column px-4 py-6 gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" class="h-2rem animation-duration-300 fadein">
                    <path fill="#001C64" d="M37.972 13.82c.107-5.565-4.485-9.837-10.799-9.837H14.115a1.278 1.278 0 0 0-1.262 1.079L7.62 37.758a1.038 1.038 0 0 0 1.025 1.2h7.737l-1.21 7.572a1.038 1.038 0 0 0 1.026 1.2H22.5c.305 0 .576-.11.807-.307.231-.198.269-.471.316-.772l1.85-10.885c.047-.3.2-.69.432-.888.231-.198.433-.306.737-.307H30.5c6.183 0 11.43-4.394 12.389-10.507.678-4.34-1.182-8.287-4.916-10.244Z"/>
                    <path fill="#0070E0" d="m18.056 26.9-1.927 12.22-1.21 7.664a1.038 1.038 0 0 0 1.026 1.2h6.67a1.278 1.278 0 0 0 1.261-1.079l1.758-11.14a1.277 1.277 0 0 1 1.261-1.078h3.927c6.183 0 11.429-4.51 12.388-10.623.68-4.339-1.504-8.286-5.238-10.244-.01.462-.05.923-.121 1.38-.959 6.112-6.206 10.623-12.389 10.623h-6.145a1.277 1.277 0 0 0-1.261 1.077Z"/>
                    <path fill="#003087" d="M16.128 39.12h-7.76a1.037 1.037 0 0 1-1.025-1.2l5.232-33.182a1.277 1.277 0 0 1 1.262-1.078h13.337c6.313 0 10.905 4.595 10.798 10.16-1.571-.824-3.417-1.295-5.44-1.295H21.413a1.278 1.278 0 0 0-1.261 1.078L18.057 26.9l-1.93 12.22Z"/>
                </svg>

                <h3 class="m-0 text-900 font-normal text-center animation-duration-300 fadein">Pay with PayPal</h3>

                <span class="text-center animation-duration-300 fadein text-600">With a PayPal account, you're eligible for Purchase Protection and Rewards.</span>

                <input required type="text" class="animation-duration-300 fadein w-full border-1 border-1 border-400 border-round" placeholder="Email or mobile number"/>

                <input required type="password" class="animation-duration-300 fadein w-full border-1 border-1 border-400 border-round" placeholder="Enter your password" />

                <button type="submit" onclick="stepper(2)" class="cursor-pointer w-full border-round-3xl animation-duration-300 fadein text-0 border-1 h-3rem text-xl" style="background: #0070ba;">Log In</button>
            </div>
        `;

        let step2 = `
            <div class="w-full bg-yellow-50 flex justify-content-between p-3">
                <span class="h-2rem w-2rem border-circle bg-orange-300 text-0 flex align-items-center justify-content-center">P</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" class="h-2rem animation-duration-300 fadein">
                    <path fill="#001C64" d="M37.972 13.82c.107-5.565-4.485-9.837-10.799-9.837H14.115a1.278 1.278 0 0 0-1.262 1.079L7.62 37.758a1.038 1.038 0 0 0 1.025 1.2h7.737l-1.21 7.572a1.038 1.038 0 0 0 1.026 1.2H22.5c.305 0 .576-.11.807-.307.231-.198.269-.471.316-.772l1.85-10.885c.047-.3.2-.69.432-.888.231-.198.433-.306.737-.307H30.5c6.183 0 11.43-4.394 12.389-10.507.678-4.34-1.182-8.287-4.916-10.244Z"/>
                    <path fill="#0070E0" d="m18.056 26.9-1.927 12.22-1.21 7.664a1.038 1.038 0 0 0 1.026 1.2h6.67a1.278 1.278 0 0 0 1.261-1.079l1.758-11.14a1.277 1.277 0 0 1 1.261-1.078h3.927c6.183 0 11.429-4.51 12.388-10.623.68-4.339-1.504-8.286-5.238-10.244-.01.462-.05.923-.121 1.38-.959 6.112-6.206 10.623-12.389 10.623h-6.145a1.277 1.277 0 0 0-1.261 1.077Z"/>
                    <path fill="#003087" d="M16.128 39.12h-7.76a1.037 1.037 0 0 1-1.025-1.2l5.232-33.182a1.277 1.277 0 0 1 1.262-1.078h13.337c6.313 0 10.905 4.595 10.798 10.16-1.571-.824-3.417-1.295-5.44-1.295H21.413a1.278 1.278 0 0 0-1.261 1.078L18.057 26.9l-1.93 12.22Z"/>
                </svg>
                <span class="font-bold text-blue-600 flex align-items-center justify-content-center">RM ${ amount }</span>
            </div>

            <div class="flex flex-column border-bottom-1 border-300 p-3 gap-2">
                <span class="text-800">Ship to Lizkrispychip Kerepek</span>
                <span class="text-600">Level 01, No 1, First Avenue Bandar Utama, 47800 Petaling Jaya, Selangor</span>
            </div>

            <div class="flex flex-column p-3 gap-2 w-full">
                <span class="text-800 text-2xl font-light">Pay with</span>

                <div class="flex align-items-center gap-2 surface-ground p-2">
                    <svg aria-labelledby="master-card-art-title" data-testid="master-card-art" height="24" role="img" viewBox="0 0 38 24" width="38" xmlns="http://www.w3.org/2000/svg"><title id="master-card-art-title">Mastercard</title><g fill="none" fill-rule="evenodd"><path d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z" fill="#000" opacity=".07"></path><path d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32" fill="#FFF"></path><circle cx="15" cy="12" fill="#EB001B" r="7"></circle><circle cx="23" cy="12" fill="#F79E1B" r="7"></circle><path d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7 0 2.3 1.2 4.5 3 5.7 1.8-1.2 3-3.3 3-5.7z" fill="#FF5F00"></path></g></svg>
                    <svg aria-labelledby="discover-card-art-title" data-testid="discover-card-art" height="24" role="img" viewBox="0 0 38 24" width="38" xmlns="http://www.w3.org/2000/svg"><title id="discover-card-art-title">Discover</title><g fill="none" fill-rule="evenodd"><path d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z" fill="#000" opacity=".07"></path><path d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32" fill="#FFF"></path><path d="M37 16.95V21c0 1.1-.9 2-2 2H23.228c7.896-1.815 12.043-4.601 13.772-6.05z" fill="#EDA024"></path><path d="M9 11h20v2H9z" fill="#494949"></path><path d="M22 12c0 1.7-1.3 3-3 3s-3-1.4-3-3 1.4-3 3-3c1.7 0 3 1.3 3 3z" fill="#EDA024"></path></g></svg>
                    <svg aria-labelledby="visa-card-art-title" data-testid="visa-card-art" height="24" role="img" viewBox="0 0 38 24" width="38" xmlns="http://www.w3.org/2000/svg"><title id="visa-card-art-title">Visa</title><g fill="none" fill-rule="evenodd"><path d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z" fill="#000" opacity=".07"></path><path d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32" fill="#FFF"></path><path d="M28.3 10.1H28c-.4 1-.7 1.5-1 3h1.9c-.3-1.5-.3-2.2-.6-3zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5L27 8.7c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.2zm-13.4-.3l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-.8-2.4-.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.3 0-.6 0-.9.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-1 4.5 0 .2-.1.2-.3.2l-1.7.1zM5 8.2c0-.1.2-.2.3-.2h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1l2.1-5.1c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5L5 8.2z" fill="#142688" fill-rule="nonzero"></path></g></svg>
                    <svg aria-labelledby="amex-card-art-title" data-testid="amex-card-art" height="24" role="img" viewBox="0 0 38 24" width="38" xmlns="http://www.w3.org/2000/svg"><title id="amex-card-art-title">American Express</title><defs><rect height="36" id="amexCardArt-a" rx="4" width="324"></rect></defs><g fill="none" fill-rule="evenodd"><g transform="translate(-61 -6)"><mask fill="#fff" id="amexCardArt-b"><use xlink:href="#amexCardArt-a"></use></mask><g fill-rule="nonzero" mask="url(#amexCardArt-b)"><path d="M96 6H64c-1.7 0-3 1.3-3 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V9c0-1.7-1.4-3-3-3z" fill="#000" opacity=".07"></path><path d="M96 7c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H64c-1.1 0-2-.9-2-2V9c0-1.1.9-2 2-2h32" fill="#006FCF"></path><path d="M69.971 16.268l.774 1.876h-1.542l.768-1.876zm16.075.078h-2.977v.827h2.929v1.239h-2.923v.922h2.977v.739l2.077-2.245-2.077-2.34-.006.858zm-14.063-2.34h3.995l.887 1.935.822-1.941h10.37l1.078 1.19L90.25 14h4.763l-3.519 3.852 3.483 3.828h-4.834l-1.078-1.19-1.125 1.19H71.03l-.494-1.19h-1.13l-.495 1.19H65L68.286 14h3.43l.267.006zm8.663 1.078h-2.239l-1.5 3.536-1.625-3.536H73.06v4.81L71 15.084h-1.993l-2.382 5.512h1.555l.494-1.19h2.596l.494 1.19h2.72v-3.935l1.751 3.941h1.19l1.74-3.929v3.93h1.458l.024-5.52-.001.001zm9.34 2.768l2.531-2.768h-1.822l-1.601 1.726-1.548-1.726h-5.894v5.518h5.81l1.614-1.738 1.548 1.738h1.875l-2.512-2.75h-.001z" fill="#FFF"></path></g></g></g></svg>
                    <svg aria-labelledby="diners-card-art-title" data-testid="diners-card-art" xmlns="http://www.w3.org/2000/svg" width="38" height="24" viewBox="0 0 38 24"><title id="diners-card-art-title">Diners</title><g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1"><g><path fill="#000" fill-rule="nonzero" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3z" opacity="0.07"></path><path fill="#FFF" fill-rule="nonzero" d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32"></path><g transform="translate(9.625 4.125)"><path fill="#0079BE" d="M10.736 14.222c3.968.018 7.59-3.17 7.59-7.05 0-4.241-3.622-7.173-7.59-7.172H7.321C3.305-.001 0 2.932 0 7.173c0 3.88 3.305 7.067 7.32 7.049h3.416z"></path><path fill="#FFF" d="M7.337.588C3.667.588.694 3.502.693 7.098c.001 3.595 2.975 6.509 6.644 6.51 3.67-.001 6.644-2.915 6.645-6.51 0-3.596-2.975-6.51-6.645-6.51zm-4.211 6.51c.003-1.757 1.124-3.255 2.703-3.85v7.7c-1.58-.595-2.7-2.092-2.703-3.85zm5.718 3.852V3.247c1.58.594 2.703 2.093 2.705 3.851-.002 1.759-1.124 3.257-2.705 3.852z"></path><path fill="#0079BE" d="M10.736 14.222c3.968.018 7.59-3.17 7.59-7.05 0-4.241-3.622-7.173-7.59-7.172H7.321C3.305-.001 0 2.932 0 7.173c0 3.88 3.305 7.067 7.32 7.049h3.416z"></path><path fill="#FFF" d="M7.337.588C3.667.588.694 3.502.693 7.098c.001 3.595 2.975 6.509 6.644 6.51 3.67-.001 6.644-2.915 6.645-6.51 0-3.596-2.975-6.51-6.645-6.51zm-4.211 6.51c.003-1.757 1.124-3.255 2.703-3.85v7.7c-1.58-.595-2.7-2.092-2.703-3.85zm5.718 3.852V3.247c1.58.594 2.703 2.093 2.705 3.851-.002 1.759-1.124 3.257-2.705 3.852z"></path></g></g></g></svg>
                </div>

                <div class="flex flex-column gap-3">
                    <input required type="text" class="animation-duration-300 fadein flex-1 border-1 border-1 border-300 border-round" placeholder="Card Number"/>

                    <div class="w-full flex gap-3">
                        <input required type="date" class="animation-duration-300 fadein flex-1 border-1 border-1 border-300 border-round" placeholder="Expired Date"/>
                        <input required type="text" class="animation-duration-300 fadein flex-1 border-1 border-1 border-300 border-round" placeholder="CVV"/>
                    </div>

                    <div class="w-full flex gap-3">
                        <input required type="text" class="animation-duration-300 fadein flex-1 border-1 border-1 border-300 border-round" placeholder="First Name"/>
                        <input required type="text" class="animation-duration-300 fadein flex-1 border-1 border-1 border-300 border-round" placeholder="Last Name"/>
                    </div>
                </div>
            </div>

            <div class="w-full shadow-2 p-3">
                <button type="submit" onclick="stepper(3)" class="cursor-pointer w-full border-round-3xl animation-duration-300 fadein text-0 border-1 h-3rem text-xl" style="background: #0070ba;">Pay Now</button>
            </div>
        `;
        
        let step3 = `
            <div class="card">
                <span class="card__success flex align-items-center justify-content-center">
                    <i class="ion-checkmark"></i>
                </span>
                <h1 class="card__msg">Payment Complete</h1>
                <h2 class="card__submsg">Thank you for your transfer</h2>
                
                <div class="card__body">
                    <h1 class="card__price">
                        <span>RM</span>${ amount }<span>.00</span>
                    </h1>
                    
                    <p class="card__method">Payment method</p>

                    <div class="card__payment">
                        <img src="https://seeklogo.com/images/V/VISA-logo-F3440F512B-seeklogo.com.png" class="card__credit-card">

                        <div class="card__card-details">
                            <p class="card__card-type">Credit / debit card</p>
                            <p class="card__card-number">Visa ending in **89</p>          
                        </div>
                    </div>
                </div>
                
                <div class="card__tags">
                    <span class="card__tag">completed</span>
                    <span class="card__tag">#${ '6'.toString().padStart(6, "0") }</span>        
                </div>

                <button type="button" onclick="stepper(4)" class="mt-4 cursor-pointer w-full border-round animation-duration-300 fadein text-0 border-1 h-3rem text-base" style="background: #0070ba;">Proceed</button>
            </div>
        `;

        function stepper(action){
            loaderEl.classList.add('opacity-1');
            loaderEl.classList.add('z-5');
            loaderEl.classList.remove('opacity-0');
            loaderEl.classList.remove('z-0');

            setTimeout(function(){
                loaderEl.classList.remove('opacity-1');
                loaderEl.classList.remove('z-5');
                loaderEl.classList.add('opacity-0');
                loaderEl.classList.add('z-0');

                switch(action){
                    case 1:
                        mainContainer.innerHTML = step1;
                    break;
                    case 2:
                        mainContainer.innerHTML = step2;
                    break;
                    case 3:
                        mainContainer.innerHTML = step3;
                    break;
                    case 4:
                        $body.className = '';
                        $body.innerHTML = 'Redirect in 3...';

                        setTimeout(function(){ $body.innerHTML = 'Redirect in 2...'; }, 1500);

                        setTimeout(function(){ $body.innerHTML = 'Redirect in 1...'; }, 3000);

                        setTimeout(function(){
                            //Final
                            window.location.href= `${ window.location.href }&completed`;
                        }, 4500);
                    break;
                }
            },800);
        };

        if(mainContainer && loaderEl){
            stepper(1);
        }
    </script>
</body>
</html>