<?php
require_once 'header.php';
$CI=&get_instance();

 $menuCSS = $this->MenuModel->getMenuCSS();
 $me=$menuCSS->row();
?>




<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Create File Service
                <div class="page-title-subheading"> You can use your form to make File Service
                </div>
            </div>
        </div>
        <div class="page-title-actions">              
        </div>
    </div>
</div>

<?php

$form = $this->FormModel->getFormModel();

if($form->num_rows())
{
?>

<form action="" method="post">
<div class="main-card mb-3 card">
    <div class="card-header">Create File Service Form
    </div>
     <div class="card-body">
        <div class="form-group">
            <label>Choose a form for Data Matching</label>
            <select class="form-control" name="formid">
            <?php
                foreach($form->result() as $data)
                {
                    echo'<option value="'.$data->id.'">'.$data->title.'</option>';
                }
            ?>
            </select>
        </div>

        <div class="form-group">
            <label>File Service Name</label>
            <input type="text" name="serviceName" class="form-control">
        </div>
        <div class="form-group">
            <label>Download Option</label><br>
            <input type="radio" name="download" value="1" checked> Yes<br>
            <input type="radio" name="download" value="0"> No
            
        </div>
       
     </div>
     <div class="d-block text-right card-footer">
        <button type="submit" class="btn-wide btn btn-success">Save</button>
    </div>
</div>
</form>

<?php
$all = $CI->ServiceModel->getFileService();
?>
<div class="main-card mb-3 card">
    <div class="card-header">All Available File Services
    </div>
     <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr><th>#</th><th>Service Name</th><th>Form in Use</th><th>Download Permission</th><th colspan="2">Action</th></tr>
            </thead>
            <?php
                $i=1;
              foreach ($all->result() as $d)
              {
               $formName= $this->FormModel->getFormModel(array('id'=>$d->formid))->row()->title;
                echo'<tr>
                        <td>'.$i++.'</td>
                        <td>'.$d->service_name.'</td>
                        <td>'.$formName.'</td>
                        <td>'.($d->download_permission?'Yes':'No').'</td>
                        <td><a href="'.site_url('Admin/service/'.AJ_ENCODE($d->id)).'" class="btn btn-success">Manage</a></td>
                        <td><button class="btn btn-danger delete-file-serive" data-href="'.site_url('Admin/delete_file_service/'.AJ_ENCODE($d->id)).'"  >Delete</button></a></td>
                    </tr>';
              }
            ?>
        </table>
     </div>
</div>
<script>
    $('.delete-file-serive').click(function(){
        
        let url = $(this).data('href');
        
        $.confirm({
            type:'red',
            title:'Confirmation',
            icon:'fa fa-bell',
            content:'Are you sure for delete it.',
            buttons:{
                ok:{
                    text:'<i class="fa fa-trash"></i> Delete',
                    btnClass:'btn-danger',
                    action:function(){
                       location.href = url;
                    }
                },
                cancel:function(){}
            }
        });
        
    });
</script>

<?
}
else
{
 echo'<div class="alert alert-danger" align="center"> <font size="7"><i class="fa fa-exclamation-triangle"></i></font><br> Please Create atleast 1  Data Form and 1 Payment Method First</div>';
}

require_once 'footer.php';

?>