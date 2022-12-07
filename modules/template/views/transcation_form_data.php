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

echo '<div class="row">
                 <div class="col-md-12"> <h4>Pay Using:</h4></div>  
                     
                      
                      
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
                  

                       $pics = array('paytm'=>'https://cdn.iconscout.com/icon/free/png-512/paytm-226448.png',
          				'payumoney'=>base_url.'/template/front/img/preview/payments/pum.png',
          				'razorpay' => base_url.'/template/front/img/preview/payments/razorpay.png',
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
		                    
		                    
    						echo'<div class="div-method cnt_min col-md-3" style=" height:170px; display:inline-block;cursor:pointer">
                					<label>
                				 		 <input type="radio" name="gatewayid" value="'.$res.'" data-id="'.$mname.'" style="display:none;" '.$checked.'> <img src="'.$pics[strtolower($mname)].'" class="selected_img" style="height:100%; width:100%;">
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
		        
		        
		        
		        
echo '</div>';