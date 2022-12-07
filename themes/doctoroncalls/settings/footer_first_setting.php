<div class="row">
    <div class="col-md-12">
        {_extra_setting_form_}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Footer First Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <?php
                        $id = 'footer_description';
                        echo form_label('Enter Description',$id)
                            .form_textarea($id,$this->ES->get(['type' => $id],true),'class="form-control" rows="3" id="'.$id.'" placeholder="Enter Description"');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        $id = 'footer_location';
                        echo form_label('Enter Location',$id)
                            .form_input($id,$this->ES->get(['type' => $id],true),'class="form-control" id="'.$id.'" placeholder="Enter Location"');
                        ?>
                    </div>
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
                </div>
                <div class="card-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
        </form>
    </div>
</div>