</div>
</div>
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
    <p id="back-top">
        <a href="#top"><span></span>Back to Top</a>
    </p>
    <!-- C. FOOTER AREA -->
    <div class="footer"  style="<?=$s?> padding: 0px;">

        <div style="width:100%; height: auto; padding: 60px 0px 60px 0px; <?=$over?>">

            <div class="container-fluid">
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


       <!--  <div id="footerslider">
            <div id="imageloader" style="display: none;">
                <img src="images/ajax-loader.gif">
            </div>
            <img src="sliderimages/n-1.jpg" style="left: 245px; display: inline;">
            <img src="sliderimages/n-2.jpg" style="left: 478px; display: inline;">
            <img src="sliderimages/n-3.jpg" style="left: 711px; display: inline;">
            <img src="sliderimages/n-4.jpg" style="left: 944px; display: inline;">
            <img src="sliderimages/n-5.jpg" style="left: 1177px; display: inline;">
            <img src="sliderimages/n-6.jpg" style="left: 1384px; display: inline;">
            <img src="sliderimages/n-7.jpg" style="left: 1591px; display: inline;">
            <img src="sliderimages/n-8.jpg" style="left: 1825px; display: inline;">
            <img src="sliderimages/n-9.jpg" style="left: 2058px; display: inline;">
            <img src="sliderimages/n-10.jpg" style="left: 2265px; display: inline;">
            <img src="sliderimages/n-11.jpg" style="left: -219px; display: inline;">
            <img src="sliderimages/n-12.jpg" style="left: 14px; display: inline;">
            <img src="sliderimages/n-13.jpg" style="left: 214px; display: inline;">
            <img src="sliderimages/n-14.jpg" style="left: 614px; display: inline;">
            <img src="sliderimages/n-15.jpg" style="left: 814px; display: inline;">
        </div> -->


       <!--  <p>
            Copyright &copy; 2012 Purohit Contruction Ltd. &nbsp;&nbsp;|&nbsp; &nbsp;All Rights
            Reserved</p>
        <div class="social_wrapper">
            <ul>
                <li><a href="SiteMap.html" target="_blank">
                    <img src="images/sitemap.png" alt="" /></a></li>
                <li><a href="https://twitter.com/PCL_SOPAN" target="_blank">
                    <img src="images/twitter.png" alt="" /></a></li>
                <li><a href="http://www.facebook.com/pages/Purohit-Construction/506520102714820?ref=hl"
                    target="_blank">
                    <img src="images/facebook.png" alt="" /></a></li>
                <li class="flickr"><a href="http://www.flickr.com/photos/91632893@N03" target="_blank">
                    <img src="images/flickr.png" alt="" /></a></li>
                
                
                
                
            </ul> -->
            
        </div>
    </div>
    </form>
</body>

<!-- Mirrored from www.purohitconstruction.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jun 2020 12:35:18 GMT -->
</html>