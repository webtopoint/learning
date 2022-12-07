<?php
echo'<br>
            <div class="col-md-12 col-lg-12 aos-init aos-animate " data-aos="fade">
            <div class="unit-7 pricing-table-modern__item">
              <div class="pricing-table__item-header">
                <div class="pricing-table__item-header-bg">
                  <div class="pricing-table__item-header-bg-inner"></div>
                </div>
                <p class="pricing-table__item-title mb-0"><i class="fa fa-picture-o"></i> '.$g->gallery_name.'</p>
              </div>
              <div class="pricing-table__item-main" align="center" style="padding:3px;">'; 
                        if($videos->num_rows())
                        {
                            foreach ($videos->result() as $vid)
                            {
                              $yid = explode('=', $vid->video);
                              $top = '';
                              if($vid->type == 'video'){
                                  
                                  $video = base_url.'/public/web/video_thumb.jpg';
                                  $link  = base_url.'/public/temp/'.CLIENT_ID.'/'.$vid->video;
                              }
                              else{
                                  
                                    $video =  'https://img.youtube.com/vi/'.@$yid[1].'/hqdefault.jpg'; 
                                    $top  = '<img src="'.base_url.'/public/custom/youtube logo.png" class="youtube-v-thumb">';
                                    $link = 'https://www.youtube.com/embed/'.@$yid[1];
                              }
                              
                              echo'
                              <div class="VideoBox post-entry bg-white col-sm-12 col-md-6 col-lg-'.$width.'" style=" margin:1px;  height:'.$height.'px; display:inline-block;  ">
                                <div class="image" style="height:100%;">
                                 
                                  <img src="'.$video.'"   class="img-fluid" style="height:100%; width:100%;" data-link="'.$link.'">
                                  '.$top.'
                               </div>
                              </div>';
                            }
                            echo'<div class="pricing-table__item-control" style="margin:5px;">
                            <a class="btn btn-secondary rounded-0 py-2 px-4" href="#">More</a></div>';
                        }
                        else
                        {
                          echo'<font color="red">No Data Available</font>';
                        }
                    echo'</div>
                      </div>
                   </div><br>';
                   ?>