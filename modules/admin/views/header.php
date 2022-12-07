<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
    <meta http-equiv="Content-Language" content="en">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    



    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <meta name="description" content="">

    <meta name="msapplication-tap-highlight" content="no">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="<?=site_url('public/web/')?>main.css" rel="stylesheet">

    <link href="<?=site_url('public/web/')?>style.css" rel="stylesheet"></head>
    
    
    <style>
    .tox .tox-notification--warn, .tox .tox-notification--warning {
        display:none!important;
    }
    .widget-heading{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: 129px;
    }
    
		@font-face 
		{  
		    font-family: "KundliNormal"; /* font name for the feature use*/
		    src: url(("<?=base_url.('/public/custom/fonts/')?>fonts/kundli.ttf");   
		    src: local("KundliNormal"), url("<?=base_url.('/public/custom/fonts/')?>KundliNormal.ttf") format("truetype"); /*non-IE*/  
		}
        p.heading{
            margin-top: 7px!important
        }
        .heading input {
            font-weight: bold;
            font-size: 22px;
            padding: 5px;
            width: 100%;
            border: 0px;
            outline: 0px;
        }
        .rounded-circle {
            border: 2px  solid white;
        }
        .top-number{
               position: absolute;
                top: -8px;
                border-radius: 50%;
                min-width: 16px;
                height: 25px;
                padding: 10px;
                left: 30px;
                background: white;
                color: black;
                text-align: center;
                line-height: 0;
        }
        
       
	</style>
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>

    <script type="text/javascript" src="<?=site_url('public/web/')?>assets/scripts/main.js"></script>

    <script src="<?=site_url('public/web/')?>jquery.min.js"></script>

    <script src="<?=site_url('public/web/')?>jquery.nestable.js"></script></body>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <!-- Font library -->

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,400;0,700;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">


    <!-- ================================================== -->
    <!-- ============================== TAG ========================-->

    <link rel="stylesheet" href="<?=base_url.'/public/tagify-master/dist/jquery.tagsinput.css'?>">
    <script type="text/javascript" src="<?=base_url.'/public/tagify-master/dist/jquery.tagsinput.js'?>"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- ================================================================ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script src="<?=base_url.'/public/custom/ckeditor/ckeditor.js'?>"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.js"></script>
    <link href="<?=base_url.'/custom/admin-custom.css'?>">
    
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/1.2.18/jquery.webui-popover.css" integrity="sha512-cCFi/2BEpaQF3bVAoIKzDSnrHaAzj2UMeNIB1K5JO/Zq07dqFwQOxYCcnCYIRrdxIcN8acc2oVK4AYsqLmMiZg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/1.2.18/jquery.webui-popover.min.js" integrity="sha512-c7jfqR4Yc1iFS3KA+EceHmO91hjSfqNZ6cu00AKBE62BmQq7EOoCVGGwjV/OoaEG1teTU9nY6gBuToAzFfxMSw==" crossorigin="anonymous"></script>
    
    <input type="hidden" id="base_url" value="<?=base_url()?>">
    <script type="text/javascript">var base_url = $('#base_url').val(); $Myalert = 0; </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js" integrity="sha512-bUg5gaqBVaXIJNuebamJ6uex//mjxPk8kljQTdM1SwkNrQD7pjS+PerntUSD+QRWPNJ0tq54/x4zRV8bLrLhZg==" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.css" integrity="sha512-DanfxWBasQtq+RtkNAEDTdX4Q6BPCJQ/kexi/RftcP0BcA4NIJPSi7i31Vl+Yl5OCfgZkdJmCqz+byTOIIRboQ==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.js" integrity="sha512-/CzcPLOqUndTJKlWJ+PkvFh2ETRtkrnxwmULr9LsUU+cFLl7TAOR5gwwD8DRLvtM4h5ke/GQknlqQbWuT9BKdA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha512-42kB9yDlYiCEfx2xVwq0q7hT4uf26FUgSIZBK8uiaEnTdShXjwr8Ip1V4xGJMg3mHkUt9nNuTDxunHF0/EgxLQ==" crossorigin="anonymous" />

    
    <?php
    require_once FCPATH.'demo.php';
     if(isset($css_files)){
        
        foreach($css_files as $file): ?>
        	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; 
    }
    
    
    
    if($this->session->flashdata('success')){

        ?>

        <script type="text/javascript">

            toastr.success('<?=$this->session->flashdata('success')?>');

        </script>

        <?php

    }
    if($this->session->flashdata('danger')){

        ?>

        <script type="text/javascript">

            toastr.error('<?=$this->session->flashdata('danger')?>');

        </script>

        <?php

    }
   if($this->session->flashdata('error')){

                                    ?>

                                    <script type="text/javascript">

                                        toastr.error('<?=$this->session->flashdata('error')?>');

                                    </script>

                                    <?php

                                }

   if(isset($_GET['_token']) && isset($_GET['back_url'])){

        $__url = base_url.'/Admin';

        echo '<script>history.pushState(null, null, "'.$__url.'");</script>';

    }                             



                                ?>

<style type="text/css">
.cke_wysiwyg_frame, .cke_wysiwyg_div {
    background-color: #ececec!important;
}

.dataTablesContainer .card-header{
    position:relative;
}
.dataTablesContainer .card-header .card-toolbar{
    position:absolute;
    right:10px;
    top:2px;
}
   @media only screen and (max-width: 600px) {
       .dataTablesContainer .card-header .card-toolbar{
                position:relative;
            }
   }
    .form-control:focus{

        border:1px solid black;

        outline: none;

        box-shadow: none;

        color:black;

    }

    .determinate{

        background-color: green

    }

    .alert-danger{

        background: #d1113e;

        border:1px solid #910324;

        color:white;



    }

    .cke_textarea_inline {

      border: 1px solid #ccc;

      padding: 10px;

      min-height: 300px;

      background: #fff;

      color: #000;

    }

    .fileuploader{

  position: relative;
  background: white;
  width: 100%;
  height: 100%;
  border: 1px solid #e9e9e9;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);

}

.fileuploader.active{

  background: #2196F3;

}

/** Preview of collections of uploaded documents **/
/**/

.preview-container{

  position: fixed;
  right: 10px;
  bottom: 0px;
  width: 300px;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  visibility: hidden;

}

.preview-container #previews{

  max-height: 400px;

  overflow: auto; 

}

.preview-container #previews .zdrop-info{

  width: 88%;

  margin-right: 2%;

}

.preview-container #previews.collection{

  margin: 0;

}

.preview-container #previews.collection .actions a{

  width: 1.5em;

  height: 1.5em;

  line-height: 1;

}

.preview-container #previews.collection .actions a i{

  font-size: 1em;

  line-height: 1.6;

}

.preview-container #previews.collection .dz-error-message{

  font-size: 0.8em;

  margin-top: -12px;

  color: #F44336;

}

.preview-container .header{

  background: #2196F3;

  color: #fff;

  padding: 8px;

}

.preview-container .header i{

  float: right;

  cursor: pointer;

}

.cke_top{background-color: white}

.cke_button__about_icon{display: none}

a.cke_dialog_ui_button_ok {

        background-image: linear-gradient(to bottom, #ffd800, #ff6a00) !important;

    }
div.my-sticky {
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
}

        .link-box .form-group{
            border:1px solid black;
            position:relative;
                background: black;
        }
        .myINput{
            border:none;
            outline:none;
            text-transform: uppercase;
            color: rgba(13,27,62,0.7);
            font-weight: bold;
            font-size: .88rem;
        }
        .myINput:focus{
            border:none;
            outline:none;
        }
        .link-box .form-group:before{
                content: "\f047";
                height: 20px;
                cursor: move;
                top: 0;
                width: 100%;
                text-align: center;
                color: white;
                display: inline-block;
                font: normal normal normal 14px/1 FontAwesome;
                font-size: inherit;
                text-rendering: auto;
                -webkit-font-smoothing: antialiased;
        }
        .link-box .form-control{
            border-radius:0;
            border-color:black;
        }
        .remove-link{
                border-radius: 50%;
                position: absolute;
                top: -14px;
                border: 1px solid black;
                right: -10px;
        }
    </style>
<body>
<!--    <div class="widget-remove-event-div trashbox" ondragover="allowDrop(event)" ondrop="setdrop(event)"  style="position: fixed;-->
<!--    background: #940808b8;-->
<!--    display: none;-->
<!--    width: 100%;-->
<!--    height: 76px;-->
<!--    z-index: 90;color:white;">-->
<!--    <h3>Remove</h3>-->
<!--</div>-->
<style>
.logo-src1:before{
    content : 'Admin Panel';
}
    .closed-sidebar .logo-src1:before{
        content : 'AP';
    margin-left: -14px;
    }
    
</style>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        <div class="app-header header-shadow <?=$this->Admin['front']->top_bar?>">

            <div class="app-header__logo">

                <div class="logo-src1" style="height:23px;width:163px;color: white;font-size: 2em;line-height: 0.5;font-weight: 700;font-family: cursive;text-shadow: 0 0 3px black;"></div>

                <div class="header__pane ml-auto">

                    <div>

                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">

                            <span class="hamburger-box">

                                <span class="hamburger-inner"></span>

                            </span>

                        </button>

                    </div>

                </div>

            </div>

            <div class="app-header__mobile-menu">

                <div>

                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">

                        <span class="hamburger-box">

                            <span class="hamburger-inner"></span>

                        </span>

                    </button>

                </div>

            </div>

            <div class="app-header__menu">

                <span>

                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">

                        <span class="btn-icon-wrapper">

                            <i class="fa fa-ellipsis-v fa-w-6"></i>

                        </span>

                    </button>

                </span>

            </div>    

            <div class="app-header__content">

                <div class="app-header-left">

                    <div class="search-wrapper">

                        <div class="input-holder">

                            <input type="text" class="search-input" placeholder="Type to search">

                            <button class="search-icon"><span></span></button>

                        </div>

                        <button class="close"></button>

                    </div>
                    
                    <ul class="header-menu nav">

                        <li class="nav-item">

                            <a href="javascript:manage_facebook_Pixel();" class="nav-link" style="   border: 1px solid white;    box-shadow: 0 0 7px 0 inset rgb(255 255 255);    font-weight: 700;">

                                <i class="nav-link-icon fa fa-facebook"> </i>

                                Manage Facebook Pixel

                            </a>

                        </li>
                        
                        <li class="nav-item">

                            <a href="javascript:Google_Analytics();" class="nav-link" style="   border: 1px solid white;    box-shadow: 0 0 7px 0 inset rgb(255 255 255);    font-weight: 700;">

                                <i class="nav-link-icon fa fa-google"> </i>

                                Google Analytics

                            </a>

                        </li>
                        
                        <li class="nav-item">

                            <a href="https://webmail.<?=FRESH_DOMAIN?>" target="_blank" class="nav-link" style="   border: 1px solid white;    box-shadow: 0 0 7px 0 inset rgb(255 255 255);    font-weight: 700;">

                                <i class="nav-link-icon fa fa-envelope"> </i>

                                Web Mail

                            </a>

                        </li>
                    </ul>
                    <!--<ul class="header-menu nav">-->

                    <!--    <li class="nav-item">-->

                    <!--        <a href="javascript:void(0);" class="nav-link">-->

                    <!--            <i class="nav-link-icon fa fa-database"> </i>-->

                    <!--            Statistics-->

                    <!--        </a>-->

                    <!--    </li>-->

                    <!--    <li class="btn-group nav-item">-->

                    <!--        <a href="javascript:void(0);" class="nav-link">-->

                    <!--            <i class="nav-link-icon fa fa-edit"></i>-->

                    <!--            Projects-->

                    <!--        </a>-->

                    <!--    </li>-->

                    <!--    <li class="dropdown nav-item">-->

                    <!--        <a href="javascript:void(0);" class="nav-link">-->

                    <!--            <i class="nav-link-icon fa fa-cog"></i>-->

                    <!--            Settings-->

                    <!--        </a>-->

                    <!--    </li>-->

                    <!--</ul>        -->

                </div>

                <div class="app-header-right">
                    
                    <div class="header-btn-lg pr-0">

                        <div class="widget-content p-0">

                            <div class="widget-content-wrapper">
                                
                                
                                
    <?php
    /*
                                <div class="widget-content-left">

                                    <div class="btn-group">

                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">

                                            <img width="42" class="rounded-circle" src="<?=AdminProfile?>" alt="">

                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>

                                        </a>

                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">

                                            <h6 tabindex="-1" class="dropdown-header"><i class="fa fa-wallet"></i> Wallet Setting</h6>
                                            
                                            
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <h6 tabindex="-1" class="dropdown-header"><i class="fa fa-cog"></i> </i>Setting</h6>
                                            
                                            <a href="<?=base_url?>/admin/Change-password" tabindex="0" class="dropdown-item"><i class="fa fa-key"></i> <span style="padding-left:10px">Change Password</span></a>

                                            <a href="<?=site_url('admin/logout')?>" tabindex="0" class="dropdown-item"><i class="fa fa-power-off"></i> <span style="padding-left:10px">Logout</span></a>

                                        </div>

                                    </div>

                                </div>
    */
    ?>
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" style="position:relative" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle admin-profile"  style="width:50px;height:50px"src="<?=AdminProfile?>" alt="">
                                            <span class="top-number">1</span>
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right" style="    width: 324px;">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2" style="background-image: url('<?=AdminProfile?>');"></div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper" style="padding: 14px;    margin-top: -10px;">
                                                                <div class="widget-content-left mr-3">
                                                                    <img width="42" class="rounded-circle admin-profile" style="width:50px;height:50px" src="<?=AdminProfile?>" alt="">
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"><?=AdminNAME?></div>
                                                                    <div class="widget-subheading opacity-8">Admin</div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">
                                                                    <a href="<?=site_url('admin/logout')?>" class="btn-pill btn-shadow btn-shine btn btn-focus"> <i class="fa fa-power-off"></i> Logout</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <style>
                                                .scroll-area-xs ul li.nav-item:hover{
                                                    background:rgb(0,0,0,0.7);
                                                    color:white!important;
                                                    letter-spacing: 3px;
                                                    transition:.3s;
                                                }
                                                .scroll-area-xs ul li.nav-item:hover .scroll-area-xs ul li.nav-item a{
                                                    color:white!important;
                                                }
                                            </style>
                                            <div class="scroll-area-xs" style="height: 150px;">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">My Account</li>
                                                        <li class="nav-item">
                                                            <a href="/admin/profile" class="nav-link">
                                                                <i class="fa fa-user"></i> <span style="padding-left:10px"> Profile </span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">
                                                                <i class="fa fa-bell"></i> <span style="padding-left:10px"> Notifications </span>
                                                                <div class="ml-auto badge badge-success">1</div>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="<?=base_url?>/admin/Change-password"  class="nav-link"><i class="fa fa-key"></i> <span style="padding-left:10px">Change Password</span></a>
                                                        </li>
                                                    </ul>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider mb-0 nav-item"></li>
                                            </ul>
                                            <div class="grid-menu grid-menu-2col">
                                                <div class="no-gutters row" style="    padding: 18px;">
                                                    <div class="col-sm-6">
                                                        <a href="/admin/sms-panel" class="btn-icon-vertical sms-panel-btn btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                            <i class="pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i> SMS Panel
                                                        </a>
                                                    </div>
                                                    
                                                    <!--<div class="col-sm-6">-->
                                                    <!--    <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">-->
                                                    <!--        <i class="pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>-->
                                                    <!--        <b>Support Tickets</b>-->
                                                    <!--    </button>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                            <!--<ul class="nav flex-column">-->
                                            <!--    <li class="nav-item-divider nav-item">-->
                                            <!--    </li>-->
                                            <!--    <li class="nav-item-btn text-center nav-item">-->
                                            <!--        <button class="btn-wide btn btn-primary btn-sm"> Open Messages </button>-->
                                            <!--    </li>-->
                                            <!--</ul>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">

                                    <div class="widget-heading">

                                       <?=AdminNAME?>

                                    </div>

                                    <div class="widget-subheading">

                                        Admin

                                    </div>

                                </div>

                                <div class="widget-content-right header-user-info ml-3">

                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">

                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>

                                    </button>

                                </div>
                                
                                <div class="widget-content-right header-user-info ml-3">

                                    <a href="<?=base_url?>" target="_blank" class="btn-shadow p-1 btn btn-success btn-sm">

                                        <i class="fa text-white fa-globe pr-1 pl-1"></i> Visit Website

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>        

                </div>

            </div>



        </div>        

        
        <div class="ui-theme-settings">

            <button type="button" id="TooltipDemo" onclick="$('.menu-section-div').removeClass('settings-open')" class="btn-open-options btn btn-warning">

                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i> 

            </button>

            <div class="theme-settings__inner">

                <div class="scrollbar-container">

                    <div class="theme-settings__options-wrapper">

                        <h3 class="themeoptions-heading">Layout Options

                        </h3>

                        <div class="p-3">

                            <ul class="list-group">

                                <li class="list-group-item">

                                    <div class="widget-content p-0">

                                        <div class="widget-content-wrapper">

                                            <div class="widget-content-left mr-3">

                                                <div class="switch has-switch switch-container-class" data-class="fixed-header">

                                                    <div class="switch-animate switch-on">

                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="widget-content-left">

                                                <div class="widget-heading">Fixed Header

                                                </div>

                                                <div class="widget-subheading">Makes the header top fixed, always visible!

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </li>

                                <li class="list-group-item">

                                    <div class="widget-content p-0">

                                        <div class="widget-content-wrapper">

                                            <div class="widget-content-left mr-3">

                                                <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">

                                                    <div class="switch-animate switch-on">

                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="widget-content-left">

                                                <div class="widget-heading">Fixed Sidebar

                                                </div>

                                                <div class="widget-subheading">Makes the sidebar left fixed, always visible!

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </li>

                                <li class="list-group-item">

                                    <div class="widget-content p-0">

                                        <div class="widget-content-wrapper">

                                            <div class="widget-content-left mr-3">

                                                <div class="switch has-switch switch-container-class" data-class="fixed-footer">

                                                    <div class="switch-animate switch-off">

                                                        <input type="checkbox" data-toggle="toggle" data-onstyle="success">

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="widget-content-left">

                                                <div class="widget-heading">Fixed Footer

                                                </div>

                                                <div class="widget-subheading">Makes the app footer bottom fixed, always visible!

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </li>

                            </ul>

                        </div>

                        <h3 class="themeoptions-heading">

                            <div>

                                Header Options

                            </div>

                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">

                                Restore Default

                            </button>

                        </h3>

                        <div class="p-3">

                            <ul class="list-group">

                                <li class="list-group-item">

                                    <h5 class="pb-2">Choose Color Scheme

                                    </h5>

                                    <div class="theme-settings-swatches header-set">

                                        <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light">

                                        </div>

                                        <div class="divider">

                                        </div>

                                        <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light">

                                        </div>

                                        <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light">

                                        </div>

                                    </div>

                                </li>

                            </ul>

                        </div>

                        <h3 class="themeoptions-heading">

                            <div>Sidebar Options</div>

                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">

                                Restore Default

                            </button>

                        </h3>

                        <div class="p-3">

                            <ul class="list-group">

                                <li class="list-group-item">

                                    <h5 class="pb-2">Choose Color Scheme

                                    </h5>

                                    <?php

                                    $ty=$slider= '';

                                    if(isset($this->Admin->slider_bar) && $this->Admin->slider_bar){

                                        $ty = $this->Admin->slider_bar;

                                    }

                                    ?>

                                    <div class="theme-settings-swatches slider-box-class">

                                        <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light">

                                        </div>

                                        <div class="divider">

                                        </div>

                                        <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark">

                                        </div>

                                        <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light">

                                        </div>

                                        <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light">

                                        </div>

                                    </div>

                                </li>

                            </ul>

                        </div>

                        <h3 class="themeoptions-heading">

                            <div>Main Content Options</div>

                            <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default

                            </button>

                        </h3>

                        <div class="p-3">

                            <ul class="list-group">

                                <li class="list-group-item">

                                    <h5 class="pb-2">Page Section Tabs

                                    </h5>

                                    <div class="theme-settings-swatches">

                                        <div role="group" class="mt-2 btn-group">

                                            <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">

                                                Line

                                            </button>

                                            <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">

                                                Shadow

                                            </button>

                                        </div>

                                    </div>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>        

        <div class="app-main">

                <div class="app-sidebar sidebar-shadow <?=$this->Admin['front']->slider_bar?>">

                    <div class="app-header__logo">

                        <div class="logo-src"></div>

                        <div class="header__pane ml-auto">

                            <div>

                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">

                                    <span class="hamburger-box">

                                        <span class="hamburger-inner"></span>

                                    </span>

                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="app-header__mobile-menu">

                        <div>

                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">

                                <span class="hamburger-box">

                                    <span class="hamburger-inner"></span>

                                </span>

                            </button>

                        </div>

                    </div>

                    <div class="app-header__menu">

                        <span>

                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">

                                <span class="btn-icon-wrapper">

                                    <i class="fa fa-ellipsis-v fa-w-6"></i>

                                </span>

                            </button>

                        </span>

                    </div>    <div class="scrollbar-sidebar">

                        <div class="app-sidebar__inner">

                            



                            <ul class="vertical-nav-menu">

                                <li class="app-sidebar__heading">Dashboards</li>

                                <li>

                                    <a href="" class="mm-active">

                                        <i class="metismenu-icon pe-7s-rocket"></i>

                                        Dashboard  

                                    </a>

                                </li>
                                
                                <?php
                                $listTHemeMenu = $this->ThemeModel->getMenu();
                                
                                if($listTHemeMenu){
                                    echo '<li class="app-sidebar__heading">Theme Setting</li>';
                                    
                                    foreach($listTHemeMenu as $key => $value) {
                                	        
                                	        if(array_key_exists('child',$value)){
                                	           echo '<li class="">
                                	                        <a href="#">
                                	                        <i class="metismenu-icon pe-7s-settings"></i>'.$value['label'].' <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                                	                    ';
                                	           echo ThemeMenu($value['child']);
                                	        }
                                	        else{
                                	            echo '<li>
                                	                        <a class="" href="'.base_url('settings/v1/'.$value['method']).'">
                                	                        <i class="metismenu-icon pe-7s-settings"></i>  '.$value['label'].'</a>
                                	                    ';
                                	        }
                                            echo  "</li>";
                                
                                	}
                                	
                                }
                                
                                
                                echo '<li class="app-sidebar__heading">Addons</li>';
                                    
                                   
                        	            echo '<li>
                        	                        <a class="" href="'.base_url('addons/site-addons').'"><i class="metismenu-icon pe-7s-exapnd2"></i> My Addons</a>
                        	                   </li>';
                                
                                	
                                
                                
                                
                                if(THEME_ID == 1){
                                    echo '<li class="app-sidebar__heading">Theme Setting</li>';
                                    ?>
                                    <li class="page_setting">

                                        <a href="#">
    
                                            <i class="metismenu-icon pe-7s-settings"></i>
    
                                            Header Setting
    
                                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    
                                        </a>
    
                                        <ul>
    
                                            <li>
    
                                                <a class="all_pages" href="<?=site_url('admin/header-setting/topbar')?>">
    
                                                    <i class="metismenu-icon"></i>
    
                                                    Topbar
    
                                                </a>
    
                                            </li>
                                            <li>
    
                                                <a class="all_pages" href="<?=site_url('admin/header-setting/header')?>">
    
                                                    <i class="metismenu-icon"></i>
    
                                                    Header
    
                                                </a>
    
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                
                    function ThemeMenu($items,$class = ''){
	    
                			    $html = "<ul class=\"".$class."\">";
                
                                foreach($items as $key => $value) {
                
                			    if(array_key_exists('child',$value)){
                        	           $html .= '<li class="">
                        	                        <a href="#">'.$value['label'].'</a>
                        	                    ';
                        	           $html .= ThemeMenu($value['child']);
                        	        }
                        	        else{
                        	            $html .= '<li>
                        	                        <a class="" href="'.base_url('settings/v1/'.$value['method']).'">'.$value['label'].'</a>
                        	                    ';
                        	        }
                                    $html .=  "</li>";
                                }
                			    $html .= "</ul>";
                
                
                
                			    return $html;
                	}
                                
                                ?>

                                
                                <li class="app-sidebar__heading">UI Setting</li>
                                <li class="page_setting">

                                    <a href="#">

                                        <i class="metismenu-icon pe-7s-file"></i>

                                        Pages

                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>

                                    </a>

                                    <ul>

                                        <li>

                                            <a class="all_pages" href="<?=site_url('admin/list-pages')?>">

                                                <i class="metismenu-icon"></i>

                                                All Pages

                                            </a>

                                        </li>

                                        <li>

                                            <a class="add_page" href="<?=site_url('admin/Add-Page')?>">

                                                <i class="metismenu-icon"></i>

                                                Add Page

                                            </a>

                                        </li>

                                    </ul>

                                </li>
                                
                                
                                    <li class="content">
                                        <a href="#"><i class="metismenu-icon pe-7s-box1"></i> Content Area <span class="badge badge-danger pull-right" style=" margin-top: 8px;">New</span><i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                                        
                                        <ul>
                                            <li>
                                                <a class="add_content" href="<?=site_url('admin/content/add')?>"><i class="metismenu-icon"></i> Add Content</a>
                                            </li>
                                            <li>
                                                <a class="Use_content" href="<?=site_url('admin/content/use')?>"><i class="metismenu-icon"></i> Use Content</a>
                                            </li>
                                        </ul>
                                        
                                </li>
                                
                                <?php
                                
                                if(defined('newsportal')){
                                    ?>
                                    <li class="gallery_setting">

                                        <a href="#">
    
                                            <i class="metismenu-icon pe-7s-file"></i>
    
                                            Post Area
    
                                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    
                                        </a>
    
                                        <ul>
                                            <li>

                                                <a class="" href="<?=base_url?>/admin/news/">
    
                                                    <i class="metismenu-icon"></i>
    
                                                    All Post
    
                                                </a>
    
                                            </li>
                                            <li>

                                                <a class="" href="<?=site_url('admin/news/add')?>">
    
                                                    <i class="metismenu-icon"></i>
    
                                                    New Post
    
                                                </a>
    
                                            </li>
                                            <li>

                                                <a class="" href="<?=base_url?>/admin/news/categories">
    
                                                    <i class="metismenu-icon"></i>
    
                                                    Categories
    
                                                </a>
    
                                            </li>
                                            <li>

                                                <a class="" href="<?=base_url?>/admin/news/setting">
    
                                                    <i class="metismenu-icon"></i>
    
                                                    Setting
    
                                                </a>
    
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                
                                 if(!defined('newsportal')){
                                ?>
                                
                                <li class="gallery_setting">

                                    <a href="#">

                                        <i class="metismenu-icon pe-7s-plugin"></i>

                                        Galleries

                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>

                                    </a>

                                    <ul>

                                        <li>

                                            <a class="img_gallery" href="<?=site_url('admin/image-gallery')?>">

                                                <i class="metismenu-icon"></i>

                                                Image Gallery

                                            </a>

                                        </li>

                                        <li>

                                            <a class="prd_gallery" href="<?=site_url('admin/product-gallery')?>">

                                                <i class="metismenu-icon"></i>

                                                Product Gallery

                                            </a>

                                        </li>
                                        <li>

                                            <a class="video_gallery" href="<?=site_url('admin/video-gallery')?>">

                                                <i class="metismenu-icon"></i>

                                                Video Gallery

                                            </a>

                                        </li>
                                        
                                        <li>

                                            <a class="file_download_gallery" href="<?=site_url('admin/file-download-gallery')?>">

                                                <i class="metismenu-icon"></i>

                                                File Download Gallery

                                            </a>

                                        </li>
                                        
                                        <li>

                                            <a class="use_gallery" href="<?=site_url('admin/use-gallery')?>">

                                                <i class="metismenu-icon"></i>

                                                Use Gallery

                                            </a>

                                        </li>

                                        <li>

                                            <a class="use_product_gallery" href="<?=site_url('admin/use-product-gallery')?>">

                                                <i class="metismenu-icon"></i>

                                                Use Product Gallery

                                            </a>

                                        </li>

                                        <li>

                                            <a class="use_video_gallery" href="<?=site_url('admin/use-video-gallery')?>">

                                                <i class="metismenu-icon"></i>

                                                Use Video Gallery

                                            </a>

                                        </li>
                                        
                                        <li>

                                            <a class="use_file_download_gallery" href="<?=site_url('admin/file-download-gallery-use-in-page')?>">

                                                <i class="metismenu-icon"></i>

                                                Use File Download Gallery

                                            </a>

                                        </li>
                                        
                                        <li>

                                            <a class="product_query" href="<?=site_url('admin/product-query')?>">

                                                <i class="metismenu-icon"></i>

                                                 Product Queries

                                            </a>

                                        </li>

                                    </ul>

                                </li>
                                <?php
                                 }
                                ?>

                                <li class="ui_setting">

                                    <a href="#">

                                        <i class="metismenu-icon pe-7s-settings"></i>

                                        Setting

                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>

                                    </a>

                                    <ul>

                                        <li>

                                            <a class="menu_section" href="<?=site_url('admin/Menu-section')?>">

                                                <i class="metismenu-icon"></i>

                                                Menu Section

                                            </a>

                                        </li>

                                        <!--<li>-->

                                        <!--    <a class="theme_setting" href="<?=site_url('admin/theme-setting')?>">-->

                                        <!--        <i class="metismenu-icon"></i>-->

                                        <!--        Theme Setting-->

                                        <!--    </a>-->

                                        <!--</li>-->

                                        <li>

                                            <a class="widget_setting" href="<?=site_url('admin/add-widget')?>">

                                                <i class="metismenu-icon"></i>

                                                Widgets

                                            </a>

                                        </li>
                                        <?php
                                        if(!isCustom):
                                        ?>
                                        <li>

                                            <a class="use_widget" href="<?=site_url('admin/use-widget')?>">

                                                <i class="metismenu-icon"></i>

                                               Use Widgets

                                            </a>

                                        </li>
                                        <?php
                                        endif;
                                        ?>
                                         <li>

                                            <a class="web_setting" href="<?=site_url('admin/website-setting')?>">

                                                <i class="metismenu-icon"></i>

                                               Website Setting

                                            </a>

                                        </li>
                                    </ul>

                                </li>

                                 <li class="carousel">

                                    <a href="#">

                                        <i class="metismenu-icon pe-7s-photo-gallery"></i>

                                        Carousel

                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>

                                    </a>

                                    <ul>

                                        <li>

                                            <a class="add_carousel" href="<?=site_url('admin/add-carousel')?>">

                                                <i class="metismenu-icon"></i>

                                                Add Carousel

                                            </a>

                                        </li>

                                        <li>

                                            <a class="user_carousel" href="<?=site_url('admin/use-carousel')?>">

                                                <i class="metismenu-icon"></i>

                                                Use Carousel

                                            </a>

                                        </li>

                                    </ul>

                                </li>
                                <?php
                                $slider_url = /*(isCustom) ? 'sliders' :*/ 'admin/slider';
                                ?>
                                <li>

                                            <a href="<?=base_url?>/<?=$slider_url?>">
        
                                                <i class="metismenu-icon pe-7s-play"></i>
        
                                                Slider
        
                            <span class="badge badge-danger pull-right" style=" margin-top: 8px;">New Feature</span></a>
        
                                        </li>
                                <?php
                                 if(!defined('newsportal')){
                                ?>
                                 <li class="Forms">

                                    <a href="#">

                                        <i class="metismenu-icon pe-7s-display2"></i>

                                        Forms

                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>

                                    </a>

                                    <ul>

                                        <li>

                                            <a class="add_new_form" href="<?=site_url('admin/add-form')?>">

                                                <i class="metismenu-icon"></i>

                                                Add New Form

                                            </a>

                                        </li>

                                        <li>

                                            <a class="use_form" href="<?=site_url('admin/use-form')?>">

                                                <i class="metismenu-icon"></i>

                                                Use Form

                                            </a>

                                        </li>

                                         <li>

                                            <a class="user_carousel" href="<?=site_url('admin/form-data')?>">

                                                <i class="metismenu-icon"></i>

                                                Form Data

                                            </a>

                                        </li>
                                        
                                        <li>

                                            <a class="user_carousel" href="<?=site_url('admin/get-quick-form-data')?>">

                                                <i class="metismenu-icon"></i>

                                                Get Quick Form Data

                                            </a>

                                        </li>


                                    </ul>

                                </li>
                                <li class="payment_gateway">

                                    <a href="#">

                                        <i class="metismenu-icon pe-7s-display2"></i>

                                        Transaction Form

                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>

                                    </a>

                                    <ul>

                                        <li>

                                            <a class="add_payment_method" href="<?=site_url('admin/add-payment-method')?>">

                                                <i class="metismenu-icon"></i>

                                                Add Payment Method

                                            </a>

                                        </li>

                                        <li>

                                            <a class="use_form" href="<?=site_url('admin/create-transaction-form')?>">

                                                <i class="metismenu-icon"></i>

                                                Create Transaction form

                                            </a>

                                        </li>

                                         <li>

                                            <a class="user_carousel" href="<?=site_url('admin/use-transaction-form')?>">

                                                <i class="metismenu-icon"></i>

                                                Use Transaction Form

                                            </a>

                                        </li>

                                         <li>

                                            <a class="user_carousel" href="<?=site_url('admin/transaction-form-data')?>">

                                                <i class="metismenu-icon"></i>

                                                Transaction Form Data

                                            </a>

                                        </li>


                                    </ul>

                                </li>
                                <?php
                                 }
                                ?>

                                 <li class="PopUp">

                                    <a href="#">

                                        <i class="metismenu-icon pe-7s-graph1"></i>

                                        Others

                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>

                                    </a>

                                    <ul>
                                        
                                        <li>

                                            <a class="add_new_form" href="<?=site_url('admin/add-popup')?>">

                                                <i class="metismenu-icon"></i>

                                                Add Pop Up

                                            </a>

                                        </li>
                                         <li>

                                            <a class="add_new_form" href="<?=site_url('admin/manage-schema')?>">

                                                <i class="metismenu-icon"></i>

                                                Manage Page

                                            </a>

                                        </li>
                                        <li>

                                            <a class="feature_box" href="<?=site_url('admin/feature-box')?>">

                                                <i class="metismenu-icon"></i>

                                                Feature Box

                                            </a>

                                        </li>

                                         <li>

                                            <a class="feature_box_use" href="<?=site_url('admin/use-feature-box')?>">

                                                <i class="metismenu-icon"></i>

                                               Use Feature Box

                                            </a>

                                        </li>
                                          <li>

                                            <a class="secondary_menu" href="<?=site_url('admin/secondary-menu')?>">

                                                <i class="metismenu-icon"></i>

                                               Secondary Menu

                                            </a>

                                        </li>
                                    </ul>
                                </li>
                                 <li>
                                    <a class="utility" >

                                        <i class="metismenu-icon pe-7s-link"></i>

                                       Utilites
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>

                                        <a class="utility" href="<?=site_url('admin/Utilities/social')?>">

                                            

                                           Social Links

                                        </a>

                                         </li>
                                    </ul>

                                </li>


                                <li>
                                    <a class="utility" >

                                        <i class="metismenu-icon pe-7s-repeat"></i>

                                       Marquee
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>

                                        <a class="utility" href="<?=site_url('admin/add_marquee')?>">

                                            

                                           Add Marquee

                                        </a>

                                         </li>
                                         <li>

                                        <a class="utility" href="<?=site_url('admin/use_marquee')?>">

                                            

                                           Use Marquee

                                        </a>

                                         </li>
                                    </ul>

                                </li>
                                
                                
                                <li>
                                    <a class="utility" >

                                        <i class="metismenu-icon pe-7s-display1"></i>

                                       Google Adsense
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                        <a class="utility" href="<?=site_url('admin/add-adsense')?>">
                                           Add Adsense Credential 
                                        </a>
                                         </li>

                                         <li>
                                        <a class="utility" href="<?=site_url('admin/create-ads')?>">
                                           Create ads
                                        </a>
                                         </li>


                                         <li>
                                        <a class="utility" href="<?=site_url('admin/use-ads')?>">
                                          Use Ads
                                        </a>
                                         </li>
                                    </ul>

                                </li>

                                <li>
                                    <a class="file_service" >

                                        <i class="metismenu-icon pe-7s-browser"></i>

                                       File Service
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>

                                        <a class="file-service" href="<?=site_url('admin/file-service')?>">
                                          File Service
                                        </a>

                                         </li>
                                         <li>

                                        <a class="use-file-service" href="<?=site_url('admin/use-file-service')?>">
                                          Use File Service
                                        </a>

                                         </li>
                                    </ul>

                                </li>
                                <?php
                                echo Modules :: run('addons/print_menu');
                                /*
                                if($this->crud_model->get_general_setting_by_type('result_section') == 'ok'){
                                  ?>
                                  <li class="app-sidebar__heading">Result Section</li>

                               
                                  <li>
                                    <a class="result_section" >

                                        <i class="metismenu-icon pe-7s-rocket"></i>

                                       Student Classes
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>

                                        <a class="classes-service" href="<?=site_url('admin/create-class-for-result')?>">
                                          Create Class
                                        </a>

                                         </li>
                                         <li>

                                        <a class="manage-classes-service" href="<?=site_url('admin/manage-classes-for-result')?>">
                                          Manage Classes
                                        </a>

                                         </li>
                                    </ul>

                                </li>
                                <li>
                                    <a class="subject_section" >

                                        <i class="metismenu-icon pe-7s-rocket"></i>

                                       Subjects
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>

                                        <a class="subject-service" href="<?=site_url('admin/create-subject-for-result')?>">
                                          Create Subject
                                        </a>

                                         </li>
                                         <li>

                                        <a class="manage-subject-service" href="<?=site_url('admin/manage-subjects-for-result')?>">
                                          Manage Subjects
                                        </a>

                                         </li>
                                          <li>

                                        <a class="subject-service" href="<?=site_url('admin/add-subject-combination-for-result')?>">
                                          Add Subject Combination
                                        </a>

                                         </li>
                                         <li>

                                        <a class="manage-subject-service" href="<?=site_url('admin/manage-subjects-combination-for-result')?>">
                                          Manage Subjects Combination
                                        </a>

                                         </li>
                                    </ul>

                                </li>
                                <li>
                                    <a class="student_section" >

                                        <i class="metismenu-icon pe-7s-rocket"></i>

                                       Students
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>

                                        <a class="add-student-service" href="<?=site_url('admin/add-student-for-result')?>">
                                          Add Student
                                        </a>

                                         </li>
                                         <li>

                                        <a class="manage-students-service" href="<?=site_url('admin/manage-students-for-result')?>">
                                          Manage Student
                                        </a>

                                         </li>
                                    </ul>

                                </li>
                                 <li>
                                    <a class="result_section" >

                                        <i class="metismenu-icon pe-7s-rocket"></i>

                                       Result
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>

                                        <a class="add-result-service" href="<?=site_url('admin/add-result')?>">
                                          Add Result
                                        </a>

                                         </li>
                                        <li>
                                            <a class="manage-result-service" href="<?=site_url('admin/manage-result')?>">
                                              Manage Result
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a class="result-setting" href="<?=site_url('admin/result-setting')?>">
                                              Result Setting
                                            </a>
                                        </li>
                                         
                                    </ul>

                                </li>
                                
                                
                                
                                <li>
                                    <a class="result_section" >
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Result Search Form
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a class="add-result-service" href="<?=site_url('admin/search-form-for-result')?>">
                                               Search Form
                                            </a>
                                         </li>
                                        <li>
                                            <a class="manage-result-service" href="<?=site_url('admin/use-search-form-for-result')?>">
                                              User Search Form
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                  <?php
                                }
                                
                                if(isCustom){
                                    ?>
                                    <li>

                                        <a href="<?=base_url?>/settings/footer" class="mm-active">
            
                                            <i class="metismenu-icon pe-7s-rocket"></i>
            
                                                    Theme Footer  
            
                                        </a>
            
                                    </li>
                                    <?php
                                }
                                */
                                ?>
                                <li class="app-sidebar__heading">Other Section</li>
                                
                                <li>

                                    <a href="<?=base_url?>/admin/Email" class="mm-active">
        
                                        <i class="metismenu-icon pe-7s-mail"></i>
        
                                                Email  
        
                                    </a>
        
                                </li>
                                <li>
                                    <a class="other" >

                                        <i class="metismenu-icon pe-7s-keypad"></i>

                                       Other
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>

                                        <a class="utility" href="#">Comming Soon</a>

                                         </li>
                                    </ul>

                                </li>

                            </ul>

                        </div>

                    </div>

                </div>    

                <div class="app-main__outer">

                       <div class="app-main__inner">

                        <div id="load"></div>
                        
                        <?=@$output?>