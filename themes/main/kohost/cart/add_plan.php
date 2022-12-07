<link rel="stylesheet" type="text/css" href="https://whmcs.themetags.com/templates/orderforms/hostlar_standard/css/all.min.css?v=a1db48" />
<link rel="stylesheet" type="text/css" href="https://whmcs.themetags.com/templates/orderforms/hostlar_standard/css/style.css"/>
<script type="text/javascript" src="https://whmcs.themetags.com/templates/orderforms/hostlar_standard/js/scripts.min.js?v=a1db48"></script>

<script type="text/javascript" src="https://whmcs.themetags.com/templates/orderforms/hostlar_standard/js/custom.js"></script>


<?php
$plan = 0;
if(isset($_GET['plan'])){
   $plan = $_GET['plan']; 
}

?>

<form id="fromProductDomain">
                <input type="hidden" id="frmProductDomainPid" value="<?=$plan?>">
                <div class="domain-selection-options">
                    <div class="option option-selected">
                        
                            <label class="">
                                
                                    <input type="radio" name="domainoption" value="register" id="selregister" checked="" >
                                    Register a new domain
                            </label>
                            <div class="domain-input-group clearfix" id="domainregister" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-1 offset-sm-1">
                                        <div class="row domains-row">
                                            <div class="col-xs-9 col-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">www.</span>
                                                    <input type="text" id="registersld" name="register_domain" value="" class="form-control" autocapitalize="none" data-toggle="tooltip" data-placement="top" data-trigger="manual" title="" data-original-title="Please enter your domain">
                                                </div>
                                            </div>
                                            <div class="col-xs-3 col-3">
                                                <select id="registertld" class="form-control" name="register_tld">
                                                        <option value=".com">.com</option>
                                                        <option value=".net">.net</option>
                                                        <option value=".org">.org</option>
                                                        <option value=".biz">.biz</option>
                                                        <option value=".info">.info</option>
                                                        <option value=".store">.store</option>
                                                        <option value=".online">.online</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn primary-solid-btn btn-block" id="register_btn">
                                            Check
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="option" style="display:none">
                            <label class="">
                                <input type="radio" name="domainoption" value="transfer" id="seltransfer">
                                Transfer your domain from another registrar
                            </label>
                            <div class="domain-input-group clearfix" id="domaintransfer" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-1 offset-sm-1">
                                        <div class="row domains-row">
                                            <div class="col-xs-9 col-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">www.</span>
                                                    <input type="text" id="transfersld" value="" class="form-control" autocapitalize="none" data-toggle="tooltip" data-placement="top" data-trigger="manual" title="Please enter your domain">
                                                </div>
                                            </div>
                                            <div class="col-xs-3 col-3">
                                                <select id="transfertld" class="form-control" name="">
                                                        <option value=".com">.com</option>
                                                        <option value=".net">.net</option>
                                                        <option value=".org">.org</option>
                                                        <option value=".biz">.biz</option>
                                                        <option value=".info">.info</option>
                                                        <option value=".store">.store</option>
                                                        <option value=".online">.online</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn primary-solid-btn btn-block">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="option">
                            <label class="">
                                 <input type="radio" name="domainoption" value="owndomain" id="selowndomain" >
                                 I will use my existing domain and update my nameservers
                            </label>
                            <div class="domain-input-group clearfix" id="domainowndomain" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="row domains-row">
                                            <div class="col-xs-2 text-right">
                                                <p class="form-control-static" style="line-height: 3;">www.</p>
                                            </div>
                                            <div class="col-xs-7 col-7">
                                                <input type="text" id="owndomainsld" value="" name="owndomain_domain" placeholder="example" class="form-control" autocapitalize="none" data-toggle="tooltip" data-placement="top" data-trigger="manual" title="" data-original-title="Please enter your domain">
                                            </div>
                                            <div class="col-xs-3 col-3">
                                                <input type="text" id="owndomaintld" value="" name="owndomain_tld" placeholder="com" class="form-control" autocapitalize="none" data-toggle="tooltip" data-placement="top" data-trigger="manual" title="Required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn primary-solid-btn btn-block" id="owndomain_btn">
                                            Use
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="option">
                            <label class="">
                                    <input type="radio" name="domainoption" value="havenotdomain" id="havenotdomain" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">
                                  If there is no domain
                            </label>
                            <div class="domain-input-group clearfix" id="domainhavenotdomain" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <p>
                                            If the domain is not there now, then you can take a similar plan, later You can set up a domain after purchasing the plan.
                                        </p>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" data-plan="<?=  $this->input->get('plan',true) ?>" class="btn primary-solid-btn btn-block add-without-domain">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                    <?php
                        if(searchForindexAndValue($this->cart->contents())){
                    ?>
                    <div class="option">
                        <label class="">
                            <input type="radio" name="domainoption" value="cartdomain" id="cartdomain" >
                          Your cart Domain List 
                        </label>
                        <div class="domain-input-group clearfix" id="domaincartdomain" style="display: none;">
                        <?php    
                        echo '<h3>Your Cart\'s Domain(s)</h3>
                        ';
                        foreach($this->cart->contents() as $rowId => $item){
                               echo ' <label>
                                    <input type="radio" name="cart_domain" value=""> '.$item['name'].'
                                </label> ';
                         }
                        echo '
                        </div>
                    </div>';
                        }
                    
                    ?>
                    
                
            </form>
            
            
            <form method="post" action="/cart.php?a=add&amp;pid=24&amp;domainselect=1" id="frmProductDomainSelections" style="width:100%">


                <div id="DomainSearchResults" class="">

                    <div id="searchDomainInfo">
                        <p id="primaryLookupSearching" class="domain-lookup-loader domain-lookup-primary-loader domain-searching domain-checker-result-headline">
                            <i class="fas fa-spinner fa-spin" style="disaply:none"></i>
                            <span class="domain-lookup-register-loader w-hidden">Checking availability...</span>
                            <span class="domain-lookup-transfer-loader w-hidden">Verifying transfer eligibility...</span>
                            <span class="domain-lookup-other-loader w-hidden">Verifying your domain selection...</span>
                        </p>
                        
                        <div class="domain-primary-result">
                            
                        </div>
                        
                        
                        <!--div id="primaryLookupResult" class="domain-lookup-result domain-lookup-primary-results  unavailable-block">
                            
                            
                            
                            <div class="domain-unavailable domain-checker-unavailable headline"><span class="domainSearch"><i class="far fa-times-circle"></i><br></span> <strong>:domain</strong> is unavailable</div>
                            <div class="domain-available domain-checker-available headline w-hidden"><span class="domainSearch"><i class="far fa-check-circle"></i><br></span> Congratulations! <strong></strong> is available!
                                <div class="domain-price w-hidden">
                                    <span class="register-price-label">Continue to register this domain for</span>
                                    <span class="transfer-price-label w-hidden">Transfer to us and extend by 1 year* for</span>
                                    <span class="price mb-0"></span>
                                </div>
                            </div>
                            <div class="btn btn-primary domain-contact-support headline w-hidden">Contact Us</div>
                            <div class="transfer-eligible w-hidden">
                                <p class="domain-checker-available headline"><span class="domainSearch"><i class="far fa-check-circle"></i><br></span> Your domain is eligible for transfer</p>
                                <p>Please ensure you have unlocked your domain at your current registrar before continuing.</p>
                            </div>
                            <div class="transfer-not-eligible w-hidden">
                                <p class="domain-checker-unavailable headline"><span class="domainSearch"><i class="far fa-times-circle"></i><br></span> Not Eligible for Transfer</p>
                                <p>The domain you entered does not appear to be registered.</p>
                                <p>If the domain was registered recently, you may need to try again later.</p>
                                <p class="mb-0">Alternatively, you can perform a search to register this domain.</p>
                            </div>
                            <div class="domain-invalid w-hidden">
                                <p class="domain-checker-unavailable headline"><span class="domainSearch"><i class="far fa-times-circle"></i><br></span> Invalid domain name provided</p>
                                <p>
                                    Domains must begin with a letter or a number<span class="domain-length-restrictions"> and be between <span class="min-length"></span> and <span class="max-length"></span> characters in length</span><br>
                                    Please check your entry and try again.
                                </p>
                            </div>
                            
                            <p class="domain-error domain-checker-unavailable headline"></p>
                            <input type="hidden" id="resultDomainOption" name="domainoption">
                            <input type="hidden" id="resultDomain" name="domains[]">
                            <input type="hidden" id="resultDomainPricingTerm">
                            
                            
                            
                            
                        </div -->
                    </div>

                                            
                        <div class="suggested-domains w-hidden">
                            <div class="panel-heading card-header">
                                Suggested Domains
                            </div>
                            <div id="suggestionsLoader" class="card-body panel-body domain-lookup-loader domain-lookup-suggestions-loader">
                                <i class="fas fa-spinner fa-spin"></i> Generating suggestions for you
                            </div>
                            <div id="domainSuggestions" class="domain-lookup-result list-group w-hidden">
                                <div class="domain-suggestion list-group-item w-hidden">
                                    <span class="domain"></span><span class="extension"></span>
                                    <div class="actions">
                                        <button type="button" class="btn btn-add-to-cart product-domain" data-whois="1" data-domain="">
                                            <span class="to-add">Add to Cart</span>
                                            <span class="loading">
                                                <i class="fas fa-spinner fa-spin"></i> Loading...
                                            </span>
                                            <span class="added">Added</span>
                                            <span class="unavailable">Taken</span>
                                        </button>
                                        <button type="button" class="btn primary-solid-btn domain-contact-support w-hidden">Contact Support to Purchase</button>
                                        <span class="price"></span>
                                        <span class="promo w-hidden"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer card-footer more-suggestions text-center w-hidden">
                                <a id="moreSuggestions" href="#" onclick="loadMoreSuggestions();return false;">Give me more suggestions!</a>
                                <span id="noMoreSuggestions" class="no-more small w-hidden">That's all the results we have for you! If you still haven't found what you're looking for, please try a different search term or keyword.</span>
                            </div>
                            <div class="text-center text-muted domain-suggestions-warning">
                                <p>Domain name suggestions may not always be available. Availability is checked in real-time at the point of adding to the cart.</p>
                            </div>
                        </div>
                </div>

                <div class="text-center">
                    <button id="btnDomainContinue" type="submit" class="btn primary-solid-btn w-hidden" disabled="disabled">
                        Continue
                        &nbsp;<i class="fas fa-arrow-circle-right"></i>
                    </button>
                </div>
            </form>
            
            <script>
            function isEmpty(val){
                return (val === undefined || val == null || val.length <= 0) ? true : false;
            }
                $('#fromProductDomain').submit(function(e){
                    e.preventDefault();
                    console.log($(this).serialize());
                    var that = this;
                    var domain = '', tld = '';
                    var main = $('input[name=domainoption]:checked').val();
                        domain = $('input[name='+main+'_domain]').val(),
                        tld = $('[name='+main+'_tld]').val();
                        //alert((tld));
                        var btn = $('#'+main+'_btn');
                        btnHtml = btn.html();
                        btn.html('<i class="fa fa-spin fa-spinner"></i>').prop('disabled',true);
                        $('.domain-primary-result').html('');
                    if(isEmpty(domain) || isEmpty(tld)){
                        alert('Please Fill All Fields..');
                    }
                    else{
                        var idBox = $('#DomainSearchResults');
                        $(idBox).find('.fa-spinner').show();
                        var mainLoader = $('.domain-lookup-loader');
                        var box = ( main == 'register') ? main : 'other';
                        //alert(box);
                        var loader = $(mainLoader).find('.domain-lookup-'+box+'-loader');
                        
                        loader.removeClass('w-hidden');
                        
                        $.ajax({
                                type : 'POST',
                                url : '<?=site_url('ajax/check_domain_for_plan')?>',
                                data : {plan : '<?=$this->input->get('plan',true)?>',type : main,domain : domain , tld : tld},
                                dataType : 'json',
                                success : function(res){
                                    /*
                                    if(res.status == 'added'){
                                        toastr.success('Plan Added Successfully..');
                                        location.href = '/cart';
                                    }
                                    else if(res.status == 'already'){
                                        toastr.error('Plan already added..');
                                        location.href = '/cart';
                                    }
                                    else{
                                        toastr.error('Something Went Wrong..');
                                    }
                                    */
                                    $('.domain-primary-result').html(res.message);
                                     console.warn(res);
                                    btn.html(btnHtml).prop('disabled',false);
                                },
                                complete:function(){
                                        $(mainLoader).find('span').addClass('w-hidden');
                                        $(idBox).find('.fa-spinner').hide();
                                },
                                error : function(a,v,c){
                                    console.warn(a.responseText);
                                    
                                }
                        });
                    }
                    // alert(main);
                  //  $(that).html('<i class="fa fa-spin fa-spinner"></i> Wait..').prop('disabled',true);     
                });
                
                $('.add-without-domain').click(function(){
                    var plan = $(this).data('plan'),
                        that = this;
                    $(that).html('<i class="fa fa-spin fa-spinner"></i> Wait..').prop('disabled',true);                
                    $.ajax({
                        type : 'POST',
                        url : '<?=site_url('ajax/add_plan_without_domain')?>',
                        data : {plan : plan},
                        dataType : 'json',
                        success : function(res){
                            if(res.status == 'added'){
                                toastr.success('Plan Added Successfully..');
                                location.href = '/cart';
                            }
                            else if(res.status == 'already'){
                                toastr.error('Plan already added..');
                                location.href = '/cart';
                            }
                            else{
                                toastr.error('Something Went Wrong..');
                            }
                            // console.warn(res);
                            $(that).html('Add').prop('disabled',false);  
                        },
                        error : function(a,v,c){
                            console.warn(a.responseText);
                            
                        }
                    });
                });
               
                    
                
                
                
                
            </script>