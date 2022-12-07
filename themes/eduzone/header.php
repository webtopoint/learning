<div class="page-wraper">
    <div id="loading-area"></div>
    <!-- header -->
    <header class="site-header mo-left header">
		<div class="top-bar">
			<div class="container">
				<div class="row d-flex justify-content-between align-items-center">
					<div class="dlab-topbar-left">
						<ul>
							<li><i class="la la-phone-volume"></i>  +01 234 5678901</li>
							<li><i class="las la-map-marker"></i> 1073 W Stephen Ave, Clawson</li>
						</ul>
					</div>
					<div class="dlab-topbar-right">
						<ul>
							<li><i class="la la-clock"></i>  Mon - Sat 8.00 - 18.00</li>
							<li><i class="las la-envelope-open"></i> info@example.com</li>
						</ul>				
					</div>
				</div>
			</div>
		</div>
		<!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion logo-dark">
						<a href="index.html"><img src="{_logo_}" alt=""></a>
					</div>
                    <!-- nav toggle button -->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
                    <!-- extra nav -->
                    <div class="extra-nav">
                        <div class="extra-cell">
                            <button id="quik-search-btn" type="button" class="site-button-link"><i class="la la-search"></i></button>
							<a target="_blank" href="contact-1.html" class="site-button btnhover13">Apply Now</a>
						</div>
                    </div>
                    <!-- Quik search -->
                    <div class="dlab-quik-search ">
                        <form action="#">
                            <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                            <span id="quik-search-remove"><i class="ti-close"></i></span>
                        </form>
                    </div>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
						<div class="logo-header d-md-block d-lg-none">
							<a href="/"><img src="{_logo_}" alt=""></a>
						</div>
						
						  <?
                  $pageCount = 0;

                  function get_menu($items,$class = 'site-menu js-clone-nav d-none d-lg-block',$icon = 'down') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {
                          $_page_url = DefaultPage==$value['page_id']?'/': $value['url'];
                          $activeCss = getActiveMenu($value['page_id'] , 'active');// : '';

                          if($value['type'] == 'category'){
                            $_page_url = base_url.'/category/'.get_instance()->NewsModel->getCategorylink($value['page_id']);
                            $activeCss = getActiveMenu($value['page_id'],'active',true);
                          }
                          
                        $iconWithTExt =  $value['label'];
                          
                        if(array_key_exists('child',$value))

                          $html.= '<li class="'.$activeCss.'"><a href="javascript:;" '.$value['target'].' class="menu-css">'.$iconWithTExt.' <i class="fas fa-chevron-'.$icon.'"></i></a>'; 

                        else

                          $html.= '<li class=" '.$activeCss.'"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css">'.$iconWithTExt.'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'sub-menu','right');

                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }

                  print get_menu($menu_items,'nav navbar-nav menu-'.$group_id);

                  ?>
						<div class="dlab-social-icon">
							<ul>
								<li><a class="site-button circle fab fa-facebook-f" href="javascript:void(0);"></a></li>
								<li><a class="site-button  circle fab fa-twitter" href="javascript:void(0);"></a></li>
								<li><a class="site-button circle fab fa-linkedin-in" href="javascript:void(0);"></a></li>
								<li><a class="site-button circle fab fa-instagram" href="javascript:void(0);"></a></li>
							</ul>
						</div>		
                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>