        <div class="az-sidebar-header">
        <a href="" style="text-transform: capitalize;" class="az-logo">Web<span style="text-transform: capitalize;"> Adm</span> in</a>
      </div><!-- az-sidebar-header -->

      <div class="az-sidebar-loggedin">
        <div class="az-img-user online"><img src="https://via.placeholder.com/500" alt=""></div>
        <div class="media-body">
          <h6>Arya</h6>
          <span>Premium Member</span>
        </div><!-- media-body -->
      </div><!-- az-sidebar-loggedin -->



      <div class="az-sidebar-body">
        <ul class="nav all-menu-links">
            
          <li class="nav-label">Main Menu</li>
          
          <li class="navaa-item ">
              <a href="<?=base_url?>/admin" class="nav-link dashboard-li"><i class="typcn typcn-clipboard"></i> Dashboard</a>
          </li>
          
          <li class="nav-item setting">
            <a href="<?=base_url?>/admin/payment-methods" class="nav-link payment-li">
            	<i class="icon ion-md-filing"></i> Payment 
            </a>
          </li>
          <li class="nav-item setting">
            <a href="<?=base_url?>/admin/websites" class="nav-link payment-li">
            	<i class="icon ion-md-globe"></i> Website(S) 
            </a>
          </li>
          <li class="nav-item setting">
            <a href="<?=base_url?>/admin/wallet" class="nav-link wallet-li">
            	<i class="icon ion-md-filing"></i> Wallet 
            </a>
          </li>

          <li class="nav-item">
            <a href="#submenu" class="nav-link with-sub"><i class="typcn typcn-clipboard"></i>CMS</a>
            <ul class="nav-sub">
              <li class="nav-sub-item"><a href="<?=base_url?>/cms/page" class="nav-sub-link">Pages</a></li>
              <li class="nav-sub-item"><a href="<?=base_url?>/cms/menu" class="nav-sub-link">Menu</a></li>
              <li class="nav-sub-item"><a href="<?=base_url?>/cms/setting" class="nav-sub-link ">Setting  </a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#submenu" class="nav-link with-sub"><i class="typcn typcn-clipboard"></i>Setting</a>
            <ul class="nav-sub">
              <li class="nav-sub-item"><a href="<?=base_url?>/plans" class="nav-sub-link">Manage Plan Price</a></li>
              <!--li class="nav-sub-item"><a href="<?=base_url?>/cms/menu" class="nav-sub-link">Menu</a></li>
              <li class="nav-sub-item"><a href="<?=base_url?>/cms/setting" class="nav-sub-link ">Setting  </a></li-->
            </ul>
          </li>
          
          
        </ul><!-- nav -->
      </div><!-- az-sidebar-body -->

      <script>
        var current_url = window.location.href;
        $('.all-menu-links a').each(function(){

          if( current_url == $(this).attr('href')){
            
            if($(this).hasClass('nav-sub-link')){ 
                $(this).closest('.nav-item').addClass('active show');
                $(this).parent().addClass('active');
            }
            else
                $(this).addClass('active');
          }    

        }); 
      </script>