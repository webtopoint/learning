<div class="row"><div class="col-md-12">
    {_extra_setting_form_}
    
        <div class="card">
            <div class="card-header bg-success">
                <h3 class="text-white">Gallery Section</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <?php
                    $id = 'gallery_section_title';
                    echo form_textarea($id,$this->ES->get(['type' => $id],true),'class="form-control aryaeditor" rows="3" id="'.$id.'" placeholder="Enter Gallery Title"');
                    ?>
                </div>
                <div class="form-group">
                    <b>Select Gallery</b>
                    <?php
                    $Gal = $this->GalleryModel->image_gallery();
                    ?>
                    <ul class="list-group">
                        <?php
                        $getAllGals = $this->ES->get('gallery_ids',true);
                        $getAllGalsIds = !empty($getAllGals) ? json_decode($getAllGals,true) : [];
                        foreach($Gal->result() as $gal)
                        {
                            $chk = in_array($gal->id,$getAllGalsIds) ? 'checked' : ''; 
                            echo'<li class="list-group-item">
                                    <h5 class="list-group-item-heading"><strong><label><input type="checkbox" name="gallery_ids[]" id="'.$gal->id.'" value="'.$gal->id.'" '.$chk.'>'.$gal->gallery_name.'</label></strong> 
                                        <a href="'.site_url('Admin/image-gallery/'.AJ_ENCODE($gal->id).'/view-images').'" target="_blank"><button class="mb-2 mr-2 border-0 btn-transition btn btn-outline-primary"> View 
                                                    </button></a>
                                    </h5>
                                </li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
            <div class="card-footer">
                {_form_save_button_}
                <?=Modules :: run('settings/set_in_page_button','','gallery_album') ?>
            </div>        
        </div>
   
    {_close_form_}
</div> 

</div>

<?php
echo Modules :: run('settings/tinymce');
?>