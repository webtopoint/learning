 
 
 
 
 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
 <!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
<script>

    if(!window.jQuery)
    {
       var script = document.createElement('script');
       script.type = "text/javascript";
       script.src = "https://code.jquery.com/jquery-1.10.2.js";
       document.getElementsByTagName('head')[0].appendChild(script);
       
       var script = document.createElement('script');
       script.type = "text/javascript";
       script.src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js";
       document.getElementsByTagName('head')[0].appendChild(script);
    }

    $(document).on('submit','#razorpay-form-<?=$id?>',function(e){    
        
            if( $(this).find('input[name=gatewayid]:checked').data('id') == 'razorpay' ){
                <?=$function?>(0,0);
                return false;
            }
            return true;
        
    })



  var razorpay_options_<?=$id?> = {
    key: "<?php echo strip_tags( $key ); ?>",
    amount: "<?php echo $amount; ?>",
    name: "<?php echo $name; ?>",
    description: "Order # <?php echo $order_id .'-'.$form_id; ?>",
    netbanking: true,
    currency: "INR",
    prefill: {
      name:"",
      email: "",
      contact: ""
    },
    notes: {
      soolegal_order_id: "<?php echo $order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id_<?=$id?>').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form-<?=$id?>').submit();
    },
    "modal": {
        "ondismiss": function(){
            // location.reload();
            $('body').css({'overflow-x':'scroll'});
        }
    }
  };
  function calPrice_<?=$id?>(el){
      
      let price = el.value == '' ? 0 : el.value;
      /*
      if(el.value <= 0){
        el.value = price = razorpay_options_<?=$id?>.amount;
        return true;
      }
      
      */
      $('#merchant_total_<?=$id?>').val(parseFloat(price * 100));
      $('#merchant_amount_<?=$id?>').val(parseFloat(price));
      razorpay_options_<?=$id?>.amount = parseFloat(price * 100);
      
  }
  
  var razorpay_submit_btn_<?=$id?>, razorpay_instance_<?=$id?>;


  function razor_pay_requiredFields(){
      let errors = 0;
        $("#razorpay-form-<?=$id?> :input[required]").map(function(){
            
            if( !$(this).val() ) {
                  $(this).attr('style','border:1px solid red');//.effect('shake');
                  errors++;
            } else if ($(this).val()) {
                  $(this).removeAttr('style');
            }   
            
        });
      
      return errors;
      
  }
  function <?=$function?>(els = 0, ttl = 1){
        let errors = 0;
        if( ( errors = razor_pay_requiredFields() ) > 0 && ttl){
            $("#razorpay-form-<?=$id?> :input[required]").each(function(){
                
                if(this.value == ''){
                    $(this).focus();
                    return false;
                }
                
            });
            
            return false;
        }
        else{
            
            let el = $("#razorpay-form-<?=$id?>").find('.submitBtn > button'),
                btn_value = $(el).html();
            
            if(typeof Razorpay == 'undefined'){
              setTimeout(<?=$function?>, 200);
              if(!razorpay_submit_btn_<?=$id?> && el){
                razorpay_submit_btn_<?=$id?> = el;
                $(el).prop('disabled', true ); 
                $(el).html( 'Please wait...' );  
              }
            } else {
              if(!razorpay_instance_<?=$id?>){
                razorpay_instance_<?=$id?> = new Razorpay(razorpay_options_<?=$id?>);
                if(razorpay_submit_btn_<?=$id?>){
                  $( razorpay_submit_btn_<?=$id?> ).prop( 'disabled', false );
                  $(el).html( btn_value );  
                }
              }
              razorpay_instance_<?=$id?>.open();
            }
        
            
            
            
            
        }
    
    
    
    
    
    
    
    
    
  }  
</script>