<?php
$productinfo = ' Transaction Form';
$txnid = time();
$surl = '';
$furl = '';        
$key_id = payment_method()->key1;
$currency_code = 'INR'; 
$price = 0;
if($f->amount)
    $price = ($f->amount);
$total = ($price* 100); 
$amount = $price;
$merchant_order_id = ($f->id);
$card_holder_name = '';
$email = '';
$phone = '';
$name = @$title;
$return_url = site_url('Home/transaction-submit');






     echo'<div class="col-lg-12 unit-7 pricing-table-modern__item" align="none">



              <div class="pricing-table__item-header">

                <div class="pricing-table__item-header-bg">

                  <div class="pricing-table__item-header-bg-inner"></div>

                </div>

                <p class="pricing-table__item-title mb-0">'.$f->tform_name.'</p>

              </div> 



            <form action="'.$return_url.'" class="p-5 bg-white" name="razorpay-form" id="razorpay-form-'.$f->id.'" data-id="'.AJ_ENCODE($f->id).'" align="left" method="post" enctype="multipart/form-data" onsubmit="">
                <input type="hidden" name="tfid" value="'.AJ_ENCODE($f->id).'">
                  
                  <input type="hidden" name="orderNote" value="'.$f->tform_name.' FORM PAYMENT"/>
                  <input type="hidden" name="orderCurrency" value="INR"/>
                  <input type="hidden" name="customerName" value="a"/>
                  <input type="hidden" name="customerEmail" value="ajaykumar@gmail.com"/>
                  <input type="hidden" name="customerPhone" value="8533898539"/>
                  <input type="hidden" name="orderAmount" value="'.$amount.'"/>
                  <input type ="hidden" name="notifyUrl" value="'.base_url.'/Home/cashfree_transaction/'.$txnid.'"/>
                  <input type ="hidden" name="returnUrl" value="'.base_url.'/Home/cashfree_transaction/'.$txnid.'"/>
                  <input type="hidden" name="appId" value="'.payment_method('cashfree')->key1.'"/>
                  <input type="hidden" name="orderId" value="'.$txnid.'"/>
                  
                  
                  
                  
                  
                  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id_'.$f->id.'" />
                  <input type="hidden" name="merchant_order_id" id="merchant_order_id_'.$f->id.'" value="'.$merchant_order_id.'"/>
                  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id_'.$f->id.'" value="'.$txnid.'"/>
                  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id_'.$f->id.'" value="'.$productinfo.'"/>
                  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id_'.$f->id.'" value="'.$surl.'"/>
                  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id_'.$f->id.'" value="'.$furl.'"/>
                  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id_'.$f->id.'" value="'.$card_holder_name.'"/>
                  <input type="hidden" name="merchant_total" id="merchant_total_'.$f->id.'" value="'.$total.'"/>
                  <input type="hidden" name="merchant_amount" id="merchant_amount_'.$f->id.'" value="'.$amount.'"/>';
                  
            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)
                echo '<div class="row form-group">';
                echo'<div class="col-md-'.$col.' mb-3 mb-md-0">'.$fil.'</div>';
                $ck+=$col;

              if($ck==12)
              {                echo'</div>'; $ck=0;              }

              

            }

            if($ck>0)
                echo '</div>';

              $force='';

              if($f->amount)

                $force = ' value="'.$f->amount.'" disabled ';



              echo'<div class="row form-group">

                      <div class="col-md-'.$col.' mb-3 mb-md-0">

                        <label>Amount to be Paid</label>

                        <input type="number" name="amount" class="form-control" onkeyup="calPrice_'.$f->id.'(this)" onkeydown="calPrice_'.$f->id.'(this)" '.$force.' required>

                      </div>

                    </div>

                    ';

            echo '<div class="row form-group">
                     
                      <div class="col-md-12 cnt_full">
                      <h4>Pay Using:</h4>
                      ';

                       $pics = array('paytm'=>'https://cdn.iconscout.com/icon/free/png-512/paytm-226448.png',
          				'payumoney'=>'https://res.cloudinary.com/tia-img/image/fetch/t_company_avatar/https%3A%2F%2Fcdn.techinasia.com%2Fdata%2Fimages%2Fa7e6f511134a282fc7a386c0eb5929a0.png',
          				'razorpay' => base_url.'/public/razorpay.png',
          				'cashfree' => 'https://www.cashfree.com/images/presskit/header.png'
      		);
      		//print_r(json_decode($f->payment_method_id));
               $chk=0;
		        if($f->payment_method_id[0]=='[')
		        {
		            foreach (json_decode($f->payment_method_id) as $res)
		            {
		                 $method__ =  $CI->PaymentModel->getPaymentMethod(array('id'=>$res));
		                 if($method__->num_rows()){
		                    $mname =$method__->row()->method;
		                    
		                    $checked = ($chk?'':'checked ');
		                    if($mname == 'razorpay')
		                        $checked = 'required onclick="razorpaySubmit_'.$f->id.'(this);"';
		                    
		                    
    						echo'<div class="div-method cnt_min" style="width:200px; height:90px; display:inline-block;cursor:pointer">
                					<label>
                				 		 <input type="radio" name="gatewayid" value="'.$res.'" data-id="'.$mname.'" style="display:inline-block;" '.$checked.'> <img src="'.$pics[strtolower($mname)].'" class="selected_img" style="height:100%; width:100%;">
                					 </label>
                					</div>';
    						$chk=1;
		                 }
		            }
		        }
		        else
		        {
		             $mname =  $CI->PaymentModel->getPaymentMethod(array('id'=>$f->payment_method_id))->row()->method;	
					echo'<div style="width:150px; height:90px; display:inline-block;"><input type="radio" name="gatewayid"  data-id="'.$mname.'"  value="'.$f->payment_method_id.'" style="display:inline-block;" '.($chk?'':'checked').'> &nbsp; <img src="'.$pics[strtolower($mname)].'" style="height:100%; width:100%;"></div>';
		        	$chk=1;
		        }

                      echo'</div>
                    </div>';

              echo '<div class="row form-group">

                      <div class="col-md-12 mb-3 mb-md-0">

                      '.$f->btn.'

                      </div>

                    </div>

            </form>

            

          </div>
        
        
          <br>';
           echo get_instance()->load->view('home/plugins/razorpay_transaction_js',[
              
            'function' =>    'razorpaySubmit_'.$f->id,
            'id' => $f->id,
            'amount'    =>  $total,
            'name'  =>  $name,
            'form_id' => $merchant_order_id,
            'order_id' => $txnid,
            'key'   => $key_id
            
        ],true);  
        ?>