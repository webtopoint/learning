    <!--Main Footer-->
    <footer class="main-footer" style="background-image:url(images/background/footer-bg.jpg);">
    	
        <!--Footer Upper-->        
        <div class="footer-upper">
            <div class="auto-container">
                <div class="row clearfix">

                    <div class="col-lg-3 col-sm-6 col-xs-12 column tp-mb-zx50">
                        <div class="footer-widget about-widget">
                            <div class="logo"><a href="{_base_url_}"><img src="{_logo_}"  {_logo_style_} class="img-responsive" alt=""></a></div>
                            <div class="text">
                                <p>{_footer_description_}</p>
                            </div>
                            
                            <ul class="contact-info">
                            	<li><span class="icon fa fa-map-marker"></span>{_footer_location_}</li>
                                <li><span class="icon fa fa-phone"></span> {_footer_mobile_}</li>
                                <li><span class="icon fa fa-envelope-o"></span> {_footer_email_}</li>
                            </ul>
                            
                            <div class="social-links-two clearfix">
                            <?php
                            if($social_links = web_plugin('social_links')){
                                foreach($social_links as $index => $link){
                                    if($index == 'position')
                                        continue;
                                    echo '<a href="'.$link.'" class="'.$index.' img-circle"><span class="fa fa-'.$index.'"></span></a>    ';
                                }
                            }
                            
                            ?>
                            	<!--a href="#" class="facebook img-circle"><span class="fa fa-facebook-f"></span></a>
                                <a href="#" class="twitter img-circle"><span class="fa fa-twitter"></span></a>
                                <a href="#" class="google-plus img-circle"><span class="fa fa-google-plus"></span></a>
                                <a href="#" class="linkedin img-circle"><span class="fa fa-pinterest-p"></span></a>
                                <a href="#" class="linkedin img-circle"><span class="fa fa-linkedin"></span></a-->
                            </div>
                            
                        </div>
                    </div>
                    
                    <!--Footer Column-->
                    <div class="col-lg-2 col-sm-6 col-xs-12 column">
                        <h2>Quick Links</h2>
                        <div class="footer-widget links-widget">
                            <ul>
                                <?php
                                foreach($this->ES->get('quick_links','get_row') as $quick_links){
                                    echo '<li><a  href="'.$quick_links->value.'">'.$quick_links->title.'</a></li>';
                                }
                                ?>
                                <!-- <li><a href="#">About Us</a></li>
                                <li><a href="#">Causes</a></li>
                                <li><a href="#">Events</a></li>
                                <li><a href="#">Mission</a></li>
                                <li><a href="#">Faq & News</a></li>
                                <li><a href="#">Archives</a></li>
                                <li><a href="#">Contact</a></li> -->
                            </ul>

                        </div>
                    </div>

            		<!--Footer Column-->
                	<div class="col-lg-3 col-sm-6 col-xs-12 column">
                    	<div class="footer-widget links-widget">
                        	<h2>Usefull Links</h2>	
                            <ul>
                                <?php
                                foreach($this->ES->get('usefull_links','get_row') as $usefull_links){
                                    echo '<li><a  href="'.$usefull_links->value.'">'.$usefull_links->title.'</a></li>';
                                }
                                ?>
                            </ul>
                            
                            
                        </div>
                    </div>
                    
                    <!--Footer Column-->
                    <div class="col-lg-4 col-sm-6 col-xs-12 column">
                        <div class="footer-widget contact-widget">
                        	<h2>Contact Form</h2>
                            <form action="https://html.commonsupport.xyz/html/charity-club/inc/sendemail.php" class="contact-form" id="footer-cf">
                                <input type="text" name="name"  placeholder="Full Name">
                                <input type="text" name="email" placeholder="Email Address" >
                                <textarea name="message" placeholder="Your Message"></textarea>
                                <button type="submit">Send</button>
                            </form>

                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
        
        <!--Footer Bottom-->
    	<div class="footer-bottom">
            <div class="auto-container clearfix">
                <!--Copyright-->
                <div class="copyright text-center">Copyright {_YEAR_} &copy; <a href="#">{_title_}</a>  with love</div>
            </div>
        </div>
        
    </footer>


</div>
<!--End pagewrapper-->


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".page-wrapper"><span class="fa fa-long-arrow-up"></span></div>


<!--Donate Popup-->
<div class="modal fade pop-box" id="donate-popup" tabindex="-1" role="dialog" aria-labelledby="donate-popup" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<!--Donation Section-->
            <section class="donation-section">
                <div class="donation-form-outer">
                    <form method="post" action="#">
                        
                        <!--Form Portlet-->
                        <div class="form-portlet">
                            <h3>How Much Would you like to Donate?</h3>
                            
                            <div class="row clearfix">
                                <div class="form-group col-lg-7 col-md-12 col-xs-12 clearfix">
                                    
                                    <div class="radio-select">
                                        <input type="radio" name="sel-amount" id="amount-1">
                                        <label for="amount-1">$10</label>
                                    </div>
                                    
                                    <div class="radio-select">
                                        <input type="radio" name="sel-amount" id="amount-2" checked>
                                        <label for="amount-2">$25</label>
                                    </div>
                                    
                                    <div class="radio-select">
                                        <input type="radio" name="sel-amount" id="amount-3">
                                        <label for="amount-3">$50</label>
                                    </div>
                                    
                                    <div class="radio-select">
                                        <input type="radio" name="sel-amount" id="amount-4">
                                        <label for="amount-4">$100</label>
                                    </div>
                                    
                                    <div class="radio-select">
                                        <input type="radio" name="sel-amount" id="amount-5">
                                        <label for="amount-5">$150</label>
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group other-amount col-lg-5 col-md-8 col-xs-12 padd-top-10">
                                    
                                    <input type="text" name="other-amount" value="" placeholder="Or Other Amount">
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                        <br>
                        
                        <!--Form Portlet-->
                        <div class="form-portlet">
                            <h4>Billing Information</h4>
                            
                            <div class="row clearfix">
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">First Name <span class="required">*</span></div>
                                    <input type="text" name="name" value="" placeholder="First Name" required>
                                </div>
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">Last Name <span class="required">*</span></div>
                                    <input type="text" name="name" value="" placeholder="Last Name" required>
                                </div>
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">Email <span class="required">*</span></div>
                                    <input type="email" name="name" value="" placeholder="Email" required>
                                </div>
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">Phone <span class="required">*</span></div>
                                    <input type="text" name="name" value="" placeholder="Phone" required>
                                </div>
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">Address 1 <span class="required">*</span></div>
                                    <input type="text" name="name" value="" placeholder="Address 1" required>
                                </div>
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">Address 2 <span class="required">*</span></div>
                                    <input type="text" name="name" value="" placeholder="Address 2" required>
                                </div>
                                
                            </div>
                        </div>
                        
                        <br>
                        
                        <!--Form Portlet-->
                        <div class="form-portlet">
                            <h4>Payment Information</h4>
                            
                            <div class="payment-option-logo"><img class="img-responsive" src="images/resource/payment-logos.png" alt=""></div>
                            <br>
                            
                            <div class="row clearfix">
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">Card Number <span class="required">*</span></div>
                                    <input type="text" name="name" value="" placeholder="Card Number" required>
                                </div>
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">Card Holder Name <span class="required">*</span></div>
                                    <input type="text" name="name" value="" placeholder="Card Holder Name" required>
                                </div>
                                
                                
                                
                                <div class="form-group col-lg-3 col-md-3 col-xs-12">
                                    <div class="field-label">Expire Date <span class="required">*</span></div>
                                    <select>
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                        <option>07</option>
                                        <option>08</option>
                                        <option>09</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-lg-3 col-md-3 col-xs-12">
                                    <div class="field-label">&nbsp;</div>
                                    <select>
                                        <option>2016</option>
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <div class="field-label">Security Code (CVC) <span class="required">*</span></div>
                                    <input type="text" name="name" value="" placeholder="Security Code" required>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="text-left"><button type="submit" class="theme-btn btn-style-two">Donate Now</button></div>
                        
                    </form>
                </div>
            </section>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>




