<?php

class Pum {    
   var $fields = array();
   public $salt,$key,$type,$pum_url;
   function init($salt,$key = '', $type = 'original'){
          if($type == 'sandbox') {
             $this->pum_url = "https://sandboxsecure.payu.in/_payment";
          } else if($type == 'original') {
             $this->pum_url = "https://secure.payu.in/_payment";
          } 
          $this->pum_salt = $salt; 
          $this->add_field('key',$key);
          
        $this->add_field('txnid',substr(hash('sha256', mt_rand() . microtime()), 0, 20));


        $this->add_field('productinfo', 'Payment with PayUmoney');
        $this->add_field('service_provider', 'payu_paisa');
        
        return $this;
   }
   
   function add_field($field, $value = '') {   
       if(is_array($field)){
           foreach($field as $i => $v)
               $this->add_field($i,$v);
       }
       else{
            $this->fields["$field"] = $value;
            $_POST["$field"] = $value;
       }
      return $this;
   }
   
   function all_fields(){
       return $this->fields;
   }
   
   function submit_pum_ajax(){
       return $this->submit_pum_post(true,false);
   }

   function submit_pum_post($return = false,$onload = true) {
      $hash = '';
      $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
      $html = '';
      $ci = &get_instance();
      
      $ci->form_validation->set_rules('key','Merchant Key','required');
      $ci->form_validation->set_rules('txnid','Transaction Number','required');
      $ci->form_validation->set_rules('amount','Amount','required');
      $ci->form_validation->set_rules('firstname','Name','required');
      $ci->form_validation->set_rules('email','Email','required');
      $ci->form_validation->set_rules('phone','Phone','required');
      $ci->form_validation->set_rules('productinfo','Product Info','required');
      $ci->form_validation->set_rules('surl','Success Url','required');
      $ci->form_validation->set_rules('furl','Fail Url','required');
      $ci->form_validation->set_rules('service_provider','Service Provider','required');
    
      if(($status = $ci->form_validation->run()) == FALSE)
      {
          
          $html = validation_errors('<div class="alert alert-danger">','</div>');
      }
      else {
         //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
         $hashVarsSeq = explode('|', $hashSequence);
         $hash_string = '';  
         foreach($hashVarsSeq as $hash_var) {
            $hash_string .= isset($this->fields[$hash_var]) ? $this->fields[$hash_var] : '';
            $hash_string .= '|';
         }
         $hash_string .= $this->pum_salt;
         $hash = strtolower(hash('sha512', $hash_string));
         $this->add_field('hash',$hash);

         $html = $onload ? "<html>\n" : '';
         //echo "<head><title>Processing Payment...</title></head>\n";
         $html .= $onload ? "<body onLoad=\"document.forms['pum_form'].submit();\">\n" : "";
         //echo "<body >\n";
         //echo "<center><h3>";
         //echo " Redirecting to the pum.</h3></center>\n";
         $html .= "<form method=\"post\" name=\"pum_form\" ";
         $html .= "action=\"".$this->pum_url."\">\n";

         foreach ($this->fields as $name => $value) {
            $html .= "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>\n";
         }
           
         $html .= "</form>\n";
         $html .= $onload ? "</body></html>\n" : '';
      }
      
      
      if($return)
        return ['status' => $status,'html' => $html];
      else
        echo $html;
    
   }
   
   
}         
