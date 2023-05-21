<?php
    include 'config.php';

    $collection = [];

    if(!isset($_SESSION['account_session'])){
        header("Location: login-account.php");
        exit();
    }

    $bodylist = fetchRows("SELECT * from body ORDER BY name");
    $syntomlist = fetchRows("SELECT * from syntom ORDER BY name");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'inc/header.php'; ?>

    <style>
        #progress-bar-container li::after{
            margin-top: 47px !important;
        }

        #progress-content-section{
            background: #fff !important;
        }

        .list-container h2{
            position: sticky;
            top: 0;
            background: #fff;
        }

        .list-container{
            max-height: 50vh;
            min-height: 50vh;
            overflow: auto;
            overscroll-behavior: contain;
        }

        #progress-content-section .section-content{
            padding: unset !important;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <?php include 'inc/sidebar.php'; ?>

        <div class="main">
            <?php include 'inc/top-navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">

                    <!--#START HEADER -->
                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Check</strong> health and disease</h3>
                        </div>
                    </div>
                    <!--#END HEADER -->

                    <!--#START Chart -->
                    <div class="row">
						<div class="col-xl-12 col-xxl-12">
							<div class="card flex-fill w-100">

                                <!--#START Header -->
								<div class="card-header"></div>
                                <!--#END Header -->

                                <!--#START Content -->
								<div class="card-body pt-2 pb-3 vh-100">

                                    <div class="progress-wrapper">
                                        <div id="progress-bar-container">
                                            <ul>
                                                <li class="step step01 active">
                                                    <div class="step-inner">Body Part</div>
                                                </li>
                                                <li class="step step02">
                                                    <div class="step-inner">Syntom</div>
                                                </li>
                                                <li class="step step03">
                                                    <div class="step-inner">Result</div>
                                                </li>
                                            </ul>

                                            <div id="line">
                                                <div id="line-progress"></div>
                                            </div>
                                            
                                            <div id="progress-content-section">
                                                <div class="section-content step1 active list-container">
                                                    <h2 class="pb-4 d-flex flex-column gap-3">
                                                        Choose parts of the body affected by diseases
                                                        <input type="search" class="form-control" placeholder="Search" onkeyup="narrowListing(this,'#options-step-1')"/>
                                                    </h2>

                                                    <div id="options-step-1" class="w-100 d-flex flex-column contents">
                                                        <?php
                                                            if(!empty($bodylist)){
                                                                foreach($bodylist as $key => $value){
                                                                    echo '
                                                                    <div data-label="'.$value['name'].'" class="cursor-pointer border border-1 form-check d-flex align-items-center gap-3 p-0 bg-light rounded-3">
                                                                        <input class="cursor-pointer form-check-input p-3 ms-2 mt-0" type="checkbox" value="'.$value['id'].'" id="bodypart_'.$key.'">
                                                                        <label class="cursor-pointer form-check-label py-3 text-lg fw-bold" for="bodypart_'.$key.'">'.$value['name'].'</label>
                                                                    </div>';
                                                                }
                                                            }else{
                                                                echo '<div class="w-100">No options</div>';
                                                            }
                                                        ?>
                                                    </div>

                                                </div>
                                                <div class="section-content step2 list-container">
                                                    <h2 class="pb-4 d-flex flex-column gap-3">
                                                        Choose symptoms that affecting you
                                                        <input type="search" class="form-control" placeholder="Search" onkeyup="narrowListing(this,'#options-step-2')"/>
                                                    </h2>

                                                    <div id="options-step-2" class="w-100 d-flex flex-column contents">
                                                        <?php
                                                            if(!empty($syntomlist)){
                                                                foreach($syntomlist as $key => $value){
                                                                    echo '
                                                                    <div data-label="'.$value['name'].'" class="cursor-pointer border border-1 form-check d-flex align-items-center gap-3 p-0 bg-light rounded-3">
                                                                        <input class="cursor-pointer form-check-input p-3 ms-2 mt-0" type="checkbox" value="'.$value['id'].'" id="syntompart_'.$key.'">
                                                                        <label class="cursor-pointer form-check-label py-3 text-lg fw-bold" for="syntompart_'.$key.'">'.$value['name'].'</label>
                                                                    </div>';
                                                                }
                                                            }else{
                                                                echo '<div class="w-100">No options</div>';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="section-content step3">
                                                    <div class="w-100">
                                                        <button class="btn btn-secondary submit-button"><i class="align-middle" data-feather="refresh-cw"></i> Check symptoms Now</button>
                                                    </div>
                                                    
                                                    <div id="result-response-disease" class="w-100 p-3"></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

								</div>
                                <!--#END Content -->

							</div>
						</div>
					</div>
                    <!--#END Content -->

                </div>
            </main>

            <?php include 'inc/footer.php'; ?>
        </div>
    </div>

    <script ssrc="./js/jquery.min.js"></script>
    <script>
        let stepOne = $('#options-step-1');
        let stepTwo = $('#options-step-2');
        let responseLand = $('#result-response-disease');

        let IsValidJSONString = function (str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        };

        $(".step").click(function () {
            $(this).addClass("active").prevAll().addClass("active");
            $(this).nextAll().removeClass("active");
        });

        $(".step01").click(function () {
            $("#line-progress").css("width", "8%");
            $(".step1").addClass("active").siblings().removeClass("active");
        });

        $(".step02").click(function () {
            $("#line-progress").css("width", "50%");
            $(".step2").addClass("active").siblings().removeClass("active");
        });

        $(".step03").click(function () {
            $("#line-progress").css("width", "100%");
            $(".step3").addClass("active").siblings().removeClass("active");
        });

        $('.submit-button').on('click', function(){
            let collectionBody = [];
            let collectionSyntom = [];

            stepOne.find('input:checked').each((i,e) => {
                collectionBody.push(e.value);
            });

            stepTwo.find('input:checked').each((i,e) => {
                collectionSyntom.push(e.value);
            });

            $.ajax({
                method: 'POST',
                url: './_syntomCheck.php',
                data: {
                    body: collectionBody.join(','),
                    syntom: collectionSyntom.join(',')
                },
                beforeSend: function(){
                    console.log('before submit');
                },
                success: function(jsonstring){
                    const listdata = (IsValidJSONString(jsonstring) ? JSON.parse(jsonstring) : jsonstring);
                    let responseUi = '';

                    if(Array.isArray(listdata)){
                        listdata.forEach((c, i) => {
                            responseUi += `<div class="p-2" style="white-space: pre-line;text-align: initial;">${ (i + 1) }. ${ c }</div>`;
                        })
                    }

                    if(responseUi != ''){
                        responseLand.html(`
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            <div class="alert-message">
                                <h4 class="alert-heading">Result found!</h4>
                                <p class="text-success">Base on your syntom, we conclude that you probably may have these issue.</p>
                                <hr>
                                <div class="w-100 d-flex flex-column text-left align-items-start">${ responseUi }</div>
                            </div>
                        </div>`);
                    }

                    if(responseUi == ''){
                        responseLand.html(`
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <h4 class="alert-heading">No result found!</h4>
                                <p>Sorry we could not justify what kind of disease you have</p>
                            </div>
                        </div>`);
                    }
                }
            });
        });

        function narrowListing(self,target){
            const el = $(target);
            const $key = self.value.toLowerCase();
            const $child = el.children();
            
            if($child.length > 0){
                $child.each(function(i, e){
                    const $li = $(e);
                    const $label = $li.attr('data-label').toLowerCase();

                    $li.removeClass('d-none');

                    if($label.includes($key)){
                        $li.removeClass('d-none');
                    }else{
                        $li.addClass('d-none');
                    }
                });
            }
        }
    </script>
</body>
</html>