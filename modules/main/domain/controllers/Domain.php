<?php
class Domain extends WEB_Controller{
    public $response = ['status' => false];
    
    public $promo_price = [];
    
    function __construct(){
        parent :: __construct();
        $this->promo();
    }
    function remove($rowId){
        if(Modules :: run('cart/remove',$rowId)){
            redirect(base_url('cart'));
        }
    }
    function fetch($domain = ''){
        if(!empty($domain)){
            $list = fetch_domain_tld($domain);
            $keyword = $list['domain'];
            $tld = $list['tld'];
            $domainApi = new resellerClub\Domain;
                             
                             
            $Premium = response ( $domainApi->checkAvailabilityPremium($keyword,$tld,false ) );

            $domains = response( $domainApi->checkAvailability($keyword,$tld,true) );
             
            if(!isset($domains['ERROR'])){
                $domains = @$domains[$domain]; 
                $product_key = isset($domains['classkey']) ? $domains['classkey'] : '';
                $renew_price = $this->price_with_product_key($product_key,1,'renewdomain');
               if(isset($Premium[$domain])){
                   $this->response = [
                            
                                            'status'  =>  true,
                                            'type' => 'premium',
                                            'domain' => $domain,
                                            'price' => $Premium[$domain],
                                            'renew_price' => $renew_price,
                                            'classkey' => $product_key
                                   ];
               }
               else if($domains['status'] == 'available'){
                   $price = $this->price_with_product_key($product_key);
                   $this->response = [
                                            'status'  =>  true,
                                            'type' => 'available',
                                            'domain' => $domain,
                                            'price' => $price,
                                            'renew_price' => $renew_price,
                                            'classkey' => $product_key
                                   ];
               }
               else{
                   $this->response = [
                                            'status'  =>  false,
                                            'type' => 'notavailabel',
                                            'domain' => $domain,
                                            'price' => 0,
                                            'renew_price' => 0,
                                            'classkey' => $product_key
                                   ];
               }
            }
        }
        
        return $this->response;
        
    }
    
    function price($domain,$year = 1,$type = 'addnewdomain'){
        $domain = (object) $this->fetch($domain);
        if($domain->status){
            $prices = $this->domainPrice();
                 if($year == 1){
                     if(isset($this->promo_price[$domain->classkey]))
                        return $this->promo_price[$domain->classkey];
                 }
            return @$prices[$domain->classkey][$type][$year];
        }
        return 0;
    }
    
    function price_with_product_key($product_key,$year = 1,$type = 'addnewdomain'){
        
        if(!$product_key)
            return;
        if($year == 1){
            if(isset($this->promo_price[$product_key]))
                return $this->promo_price[$product_key];
        }
             
        $prices = $this->domainPrice();
        return @$prices[$product_key][$type][$year];
    }
    
    function proper_domain_price($find_key = ''){
        $prices = $this->domainPrice();
        $_price = [];
        foreach($prices as $key => $price){
            $_price[$key] = (isset($this->promo_price[$key])) ? $this->promo_price[$key]  : $price;
        }
        if(isset($_price[$find_key]))
            return $_price[$find_key];
        return $_price;
    }
    
    function promo(){
        $api = new resellerClub\Resellers;
        $all = $api->promo_details();
        foreach($all as $promo){
            if($promo->isactive AND $promo->starttime <= time() AND $promo->endtime >= time()){
                $this->promo_price[$promo->productkey] = $promo->customerprice;
            }
        }
        return $this->promo_price;
    }
    
    function domain_list_wrap(){
        return $this->load->view(__FUNCTION__,[],true);
    }
    
    function promo_Price($prloduct_key){
        //$prices = $this->promo();
        
    }
    
}


?>