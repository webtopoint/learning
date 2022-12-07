<div class="row">
    
    <div class="col-md-4">
        <?php
        echo form_open_multipart('','',['type'=>'logo']);
        ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Logo</h3>
                </div>
                <div class="card-body">
                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?=base_url('static/back')?>/media/svg/avatars/blank-dark.svg')">
                    	<!--begin::Preview existing avatar-->
                    	<div class="image-input-wrapper w-225px h-225px" style="background-image: url('<?=config_item('admin_logo')?>')"></div>
                    	<!--end::Preview existing avatar-->
                    	<!--begin::Label-->
                    	<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                    		<i class="fa fa-edit fs-7"></i>
                    		<!--begin::Inputs-->
                    		<input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                    		<input type="hidden" name="avatar_remove">
                    		<!--end::Inputs-->
                    	</label>
                    	<!--end::Label-->
                    	<!--begin::Cancel-->
                    	<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar">
                    		<i class="fa fa-times fs-2"></i>
                    	</span>
                    	<!--end::Cancel-->
                    	<!--begin::Remove-->
                    	<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
                    		<i class="fa fa-times fs-2"></i>
                    	</span>
                    	<!--end::Remove-->
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
