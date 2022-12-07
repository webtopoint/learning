<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130582519-1"></script>
    

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/azia/img/azia-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="https://sndigitalhub.com">
    <meta property="og:title" content="Sndigital Hub">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <title>Admin Panel</title>

    <!-- vendor css -->
    <link href="<?=base_url()?>public/company/assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/jqvmap/jqvmap.min.css" rel="stylesheet">

    <link href="<?=base_url()?>public/company/assets/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/select2/css/select2.min.css" rel="stylesheet">
    <!-- azia CSS -->
    
    <link href="<?=base_url()?>public/company/assets/lib/spectrum-colorpicker/spectrum.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
    <link href="<?=base_url()?>public/company/assets/lib/pickerjs/picker.min.css" rel="stylesheet">
    
    <link href="<?=base_url()?>public/company/assets/lib/lightslider/css/lightslider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>public/company/assets/css/azia.css">
    <?php
    if(isset($output['css_files'])){
    foreach($output['css_files'] as $file): ?>
            	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; 
    }?>
    <script src="<?=base_url()?>public/company/assets/lib/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/ionicons/ionicons.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/chart.js/Chart.bundle.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jquery.flot/jquery.flot.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jquery.flot/jquery.flot.crosshair.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jquery.flot/jquery.flot.resize.js"></script>
    
    <script src="<?=base_url()?>public/company/assets/lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="<?=base_url()?>public/company/assets/js/azia.js"></script>
    
    <script src="<?=base_url()?>public/company/assets/js/dashboard.sampledata.js"></script>
    
    <script src="<?=base_url()?>public/company/assets/lib/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/select2/js/select2.min.js"></script>
    
   
    <script src="<?=base_url()?>public/company/assets/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jquery.maskedinput/jquery.maskedinput.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/spectrum-colorpicker/spectrum.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jquery-simple-datetimepicker/jquery.simple-dtpicker.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/pickerjs/picker.min.js"></script>
    
    <script src="<?=base_url()?>public/company/assets/lib/pickerjs/main.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/lightslider/js/lightslider.min.js"></script>
    
    
    <script>var base_url = '<?=base_url?>',site_name = '<?= defined('SITE_NAME') ? SITE_NAME : ''?>',$JS;</script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/notify/css/jquery.gritter.css" />-->
    <!--<script type="text/javascript" src="<?=base_url()?>public/notify/js/jquery.gritter.js"></script>-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    
    
    <script src="<?=base_url()?>public/company/assets/lib/chart.js/Chart.bundle.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/jquery-steps/jquery.steps.min.js"></script>
    <script src="<?=base_url()?>public/company/assets/lib/parsleyjs/parsley.min.js"></script>
    
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    
    <!-- Production -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/spin.min.js" integrity="sha512-FzwLmClLNd77zi/Ke+dYlawHiPBAWhk8FzA4pwFV2a6PIR7/VHDLZ0yKm/ekC38HzTc5lo8L8NM98zWNtCDdyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda.min.js" integrity="sha512-fK8kfclYYyRUN1KzdZLVJrAc+LmdsZYH+0Fp3TP4MPJzcLUk3FbQpfWSbL/uxh7cmqbuogJ75pMmL62SiNwWeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda.jquery.min.js" integrity="sha512-9pDK1QtjyYU3QU0NU3+kZ6TrxsMJISp9qxRXDN3Ali+pZPJzxDJL1jc6oQuLoAtve6Pc+KUDy6QJajimBKxfYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js" integrity="sha512-bUg5gaqBVaXIJNuebamJ6uex//mjxPk8kljQTdM1SwkNrQD7pjS+PerntUSD+QRWPNJ0tq54/x4zRV8bLrLhZg==" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.css" integrity="sha512-DanfxWBasQtq+RtkNAEDTdX4Q6BPCJQ/kexi/RftcP0BcA4NIJPSi7i31Vl+Yl5OCfgZkdJmCqz+byTOIIRboQ==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.js" integrity="sha512-/CzcPLOqUndTJKlWJ+PkvFh2ETRtkrnxwmULr9LsUU+cFLl7TAOR5gwwD8DRLvtM4h5ke/GQknlqQbWuT9BKdA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha512-42kB9yDlYiCEfx2xVwq0q7hT4uf26FUgSIZBK8uiaEnTdShXjwr8Ip1V4xGJMg3mHkUt9nNuTDxunHF0/EgxLQ==" crossorigin="anonymous" />
    <script src="https://motexooil.co.in/public/web/jquery.nestable.js"></script>
    <link href="https://bizknowindia.org.in/static/back/style.css" rel="stylesheet" type="text/css" />
		
    <script>
      var loader_btn_html = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading..'; 
    </script>
    <style>.nav-link.active{color:white!important;}
    .tox-notifications-container{
        display:none!important;
    }
    .btn-xs{border-width: 0;
          line-height: 1.538;
          padding: 4px 8px;
          border-radius: 0;
          transition: none;
          min-height: auto;}
          .file-input{position:absolute;z-index:-1}div.sticky {
        position: -webkit-sticky; /* Safari */
        position: sticky;
        top: 0;
      }.noselect {
        -webkit-touch-callout: none; /* iOS Safari */
          -webkit-user-select: none; /* Safari */
           -khtml-user-select: none; /* Konqueror HTML */
             -moz-user-select: none; /* Old versions of Firefox */
              -ms-user-select: none; /* Internet Explorer/Edge */
                  user-select: none; /* Non-prefixed version, currently
                                        supported by Chrome, Edge, Opera and Firefox */
      }
      .az-sidebar-indigo-dark ,.bg-theme {
          background-color: #250735!important;
          border-right-width: 0;
      }
      .az-sidebar-indigo-dark .az-sidebar-body .nav-item.active::before {
          background: rgba(0,0,0,.9)!important;
      }
      .btn.bg-theme{
           background-color: #250735!important;
           color:white;
           border:1px solid #250735;
           transition:1s;
      }
      .btn.bg-theme:hover{
           background: white!important;
           color:#250735;
           border:1px solid #250735;
           transition:1s;
      }

      .loading-wizard{
          position: absolute;
          top: 0;
          width: 100%;
          background: #250735d4;
          left: 0;
          height: 100%;
          z-index: 99;
          display:none;
      }
      .loading-wizard i{
          color: white;
          font-size: 4em;
          left: 50%;
          position: absolute;
          top: 50%;
      }
      .dataTablesContainer .card-title{
        display:inline-block!important;
      }
      .dataTablesContainer .card-toolbar.btn-group{
        float:right!important;
      }
      </style>
  </head>
  <body class="az-body az-body-sidebar az-body-dashboard-nine">

    <div class="az-sidebar az-sidebar-sticky az-sidebar-indigo-dark">

      <?php
      require_once 'include/navigation.php';
      ?>

    </div><!-- az-sidebar -->

    <div class="az-content az-content-dashboard-nine">
      <div class="az-header az-header-dashboard-nine">
          
        <div class="container-fluid">
            
          <div class="az-header-left">
            <a href="javascript:void(0)" id="azIconbarShow" class="az-header-menu-icon"><span></span></a>
          </div><!-- az-header-left -->
          <div class="az-header-center">
            <input type="search" class="form-control" placeholder="Search for anything">
            <button class="btn"><i class="fas fa-search"></i></button>
          </div><!-- az-header-center -->
          <div class="az-header-right">
            <div class="az-header-message" style="margin-right:10px">
              <a href="<?=base_url()?>" target="_blank"><i class="typcn typcn-globe"></i></a>
            </div><!-- az-header-message -->
            <div class="az-header-message">
              <a href="app-chat.html"><i class="typcn typcn-messages"></i></a>
            </div><!-- az-header-message -->
            <div class="dropdown az-header-notification">
              <a href="" class="new"><i class="typcn typcn-bell"></i></a>
              <div class="dropdown-menu">
                <div class="az-dropdown-header mg-b-20 d-sm-none">
                  <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <h6 class="az-notification-title">Notifications</h6>
                <p class="az-notification-text">You have 2 unread notification</p>
                <div class="az-notification-list">
                  <div class="media new">
                    <div class="az-img-user"><img src="https://via.placeholder.com/500" alt=""></div>
                    <div class="media-body">
                      <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                      <span>Mar 15 12:32pm</span>
                    </div><!-- media-body -->
                  </div><!-- media -->
                  <div class="media new">
                    <div class="az-img-user online"><img src="https://via.placeholder.com/500" alt=""></div>
                    <div class="media-body">
                      <p><strong>Joyce Chua</strong> just created a new blog post</p>
                      <span>Mar 13 04:16am</span>
                    </div><!-- media-body -->
                  </div><!-- media -->
                  <div class="media">
                    <div class="az-img-user"><img src="https://via.placeholder.com/500" alt=""></div>
                    <div class="media-body">
                      <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                      <span>Mar 13 02:56am</span>
                    </div><!-- media-body -->
                  </div><!-- media -->
                  <div class="media">
                    <div class="az-img-user"><img src="https://via.placeholder.com/500" alt=""></div>
                    <div class="media-body">
                      <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                      <span>Mar 12 10:40pm</span>
                    </div><!-- media-body -->
                  </div><!-- media -->
                </div><!-- az-notification-list -->
                <div class="dropdown-footer"><a href="">View All Notifications</a></div>
              </div><!-- dropdown-menu -->
            </div><!-- az-header-notification -->
            <div class="dropdown az-profile-menu">
              <a href="" class="az-img-user"><img src="https://via.placeholder.com/500" alt=""></a>
              <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                  <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                  <div class="az-img-user">
                    <img src="https://via.placeholder.com/500" alt="">
                  </div><!-- az-img-user -->
                  <h6>Aziana Pechon</h6>
                  <span>Premium Member</span>
                </div><!-- az-header-profile -->

                <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                <a href="<?=base_url()?>Admin/logout" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
              </div><!-- dropdown-menu -->
            </div>
          </div><!-- az-header-right -->
        </div><!-- container -->
      </div><!-- az-header -->

      <div class="az-content-body" >
        <?php
        if(isset($havePlans)){
          if($havePlans == 0){
            echo ' <div class="row row-sm">'.$this->load->view('plans/not_exists_plans',[],true).'</div>';
          }
        }
        if(isset($output)){
            ?>
            <div class="row row-sm">

            	<div class="col-md-12">
            		<div class="card">
            			<div class="card-header bg-primary tx-white">
            				<strong><?=@$title?></strong>
            			</div>
            			<div class="card-body">
            			    <?=$output['output']?>
            			</div>
            		</div>
            	</div>
            </div>
            <?php
            
            
        }
        else{
        //     //echo __DIR__.'/'.self();
        //   require_once (file_exists(__DIR__.'/'.self())) 
        //                           ? __DIR__.'/'.self() 
        //                           : VIEWPATH.'errors/404.php'; 
        echo $page_data;
        }
        ?>
                
        
      </div><!-- az-content-body -->

      <div class="az-footer ht-40">
        <div class="container-fluid pd-t-0-f ht-100p">
          <span>&copy; SN Digital Hub</span> 
          <span>Designed by: <a href="https://facebook.com/ajaykumararya2">Developer</a></span>
        </div><!-- container -->
      </div><!-- az-footer -->
    </div><!-- az-content -->
<?php
if(isset($output['js_files'] )){
    foreach($output['js_files'] as $file): ?>
                <script src="<?php echo $file; ?>"></script>
            <?php endforeach;
}
?>
    <script>
    //az-sidebar-hide
   
    $('#azIconbarShow').click(function(){
        if($('body').hasClass('az-sidebar-hide'))
          $('body').addClass('az-sidebar-hide').removeClass('az-sidebar-show');
        else
         $('body').addClass('az-sidebar-show').removeClass('az-sidebar-hide');
    });
    // Additional code for adding placeholder in search box of select2
      (function($) {
        var Defaults = $.fn.select2.amd.require('select2/defaults');

        $.extend(Defaults.defaults, {
          searchInputPlaceholder: ''
        });

        var SearchDropdown = $.fn.select2.amd.require('select2/dropdown/search');

        var _renderSearchDropdown = SearchDropdown.prototype.render;

        SearchDropdown.prototype.render = function(decorated) {

          // invoke parent method
          var $rendered = _renderSearchDropdown.apply(this, Array.prototype.slice.apply(arguments));

          this.$search.attr('placeholder', this.options.get('searchInputPlaceholder'));

          return $rendered;
        };

      })(window.jQuery);
    
    
       
    
    </script>
    <script>
      $(function(){
        'use strict'
        // Toggle Switches
        $('.az-toggle').on('click', function(){
          $(this).toggleClass('on');
        })
        
        $('.az-sidebar .with-sub').on('click', function(e){
          e.preventDefault();
          $(this).parent().toggleClass('show');
          $(this).parent().siblings().removeClass('show');
        })

        $(document).on('click touchstart', function(e){
          e.stopPropagation();

          // closing of sidebar menu when clicking outside of it
          if(!$(e.target).closest('.az-header-menu-icon').length) {
            var sidebarTarg = $(e.target).closest('.az-sidebar').length;
            if(!sidebarTarg) {
              $('body').removeClass('az-sidebar-show');
            }
          }
        });


        $('#azSidebarToggle').on('click', function(e){
          e.preventDefault();

          if(window.matchMedia('(min-width: 992px)').matches) {
            $('body').toggleClass('az-sidebar-hide');
          } else {
            $('body').toggleClass('az-sidebar-show');
          }
        });

        new PerfectScrollbar('.az-sidebar-body', {
          suppressScrollX: true
        });


      });
    </script>
  </body>
</html>

