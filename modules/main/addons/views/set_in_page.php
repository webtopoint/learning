<?php
extract($data);
// echo $type;

$col = $flag ? 6 : 12;
$title = isset($title) ? $title : ucwords(str_replace('_',' ',$type));

$type_id = isset($type_id) ? $type_id : 0;
$where = ['type' => $type,'type_id' => $type_id];
// echo form_open(base_url('addons/set_in_page'),'class="form_set-in-page-'.$type.'"',$where);


$_list_pages = $this->db->order_by('title','ASC')->get('pages');



?>
<style>
    label.loading{
        position: absolute;
        background: #030303a1;
        top: 0;
        height: 100%;
        width: 100%;
        left: 0;
        border-radius: 2px;
        line-height: 3;
        text-align: center;
    }
    label.loading i{
        color:white;
    }
</style>
<div class="row">
    <div class-"col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><?=$title?> Set in Page</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-<?=$col?>">
                        <div class="card bg-primary">
                            <div class="card-header">
                                <h3 class="card-title">List Page(s)</h3>
                            </div>
                            <div class="card-body" style="padding:10px;height:300px;overflow-x:hidden">
                                <ul class="list-group" data-type="page">
                                    <?php
                                    if($_list_pages->num_rows()){
                                        foreach($_list_pages->result() as $page):
                                            $where['page_id'] = $page->id;
                                                $where['section'] = 'page';
                                            $checked = $this->db->get_where('page_schema',$where)->num_rows() ? 'checked' : '';
                                    ?>
                                    <li class="list-group-item">
                                        <label style="margin-bottom:3px" class="form-check form-switch form-check-custom form-check-solid pulse pulse-primary">
                							<input class="form-check-input w-30px h-20px parent-input" data-type="<?=$type?>" data-id="<?=$type_id?>" type="checkbox" <?=$checked?> name="page_id[]" value="<?=$page->id?>">
                							<span class="pulse-ring ms-n1"></span>
                							<span class="form-check-label text-gray-600 fs-7"><?=$page->title?></span>
                						</label>
                                    </li>
                                    <?php
                                        endforeach;
                                    }else{
                                        echo '<li><div class="alert alert-danger">Page(s) not found..</div></li>';
                                    }
                                    
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($flag):
                        
                        $_list_static_pages = $this->db->order_by('page','ASC')->get('static_pages');
                    ?>
                        <div class="col-md-<?=$col?>">
                            <div class="card bg-danger">
                                <div class="card-header">
                                    <h3 class="card-title">List Static Page(s)</h3>
                                </div>
                                <div class="card-body" style="padding:10px;height:300px;overflow-x:hidden">
                                    <ul class="list-group" data-type="static">
                                        <?php
                                        if($_list_static_pages->num_rows()){
                                            foreach($_list_static_pages->result() as $page):
                                                $where['page_id'] = $page->id;
                                                $where['section'] = 'static';
                                                $checked = $this->db->get_where('page_schema',$where)->num_rows() ? 'checked' : '';
                                        ?>
                                        <li class="list-group-item">
                                            <label style="margin-bottom:3px" class="form-check form-switch form-check-custom form-check-solid pulse pulse-danger">
                    							<input class="form-check-input w-30px h-20px parent-input" type="checkbox" data-type="<?=$type?>" data-id="<?=$type_id?>" <?=$checked?> name="static_page_id[]" value="<?=$page->id?>">
                    							<span class="pulse-ring ms-n1"></span>
                    							<span class="form-check-label text-gray-600 fs-7"><?=$page->page?></span>
                    						</label>
                                        </li>
                                        <?php
                                            endforeach;
                                        }else{
                                            echo '<li><div class="alert alert-danger">Page(s) not found..</div></li>';
                                        }
                                        
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="card-footer">
                <!--<button class="btn btn-success"><i class="fa fa-save"></i> Save</button>-->
            </div>
        </div>
    </div>
</div>




<?php
// echo form_close();
?>
<script>
    
    $(function(){
        $('.parent-input').change(function(){
            var type = $(this).data('type'),
                section = $(this).closest('ul').data('type'),
                type_id = $(this).data('id'),
                page_id = $(this).val(),
                li = $(this).closest('li')
                loader = `
						<label class="loading">
						    <i class="fa fa-spin fa-spinner"></i> Please Wait...
						</label>`;
                
                li.append(loader);
                
                $.ajax({
                    type : 'POST',
                    url : '<?=base_url('addons/set_in_page')?>',
                    data : {type,section,type_id,page_id},
                    dataType : 'json',
                    success : function(re){
                        // console.log(re);
                        toastr.success('Schema Update Successfully.');
                        li.find('.loading').slideUp('slow',function(){
                            $(this).remove();
                        });
                    },
                    error: function(r,b,c){
                        console.warn(r.responseText);
                    }
                });
                
            
        });
    });
</script>