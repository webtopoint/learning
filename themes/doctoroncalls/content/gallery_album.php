<section class="gallery-section sortable-masonry">
    <div class="auto-container">
        <?php
        $rendomClass = 'class-'.mt_rand(333,9999);
        $gallery_ids = extra_setting('gallery_ids');
        $gallery_ids = !empty($gallery_ids) ? json_decode($gallery_ids,true) : [];
        $GALLERIES = [];
        ?>
        <!--Filter-->
        <div class="filters text-center">
            <ul class="filter-tabs filter-btns clearfix anim-3-all">
                <li class="active filter" data-role="button" data-filter=".<?=$rendomClass?>">All</li>
                <?php
                if($gallery_ids){
                    foreach($gallery_ids as $id){
                        $get = $this->GalleryModel->image_gallery($id);
                        if($get->num_rows()){
                            $row = $get->row();
                            $GALLERIES[$row->id] = $row->gallery_name;
                            echo '<li class="filter" data-role="button" data-filter=".'.$rendomClass.'-'.$id.'">'.$row->gallery_name.'</li>';
                        }
                    }
                }
                ?>
                <!--li class="filter" data-role="button" data-filter=".environment">Child</li>
                <li class="filter" data-role="button" data-filter=".eco">Charity</li>
                <li class="filter" data-role="button" data-filter=".energy">Volunteering</li>
                <li class="filter" data-role="button" data-filter=".animals">Sponsorship</li>
                <li class="filter" data-role="button" data-filter=".plants">Plants</li-->
            </ul>
        </div>
        
        <div class="images-container">
        
        <div class="items-container row clearfix" style="position: relative; height: 1054.34px;">
            <?php
            if($gallery_ids){
                foreach($gallery_ids as $id){
                    $getImages = $this->GalleryModel->list_galllery_images(array('gallery_id'=>$id,'admin_id'=>CLIENT_ID));
                    if($getImages->num_rows()):
                        foreach($getImages->result() as $row):
                    ?>
                    <!--Column-->
                    <div class="column <?=$rendomClass?> <?=$rendomClass.'-'.$id?> col-md-4 col-sm-6 col-xs-12" style="position: absolute; left: 0px; top: 0px;">
                        <!--Default Portfolio Item-->
                        <div class="default-portfolio-item">
                            <div class="inner-box text-center">
                                <!--Image Box-->
                                <figure class="image-box"><img src="<?=client_file($row->image)?>" alt=""></figure>
                                <div class="overlay-box">
                                    <div class="inner-content">
                                        <div class="content">
                                            <h3><a href="#"><?=isset($GALLERIES[$id]) ? $GALLERIES[$id] : ''?></a></h3>
                                            <a class="arrow lightbox-image" href="<?=client_file($row->image)?>" title="Image Caption Here"><span class="icon flaticon-cross-4"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    endif;
                }
            }

            ?>
            
            
            
            
        </div>
        </div>
        
    </div>
</section>