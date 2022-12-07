<?php
            echo'<br>
            <div class="col-md-12 col-lg-12 aos-init aos-animate GalleryBox" data-aos="fade">
            <div class="unit-7 pricing-table-modern__item">
              <div class="pricing-table__item-header">
                <div class="pricing-table__item-header-bg">
                  <div class="pricing-table__item-header-bg-inner"></div>
                </div>
                <p class="pricing-table__item-title mb-0">'.$g->gallery_name.'</p>
              </div>
              <div class="pricing-table__item-main" align="center" style=""><div class="row">'; 
                        if($images->num_rows())
                        {
                            foreach ($images->result() as $img)
                            {
                              echo'<div class="col-lg-'.$width.'"  style="height:'.$height.'px;    padding:2px;">
                                   <img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$img->image.'" class="img-fluid" style="height:100%; width:100%;" onmouse>
                                  </div>';
                            }
                           // echo'<div class="pricing-table__item-control" style="margin:5px;">
                            //<a class="btn btn-secondary rounded-0 py-2 px-4" href="#">More</a></div>';
                        }
                        else
                        { 
                          echo'<font color="red">No Data Available</font>';
                        }
                    echo'</div> </div>
                      </div>
                   </div><br>';
?>