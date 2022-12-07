
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
<div class="clr"></div>
<div id="footer"  style="<?=$s?> padding: 0px;">
	<div style="width:100%; height: auto; padding: 60px 0px 60px 0px; <?=$over?>">

		<div class="divinner">
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
		<div class="divinner">
			
		</div>
	</div>
			<!--<div class="copyright">-->
			<!--	<div class="divinner">-->
			<!--		<p class="textcenter whitetext mb_0">&#9400; 2020. All Rights Reserved. Geolife Group | Powered by <a href="https://convergenceservices.in/" target="_blank">Convergence Services</a></p>-->
			<!--	</div>-->
			<!--</div>-->
			<div class="clr"></div>
</div>
	
</body>
</html>