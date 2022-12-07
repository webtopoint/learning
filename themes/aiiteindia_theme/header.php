<style>
    .main-header .main-box:before, .main-header .header-lower, .sticky-header {
            background-color: {_menubar_color_code_}!important;
        }
    .main-menu .navigation>li>ul{
        border-bottom:3px solid {_menubar_color_code_}!important;
    }
    .social_links > a {
        line-height: 25px!important;
    }
</style>
</head>



{_body_}

<div class="page-wrapper">
<!-- Preloader -->
<div class="preloader"></div>
 <!-- Main Header-->
<header class="main-header header-style-one">
 <!-- Header top -->
 <div class="header-top">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="top-left col-md-5">
					<ul class="contact-list-one">
						<li><i class="flaticon-call-1"></i><a href="tel:{_contact_}">{_contact_}</a> <strong>call to us</strong></li>
                           <li><i class="flaticon-email-1"></i> <a href="mailto:{_email_}">{_email_}</a> <strong>Mail to us</strong></li>
                        </ul>
                        
                    </div>

                    <div class="top-right col-md-7">
					<div>
					    <?php
					    $getMenus = $this->SiteModel->extra_setting('topbar_menus','all');
					    if($getMenus){
					        foreach($getMenus->result() as $rowMenu){
					            echo "<a href='$rowMenu->value' class='btn btn-sm custm'>$rowMenu->title</a>";
					        }
					    }
					    ?>
                        
                    </div>
                        
                        
                        <?php
                        if($social_links = web_plugin('social_links')){
                            echo '<ul class="social-icon-one">';
                            if($social_links->facebook)
                        		echo'<li><a target="_blank" class="facebook" href="'.$social_links->facebook.'"><i class="fa fa-facebook-f"></i></a></li>';
                        	
                        	if($social_links->twitter)
                        		echo'<li><a target="_blank" class="twitter" href="'.$social_links->twitter.'"><i class="fa fa-twitter"></i></a></li>';
                        	
                        	if($social_links->instagram)
                        		echo'<li><a target="_blank" class="instagram" href="'.$social_links->instagram.'"><i class="fa fa-instagram"></i></a></li>';
                        	
                        	if($social_links->linkedin)
                        		echo'<li><a target="_blank" class="linkedin" href="'.$social_links->linkedin.'"><i class="fa fa-linkedin"></i></a></li>';
                        	
                        	if($social_links->pinterest)
                        		echo'<li><a target="_blank" class="pintrest" href="'.$social_links->pinterest.'"><i class="fa fa-pinterest"></i></a></li>';
                        	
                        	if($social_links->youtube)
                        		echo'<li><a target="_blank" class="youtube" href="'.$social_links->youtube.'"><i class="fa fa-youtube"></i></a> </li>';
                            echo '</ul>';
                        }
                        
                        ?>
						
						</div>

                </div>

            </div>

        </div>
<div class="container-fluid" style="position: relative;background: #fff;">
   <div class=" ">
   <div class="container mob">
    <div class="row">
   <div class="col-md-10 col-9 d-flex "><a href=""><img src="{_logo_}" {_logo_style_} class="img-fluid  "></a></div>
    <!--<div class="col-md-2 col-3 d-flex align-items-center"><img src="images/qci-logo.jpg" class="img-fluid  "></div>-->
   </div>
   </div>
   </div>
   
   </div>
<!-- End Header Top -->
 <!-- Header Lower -->
        <div class="header-lower" >

            <div class="auto-container">    

                <!-- Main box -->

                <div class="main-box">

                     



                    <div class="nav-outer">



                        <!-- Main Menu -->

                        <nav class="main-menu navbar-expand-md">

                            <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                    <?php
                  $pageCount = 0;

                  function get_menu($items,$class = 'navigation clearfix') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {
                          $_page_url = DefaultPage==$value['page_id']?'/': $value['url'];
                          $activeCss = getActiveMenu($value['page_id'],'current');

                          if($value['type'] == 'category'){
                            $_page_url = base_url.'/category/'.get_instance()->NewsModel->getCategorylink($value['page_id']);
                            $activeCss = getActiveMenu($value['page_id'],'active-menu',true);
                          }
                          
                        $iconWithTExt =  $value['label'];
                          
                        if(array_key_exists('child',$value))

                          $html.= '<li class="dropdown '.$activeCss.'"><a href="#" '.$value['target'].' class="menu-css">'.$iconWithTExt.'</a>'; 

                        else

                          $html.= '<li class=" '.$activeCss.'"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css">'.$iconWithTExt.'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'');

                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }
                  
                  print get_menu($menu_items,'navigation clearfix menu-'.$group_id);
                /*
                  ?>
                                <ul class="navigation clearfix">

                                    <li class="current  "><a href="index.html">HOME</a></li>

                                  
									 <li class="dropdown"><a href="#">ABOUT US</a>
                                        <ul>
                                           <li><a href="about-aiite.html">About AIITE</a></li>
              <li><a href="founder-and-chairman.html">Founder &amp; Chairman</a></li>
              <li><a href="vision.html">Vision</a></li>
              <li><a href="mission.html">Mission</a></li>
              <li><a href="board-of-directors.html">Board of Directors</a></li>
			  <li><a href="Board-of-Advisory.html">Board of Advisory</a></li>
              <li><a href="accreditation.html">Accreditation & Recognition</a></li>
              <li><a href="quality-policy.html">Quality Policy</a></li>
              <li><a href="the-mark-of-excellence.html">The Mark of Excellence</a></li>
              <li><a href="acheivement-awards.html">Achievements & Awards</a></li>
                                        </ul>
                                    </li>

                                    

                                    <li class="dropdown"><a href="#">ACADEMICS</a>
                                        <ul>
                                                           <li><a href="academic-course6bb3.html?Aid=14">AIITE TEACHERS TRAINING ACADEMY </a></li>
			              <li><a href="academic-course1afb.html?Aid=20">AIITE COMPUTER EDUCATION ACADEMY </a></li>
			              <li><a href="academic-course6175.html?Aid=21">AIITE VOCATIONAL EDUCATION ACADEMY </a></li>
			              <li><a href="academic-coursef444.html?Aid=22">AIITE HARDWARE  NETWORKING ACADEMY </a></li>
			              <li><a href="academic-coursee558.html?Aid=23">AIITE AGRICULTURE EDUCATION ACADEMY </a></li>
			              <li><a href="academic-course206c.html?Aid=24">AIITE FASHION DESIGN AND TEXTILE  ACADEMY</a></li>
			              <li><a href="academic-course7b7d.html?Aid=25">AIITE NATUROPATHY AND YOGA SCIENCES  </a></li>
			              <li><a href="academic-course97e9.html?Aid=26">AIITE HEALTH AND PARAMEDICAL SCIENCES</a></li>
			              <li><a href="academic-coursef624.html?Aid=27">AIITE BIOMEDICAL TECHNOLOGY ACADEMY </a></li>
			              <li><a href="academic-course2701.html?Aid=28">AIITE MANAGEMENT EDUCATION ACADEMY </a></li>
			              <li><a href="academic-course251f.html?Aid=29">AIITE ENGINEERING AND TECHNOLOGY ACADEMY </a></li>
			              <li><a href="academic-course71dd.html?Aid=30">AIITE MASS-COMMUNICATION AND JOURNALISM ACADEMY</a></li>
			              <li><a href="academic-course43b7.html?Aid=31">AIITE HYGIENE AND PUBLIC HEALTH ACADEMY</a></li>
			              <li><a href="academic-course5c23.html?Aid=32">AIITE SOCIAL SCIENCES ACADEMY </a></li>
			              <li><a href="academic-course6588.html?Aid=34">AIITE FOOTWEAR TECHNOLOGY ACADEMY </a></li>
			              <li><a href="academic-coursee5f4.html?Aid=35">AIITE SPORTS AND PHYSICAL EDUCATION ACADEMY</a></li>
			              <li><a href="academic-course96ac.html?Aid=36">AIITE HANDWRITING TRAINING ACADEMY </a></li>
			              <li><a href="academic-course3efb.html?Aid=37">AIITE AVIATION TRAINING ACADEMY</a></li>
			              <li><a href="academic-coursec449.html?Aid=38">AIITE FIRE AND SAFETY TRAINING ACADEMY </a></li>
			              <li><a href="academic-course2b4c.html?Aid=39">AIITE HOTEL AND HOSPITALITY MANAGEMENT ACADEMY</a></li>
			              <li><a href="academic-course8808.html?Aid=40">AIITE BEAUTY AND WELLNESS ACADEMY</a></li>
			              <li><a href="academic-coursee3f5.html?Aid=41">AIITE PERFORMING ARTS ACADEMY </a></li>
			              <li><a href="academic-course8c55.html?Aid=42">AIITE MULTIMEDIA AND ANIMATION ACADEMY</a></li>
			              <li><a href="academic-course483b.html?Aid=43">AIITE ASTROLOGY AND VASTU ACADEMY</a></li>
			              <li><a href="academic-course40af.html?Aid=44">AIITE SECURITY SERVICES TRAINING ACADEMY</a></li>
			                                        </ul>
                                    </li>

                                    <li class="dropdown"><a href="#">ADMISSION</a>

                                        <ul>

                                           <li> <a href="admission.html">Admission</a></li>
                <li> <a href="student-register.html">Online Admission</a></li>
                <li> <a href="student-login.html">Login</a></li>

                                        </ul>

                                    </li>
									<li class="dropdown"><a href="#">BRANCHES</a>

                                        <ul>

                                         <li> <a href="franchise.html">Indian Branch</a></li>
                <li> <a href="Overseas-franchise.html">Overseas Branch</a></li>
                <li> <a href="login.html">Online Apply</a></li>

                                        </ul>

                                    </li>

                                   <li class="dropdown"><a href="#">MEDIA</a>
									<ul>
									<li><a href="gallery.html">Gallery</a></li>
								    <li><a href="events.html">NEWS & EVENTS</a></li>
									</ul>

                                    </li>
									 <li class="dropdown"><a href="#">RESULTS</a>
									<ul>
									 <li><a href="online-exam-result.html">Online Exam Result</a></li>
									</ul>
									</li>
									<li class="dropdown"><a href="#">DOWNLOAD</a>
									<ul>
									  <li><a href="AdmitCard.html">Admit Card</a></li>
              <li> <a href="download.html">Download</a></li>
									</ul>
									</li>
									   <li class="dropdown"><a href="#">CAREER</a>
									<ul>
									 <li> <a href="current-openings.html">Current Openings</a></li>
                <li> <a href="apply-online-career.html">Apply Online Career</a></li>
									</ul>
									</li>
										  
										    <li><a href="contact-us.html">CONTACT US</a></li>
											 

                                </ul>
                <?php
                */
                ?>

                            </div>

                        </nav>
<!-- Main Menu End-->
 </div>
</div>
</div>
</div>



        <!-- Sticky Header  -->

        <div class="sticky-header">

            <div class="auto-container">            
			<div class="main-box">

                    <div class="logo-box">
		<div class="upper-right">
		<a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><i class="flaticon-menu"></i></a>

                        </div>

                    </div>

                    

                    <nav class="main-menu navbar-expand-md">

                        <!--Keep This Empty / Menu will come through Javascript-->

                    </nav>

                </div>

            </div>

        </div><!-- End Sticky Menu -->



        <!-- Mobile Header -->

        <div class="mobile-header">

          



            <!--Nav Box-->

            <div class="nav-outer clearfix">

                <div class="outer-box">

                    <!-- Search Btn -->

                    <div class="search-box">

                        <button class="search-btn mobile-search-btn"><i class="flaticon-search-2"></i></button>

                    </div>



                    <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><i class="flaticon-menu"></i></a>

                </div>

            </div>

        </div>



        <!-- Mobile Menu  -->

        <div class="mobile-menu">

            <div class="menu-backdrop"></div>

            

            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->

            <nav class="menu-box">

                <div class="upper-box">

                   

                    <div class="close-btn"><i class="icon flaticon-close"></i></div>

                </div>



                <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>



                <ul class="contact-list-one">

                    <li><i class="flaticon-location"></i> {_footer_address_} <strong>Address</strong></li>

                    <li><i class="flaticon-call-1"></i><a href="tel:{_footer_mobile_}">{_footer_mobile_}</a> <strong>call to us</strong></li>

                    <li><i class="flaticon-email-1"></i> <a href="mailto:{_footer_email_}">{_footer_email_}</a> <strong>Mail to us</strong></li>

                </ul>



<?php
                        if($social_links){
                            echo '<ul class="social-links">';
                            if($social_links->facebook)
                        		echo'<li><a target="_blank" class="facebook" href="'.$social_links->facebook.'"><i class="fa fa-facebook-f"></i></a></li>';
                        	
                        	if($social_links->twitter)
                        		echo'<li><a target="_blank" class="twitter" href="'.$social_links->twitter.'"><i class="fa fa-twitter"></i></a></li>';
                        	
                        	if($social_links->instagram)
                        		echo'<li><a target="_blank" class="instagram" href="'.$social_links->instagram.'"><i class="fa fa-instagram"></i></a></li>';
                        	
                        	if($social_links->linkedin)
                        		echo'<li><a target="_blank" class="linkedin" href="'.$social_links->linkedin.'"><i class="fa fa-linkedin"></i></a></li>';
                        	
                        	if($social_links->pinterest)
                        		echo'<li><a target="_blank" class="pintrest" href="'.$social_links->pinterest.'"><i class="fa fa-pinterest"></i></a></li>';
                        	
                        	if($social_links->youtube)
                        		echo'<li><a target="_blank" class="youtube" href="'.$social_links->youtube.'"><i class="fa fa-youtube"></i></a> </li>';
                            echo '</ul>';
                        }
                        
                        ?>

            </nav>

        </div><!-- End Mobile Menu -->



        <!-- Header Search -->

        <div class="search-popup">

            <button class="close-search"><i class="flaticon-close"></i></button>

            <form method="post" action="">

                <div class="form-group">

                    <input type="search" name="search-field" value="" placeholder="Search" required="">

                    <button type="submit"><i class="fa fa-search"></i></button>

                </div>

            </form>

        </div>

        <!-- End Header Search -->



    </header>

    <!--End Main Header --><!-- Hidden bar back drop -->
<div class="form-back-drop"></div>