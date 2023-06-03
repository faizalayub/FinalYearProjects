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

        #progress-content-section .section-content{
            padding: unset !important;
        }

        .card-body-scroller{
            min-height: 80vh;
            max-height: 80vh;
            overflow: auto;
        }

        /* #START Stepper */
        .arrow-steps .step {
            font-size: 14px;
            text-align: center;
            color: #666;
            cursor: default;
            margin: 0 3px;
            padding: 10px 10px 10px 30px;
            min-width: 180px;
            float: left;
            position: relative;
            background-color: #d9e3f7;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none; 
            transition: background-color 0.2s ease;
        }

        .arrow-steps .step:after,
        .arrow-steps .step:before {
            content: " ";
            position: absolute;
            top: 0;
            right: -17px;
            width: 0;
            height: 0;
            border-top: 19px solid transparent;
            border-bottom: 22px solid transparent;
            border-left: 17px solid #d9e3f7;
            z-index: 2;
            transition: border-color 0.2s ease;
        }

        .arrow-steps .step:before {
            right: auto;
            left: 0;
            border-left: 17px solid #fff;	
            z-index: 0;
        }

        .arrow-steps .step:first-child:before {
            border: none;
        }

        .arrow-steps .step:first-child {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .arrow-steps .step span {
            position: relative;
        }

        .arrow-steps .step.done span:before {
            opacity: 1;
            -webkit-transition: opacity 0.3s ease 0.5s;
            -moz-transition: opacity 0.3s ease 0.5s;
            -ms-transition: opacity 0.3s ease 0.5s;
            transition: opacity 0.3s ease 0.5s;
        }

        .arrow-steps .step.current {
            color: #fff;
            background-color: #23468c;
        }

        .arrow-steps .step.current:after {
            border-left: 17px solid #23468c;	
        }
        /* #END Stepper */
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

                    <!--#START Content -->
                    <div class="row">
						<div class="col-md-12">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title m-0 p-0">Symptom Checker</h5>

                                    <div class="arrow-steps clearfix mt-3">
                                        <div class="step current">
                                            <span class="fw-bold">STEP 1:</span> Choose effected body parts
                                        </div>
                                        <div class="step">
                                            <span class="fw-bold">STEP 2:</span> Select related symtom
                                        </div>
                                        <div class="step">
                                            <span class="fw-bold">STEP 3:</span> View possible causes
                                        </div>
                                    </div>

                                    <div class="nav clearfix">
                                        <a href="#" class="prev">Previous</a>
                                        <a href="#" class="next pull-right">Next</a>
                                    </div>
								</div>

								<!-- <div class="list-group list-group-flush d-flex" role="tablist">
									<a class="list-group-item list-group-item-action d-flex gap-3 active" data-bs-toggle="list" href="#diseasebody" role="tab" aria-selected="true">
                                        <span class="fw-bold">STEP 1:</span> Choose effected body parts
									</a>
									<a class="list-group-item list-group-item-action d-flex gap-3" data-bs-toggle="list" href="#diseasesyntom" role="tab" aria-selected="false" tabindex="-1">
                                        <span class="fw-bold">STEP 2:</span> Select related symtom
									</a>
									<a class="list-group-item list-group-item-action d-flex gap-3" data-bs-toggle="list" href="#diseaseresult" role="tab" aria-selected="false" tabindex="-1">
                                        <span class="fw-bold">STEP 3:</span> View possible causes
									</a>
								</div> -->

							</div>
						</div>

						<div class="col-md-12">
							<div class="tab-content">

								<div class="tab-pane fade show active" id="diseasebody" role="tabpanel">
									<div class="card">
										<div class="card-header d-flex flex-column gap-3">
											<h5 class="card-title mb-0">Choose effected body parts</h5>
                                            <input type="search" class="form-control" placeholder="Search" onkeyup="narrowListing(this,'#options-step-1')">
										</div>
										<div class="card-body card-body-scroller py-0">
                                            <div class="dropdown-menu mb-3" style="position:static;display:block;" id="options-step-1">
                                                <?php
                                                    if(!empty($bodylist)){
                                                        foreach($bodylist as $key => $value){
                                                            echo '
                                                            <div class="dropdown-item py-0 cursor-pointer" data-label="'.$value['name'].'">
                                                                <label class="form-check m-0 py-2">
                                                                    <input class="form-check-input" type="checkbox" value="'.$value['id'].'">
                                                                    <span class="form-check-label">'.$value['name'].'</span>
                                                                </label>
                                                            </div>';
                                                        }
                                                    }else{
                                                        echo '<div class="w-100">No options</div>';
                                                    }
                                                ?>
											</div>
                                        </div>
                                        <div class="card-footer"></div>
									</div>
								</div>

								<div class="tab-pane fade" id="diseasesyntom" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header d-flex flex-column gap-3">
											<h5 class="card-title mb-0">Select related symtom</h5>
                                            <input type="search" class="form-control" placeholder="Search" onkeyup="narrowListing(this,'#options-step-2')">
										</div>
										<div class="card-body card-body-scroller py-0">
                                            <div class="dropdown-menu mb-3" style="position:static;display:block;" id="options-step-2">
                                                <?php
                                                    if(!empty($syntomlist)){
                                                        foreach($syntomlist as $key => $value){
                                                            echo '
                                                            <div class="dropdown-item py-0 cursor-pointer" data-label="'.$value['name'].'">
                                                                <label class="form-check m-0 py-2">
                                                                    <input class="form-check-input" type="checkbox" value="'.$value['id'].'">
                                                                    <span class="form-check-label">'.$value['name'].'</span>
                                                                </label>
                                                            </div>';
                                                        }
                                                    }else{
                                                        echo '<div class="w-100">No options</div>';
                                                    }
                                                ?>
											</div>
                                        </div>
                                        <div class="card-footer"></div>
									</div>
								</div>

                                <div class="tab-pane fade" id="diseaseresult" role="tabpanel">
                                    <div class="card">
										<div class="card-header d-flex flex-column gap-3">
											<h5 class="card-title mb-0">View possible causes</h5>
                                            <button class="btn btn-success submit-button">Find Causes</button>
										</div>
										<div class="card-body p-0 card-body-scroller">
                                            <div id="finder-loader" class="d-none loader w-100 d-flex justify-content-center align-items-center pb-6 pt-5">
                                                <div class="spinner-border text-success" role="status"><span class="visually-hidden">Loading...</span></div>
                                            </div>

                                            <div class="w-100 p-3 accordion" id="result-response-disease"></div>
                                        </div>
                                        <div class="card-footer"></div>
									</div>
								</div>

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
        let responseLoader = $('#finder-loader');

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
            const $button = $(this);
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
                    $button.attr('disabled', true);
                    responseLoader.removeClass('d-none');
                    responseLand.html('');
                },
                success: function(jsonstring){
                    const listdata = (IsValidJSONString(jsonstring) ? JSON.parse(jsonstring) : jsonstring);
                    let responseUi = '';

                    setTimeout(() => {
                        $button.attr('disabled', false);
                        responseLoader.addClass('d-none');

                        if(Array.isArray(listdata)){
                            listdata.forEach((c, i) => {
                                const splitByBreakline = (c.split('\n'));

                                responseUi += `
                                <div class="card">
                                    <div class="card-header p-0 bg-light border" id="heading${ i }">
                                        <h5 class="card-title m-0 p-0 d-flex">
                                            <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse${ i }" aria-expanded="false" aria-controls="collapse${ i }" class="collapsed flex-grow-1 p-3">
                                                ${ (splitByBreakline[0] ?? '-') }
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse${ i }" class="collapse" aria-labelledby="heading${ i }" data-bs-parent="#result-response-disease" style="">
                                        <div class="card-body">
                                            <p class="p-0 m-0" style="white-space: pre-line;text-align: initial;">${ c }</p>
                                        </div>
                                    </div>
                                </div>`;
                            });
                        }

                        if(responseUi != ''){
                            responseLand.html(responseUi);
                        }else{
                            responseLand.html(`
                            <div class="alert alert-warning" role="alert">
                                <div class="alert-message">
                                    <h4 class="alert-heading">No result found!</h4>
                                    <p class="m-0 p-0">Sorry we could not justify what kind of disease you have, please try again with another symtom</p>
                                </div>
                            </div>`);
                        }
                    }, 2000);
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

        /* #START Stepper */
        $(document).ready(function() {
            var back = $(".prev");
            var	next = $(".next");
            var	steps = $(".step");
            
            next.bind("click", function() { 
                $.each( steps, function( i ) {
                    if (!$(steps[i]).hasClass('current') && !$(steps[i]).hasClass('done')) {
                        $(steps[i]).addClass('current');
                        $(steps[i - 1]).removeClass('current').addClass('done');
                        return false;
                    }
                })		
            });

            back.bind("click", function() { 
                $.each( steps, function( i ) {
                    if ($(steps[i]).hasClass('done') && $(steps[i + 1]).hasClass('current')) {
                        $(steps[i + 1]).removeClass('current');
                        $(steps[i]).removeClass('done').addClass('current');
                        return false;
                    }
                })		
            });
        });
        /* #END Stepper */
    </script>
</body>
</html>