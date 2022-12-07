<?

require_once 'header.php';

$id = AJ_DECODE($id);

$service = $this->ServiceModel->getFileService(array('id'=>$id));
if(!$service->num_rows())
{
    echo'<div class="alert alert-danger">No Service Found</div>';
}
$sdata = $service->row();

$form = $this->FormModel->getFormModel(array('id'=>$sdata->formid))->row();

?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Manage File Service

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>
</div>


<div class="row">
    <div class="col-lg-4">
        <div class="main-card mb-3 card">
        <form action="" method="post">
            <input type="hidden" name="task" value="update">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="card-header">Update File Service Form
            </div>
             <div class="card-body">
                <div class="form-group">
                    <label>File Service Name</label>
                    <input type="text" name="serviceName" class="form-control" value="<?=$sdata->service_name?>">
                </div>
                <div class="form-group">
                    <label>Download Option</label><br>
                    <input type="radio" name="download" value="1" <?=$sdata->download_permission?'checked':''?>> Yes<br>
                    <input type="radio" name="download" value="0" <?=$sdata->download_permission?'':'checked'?>> No
                    
                </div>
               
             </div>
             <div class="d-block text-right card-footer">
                <button type="submit" class="btn-wide btn btn-success">Save</button>
            </div>
        </form>
        </div>
    </div>
     <div class="col-lg-8 ">
        <div class="main-card mb-3 card">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="task" value="add-file">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="card-header">Upload File
            </div>
             <div class="card-body">
               <?php
               if(isJson($form->fields))
               {
                    foreach (json_decode($form->fields) as  $value)
                    {
                        echo'<div class="form-group">'.$value.'</div>';
                    }
               }
               ?>
                    <div class="form-group">
                        <label>Attach File</label>
                        <input type="file" name="attechedFile" class="form-control" required>
                    </div>
             </div>
             <div class="d-block text-right card-footer">
                <button type="submit" class="btn-wide btn btn-success">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 ">
        <div class="main-card mb-3 card">
            <div class="card-header">Upload File</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr><th>#</th><th>Data</th><th>File</th><th>Action</th></tr>
                     <?php 
                     $i=1;
                    $all = $this->ServiceModel->getFileServiceData(array('service_id'=>$id));
                    foreach ($all->result() as $res) 
                    {   $data='';
                        foreach (json_decode($res->data) as $key => $value) 
                        {
                           $data.= $value.'<br>';
                        }
                        echo'<tr class="tt-'.$res->id.'"><td>'.$i++.'</td><td>'.$data.'</td><td><a href="'.site_url('public/temp/'.CLIENT_ID.'/'.$res->file).'">'.$res->file.'</a></td><td><a href="javascript:void(0)" class="btn btn-danger delete-file-one btn-xs btn-sm" data-id="'.$res->id.'"><i class="fa fa-trash"></i> Delete</a> </td></tr>';
                    }
                    ?>  
                </table>
               
            </div>
        </div>
    </div>
</div>        
<script>
    $('.delete-file-one').click(function(){
        let id = $(this).data('id');
        
        $.confirm({
            type : 'red',
            title : 'Confirmation!',
            icon : 'fa fa-bell',
            content : 'Are you sure for delete.',
            buttons : {
                delete : {
                    text        : '<i class="fa fa-trash"></i> Delete',
                    btnClass    : 'btn-danger',
                    action      : function(){
                        $.ajax({
                            type : 'POST',
                            url : '<?=base_url?>/Admin/AJAX',
                            data : { id : id  , var : 'DeleteServiceItem'},
                            dataType: 'json',
                            success:function(res){
                                console.log(res);
                                $('.tt-'+id).hide();
                            },
                            error:function(a,v,c){
                                console.log(a.responseText);
                            }
                        });
                    }
                },
                cancel:function(){}
            }
        });
    });
</script>
<?php
require_once 'footer.php';
?>