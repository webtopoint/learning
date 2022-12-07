<div class="row">
    <div class="col-md-4">
        {_extra_setting_form_}
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Header Right Button</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <?php
                        $id = 'header_right_button_text';
                        echo form_label('Enter Text',$id)
                            .form_input($id,$this->ES->get(['type' => $id],true),'class="form-control" id="'.$id.'" placeholder="Enter Text"');
                        ?>
                     </div>
                    <div class="form-group">
                        <?php
                        $id = 'header_right_button_link';
                        echo form_label('Enter Text',$id)
                            .form_input($id,$this->ES->get(['type' => $id],true),'class="form-control" id="field-value" placeholder="Enter Link"');
                        ?>
                        <button type="button" class="our-page-links btn btn-primary btn-xs mt-3">Set Our Page in this link</button>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>


</div>


