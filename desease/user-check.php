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
                                        <div class="step current" data-content="#diseasebody">
                                            <span class="fw-bold">STEP 1:</span> Choose effected body parts
                                        </div>
                                        <div class="step" data-content="#diseasesyntom">
                                            <span class="fw-bold">STEP 2:</span> Select related symtom
                                        </div>
                                        <div class="step" data-content="#diseaseresult">
                                            <span class="fw-bold">STEP 3:</span> View possible causes
                                        </div>
                                    </div>

                                    <div class="w-100 d-flex justify-content-between p-3 bg-light round border mt-3">
                                        <button class="btn btn-secondary prev">Previous</button>
                                        <button class="btn btn-primary next">Next</button>
                                    </div>
								</div>
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
											<h5 class="card-title mb-0">View possible disease</h5>
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

        function showResult(){
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
                    let tabsTitle = '';
                    let tabsContent = '';

                    setTimeout(() => {
                        $button.attr('disabled', false);
                        responseLoader.addClass('d-none');

                        if(typeof(listdata) == 'object'){
                            const { description, title, treatment } = listdata;
                            const loopcount = (description.length);

                            for(let k = 0; k <= loopcount; k++){
                                const valueTitle       = (title[k]);
                                const valueDescription = (description[k]);
                                const valueTreatment   = (treatment[k]);

                                tabsTitle += `
                                <div class="dropdown-item ${ (k == 0 ? 'active' : '') }" onclick="toggleTab(this, 'paneldata_${ k }')">
                                    ${ (valueTitle && valueTitle[0] ? valueTitle[0] : 'No Description') }
                                </div>`;

                                tabsContent += `
                                <div class="tab flex-grow-1 ${ (k != 0 ? 'd-none' : '') }" id="paneldata_${ k }">
                                    <ul class="nav nav-tabs d-flex border" role="tablist">
                                        <li class="nav-item flex-grow-1" role="presentation">
                                            <a class="nav-link active text-center" href="#paneldata_${ k }-tab-1" data-bs-toggle="tab" role="tab" aria-selected="true">Condition</a>
                                        </li>
                                        <li class="nav-item flex-grow-1" role="presentation">
                                            <a class="nav-link w-100 text-center" href="#paneldata_${ k }-tab-2" data-bs-toggle="tab" role="tab" aria-selected="false" tabindex="-1">Treatment</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content border">
                                        <div class="tab-pane active" id="paneldata_${ k }-tab-1" role="tabpanel" style="white-space: pre-line;">${ (valueDescription && valueDescription[0] ? valueDescription[0] : '-') }</div>
                                        <div class="tab-pane" id="paneldata_${ k }-tab-2" role="tabpanel" style="white-space: pre-line;">${ (valueTreatment && valueTreatment[0] ? valueTreatment[0] : '-') }</div>
                                    </div>
                                </div>`;
                            }
                        }

                        if(tabsTitle != ''){
                            responseLand.html(`
                            <div class="d-flex">
                                <div class="d-flex flex-column tab-parent">
                                    <div class="dropdown-menu mb-2" style="position: sticky;top: 0;display: block;">
                                        ${ tabsTitle }
                                    </div>
                                </div>
                                ${ tabsContent }
                            </div>`);
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
        }

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


        function toggleTab(el, id){
            const $elem = $(el);
            const target = $(`#${ id }`);
            const others = target.siblings().not('.tab-parent');

            $elem.siblings().removeClass('active');
            $elem.addClass('active');

            others.addClass('d-none');
            target.removeClass('d-none');
        }

        /* #START Stepper */
        $(document).ready(function() {
            let back = $(".prev");
            let	next = $(".next");
            let	steps = $(".step");
            let submit = $('.submit-button');
            
            next.bind("click", function() { 
                $.each( steps, function( i, e ) {
                    const content = $(e).data('content');

                    if (!$(steps[i]).hasClass('current') && !$(steps[i]).hasClass('done')) {
                        $('.tab-pane').removeClass('show active');

                        $(steps[i]).addClass('current');

                        $(steps[i - 1]).removeClass('current').addClass('done');

                        $(content).addClass('show active');

                        if(content == '#diseaseresult'){
                            showResult();
                        }

                        return false;
                    }
                })		
            });

            back.bind("click", function() { 
                $.each( steps, function( i, e ) {
                    const content = $(e).data('content');

                    $('.tab-pane').removeClass('show active');

                    if ($(steps[i]).hasClass('done') && $(steps[i + 1]).hasClass('current')) {
                        $('.tab-pane').removeClass('show active');

                        $(steps[i + 1]).removeClass('current');

                        $(steps[i]).removeClass('done').addClass('current');

                        $(content).addClass('show active');

                        return false;
                    }
                })		
            });
        });
        /* #END Stepper */
    </script>
</body>
</html>