<?php
require __DIR__ . '/razorpay/razorpay-php/Razorpay.php';
use Razorpay\Api\Api;

class Razorpay {
    public $api;
    function Api($keyId, $keySecret){
        $this->api = new Api($keyId, $keySecret);
        return $this->api;
    }
    
}

?>