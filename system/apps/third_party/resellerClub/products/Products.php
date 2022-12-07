<?php

namespace Resellerclub;

require_once __DIR__ . '/../core/Core.php';

/**
 * Contains customer related API calls.
 * @package Resellerclub
 */
class Products extends Core {
    
    function customer_price($customer_id = 0){
        $array = [];
        if($customer_id)
            $array['customer-id'] = $customer_id;
        $this->defaultValidate($array);
        return $this->callApi(METHOD_GET, 'products', 'customer-price',$array);
    }
    
}
