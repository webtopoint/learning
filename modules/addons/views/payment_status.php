<div class="col-md-12">
<?php
$title = $status == 'fail' ? 'Payment Failed' : 'Payment Success';
$message = $status == 'fail' ? '<div class="alert alert-danger">'.@$_POST['error_Message'].'</div>' :  '<div class="alert alert-success">Payment Successfully....</div>';
?>



<div class="card card-primary">
    <div class="card-header">
        <?=$title?>
    </div>
    <div class="card-body">
        <?=$message?>
    </div>
    <div class="card-footer">
        <a href="<?=base_url('addons/site-addons')?>" class="btn btn-success"><i class="pe-7s-back"></i> Back to List Addons</a>
    </div>
</div>
</div>
