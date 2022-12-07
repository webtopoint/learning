<section class="clients-section alternate2  gallery ">
        <div class="container-fluid">

            <div class="content-box wow fadeInUp animated animated" style="visibility: visible; animation-name: fadeInUp;">

               
                <div class="row">
                    
                    <?php
                    if($images->num_rows())
                    {
                        foreach ($images->result() as $img)
                        {
                        //   echo'<div class="col-lg-'.$width.'"  style="height:'.$height.'px;    padding:2px;">
                        //       <img src="'..'" class="img-fluid" style="height:100%; width:100%;" onmouse>
                        //       </div>';
                              $image  = base_url('assets/file/'.$img->image);
                        ?>
                        <!-- Gallery Block -->
                        <div class="gallery-block col-lg-<?=$width?> col-md-6 col-sm-12" style="   padding:2px;">
            
                            <div class="image-box">
            
                                <figure class="image">
            					<a href="<?=$image?>" class="lightbox-image"><img src="<?=$image?>" alt=""></a>
            					
            					</figure>
            
                                <!--div class="overlay-box">
                                        <a href="<?=$image?>" class="lightbox-image">
                                     
            
                                    <h3><?=$g->gallery_name?></h3>
            
                                    </a>
            
                                </div-->
            
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