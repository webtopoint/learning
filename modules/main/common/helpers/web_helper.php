<?php

if(function_exists('set_cart_heading')){
    function set_cart_heading(){
        $CI = & get_instance();
        if($get = $CI->input->get()){
            if(isset($get['a'])){
                switch($get['a']){
                    case 'plan':
                        return 'Website Plan(S)';
                    break;
                }
            }
        }
        
        return 'Review &amp; Checkout';
    }
}

?>