<footer class="footer-area">
  <div class="container">
	  <div class="footer-header">
	    <h2><?=@$website->title?></h2>
	  </div>
	  
	  
	  <?php

          $foo = $CI->WidgetModel->getWidgetFooter();

          if($num = $foo->num_rows())
          { $j=0;
            $result = $foo->result();
           // print_r($result);exit();
            while($num>0)
            {   $y = $num<=4?$num:4;
                $x  = (int)12/$y;
                
                echo'<div class="row">';
                for($i=1;$i<=$y;$i++)
                {
                    $res = $result[$j];
                   echo  '<div class="col-md-'.$x.'">'.getWidget($res->widget_id).'</div>';
                   $num--; $j++;
                }
                echo'</div>';
            }
             
          }

          ?>
	  
	  
	  
	  
	  
 <!--   <div class="row">-->
 <!--           <div class="footer-main-menu">-->
 <!--       <h3><a href="career16plus.html">-->
 <!--         CAREER16PLUS          </a></h3>-->
 <!--       <ul class="list-unstyled">-->
 <!--                   <li><a href="career16plus/jobs.html">-->
 <!--           JOBS            </a></li>-->
 <!--                   <li><a href="career16plus/education-news.html">-->
 <!--           EDUCATION NEWS             </a></li>-->
 <!--                   <li><a href="career16plus/special-report.html">-->
 <!--           SPECIAL REPORT             </a></li>-->
 <!--                 </ul>-->
 <!--     </div>-->
 <!--           <div class="footer-main-menu">-->
 <!--       <h3><a href="entertainment.html">-->
 <!--         ENTERTAINMENT           </a></h3>-->
 <!--       <ul class="list-unstyled">-->
 <!--                   <li><a href="entertainment/television.html">-->
 <!--           TELEVISION            </a></li>-->
 <!--                   <li><a href="entertainment/bollywood.html">-->
 <!--           BOLLYWOOD            </a></li>-->
 <!--                 </ul>-->
 <!--     </div>-->
 <!--           <div class="footer-main-menu">-->
 <!--       <h3><a href="hindi-news.html">-->
 <!--         HINDI NEWS          </a></h3>-->
 <!--       <ul class="list-unstyled">-->
 <!--                   <li><a href="hindi-news/india-news.html">-->
 <!--           INDIA NEWS            </a></li>-->
 <!--                   <li><a href="hindi-news/world-news.html">-->
 <!--           WORLD NEWS            </a></li>-->
 <!--                   <li><a href="hindi-news/bengal-election.html">-->
 <!--           BENGAL ELECTION             </a></li>-->
 <!--                   <li><a href="hindi-news/states-news.html">-->
 <!--           STATES NEWS            </a></li>-->
 <!--                   <li><a href="hindi-news/bihar-news.html">-->
 <!--           BIHAR NEWS            </a></li>-->
 <!--                 </ul>-->
 <!--     </div>-->
 <!--           <div class="footer-main-menu">-->
 <!--       <h3><a href="puja-pandit.html">-->
 <!--         PUJA PANDIT            </a></h3>-->
 <!--       <ul class="list-unstyled">-->
 <!--                   <li><a href="puja-pandit/festivals.html">-->
 <!--           FESTIVALS             </a></li>-->
 <!--                   <li><a href="puja-pandit/religion.html">-->
 <!--           RELIGION            </a></li>-->
 <!--                 </ul>-->
 <!--     </div>-->
 <!--     		 <div class="footer-main-menu">-->
	<!--		 <h3><a href="#">Services </a></h3>-->
	<!--		 <ul class="list-unstyled">-->
	<!--			 <li><a href="corporate.html">Corporate</a></li>-->
	<!--		 </ul>-->
	<!--	</div>-->
			 
	<!--	<div class="footerSocialIcon">-->
 <!--<h3><a href="#">Social Media </a></h3>-->
	<!--	   <ul>-->
		       
	<!--	       			<li><a href="https://www.facebook.com/thelastbreaking" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>-->
 <!--         <li><a href="https://twitter.com/thelastbreaking" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
 <!--         <li><a href="https://www.instagram.com/thelastbreaking" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
 <!--         <li><a href="https://www.youtube.com/channel/UCZ0bq6OC-cHuc7JVEC02A2w" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>-->
	<!--		<li><a href="https://t.me/thelastbreaking" target="_blank"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a></li>-->
					       
	<!--	   </ul>-->
	<!--	</div>	-->
 <!--   </div>-->
  </div>
  <div class="footer-bottom-holder">
    <div class="container">
        <div class="row text-center">

          <div class="col-md-12">
 
            <strong>

           Copyright © <?=date('Y')?>  <a href="<?=base_url?>"><?=@$website->title?></a>

            </strong>

          </div>

          

        </div>
        
      <!--<div class="row">-->
        
      <!--  <div class="col-md-5">-->
      <!--    <p>Copyright @ Last Breaking Communication Pvt. Ltd.</p>-->
      <!--  </div>-->
      <!--  <div class="col-md-7">-->
      <!--    <ul class="footer-menu">-->
      <!--      <li><a href="contact.html">Contact Us</a></li>-->
      <!--      <li><a href="advertise.html"> Advertise With Us</a></li>-->
      <!--      <li><a href="aboutus.html">About Us</a></li>-->
      <!--      <li><a href="privacyPolicy.html">Privacy Policy</a></li>-->
      <!--      <li><a href="sitemap.html">Site Map</a></li>-->
      <!--      <li><a href="contact.html">Help</a></li>-->
      <!--    </ul>-->
      <!--  </div>-->
        
        
        
        
      <!--</div>-->
      
      
      
    </div>
  </div>
</footer>
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/assets/popper.min.js"></script> 
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/assets/bootstrap.min.js"></script> 
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/assets/owl.carousel.min.js"></script> 
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/assets/jquery.newsticker.min.js"></script> 
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/assets/smooth-scroll.js"></script> 
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/assets/jquery.meanmenu.min.js"></script> 
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/plugins.js"></script> 
<script src="<?=site_url('public/theme/'.FileDirecory)?>/js/custom.js"></script>
<script type="text/javascript">
/*
$(document).bind('cut copy paste',function(e){
    return false;
});
$(document).bind("contextmenu",function(e){
    return false;
});
$(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
    
    if (event.ctrlKey && (event.keyCode === 85 || event.keyCode === 83 || event.keyCode ===65 )) {
       return false;
    }else if (event.ctrlKey && event.shiftKey && event.keyCode === 73){
       return false;
    }
    
    if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {  
      event.preventDefault();  
      } 
});
*/
</script>
<script>
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
var header = $("#guide-template");
  $(window).scroll(function() {    
    var scroll = $(window).scrollTop();
       if (scroll >= 300) {
          header.addClass("fixed");
        } else {
          header.removeClass("fixed");
        }
});
$(window).scroll(function () {

            var scroll_top = $(this).scrollTop();
               if (scroll_top > 66) {//height of header
                 $('.wrapper').addClass('sticky');
              } else {
              $('.wrapper').removeClass('sticky');
              }
       });
     $( () => {
  $('nav input[type="checkbox"]').on('change', function() {
    $('.main-nav input[type="checkbox"]').not(this).prop('checked', false);
    $('.right-nav input[type="checkbox"]').not(this).prop('checked', false);
  });
});
</script>
</body>
<!-- Mirrored from www.thelastbreaking.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Apr 2021 10:12:46 GMT -->
</html>