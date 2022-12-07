<?php
// ======================================= w4 Themeem
// $mean=array(
//   'backgroundColor'=>' background-color:',
//   'backgroundHover'=>' background-color:',
//   'textColor'=>' color:',
//   'textHover'=>' color:',
//   'menuPadL'=>' padding-left:',
//   'menuPadR'=>' padding-right:',
//   'menuPadT'=>' padding-top:',
//   'menuPadB'=>' padding-bottom:',
//   'Bcolor'=>' border-color:',
//   'Bstyle'=>' border-style:',
//   'Bsize'=>' border-width:',
//   'Bradius'=>'border-radius:',
//   'Fsize'=>'font-size:',
//   'Fstyle'=>'font-style:',
//   'Fweight'=>'font-weight:',
//   'Ffamily'=>'font-family:'
// );
$mean= (array)\C::menuCssArray();
?>
<html>

<!-- Mirrored from www.geolifegroup.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 May 2020 12:57:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
<?=$title?>
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
$boxLayout = [];
if($webdata->num_rows())
{
    $wdata = $webdata->row();
    if($wdata->logo)
        $logo=base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->logo;
        
    if($wdata->contact)
        $contact= json_decode($wdata->contact)[0];
        
    if($wdata->email)
        $email= json_decode($wdata->email)[0];
    
    if($wdata->box_layout)
       $boxLayout = json_decode($wdata->box_layout);
    $title=$wdata->title;
}
    $BODYSTYLE = '';
    $box_layout = false;
    if(is_object($boxLayout)){
        if($boxLayout->box_layout)
        {
            $box_layout = true;
            $BODYSTYLE = 'margin-left:10%;margin-right:10%;'; 
            if($boxLayout->type == 'bg_color')
                  $BODYSTYLE .= 'background:'.$boxLayout->value;
            if($boxLayout->type == 'bg_image')
                 $BODYSTYLE  .= 'background:url('.base_url.'/public/temp/'.CLIENT_ID.'/'.$boxLayout->value.')';
        }
    }
     
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<link href="<?=site_url('public/theme/'.FileDirecory.'/')?>media/system/css/modalf060.css?920b6ffcd8a0e79213a25251860aad9e" rel="stylesheet" type="text/css" />
	<link href="<?=site_url('public/theme/'.FileDirecory.'/')?>libraries/cegcore2/cache/3bdca8a54cfaad49498954d2504d654b.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
.ui.form input{box-sizing:border-box;}
@media screen and (max-width: 767px){
    #headerright {
        top: 119px!important;
        z-index: 999!important;
    }
    #topmenu{
        margin-top:0!important;
    }
}
	</style>
	

	<!--<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>media/system/js/mootools-coref060.js?920b6ffcd8a0e79213a25251860aad9e" type="text/javascript"></script>-->
	
	<!--<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>media/system/js/mootools-moref060.js?920b6ffcd8a0e79213a25251860aad9e" type="text/javascript"></script>-->

	<!--<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>templates/conv_template/js/jquery.min.js" type="text/javascript"></script>-->

	<!--<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>media/system/js/modalf060.js?920b6ffcd8a0e79213a25251860aad9e" type="text/javascript"></script>-->

	<!--<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>libraries/cegcore2/cache/2153ef7180f3d4ecc4677564b30f88c5.js" type="text/javascript"></script>-->
	

      <script src="<?=site_url('public/theme/default')?>/js/jquery-3.3.1.min.js"></script>

	<script type="text/javascript">

	if(typeof acymailingModule == 'undefined'){
				var acymailingModule = Array();
			}
			
		// 	acymailingModule['emailRegex'] = /^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*\@([a-z0-9-]+\.)+[a-z0-9]{2,10}$/i;

		// 	acymailingModule['NAMECAPTION'] = 'Name';
		// 	acymailingModule['NAME_MISSING'] = 'Please enter your name';
		// 	acymailingModule['EMAILCAPTION'] = 'Enter Email Address';
		// 	acymailingModule['VALID_EMAIL'] = 'Please enter a valid e-mail address';
		// 	acymailingModule['ACCEPT_TERMS'] = 'Please check the Terms and Conditions';
		// 	acymailingModule['CAPTCHA_MISSING'] = 'The captcha is invalid, please try again';
		// 	acymailingModule['NO_LIST_SELECTED'] = 'Please select the lists you want to subscribe to';
		
		// jQuery(function($) {
		// 	SqueezeBox.initialize({});
		// 	SqueezeBox.assign($('a.modal').get(), {
		// 		parse: 'rel'
		// 	});
		// });

// 		window.jModalClose = function () {
// 			SqueezeBox.close();
// 		};
		
// 		// Add extra modal close functionality for tinyMCE-based editors
// 		document.onreadystatechange = function () {
// 			if (document.readyState == 'interactive' && typeof tinyMCE != 'undefined' && tinyMCE)
// 			{
// 				if (typeof window.jModalClose_no_tinyMCE === 'undefined')
// 				{	
// 					window.jModalClose_no_tinyMCE = typeof(jModalClose) == 'function'  ?  jModalClose  :  false;
					
// 					jModalClose = function () {
// 						if (window.jModalClose_no_tinyMCE) window.jModalClose_no_tinyMCE.apply(this, arguments);
// 						tinyMCE.activeEditor.windowManager.close();
// 					};
// 				}
		
// 				if (typeof window.SqueezeBoxClose_no_tinyMCE === 'undefined')
// 				{
// 					if (typeof(SqueezeBox) == 'undefined')  SqueezeBox = {};
// 					window.SqueezeBoxClose_no_tinyMCE = typeof(SqueezeBox.close) == 'function'  ?  SqueezeBox.close  :  false;
		
// 					SqueezeBox.close = function () {
// 						if (window.SqueezeBoxClose_no_tinyMCE)  window.SqueezeBoxClose_no_tinyMCE.apply(this, arguments);
// 						tinyMCE.activeEditor.windowManager.close();
// 					};
// 				}
// 			}
// 		};
		
// 			jQuery(document).ready(function($){
// 				$.G2.boot.ready();
// 			});
		
// setInterval(function(){jQuery.get("index.html");}, 300000);

	// jQuery(document).ready(function($){
	// 	$.G2.forms.invisible();
		
	// 	$('body').on('contentChange.form', 'form', function(e){
	// 		e.stopPropagation();
	// 		$.G2.forms.ready($(this));
	// 	});
		
	// 	$('form').trigger('contentChange');
	// });


	</script>
	<script type="text/javascript">
		//jQuery(document).ready(function($){$("div.G2-joomla").trigger("contentChange");});
		</script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
	<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>templates/conv_template/css/templateb58c.css?37881" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>templates/conv_template/css/responsive1086.css?8462" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=site_url('public/theme/'.FileDirecory.'/')?>templates/conv_template/css/swiper.css">
	<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>templates/conv_template/js/swiper.min.js" type="text/javascript"></script>
	<!--<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>templates/conv_template/js/common9781.js?v=1590238582" type="text/javascript"></script>-->



		<!--[if IE]>
	<link rel="stylesheet" href="/templates/conv_template/css/ieonly.css" type="text/css" />
	<![endif]-->

	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery(".table_blue").wrap("<div class='table_wrapper'></div>");

			jQuery(".topmenutoggle").click(function() {
				//alert("chk");
				jQuery("#headerright").toggleClass("hide-left-bar");
			});

			jQuery("#topmenu ul >li.parent>a").click(function(e) {
				e.preventDefault();
				jQuery(this).toggleClass("opened");
				jQuery(this).next("ul").toggleClass("showul");

			});


			/*jQuery('.modaloverlay').hide();
			jQuery('hiddenoverlay').hide();
			jQuery('body.homepage .modaloverlay').show();
			jQuery('#modalclose').click(function(){
				jQuery('.modaloverlay').hide();
				jQuery('hiddenoverlay').hide();
			});*/

			/*jQuery('.modaloverlay').click(function(){
		jQuery('.modaloverlay').hide();
	});
	jQuery(function(){
		jQuery('.modaloverlay').click(function(event){
			event.stopPropagation();
		});
});*/

			/*jQuery('.modaloverlay').hide();
	jQuery('hiddenoverlay').hide();
	jQuery('body.homepage .modaloverlay').show();
	jQuery('.modaldiv').blur(function() {
		jQuery(this).hide();
	});*/

			jQuery('.modaloverlay').hide();
			jQuery('.hiddenoverlay').hide();
			jQuery('.aboutoverlay').hide();
			jQuery('body.homepage .modaloverlay').show();
			if (jQuery('body.aboutus')) {
				jQuery('.hiddenoverlay').hide();
			}
			jQuery('body.aboutus .aboutoverlay').show();
			jQuery('#modalclose').click(function() {
				jQuery('.modaloverlay').hide();
				jQuery('.hiddenoverlay').hide();
				jQuery('.aboutoverlay').hide();
			});
			jQuery('.modaloverlay').click(function() {
				jQuery('.modaloverlay').hide();
			});
			jQuery('.aboutoverlay').click(function() {
				jQuery('.aboutoverlay').hide();
				jQuery('.aboutoverlay video').attr('src', '');
			});

			jQuery(document).on('keyup', function(evt) {
				if (evt.keyCode == 27) {
					// alert('Esc key pressed.');
					// jQuery('.modaloverlay').hide();
					// jQuery('hiddenoverlay').hide();
					jQuery('.closeimg').trigger('click');
				}
			});

			jQuery(".modaldiv").focusin(function() {
				jQuery(this).show();
			});
			jQuery('.closeimg').click(function() {
				jQuery('.homepageoverlay').hide();
				jQuery('.aboutoverlay').hide();
				jQuery('.aboutoverlay video').attr('src', '');
			});

		});
	</script>
</head>



<?php

 $menuCSS = $this->MenuModel->getMenuCSS();
 $me=$menuCSS->row();
 
if($box_layout){
    echo '<style>
    #header.fixed{width: 77.5%!important;margin-left: 18px;}
	#header{width:97.2%;margin-left:15px}
	</style>';
}
\C::contentCss([ 'layout' => $box_layout ]);
//<?=$me->menubar_color
?>

<body class=" homepage" style=" <?=$BODYSTYLE?>; ">
	<a name="up" id="up"></a>
	<div id="header" style="background: transparent!important; <?php	
	
	?>">
		<div class="divinner">
			<div id="headerleft">
				<a href="<?=base_url?>">
					 <?php
		                if($logo)
		                {
		                    echo '<img src="'.$logo.'" style=" max-height: 100px; max-width:170px;" class="inner_logo">';
		                }
		                else
		                {
		                    echo'<div style="font-size:30px; padding-top:13px;">Website</div>';
		                }
		               
		                ?>
				</a>
				<a href="#" class="topmenutoggle"><img src="<?=site_url('public/theme/'.FileDirecory.'/')?>templates/conv_template/images/menu-button.png" border="0" /></a>
			</div>
			<div id="headerright">
				<div id="topmenu">
					<div class="moduletable_menu">
						<!-- <ul class="nav menu">
							<li class="active"><a href="index.html" >Home</a></li>
							<li><a href="about-us.html" >About Us</a></li>
							<li class="item-263"><a href="#">Products</a></li>
							<li class="item-103 deeper parent"><a href="#" >Media Room</a>
								<ul class="nav-child unstyled small">
									<li class="item-168"><a href="media-room/photo-gallery.html" >Photo Gallery</a></li>
									<li class="item-169"><a href="media-room/video-gallery.html" >Video Gallery</a></li>
									<li class="item-170"><a href="media-room/newsletter.html" >Newsletter</a></li>
									<li class="item-265 deeper parent"><a href="#" >Awards</a>
										<ul class="nav-child unstyled small">
											<li class="item-262"><a href="media-room/awards-main/awards.html" >Managing Director</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="parent"><a href="#" >CSR</a>
								<ul class="nav-child unstyled small">
									<li class="item-245"><a href="csr/geolife-foundation.html" >Geolife Foundation</a></li>
									<li class="item-247"><a href="csr/youth-club.html" >Youth Club</a></li>
								</ul>
							</li>
							<li class="item-352"><a href="research-farm.html" class="updating">Geolife Research Farm</a></li>
							<li class="item-105 deeper parent"><a href="#" >Testimonials</a>
								<ul class="nav-child unstyled small">
									<li class="item-372"><a href="testimonials/documented-testimonials.html" >Documented Testimonials</a></li>
									<li class="item-373"><a href="testimonials/video-testimonials.html" >Video Testimonials</a></li>
								</ul>
							</li>
							<li class="item-171"><a href="contact-us.html" >Contact Us</a></li>
							<li class="item-264"><a href="https://bit.ly/2YECiMo" target="_blank" rel="noopener noreferrer">Pay Now</a></li>
						</ul> -->


                  <?
$css  = 
$cssHover = 
$submenuCss = 
$subMenuCssHover = [];
                  if($check=!($me->menu=='' && $me->menu_hover==''))
                  {
                    $css = json_decode($me->menu);

                    $cssHover=json_decode($me->menu_hover);
                    $submenuCss = json_decode(json_encode(json_decode($me->submenu)),true);
                    $subMenuCssHover=json_decode($me->submenu_hover);
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

                  function get_menu($items,$class = 'nav menu') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {

                          $_page_url = DefaultPage==$value['page_id']?'/':(base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']));
                          $active = '';//DefaultPage==$value['page_id']?" active ":"";
                            $activeCss = getActiveMenu($value['page_id']);
                        if(array_key_exists('child',$value))

                          $html.= '<li class="deeper parent '.$active.'"><a href="'.$_page_url.'"  '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>'; 

                        else

                          $html.= '<li class="'.$active.'" style=""><a href="'.$_page_url.'"  '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'nav-child  unstyled small');





                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }

                   

                  print get_menu($items);

                  ?>


					</div>
				</div>
			</div>
		</div>
	</div>
	

<style type="text/css">
  <?php
   if($check):    
        echo \C::printMenuCSS($css,$cssHover,$submenuCss,$subMenuCssHover);
    endif;
  ?>

</style>


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

        echo'<div  style="width: 100%; height: '.$de->height.'px; overflow:hidden;">
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
            <div id="university" class="fullwidthdiv padding-vertical GalleryBox">
           		<div class="divinner">
              		<div class="moduletable university_trails" align="center">
		                
		                  <h3 class="redblack">'.$g->gallery_name.'</h3>

                	</div>
                </div>
              <div class="" align="center">'; 
                        if($images->num_rows())
                        {
                            foreach ($images->result() as $img)
                            {
                              echo'<div class=" post-entry col-lg-'.$width.'"  style="height:'.$height.'px;    padding:2px;">
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
            <div id="university" class="fullwidthdiv padding-vertical VideoBox">
           		<div class="divinner">
              		<div class="moduletable university_trails" align="center">
		                
		                  <h3 class="redblack">'.$g->gallery_name.'</h3>

                	</div>
                </div>
              <div class="" align="center">';
                        if($videos->num_rows())
                        {
                            foreach ($videos->result() as $vid)
                            {
                               $yid = explode('=', $vid->video);
                              echo'
                              <div class="post-entry bg-white col-sm-12 col-md-6 col-lg-'.$width.'" style=" margin-top:2px;  height:'.$height.'px; display:inline-block;  ">
                              <div class="image" style="height:100%;">
                                <img src="https://img.youtube.com/vi/'.$yid[1].'/hqdefault.jpg" "  class="img-fluid" style="height:100%; width:100%;" data-link="'.$yid[1].'">
                                <img src="'.base_url.'/public/custom/youtube logo.png" class="youtube-v-thumb">
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

            echo'<div id="university" class="fullwidthdiv padding-vertical GalleryBox">
	           		<div class="divinner">
	              		<div class="moduletable university_trails" align="center">
			                
			                  <h3 class="redblack">'.$g->gallery_name.'</h3>

	                	</div>
	                </div>

                  <div id="k2Container" class="tagView  domestic-products adj-image product-page">
                  	<div class="tagItemList" style=" background:white; padding-top:20px; padding-bottom:20px;">';
                   if($images->num_rows())
                  {
                      foreach ($images->result() as $img)
                      {
                $link = $img->product_link?$img->product_link:'javascript:void(0)" class="productQuery" data-proId="'.$img->id;

	echo'<div class=" col-lg-'.$width.'" style="margin:0px;">
		<div class="tagItemBody">
			  <div class="tagItemImageBlock">
				  <div class="tagItemImage" style="height:'.$height.'px" align="center">

				    	<img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'"   style="height:100%; max-width:100%;">
				  </div>
				  <div class="clr"></div>
			  </div>
			  <div class="clr"></div>
		</div>

	  	<div class="tagItemHeader">		 
		  <h5 class="tagItemTitle">'.$img->title.'</h5>';

		
		  	 if($btn->text) 
          echo'<center><a href="'.$link.'"><button class="prdBtn" type="button">'.$btn->text.'</button></a></center>';

		
		  	echo'</div><div class="clr"></div>			
			<div class="clr"></div>
	</div>';


               // echo'<div class="col-md-6 col-lg-'.$width.' tagItemView">
               //        <div class="unit-3 h-100 bg-white">
               //          <div class="d-flex align-items-center mb-3 unit-3-heading" style="height:'.$height.'px">
               //            <!--<div class="unit-3-icon-wrap mr-12">-->
               //             <img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'" "  class="img-fluid" style="height:100%; width:100%;">
               //           <!--- </div>
               //             -->
               //          </div>

               //          <div class="unit-3-body">
               //           <p style="font-weight:bold; font-size:18px;">'.$img->title.'</p>';
                         
               //           if($btn->text) 
               //            echo'<p> <center><a href="'.$link.'"><button class="prdBtn" type="button">'.$btn->text.'</button></a></center></p>';

               //          echo'</div>
                       
               //        </div>
               //      </div>';
                      }
                  }
                  else
                  {
                      echo'<font color="red">No Data Available</font>';
                  }
                echo'</div>
                </div>';
}

//======================== end product gallery =====================



// ================================= Get Form ==================

function getForm($key)
{

  $CI= & get_instance();

    $f = $CI->FormModel->getFormModel(array('id'=>$key))->row();

    $fields  = json_decode($f->fields);



     echo'<div class="col-lg-12" align="none">

     		<h3>'.$f->title.'</h3>
            <form action="" class="p-5 bg-white" data-id="'.AJ_ENCODE($f->id).'" align="left" onsubmit="DataFormSubmit (event,this)">';

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

$productinfo = ' Transaction Form';
$txnid = time();
$surl = $surl;
$furl = $furl;        
$key_id = payment_method()->key1;
$currency_code = 'INR'; 
$price = 0;
if($f->amount)
    $price = ($f->amount);
$total = ($price* 100); 
$amount = $price;
$merchant_order_id = ($f->id);
$card_holder_name = '';
$email = '';
$phone = '';
$name = @$title;
$return_url = site_url('Home/transaction-submit');






     echo'<div class="col-lg-12 unit-7 pricing-table-modern__item" align="none">



              <div class="pricing-table__item-header">

                <div class="pricing-table__item-header-bg">

                  <div class="pricing-table__item-header-bg-inner"></div>

                </div>

                <p class="pricing-table__item-title mb-0">'.$f->tform_name.'</p>

              </div> 



            <form action="'.$return_url.'" class="p-5 bg-white" name="razorpay-form" id="razorpay-form-'.$f->id.'" data-id="'.AJ_ENCODE($f->id).'" align="left" method="post" enctype="multipart/form-data" onsubmit=""><input type="hidden" name="tfid" value="'.AJ_ENCODE($f->id).'">
                  
                  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id_'.$f->id.'" />
                  <input type="hidden" name="merchant_order_id" id="merchant_order_id_'.$f->id.'" value="'.$merchant_order_id.'"/>
                  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id_'.$f->id.'" value="'.$txnid.'"/>
                  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id_'.$f->id.'" value="'.$productinfo.'"/>
                  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id_'.$f->id.'" value="'.$surl.'"/>
                  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id_'.$f->id.'" value="'.$furl.'"/>
                  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id_'.$f->id.'" value="'.$card_holder_name.'"/>
                  <input type="hidden" name="merchant_total" id="merchant_total_'.$f->id.'" value="'.$total.'"/>
                  <input type="hidden" name="merchant_amount" id="merchant_amount_'.$f->id.'" value="'.$amount.'"/>';
                  
            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)
                echo '<div class="row form-group">';
                echo'<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';
                $ck+=$col;

              if($ck==12)
              {                echo'</div>'; $ck=0;              }

              

            }

            if($ck>0)
                echo '</div>';

              $force='';

              if($f->amount)

                $force = ' value="'.$f->amount.'" disabled ';



              echo'<div class="row form-group">

                      <div class="col-md-'.$col.' mb-3 mb-md-0">

                        <label>Amount to be Paid</label>

                        <input type="number" name="amount" class="form-control" onkeyup="calPrice_'.$f->id.'(this)" onkeydown="calPrice_'.$f->id.'(this)" '.$force.' required>

                      </div>

                    </div>

                    ';

            echo '<div class="row form-group">

                      <div class="col-md-12">
                      <h4>Pay Using:</h4>
                      ';

                       $pics = array('paytm'=>'https://cdn.iconscout.com/icon/free/png-512/paytm-226448.png',
          				'payumoney'=>'https://res.cloudinary.com/tia-img/image/fetch/t_company_avatar/https%3A%2F%2Fcdn.techinasia.com%2Fdata%2Fimages%2Fa7e6f511134a282fc7a386c0eb5929a0.png',
          				'razorpay' => base_url.'/public/razorpay.png'
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
		                    
		                    $checked = ($chk?'':'checked ');
		                    if($mname == 'razorpay')
		                        $checked = 'required onclick="razorpaySubmit_'.$f->id.'(this);"';
		                    
		                    
    						echo'<div class="div-method" style="width:200px; height:90px; display:inline-block;cursor:pointer">
                					<label>
                				 		 <input type="radio" name="gatewayid" value="'.$res.'" data-id="'.$mname.'" style="display:inline-block;" '.$checked.'> &nbsp; <img src="'.$pics[$mname].'" style="height:100%; width:100%;">
                					 </label>
                					</div>';
    						$chk=1;
		                 }
		            }
		        }
		        else
		        {
		             $mname =  $CI->PaymentModel->getPaymentMethod(array('id'=>$f->payment_method_id))->row()->method;	
					echo'<div style="width:150px; height:90px; display:inline-block;"><input type="radio" name="gatewayid"  data-id="'.$mname.'"  value="'.$f->payment_method_id.'" style="display:inline-block;" '.($chk?'':'checked').'> &nbsp; <img src="'.$pics[$mname].'" style="height:100%; width:100%;"></div>';
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
        
        
          <br>';
          
           echo $CI->w999->view('front/plugins/razorpay_transaction_js',[
              
            'function' =>    'razorpaySubmit_'.$f->id,
            'id' => $f->id,
            'amount'    =>  $total,
            'name'  =>  $name,
            'form_id' => $merchant_order_id,
            'order_id' => $txnid,
            'key'   => $key_id
            
        ],true);   
      
    }

}



function getFeatureBox($key)
{

  $CI= & get_instance();

    $f = $CI->SiteModel->getFeatureBox(array('id'=>$key))->row();

    $boxes  = json_decode($f->boxes);

    $width= round(12/$f->no,2);
    $size  = ($f->size+20); 
    $type= $f->type=='circle'?'border-radius:50%;':'';

    echo'<div class="container-fluid" style=" margin-bottom:50px; margin-top:50px;">
           <div class="row"> 
                    <div class="col-md-12" style="text-align:center; padding:10px;">
                    </div> 
                <div class="container">';
                
                      foreach ($boxes as $res)
                      {
               
                echo'<div class="col-lg-'.$width.' col-md-'.$width.' col-sm-12"> 
                        <div class="box_3" align="center" style="border:0px;"> 
                            <div style="height:'.$size.'px; width:'.$size.'px; font-size:'.$f->size.'; padding:10px; background-color:'.$f->boxcolor.'; color:'.$f->icolor.'; '.$type.'" align="center">
                                <i class="fa '.$res->icon.'"></i>
                            </div>
                            <div class="box_4" style="background:none;"> 
                              <h3>
                              '.$res->title.'</h3> 
                              <p>'.$res->data.'</p>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp; </div> 
                    </div>';
                      }
        
                echo'</div>
                </div>
              </div>';

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
?>