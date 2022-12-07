<!DOCTYPE html>

<html lang="en">



<head>
    <?=$title?>

  <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">



  <title></title>

  <meta content="" name="descriptison">

  <meta content="" name="keywords">



  <!-- Favicons -->

  <link href="assets/img/favicon.png" rel="icon">

  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">



  <!-- Google Fonts -->

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">



  <!-- Vendor CSS Files -->

  <link href="<?=site_url('public/theme/'.FileDirecory)?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?=site_url('public/theme/'.FileDirecory)?>/assets/vendor/icofont/icofont.min.css" rel="stylesheet">

  <link href="<?=site_url('public/theme/'.FileDirecory)?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <link href="<?=site_url('public/theme/'.FileDirecory)?>/assets/vendor/venobox/venobox.css" rel="stylesheet">

  <link href="<?=site_url('public/theme/'.FileDirecory)?>/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <link href="<?=site_url('public/theme/'.FileDirecory)?>/assets/vendor/aos/aos.css" rel="stylesheet">



  <!-- Template Main CSS File -->

  <link href="<?=site_url('public/theme/'.FileDirecory)?>/assets/css/style.css" rel="stylesheet">



  <!-- =======================================================

  * Template Name: Ninestars - v2.0.0

  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/

  * Author: BootstrapMade.com

  * License: https://bootstrapmade.com/license/

  ======================================================== -->

</head>



<body>



  <!-- ======= Header ======= -->

  <header id="header" class="fixed-top">

    <div class="container-fluid d-flex">



      <div class="logo mr-auto">

        <h1 class="text-light"><a href="index.html"><span>Ninestars</span></a></h1>

        <!-- Uncomment below if you prefer to use an image logo -->

        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      </div>



      <nav class="nav-menu d-none d-lg-block">

          

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

                  function get_menu($items,$class = 'site-menu js-clone-nav d-none d-lg-block') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {

                          $_page_url = DefaultPage==$value['page_id']?'/':base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']);
                          $activeCss = getActiveMenu($value['page_id']);
                        if(array_key_exists('child',$value))

                          $html.= '<li class="drop-down"><a href="#" '.$value['target'].' class="menu-css '.$activeCss.'">'.$value['page_name'].'</a>'; 

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

          

          

          

        <!--ul>

          <li class="active"><a href="#header">Home</a></li>

          <li><a href="#about">About Us</a></li>

          <li><a href="#services">Services</a></li>

          <li><a href="#portfolio">Portfolio</a></li>

          <li><a href="#team">Team</a></li>

          <li class="drop-down"><a href="">Drop Down</a>

            <ul>

              <li><a href="#">Drop Down 1</a></li>

              <li class="drop-down"><a href="#">Drop Down 2</a>

                <ul>

                  <li><a href="#">Deep Drop Down 1</a></li>

                  <li><a href="#">Deep Drop Down 2</a></li>

                  <li><a href="#">Deep Drop Down 3</a></li>

                  <li><a href="#">Deep Drop Down 4</a></li>

                  <li><a href="#">Deep Drop Down 5</a></li>

                </ul>

              </li>

              <li><a href="#">Drop Down 3</a></li>

              <li><a href="#">Drop Down 4</a></li>

              <li><a href="#">Drop Down 5</a></li>

              <li class="drop-down"><a href="#">Drop Down 2</a>

                <ul>

                  <li><a href="#">Deep Drop Down 1</a></li>

                  <li><a href="#">Deep Drop Down 2</a></li>

                  <li><a href="#">Deep Drop Down 3</a></li>

                  <li><a href="#">Deep Drop Down 4</a></li>

                  <li><a href="#">Deep Drop Down 5</a></li>

                  <li class="drop-down"><a href="#">Drop Down 2</a>

                    <ul>

                      <li><a href="#">Deep Drop Down 1</a></li>

                      <li><a href="#">Deep Drop Down 2</a></li>

                      <li><a href="#">Deep Drop Down 3</a></li>

                      <li><a href="#">Deep Drop Down 4</a></li>

                      <li><a href="#">Deep Drop Down 5</a></li>

                      <li class="drop-down"><a href="#">Drop Down 2</a>

                        <ul>

                          <li><a href="#">Deep Drop Down 1</a></li>

                          <li><a href="#">Deep Drop Down 2</a></li>

                          <li><a href="#">Deep Drop Down 3</a></li>

                          <li><a href="#">Deep Drop Down 4</a></li>

                          <li><a href="#">Deep Drop Down 5</a></li>

                        </ul>

                      </li>

                    </ul>

                  </li>

                </ul>

              </li>

            </ul>

          </li>

          <li><a href="#contact">Contact Us</a></li>



          <li class="get-started"><a href="#about">Get Started</a></li>

        </ul-->

      </nav><!-- .nav-menu -->



    </div>

  </header><!-- End Header -->