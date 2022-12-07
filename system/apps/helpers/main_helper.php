<?php

function start_with($haystack, $needle){
    return substr($haystack,0,strlen($needle)) === $needle;
}

function condition_with_return($index , $value,$trueReturn = 'inline', $falseReturn = 'none'){
    return $index == $value ? $trueReturn : $falseReturn;
}
function starts_with($haystack, $needle)
{
	return substr($haystack, 0, strlen($needle))===$needle;
}
function css_theme(){
    $data = [
        'kohost' => array(
            theme_base().'/assets/css/main.css',
            theme_base().'/assets/all.min.css?v=a1db48',
            theme_base().'/assets/style.css',
            theme_base().'/assets/custom.css?v=a1db48',
            'https://pro.fontawesome.com/releases/v5.2.0/css/all.css'
        ),    
    ];
    
    return isset($data[THEME]) ? $data[THEME] : [];
}

function confirm_js_theme($index = 'light'){
    $ci = &get_instance();
    $get = $ci->session->has_userdata('theme_skin')
                                        ? $ci->session->theme_skin : 'dark';
    return $get == 'dark' ? 'supervan' : $index;
}

if(!function_exists('set_cart_heading')){
    function set_cart_heading(){
        $CI = & get_instance();
        if($get = $CI->input->get()){
            if(isset($get['a'])){
                switch($get['a']){
                    case 'checkout':
                        return 'Checkout';
                    break;
                    case 'add':
                        if(isset($get['domain'])){
                            return ucwords($get['domain']) .' Domain';
                        }
                    break;
                    case 'add_plan':
                        return 'Choose a Domain...';
                    break;
                    case 'plan':
                        return 'Website Plan(S)';
                    break;
                }
            }
        }
        
        return 'Review &amp; Checkout';
    }
}


function searchForindexAndValue($array = array(),$index = 'type', $value = 'domain') {
   foreach ($array as $key => $val) {
       if ($val[$index] === $value) {
           return $value;
       }
   }
   return null;
}

if(!function_exists('extract_subdomains')){
    function extract_subdomains($domain)
    {
        $subdomains = $domain;
        $domain = extract_domain($subdomains);
    
        $subdomains = rtrim(strstr($subdomains, $domain, true), '.');
    
        return $subdomains;
    }
}

if(!function_exists('extract_domain')){
    function extract_domain($domain)
    {
        if(preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $domain, $matches))
        {
            return $matches['domain'];
        } else {
            return $domain;
        }
    }
}

if(!function_exists('cPanelAPILoad')){
    function cPanelAPILoad(){
        require_once BASEPATH.'libraries/cPanel/cpaneluapi.class.php';
    }
}
if(!function_exists('active')){
    function active($class = 'admin',$method = 'index',$active  = 'active',$else  = ''){
        $CI = & get_instance();
        $_class = $CI->router->fetch_class();
        
        $_method = $CI->router->fetch_method();
        if(!is_array($method)){
            $method = [$method];
        }
        return ($_class == $class AND in_array($_method,$method))
                            ? $active : $else;
    }
}

function domain_amount($maindomain,$year = 1,$type = 'addnewdomain'){

    extract(fetch_domain_tld($maindomain));
    
    $domainApi = new resellerClub\Domain;
                             
                             
    $Premium = response ( $domainApi->checkAvailabilityPremium($domain,$tld,false ) );

    $domains = response( $domainApi->checkAvailability($domain,$tld,true) );
    if(!isset($domains['ERROR'])){
        $domains = $domains[$maindomain];

            if(isset($Premium[$maindomain])){
                return $Premium[$maindomain];
            }
            else if($domains['status'] == 'available'){
                    return domain_price($domains['classkey'])[$type][$year];
            }
    }
    
    return 0;
    
}

function domain_price($tldClassKey = ''){
    if($tldClassKey){
        $CI = web_instance();
        
        $allPrice = $CI->domainPrice();
        
        return isset($allPrice[$tldClassKey])
                        ? $allPrice[$tldClassKey] : '';
    }
    return;
}
function fetch_domain_tld($domain, $pre = true){
    $domain = (!($point = strpos($domain,'.')))  ?  "$domain.com" : $domain;
    $point = strpos($domain,'.');
    $result = [
                    'domain' => substr($domain,0,$point),
                    'tld' =>   substr($domain,$point+1)
                ];
    if(is_bool($pre)){
        return $result;
    }
    else{
        return isset($result[$pre]) 
                ? $result[$pre] : '';
    }
}
function response($data , $type = 'array'){
    switch($type){
        case 'array':
            return (array) json_decode(json_encode($data),true);
        break;
        default:
            return $data;
    }
}

function pre($array = [], $flg                 = false){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    if($flg)
        exit;
}
function multi_to_single_array($array = array()){
    $d = array();
    foreach($array as $data){
        if(is_array($data)){
            $d = array_merge($d,multi_to_single_array($data));
        }
        else
            $d[] = $data;
    }
    return $d;
}
function theme_base($url = ''){
    $dir = defined('isReseller')  ? 'reseller/'.FileDirectory.'/' : DIR_THEMS;
    return base_url("themes/$dir/$url");
}

function &main_instance(){
    return Main_Controller :: main_instance();
}
function web_instance(){
    return WEB_Controller :: web_instance();
}
function roles(){
    $CI = &main_instance();
	if( $CI->session->has_userdata('role')  ){
	    $role = $CI->session->userdata('role');
	    if( $role == 1)
	        return 'all'; 
	        
	        
	    $roles = $CI->db->get_where('role',['role_id' => $role]);
	    if($roles->num_rows()){
	        return json_decode($roles->row()->permission,true);
	    }
	    
	}
	return false;
}

function main_data($index = ''){
    if(!empty($index)){
        
        $CI = main_instance();
    
        if(isset($CI->data[$index])){
            return $CI->data[$index];
        }
        elseif(isset($CI->data["text_$index"]))
            return $CI->data["text_$index"];
        
    }
    
    return $index;
}

function print_session_message($data = ['success','error']){
    
    if(is_array($data)){
        foreach($data as $index){
            print_session_message($index);
        }
        return;
    }
    if(is_string($data)){
        $ci = &get_instance();
        $class = ($data == 'error') ? 'danger' : $data;
        if($msg = $ci->session->flashdata($data))
            echo '<div class="alert alert-'.$class.'">'.$msg.'</div>';
    }
    
}

function huminize_word($string,$count = 0){
    return
        $count > 1             ? plural($string)            : singular($string);
}
?>