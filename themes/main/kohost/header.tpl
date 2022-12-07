<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--favicon icon-->
    <link rel="icon" href="<?=base_url('upload/bizknowindiaLogo.jpeg')?>" type="image/png" sizes="16x16">

    <!--title-->
    <title>{title}</title>

    <!--build:css-->
    <link rel="stylesheet" href="<?=theme_base()?>assets/css/main.css">
    <!-- endbuild -->
    <script src="<?=theme_base()?>assets/js/vendors/jquery-3.5.1.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?=theme_base()?>assets/all.min.css?v=a1db48">
    <link rel="stylesheet" type="text/css" href="<?=theme_base()?>assets/style.css">
    <link href="<?=theme_base()?>assets/custom.css?v=a1db48" rel="stylesheet">
    
    <link href="<?=theme_base()?>assets/customStyle.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/all.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    
    
        <link rel="stylesheet" href="<?=base_url('static')?>/icon-picker/dist/fontawesome-5.11.2/css/all.min.css">
    <script>
        toastr.options = {
              "closeButton": true,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-bottom-center",
              "preventDuplicates": false,
              "onclick": null,
              "timeOut": "5000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
    </script>
    
    <style>
        a.login-btn:hover,a.sign-up-btn:hover{
            background:#083c96!important;
        }
        a.sign-up-btn ,a.cart-btn{
                color: white!important;
        }
        .page-header-section {
            padding: 84px 0 40px 0;
        }
        span.cart-count {
            position: absolute;
            bottom: -20px;
            left: 5px;
            width: 43px;
        }
        .bg-transparent.affix {
            background: #931818 !important;
        }
        .btn-outline-brand-02 {
            border-color: #931818!important;
            color: #931818!important;
        }
        .btn-outline-brand-02:hover {
            background-color: #931818!important;
            color: #fff!important;
        }
        .btn-outline-brand-01 {
            border-color: #931818!important;
            color: #931818!important;
        }
        .btn-outline-brand-01:hover ,a.sign-up-btn:hover,a.login-btn:hover{
            background-color: #931818!important;
            color: #fff!important;
        }
        .btn-brand-01 {
            background-color: #931818!important;
            border-color: #931818!important;
            color: #fff;
        }
        .btn-brand-01:hover {
            background-color: #fff!important;
            color: #931818!important;
        }
        .gradient-overlay:before {
            background-color: #BF0000!important;
        }
        #order-standard_cart .order-summary{
            background-color: #bf0000 !important;
            border-bottom: 4px solid #7c0909 !important;
        }
        .dataTables_wrapper .dataTables_info, #order-standard_cart .view-cart-items-header {
            background-color: #7c0909 !important;
            border: 1px solid #7c0909;
            color: hsla(0,0%,100%,.64);
        }
        @media (max-width: 767px){
            .bg-transparent .header-nav #navBar.navbar-collapse, .gradient-bg .header-nav #navBar.navbar-collapse {
                background: linear-gradient(75deg, #931818 10%, #BF0000) !important;
            }
        }
        @media (min-width: 768px){
            .navbar-expand-md .main-navbar-nav .custom-nav-link {
                 padding-top: 0!important; 
                 padding-bottom: 0!important; 
                 padding-right: 0.5rem!important; 
                 padding-left: 0.5rem!important; 
            }
        }
    </style>
</head>

<body>

    <!--preloader start-->
    <div id="preloader">
        <div class="preloader-wrap">
            <img src="<?=config_item('admin_logo')?>" alt="logo" class="img-fluid" />
            <div class="preloader">
                <i>.</i>
                <i>.</i>
                <i>.</i>
            </div>
        </div>
    </div>
    <!--preloader end-->
    <!--header section start-->
    <div id="header-top-bar" class="top-bar gray-light-bg pb-1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 col-lg-5 d-none d-lg-block d-md-block">
                    <ul class="list-unstyled list-inline topbar-nav topbar-nav-left">
                        <?php
                        $left_topbar = Modules :: run('addons/get_links','left_topbar');
                        if($left_topbar->num_rows()){
                            foreach($left_topbar->result() as $link){
                                $icon = empty($link->icon) ? '' : '<i class="'.$link->icon.' mr-1"></i>'; 
                                echo '<li class="list-inline-item">'.$icon.' <a href="'.$link->value.'">'.$link->index.'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-7">
                    <ul class="list-unstyled list-inline topbar-nav topbar-nav-right text-lg-right">
                        <?php
                        $right_topbar = Modules :: run('addons/get_links','right_topbar');
                        if($right_topbar->num_rows()){
                            foreach($right_topbar->result() as $link){
                                $icon = empty($link->icon) ? '' : '<i class="'.$link->icon.' mr-1"></i>'; 
                                echo '<li class="list-inline-item"> <a href="'.$link->value.'">'.$icon.' '.$link->index.'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <header id="header" class="header-main position-relative">
        <!--main header menu start-->
        <div id="logoAndNav" class="main-header-menu-wrap bg-transparent fixed-top">
            <div class="container">
                <nav class="js-mega-menu navbar navbar-expand-md header-nav">

                    <!--logo start-->
                    <a class="navbar-brand pt-0" href="/"><img src="<?=config_item('admin_logo')?>" style="width: 201px;" alt="logo" class="img-fluid" /></a>
                    <!--logo end-->

                    <!--responsive toggle button start-->
                    <button type="button" class="navbar-toggler btn" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
                        <span id="hamburgerTrigger">
                          <span class="ti-menu"></span>
                        </span>
                    </button>
                    <!--responsive toggle button end-->

                    <!--main menu start-->
                    <div id="navBar" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto main-navbar-nav">
                            <!--home start-->
                            <li class="nav-item hs-has-mega-menu custom-nav-item" data-position="center">
                                <a id="homeMegaMenu" class="nav-link custom-nav-link" href="/" aria-haspopup="true" aria-expanded="false">Home</a>
                            </li>
                            <?php
                            echo Modules :: run('page/menu');
                            ?>
                            
                        </ul>
                        <ul class="nav navbar-right secondary-nav">
                            
                            <?php
                            if($this->session->has_userdata('CLIENT_LOGIN')){
                                ?>
                                
                                <li menuitemname="Account" class="dropdown account primary-action" id="Secondary_Navbar-Account">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <i class="fas fa-user"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li menuitemname="Profile">
                                                    <a href="#" class="user-name">
                                                        Hello, John!
                                                        <span>demo@themetags.com</span>
                                                    </a>
                                                </li>
                                                <li menuitemname="Edit Account Details" id="Secondary_Navbar-Account-Edit_Account_Details">
                                                    <a href="/clientarea.php?action=details">
                                                        My Details
                                                    </a>
                                                </li>
                                                <li menuitemname="Logout" id="Secondary_Navbar-Account-Logout">
                                                    <a href="/web/logout">
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                    </li>
                                <?php
                            }
                            else{
                            ?>
                                <li class="primary-action">
                                    <a href="/register"  class="sign-up-btn">Sign Up</a>
                                </li>
                                
                                <li class="primary-action">
                                    <a href="/clientarea"  class="login-btn">Login</a>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="primary-action" style="padding-left: 16px;margin-top: -13px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Cart">
                                <a href="/cart/?a=view" class="cart-btn"> 
                                
                                    <span class="cart-count"><?php echo $count = $this->cart->total_items();?> <?=huminize_word('item',$count)?></span>
                                    <i class="fas fa-shopping-basket" ></i></a>
                            </li>
                        </ul>
                    </div>
                    <!--main menu end-->
                </nav>
                
            </div>
        </div>
        <!--main header menu end-->
    </header>
    <!--header section end-->

    <div class="main">
