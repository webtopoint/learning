

    <?php
    $s="";$over=""; 
   $f =  $CI->ThemeModel->getCustomCss(array('element'=>'footer'));
   if($f->num_rows())
   {
      $css = json_decode($f->row()->css);
       
      if($css->imgName)
       $s.= "background-image:url('".base_url."/public/temp/".CLIENT_ID."/".$css->imgName."')!important; background-size:100% 100%!important; background:no-repeat; ";
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

           Copyright © <?=date('Y')?>  <a href="<?=base_url?>"><?=@$title?></a>

            </strong>

          </div>

          

        </div>

      </div>
    </div>
    </footer>

  </div>
    

  </body>

</html>