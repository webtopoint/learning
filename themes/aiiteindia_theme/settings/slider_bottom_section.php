<div class="row">
    <div class="col-md-12">
        <?php
        echo form_open_multipart('settings/v1/submit');
        $content = $this->ThemeModel->get_theme_templates(11,'content');
        ?>
        <div class="card">
            <div class="card-header">
                <strong>Slider Bottom Section</strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="aryaeditor" name="slider_bottom_section"><?=$this->SiteModel->extra_setting('slider_bottom_section',true,$content)?></textarea>
                    <?php
                    // $id = 'slider_bottom_section';
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
</div>
<?php
    echo $this->settings->tinymce(['content_style' => 'body{padding-top:160px}']);
    ?>