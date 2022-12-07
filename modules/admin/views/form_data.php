<?

require_once 'header.php';

?>

<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>View Form Data

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 



<?php
$CI= &get_instance();
$forms  = $CI->FormModel->getFormModel();
$op = "<option value=0>--No Form Seleted--</option>";
foreach($forms->result() as $res)
    $op.="<option value='".$res->id."'>".$res->title."</option>";
?>

<div class="row">
    <div class="container">
        <div class="mb-3 text-center card main-card">
            <div class="card-header">
                <div class="col-md-4">
                    Select Form 
                </div>
                <div class="col-md-5">
                    <select class="form-control" onchange="loadFormData(this.value)"><?=$op?></select>
                </div>
            </div>
            <div class="card-body viewBox">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function loadFormData(fid)
    {
        if(fid == 0){
            $('.viewBox').html('');
            return false;
        }
        $.ajax({
            url:'<?site_url("Admin/form_data")?>',
            type:'POST',
            data:{fid:fid},
            beforeSend:function()
            {
                $("#load").show();
            },
            success:function(q)
            {   //alert(q);
                $(".viewBox").html(q);
                $("#load").hide();
            }
        });
    }

    function deleteData(ele)
    {   
        
        if(confirm("Are you Sure?"))
        {
           $.ajax({
                url:'<?=site_url('Admin/delete-form-data')?>',
                type:'POST',
                data:{id:$(ele).data('id')},
                success:function(q)
                {
                   if(q=='done')
                   {
                        $(ele).parent().parent().hide(200);
                   }
                }
           });
        }
    }
</script>


<?

require_once 'footer.php';

?>