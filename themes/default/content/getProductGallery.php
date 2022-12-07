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

            echo'<div class="container">
                  <div class="row justify-content-center text-center mb-5">
                    <div class="col-md-12 aos-init aos-animate" data-aos="fade">
                      <h2>'.$g->gallery_name.'</h2>
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
                                    <div class="d-flex align-items-center mb-3 unit-3-heading" style="height:'.$height.'px">
                                      <!--<div class="unit-3-icon-wrap mr-12">-->
                                       <img src="'.client_file($img->image).'" "  class="img-fluid" style="height:100%; width:100%;">
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