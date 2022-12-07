<?php
/*                  ===================================================  Default theme =========================================================     */

    // update array


$mean= \C::menuCssArray();
?>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/magnific-popup.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/jquery-ui.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/owl.carousel.min.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/animate.css">

    <link rel="stylesheet" href="<?=base_url?>/public/custom/icon-picker/dist/fontawesome-5.11.2/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/fl-bigmug-line.css">
  

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/aos.css">



    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/style.css">

    
    <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/jquery-3.3.1.min.js"></script>
      
      <style>
          .theme-12-logo{
             height:200px!important; width:100%; 
          }
          @media only screen and (max-width: 600px) {
              .theme-12-logo{
                     height:100px; width:100%; 
                  }
            }
            ul.topbar li{
                display: inline-block;
                list-style:none;
            }
            ul.topbar{
                padding:0;
            }
            .cnt_full
            {
            display:block;
            margin:20px 10px;
            width:100%;
            }
            .cnt_min
            {
                    display:inline-block;width:150px;margin-bottom:10px;height:120px;position:relative;padding:0 2%;
            }
            .cnt_min:hover{
                cursor:pointer;
            }
            .cnt_min input[type="radio"]
            {
            width:100%;height:100%;position:absolute;top:0;left:0;opacity:0;
            }
            .selected_img
            {
                pointer-events: none;width:100%;height:100%;
            }
            .cnt_min input[type="radio"]:checked ~ .selected_img
            {
                 border: solid 3px black;
                box-shadow: 0px 1px 4px 0px #2eff20;
                border-radius: 5px;
            }
      </style>
      <style type="text/css">
      <?php
         $group = $this->MenuModel->get_menu_groups([],1,0,1);
         $gROUPwHERE = $group->num_rows() ? ['group_id' => $group->row()->id] : [];
         $menuCSS = $this->MenuModel->getMenuCSS($gROUPwHERE);
         $me      = $menuCSS->row();
        
        
          if($check=!($me->menu=='' && $me->menu_hover==''))
          {
            $css = json_decode($me->menu,true);
            //print_r( $css );
            $cssHover=json_decode($me->menu_hover);
          }
          $submenuCss = json_decode(json_encode(json_decode($me->submenu)),true);
          $subMenuCssHover=json_decode($me->submenu_hover);
          $group_id = ($group->num_rows()) ? $group->row()->id : 0;
          if($check):     
            echo \C::printMenuCSS($css,$cssHover,$submenuCss,$subMenuCssHover,$group_id);
        
        endif;
      ?>
    
    </style>
      
  </head>

<?php

$CI=&get_instance();

// $res = $CI->ThemeModel->getCustomCss(array('element'=>'site'));
// $st="";
// if($res->num_rows())
// {
//     $css = json_decode($res->row()->css);

//     if($css->style=='box')
//       $st="padding:30px 90px 30px 90px; background:black;";
// }

$webdata        =           $CI->SiteModel->getWebsiteData();
$title          =           $logo=$contact=$email="";


$boxLayout      =           [];
if($webdata->num_rows())
{
    $wdata = $webdata->row();
    if($wdata->favicon)
       echo '<link rel="icon" href="'.client_file($wdata->favicon).'" type="image/gif" sizes="16x16">';
    if($wdata->logo)
        $logo=base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->logo;
        
    if($wdata->contact)
        $contact= json_decode($wdata->contact)[0];
        
    if($wdata->email)
        $email= json_decode($wdata->email)[0];
    
    if($wdata->box_layout)
       $boxLayout = json_decode($wdata->box_layout);
    $title=$wdata->title;
    
    if($wdata->other)
    {
    	$d = json_decode($wdata->other);
    	echo "\n".isset($d->headerCode) ? $d->headerCode : '';
    }
}
    $BODYSTYLE = '';
    $layout = false;
    if(is_object($boxLayout)){
        if($boxLayout->box_layout)
        {
            $layout = true;
            $BODYSTYLE = 'margin-left:6%;margin-right:6%;'; 
            if($boxLayout->type == 'bg_color')
                  $BODYSTYLE .= 'background:'.$boxLayout->value;
            if($boxLayout->type == 'bg_image')
                 $BODYSTYLE  .= 'background-image:url('.base_url.'/public/temp/'.CLIENT_ID.'/'.$boxLayout->value.');background-repeat: no-repeat;background-size: 100% 100%;';
        }
    }
    
    
    \C::contentCss([ 'layout' => $layout ]);
    
 ?>
    <style>
        .container-fluid{
            padding:0;
            margin:0;
        }
        .site-navbar .site-navigation .site-menu > li , .site-navbar .site-navigation .site-menu .has-children .dropdown{
            padding:0!important;
        }
        .site-navbar .site-navigation .site-menu .has-children .dropdown{margin:0!important;}
        .site-navbar .site-navigation .site-menu .has-children .dropdown > li.has-children > a:before {
                right: 2px!important;
        }
        ol, ul, dl {
            margin:0!important;
        }
    </style>
    
  <body style="<?=$BODYSTYLE?>" >

  <?

    $top = $this->SiteModel->getTopBar();
    if($top->num_rows()){
        $top = $top -> row();
        \C::printHeaderCSS('topbar',json_decode($top->css,true));// $top -> css;
         echo '<div class=" header-section" >
                    <div class="row" style="padding:0;margin:0">';
                
                
                
                $events = (array) json_decode( $top -> events);
                foreach($events as $k){
                    
                    echo '<div class="'.$k->size.'" style="padding:0">';
                    echo \C::TOPWIDGET( $k->id , $k->action );
                    echo '</div>';
                }
            
        echo '      </div>
              </div>';
    }
      
  
  
  
  echo '<div class="site-wrap" style="background: white;">';
    
    
 
    if(THEME_ID == 12){
        ?>
        
        <div class="site-navbar bg-dark" >

            <div class="container">
    
              <div class="row align-items-center" style="font-size:20px">
                  <div class="col-md-6 col-lg-6">
                      
                  </div>
                  <div class="col-md-6 col-lg-6">
                      <a href="tel:<?=$contact?>">
                          <i class="fa fa-phone"></i> <?=$contact?>
                      </a>
                      <a href="mailto:<?=$email?>" style="margin-left:8px">
                          <i class="fa fa-envelope"></i> <?=$email?>
                      </a>
                  </div>
              </div>
              
            </div>
            
        </div>
    <?php
    }
    ?>
    
    <div class="site-mobile-menu">

      <div class="site-mobile-menu-header">

        <div class="site-mobile-menu-close mt-3">

          <span class="icon-close2 js-menu-toggle"></span>

        </div>

      </div>

      <div class="site-mobile-menu-body"></div>

    </div> <!-- .site-mobile-menu -->

    

    
    <?
    $container_class  =   THEME_ID == 12 ? ''  : 'container py-2';
    $row_class        =   THEME_ID == 12 ? ''  : 'row align-items-center';
    
    ?>
    <div class="site-navbar-wrap bg-white">

      <div class="site-navbar-top">

        <div class="<?=$container_class?>">

          <div class="<?=$row_class?>">

            <?
            $header = $this->SiteModel->getHeader();
        
            if($header->num_rows()):
                
                $header = $header->row();
                
                $events = (array) json_decode( $header->events);
                foreach($events as $k){
                        
                        echo '<div class="'.$k->size.'" style="padding:0">';
                        echo \C::TOPWIDGET( $k->id , $k->action );
                        echo '</div>';
                    }
                    
            elseif(THEME_ID == 12):
                ?>
                <div class="col-12 col-md-12 col-lg-12" style="padding:0">
                    <a href="<?=site_url()?>" class="d-flex align-items-center site-logo">
                
                    <?
                    if($logo)
                        echo '<img src="'.$logo.'"  class="theme-12-logo">';
                    else
                        echo' <span class="fl-bigmug-line-cube29 mr-3 cube-bg"></span><span>Website</span>';
                    ?>
                  </a>
                </div>
                
                <?
            else:
            ?>

            <div class="col-6 col-md-6 col-lg-2">

              <a href="<?=site_url()?>" class="d-flex align-items-center site-logo">
                
                <?php
                if($logo)
                {
                    echo '<img src="'.$logo.'" style="height:auto; width:100%;">';
                }
                else
                {
                    echo' <span class="fl-bigmug-line-cube29 mr-3 cube-bg"></span>

                            <span>Website</span>';
                }
               
                ?>
              </a>

            </div>


            <div class="col-6 col-md-6 col-lg-10">

              <ul class="unit-4 ml-auto text-right">



                <li class="text-left">

                  <a href="tel:<?=$contact?>">

                    <div class="d-flex align-items-center block-unit">

                      <div class="icon mr-0 mr-md-4">

                        <span class="fl-bigmug-line-cellphone55 h3"></span>

                      </div>

                      <div class="d-none d-lg-block">

                        <span class="d-block text-gray-500 text-uppercase">24/7 Support</span>

                        <span class="h6"><a href="tel:<?=$contact?>"><?=$contact?></a></span>

                      </div>

                    </div>

                  </a>

                </li>





                <li class="text-left">

                  <a href="mailto:<?=$email?>">

                    <div class="d-flex align-items-center block-unit">

                      <div class="icon mr-0 mr-md-4">

                        <span class="fl-bigmug-line-email64 h5"></span>

                      </div>

                      <div class="d-none d-lg-block">

                        <span class="d-block text-gray-500 text-uppercase">Email</span>

                        <span class="h6"><a href="mailto:<?=$email?>"><?=$email?></a></span>

                      </div>

                    </div>

                  </a>

                </li>

              </ul>

            </div>           

            <?
            endif;
            ?>

          </div>

          

        </div>

      </div>


      <div class="site-navbar bg-dark " style="background: <?=$me->menubar_color?>!important;">

        <!--<div class="container">-->

        <!--  <div class="row align-items-center">-->
            <div>
                
              <div>


            <div class="col-4 col-md-4 col-lg-12" style="padding:0">

              <nav class="site-navigation text-left" role="navigation">

                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
                  <a href="#" class="site-menu-toggle js-menu-toggle" style="<?=$check?"color: ".$cssHover->textHover:"color:white"; ?>">
                    <span class="icon-menu h3"></span>
                  </a>
                </div>

                <style type="text/css">

                  /*

                  ul.dropdown{

                    background-color: red!important;

                    border:none;

                  }

                  */

                </style>

                

                  <?
                  
                  
                  $query = $this->MenuModel->get_menus($group_id);                   

                  $ref   = [];

                  $items = [];

                  foreach($query->result() as $k => $data) {

			            $icons = (array) ( !empty( $data->iconCss ) ? json_decode($data->iconCss) : C::isIconStyle() );
                           
                        $iconStyle = 'style="';
                        foreach($icons as $i => $v){
                            if( ! in_array( $i , [ 'position' , 'title_hide' , 'icon_hide' ] ) ){
                                
                                    $iconStyle .= $i.':'.$v;
                                    $iconStyle .= ($i == 'font-size') ? 'px;' : ';';
                            }
                        }
                        $iconStyle .= '"';
                        $pageName = $data->label;
                        
                        if(isset($icons['title_hide']))
                            $pageName = $icons['title_hide'] == 'false' ? '' : $pageName;
                        
                        $Hide_icon = false;
                        if(isset($icons['icon_hide']))
                            $Hide_icon = ($icons['icon_hide'] == 'false') ? false : true;
                            
                        
                         
                      $thisRef                  =       &$ref[$data->id];
                      $thisRef['parent']        =       $data->parent;
                      $thisRef['type']          =       $data->type;
                      $thisRef['page_name']     =       $data->label;
                      $thisRef['link']          =       $data->link;
                      $thisRef['url']           =       (base_url.'/web/'.AJ_ENCODE($data->page_id).'/');
                      $thisRef['id']            =       $data->id;
                      $thisRef['page_id']       =       $data->page_id;
                      $thisRef['target']        =        '';
                      
                      $thisRef['left_icon']     =  ( $icons['position'] == 'left' AND $Hide_icon ) ? 
                                                                    empty($data->icon) ? '' : '<i '.$iconStyle.' class="'.$data->icon.'"></i>' : '';
                      $thisRef['right_icon']    =  ( $icons['position'] == 'right' AND $Hide_icon ) ? 
                                                                    empty($data->icon) ? '' : '<i '.$iconStyle.' class="'.$data->icon.'"></i>' : '';
                                                                    
                      $thisRef['label']         =   $thisRef['left_icon'].' '.$pageName.' '.$thisRef['right_icon'];                                             
                      
                      $chR = $this->SiteModel->list_page($data->page_id);
                      if($chR->num_rows()){
                            $MENURow = $chR->row();
                            $thisRef['target'] = $MENURow->redirection ? ' target="_blank" ' : '';
                            if($MENURow->link)
                                $thisRef['url'] = $MENURow->link;
                            else
                                $thisRef['url'] = $thisRef['url'] . Print_page($MENURow->page_name);
                      }

                     if($data->parent == 0) 
                          $items[$data->id]                         =       &$thisRef;
                     else 
                          $ref[$data->parent]['child'][$data->id]   =       &$thisRef;

                  }

                   

                   $pageCount = 0;

                  function get_menu($items,$class = 'site-menu js-clone-nav d-none d-lg-block') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {
                          $_page_url = DefaultPage==$value['page_id']?'/': $value['url'];
                          $activeCss = getActiveMenu($value['page_id']);

                          if($value['type'] == 'category'){
                            $_page_url = base_url.'/category/'.get_instance()->NewsModel->getCategorylink($value['page_id']);
                            $activeCss = getActiveMenu($value['page_id'],'active-menu',true);
                          }
                          
                        $iconWithTExt =  $value['label'];
                          
                        if(array_key_exists('child',$value))

                          $html.= '<li class="has-children '.$activeCss.'"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css">'.$iconWithTExt.'</a>'; 

                        else

                          $html.= '<li class=" '.$activeCss.'"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css">'.$iconWithTExt.'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'dropdown submenu-ul');

                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }

                   

                  print get_menu($items,'site-menu js-clone-nav d-none d-lg-block menu-'.$group_id);

                  ?>

              </nav>

            </div>



          </div>

        </div>

      </div>

    </div>
    

<?php

?>
<style type="text/css">
	.info_body a
	{
		width:99%;
		display: inline-block;
		padding: 2px;
		margin:1px;
		word-wrap: nowrap;
		text-align:left;
		border-bottom: 1px solid #ccc;
		color:#6b6a6a;
	}
/* width */
.scrolldiv::-webkit-scrollbar {
  width: 5px;
}

/* Track */
.scrolldiv::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
.scrolldiv::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
.scrolldiv::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
  .info_body a:hover{
   color:black;
  }
</style>

<script type="text/javascript">
  $(".site-navbar .site-navigation .site-menu > li:last-child > a").css("padding-right","!important");
</script>


<?php
//============GEt Carousel=========================================

function getCarousel($key)
{ 
  $CI = &get_instance();

       $data = $CI->SiteModel->getCarousel(array('id'=>$key));

       if(!$data->num_rows())
       {
       		echo $key.' Not found';
       		return false;
       }
        $drow = $data->row();



        $de = json_decode($drow->details);

        $sp = array('verySlow'=>5000,
                      'slow'=>4000,
                      'normal'=>2000,
                      'fast'=>1000,
                      'veryFast'=>500,
              );
        echo '<style>
                    #carousel-height-000'.$drow->id.'{
                        height: '.$de->height.'px;
                    }
                    @media only screen and (max-width: 600px) {
                       #carousel-height-000'.$drow->id.'{
                            height: 200px;
                        }
                    }
                </style>';
        echo'<div style="width: 100%;  overflow:hidden;" id="carousel-height-000'.$drow->id.'">
              <div class="swiper-container-'.$drow->id.'">
                <div class="swiper-wrapper">';
                
                
                if($drow->images)
                {
                    foreach (json_decode($drow->images) as $img)
                    {
                        echo'<div class="swiper-slide" id="carousel-height-000'.$drow->id.'" style="background-image: url('.$img.'); background-size:100% 100%; background-repeate:none; width:100%">
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
            echo'<br>
            <div class="col-md-12 col-lg-12 aos-init aos-animate GalleryBox" data-aos="fade">
            <div class="unit-7 pricing-table-modern__item">
              <div class="pricing-table__item-header">
                <div class="pricing-table__item-header-bg">
                  <div class="pricing-table__item-header-bg-inner"></div>
                </div>
                <p class="pricing-table__item-title mb-0">'.$g->gallery_name.'</p>
              </div>
              <div class="pricing-table__item-main" align="center" style=""><div class="row">'; 
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
                    echo'</div> </div>
                      </div>
                   </div><br>';
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
            <div class="col-md-12 col-lg-12 aos-init aos-animate " data-aos="fade">
            <div class="unit-7 pricing-table-modern__item">
              <div class="pricing-table__item-header">
                <div class="pricing-table__item-header-bg">
                  <div class="pricing-table__item-header-bg-inner"></div>
                </div>
                <p class="pricing-table__item-title mb-0"><i class="fa fa-picture-o"></i> '.$g->gallery_name.'</p>
              </div>
              <div class="pricing-table__item-main" align="center" style="padding:3px;">'; 
                        if($videos->num_rows())
                        {
                            foreach ($videos->result() as $vid)
                            {
                              $yid = explode('=', $vid->video);
                              $top = '';
                              if($vid->type == 'video'){
                                  
                                  $video = base_url.'/public/web/video_thumb.jpg';
                                  $link  = base_url.'/public/temp/'.CLIENT_ID.'/'.$vid->video;
                              }
                              else{
                                    $video =  'https://img.youtube.com/vi/'.$yid[1].'/hqdefault.jpg'; 
                                    $top  = '<img src="'.base_url.'/public/custom/youtube logo.png" class="youtube-v-thumb">';
                                    $link = 'https://www.youtube.com/embed/'.$yid[1];
                              }
                              
                              echo'
                              <div class="VideoBox post-entry bg-white col-sm-12 col-md-6 col-lg-'.$width.'" style=" margin:1px;  height:'.$height.'px; display:inline-block;  ">
                                <div class="image" style="height:100%;">
                                 
                                  <img src="'.$video.'"   class="img-fluid" style="height:100%; width:100%;" data-link="'.$link.'">
                                  '.$top.'
                               </div>
                              </div>';
                            }
                            echo'<div class="pricing-table__item-control" style="margin:5px;">
                            <a class="btn btn-secondary rounded-0 py-2 px-4" href="#">More</a></div>';
                        }
                        else
                        {
                          echo'<font color="red">No Data Available</font>';
                        }
                    echo'</div>
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
            <div class="row" data-aos="fade" >
            <div class="unit-7 pricing-table-modern__item" style="    width: 100%;
    margin-left: 30px;
    margin-right: 30px;">
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
                   </div>
        <br>';
}

//================================ Get getFileDownloadGallery GAllery ===================================

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
            $btnClass = 'prBtn-'.$g->id;
            echo'<style>
                  .'.$btnClass.'{
                    color:'.$btn->color.';
                    background-color:'.$btn->backColor.';
                    border:'.$btn->Bsize.'px '.$btn->Bstyle.' '.$btn->Bcolor.';
                    padding:'.$btn->padT.'px '.$btn->padR.'px '.$btn->padB.'px '.$btn->padL.'px; 
                  }
                  .'.$btnClass.':hover
                  {
                    color:'.$btn->textHover.';
                    background-color:'.$btn->backHover.';
                  }
            </style>';

            echo'<div class="container">
                  <div class="row justify-content-center text-center mb-5">
                    <div class="col-md-12 aos-init aos-animate" data-aos="fade">
                      <h2>'.$g->gallery_name.'</h2>
                    </div>
                  </div>
                  <div class="row hosting">';
                   if($images->num_rows())
                  {
                      foreach ($images->result() as $img)
                      {
                $link = $img->product_link?$img->product_link:'javascript:void(0)" class="productQuery" data-proId="'.$img->id;
               echo'<div class="col-md-6 col-lg-'.$width.' mb-5 mb-lg-4 aos-init aos-animate" data-aos="fade" data-aos-delay="100" >
                      <div class="unit-3 h-100 bg-white">
                        <div class="d-flex align-items-center mb-3 unit-3-heading" style="height:'.$height.'px">
                          <!--<div class="unit-3-icon-wrap mr-12">-->
                           <img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'" "  class="img-fluid" style="height:100%; width:100%;">
                         <!--- </div>
                           -->
                        </div>

                        <div class="unit-3-body">
                         <p style="font-weight:bold; font-size:18px;text-align:center;">'.$img->title.'</p>';
                         
                         if($btn->text) 
                          echo'<p> <center><a href="'.$link.'"><button class="'.$btnClass.' prdBtn" type="button">'.$btn->text.'</button></a></center></p>';

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


    if($f->theme_id){
      echo $CI->{PREFIX}->view('front/plugins/print_form_with_theme',[
        'form_id' => $f->id,
        'fields'  => $fields,
        'event'  =>  $f,
        'css'    => $f->css
      ],true);
    }
    else{
     echo'<div class="col-lg-12 unit-7 pricing-table-modern__item" id="form-'.($f->id).'" align="none">



              <div class="pricing-table__item-header">

                <div class="pricing-table__item-header-bg">

                  <div class="pricing-table__item-header-bg-inner"></div>

                </div>

                <p class="pricing-table__item-title mb-0">'.$f->title.'</p>

              </div> 

            <form action="" class="p-5 bg-white" data-id="'.AJ_ENCODE($f->id).'" align="left" onsubmit="DataFormSubmit (event,this)">';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)

              echo '<div class="row form-group">';

                      echo'<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';

                      $ck  +=  $col;

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

          <br>';
    }

}

//================================= Get Search Result Form===============
function getSearchResultForm($key){
    $CI = & get_instance();
    $f = $CI->FormModel->getSearchResultForm_View(['id'=>$key])->row();
    $fields = json_decode($f->fields);
    $form_css = json_decode($f->forms_css);

    echo '<style>
            .resultSearchForm-Button-'.$f->id.'{';
            foreach($form_css->button_css as $k => $v){
                echo $k.':'.$v.';';
            }
    echo 'cursor:pointer;}</style>';
    
    echo '<div class="col-lg-12 unit-7 pricing-table-modern__item" align="none">



              <div class="pricing-table__item-header">

                <div class="pricing-table__item-header-bg">

                  <div class="pricing-table__item-header-bg-inner"></div>

                </div>

                <p class="pricing-table__item-title mb-0">'.$form_css->form_title.'</p>

              </div> 



            <form action="" class="p-5 bg-white" data-id="'.AJ_ENCODE($f->id).'" align="left" onSubmit="findResultBySomeFields(event,this)">';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil => $value){

              if($ck==0)

              echo '<div class="row form-group">';

                      echo'<div class="col-md-'.$col.' mb-3 mb-md-0">
                            <div class="form-group">
                                <lable>'.$value->label.'</label>';
                                switch($fil){
                                    
                                    case 'dob':
                                        echo '<input type="date" placeholder="'.$value->placeholder.'" required class="form-control" name="'.$fil.'">';
                                    break;
                                    
                                    default:
                                        echo '<input type="" placeholder="'.$value->placeholder.'" required class="form-control" name="'.$fil.'">';
                                }
                      echo '</div>
                          </div>';

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
                            <button class="resultSearchForm-Button-'.$f->id.'">
                            '.$form_css->button_name.'
                            </button>
                      </div>

                    </div>

            </form>

            

          </div>

          <br>';
}
// =================================================== Get Pop up Form =============

function getPopupForm($key)

{

  $CI= & get_instance();

   $f = $CI->FormModel->getFormModel(array('id'=>$key))->row();

    $fields  = json_decode($f->fields);

   

     $res = '<div class="col-lg-12 unit-7 pricing-table-modern__item" align="none">



              <div class="pricing-table__item-header">

                <div class="pricing-table__item-header-bg">

                  <div class="pricing-table__item-header-bg-inner"></div>

                </div>

                <p class="pricing-table__item-title mb-0">'.$f->title.'</p>

              </div> 



            <form action="" class="p-5 bg-white" data-id="'.AJ_ENCODE($f->id).'" align="left" onsubmit="DataFormSubmit (event,this)">';

            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)

              $res.= '<div class="row form-group">';

                      $res.='<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';

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

            

          </div>';

          return $res;



}

// =================================================== Get Transaction Form =============
/*
old code after cashfree updatation
function getTransactionForm($key)
{

  

  $CI= & get_instance();

    $fs = $CI->FormModel->getTransactionForm(array('id'=>$key));
    if($fs->num_rows()){
        $f = $fs->row();
    $fields  = json_decode($f->fields);

$productinfo = ' Transaction Form';
$txnid = time();
$surl = '';
$furl = '';        
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
                				 		 <input type="radio" name="gatewayid" value="'.$res.'" data-id="'.$mname.'" style="display:inline-block;" '.$checked.'> &nbsp; <img src="'.$pics[strtolower($mname)].'" style="height:100%; width:100%;">
                					 </label>
                					</div>';
    						$chk=1;
		                 }
		            }
		        }
		        else
		        {
		             $mname =  $CI->PaymentModel->getPaymentMethod(array('id'=>$f->payment_method_id))->row()->method;	
					echo'<div style="width:150px; height:90px; display:inline-block;"><input type="radio" name="gatewayid"  data-id="'.$mname.'"  value="'.$f->payment_method_id.'" style="display:inline-block;" '.($chk?'':'checked').'> &nbsp; <img src="'.$pics[strtolower($mname)].'" style="height:100%; width:100%;"></div>';
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
*/

/*** New getTransactionForm ***/
function getTransactionForm($key)
{

  

  $CI= & get_instance();

    $fs = $CI->FormModel->getTransactionForm(array('id'=>$key));
    if($fs->num_rows()){
        $f = $fs->row();
    $fields  = json_decode($f->fields);

$productinfo = ' Transaction Form';
$txnid = time();
$surl = '';
$furl = '';        
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



            <form action="'.$return_url.'" class="p-5 bg-white" name="razorpay-form" id="razorpay-form-'.$f->id.'" data-id="'.AJ_ENCODE($f->id).'" align="left" method="post" enctype="multipart/form-data" onsubmit="">
                <input type="hidden" name="tfid" value="'.AJ_ENCODE($f->id).'">
                  
                  <input type="hidden" name="orderNote" value="'.$f->tform_name.' FORM PAYMENT"/>
                  <input type="hidden" name="orderCurrency" value="INR"/>
                  <input type="hidden" name="customerName" value="a"/>
                  <input type="hidden" name="customerEmail" value="ajaykumar@gmail.com"/>
                  <input type="hidden" name="customerPhone" value="8533898539"/>
                  <input type="hidden" name="orderAmount" value="'.$amount.'"/>
                  <input type ="hidden" name="notifyUrl" value="'.base_url.'/Home/cashfree_transaction/'.$txnid.'"/>
                  <input type ="hidden" name="returnUrl" value="'.base_url.'/Home/cashfree_transaction/'.$txnid.'"/>
                  <input type="hidden" name="appId" value="'.payment_method('cashfree')->key1.'"/>
                  <input type="hidden" name="orderId" value="'.$txnid.'"/>
                  
                  
                  
                  
                  
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
                     
                      <div class="col-md-12 cnt_full">
                      <h4>Pay Using:</h4>
                      ';

                       $pics = array('paytm'=>'https://cdn.iconscout.com/icon/free/png-512/paytm-226448.png',
          				'payumoney'=>'https://res.cloudinary.com/tia-img/image/fetch/t_company_avatar/https%3A%2F%2Fcdn.techinasia.com%2Fdata%2Fimages%2Fa7e6f511134a282fc7a386c0eb5929a0.png',
          				'razorpay' => base_url.'/public/razorpay.png',
          				'cashfree' => 'https://www.cashfree.com/images/presskit/header.png'
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
		                    
		                    
    						echo'<div class="div-method cnt_min" style="width:200px; height:90px; display:inline-block;cursor:pointer">
                					<label>
                				 		 <input type="radio" name="gatewayid" value="'.$res.'" data-id="'.$mname.'" style="display:inline-block;" '.$checked.'> <img src="'.$pics[strtolower($mname)].'" class="selected_img" style="height:100%; width:100%;">
                					 </label>
                					</div>';
    						$chk=1;
		                 }
		            }
		        }
		        else
		        {
		             $mname =  $CI->PaymentModel->getPaymentMethod(array('id'=>$f->payment_method_id))->row()->method;	
					echo'<div style="width:150px; height:90px; display:inline-block;"><input type="radio" name="gatewayid"  data-id="'.$mname.'"  value="'.$f->payment_method_id.'" style="display:inline-block;" '.($chk?'':'checked').'> &nbsp; <img src="'.$pics[strtolower($mname)].'" style="height:100%; width:100%;"></div>';
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
/** End New getTransactionForm **/

function getFeatureBox($key)
{

  $CI= & get_instance();

    $f = $CI->SiteModel->getFeatureBox(array('id'=>$key))->row();

    $boxes  = json_decode($f->boxes);

    $width= round(12/$f->no,2);
    $size  = ($f->size+20); 
    $type= $f->type=='circle'?'border-radius:50%;':'';

    echo'<div class="container-fluid" style=" margin-bottom:50px; padding-top:50px; background:#f5feff;">
           <div class="row hosting">';
                
                      foreach ($boxes as $res)
                      {
               

                  echo'<div class="col-lg-'.$width.' col-md-'.$width.' mb-5 aos-init aos-animate" data-aos="fade" data-aos-delay="100">

                              <div class="unit-3 h-100 bg-white">
                                
                                <div class="d-flex align-items-center mb-3 unit-3-heading">
                                  <div class="unit-3-icon-wrap mr-4">
                                    <div style="height:'.$size.'px; width:'.$size.'px; font-size:'.$f->size.'; padding:10px; background-color:'.$f->boxcolor.'; color:'.$f->icolor.'; '.$type.'" align="center">
                                                  <i class="fa '.$res->icon.'"></i>
                                    </div>
                                  </div>
                                  <h2 class="h5">'.$res->title.'</h2>
                                </div>
                                <div class="unit-3-body">
                                  <p>'.$res->data.'</p>
                                </div>
                              </div>

                            </div>';


                // echo'<div class=" col-md-'.$width.' col-sm-12"> 
                //         <div class="box_3" align="center" style="border:0px;"> 
                            
                //             <div class="box_4" style="background:none;"> 
                //               <h3>
                //               <a href="javascript:void(0)"></a></h3> 
                //               <p></p>
                //             </div>
                //         </div>
                //         <div class="clearfix">&nbsp; </div> 
                //     </div>';
                      }
        
                echo'
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
          <br>';

}

function getAds($key)
{
  
  $CI= & get_instance();

    $f = $CI->SiteModel->getGoogleAds(array('id'=>$key));
    if($f->num_rows()){
        $f = $f->row();
        echo'<div class="container-fluid">
          <div class="container">'.$f->ads_code.'</div>
          </div>
    
          ';
    }
}

function getMarquee($key){
    $CI = & get_instance();
    
    $mar = $CI->SiteModel->getMarquee(['id'=>$key]);
    
    if($mar->num_rows()){
        $mar1 = $mar->row();
        $properties = '';
        foreach(json_decode($mar1->properties,true) as $k => $a){
            if($k == 'hoverstop')
                $properties .= ($a=='yes') ? 'onMouseOver="this.stop()" onMouseOut="this.start()" ' :'';
            else
                $properties .= $k.'="'.$a.'" ';
        }
        
        $btn_data = json_decode($mar1->btn_data, true);
        $btn_css = $btn_html = '';
        if($btn_data){
             $btn_css = 'float:'.$btn_data['btn_position'].';';
             
            $btn_html = '
                <div class="btn_css" style="position: relative;margin-top: -63px;'.$btn_css.'">
                    '.$btn_data['btn_title'].'
                </div> 
            ';
        }
        echo '
        <div class="container-fluid" >
           
            <div style=" width:100%;">
             <marquee '. $properties .' style="  margin-top: 20px;">'.$mar1->data.' </marquee>
            </div>
              '.str_replace('</p>','',str_replace('<p>','',$btn_html)).'
            
        </div>';
        

    }
    
}
?>