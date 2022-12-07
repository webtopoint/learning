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






     echo'<section class="contact-section" id="form-'.($f->id).'">
        <div class=" auto-container shadow-lg p-4">
          <div class="sec-title text-center">

                <h2>'.$f->tform_name.'</h2>

                <span class="divider"></span>

            </div>
            <div class="contact-form">



            <form action="'.$return_url.'" class="p-5 bg-white" name="razorpay-form" id="razorpay-form-'.$f->id.'" data-id="'.AJ_ENCODE($f->id).'" align="left" method="post" enctype="multipart/form-data" onsubmit="">
                ';
                  
            $col = (int)12/$f->layout;

            $ck = 0;

            foreach ($fields as $fil)

            {

              if($ck==0)
                echo '<div class="row ">';
                echo'<div class="col-md-'.$col.' form-group mb-3 mb-md-0">'.$fil.'</div>';
                $ck+=$col;

              if($ck==12)
              {                echo'</div>'; $ck=0;              }

              

            }

            if($ck>0)
                echo '</div>';

              $force='';

              if($f->amount)

                $force = ' value="'.$f->amount.'" disabled ';



              echo'<div class="row ">

                      <div class="col-md-'.$col.' form-group mb-3 mb-md-0">

                        <label>Amount to be Paid</label>

                        <input type="number" name="amount" class="form-control" onkeyup="calPrice_'.$f->id.'(this)" onkeydown="calPrice_'.$f->id.'(this)" '.$force.' required>

                      </div>

                    </div>

                    ';

         
            echo $this->load->view('template/transcation_form_data',['f' => $f],true);


              echo '<div class="row form-group">

                      <div class="col-md-12 mb-3 mb-md-0">

                      '.$f->btn.'

                      </div>

                    </div>

            </form>

            

          </div>
        
         </div>
    </section>
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