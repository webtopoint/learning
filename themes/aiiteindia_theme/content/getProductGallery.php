<?php
            echo'<style>
                  .'.$btnClass.'{
                    color:'.$btn->color.';
                    background-color:'.$btn->backColor.';
                    border:'.$btn->Bsize.'px '.$btn->Bstyle.' '.$btn->Bcolor.';
                    padding:'.$btn->padT.'px '.$btn->padR.'px '.$btn->padB.'px '.$btn->padL.'px; 
                  }
                  .'.$btnClass.':hover
                  {
                    color:'.$btn->textHover.';
                    background-color:'.$btn->backHover.';
                  }
            </style>';

            echo'<div class="container mt-4">
                  <div class="row justify-content-center text-center mb-5">
                   
                    <div class="sec-title text-center">
        
                        <h2>'.$g->gallery_name.'</h2>
        
                        <span class="divider"></span>
        
                    </div>
                  </div>
                  <div class="row hosting">';
                   if($images->num_rows())
                  {
                      foreach ($images->result() as $img)
                      {
                            $link = $img->product_link?$img->product_link:'javascript:void(0)" class="productQuery" data-proId="'.$img->id;
                           echo'<div class="col-md-6 col-lg-'.$width.' mb-5 mb-lg-4 aos-init aos-animate" data-aos="fade" data-aos-delay="100" >
                                  <div class="unit-3 h-100 bg-white">
                                    <div class="" style="height:'.$height.'px" align="center">
                                      <!--<div class="unit-3-icon-wrap mr-12">-->
                                       <img src="'.client_file($img->image).'" "  class="img-fluid" style="height:100%; width:60%;">
                                     <!--- </div>
                                       -->
                                    </div>
            
                                    <div class="unit-3-body">
                                     <p style="font-weight:bold; font-size:18px;text-align:center;">'.$img->title.'</p>';
                                     
                                     if($btn->text) 
                                      echo'<p> <center><a href="'.$link.'"><button class="'.$btnClass.' prdBtn" type="button">'.$btn->text.'</button></a></center></p>';
            
                                    echo'</div>
                                   
                                  </div>
                                </div>';
                      }
                  }
                  else
                  {
                      echo'<font color="red">No Data Available</font>';
                  }
                echo'</div>
                </div>';
?>