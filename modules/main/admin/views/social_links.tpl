<div class="row">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="col-md-12">
        <?php
        echo form_open();
        ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Social Links</h3>
                </div>
                <div class="card-body">
                    <?php
                    
                    $get = $this->db->order_by('seq','ASC')->get('social_links');
                    if($get->num_rows()){
                    
                        foreach($get->result() as $link){
                        
                            ?>
                            <div class="form-group">
                                <div class="position-relative me-md-2">
        							<span class=" position-absolute top-50 translate-middle ms-6">
        								<i class="fa fa-<?=$link->name?>"></i>
        							</span>
        							<input type="text" class="form-control form-control-solid ps-10" name="<?=$link->name?>"  placeholder="<?=ucwords($link->name)?>" value="<?=$link->value?>">
        						</div>
                            </div>
                            <?php
                        
                        }
                    
                    
                    }
                    
                    ?>
                    
                    
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

<style>
    .form-group{
        margin-bottom:10px;
    }
</style>