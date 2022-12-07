<?php
require_once 'header.php';
$CI=&get_instance();
$paytm = $CI->PaymentModel->getPaymentMethod(array('method'=>'paytm'));

$payumoney = $CI->PaymentModel->getPaymentMethod(array('method'=>'payumoney'));
$razorpay = $CI->PaymentModel->getPaymentMethod(array('method'=>'razorpay'));

$cashfree = $CI->PaymentModel->getPaymentMethod(array('method'=>'cashfree'));
$data = ['paytm' => ['mid' => '', 'mkey' => ''] , 'payumoney' => ['mid' => '', 'key' => ''], 'razorpay' => ['key' => '', 'secret' => '' ],'cashfree' => ['app_id' => '', 'secret_key' => '' ] ];
if($paytm->num_rows()){
    $data['paytm']['mid'] = strip_tags ( $paytm->row()->key1 );
    $data['paytm']['mkey'] = strip_tags ( $paytm->row()->key2 );
}

if($payumoney->num_rows()){
    $data['payumoney']['mid'] = strip_tags( $payumoney->row()->key1 );
    $data['payumoney']['key'] = strip_tags( $payumoney->row()->key2 );
}

if($razorpay->num_rows()){
    $data['razorpay']['key'] = strip_tags( $razorpay->row()->key1 );
    $data['razorpay']['secret'] = strip_tags( $razorpay->row()->key2 );
}

if($cashfree->num_rows()){
    $data['cashfree']['app_id'] = strip_tags( $cashfree->row()->key1 );
    $data['cashfree']['secret_key'] = strip_tags( $cashfree->row()->key2 );
}



?>
<style>
    a.btn-pill{
        margin-right:5px;
    }
</style>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Update Payment Method
                <div class="page-title-subheading">We provide various payment options. 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <form class="main-card card" method="POST"  action="/admin/add-payment-method/paytm" onsubmit="$(this).find('input').attr('readonly','readonly')">
            <div class="card-header">
                <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i> Paytm
            </div>
            <div class="card-body" style="overflow-x:hidden">
                <div class="form-group">
                    <label>Enter MID *</label>
                    <input type="text" class="form-control" name="key1" placeholder="Enter Paytm MID" value="<?=$data['paytm']['mid']?>">
                </div>
                
                <div class="form-group">
                    <label>Enter MKEY *</label>
                    <input type="text" class="form-control" name="key2" placeholder="Enter Paytm MKEY" value="<?=$data['paytm']['mkey']?>">
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button class="btn btn-primary"> <i class="fa fa-plus"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-4">
        <form class="main-card card" method="POST"  action="/admin/add-payment-method/payumoney" onsubmit="$(this).find('input').attr('readonly','readonly')">
            <div class="card-header">
                <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i> Payumoney
            </div>
            <div class="card-body" style="overflow-x:hidden">
                
                <div class="form-group">
                    <label>Enter Merchant Key*</label>
                    <input type="text" class="form-control" name="key2" placeholder="Enter Payumoney MKEY" value="<?=$data['payumoney']['mid']?>">
                </div>
                <div class="form-group">
                    <label>Enter SALT *</label>
                    <input type="text" class="form-control" name="key1" placeholder="Enter Payumoney SALT" value="<?=$data['payumoney']['key']?>">
                </div>
                
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button class="btn btn-primary"> <i class="fa fa-plus"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-4">
        <form class="main-card card" method="POST"  action="/admin/add-payment-method/razorpay" onsubmit="$(this).find('input').attr('readonly','readonly')">
            <div class="card-header">
                <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i> RazorPay
            </div>
            <div class="card-body" style="overflow-x:hidden">
                <div class="form-group">
                    <label>Enter MID *</label>
                    <input type="text" class="form-control" name="key1" placeholder="Enter RazorPay MID"  value="<?=$data['razorpay']['key']?>">
                </div>
                
                <div class="form-group">
                    <label>Enter MKEY *</label>
                    <input type="text" class="form-control" name="key2" placeholder="Enter RazorPay MKEY"  value="<?=$data['razorpay']['secret']?>">
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button class="btn btn-primary"> <i class="fa fa-plus"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-md-4">
        <form class="main-card card" method="POST"  action="/admin/add-payment-method/cashfree" onsubmit="$(this).find('input').attr('readonly','readonly')">
            <div class="card-header">
                <i class="header-icon lnr-license icon-gradient bg-plum-plate"></i> Cashfree
            </div>
            <div class="card-body" style="overflow-x:hidden">
                <div class="form-group">
                    <label>Enter Your app id *</label>
                    <input type="text" class="form-control" name="key1" placeholder="Enter Cashfree APP Id"  value="<?=$data['cashfree']['app_id']?>">
                </div>
                
                <div class="form-group">
                    <label>Enter Your Secret Key *</label>
                    <input type="text" class="form-control" name="key2" placeholder="Enter Cashfree Secret KEY"  value="<?=$data['cashfree']['secret_key']?>">
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button class="btn btn-primary"> <i class="fa fa-plus"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
    
    
    
</div>
<?
/*
?>
<div class="main-card mb-3 card">
    <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>
        Choose a Payment Method
        <div class="btn-actions-pane-right">
            <div class="nav">
                <a data-toggle="tab" href="#tab-eg2-0" class="btn-pill btn-wide btn btn-outline-alternate btn-sm active">Paytm Business</a>
               <!--  <a data-toggle="tab" href="#tab-eg2-1" class="btn-pill btn-wide mr-1 ml-1 btn btn-outline-alternate btn-sm show">Instamojo</a>
                <a data-toggle="tab" href="#tab-eg2-2" class="btn-pill btn-wide btn btn-outline-alternate btn-sm  show">Rajorpay</a> -->
                <a data-toggle="tab" href="#tab-eg2-2" class="btn-pill btn-wide btn btn-outline-alternate btn-sm">Payumoney Business</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="tab-content">
            
            <div class="tab-pane active" id="tab-eg2-0" role="tabpanel">
                <center> <h3>Paytm Bussiness Payment Gateway</h3></center>
                <form  action="" method="post" onsubmit="$(this).find('input').attr('readonly','readonly')">
                <?php
                if(!$paytm->num_rows())
                {   
                echo'
                     <input type="hidden" name="method" value="paytm">
                     <input type="hidden" name="action" value="Update">
                    <div class="form-group">
                        <label>Merchant ID</label>
                        <input type="text" name="mid" class="form-control" ="">
                    </div>
                    <div class="form-group">
                        <label>Merchant KEY</label>
                        <input type="text" name="mkey" class="form-control" ="">
                    </div>
                    <div class="form-group">
                   <button type="submit" class="btn-wide btn btn-success">Save</button>
                   </div>';
                }
                else
                {
                    $da = $paytm->row();
                    if($da->key1 == '' && $da->key2 == ''){
                        echo'
                             <input type="hidden" name="method" value="paytm">
                             <input type="hidden" name="action" value="Update">
                            <div class="form-group">
                                <label>Merchant ID</label>
                                <input type="text" name="mid" class="form-control" ="">
                            </div>
                            <div class="form-group">
                                <label>Merchant KEY</label>
                                <input type="text" name="mkey" class="form-control" ="">
                            </div>
                            <div class="form-group">
                           <button type="submit" class="btn-wide btn btn-success">Save</button>
                           </div>';
                    }
                    else{
                    echo'<div class="form-group">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="method" value="paytm">
                        <ul class="list-group">
                            <li class="justify-content-between list-group-item">
                                <strong>Merchant ID</strong> : <code>'.$da->key1.'</code>
                            </li>
                            <li class="justify-content-between list-group-item">
                             <strong>Merchant KEY</strong> : <code>'.$da->key2.'</code>
                            </li>
                        </ul>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger">Remove</button>
                        </div>';
                    }
                   
                }
                ?>
                </form>
            </div>
            
            <div class="tab-pane" id="tab-eg2-2" role="tabpanel">
                <center> <h3>Payumoney Bussiness Payment Gateway</h3></center>
                <form  action="" method="post" onsubmit="$(this).find('input').attr('readonly','readonly')">
                <?php
                if(!$payumoney->num_rows())
                {   
                echo'
                     <input type="hidden" name="method" value="payumoney">
                     <input type="hidden" name="action" value="Update">
                    <div class="form-group">
                        <label>Merchant KEY</label>
                        <input type="text" name="mid" class="form-control" ="">
                    </div>
                    <div class="form-group">
                        <label>Merchant Salt </label>
                        <input type="text" name="mkey" class="form-control" ="">
                    </div>
                    <div class="form-group">
                   <button type="submit" class="btn-wide btn btn-success">Save</button>
                   </div>';
                }
                if($payumoney->num_rows())
                {
                    $da = $payumoney->row();
                    if($da->key1 == '' && $da->key2 == ''){
                        echo'
                         <input type="hidden" name="method" value="payumoney">
                         <input type="hidden" name="action" value="Update">
                        <div class="form-group">
                            <label>Merchant KEY</label>
                            <input type="text" name="mid" class="form-control" ="">
                        </div>
                        <div class="form-group">
                            <label>Merchant Salt </label>
                            <input type="text" name="mkey" class="form-control" ="">
                        </div>
                        <div class="form-group">
                       <button type="submit" class="btn-wide btn btn-success">Save</button>
                       </div>';
                    }
                    else{
                    echo'<div class="form-group">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="method" value="payumoney">
                        <ul class="list-group">
                            <li class="justify-content-between list-group-item">
                                <strong>Merchant KEY</strong> : <code>'.$da->key1.'</code>
                            </li>
                            <li class="justify-content-between list-group-item">
                             <strong>Merchant Salt</strong> : <code>'.$da->key2.'</code>
                            </li>
                        </ul>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger">Remove</button>
                        </div>
                    ';
                    }
                }
                ?>
                </form>
            </div>
            
           <!--  <div class="tab-pane show" id="tab-eg2-1" role="tabpanel">
                <center> <h3>Instamojo Payment Gateway</h3></center>
                    <div class="form-group">
                        <label>Private API Key</label>
                        <input type="text" name="apikey" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Private Auth Token</label>
                        <input type="text" name="authtoken" class="form-control">
                    </div>
            </div>
            <div class="tab-pane show" id="tab-eg2-2" role="tabpanel"><p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                type specimen book. It has
                survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p></div> -->
        </div>
    </div>
</div>



<?php
*/

require_once 'footer.php';
?>