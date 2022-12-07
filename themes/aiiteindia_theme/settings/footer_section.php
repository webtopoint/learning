<div class="row">
    <div class="col-md-3">
        <?php
        echo form_open_multipart('settings/v1/submit');
        ?> 
        <div class="card">
            <div class="card-header">
                <strong>Footer Setting</strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <?php
                    $id = 'footer_mobile';
                    echo form_label('Enter Mobile',$id)
                        .form_input($id,$this->ES->get(['type' => $id],true),'class="form-control" id="'.$id.'" placeholder="Enter Mobile"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $id = 'footer_email';
                    echo form_label('Enter Email',$id)
                        .form_input($id,$this->ES->get(['type' => $id],true),'class="form-control" id="'.$id.'" placeholder="Enter Email"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $id = 'footer_address';
                    echo form_label('Enter Address',$id)
                        .form_input($id,$this->ES->get(['type' => $id],true),'class="form-control" id="'.$id.'" placeholder="Enter Address"');
                    ?>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
        
        <?php
        echo form_close();
        ?>
    </div>
    
    <div class="col-md-6">
        <?php
        
        $default = '<ul class="user-links">

                    <li><a href="#">About AIITE</a></li>
                  <li><a href="#">Founder &amp; Chairman</a></li>
                  <li><a href="#">Vision</a></li>
                  <li><a href="#">Mission</a></li>
                  <li><a href="#">Board of Directors</a></li>
                  <li><a href="#">Accreditation</a></li>
                  <li><a href="#">Quality Policy</a></li>
                  <li><a href="#">The Mark of Excellence</a></li>
			  

                </ul>';
        
        
        $content = '<textarea class="aryaeditor" name="footer_second_section">'.$this->SiteModel->extra_setting('footer_second_section',true,$default).'</textarea>';
        $this->settings->create_links('footer_second_section','Usefull Links',true,$content);
        
        
        ?>
    </div>
    <br>
    
    <div  class="col-md-6">
        <?php
         $content = '<textarea class="aryaeditor" name="footer_third_section">'.$this->SiteModel->extra_setting('footer_third_section',true,$default).'</textarea>';
         $this->settings->create_links('footer_third_section','Academic',true,$content);
        ?>
    </div>
    <br>
    <div  class="col-md-6">
        <?php
         $content = '<textarea class="aryaeditor" name="footer_forth_section">'.$this->SiteModel->extra_setting('footer_forth_section',true,$default).'</textarea>';
         $this->settings->create_links('footer_forth_section','',true,$content);
        ?>
    </div>
    
    
    <?php
    echo $this->settings->tinymce(['content_style' => 'body{background:black}']);
    ?>
    
    
    
</div>