<section class="clients-section alternate2">
        <div class="container-fluid">

            <div class="content-box wow fadeInUp animated animated" style="visibility: visible; animation-name: fadeInUp;">
                <div class="sec-title text-center">

                    <h2><?=$g->gallery_name?></h2>
    
                    <span class="divider"></span>
    
                </div>
               
                <div class="row">
                    
                    <?php
                    
                    if($videos->num_rows())
                    {
                        foreach ($videos->result() as $vid)
                        {
                          $yid = explode('=', $vid->video);
                          $top = 'View';
                          if($vid->type == 'video'){
                              
                              $video = base_url.'/public/web/video_thumb.jpg';
                              $link  = base_url.'/public/temp/'.CLIENT_ID.'/'.$vid->video;
                          }
                          else{
                              
                                $video =  'https://img.youtube.com/vi/'.@$yid[1].'/hqdefault.jpg'; 
                                $top  = '<img src="'.base_url.'/public/custom/youtube logo.png" >';
                                $link = 'https://www.youtube.com/embed/'.@$yid[1];
                          }
                          
                          ?>
                        <!-- Gallery Block -->
                        <div class="gallery-block col-lg-<?=$width?> col-md-6 col-sm-12" style="height:<?=$height?>px;    padding:2px;">
            
                            <div class="image-box">
            
                                <figure class="image">
            					
            					<img src="#" alt="">
            					<a href="<?=$video?>" class="lightbox-image"><img src="<?=$video?>" alt=""></a>
            					
            					</figure>
            
                                <div class="overlay-box">
                                        <a href="<?=$link?>" class="lightbox-image">
                                     
            
                                    <h3><?=$top?></h3>
            
                                    </a>
            
                                </div>
            
                            </div>
            
                        </div>
                        <?php
                        }
                    }
                    else
                    {
                      echo'<font color="red">No Data Available</font>';
                    }
                    
                    ?>
                    

 
           
 

             

        </div>

            </div>

        </div>
    </section>