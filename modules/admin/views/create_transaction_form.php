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
            <div>Create Transaction Form
                <div class="page-title-subheading">You can use your form to make transaction
                </div>
            </div>
        </div>
        <div class="page-title-actions">              
        </div>
    </div>
</div>

<?php

$form = $this->FormModel->getFormModel();
$method = $this->PaymentModel->getPaymentMethod();
if($form->num_rows() && $method->num_rows())
{
?>

<form action="" method="post">
<div class="main-card mb-3 card">
    <div class="card-header">Create Transaction Form
    </div>
     <div class="card-body">
        <div class="form-group">
            <label>Choose a form for Data Collection</label>
            <select class="form-control" name="formid">
            <?php
                foreach($form->result() as $data){
                    echo'<option value="'.$data->id.'">'.$data->title.'</option>';
                }
            ?>
            </select>
        </div>

         <div class="form-group">
            <label>Choose a Payment Method</label>
            <div class="form-control">
                 <?
                 foreach($method->result() as $med)
                    echo '<label style="margin-right:10px"><input type="checkbox" name="methodid[]" value="'.$med->id.'"> '.strtoupper($med->method).'</label>'
                 ?>
            </div>
                <!--select class="form-control custom-select" name="methodid" required>
            <?php
            /*
             foreach($method->result() as $med)
                {
                    echo'<option  value="'.$med->id.'" class="form-check-input"> '.strtoupper($med->method).'</option>
                    ';
                }
            /*
                foreach($method->result() as $med)
                {
                    echo'<div class="position-relative form-check form-check-inline">
                    <label class="form-check-label"><input type="checkbox" name="methodid[]"  value="'.$med->id.'" class="form-check-input"> '.strtoupper($med->method).'</label></div>
                    ';
                }
                */
            ?>
            </select-->
        </div>
        <div class="form-group">
            <label>Transaction Form Name</label>
            <input type="text" name="tformname" class="form-control">
        </div>
        <div class="form-group">
            <label>Min Amount</label>
            <input type="number" name="minamount" class="form-control">
        </div>
        <div class="form-group">
            <label>Fix Amount <small><b>(Leave this blank if You want open Amount)</b></small></label>
            <input type="number" name="fixamount" class="form-control" onkeyup="this.value?$('input[name=minamount]').val(this.value).attr('readonly',true):$('input[name=minamount]').val('').attr('readonly',false)">
        </div>
     </div>
     <div class="d-block text-right card-footer">
        <button type="submit" class="btn-wide btn btn-success">Save</button>
    </div>
</div>
</form>

<?php
$all = $CI->FormModel->getTransactionForm();

?>
<div class="main-card mb-3 card">
    <div class="card-header">All Available Forms
    </div>
     <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr><th>#</th><th>Form Name</th><th>Payment Method</th><th>Min Amount</th><th>Fix Amount</th><th>Action</th></tr>
            </thead>
            <?php
                $i=1;
              foreach ($all->result() as $d)
              {
                $met = '';
                    if($d->payment_method_id[0]=='[')
                    {
                        foreach (json_decode($d->payment_method_id) as $res)
                        {
                            $met.= strtoupper($CI->PaymentModel->getPaymentMethod(array('id'=>$res))->row()->method).'<br>';
                        }
                    }
                    else
                    {
                        $met = strtoupper($CI->PaymentModel->getPaymentMethod(array('id'=>$d->payment_method_id))->row()->method);
                    }
                    
                    
                  echo'<tr class="table-'.$d->id.'"><td>'.$i++.'</td><td>'.$d->tform_name.'</td><td>'.$met.'</td><td>'.$d->min_amount.'</td>
                  
                          <td>'.$d->amount.'</td>
                          <td><button class="btn btn-danger delete-transaction-form" data-id="'.$d->id.'">Delete</button></a></td>
                          
                      
                      </tr>';
              }
            ?>
        </table>
     </div>
</div>
<script>
    $('.delete-transaction-form').click(function(){
        let id = $(this).data('id');
        $.confirm({
            type:'red',
            icon:'fa fa-bell',
            title:'Confirmation',
            content:'Are you sure for delete it.',
            buttons:{
                delete:{
                        text:'<i class="fa fa-trash"></i> Delete',
                        btnClass:'btn-danger',
                        action:function(){
                            $.ajax({
                                type:'POST',
                                url:document.location,
                                data:{status:'delete-transaction-form',id:id},
                                dataType:'json',
                                success:function(res){
                                    $('.table-'+id).hide();
                                    toastr.success('Form Deleted Successfully..');
                                    console.log(res);
                                },
                                error:function(a,b,c){
                                    console.log(a.responseText);
                                    console.log(b);
                                    console.log(c);
                                }
                            });
                            
                        }
                    },
                    cancel:function(){
                        
                    }
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