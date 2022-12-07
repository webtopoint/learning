<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
    
    <!-- Main Header -->
    <header class="header-style-two">
        <!-- Header Top -->
        <div class="header-top">
            <div class="auto-container clearfix">
                <!-- Logo -->
                <div class="logo">
                    <a href="{_base_url_}" ><img src="{_logo_}" {_logo_style_}  alt="{_title_}"></a>
                 </div>
                 
                 <!--Info Outer-->
                 <div class="info-outer">
                    <!--Info Box-->
                    <div class="info-box">
                        <div class="icon"><span class="flaticon-computer"></span></div>
                        <strong>EMAIL</strong>
                        <a href="mailt:{_email_}">{_email_}</a>
                    </div>
                    <!--Info Box-->
                    <div class="info-box">
                        <div class="icon"><span class="flaticon-technology-5"></span></div>
                        <strong>Call Now</strong>
                        <a class="phone" href="tel:{_contact_}">{_contact_}</a>
                    </div>
                    <!--Info Box-->
                    <div class="info-box social-box">
                        <div class="social-links clearfix">
                        <?php
                        if($social_links = web_plugin('social_links')){
                            foreach($social_links as $index => $link){
                                echo '<a href="'.$link.'" class="'.$index.' img-circle"><span class="fa fa-'.$index.'"></span></a>    ';
                            }
                        }
                        
                        ?>
                            <!-- <a href="#" class="facebook img-circle"><span class="fa fa-facebook-f"></span></a>
                            <a href="#" class="twitter img-circle"><span class="fa fa-twitter"></span></a>
                            <a href="#" class="google-plus img-circle"><span class="fa fa-google-plus"></span></a>
                            <a href="#" class="linkedin img-circle"><span class="fa fa-linkedin"></span></a> -->
                        </div>
                    </div>
                 </div>
                
            </div>
        </div><!-- Header Top End -->
        
        <!-- Lower Part -->
        <div class="lower-part">
            <div class="auto-container clearfix">
                
                <!--Outer Box-->
                <div class="outer-box clearfix">
                
                    <!--Btn Box-->
                    <div class="btn-box">
                        <a href="{_header_right_button_link_}" class="theme-btn" >{_header_right_button_text_}</a>
                    </div>
                    
                    <!-- Main Menu -->
                    <nav class="main-menu">
                        
                        <div class="navbar-header">
                            <!-- Toggle Button -->      
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        
                        <div class="navbar-collapse collapse clearfix">

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
                            <ul class="navigation">
                            
                                <li class="current dropdown"><a href="#">Home</a>
                                    <ul>
                                        <li><a href="index-2.html">Homepage One</a></li>
                                        <li><a href="index-3.html">Homepage Two</a></li>
                                    </ul>
                                </li>
                                <li><a href="about.html">About</a></li>
                                <li class="dropdown"><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="services.html">Our Mission</a></li>
                                        <li class="dropdown"><a href="#">Causes</a>
                                            <ul>
                                                <li><a href="causes-grid.html">Causes Grid</a></li>
                                                <li><a href="causes-list.html">Causes List</a></li>
                                                <li><a href="causes-single.html">Single Causes</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown"><a href="#">Events</a>
                                            <ul>
                                                <li><a href="events-list.html">Events List View</a></li>
                                                <li><a href="events-grid.html">Events Grid View</a></li>
                                                <li><a href="event-single.html">Single Event</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="team.html">Our Team</a></li>
                                        <li><a href="team-single.html">Team Single</a></li>
                                        <li><a href="testimonials.html">Testimonial</a></li>
                                        <li><a href="faqs.html">FAQs Page</a></li>
                                        <li><a href="error.html">404 Page</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Events</a>
                                    <ul>
                                        <li><a href="events-list.html">Events List View</a></li>
                                        <li><a href="events-grid.html">Events Grid View</a></li>
                                        <li><a href="event-single.html">Single Event</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Blog</a>
                                    <ul>
                                        <li><a href="blog.html">Blog Classic</a></li>
                                        <li><a href="blog-three-column.html">Blog Three Column</a></li>
                                        <li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Gallery</a>
                                    <ul>
                                        <li><a href="gallery-masonry.html">Gallery Masonry</a></li>
                                        <li><a href="gallery-three-column.html">Gallery Three Column</a></li>
                                    </ul>
                                </li>
                                
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                  */
                  ?>
                        </div>
                    </nav><!-- Main Menu End-->
                    
                </div>
            </div>
        </div><!-- Lower Part End-->
        
    </header><!--End Main Header -->

