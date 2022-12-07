<?php
//  ===================================================Default themee
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
<html lang="en">

  <head>

    <?=$title?>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 

 

    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/bootstrap.min.css">   
    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/fonts.css">   
    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/typography.css">   
    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/animate.css"> 
    <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/style-myraah.css"> 
    
    <!-- Plugins CSS -->    
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
	
	<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>.btn{background: #9f1b4a;color: #fff;}li a{color : #9f1b4a;}section{padding:60px 0;}li{list-style:none;}ul{padding-left:0;}
      html,body{overflow-x:hidden;}
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

$webdata=$CI->SiteModel->getWebsiteData();
$title=$logo=$contact=$email="";
if($webdata->num_rows())
{
    $wdata = $webdata->row();
    if($wdata->logo)
        $logo=base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->logo;
        
    if($wdata->contact)
        $contact= json_decode($wdata->contact)[0];
        
    if($wdata->email)
        $email= json_decode($wdata->email)[0];
    
    $title=$wdata->title;
}
$BODYSTYLE = '';
if(is_object($boxLayout)){
        if($boxLayout->box_layout)
        {
            $BODYSTYLE = 'margin-left:10%;margin-right:10%;'; 
            if($boxLayout->type == 'bg_color')
                  $BODYSTYLE .= 'background:'.$boxLayout->value;
            if($boxLayout->type == 'bg_image')
                 $BODYSTYLE  .= 'background:url('.base_url.'/public/temp/'.CLIENT_ID.'/'.$boxLayout->value.')';
        }
    }
    
 ?>

  <body style="home-page loaded" style="<?=$BODYSTYLE?>">

    <div class="scrolledIntroAfter">

    	<div id="bg">
    		<canvas id="bgCanvas"></canvas>
    	</div>
    	<header>
    		<div class="inner">
    			<h1>
    				<a href="<?=base_url?>" class="junni-logo">
    				    <?php
                        if($logo)
                            echo '<img src="'.$logo.'" >';
                        else
                            echo' <span class="fl-bigmug-line-cube29 mr-3 cube-bg"></span><span>Website</span>';
                       
                        ?>
    				</a>
    			</h1>
 <?php

 $menuCSS = $this->MenuModel->getMenuCSS();
 $me=$menuCSS->row();


  if($check=!($me->menu=='' && $me->menu_hover==''))
  {
    $css = json_decode($me->menu);

    $cssHover=json_decode($me->menu_hover);
  }



?>
  
  
    			
    			<nav class="globalNav">
    			    
    			    <?
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

                  function get_menu($items,$class = 'site-menu') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {

                          $_page_url = DefaultPage==$value['page_id']?'/':(base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']));
                          $activeCss = getActiveMenu($value['page_id']);
                        if(array_key_exists('child',$value))

                          $html.= '<li class="has-children" style="padding-right:5px;"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>'; 

                        else

                          $html.= '<li class=""><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'dropdown');

                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }

                   

                  print get_menu($items);
    			    ?>
    			    
    			    
    				<!--<ul>-->
    				<!--- menu code goes here -->    
    				<!--<li class="nav-home">-->
           
        <!--                <a href="#" data-pagechange="home">-->
        <!--                    Home-->
        <!--                </a>-->
        <!--            </li>    <li class="nav-home">-->
                       
        <!--                <a href="#" data-pagechange="home">-->
        <!--                    About-->
        <!--                </a>-->
        <!--            </li>    <li class="nav-home">-->
                       
        <!--                <a href="#" data-pagechange="home">-->
        <!--                    Contact-->
        <!--                </a>-->
        <!--            </li>    <li class="nav-home">-->
                       
        <!--                <a href="#" data-pagechange="home">-->
        <!--                    Listing-->
        <!--                </a>-->
        <!--            </li><!--- menu code ends here -->
    				<!--</ul>-->
    			</nav>		
    			<div class="openMenu-wrap">
    				<div class="openMenu">
    					<span></span>
    					<span></span>
    					<span></span>
    					<span></span>
    					<p class="tk-filson-soft">MENU</p>
    				</div>
    			</div>
    		</div>
    	</header>	
    
    	<div id="barba-wrapper">
    		<div class="barba-container">
    			<div id="page-home">
    				<section id="release">
    					<div class="inner">
    						<div class="ttl">
    							<h1 class="scroll"><!-- he11 -->Your teaching career is in safe hands when you study with us.<!-- he11end --></h1>
    						</div>
    					</div>
    				</section>
    			</div>
    		</div>
    	</div>
    </div><!-- Header end here --><!-- About -->










  

  <div class="wow zoomIn   animated" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: zoomIn;">





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
            <div class="col-md-12 col-lg-12 aos-init aos-animate VideoBox" data-aos="fade">
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
                              echo'
                              <div class="post-entry bg-white col-sm-12 col-md-6 col-lg-'.$width.'" style=" margin:1px;  height:'.$height.'px; display:inline-block;  ">
                              <div class="image" style="height:100%;">
                                <img src="https://img.youtube.com/vi/'.$yid[1].'/hqdefault.jpg" "  class="img-fluid" style="height:100%; width:100%;" data-link="'.$yid[1].'">
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
                  }
                  .prdBtn:hover
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
                         <p style="font-weight:bold; font-size:18px;">'.$img->title.'</p>';
                         
                         if($btn->text) 
                          echo'<p> <center><a href="'.$link.'"><button class="prdBtn" type="button">'.$btn->text.'</button></a></center></p>';

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



     echo'<div class="form-column col-lg-12 unit-7 pricing-table-modern__item" align="none">



              <div class="inner-box">

                <h3 class="editable 6cosh1">'.$f->title.'</h3>


                <div class="default-form contact-form">
                
                   <div role="form" dir="ltr">
						<div class="screen-reader-response"></div>
							
            <form action="" class="p-5 bg-white" id="contactForm" data-id="'.AJ_ENCODE($f->id).'" align="left" onsubmit="DataFormSubmit (event,this)">';

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
          </div>
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

function getTransactionForm($key)
{

  

  $CI= & get_instance();

    $f = $CI->FormModel->getTransactionForm(array('id'=>$key))->row();

    $fields  = json_decode($f->fields);



     echo'<div class="col-lg-12 unit-7 pricing-table-modern__item" align="none">



              <div class="pricing-table__item-header">

                <div class="pricing-table__item-header-bg">

                  <div class="pricing-table__item-header-bg-inner"></div>

                </div>

                <p class="pricing-table__item-title mb-0">'.$f->tform_name.'</p>

              </div> 



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

                        <input type="number" name="amount" class="form-control" '.$force.' required>

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

          <br>';

}


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

    $f = $CI->SiteModel->getGoogleAds(array('id'=>$key))->row();
    echo'<div class="container-fluid">
      <div class="container">'.$f->ads_code.'</div>
      </div>

      ';
}
?>