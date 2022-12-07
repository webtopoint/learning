<!doctype html>
<html class="no-js" lang="en">

    <head>
        <!-- META DATA -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
		
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
		
		<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
		
        <!-- TITLE OF SITE -->
        <?=web_plugin('title_tag')?>

        <!-- for title img -->
		<?=web_plugin('favicon')?>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="<?=theme_assets('assets')?>/css/font-awesome.min.css">
		
		<!--linear icon css-->
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
		
		<!--animate.css-->
        <link rel="stylesheet" href="<?=theme_assets('assets')?>/css/animate.css">
		
		<!--hover.css-->
        <link rel="stylesheet" href="<?=theme_assets('assets')?>/css/hover-min.css">
		
		<!--vedio player css-->
        <link rel="stylesheet" href="<?=theme_assets('assets')?>/css/magnific-popup.css">

		<!--owl.carousel.css-->
        <link rel="stylesheet" href="<?=theme_assets('assets')?>/css/owl.carousel.min.css">
		<link href="<?=theme_assets('assets')?>/css/owl.theme.default.min.css" rel="stylesheet"/>


        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="<?=theme_assets('assets')?>/css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link href="<?=theme_assets('assets')?>/css/bootsnav.css" rel="stylesheet"/>	
        
        <!--style.css-->
        <link rel="stylesheet" href="<?=theme_assets('assets')?>/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="<?=theme_assets('assets')?>/css/responsive.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
	
	<body>
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

		
		
		
		<!--header start-->
		<section class="header">
			<div class="container">	
				<div class="header-left">
					<ul class="pull-left">
					    <?
					    if($mobile = extra_setting('topbar_mobile')):
					    ?>
						<li>
						    
							<a href="tel:<?=$mobile?>">
								<i class="fa fa-phone" aria-hidden="true"></i> <?=$mobile?>
							</a>
						</li><!--/li-->
						<?
						endif;
						if($gmail = extra_setting('topbar_gmail')):
						?>
						<li>
							<a href="mailto:<?=$gmail?>">
								<i class="fa fa-envelope" aria-hidden="true"></i> <?=$gmail?>
							</a>
						</li><!--/li-->
					    <?
					    endif;
					    ?>
					</ul><!--/ul-->
				</div><!--/.header-left -->
				<div class="header-right pull-right">
					<ul>
						<li>
							<div class="social-icon">
								<ul>
									<!--<li><a href="#"><i class="fa fa-facebook"></i></a></li>-->
									<!--<li><a href="#"><i class="fa fa-google-plus"></i></a></li>-->
									<!--<li><a href="#"><i class="fa fa-linkedin"></i></a></li>-->
									<!--<li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
									<?
									 echo print_social_input('topbar',[ 'facebook', 'twitter', 'youtube', 'instagram' ]);
									?>
								</ul><!--/.ul -->
							</div><!--/.social-icon -->
						</li><!--/li -->
					</ul><!--/ul -->
				</div><!--/.header-right -->
			</div><!--/.container -->	

		</section><!--/.header-->	
		<!--header end-->
		
		<!--menu start-->
		<section id="menu">
			<div class="container">
				<div class="menubar">
					<nav class="navbar navbar-default">
					
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="/" style="width: 170px;margin-top: 6px;">
								<img src="<?=web_plugin('logo')?>" alt="logo">
							</a>
						</div><!--/.navbar-header -->

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						    
						    <?
						    function get_menu($items,$class = 'site-menu js-clone-nav d-none d-lg-block') {

            
            
                                  $html = "<ul class=\"".$class."\" id=\"menu-id\">";
            
            
            
                                  foreach($items as $key=>$value) {
                                      $_page_url = DefaultPage==$value['page_id']?'/': $value['url'];
                                      $activeCss = getActiveMenu($value['page_id'],'active',true);
            
                                      if($value['type'] == 'category'){
                                        $_page_url = base_url.'/category/'.get_instance()->NewsModel->getCategorylink($value['page_id']);
                                        $activeCss = getActiveMenu($value['page_id'],'active-menu',true);
                                      }
                                      
                                    $iconWithTExt =  $value['label'];
                                      
                                    // if(array_key_exists('child',$value))
            
                                    //   $html.= '<li class="has-children '.$activeCss.'"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css">'.$iconWithTExt.'</a>'; 
            
                                    // else
            
                                      $html.= '<li class="'.$activeCss.'"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css ">'.$iconWithTExt.'</a>';
            
                                                 
            
                                    //   if(array_key_exists('child',$value))
            
                                    //       $html .= get_menu($value['child'],'dropdown submenu-ul');
            
                                      $html .= "</li>";
            
                                  }
            
                                  $html .= "</ul>";
            
            
            
                                  return $html;
            
            
            
                              }
            
                              $group = $this->MenuModel->get_menu_groups([],1,0,1);
                             $this->group_id = $group_id = ($group->num_rows()) ? $group->row()->id : 0;
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
                             print get_menu($items,'nav navbar-nav navbar-right menu-'.$this->group_id);
						    
						    
						    ?>
						    
						    
						    
						</div><!-- /.navbar-collapse -->
					</nav><!--/nav -->
				</div><!--/.menubar -->
			</div><!-- /.container -->

		</section><!--/#menu-->
		<!--menu end-->
		<?php
		$this->load->module('sliders');
		$getSlider = $this->sliders->getAll();
	
		if($getSlider->num_rows() AND $page_id == DefaultPage):
		?>
		<!-- header-slider-area start -->
		<section class="header-slider-area">
			<div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">
			
			  <!-- Indicators -->
				<ol class="carousel-indicators">
				    <?php
				    $i = 0;
				    foreach($getSlider->result() as $slider){
				        $active = $i ? '' : 'active';
				        echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i++.'" class="'.$active.'"></li>';
				    }
				    ?>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
				    <?php
				    $i = 1;
				    foreach($getSlider->result() as $slider){
				        $active = $i == 1 ? 'active' : '';
				        ?>
					<div class="item <?=$active?>">
						<div class="single-slide-item slide-<?=++$i?>" style="background-image:url('<?=client_file($slider->image)?>')">
							<div class="container">
								<div class="row">
									<div class="col-sm-12">
										<div class="single-slide-item-content">
											<?=$slider->content?>
											
										</div><!-- /.single-slide-item-content-->
									</div><!-- /.col-->
								</div><!-- /.row-->
							</div><!-- /.container-->
						</div><!-- /.single-slide-item-->
					</div><!-- /.item .active-->
				    <?php
				    }
				    ?>
				</div><!-- /.carousel-inner-->
                
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="lnr lnr-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="lnr lnr-chevron-right"></span>
				</a>
			</div><!-- /.carousel-->

		</section><!-- /.header-slider-area-->
		<!-- header-slider-area end -->
		<?php
		endif;
		//endslider
		?>
	