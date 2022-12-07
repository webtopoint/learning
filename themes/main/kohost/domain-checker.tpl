<section class="hero-equal-height ptb-120 gradient-overlay bg-image" >
    <div class="background-image-wraper" style="background: url('assets/img/hero-1.jpg')no-repeat center center / cover; opacity: 1;"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-8">
                <div class="hero-content-left text-white text-center">
                    <h1 class="text-white">Search for Find Unique Domains!</h1>
                    <p class="lead">Up to 50% Off domain and hosting, Starting from $2.99/month, free SSL certificate, 24/7/365 support, money back guarantee.</p>

                        
                    <form action="<?=site_url('domain-checker')?>" method="GET" class="domain-transfer-form mt-3 w-75 d-block mx-auto">
                        <div class="input-group">
                            <input type="text" name="domain" id="domain" class="form-control" placeholder="yourdomainname.com" value="<?=$domain?>">
                            <div class="input-group-append">
                                <button class="btn search-btn btn-brand-01 btn-hover d-flex align-items-center" type="submit">
                                    <span class="ti-world mr-2"></span> Search
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="domain-list-wrap text-center mt-4">
                        <?php
                                echo Modules :: run('domain/domain_list_wrap');
                                ?>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</section>


<?php
if(!empty($domain)):
?>

<section class="domain-search-result-section gray-light-bg ptb-100">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-12 col-lg-12">
                        <div class="content-with-sidebar">
                            <!--alert table start-->
                            <?php
                             $domainApi = new resellerClub\Domain;
                             
                             
                             $Premium = response ( $domainApi->checkAvailabilityPremium($keyword,$tld,false ) );
                
                            $domains = response( $domainApi->checkAvailability($keyword,$tld,true) );
                             
                            if(!isset($domains['ERROR'])){
                                $domains = @$domains[$domain];
                      
                               if(isset($Premium[$domain])){
                               ?>
                                <table class="table vps-hosting-pricing-table domain-search-result-table alert-table mb-5">
                                    <tbody>
                                    <tr class="vps-pricing-row">
                                        
                                        <td style="position:relative"  data-value="Available">
                                            <img src="<?=theme_base('images/premium.png')?>" style="
                                                    width: 100px;
                                                    position: absolute;
                                                    top: -50px;
                                                    left: -8px;
                                                ">
                                            
                                            
                                            
                                            <span class="color-primary"><?=$domain?></span> is available!
                                            </td>
                                        <td  data-value="Price">
                                            <p>
                                                <span class="rate"><i class="fa fa-rupee"></i> <?=$Premium[$domain]?><span>/year</span></span>
                                                <span class="pricing-onsale">Renew at - <span class="fa fa-rupee color-3 color-3-bg"> <?=(domain_price($domains['classkey']))['renewdomain'][1]?></span> </span>
                                            </p>
                                        </td>
                                        <td>
                                            <!--a href="javascript:;" class="btn btn-brand-01 btn-sm"><i class="fa fa-shopping-cart"></i> Add to Cart</a-->
                                            <?php
                                            echo Modules :: run('cart/domain_button',$domain);
                                            ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                               <?php
                               }
                               else if($domains['status'] == 'available'){
                               
                                $_price = Modules :: run('domain/price_with_product_key',$domains['classkey']); 
                                ?>
                                <table class="table vps-hosting-pricing-table domain-search-result-table alert-table mb-5">
                                    <tbody>
                                    <tr class="vps-pricing-row">
                                        <td  data-value="Available"><span class="color-primary"><?=$domain?></span> is available!
                                          </td>
                                        <td  data-value="Price">
                                            <p>
                                                <span class="rate"><i class="fa fa-rupee"></i> <?=$_price?><span>/year</span></span>
                                                <span class="pricing-onsale">On sale - <span class="badge color-3 color-3-bg">Save 30%</span></span>
                                            </p>
                                        </td>
                                        <td>
                                            <?php
                                            echo Modules :: run('cart/domain_button',$domain);
                                            /*
                                            if($this->cart_model->is_added_to_cart($domain)){
                                                ?>
                                                <a href="javascript:;" data-href="<?=base_url('cart/remove_domain/'.$domain)?>" class="btn btn-sm add-doamin"><i class="fa fa-trash"></i> Remove</a>
                                                <a href="/cart" class="btn btn-sm btn-brand-01 btn-sm">Go TO Cart</a>
                                                <?php
                                            }else{
                                            ?>
                                                <a href="javascript:;" data-href="<?=base_url('cart/add_domain/'.$domain)?>" class="btn btn-brand-01 btn-sm domain-add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                                            <?php
                                            }
                                            */
                                            ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php
                               }
                               else{
                                    echo '<div class="row">
                                    
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    Domain('.$domain.') is not available.
                                                </div>
                                            </div>
                                         </div>';
                               
                               }
                            
                            }
                            
                            
                            ?>
                            <div class="__domainSuggestions">
                                <div class="spinner">
                                  <div class="bounce1"></div>
                                  <div class="bounce2"></div>
                                  <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<script>
      $("html, body").animate({ scrollTop: 300 }, 1000);
      /*
      $(function(){
          
          $('a.domain-add-to-cart').click(function(){
              $(this).html('<i class="fa fa-spinner fa-spin"></i> Loading..');
              $.ajax({
                  url : $(this).data('href'),
                  success : function(res){
                      toastr.success(res);
                      location.reload();
                  }
              });
          });
      });
      */
      $('.__domainSuggestions').load('<?=site_url("web/domainSuggestions")?>',{keyword : '<?=$keyword?>'},function(res){
          $('.__domainSuggestions').html(res)
      })
</script>

<?php
endif;
?>