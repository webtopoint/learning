</section>		
<?php
    $s="background:none;";$over=""; 
   $f =  $CI->ThemeModel->getCustomCss(array('element'=>'footer'));
   if($f->num_rows())
   {
      $css = json_decode($f->row()->css);
      
      if($css->imgName)
       $s.= "background-image:url('".base_url."/public/temp/".CLIENT_ID."/".$css->imgName."')!important; background-size:100% 100%!important; background:no-repeat; ";
      if($css->backColor)
        $over.= "background-color:".hex2rgba($css->backColor,round($css->opacity/100,2))."!important";
   }
    ?>
		<footer id="footer" style="<?=$s?> padding: 0px;">
			<div style="width:100%; height: auto; padding: 60px 0px 60px 0px; <?=$over?>">

				<div class="container">
					<div class="footer-top clearfix">
						
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

						
					</div>
				</div>
				
				<!-- <div class="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-sm-6"><p>Coyright © 2016 Advisor. All rights reserved.</p></div>
							<div class="col-md-6 col-sm-6"><p class="text-right">Designed by <a href="#.">Brighthemes</a></p></div>
						</div>
					</div>
				</div> -->
				</div>
			</footer>
			
			
			
            
		<!-- FOOTER SCRIPTS
		================================================== -->
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/jquery-2.2.0.js"></script>
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/smooth-scroll.js"></script>
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/bootstrap.min.js"></script>
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/counter.js"></script>
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/common.js"></script>
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/scripts.js"></script>
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>js/hero-slider.js"></script>
		
		
		<!-- DEMO -->
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>demo-files/js/jquery.cookie.js"></script>
		<script src="<?=site_url('public/theme/'.FileDirecory.'/')?>demo-files/js/switcher.js"></script>
		
		
    </body>

<!-- Mirrored from wahabali.com/work/advisor/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Jun 2020 12:17:50 GMT -->
</html>