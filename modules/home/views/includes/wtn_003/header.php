<?php
// ======================================= w3 Themeem
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

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/bootstrap.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/flickity.css" media="screen">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/jquery-1.11.1.min.js"></script>
<!-- Custom Theme files -->
<link href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
<!----start-top-nav-script---->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory.'/')?>css/Menustyles.css">
 <script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/Menuscript.js"></script>

<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/flickity.pkgd.min.js"></script>
		<script>
			$(function() {
				var pull 		= $('#pull');
					menu 		= $('nav ul');
					menuHeight	= menu.height();
				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});
				$(window).resize(function(){
	        		var w = $(window).width();
	        		if(w > 320 && menu.is(':hidden')) {
	        			menu.removeAttr('style');
	        		}
	    		});
			});
		</script>
		<!----//End-top-nav-script---->
<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/jquery.easydropdown.js"></script>
<!----- start-Share-instantly-slider---->
					 <!-- Prettify -->
					
					  
					<!----- //End-Share-instantly-slider---->
<script type="text/javascript" src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/hover_pack.js"></script>

<style>

.logo-header
{
	margin-top: -11px;
}

.menu {
  float: right;
  margin-top: 16px !important;
}

.image_left
{
	position: absolute;
	width: 100%;
	height: auto;
	
}
</style>
</head>
<body style="<?=$BODYSTYLE?>"> <!----start-header---->





<?php

 $menuCSS = $this->MenuModel->getMenuCSS();
 $me=$menuCSS->row();

?>

<div style="border-top: 5px solid #1C71A8; width: 100%;"></div>
<div class="container">
<div class="row headrow">
<div class="col-md-12" style="background: <?=$me->menubar_color?>!important;">
<div class="col-md-5">
<h1 style="width: 360px; max-height: 100px;">
	<a href="<?=site_url()?>">
		 <?php
                if($logo)
                {
                    echo '<img src="'.$logo.'" style=" max-height: 100px; width:100%;" class="inner_logo">';
                }
                else
                {
                    echo'Website';
                }
               
                ?>
  </a>
</h1>
</div>
<div class="col-md-7 menurow">
<div id="cssmenu" class="cssmenu" style="background: <?=$me->menubar_color?>!important;"> 
     <?php
     
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



                     function get_menu($items,$class = '') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {

                          $_page_url = DefaultPage==$value['page_id']?'/':(base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']));

                        if(array_key_exists('child',$value))

                          $html.= '<li class=" has-sub" ><a href="#" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>'; 

                        else

                          $html.= '<li class=""><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'');





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

        echo'<!--<div style="width:100%; text-align:center"><h2>'.$drow->name.'</h2></div>-->
        <div style="width: 100%; height: '.$de->height.'px; overflow:hidden;">
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
                <!--<div class="swiper-button-next"></div>
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
//============================================= Get Gallery ==================================
	
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
           
            <div class="container GalleryBox" style="width:100%!important; margin-bottom:50px;"> 
			    <div class="row"> 
			      <div class="col-md-12"> <h2><i class="fa fa-picture-o"></i> '.$g->gallery_name.'</h2> 
			      </div> 
			    </div> 
			    <div class="row">'; 
                        if($images->num_rows())
                        {
                            foreach ($images->result() as $img)
                            {
                              echo'
                              <div class="col-lg-'.$width.' col-xs-12" style="height:'.$height.'px; display:inline-block; margin-top:5px; margin-bottom:5px;"> 
                              	<center class="image"><img class="img-thumbnail" src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'" style="height:100%; width:100%;"> </center>
                              </div>';
                            }
                        }
                        else
                        {
                          echo'<font color="red">No Data Available</font>';
                        }
                    echo'
                </div>
            </div>
        ';
}

//========================================= End Get Gallery ===================================


//=============================================== Get Video Gallery ==========================



function getVideoGallery($key,$col)
{
  $CI = &get_instance();

            $g = $CI->GalleryModel->getVideoGallery(array('id'=>$key))->row();
            $videos = $CI->GalleryModel->getGalleryVideos(array('gallery_id'=>$key,'admin_id'=>CLIENT_ID));
            $lay = $g->layout?$g->layout:1;
            $width= round(12/$lay,2);
           // $width--; 
            $height= round((75*$col)/$lay,2);
            echo'
            <div class="container VideoBox" style="width:100%!important; margin-bottom:50px; background:#f5feff;"> 
			    <div class="row"> 
			      <div class="col-md-12"  style="text-align:center; padding:10px;"> <h2><i class="fa fa-video-camera"></i> '.$g->gallery_name.'</h2> 
			      </div> 
			    </div> 
			    <div class="row">'; 
                        if($videos->num_rows())
                        {
                            foreach ($videos->result() as $vid)
                            {
                               $yid = explode('=', $vid->video);
                              echo'
                              <div class="col-lg-'.$width.' col-xs-12" style="height:'.$height.'px; display:inline-block; margin-top:5px; margin-bottom:5px;"> 
                              	<center class="image">
                              	<img class="img-thumbnail" src="https://img.youtube.com/vi/'.$yid[1].'/hqdefault.jpg"" style="height:100%; width:100%;" data-link="'.$yid[1].'">
                            	</center>
                              </div> ';
                            }
                         
                        }
                        else
                        {
                          echo'<font color="red">No Data Available</font>';
                        }
                    echo'

                      </div>
                   </div><br>';
}
//========================================= End Video Gallery =============================

//==================================== get product gallery


// <div class="container"> 
//     <div class="col-md-4"> 
//       <div class="box_3"> <img alt="Electrical" class="img-responsive" src="images/electrical.png"> 
//         <div class="box_4"> <a href="#"></a><h3><a href="services.html">Our raceway offers complete solutions for wiring management systems.</a></h3> 
//           <p>Contemporarily designed and affordable, the raceways are functional for wire inclosure application in commercial, industrial &amp; residential environments. Our line of raceway includes a full complement of accessories so that wire management system can be 100% customized. To maintain power factor to unity which means to acheive demand in KVA.</p> <a href="services.html"><span class="more">More Reading  &nbsp;<img alt="Arrow" src="images/arrow.png"></span></a> 
//         </div> 
//       </div> 
//     </div> 
//     
//  </div>


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

            echo'<div class="container-fluid" style=" margin-bottom:50px; background:#f5feff;">
                  <div class="row"> 
				            <div class="col-md-12" style="text-align:center; padding:10px;"> <h2>'.$g->gallery_name.'</h2> 
				          </div> 
                  <div class="container">';
                   if($images->num_rows())
                  {
                      foreach ($images->result() as $img)
                      {
                $link = $img->product_link?$img->product_link:'javascript:void(0)" class="productQuery" data-proId="'.$img->id;
               echo'<div class="col-lg-'.$width.' col-md-'.$width.' col-sm-12"> 
      				<div class="box_3"> 
                            <img alt="Electrical" class="img-responsive" src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'" style="width:100%;height:300px">
                            <div class="box_4"> 
                				<h3>
                				<a href="javascript:void(0)">'.$img->title.'</a></h3> 
          						<p>'.$img->description.'</p>';
          						//<!--<a href="services.html"><span class="more">More Reading  &nbsp;<img alt="Arrow" src="images/arrow.png"></span></a>-->
          						if($btn->text) 
                         		 echo'<p> <center><a href="'.$link.'"><button class="prdBtn" type="button">'.$btn->text.'</button></a></center></p>';
                         		else if(substr($link,0,4)=='http')
                         		{
                         		echo'<a href="'.$link.'"><span class="more">More Reading  &nbsp;<img alt="Arrow" src="'.site_url('public/theme/'.FileDirecory.'/').'images/arrow.png"></span></a>';
                         		}
          					echo'</div>
                     </div>
                     <div class="clearfix">&nbsp;	</div> 
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


//===================================== end getproduct gallery ============================
//============================================ Get Form============================


function getForm($key)
{

  $CI= & get_instance();

    $f = $CI->FormModel->getFormModel(array('id'=>$key))->row();

    $fields  = json_decode($f->fields);



     echo'<div class="col-lg-12 unit-7 pricing-table-modern__item" align="none">



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

            

          </div>';

  }

//============== Get pop up form ===================


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

//==================== end popup =====================



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
//===================end get transactionform==========


//===============get Feature box ==================



function getFeatureBox($key)
{

  $CI= & get_instance();

    $f = $CI->SiteModel->getFeatureBox(array('id'=>$key))->row();

    $boxes  = json_decode($f->boxes);

    $width= round(12/$f->no,2);
    $size  = ($f->size+20); 
    $type= $f->type=='circle'?'border-radius:50%;':'';

    echo'<div class="container-fluid" style=" margin-bottom:50px; background:#f5feff;">
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
                              <a href="javascript:void(0)">'.$res->title.'</a></h3> 
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