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

                                    <div>View Transaction Form Data

                                        <div class="page-title-subheading">

                                        </div>

                                    </div>

                                </div>  

                            </div>

</div> 



<?php
$CI= &get_instance();
$forms  = $CI->FormModel->getTransactionForm();
$op = "<option value=0>--No Transaction Form Seleted--</option>";
foreach($forms->result() as $res)
    $op.="<option value='".AJ_ENCODE($res->id)."'>".$res->tform_name."</option>";
?>

<div class="row">
    <div class="container">
        <div class="mb-3 text-center card main-card">
            <div class="card-header">
                <div class="col-md-4">
                    Select Transaction Form 
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
    function loadFormData(tfid)
    {
        $.ajax({
            url:'<?site_url("Admin/transaction-form-data")?>',
            type:'POST',
            data:{tfid:tfid},
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

    function rqst_status(e)
    {
        var id = $(e).data('id');
        var link = '<?=site_url('Admin/transaction-status/')?>'+id;
        window.open(link,0,"height=600,width=700");
     
    }
</script>


<?

require_once 'footer.php';

?>