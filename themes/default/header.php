</head>
{_body_}
{_topbar_widget_}
  <?php
  echo '<div class="site-wrap" style="background: white;">';
    
    
 
    if(THEME_ID == 12){
        ?>
        
        <div class="site-navbar bg-dark" >

            <div class="container">
    
              <div class="row align-items-center" style="font-size:20px">
                  <div class="col-md-6 col-lg-6">
                      
                  </div>
                  <div class="col-md-6 col-lg-6">
                      <a href="tel:{_contact_}">
                          <i class="fa fa-phone"></i> {_contact_}
                      </a>
                      <a href="mailto:{_email_}" style="margin-left:8px">
                          <i class="fa fa-envelope"></i> {_email_}
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

    

    
    <?php
    $container_class  =   THEME_ID == 12 ? ''  : 'container py-2';
    $row_class        =   THEME_ID == 12 ? ''  : 'row align-items-center';
    
    ?>
    <div class="site-navbar-wrap bg-white">

      <div class="site-navbar-top">

        <div class="<?=$container_class?>">

          <div class="<?=$row_class?>">

            <?php
            $header = $this->SiteModel->getHeader();
        
            if($header->num_rows() ):
                
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
                
                    <?php
                    if($logo = web_plugin('logo'))
                        echo '<img src="{_logo_}"   class="theme-12-logo">';
                    else
                        echo' <span class="fl-bigmug-line-cube29 mr-3 cube-bg"></span><span>Website</span>';
                    ?>
                  </a>
                </div>
                
                <?php
            else:
            ?>

            <div class="col-6 col-md-6 col-lg-2">

              <a href="<?=site_url()?>" class="d-flex align-items-center site-logo">
                
                <?php
                if($logo = web_plugin('logo'))
                {
                    echo '<img src="{_logo_}" {_logo_style_}>';
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

                  <a href="tel:{_contact_}">

                    <div class="d-flex align-items-center block-unit">

                      <div class="icon mr-0 mr-md-4">

                        <span class="fl-bigmug-line-cellphone55 h3"></span>

                      </div>

                      <div class="d-none d-lg-block">

                        <span class="d-block text-gray-500 text-uppercase">24/7 Support</span>

                        <span class="h6"><a href="tel:{_contact_}">{_contact_}</a></span>

                      </div>

                    </div>

                  </a>

                </li>





                <li class="text-left">

                  <a href="mailto:{_email_}">

                    <div class="d-flex align-items-center block-unit">

                      <div class="icon mr-0 mr-md-4">

                        <span class="fl-bigmug-line-email64 h5"></span>

                      </div>

                      <div class="d-none d-lg-block">

                        <span class="d-block text-gray-500 text-uppercase">Email</span>

                        <span class="h6"><a href="mailto:{_email_}">{_email_}</a></span>

                      </div>

                    </div>

                  </a>

                </li>

              </ul>

            </div>           

            <?php
            endif;
            ?>

          </div>

          

        </div>

      </div>


      <div class="site-navbar bg-dark " {_menubar_color_}>

        <!--<div class="container">-->

        <!--  <div class="row align-items-center">-->
            <div>
                
              <div>


            <div class="col-4 col-md-4 col-lg-12" style="padding:0">

              <nav class="site-navigation text-left" role="navigation">

                <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
                  <a href="#" class="site-menu-toggle js-menu-toggle">
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

                

                  <?php
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

                          $html.= '<li class=" "><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$iconWithTExt.'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'dropdown submenu-ul');

                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }

                //   echo '<pre>';
                //   print_r($menu_items);
                //   exit;
                  print get_menu($menu_items,'site-menu js-clone-nav d-none d-lg-block menu-'.$group_id);

                  ?>

              </nav>

            </div>



          </div>

        </div>

      </div>

    </div>
    
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


