<?
$webdata=$CI->SiteModel->getWebsiteData();
$title=$logo=$contact=$email="";
$boxLayout = [];
if($webdata->num_rows())
{
     $wdata = $webdata->row();
    // echo '<pre>';
    // print_r($wdata);
    // echo '</pre>';
    // exit;
    if($wdata->favicon)
       echo '<link rel="icon" href="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->favicon.'" type="image/gif" sizes="16x16">';
    if($wdata->logo){
        $logo=base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->logo;
        define('logo',$logo);
    }
        
    if($wdata->contact)
        $contact= json_decode($wdata->contact)[0];
        
    if($wdata->email)
        $email= json_decode($wdata->email)[0];
    
    if($wdata->box_layout)
       $boxLayout = json_decode($wdata->box_layout);
    $title=$wdata->title;
    define('title',$title);
}
?>
<!DOCTYPE html>
<html lang="fr">
<html class="no-js" lang="en">

<!-- Mirrored from www.thelastbreaking.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 10:11:30 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge"> 
<title>Latest News from India The Last Breaking Hindi Samachar | The Last Breaking News</title>
<meta name="author" content="" />
<meta name="description" content="The Last breaking: Hindi news (हिंदी समाचार) website, watch video, Breaking news in Hindi from India, World, Education, Career, Jobs, Entertainment, Dharma and Astrology" />
<meta name="keywords" content="" />
<meta property="og:title" content="Latest news of india">
<meta property="og:site_name" content="Latest news of india">
<meta property="og:url" content="index.html">
<meta property="og:description" content="The Last breaking: Hindi news (हिंदी समाचार) website, watch video, Breaking news in Hindi from India, World, Education, Career, Jobs, Entertainment, Dharma and Astrology">
<meta property="og:type" content="article">
<meta property="og:image" content="images/logo.webp"><meta name="viewport" content="width=device-width, initial-scale=1">

 
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">
<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/assets/bootstrap.min.css">
<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/assets/font-awesome.min.css">
<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/assets/normalize.css">
<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/style.css">
<link rel="stylesheet" href="<?=site_url('public/theme/'.FileDirecory)?>/css/assets/responsive.css">
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/assets/vendor/jquery-1.12.4.min.js"></script> 
<link rel="stylesheet" href="<?=site_url('public/')?>A-ticker/style.min.css">
<script src="<?=site_url('public/')?>A-ticker/ticker-jquery.min.js"></script> 


<script type="text/javascript">
  $(".index-hide").hide();
</script>

</head>
<body>
  
    
    
    
    
<!--<div class="preloader">-->
<!--  <div class="load-list">-->
<!--    <div class="load"></div>-->
<!--    <div class="load load2"></div>-->
<!--  </div>-->
<!--</div>-->


    <div class="header-main">
    	<div class="container">
        	<div class="row">
        	   <div class="MobHeadTop hidden-lg">
        	       
        	     <div class="col-xs-2"><a class="login-icon" href="#"><i class="fa fa-user"></i></a></div>
        	     <div class="col-xs-8"> <div class="mob-header"><a href="<?=base_url?>"><?=$title?></a></div></div>
        	     <div class="col-xs-2"><button class="openBtn" onclick="openSearch()"><i class="fa fa-search"></i></button></div>
                </div>
        	    <div class="clearfix"></div>
        		<div class="col-md-3">
        			<div class="header-btn hidden-xs">
        			    <a href="#"><?
        			        echo date('l d M, Y');
        			    ?></a>
        				<!--<a href="#">Log in</a> -->
        			</div>
        		</div>
        		<div class="col-md-6"><h2 class="hidden-xs"><a href="<?=base_url?>"><?=$title?></a></h2></div>
        		<div class="col-md-3 hidden-xs"><button class="openBtn" onclick="openSearch()"><i class="fa fa-search"></i></button></div>
        	</div>
    	</div>
    </div>
	<div id="myOverlay" class="overlay">
      <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
      <div class="overlay-content">
        <div class="container">
            <div class="col-md-8 offset-2">	
            	<form action="https://www.thelastbreaking.com/search" method="post">
                  <input type="text" placeholder="Search.." name="search">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
    	</div>
      </div>
    </div>

<div class="clearfix"></div>
<div class="clearfix"></div>
<section class="menu-area navbar-expand-sm sticky-top">
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="main-menu">
            
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

                  function get_menu($items,$class = 'list-unstyled list-inline', $homeImage = false) {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";

                        if($homeImage){
                             $title = (defined('title')) ? title : '';
                             $logo = (defined('logo')) ? logo : '';
                            
                                $html .= '<li class="list-inline-item"><a href="'.base_url.'"><img class="main-logo" src="'.$logo.'" alt="'.$title.'"></a></li>';
                        }
                        
                      foreach($items as $key=>$value) {

                          $_page_url = DefaultPage==$value['page_id']?'/':(base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']));
                          $activeCss = getActiveMenu($value['page_id']);

                          if($value['type'] == 'category'){
                            $_page_url = base_url.'/category/'.get_instance()->NewsModel->getCategorylink($value['page_id']);
                            $activeCss = getActiveMenu($value['page_id'],'active-menu',true);
                          }
                          
                        if(array_key_exists('child',$value))

                          $html.= '<li class="list-inline-item"><a href="#" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>'; 

                        else

                          $html.= '<li class="list-inline-item"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'dropdown list-unstyled',false);





                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }

                   

                  print get_menu($items,'list-unstyled list-inline',true);

        ?>
          
        </div>
      </div>
      
      <div class="col-md-3">
        <div class="clock text-right"> 
    		<ul class="social-footer social-top">
    		    <li><a href="https://www.facebook.com/" target="_blank"><img src="<?=site_url('public/theme/'.FileDirecory)?>/images/facebook.svg" alt=""></a></li>
                <li><a href="https://twitter.com/" target="_blank"><img src="<?=site_url('public/theme/'.FileDirecory)?>/images/twitter.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/" target="_blank"><img src="<?=site_url('public/theme/'.FileDirecory)?>/images/instagram.svg" alt=""></a></li>
                <li><a href="https://www.youtube.com/" target="_blank"><img src="<?=site_url('public/theme/'.FileDirecory)?>/images/youtube.svg" alt=""></a></li>
    			<li><a href="https://t.me/" target="_blank"><img src="<?=site_url('public/theme/'.FileDirecory)?>/images/telegram.svg" alt=""></a></li>
					      
		      
		      
		      
   <!--       <li><a href="https://www.facebook.com/thelastbreaking/" target="_blank"><img src="https://www.thelastbreaking.com/images/facebook.svg" alt=""></a></li>-->
   <!--       <li><a href="https://twitter.com/thelastbreaking" target="_blank"><img src="https://www.thelastbreaking.com/images/twitter.svg" alt=""></a></li>-->
          <!--<li><a href="#"><img src="https://www.thelastbreaking.com/images/linkedin.svg" alt=""></a></li>-->
   <!--       <li><a href="https://www.instagram.com/thelastbreaking" target="_blank"><img src="https://www.thelastbreaking.com/images/instagram.svg" alt=""></a></li>-->
   <!--       <li><a href="https://www.youtube.com/channel/UCZ0bq6OC-cHuc7JVEC02A2w" target="_blank"><img src="https://www.thelastbreaking.com/images/youtube.svg" alt=""></a></li>-->
			<!--<li><a href="https://t.me/thelastbreaking" target="_blank"><img src="https://www.thelastbreaking.com/images/telegram.svg" alt=""></a></li>-->
			
			
           </ul>
		</div>
      </div>
      
      
    </div>
    
  </div>
</section>
<div class="clearfix"></div>
<div class="wrapper hidden-lg">
<nav>
  <label for="toggleMainNav" class="hamburger-menu"></label>
  <input type="checkbox" id="toggleMainNav" class="check-toggle">
  <label for="toggleMainNav" class="menu-overlay"></label>
  <div class="main-nav-holder">
    <ul class="main-nav">
            <li class="close-nav">
               <label for="toggleMainNav"></label>
            </li>
            
            <?
            

                        
            function get_Mobile_menu($items,$class = 'submenu1',$icon = FALSE) {


                      foreach($items as $key=>$value) {

                          $_page_url = DefaultPage==$value['page_id']?'/':(base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']));
                          $activeCss = getActiveMenu($value['page_id']);

                          if($value['type'] == 'category'){
                            $_page_url = base_url.'/category/'.get_instance()->NewsModel->getCategorylink($value['page_id']);
                            $activeCss = getActiveMenu($value['page_id'],'active-menu',true);
                          }
                        $closeIcon = $icon ? ' <i class="fa fa-minus" aria-hidden="true"></i> ' : '';
                        if(array_key_exists('child',$value))

                          $html.= '<li><a href="#" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>'; 

                        else

                          $html.= '<li><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$closeIcon.$value['page_name'].'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_Mobile_menu($value['child'],'submenu1',TRUE);





                          $html .= "</li>";

                      }



                      return $html;



                  }            
            print get_Mobile_menu($items);
            ?>
            
      
      
    </ul>
  </div>
</nav>
<div class="MobileRightSec">
<div class="mobileLogo">
    <?
            
            echo '<a href="'.base_url.'"><img class="img-fluid" src="'.$logo.'" alt="'.$title.'"></a>';
    ?>
    
    </div>
<div class="mobileDate">   				<? echo date('l d M, Y');?>			 </div></div>
</div>





<!--<section class="news-area">-->
<!--<div class="container">-->
<!--<div class="row">-->
<!--  <div class="col-md-12">-->
<!--    <div class="tab-box d-flex justify-content-between">-->
<!--      <div class="sec-title">-->
<!--        <h5><a href="#"></a></h5>-->
<!--        <ul class="sub-cat-menu car-menu">-->
<!--                      <li><a href="<?=base-Url?>/category/crime">crime</a></li>-->
                    
<!--        </ul>-->
        
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--  <div class="container">-->
<!--    <div class="latest-news">-->
<!--      <div class="tab-content">-->
<!--        <div class="tab-pane fade show active" id="tech" role="tabpanel">-->
<!--          <div class="row">-->
<!--            <div class="col-md-4">-->
<!--              <div class="lt-item-bg"> <img src="https://img.youtube.com/vi/OQ2jPQ4rvXU/hqdefault.jpg" alt="" class="img-fluid">-->
<!--                <div class="over-img-con">-->
<!--                  <h6><a href="https://leloonline.in/post/BWZYOg==/test--blog-category/UzE=">-->
<!--                    Test blog category                                    </a></h6>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
                           
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--              <div class="more-news">-->
<!--                <div class="latest-news-top new-4Col">-->
<!--                  <ul>-->
                      
<!--                  </ul>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="vire-more-btn"> <a href="#">View All</a> </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!--</div></section>-->






<?
 $ticker = $this->NewsModel->frontTicker();

        if($ticker->num_rows()){
            
            foreach($ticker->result() as $tick)
                getNewsTicker($tick->id);
        }
function  get_newsSlider($content = ''){
    $CI = get_instance();
    if(!empty($content)){
        $content = json_decode($content,true);
        ?>
        <style>
            .slider-layer {
                position: absolute;
                bottom: 20px;
                height: 100px;
                padding: 10px;
                width: 100%;
            }
            .owl-carousel .owl-item img{
                height:322px!important;
            }
            .slider-layer .list-unstyled.list-inline .list-inline-item{
                background: #ca0000;
                color: white;
                padding: 2px 10px;
                border-radius: 5px;
                box-shadow:0 0 100px 0 black;
            }
            .slider-layer p a{
                font-size:1.5em;
                color:white;
                font-weight:700;
                text-shadow:0 0 10px black;
            }
             .owl-carousel .owl-nav .owl-prev, .owl-carousel .owl-nav .owl-next{
                position: absolute;
                background: #ca0000;
                top: 40%;
                padding: 5px 10px;
                font-size: 2em;
                color: white;
            }
            .owl-carousel .owl-nav .owl-next{
                right:0;
            }
        </style>
        <?
   
        if(isset($content['category']) && isset($content['number_of_post'])){
            $cats = $content['category'];
            $num = $content['number_of_post'];
            echo '<div class="owl-carousel owl-slider">';
             foreach( $CI->NewsModel->getNewsViaMultiCategory($cats,$num,TRUE)->result() as $post){
                        $cat = $CI->NewsModel->get_category(['id'=>$post->cat_id])->row();
                echo '<div class="slider-content"> <img src="'.$CI->NewsModel->PostThumb($post->post_id).'" alt="" class="img-fluid">
                            <div class="slider-layer">
                              <ul class="list-unstyled list-inline">
                                <li class="list-inline-item">
                                  '.$cat->name.'                </li>
                              </ul>
                              <p><a href="'.$CI->NewsModel->postLink($post->post_id,$cat->id,$cat->name).'">
                               '.$post->title.'  </a></p>
                            </div>
                        </div>';
            }
            echo '</div>';
        }
        
    }
}

function get_titleNewsGRIDView( $content = '' ){
    
    $CI = get_instance();
    if(!empty($content)){
        $content = json_decode($content,true);
   
        if(isset($content['category']) && isset($content['number_of_post'])){
            $cats = $content['category'];
            $num = $content['number_of_post'];
            
            foreach( $CI->NewsModel->getNewsViaMultiCategory($cats,$num,TRUE)->result() as $post){
                $cat = $CI->NewsModel->get_category(['id'=>$post->cat_id])->row();
                echo '<div class="lt-item-sm d-flex">
                        <div class="lt-img small-thumb"> <a href="'.$CI->NewsModel->postLink($post->post_id,$cat->id,$cat->name).'"> 
                        <img src="'.$CI->NewsModel->PostThumb($post->post_id).'" alt="'.$post->title.'"></a> </div>
                        <div class="img-content">
                          <p><a href="'.$CI->NewsModel->postLink($post->post_id,$cat->id,$cat->name).'">'.$post->title.'                    </a></p>
                        </div>
                    </div>';
            }
        }
    }
}

function  get_titleNewsList($content = ''){
    $CI = get_instance();
    if(!empty($content)){
        $content = json_decode($content,true);
   
        if(isset($content['category']) && isset($content['number_of_post'])){
            $cats = $content['category'];
            $num = $content['number_of_post'];
            echo '
                <div class="latest-news-top">
                  <ul class="main-news">';
                    foreach( $CI->NewsModel->getNewsViaMultiCategory($cats,$num,TRUE)->result() as $post){
                        $cat = $CI->NewsModel->get_category(['id'=>$post->cat_id])->row();
                        echo    '<li> 
                                    <span>'.$cat->name.'</span> 
                                    <a href="'.$CI->NewsModel->postLink($post->post_id,$cat->id,$cat->name).'">'.$post->title.'</a>
                                 </li>';
                    }
            echo '
                </ul>
            </div>';
        }
    }
}

function getNewsTicker($key){
    
    $CI = get_instance();
    
    $ticker = $CI->NewsModel->getTicker($key);
    if($ticker->num_rows()):
        
        $ticker = $ticker->row();
        
        $titleCss = (isJson($ticker->title_css)) ? (array) json_decode($ticker->title_css) : [];
        $NewsCss  = (isJson($ticker->cats_css)) ? (array) json_decode($ticker->cats_css) : [];
        $addons  = (isJson($ticker->addons)) ? (array) json_decode($ticker->addons) : [];
        
        $cats = (isJson($ticker->cats)) ? (array) json_decode($ticker->cats) : [];
        
        $duration = isset($addons['anim_duration'])
                    ?  $addons['anim_duration']
                    : 200;
        
        if(count($cats) > 0 && isset($addons['numPost'])) :
            
		    $news = $CI->NewsModel->getNewsViaMultiCategory($cats,$addons['numPost'],true);
		    $styleWRAP = '';
		    if($addons['position'] == 'top'){
		        $styleWRAP = 'position:fixed;top:0;z-index:2;';
		        ?>
		        <style>
		            .menu-area,.wrapper.hidden-lg.sticky {
		                top:35px!important;
		            }
		            .header-main {
		                margin-top:35px!important;
		            }
		        </style>
		        <?
		    }
		    if($addons['position'] == 'bottom'){
		        $styleWRAP = 'position:fixed;bottom:0;z-index:2;';
		        ?>
		        <style>
		            footer.footer-area{
		                margin-bottom:35px!important;
		            }
		        </style>
		        <?
		    }
		    
		    echo '<style>#wrap-div-'.$key.' .jctkr-label{';
		           foreach($titleCss as $index => $title)
		                echo $index .':'.$title.';';
		    echo '}#wrap-div-'.$key.' .jctkr-wrapper{
		                background:'.$NewsCss['background'].';
		            }
		           #wrap-div-'.$key.' .jctkr-wrapper ul li a{
    		           font-size:'.$NewsCss['font-size'].'px;
    		           color:'.$NewsCss['color'].';
		        
		    }</style>';
		    
		    ?>
		    <div class="wrap" id="wrap-div-<?=$key?>" style="<?=$styleWRAP?>left:0;border-radius:0">
                <div class="jctkr-label">
                     <strong><?=$ticker->title?></strong>
                </div>
                <div class="js-conveyor-example jctkr-wrapper jctkr-initialized">
                    <ul style="width: 1561px; left: -292.688px;">
                        
                        <?
                        foreach($news->result() as $list):
                            $cat = $CI->NewsModel->get_category(['id'=>$list->cat_id])->row();
                            $thumb = $addons['thumbanail'] == 'show' ? '<img style="width:25px" src="'.$CI->NewsModel->PostThumb($list->post_id).'">'  : '';
                        ?>
                            <li style="margin-top:-5px">
                              <a href="<?=$CI->NewsModel->postLink($list->post_id,$cat->id,$cat->name)?>">
                                <span><?=$thumb?> <?=$list->title?></span>
                              </a>
                            </li>
                        <?
                        endforeach;
                        ?>
                        
                    </ul>
                </div>
            </div>
            <script>
              $(function() {
                $('#wrap-div-<?=$key?>').find('.js-conveyor-example').jConveyorTicker({
                    reverse_elm: true,
                    anim_duration: <?=$duration?>
                    
                });
              });
            </script>
		    <?
		endif;
    endif;
}

function  get_thumbnailNewsList($content = ''){
    $CI = get_instance();
    if(!empty($content)){
            $content = json_decode($content,true);
   
        if(isset($content['category']) && isset($content['number_of_post'])){
            $cats = $content['category'];
            $num = $content['number_of_post'];
           
            foreach( $CI->NewsModel->getNewsViaMultiCategory($cats,$num,TRUE)->result() as $post){
                $cat = $CI->NewsModel->get_category(['id'=>$post->cat_id])->row();
                echo '  <div class="top-video-small mob-img-txt"> 
                            <img src="'.$CI->NewsModel->PostThumb($post->post_id).'">
                            <div class="head-text"> 
                	            <div class="over-img-con">		  
                	                <a href="'.$CI->NewsModel->postLink($post->post_id,$cat->id,$cat->name).'">
                                        <h3>'.$post->title.'</h3>
                                    </a> 
                                </div>
                			</div>
                        </div>';
            }
        }
    }
    
}


?>