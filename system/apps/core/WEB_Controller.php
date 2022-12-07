<?php
require APPPATH . 'libraries/razorpay/razorpay-php/Razorpay.php';
use Razorpay\Api\Api;
define('razorpay_key','rzp_live_e5EDXU5jg5B7mw');
define('razorpay_secret_key','NTaUoNAXKmd1naQN34RY46Ew');



class WEB_Controller extends MY_Controller{
    static $instance;
    public $subdir = '';
    public $razorpay ;
    
    public $system_plans = [
                                'basic' => 1499,
                                'premium' => 2499,
                                'ultimate' => 2999
                            ];
    
    
    function __construct(){
        parent :: __construct();
        
        $this->load->library('resellerclub');
        $this->load->library('cart');
        self :: $instance = &$this;
        $this->razorpay = new Api(razorpay_key,razorpay_secret_key);
        
    }
    
    function domainPrice($onlyDomainPrice = true){
         $domain = new resellerClub\Products;
        $apiOut = response($domain->customer_price());
        
        if($onlyDomainPrice){
            unset($apiOut['procloudasia']);
            return $apiOut;
        }
        
        return $apiOut;
    }
    
    function fetch_domain_price($maindomain,$year = 1,$type = 'addnewdomain'){
        
        extract(fetch_domain_tld($maindomain));
        
        $domainApi = new resellerClub\Domain;
                                 
                                 
        $Premium = response ( $domainApi->checkAvailabilityPremium($domain,$tld,false ) );
     
        $domains = response( $domainApi->checkAvailability($domain,$tld,true) );
        if(!isset($domains['ERROR'])){
            $domains = $domains[$maindomain];
          //  pre($domains);
                if(isset($Premium[$maindomain])){
                    return $Premium[$maindomain];
                }
                else if($domains['status'] == 'available'){
                    $prices = $this->domainPrice();
                 
                    return @$prices[$domains['classkey']][$type][$year];
                }
        }
        
        return 0;
    }
    
    
    function set_sub_dir($dir = ''){
        $this->subdir = $dir;
    }
    static function web_instance(){
        return  self :: $instance;
    }
    function render($page = '',$data = []){
        
        $data= (array)$data;
        $this->data = array_merge($this->data,$data);
        $this->parser->parse(DIR_THEMS.'/header.tpl', $this->data);
        if(!empty($page)){
            $page = str_replace('//','/',DIR_THEMS ."/$this->subdir/$page");
            $page = strpos($page,'.tpl') ? $page : "$page.tpl";
            $this->parser->parse($page,$this->data);
        }
        $this->parser->parse(DIR_THEMS.'/footer.tpl', $this->data);
    }
}


?>