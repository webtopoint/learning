
    </div>

    <!--footer section start-->
    <footer class="footer-1 ptb-60 gradient-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-4 mb-4 mb-md-4 mb-sm-4 mb-lg-0">
                    <a href="#" class="navbar-brand mb-2">
                        <img src="<?=config_item('admin_logo')?>" style="width: 201px;" alt="logo" class="img-fluid">
                    </a>
                    <br>
                    <p>Dynamically re-engineer high standards in functiona with alternative paradigms. Conveniently monetize resource maximizing initiatives.</p>
                    <ul class="list-inline social-list-default background-color social-hover-2 mt-2">
                          <?php
                            
                            $get = $this->db->order_by('seq','ASC')->get('social_links');
                            if($get->num_rows()){
                            
                                foreach($get->result() as $link){
                                
                                    ?>
                                    <li class="list-inline-item"><a class="<?=$link->name?>" href="<?=$link->value?>"><i class="fab fa-<?=$link->name?>"></i></a></li>
                                    <?php
                                
                                }
                            
                            
                            }
                            
                            ?>
                    </ul>
                </div>
                <div class="col-md-12 col-lg-8">
                    <div class="row mt-0">
                        <div class="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
                            <h6 class="font-weight-normal">Resources</h6>
                            <ul>
                                <?php
                                $button_footer = Modules :: run('addons/get_links','footer_first');
                                if($button_footer->num_rows()){
                                    foreach($button_footer->result() as $link){
                                        $icon = empty($link->icon) ? '' : '<i class="'.$link->icon.' mr-1"></i>'; 
                                        echo '<li> <a href="'.$link->value.'">'.$icon.' '.$link->index.'</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
                            <h6 class="font-weight-normal">Products</h6>
                            <ul>
                                <?php
                                $button_footer = Modules :: run('addons/get_links','footer_second');
                                if($button_footer->num_rows()){
                                    foreach($button_footer->result() as $link){
                                        $icon = empty($link->icon) ? '' : '<i class="'.$link->icon.' mr-1"></i>'; 
                                        echo '<li> <a href="'.$link->value.'">'.$icon.' '.$link->index.'</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
                            <h6 class="font-weight-normal">Company</h6>
                            <ul>
                                <?php
                                $button_footer = Modules :: run('addons/get_links','footer_third');
                                if($button_footer->num_rows()){
                                    foreach($button_footer->result() as $link){
                                        $icon = empty($link->icon) ? '' : '<i class="'.$link->icon.' mr-1"></i>'; 
                                        echo '<li> <a href="'.$link->value.'">'.$icon.' '.$link->index.'</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <h6 class="font-weight-normal">Support</h6>
                            <ul>
                                <?php
                                $button_footer = Modules :: run('addons/get_links','footer_forth');
                                if($button_footer->num_rows()){
                                    foreach($button_footer->result() as $link){
                                        $icon = empty($link->icon) ? '' : '<i class="'.$link->icon.' mr-1"></i>'; 
                                        echo '<li> <a href="'.$link->value.'">'.$icon.' '.$link->index.'</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end of container-->
    </footer>

    <!--footer bottom copyright start-->
    <div class="footer-bottom py-3 gray-light-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7">
                    <div class="copyright-wrap small-text">
                        <p class="mb-0">&copy; ThemeTags Design Agency, All rights reserved</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="terms-policy-wrap text-lg-right text-md-right text-left">
                        <ul class="list-inline">
                            <?php
                            $button_footer = Modules :: run('addons/get_links','bottom_footer');
                            if($button_footer->num_rows()){
                                foreach($button_footer->result() as $link){
                                    $icon = empty($link->icon) ? '' : '<i class="'.$link->icon.' mr-1"></i>'; 
                                    echo '<li class="list-inline-item"> <a href="'.$link->value.'">'.$icon.' '.$link->index.'</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer bottom copyright end-->
    <!--footer section end-->
    <!--scroll bottom to top button start-->
    <div class="scroll-top scroll-to-target primary-bg text-white" data-target="html">
        <span class="fas fa-hand-point-up"></span>
    </div>
    <!--scroll bottom to top button end-->
    <!--build:js-->
    <script src="<?=theme_base()?>assets/js/vendors/popper.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/bootstrap.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/bootstrap-slider.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/jquery.easing.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/owl.carousel.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/countdown.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/jquery.waypoints.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/jquery.rcounterup.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/magnific-popup.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/validator.min.js"></script>
    <script src="<?=theme_base()?>assets/js/vendors/hs.megamenu.js"></script>
    <script src="<?=theme_base()?>assets/js/app.js"></script>
    <script>
        if($('html').scrollTop()!=0){
            $('#logoAndNav').addClass('affix',2000);
        }
        $(document).on('click','.btn-add-to-cart',function(){
            if($(this).hasClass('loading') || $(this).hasClass('taken')){
                return false;
            }
            var that = this;
            // alert(1);
            $(this).find('span').css('display','none');
            $(this).addClass('loading').find('.loading').css('display','inline');
            if($(this).hasClass('checkout')){
                location.href = '<?=base_url('cart')?>';
            }
            var domain = $(this).data('domain');
            // location.href = '<?=base_url('cart/add_domain/')?>'+domain;
            $.post('<?=base_url('cart/add_domain/')?>'+domain,function(res){
                
                    $(that).find('span').css('display','none');
                if(res){
                    
                    $(that).removeClass('to-add').removeClass('loading').addClass('checkout').find('.added').css('display','inline');;
                    if(res == 'added')
                      toastr.success(domain+' Domain added in cart.');
                    else
                        toastr.error(domain + ' is already added in cart.');
                    
                    
                }
                else {
                    
                    $(that).removeClass('loading').addClass('to-add').find('.to-add').css('display','inline');
                }
            })
        });
    </script>
    <!--endbuild-->
</body>


<!-- Mirrored from kohost.themetags.com/index-top-navbar.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Feb 2022 08:32:15 GMT -->
</html>