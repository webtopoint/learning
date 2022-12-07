	<!--hm-footer start-->
		<section class="hm-footer">
			<div class="container">
				<div class="hm-footer-details">
					<div class="row">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title ">
									<div class="logo">
										<a href="/">
											<img src="<?=web_plugin('logo')?>" alt="logo" />
										</a>
									</div><!-- /.logo-->
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-para">
									<p>
										<?=extra_setting('footer_address')?>
									</p>
								</div><!--/.hm-foot-para-->
								<div class="hm-foot-icon">
									<ul>
									    <?
									    echo print_social_input('footer',[ 'facebook', 'twitter', 'youtube', 'instagram' ]);
									    ?>
										<!--<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><!--/li-->-->
										<!--<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li><!--/li-->-->
										<!--<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><!--/li-->-->
										<!--<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><!--/li-->-->
									</ul><!--/ul-->
								</div><!--/.hm-foot-icon-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
						<div class=" col-md-2 col-sm-6 col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4><?=extra_setting('usefull_links',true,'Useful Links')?></h4>
								</div><!--/.hm-foot-title-->
								<div class="footer-menu ">	  
									<ul class="">
									    <?
									    $menu = $this->SiteModel->extra_setting('footer_menu',true);
                                       $menus = (!empty($menu)) ? json_decode($menu,true) : [];
                                       foreach($menus as $m){
                                           $page = $this->SiteModel->list_page($m)->row();
                                           echo '<li class="jsxp-text">
                                                     <a href="'.page_link($page->id,$page->page_name).'" class="gthy">'.$page->page_name.'</a>
                                                 </li>';
                                       }
									    ?>
									</ul>
								</div><!-- /.footer-menu-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
						<div class=" col-md-3 col-sm-6 col-xs-12">
							<div class="hm-foot-title">
								<h4><?=extra_setting('navigation',true,'Navigation')?></h4>
							</div><!--/.hm-foot-title-->
							<div class="footer-menu ">	  
								<ul class="">
								    <?
								    $menu = $this->SiteModel->extra_setting('navigation_menu',true);
                                   $menus = (!empty($menu)) ? json_decode($menu,true) : [];
                                   foreach($menus as $m){
                                       $page = $this->SiteModel->list_page($m)->row();
                                       echo '<li class="jsxp-text">
                                                 <a href="'.page_link($page->id,$page->page_name).'" class="gthy">'.$page->page_name.'</a>
                                             </li>';
                                   }
								    ?>
								</ul>
							</div><!-- /.footer-menu-->
						</div><!--/.col-->
						<div class=" col-md-3 col-sm-6  col-xs-12">
							<div class="hm-footer-widget">
								<div class="hm-foot-title">
									<h4> Our Newsletter</h4>
								</div><!--/.hm-foot-title-->
								<div class="hm-foot-para">
									<p class="para-news">
										Subscribe to our newsletter to get the latest News and offers..
									</p>
								</div><!--/.hm-foot-para-->
								<div class="hm-foot-email">
									<div class="foot-email-box">
										<input type="text" class="form-control" placeholder="Email Address">
									</div><!--/.foot-email-box-->
									<div class="foot-email-subscribe">
										<button type="button" >go</button>
									</div><!--/.foot-email-icon-->
								</div><!--/.hm-foot-email-->
							</div><!--/.hm-footer-widget-->
						</div><!--/.col-->
					</div><!--/.row-->
				</div><!--/.hm-footer-details-->
			</div><!--/.container-->

		</section><!--/.hm-footer-details-->
		<!--hm-footer end-->
		
		<!-- footer-copyright start -->
		<footer class="footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="foot-copyright pull-left">
							<p>
								&copy; All Rights Reserved. 
							 	<a href="<?=base_url()?>"><?=web_plugin('title_tag')?></a>
							</p>
						</div><!--/.foot-copyright-->
					</div><!--/.col-->
					
				</div><!--/.row-->
				<div id="scroll-Top">
					<i class="fa fa-angle-double-up return-to-top" id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
				</div><!--/.scroll-Top-->
			</div><!-- /.container-->

		</footer><!-- /.footer-copyright-->
		<!-- footer-copyright end -->



		<!-- jaquery link -->

		<script src="<?=theme_assets('assets')?>/js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        
        <!--modernizr.min.js-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		
		<!--bootstrap.min.js-->
        <script type="text/javascript" src="<?=theme_assets('assets')?>/js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="<?=theme_assets('assets')?>/js/bootsnav.js"></script>
		
		<!-- for manu -->
		<script src="<?=theme_assets('assets')?>/js/jquery.hc-sticky.min.js" type="text/javascript"></script>

		
		<!-- vedio player js -->
		<script src="<?=theme_assets('assets')?>/js/jquery.magnific-popup.min.js"></script>


		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

        <!--owl.carousel.js-->
        <script type="text/javascript" src="<?=theme_assets('assets')?>/js/owl.carousel.min.js"></script>
		
		<!-- counter js -->
		<script src="<?=theme_assets('assets')?>/js/jquery.counterup.min.js"></script>
		<script src="<?=theme_assets('assets')?>/js/waypoints.min.js"></script>
		
        <!--Custom JS-->
        <script type="text/javascript" src="<?=theme_assets('assets')?>/js/jak-menusearch.js"></script>
        <script type="text/javascript" src="<?=theme_assets('assets')?>/js/custom.js"></script>
		

    </body>
	
</html>



