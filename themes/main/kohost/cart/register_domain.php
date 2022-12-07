<?php
$domain = $tld = $domain_name = '';
if(isset($_GET['query'])){
    $domain = fetch_domain_tld($_GET['query']);
    $tld = $domain['tld'];
    $domain = $domain['domain'];
    $domain_name = $_GET['query'];
}

?>
<p>Find your new domain name. Enter your name or keywords below to check availability.</p>
<div class="domain-checker-container">
              
    <div class="domain-checker-bg clearfix">
        <form method="post" action="<?=base_url('ajax/check_domain_for_plan')?>" >

            <input type="hidden" name="a" value="checkDomain">
            <div class="row">
                <div class="col-md-10 col-sm-11 col-xs-11">
                    <div class="input-group input-group-lg input-group-box">
                        <input type="text" name="domain" class="form-control" value="<?=$domain_name?>" placeholder="Find your new domain name" value="sitejeannie.com" id="inputDomain" data-toggle="tooltip" data-placement="left" data-trigger="manual" title="" data-original-title="Enter a domain or keyword">
                        <span class="input-group-btn input-group-append">
                            <button type="submit" id="btnCheckAvailability" class="btn search-btn domain-check-availability">Search</button>
                        </span>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<script>
    $('.domain-checker-bg > form').submit(function(r){
        r.preventDefault();
        
        $('.domain-searching').show();
        $.ajax({
            type : 'POST',
            url : $(this).attr('action'),
            data : $(this).serialize()+'&type=register',
            dataType : 'json',
            success : function(res){
                console.log(res);
                $('.result-domain').html(res.message);
                
                $('.domain-searching').hide();
            },
            error:function(r,v,c){
                console.log(r.responseText);
            }
        });
        
    })
</script>
<div id="DomainSearchResults" class="w-hidden" style="display: block;width:100%">

    <div id="searchDomainInfo" class="domain-checker-result-headline">
        <p id="primaryLookupSearching" class="domain-lookup-loader domain-lookup-primary-loader domain-searching" style="display: none;">
            <i class="fas fa-spinner fa-spin"></i> Searching...</p>
            <div class="result-domain"></div>
    </div>

    
    <div class="suggested-domains hidden" style="display: none;">
        <div class="panel-heading">
            Suggested Domains
        </div>
        <div id="suggestionsLoader" class="panel-body domain-lookup-loader domain-lookup-suggestions-loader">
            <i class="fas fa-spinner fa-spin"></i> Generating suggestions for you
        </div>
        <div id="domainSuggestions" class="domain-lookup-result list-group w-hidden" style="display: none;">
            <div class="domain-suggestion list-group-item w-hidden" style="display: none;">
                <span class="domain"></span><span class="extension"></span>
                <span class="promo w-hidden">
                    <span class="sales-group-hot w-hidden">Hot</span>
                    <span class="sales-group-new w-hidden">New</span>
                    <span class="sales-group-sale w-hidden">Sale</span>
                </span>
                <div class="actions">
                    <span class="price"></span>
                    <button type="button" class="btn btn-add-to-cart" data-whois="1" data-domain="">
                        <span class="to-add" style="display: inline;">Add to Cart</span>
                        <span class="loading" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Loading...
                        </span>
                        <span class="added" style="display: none;"><i class="far fa-shopping-cart"></i> Checkout</span>
                        <span class="unavailable" style="display: none;">Taken</span>
                    </button>
                    <button type="button" class="btn btn-primary domain-contact-support w-hidden">
                        Contact Support to Purchase
                    </button>
                </div>
            </div>
        </div>
        <div class="panel-footer card-footer more-suggestions text-center w-hidden" style="display: none;">
            <a id="moreSuggestions" href="#" onclick="loadMoreSuggestions();return false;">Give me more suggestions!</a>
            <span id="noMoreSuggestions" class="no-more small hidden" style="display: none;">That's all the results we have for you! If you still haven't found what you're looking for, please try a different search term or keyword.</span>
        </div>
        <div class="text-center text-muted domain-suggestions-warning">
            <p>Domain name suggestions may not always be available. Availability is checked in real-time at the point of adding to the cart.</p>
        </div>
    </div>

</div>