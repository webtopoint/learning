<?php
// ======================================= w4 Themeem
$mean=array(
  'backgroundColor'=>' background-color:',
  'backgroundHover'=>' background-color:',
  'textColor'=>' color:',
  'textHover'=>' color:',
  'menuPadL'=>' padding-left:',
  'menuPadR'=>' padding-right:',
  'menuPadT'=>' padding-top:',
  'menuPadB'=>' padding-bottom:',
  'Bcolor'=>' border-color:',
  'Bstyle'=>' border-style:',
  'Bsize'=>' border-width:',
  'Bradius'=>'border-radius:',
  'Fsize'=>'font-size:',
  'Fstyle'=>'font-style:',
  'Fweight'=>'font-weight:',
  'Ffamily'=>'font-family:'
);

?>
<html>

<!-- Mirrored from www.purohitconstruction.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jun 2020 12:33:40 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head id="ctl00_Head1">
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/layout1_setup.css" />
  <link rel="stylesheet" type="text/css" media="screen,projection,print" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/layout1_text.css" />
  <link href="<?=site_url('public/theme/'.FileDirecory.'/')?>CSS/prettyPhoto.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        img, div
        {
            behavior: url('CSS/iepngfix.htc');
        }
    </style>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Scripts/AC_RunActiveContent.html" type="text/javascript"></script>

    <link href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" />

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Javascripts/jquery-1.8.3.js"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Javascripts/jquery-ui-1.9.2.custom.js"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Javascripts/jquery-jvert-tabs-1.1.4.js" type="text/javascript"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Scripts/pngfix/jquery.pngFix.pack.js" type="text/javascript"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Scripts/pngfix/jquery.pngFix.js" type="text/javascript"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Javascripts/script.js" type="text/javascript"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?><?=site_url('public/theme/'.FileDirecory.'/')?>Javascripts/jquery.prettyPhoto.js" type="text/javascript"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Javascripts/jquery.flexislider.js" type="text/javascript"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Javascripts/jquery.cross-slide.js" type="text/javascript"></script>

    <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>Javascripts/jquery.cross-slide.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script>
        $(document).ready(function() {

            // hide #back-top first
            $("#back-top").hide();

            // fade in #back-top
            $(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 100) {
                        $('#back-top').fadeIn();
                    } else {
                        $('#back-top').fadeOut();
                    }
                });

                // scroll body to 0px on click
                $('#back-top a').click(function() {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            });

        });
</script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#navmenu-h li,#navmenu-v li").hover(
            function() { $(this).addClass("iehover"); },
            function() { $(this).removeClass("iehover"); });
            $(document).pngFix();
        });
    </script>
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
$title=$logo=$logo2=$contact=$email="";
if($webdata->num_rows())
{
    $wdata = $webdata->row();
    if($wdata->logo)
        $logo=base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->logo;
      if($wdata->secondary_logo)
        $logo2=base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->secondary_logo;
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
<body>

    <!-- Main Page Container -->
    <div class="page-container">
        <!-- For alternative headers START PASTE here -->
        <!-- A. HEADER -->
        <div class="header">
            <!-- A.1 HEADER TOP -->
            <div class="header-top">
                <!-- Sitelogo and sitename -->
                <div style="float: left; width: 500px; height: 150px;">

                     <?php
                        if($logo)
                        {
                            echo '<img src="'.$logo.'" class="sitelogo" style=" max-height: 100px; width:100%;">';
                        }
                        else
                        {
                            echo'<div style="font-size:30px; padding-top:13px;">Website</div>';
                        }
                       
                     ?>
                  <!--   <a class="" href="Default.html" title="Go to Start page"></a> -->

                </div>
                <!-- Navigation Level 1 -->
                <div class="nav1">
                  <?php
                  $second = $this->SiteModel->getSecondaryMenu();
                  if($second->num_rows())
                  {   
                     $sec_menu = $second->row();
                      if($sec_menu->secondary_menu)
                      {
                          echo' <ul>'; $i=0;                   
                          foreach (json_decode($sec_menu->secondary_menu) as $val)
                          {
                             $line = $i++?' | ':'';
                              $pagename = $this->SiteModel->list_page($val)->row()->page_name;

                               $_page_url = DefaultPage==$val?'/':(base_url.'/web/'.AJ_ENCODE($val).'/'.Print_page($pagename));

                              echo' <li><a href="'.$_page_url.'" title="" class="sub-menu-css"> '.$line.$pagename.' </a></li>';
                          }
                          echo'</ul>';
                      }

                      if($sec_menu->css)
                      {   
                          $secCSS = json_decode($sec_menu->css);
                          $secHover ;
                          $hoverList = array('textHover');

                          echo'<style>.sub-menu-css{';
                            foreach ($secCSS as $pro => $val)
                            {   
                                if(in_array($pro, $hoverList))   
                                {
                                  $secHover[$pro]=$val;
                                  continue;
                                }

                                if($val=='bold')
                                    $pro='Fweight';
                                echo $mean[$pro].$val.'!important;';
                            }
                            echo'}';

                          echo ' .sub-menu-css:hover{';
                            foreach ($secHover as $pro => $val)
                            {
                                echo $mean[$pro].$val.'!important;';
                            }
                            echo'}</style>';
                                                   
                      }

                  }
                  ?>
                   
                </div>
                <div style="float: right; margin-top: 10px; margin-right: 80px;">

                     <?php
                        if($logo2)
                        {
                            echo '<img src="'.$logo2.'" style=" max-height: 100px; max-width:170px;">';
                        }
                       
                     ?>
                </div>
            </div>
        </div>
    </div>
    <!-- For alternative headers END PASTE here -->
    <!-- B. MAIN -->


<?php

 $menuCSS = $this->MenuModel->getMenuCSS();
 $me=$menuCSS->row();

?>     
    <div class="page-container1">
        <!-- A.3 HEADER BOTTOM -->
        <div class="header-bottom" style="float:left; height:auto!important; background-size: 100% 100%; <?=$me->menubar_color?'background: linear-gradient(180deg, '.$me->menubar_color.', transparent)!important;':''?>">
            <!-- Navigation Level 2 (Drop-down menus) -->
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

                  function get_menu($items,$class = 'menu',$child=0) {

                    $mid = $child ? "":"id='menu'";

                      $html = "<ul class=\"".$class."\" ".$mid." >";



                      foreach($items as $key=>$value) {

                          $_page_url = DefaultPage==$value['page_id']?'/':(base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']));
                          $active = DefaultPage==$value['page_id']?" active ":"";

                        if(array_key_exists('child',$value))

                          $html.= '<li class="menulink '.$active.' menu-css"><a href="#" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>'; 

                        else

                          $html.= '<li class="'.$active.' menu-css" style=""><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'',1);





                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }

                   

                  print get_menu($items);

                  ?>
                <!--   <ul class="menu" id="menu">
                   <li><a href="#" class="menulink">About PCL</a>
                        <ul>
                            <li><a href="AboutUs.html">Overview</a></li>
                            <li><a href="AboutUs.html">The Founder</a></li>
                            <li><a href="AboutUs.html">Chairmans Message</a></li>
                            <li><a href="AboutUs.html">Mission Vision</a></li>
                            <li><a href="AboutUs.html">Management</a></li>
                            
                            <li><a href="AboutUs.html">Achievements</a></li>
                        </ul>
                    </li>
                  </ul> -->
                <!-- <ul class="menu" id="menu">
                    <li><a href="Default.html" class="menulink">Home</a></li>
                    <li><a href="#" class="menulink">About PCL</a>
                        <ul>
                            <li><a href="AboutUs.html">Overview</a></li>
                            <li><a href="AboutUs.html">The Founder</a></li>
                            <li><a href="AboutUs.html">Chairmans Message</a></li>
                            <li><a href="AboutUs.html">Mission Vision</a></li>
                            <li><a href="AboutUs.html">Management</a></li>
                            
                            <li><a href="AboutUs.html">Achievements</a></li>
                        </ul>
                    </li>
                    <li><a href="InvestorRelations.html" class="menulink">Investors Relations</a></li>
                    <li><a href="#" class="menulink">Projects</a>
                        <ul>
                            <li><a href="#" class="sub">Residential Development</a>
                                <ul>
                                   
                                    <li><a href="P_sopanlifestyle.html">Sopan Life Style<img src="images/old_icon.png"
                                        style="float: right; padding-right: 11px; border: none !important;" /></a></li>
                                    <li><a href="P_sopanelegance.html">Sopan Elegance<img src="images/new_icon.png" style="float: right;
                                        padding-right: 11px; border: none !important;" /></a></li>
                                    <li><a href="P_sopanheights.html">Sopan Heights<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_sopansagar.html">Sopan Sagar<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_statusIIlowrise.html">Status II Low Rise<img src="images/sold_icon-2.png"
                                        style="float: right; padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_statusIIhighrise.html">Status II High Rise<img src="images/sold_Icon.png"
                                        style="float: right; padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_StatusI.html">Status I<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_Sopanresidency.html">Sopan Residency<img src="images/sold_Icon.png"
                                        style="float: right; padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_Silvershine.html">Silver Shine<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_SilverNine.html">Silver Nine<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_SilverCoin.html">Silver Coin<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_Sukhsagar.html">Sukh Sagar
                                        <img src="images/sold_Icon.png" style="float: right; padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_Amiappartment.html">Ami Appartment<img src="images/sold_Icon.png"
                                        style="float: right; padding-right: 20px; border: none !important;" /></a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="sub">Commercial Development</a>
                                <ul>
                                    <li><a href="Devarsh_Sopan.html">Devarsh Sopan<img src="images/new_icon.png" style="float: right;
                                        padding-right: 11px; border: none !important;" /></a></li>
                                    <li><a href="P_sopanpalladium.html">Sopan Palladium<img src="images/new_icon.png"
                                        style="float: right; padding-right: 11px; border: none !important;" /></a></li>
                             
                                    <li><a href="P_purohithouse.html">Purohit House<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_purohitavenue.html">Purohit Avenue<img src="images/sold_Icon.png"
                                        style="float: right; padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_bkhouse.html">BK House<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_shaswat.html">Shaswat<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                    <li><a href="P_Sukan.html">Sukan<img src="images/sold_Icon.png" style="float: right;
                                        padding-right: 20px; border: none !important;" /></a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="sub">CSR Development</a>
                                <ul>
                                    <li class="topline"><a href="http://www.srisiddhivinayak.com/" target="_blank">Shree
                                        Siddhivinayak Devasthan</a></li>
                                    <li><a href="School.html">Podar Jumbo Kids</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="Newsevents.html" class="menulink">News & Media</a></li>
                    <li><a href="Career.html" class="menulink">Career</a> </li>
                    <li><a href="#" class="menulink">Support</a>
                        <ul>
                            <li class="topline"><a href="Inquiry.html">Sales Inquiry</a></li>
                            <li><a href="BankFinance.html">Bank Finance</a></li>
                            <li><a href="EmiCalculator.html">EMI Calculator</a></li>
                            <li><a href="Feedback.html">FeedBack</a></li>
                            <li><a href="PCLforNRI.html">PCL for NRI</a></li>
                            <li><a href="#">Contruction Updates</a></li>
                            
                        </ul>
                    </li>
                    <li><a href="ContactUs.html" class="menulink">Contact Us</a></li>
                </ul> -->

                <script type="text/javascript">
                    var menu = new menu.dd("menu");
                    menu.init("menu", "menuhover");
                </script>
        </div>
        <div class="main">
            <div class="main-content" style="background: white;; width: 100%; padding: 0px;">

      

<style type="text/css">

  <?php


    if($check):

       echo' ul.menu li
  {
    height: auto!important;
    background-image: none!important;
  }
  ul.menu li:hover
  {
    background-image: none!important;
  }
  ul.menu ul li a{
    border:0px;
  }
  ul.menu ul li a:hover
  {
    background:none;
  }
  .swiper-slide
  {
    width:100%!important;
    padding:0px;
    margin:0px;
  }';

    echo'.menu-css{';
      foreach ($css as $pro => $val)
      {    if($val=='bold')
              $pro='Fweight';
          echo $mean[$pro].$val.'!important;';
      }
      echo'}';

    echo ' .menu-css:hover{';
      foreach ($cssHover as $pro => $val)
      {
          echo $mean[$pro].$val.'!important;';
      }
      echo'} 
      .dropdown{background:none!important;border:none!important; box-shadow:none!important;}';

 
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
            <div class="container-fluid" style="padding:0px; padding-bottom:20px;">
                <div class="col-lg-12" align="center" style="padding-top:20px;  ">
                    <div class="breadcrumb">
                      <h1>'.$g->gallery_name.'</h1>
                    </div>
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

            echo'
            <div class="container-fluid">
                <div class="heading">
                   <h2>'.$g->gallery_name.'</h2>
                </div>          
                <div class="row" style=" padding-top:20px; padding-bottom:20px;">';
                   if($images->num_rows())
                  {
                      foreach ($images->result() as $img)
                      {
                $link = $img->product_link?$img->product_link:'javascript:void(0)" class="productQuery" data-proId="'.$img->id;

          echo'<div class=" col-lg-'.$width.'" style="margin:0px; padding:2px;">
                <div style="background:white;padding: 10px;border: 1px solid #f0f0f0;box-shadow: 0px 0px 9px -6px #a8a8a8;">
                  <img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'" style="height:'.$height.'px; width:100%; ">
                <h4 style="padding:5px;">'.$img->title.'</h4>
                <div style="height:70px; overflow:hidden; margin-bottom:5px; padding:5px;">
                '.$img->description.'
                </div>
                <div class="fadeout" style="margin-top:-90px!important; height:90px!important; bottom:0!important;"></div>
                <div style="width:100%;">';
                  
                   if($btn->text) 
          echo'<center><a href="'.$link.'"><button class="prdBtn" type="button">'.$btn->text.'</button></a></center>';
  

            echo'</div>
              </div>
            </div>';
  
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

    $f = $CI->FormModel->getTransactionForm(array('id'=>$key))->row();

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

                      <div class="col-md-12 mb-3 mb-md-0">

                      '.$f->btn.'

                      </div>

                    </div>

            </form>

            

          </div>

          <br><style>form button{height:auto;}</style>';

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
                <div class="container">';
                
                      foreach ($boxes as $res)
                      {
               
                echo'<div class="col-lg-'.$width.' col-md-'.$width.' col-sm-12 "> 
                <div class="service-box" align="center">
              <div style="height:'.$size.'px!important; width:'.$size.'px!important; font-size:'.$f->size.'!important; padding:10px; background-color:'.$f->boxcolor.'; color:'.$f->icolor.'; '.$type.'" align="center">
                          <i class="fa '.$res->icon.'" style="font-size:'.$f->size.'!important; height:auto; width:auto;"></i>
                        </div>
              <h4>'.$res->title.'</h4>
              <p>'.$res->data.'</p>
                        <div class="clearfix">&nbsp; </div> 
                      </div>
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