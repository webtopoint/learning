<?php



    ?>
    <div class="sub-heading">
        <h3>Payment Details</h3>
    </div>
    <div class="alert alert-success text-center large-text" role="alert" id="totalDueToday">
        Total Due Today: &nbsp; 
        <strong id="totalCartPrice"><?= $this->cart->total() ?> <i class="fa fa-rupee"></i></strong>
    </div>
    <div class="text-left" style="width:100%;padding:10px">
        <?php
        echo form_open('checkout');
        ?>
        <div class="container">
            <div class="form cf">
        
        
                <section class="payment-type cf">
                    <h4>Choose payment method below</h4>
                    <input type="radio" name="method" id="payumoney" checked value="payu"><label class="credit-label four col" for="payumoney">Payumoney</label>
                </section> 
            </div>
        </div>
        
        
        <p class="terms-of-servics">
            <label>
                    <input type="checkbox" id="accepttos" >
                &nbsp;
                I have read and agree to the
                <a href="#" target="_blank">Terms of Service</a>
            </label>
        </p>
        <div class="text-left margin-bottom"></div>
        
        <button type="submit" id="btnCompleteOrder" disabled class="btn primary-solid-btn disable-on-click spinner-on-click">
            Complete Order                        &nbsp;<i class="fas fa-arrow-circle-right"></i>
        </button>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <?php
        /*
        $class = '';
        if(isset($btn)){
            if($btn){
                $class = 'rzp-button';
                ?>
                <button type="submit" id="btnCompleteOrder" disabled class="btn primary-solid-btn disable-on-click spinner-on-click <?=$class?>">
                    Complete Order                        &nbsp;<i class="fas fa-arrow-circle-right"></i>
                </button>
                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                    <form name='razorpayform' action="<?=base_url('cart/finish')?>" method="POST">
                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                        <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
                    </form>
                    <script>
                    // Checkout details as a json
                    var options = <?php echo $json?>;
                    
                    options.handler = function (response){
                        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                        document.getElementById('razorpay_signature').value = response.razorpay_signature;
                        document.razorpayform.submit();
                    };
                    
                    // Boolean whether to show image inside a white frame. (default: true)
                    options.theme.image_padding = false;
                    
                    options.modal = {
                        ondismiss: function() {
                            console.log("This code runs when the popup is closed");
                        },
                        // Boolean indicating whether pressing escape key 
                        // should close the checkout form. (default: true)
                        escape: true,
                        // Boolean indicating whether clicking translucent blank
                        // space outside checkout form should close the form. (default: false)
                        backdropclose: false,
                        
                        animation : true
                    };
                    
                    var rzp = new Razorpay(options);
                    rzp.on('payment.failed', function (response){
                        //alert(response.error.code);
                        alert(response.error.description);
                    });
                    document.getElementById('btnCompleteOrder').onclick = function(e){
                        rzp.open();
                        e.preventDefault();
                    }
                    </script>
                
                <?php
            }
        }
        else{
            
        }
        
        */


        echo form_close();



        ?>
        
        
    </div>
    <script>
        $('#accepttos').click(function(){
                
                    $('.disable-on-click').prop('disabled', !$(this).is(':checked'));
        });
    </script>
    <?php




?>