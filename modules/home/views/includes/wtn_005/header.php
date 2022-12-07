<?php
// ======================================= w4 Themeem
$mean= \C::menuCssArray();

?>
<html lang="en" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<base #href="" />

	<!-- Basic Page Needs
     ================================================== -->
	 <meta charset="utf-8">
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
	 
	 <!-- Mobile Specific Metas
     ================================================== -->
     <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

	
     <!-- Fonts
     ================================================== -->
     <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
     
    <!-- CSS
     ================================================== -->
	
	<!-- bootstrap -->
	<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/bootstrap.css">

	<!-- advisor -->
	<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/advisor.css">

	<!-- plugins -->
	<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/plugins.css">	

	<!-- advisor color -->
	<link rel="stylesheet" id="color" href=" <?=site_url('public/theme/'.FileDirecory.'/')?>css/color-default.css">

	<!-- hero slider -->
	<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/hero-slider.css">
	
	<!-- responsive -->
	<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/responsive.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
	<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/modernizr.js"></script>


<?=$title?>
<style type="text/css">
	/*
	@media (min-width: 767px){
		#header .main-nav li a{
			line-height: 0!important;
		}
}*/
</style>
<?
 
$CI=&get_instance();
// $res = $CI->ThemeModel->getCustomCss(array('element'=>'site'));
// $st="";
// if($res->num_rows())
// {
//     $css = json_decode($res->row()->css);

//     if($css->style=='box')
//       $st="padding:30px 90px 30px 90px; background:black;";
// }

$webdata=$CI->SiteModel->getWebsiteData();
$title=$logo=$contact=$email="";
if($webdata->num_rows())
{
    $wdata = $webdata->row();
    if($wdata->logo)
        $logo=base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->logo;
    if($wdata->favicon)
        echo ' <link rel="icon" href="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->favicon.'" type="image/png"/>';
        
    if($wdata->contact)
        $contact= json_decode($wdata->contact)[0];
        
    if($wdata->email)
        $email= json_decode($wdata->email)[0];
    
    $title=$wdata->title;
}
?>	
	
</head>
    <body class="fixed-header">
	    	
			
			
			<!-- LOADER -->
			<div id="loader" class="loader">
				<div class="spinner">
				  <div class="double-bounce1"></div>
				  <div class="double-bounce2"></div>
				</div>
			</div>
			
			
			
	<!-- <div class="color-switcher position" id="choose_color"> 
			  <a href="#." class="picker_close"><i class="fa fa-gear"></i></a>
				  <div class="theme-colours">
				  <h5>CHOOSE COLOR:</h5>
				  <ul>
					<li><a href="#." class="one" id="one"></a></li>
					<li><a href="#." class="two" id="two"></a></li>
					<li><a href="#." class="three" id="three"></a></li>
					<li><a href="#." class="four" id="four"></a></li>
					<li><a href="#." class="five" id="five"></a></li>
					<li><a href="#." class="six" id="six"></a></li>
					<li><a href="#." class="seven" id="seven"></a></li>
				  </ul>
				  <div class="clearfix"></div>
				  <p><strong>Note:</strong> you can add your own color just replace your color code in css file.</p>
				  </div>
				  
				  <div class="animations">
					  <h5>ANIMATIONS</h5>
					  <a href="#." id="off" class="active">OFF</a>
					  <a href="#." id="on">ON</a>
				  </div>
				  
				  
				  <div class="header-footer">
					<div class="half">
						<p>Header styles</p>
						<div class="styled-selectt">
							<p>Select Style</p>
							<ul>
								<li id="h-one">Header 1</li>
								<li id="h-two">Header 2</li>
								<li id="h-three">Header 3</li>
							</ul>
						</div>
					</div>
					  <div class="half">
						<p>Footer styles</p>
						<div class="styled-selectt">
							<p>Select Style</p>
							<ul>
								<li id="light">Light</li>
								<li id="dark">Dark</li>
							</ul>
						</div>
					</div>
				  </div>
				  
				  
				  <div class="clr"></div>
			</div>
			
			 -->
            

<?php
/*
 $menuCSS = $this->MenuModel->getMenuCSS();
 $me=$menuCSS->row();
 /*/


  $menuCSS = $this->MenuModel->getMenuCSS();
 $me      = $menuCSS->row();


  if($check=!($me->menu=='' && $me->menu_hover==''))
  {
    $css = json_decode(json_encode(json_decode($me->menu)),true);
    $cssHover=json_decode($me->menu_hover);
  }
  $submenuCss = json_decode(json_encode(json_decode($me->submenu)),true);
  $subMenuCssHover=json_decode($me->submenu_hover);

?>            
            <!-- HERDER -->
            <header id="header" class="h-one-h">
            	
				<div class="container">
						<?php
						$webdata=$CI->SiteModel->getWebsiteData();
						$webData = $webdata->row();
						$tagline='';
						$address ='';
						$time='';
						if($webData->other)
						{
							$d = json_decode($webData->other);
							$tagline = isset($d->tagline)?$d->tagline:"";
							$address = isset($d->address)?$d->address:"";
							$time = isset($d->time)?$d->time:"";
						}
						?>

					<!-- TOP BAR -->
					<div class="top-bar clearfix">
						<p><?=$tagline?></p>
						<ul>
						<a href="tel:<?=$contact?>" style="color: white;"><li><i class="icon-telephone114"></i><?=$contact?></li></a>
						
						<li><i class="icon-icons74"></i><?=$address?></li>
						<li><i class="icon-icons20"></i> <?=$time?></li>
						</ul>
					</div>
					<!-- / TOP BAR -->
					
					<!-- HEADER INNER -->
					<div class="header clearfix" style="background: <?=$me->menubar_color?>!important;">
						
						<a href="" class="logo">
							 <?php
				                if($logo)
				                {
				                    echo '<img src="'.$logo.'" style=" max-height: 100px; max-width:170px;">';
				                }
				                else
				                {
				                    echo'<div style="font-size:30px; padding-top:13px;">Website</div>';
				                }
				               
				             ?>
						</a>
						
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						<!-- <div class="search-btn">
							<a href="javascript:void(0);" class="search-trigger"><i class="icon-icons185"></i></a>
						</div>
						
						<div class="search-container">
							<i class="fa fa-times header-search-close"></i>
							<div class="search-overlay"></div>
							<div class="search">
								<form>
									<label>Search:</label>
									<input type="text" placeholder="">
									<button><i class="fa fa-search"></i></button>
								</form>
							</div>
						</div> -->
						
						<nav class="main-nav navbar-collapse collapse" id="primary-nav">


							  <?

                  if($check=!($me->menu=='' && $me->menu_hover==''))
                  {
                    $css = json_decode($me->menu);

                    $cssHover=json_decode($me->menu_hover);
                  }


                  $query = $this->MenuModel->get_menus();                   

                  $ref   = [];

                  $items = [];

                  foreach($query->result() as $k => $data) {



                      $thisRef = &$ref[$data->id];



                      $thisRef['parent']        =       $data->parent;

                      $thisRef['type']          =       $data->type;

                      $thisRef['page_name']     =       $data->label;

                      $thisRef['link']          =       $data->link;

                      $thisRef['id']            =       $data->id;

                      $thisRef['page_id']       =       $data->page_id;
                      
                      $thisRef['target']        =        '';
                      
                      $chR = $this->SiteModel->list_page($data->page_id);
                      
                      if($chR->num_rows())
                          $thisRef['target'] = $chR->row()->redirection ? ' target="_blank" ' : '';




                     if($data->parent == 0) {

                          $items[$data->id] = &$thisRef;

                     } else {

                          $ref[$data->parent]['child'][$data->id] = &$thisRef;

                     }



                  }

                   

                   $pageCount = 0;

                  function get_menu($items,$class = 'nav nav-pills') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {

                          $_page_url = DefaultPage==$value['page_id']?'/':(base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']));
                          $active = DefaultPage==$value['page_id']?" active ":"";
                          $activeCss = getActiveMenu($value['page_id']);
                        if(array_key_exists('child',$value))

                          $html.= '<li class="dropdown '.$active.'"><a href="#" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>'; 

                        else

                          $html.= '<li class="'.$active.'" style=""><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'dropdown-menu submenu-ul');





                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }

                   

                  print get_menu($items);

                  ?>


							<!-- <ul class="nav nav-pills">
								<li class="dropdown active"><a href="#.">Home <i class="fa fa-caret-down"></i></a>
									<ul class="dropdown-menu">
										<li class="active"><a href="index-2.html">Home One</a></li>
										<li><a href="index2.html">Home Two</a></li>
										<li><a href="index3.html">Home Three</a></li>
									</ul>
								</li>
								<li><a href="about-us.html">About Us</a></li>
								<li class="dropdown"><a href="#.">Services <i class="fa fa-caret-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="services.html">Financial Planning</a></li>
										<li><a href="services.html">Bonds</a></li>
										<li><a href="services.html">Commodities</a></li>
										<li><a href="services.html">Investment Trusts</a></li>
										<li class="dropdown-submenu"><a href="#.">Mutual Funds <i class="fa fa-caret-right"></i></a>
											<ul class="dropdown-menu">
												<li><a href="services.html">Financial Planning</a></li>
												<li><a href="services.html">Bonds</a></li>
												<li><a href="services.html">Commodities</a></li>
											</ul>
										</li>
										<li><a href="services.html">Retirement</a></li>
										<li><a href="services.html">Trades</a></li>
									</ul>
								</li>
								<li><a href="cases.html">Cases</a></li>
								<li class="dropdown"><a href="#.">News <i class="fa fa-caret-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="news.html">News One</a></li>
										<li><a href="news2.html">News Two</a></li>
									</ul>
								</li>
								<li><a href="shop.html">Shop</a></li>
								<li class="dropdown"><a href="#.">Contact Us <i class="fa fa-caret-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="contact-us.html">Contact Us One</a></li>
										<li><a href="contact-us2.html">Contact Us Two</a></li>
									</ul>
								</li>
							</ul> -->
						</nav>
						
					</div><!-- / HEADER INNER -->
					
                </div><!-- / CONTAINER -->
				
            </header><!-- / HERDER -->
            
            <!-- HERDER -->
            <header id="header" class="header-two h-two-h" style="display:none;">
            	
				<!-- TOP BAR -->
				<div class="top-bar-simple clearfix">
					<div class="container">
						<p>We have over 15 years of experience.</p>
						<ul class="social">
							<li><a href="#." class="facebook"><i class="icon-facebook-1"></i></a></li>
							<li><a href="#." class="twitter"><i class="icon-twitter-1"></i></a></li>
							<li><a href="#." class="google-plus"><i class="icon-google"></i></a></li>
							<li><a href="#." class="linkedin"><i class="icon-linkedin3"></i></a></li>
						</ul>
					</div>
				</div>
				<!-- / TOP BAR -->
				
				
				<div class="container">
					
					<!-- HEADER INNER -->
					<div class="header clearfix">
						
						<a href="index-2.html" class="logo"><img src="images/logo.png" alt=""></a>
						
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						<div class="search-btn">
							<a href="javascript:void(0);" class="search-trigger"><i class="icon-icons185"></i></a>
						</div>
						
						
						<div class="search-container">
							<i class="fa fa-times header-search-close"></i>
							<div class="search-overlay"></div>
							<div class="search">
								<form>
									<label>Search:</label>
									<input type="text" placeholder="">
									<button><i class="fa fa-search"></i></button>
								</form>
							</div>
						</div>
						
						
						<ul class="header-contact-widget clearfix">
							<li>
								<i class="icon-telephone114"></i>
								<p>+1 900 234 567<a href="mailto:support@advisor.com">support@advisor.com</a></p>
							</li>
							<li>
								<i class="icon-icons74"></i>
								<p>Manhattan Hall,<span>Advisor Melbourne, australia</span></p>
							</li>
							<li>
								<i class="icon-icons20"></i>
								<p>08:00 - 16:30<span>Monday to Saturday</span></p>
							</li>
						</ul>
						
						
					</div><!-- / HEADER INNER -->
					
					
					<nav class="main-nav navbar-collapse collapse" id="primary-nav">
						
						<ul class="nav nav-pills">
							<li class="dropdown active"><a href="#.">Home <i class="fa fa-caret-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="index-2.html">Home One</a></li>
									<li><a href="index2.html">Home Two</a></li>
									<li class="active"><a href="index3.html">Home Three</a></li>
								</ul>
							</li>
							<li><a href="about-us.html">About Us</a></li>
							<li class="dropdown"><a href="#.">Services <i class="fa fa-caret-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="services.html">Financial Planning</a></li>
									<li><a href="services.html">Bonds</a></li>
									<li><a href="services.html">Commodities</a></li>
									<li><a href="services.html">Investment Trusts</a></li>
									<li class="dropdown-submenu"><a href="#.">Mutual Funds <i class="fa fa-caret-right"></i></a>
										<ul class="dropdown-menu">
											<li><a href="services.html">Financial Planning</a></li>
											<li><a href="services.html">Bonds</a></li>
											<li><a href="services.html">Commodities</a></li>
										</ul>
									</li>
									<li><a href="services.html">Retirement</a></li>
									<li><a href="services.html">Trades</a></li>
								</ul>
							</li>
							<li><a href="cases.html">Cases</a></li>
							<li class="dropdown"><a href="#.">News <i class="fa fa-caret-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="news.html">News One</a></li>
									<li><a href="news2.html">News Two</a></li>
								</ul>
							</li>
							<li><a href="shop.html">Shop</a></li>
							<li class="dropdown"><a href="#.">Contact Us <i class="fa fa-caret-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="contact-us.html">Contact Us One</a></li>
									<li><a href="contact-us2.html">Contact Us Two</a></li>
								</ul>
							</li>
						</ul>
					</nav>
					
					
                </div><!-- / CONTAINER -->
				
            </header><!-- / HERDER -->
            
			
			<!-- HERDER -->
            <header id="header" class="header-three h-three-h" style="display:none;">
            	
				<div class="container-fluid">
					
					
					<!-- HEADER INNER -->
					<div class="header clearfix">
						
						<a href="index-2.html" class="logo"><img src="images/logo.png" alt=""></a>
						
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						<ul class="header-links clearfix">
							<li class="header-number"><a href="#."><i class="icon-phone4"></i>+1 900 234 567 - 68</a></li>
							<li class="header-time"><a href="#."><i class="icon-clock"></i>Mon to Sat 08:00 - 16:30</a></li>
							<li><a href="#." class="btn btn-primary btn-quote" data-text="Get a quote">Get a quote</a></li>
						</ul>
						
						<nav class="main-nav navbar-collapse collapse" id="primary-nav">
							<ul class="nav nav-pills">
								<li class="dropdown active"><a href="#.">Home <i class="fa fa-caret-down"></i></a>
									<ul class="dropdown-menu">
										<li class="active"><a href="index-2.html">Home One</a></li>
										<li><a href="index2.html">Home Two</a></li>
										<li><a href="index3.html">Home Three</a></li>
									</ul>
								</li>
								<li><a href="about-us.html">About Us</a></li>
								<li class="dropdown"><a href="#.">Services <i class="fa fa-caret-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="services.html">Financial Planning</a></li>
										<li><a href="services.html">Bonds</a></li>
										<li><a href="services.html">Commodities</a></li>
										<li><a href="services.html">Investment Trusts</a></li>
										<li class="dropdown-submenu"><a href="#.">Mutual Funds <i class="fa fa-caret-right"></i></a>
											<ul class="dropdown-menu">
												<li><a href="services.html">Financial Planning</a></li>
												<li><a href="services.html">Bonds</a></li>
												<li><a href="services.html">Commodities</a></li>
											</ul>
										</li>
										<li><a href="services.html">Retirement</a></li>
										<li><a href="services.html">Trades</a></li>
									</ul>
								</li>
								<li><a href="cases.html">Cases</a></li>
								<li class="dropdown"><a href="#.">News <i class="fa fa-caret-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="news.html">News One</a></li>
										<li><a href="news2.html">News Two</a></li>
									</ul>
								</li>
								<li><a href="shop.html">Shop</a></li>
								<li class="dropdown"><a href="#.">Contact Us <i class="fa fa-caret-down"></i></a>
									<ul class="dropdown-menu">
										<li><a href="contact-us.html">Contact Us One</a></li>
										<li><a href="contact-us2.html">Contact Us Two</a></li>
									</ul>
								</li>
							</ul>
						</nav>
						
					</div><!-- / HEADER INNER -->
					
                </div><!-- / CONTAINER -->
				
            </header><!-- / HERDER -->
			

<style type="text/css">
  <?php
     if($check):
        $font = '';        
        echo \C::printMenuCSS($css,$cssHover,$submenuCss,$subMenuCssHover);
    
    endif;
  ?>


/*=====================================================*/

.container
{
	max-width: 100%!important;
}
</style>
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$(".cd-hero").css('margin-top',$('.h-one-h').outerHeight());

	});
</script>
<section class="cd-hero">

<?php
//============GEt Carousel=========================================

function getCarousel($key)
{
  $CI = &get_instance();

       $data = $CI->SiteModel->getCarousel(array('id'=>$key));
        $drow = $data->row();



        $de = json_decode($drow->details);

        $sp = array('verySlow'=>5000,
                      'slow'=>4000,
                      'normal'=>2000,
                      'fast'=>1000,
                      'veryFast'=>500,
              );

        echo'<div style="width: 100%; height: '.$de->height.'px; overflow:hidden;">
              <div class="swiper-container-'.$drow->id.'">
                <div class="swiper-wrapper">';
        if($drow->images)
        {
            foreach (json_decode($drow->images) as $img)
            {
                echo'<div class="swiper-slide" style="background-image: url('.$img.'); background-size:100% 100%; background-repeate:none; height:'.$de->height.'px;">
                    </div>';
            }
        }
        else
        {
          echo'<center> <font color="red">No Photos</font></center>';
        }

         echo'</div>
              <!--  <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>-->
            </div>
          </div>
          <script>  
             var swiper = new Swiper(".swiper-container-'.$drow->id.'", {
              slidesPerView: '.$de->perSlide.',
              spaceBetween: 30,
              centeredSlides: true,
              autoplay: {
                delay: '.$sp[$de->speed].',
                disableOnInteraction: false,
              },
               breakpoints: {
                   300: {
                    slidesPerView: 1,
                    spaceBetween: 5,
                  },
                  640: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                  },
                  768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                  },
                  1024: {
                    slidesPerView: '.$de->perSlide.',
                    spaceBetween: 10,
                  },
                }
            });
          </script>
          ';
}
//============================================ END  Get Carousel ===========================


//========================================= Get Gallery ======================================


function getGallery($key,$col)
{
  $CI = &get_instance();

            $g = $CI->GalleryModel->image_gallery($key)->row();
            $images = $CI->GalleryModel->list_galllery_images(array('gallery_id'=>$key,'admin_id'=>CLIENT_ID));
            $lay = $g->layout?$g->layout:1;
            $width= round(12/$lay,2);
           // $width--; 
            $height= round((75*$col)/$lay,2);
            echo'
            <div class="container-fluid" style="padding:0px;">
           		<div class="col-lg-12" align="center">
		                  <h3>'.$g->gallery_name.'</h3>
                </div>
	            <div class="col-lg-12 GalleryBox" align="center">'; 
	                        if($images->num_rows())
	                        {
	                            foreach ($images->result() as $img)
	                            {
	                              echo'<div class="col-lg-'.$width.'"  style="height:'.$height.'px;    padding:2px;">
	                                   <img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'" class="img-fluid" style="height:100%; width:100%;" onmouse>
	                                  </div>';
	                            }
	                           // echo'<div class="pricing-table__item-control" style="margin:5px;">
	                            //<a class="btn btn-secondary rounded-0 py-2 px-4" href="#">More</a></div>';
	                        }
	                        else
	                        { 
	                          echo'<font color="red">No Data Available</font>';
	                        }
	                    echo'
	            </div>

            </div>';
}
//============================== End Get Gallery ===============================================



//================================ Get VIdoe Gallery ====================================


function getVideoGallery($key,$col)
{
  $CI = &get_instance();


            $g = $CI->GalleryModel->getVideoGallery(array('id'=>$key))->row();
            $videos = $CI->GalleryModel->getGalleryVideos(array('gallery_id'=>$key,'admin_id'=>CLIENT_ID));
            $lay = $g->layout?$g->layout:1;
            $width= round(12/$lay,2);
           // $width--; 
            $height= round((75*$col)/$lay,2);
            echo'<br>
            <div class="container-fluid" style="padding:0px;">
           		<div class="col-lg-12" align="center">
		                  <h3>'.$g->gallery_name.'</h3>
                </div>
              <div class="col-lg-12 VideoBox" align="center">';
                        if($videos->num_rows())
                        {
                            foreach ($videos->result() as $vid)
                            {
                               $yid = explode('=', $vid->video);
                              echo'
                              <div class="post-entry bg-white col-sm-12 col-md-6 col-lg-'.$width.'" style=" margin-top:2px;  height:'.$height.'px; display:inline-block;  ">
                              <div class="image" style="height:100%;">
                              <i class="fa fa-play-circle"></i>
                                <img src="https://img.youtube.com/vi/'.$yid[1].'/hqdefault.jpg" "  class="img-fluid" style="height:100%; width:100%;" data-link="'.$yid[1].'">
                                </div>
                              </div>';
                            }
                            //echo'<div class="pricing-table__item-control" style="margin:5px;">
                           // <a class="btn btn-secondary rounded-0 py-2 px-4" href="#">More</a></div>';
                        }
                        else
                        {
                          echo'<font color="red">No Data Available</font>';
                        }
                    echo'
                      </div>
                   </div><br>';
 }

//============================== End video Gallery======================================================

//============================== End getFileDownloadGallery Gallery======================================================
function getFileDownloadGallery($key,$col){
            $CI = &get_instance();


            $g = $CI->GalleryModel->file_download_gallery(array('file_download_gallery_id'=>$key))->row();
            $files = $CI->GalleryModel->files_download_gallery(array('file_download_gallery_id'=>$key,'admin_id'=>CLIENT_ID));
            $lay = 1;//$g->layout?$g->layout:1;
            $width= round(12/$lay,2);
           // $width--; 
            $height= '150';//round((75*$col)/$lay,2);
            echo'<br>
            <div class="col-md-12 col-lg-12 aos-init aos-animate VideoBox" data-aos="fade">
            <div class="unit-7 pricing-table-modern__item">
              <div class="pricing-table__item-header">
                <div class="pricing-table__item-header-bg">
                  <div class="pricing-table__item-header-bg-inner"></div>
                </div>
                <p class="pricing-table__item-title mb-0"><i class="fa fa-picture-o"></i> '.$g->gallery_name.'</p>
              </div>
              <div class="pricing-table__item-main" align="center" style="padding:3px;">'; 
                        if($files->num_rows())
                        {
                            echo '<div class="post-entry bg-white col-sm-12 col-md-6 col-lg-'.$width.'" style=" margin:1px;  min-height:'.$height.'px; display:inline-block;  ">
                                 <table class="table table-bordered table-bordered">
                                   <thead>
                                        <tr>
                                            <th>File</th>
                                            <th>Action</th>
                                        </tr>
                                   </thead>
                                   <tbody>';
                            foreach ($files->result() as $file)
                            {
                              
                              echo'
                                <tr>
                                    <td>'.$file->file_name.'</td>
                                    <td><a href="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$file->link.'" target="_blank" class=""><i class="fa fa-cloud-download"></i> Download</a></td>
                                </tr>
                              ';
                            }
                            echo '</tbody>
                                </table></div>';
                        //echo'<div class="pricing-table__item-control" style="margin:5px;">
                           // <a class="btn btn-secondary rounded-0 py-2 px-4" href="#">More</a></div>';
                        }
                        else
                        {
                          echo'<font color="red">No Data Available</font>';
                        }
                    echo'</div>
                      </div>
                   </div><br>';
}
//================================ Get Prduct GAllery ===================================


function getProductGallery($key,$col)
{
  
   $CI = &get_instance();

            $g = $CI->GalleryModel->product_gallery(array('id'=>$key))->row();
            $images = $CI->GalleryModel->getGalleryProducts(array('gallery_id'=>$key));
            $lay = $g->layout?$g->layout:1;
            $width= round(12/$lay,2);
            //$width--; 
            $height= round((65*$col)/$lay,2);
            
            $btn = json_decode($g->btn_css);

            echo'<style>
                  .prdBtn{
                    color:'.$btn->color.';
                    background-color:'.$btn->backColor.';
                    border:'.$btn->Bsize.'px '.$btn->Bstyle.' '.$btn->Bcolor.';
                    padding:'.$btn->padT.'px '.$btn->padR.'px '.$btn->padB.'px '.$btn->padL.'px;
                    height:auto;
                    border-radius:0px; 
                  }
                  .prdBtn:hover
                  {
                    color:'.$btn->textHover.';
                    background-color:'.$btn->backHover.';
                  }
            </style>';

            echo'<section class="bg-blue">

            <div class="container">
            		<div class="heading margin-bottom-50 animate bounceIn" data-delay="200">
						<h2>'.$g->gallery_name.'</h2>
					</div>          
                  	<div class="row" style=" padding-top:20px; padding-bottom:20px;">';
                   if($images->num_rows())
                  {
                      foreach ($images->result() as $img)
                      {
                $link = $img->product_link?$img->product_link:'javascript:void(0)" class="productQuery" data-proId="'.$img->id;

					echo'<div class=" col-lg-'.$width.'" style="margin:0px;">
							<div class="team-member animate fadeInUp" style="background:white; padding-bottom:15px;margin-bottom:0px">
								<img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'" style="height:'.$height.'px;">
								<h4 style="padding-left:5px">'.$img->title.'</h4>
								<div style="height:auto; overflow:hidden; margin-bottom:5px;">'.$img->description.'

								</div>
								<ul class="social-text">';
									
									 if($btn->text) 
          echo'<center><a href="'.$link.'"><button class="prdBtn" type="button">'.$btn->text.'</button></a></center>';
	

						echo'</ul>
							</div>
						</div>';
	
                      }
                  }
                  else
                  {
                      echo'<font color="red">No Data Available</font>';
                  }
                echo'</div>
                </div></section>';
}

//======================== end product gallery =====================



// ================================= Get Form ==================

function getForm($key)
{

  $CI= & get_instance();

    $f = $CI->FormModel->getFormModel(array('id'=>$key))->row();

    $fields  = json_decode($f->fields);



     echo'<div class="col-lg-12 " align="none" style="margin:20px 0px; ">

     		<h3 style="padding:10px 0px;">'.$f->title.'</h3>
            <form action="" class="pt-5 bg-white" data-id="'.AJ_ENCODE($f->id).'" align="left" onsubmit="DataFormSubmit (event,this)">';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)

              echo '<div class="row form-group">';

                      echo'<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';

                      $ck+=$col;

              if($ck==12)

              {

                echo'</div>'; $ck=0;

              }

              

            }

              if($ck>0)

                echo '</div>';



              echo '<div class="row form-group">

                      <div class="col-md-12 mb-3 mb-md-0">

                      '.$f->btn.'

                      </div>

                    </div>

            </form>

            

          </div>

          <br><style>form button{height:auto;}</style>';

}

//================== get popup form ===========


// =================================================== Get Pop up Form =============

function getPopupForm($key)
{

  $CI= & get_instance();

   $f = $CI->FormModel->getFormModel(array('id'=>$key))->row();

    $fields  = json_decode($f->fields);

   

     $res = '<div class="col-lg-12" align="none">

     		<h3>'.$f->title.'</h3>
            <form action="" class="p-5 bg-white" data-id="'.AJ_ENCODE($f->id).'" align="left" onsubmit="DataFormSubmit (event,this)">';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)

              $res.= '<div class="row form-group">';

                      $res.= '<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';

                      $ck+=$col;

              if($ck==12)

              {

                $res.='</div>'; $ck=0;

              }

              

            }

              if($ck>0)

                $res.= '</div>';



              $res.= '<div class="row form-group">

                      <div class="col-md-12 mb-3 mb-md-0">

                      '.$f->btn.'

                      </div>

                    </div>

            </form>

            

          </div>

          <br><style>form button{height:auto;}</style>';
          return $res;



}
//===============================


// =================================================== Get Transaction Form =============




// =================================================== Get Transaction Form =============

function getTransactionForm($key)
{
  $CI= & get_instance();

    $fs = $CI->FormModel->getTransactionForm(array('id'=>$key));
    if($fs->num_rows()){
        $f = $fs->row();
    $fields  = json_decode($f->fields);



     echo'<div class="col-lg-12 " align="none" style="margin:20px 0px; ">

     		<h2 style="padding:10px 0px;">'.$f->tform_name.'</h2>

            <form action="'.site_url('Home/transaction-submit').'" class="p-5 bg-white" data-id="'.AJ_ENCODE($f->id).'" align="left" method="post" enctype="multipart/form-data" onsubmit=""><input type="hidden" name="tfid" value="'.AJ_ENCODE($f->id).'">';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)

              echo '<div class="row form-group">';

                      echo'<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';

                      $ck+=$col;

              if($ck==12)

              {

                echo'</div>'; $ck=0;

              }

              

            }

              if($ck>0)

                echo '</div>';

              $force='';

              if($f->amount)

                $force = ' value="'.$f->amount.'" disabled ';



              echo'<div class="row form-group">

                      <div class="col-md-'.$col.' mb-3 mb-md-0">

                        <label>Amount to be Paid</label>

                        <input type="number" name="amount" class="form-control" min="'.$f->min_amount.'" '.$force.' required>

                      </div>

                    </div>

                    ';


              echo '<div class="row form-group">

                      <div class="col-md-12">
                      <h4>Pay Using:</h4>
                      ';

                       $pics = array('paytm'=>'https://cdn.iconscout.com/icon/free/png-512/paytm-226448.png',
          				'payumoney'=>'https://res.cloudinary.com/tia-img/image/fetch/t_company_avatar/https%3A%2F%2Fcdn.techinasia.com%2Fdata%2Fimages%2Fa7e6f511134a282fc7a386c0eb5929a0.png'
      		);
      		//print_r(json_decode($f->payment_method_id));
               $chk=0;
		        if($f->payment_method_id[0]=='[')
		        {
		            foreach (json_decode($f->payment_method_id) as $res)
		            {
		                 $method__ =  $CI->PaymentModel->getPaymentMethod(array('id'=>$res));
		                 if($method__->num_rows()){
		                    $mname =$method__->row()->method;
    						echo'<div class="div-method" style="width:200px; height:90px; display:inline-block;cursor:pointer">
                					<label>
                				 		 <input type="radio" name="gatewayid" value="'.$res.'" style="display:inline-block;" '.($chk?'':'checked').'> &nbsp; <img src="'.$pics[$mname].'" style="height:80px; width:150px; object-fit:cover;">
                					 </label>
                					</div>';
    						$chk=1;
		                 }
		            }
		        }
		        else
		        {
		             $mname =  $CI->PaymentModel->getPaymentMethod(array('id'=>$f->payment_method_id))->row()->method;	
					echo'<div style="width:150px; height:90px; display:inline-block;"><input type="radio" name="gatewayid" value="'.$f->payment_method_id.'" style="display:inline-block;" '.($chk?'':'checked').'> &nbsp; <img src="'.$pics[$mname].'" style="height:80px; width:150px; object-fit:cover;"></div>';
		        	$chk=1;
		        }

                      echo'</div>
                    </div>';


              echo '<div class="row form-group">

                      <div class="col-md-12 mb-3 mb-md-0">

                      '.$f->btn.'

                      </div>

                    </div>
            </form>
          </div>
          <br><style>form button{height:auto;}</style>';
    }

}



function getFeatureBox($key)
{

  $CI= & get_instance();

    $fs = $CI->SiteModel->getFeatureBox(array('id'=>$key));
    if($fs->num_rows()){
        $f = $fs->row();
        $boxes  = json_decode($f->boxes,true);
        //print_r($boxes);
        $width = round(12/$f->no,2);
        $size  = ($f->size+20); 
        $type  = $f->type=='circle' ? 'border-radius:50%;' : '';
    
        echo'<div class="container-fluid" style=" margin-bottom:50px; margin-top:50px;">
               <div class="row"> 
                    <div class="container">';
                    
                          foreach ($boxes as $res)
                          {
                        echo'<div class="col-lg-'.$width.' col-md-'.$width.' col-sm-12 "> 
            	        			<div class="service-box" align="center">
            							<div style="height:'.$size.'px!important; width:'.$size.'px!important; font-size:'.$f->size.'!important; padding:10px; background-color:'.$f->boxcolor.'; color:'.$f->icolor.'; '.$type.'" align="center">
            	                        <i class="fa '.$res['icon'].'" style="font-size:'.$f->size.'!important; height:auto; width:auto;"></i>
            	                    </div>
            						<h4>'.$res['title'].'</h4>
            						<p>'.$res['data'].'</p>
            		               	<div class="clearfix">&nbsp; </div> 
                            </div>
                        </div>';
                          }
            
                    echo'</div>
                    </div>
                  </div>';
    }

}


function getFileService($key)
{

   $CI= & get_instance();

  $service = $CI->ServiceModel->getFileService(array('id'=>$key))->row();

    $f = $CI->FormModel->getFormModel(array('id'=>$service->formid))->row();

    $fields  = json_decode($f->fields);



     echo'<div class="row">

          <div class="col-lg-12 p-5">
              
              <h2>'.$service->service_name.'</h2>
              <hr>
            <form class="bg-white" data-service-id="'.AJ_ENCODE($service->id).'" align="left" onsubmit="FileService(event,this)">';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)

              echo '<div class="row form-group">';

                      echo'<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';

                      $ck+=$col;

              if($ck==12)

              {

                echo'</div>'; $ck=0;

              }

              

            }

              if($ck>0)

                echo '</div>';



              echo '<div class="row form-group">

                      <div class="col-md-12 mb-3 mb-md-0">

                      '.$f->btn.'

                      </div>

                    </div>

            </form>

            

          </div>
          </div>
          <br>

          <br><style>form button{height:auto;}</style>';

}
function getAds($key)
{
	
  $CI= & get_instance();

    $f = $CI->SiteModel->getGoogleAds(array('id'=>$key))->row();
    echo'<div class="container-fluid">
    	<div class="container">'.$f->ads_code.'</div>
    	</div>

    	';
}
function getMarquee($key)
{
	$CI= & get_instance();

    $m = $CI->SiteModel->getMarquee(array('id'=>$key))->row();

    $pro = json_decode($m->properties);

    echo'<div class="container-fluid">
    		<marquee '; 
    		foreach($pro as $key => $val)
    			{ 
    				if($key=='hoverstop' && $val=='yes')
    				{
    					echo 'onmouseover="this.stop()" onmouseout="this.start()" ';
    				}
    				else
    				echo $key.'="'.$val.'"'; 

    			} echo'>'.$m->data.'</marquee>
    	</div>

    	';

}
?>