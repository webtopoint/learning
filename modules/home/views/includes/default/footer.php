

    <?php
    $s="";$over=""; 
    $CI = & get_instance();
   $f =  $CI->ThemeModel->getCustomCss(array('element'=>'footer'));
   if($f->num_rows())
   {
      $css = json_decode($f->row()->css);
       
      if($css->imgName)
       $s.= "background-image:url('".client_file($css->imgName)."')!important; background-size:100% 100%!important; background:no-repeat; ";
      else if($css->backColor)
        $over.= "background-color:".hex2rgba($css->backColor,round($css->opacity/100,2));
     
   }
    ?>

    <footer class="site-footer" style="<?=$s?> padding: 0px;">
      <div style="width:100%; height: auto; /*padding: 60px 0px 60px 0px;*/ padding-top:12px; <?=$over?>">
      <div class="container">
          
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
        
        <div class="row">

          <div class="col-md-12 text-center">
 
            <strong>

           Copyright © {_YEAR_}  <a href="<?=base_url?>"> <?=web_plugin('title')?> </a>

            </strong>

          </div>

          

        </div>

      </div>
    </div>
    </footer>

  </div>





  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/jquery-migrate-3.0.1.min.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/jquery-ui.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/popper.min.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/bootstrap.min.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/owl.carousel.min.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/jquery.stellar.min.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/jquery.countdown.min.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/jquery.magnific-popup.min.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/bootstrap-datepicker.min.js"></script>

  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/aos.js"></script>


   
  <script src="<?=site_url('public/theme/'.FileDirecory)?>/js/main.js"></script>

    <script>

        $(document).keydown(function(e){

            if(e.which === 123){

               return false;

            }

        });
        //alert($( document ).height());
        $('body').height( $( '.site-wrap' ).height()+'px' );

    </script>
    

  </body>

</html>