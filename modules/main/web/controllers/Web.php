<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends WEB_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('common/main_lib');
        
        $this->load->database();
        $this->load->model('common/cart_model');
        $this->load->model('common/customer_model','CustomerModel');
    }
    
    
    function customer_login()
	{
	   // exit('2');
		//$this->load->helper();
		$post = $this->input->post();

		if($post){
            $this->load->helper('tool/custom');
			$return = array('status'=>0);

			$wh = array('_email'=>$post['username'],'_pass'=>$post['pass']);
            
			$chk = $this->CustomerModel->getCustomer($wh);

			if($chk->num_rows()){

				

				if($chk->num_rows() == 1){
				    $rw = $chk->row();
                    if($rw->theme_id == 6 || $rw->theme_id == 11 || $rw->theme_id == 9 || $rw->theme_id == 15)
					$return = array('status'=>1,'url'=>$rw->domain_name.'/admin?back_url='.base_url.'/customer-login&_token='.($rw->id));
					else
					$return = array('status'=>1,'url'=>$rw->domain_name.'/admin?back_url='.base_url.'/customer-login&_token='.AJ_ENCODE($rw->id));

				}
				else if($chk->num_rows() >= 2){
				   $return = ['status'=>3,'html'=>'<table class="table table-bordered table-striped">'];
				   foreach($chk->result() as $k => $rw){
				       if($rw->theme_id == 6 || $rw->theme_id == 11 || $rw->theme_id == 9 || $rw->theme_id == 15)
    					$url = ($rw->domain_name.'/admin?back_url='.base_url.'/customer-login&_token='.($rw->id));
    				   else
    					$url = ($rw->domain_name.'/admin?back_url='.base_url.'/customer-login&_token='.AJ_ENCODE($rw->id));
				       $return['html'] .= '
				       
				        <tr>
    				        
        				    <td>
        				        <h3>'.($rw->domain_name).'/admin</h3>
        				    </td>
        				    <td>
        				        <a href="http://'.$url.'" class="btn btn-success btn-sm ">
            				        Click Here
        				        </a>
        				    </td>
				        </tr>
				       ';
				   }
				   $return['html'] .= '</table>';
				}
				else{
					
					
					    $return = array('status'=>0);
				}

			}
			/*
			if(!$return['status'])
			{
    			$ft = $this->DB->get_where('admins',['email'=>$wh['_email'],'password'=>$wh['_pass'] ]);
    			if($ft->num_rows()){
    				$this->load->helper('cookie');
    				$row = $ft->row();
    				$return = ['status' => 1, 'url' => $row->domain_name.'/Admin?redirectTo=true&url='.MAIN_SITE.'&id='.AJ_ENCODE(time()).'&_token='.$row->id.'&data=true&domain='.$row->domain_name];
    			}
			}
			*/		

			echo json_encode($return);

		}else{

			$this->load->view(__FUNCTION__);

		}

	}
    
    function check(){
        $response  = file_get_contents('https://api.postalpincode.in/pincode/283151');
        $res = json_decode($response,true);// . PHP_EOL;
        pre($res);
    }
    
    function bat(){
         
        pre($this->cart->contents());
        
        
        // $prefs = array(
        //         'show_next_prev'  => TRUE,
        //         'next_prev_url'   => base_url('/web/bat/')
        // );
        // $prefs['template'] = array(
        //         'table_open'           => '<table class="calendar">',
        //         'cal_cell_start'       => '<td class="day">',
        //         'cal_cell_start_today' => '<td class="today">'
        // );
        
        // $this->load->library('calendar', $prefs);

        
        // echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
        // echo $this->calendar->get_total_days(4,2022);
    }
    
    function domainSuggestions($limit = 5){
        $keyword = $this->input->post('keyword' , true);
        $domainApi = new resellerClub\Domain;
        $suggestions = $domainApi->domainSuggestions($keyword,'',false,$limit);
                            
        if(!isset($suggestions->ERROR)):
        ?>
        
                                    <!--alert table end-->
        <h4 class="text-center">More domain options</h4>
        <table class="table vps-hosting-pricing-table domain-search-result-table">
            <tbody>
                <?php
                
                foreach($suggestions as $d => $v){
                    //print_r($v);
                    $_price = Modules :: run('domain/price',$d);
                    ?>
                    <tr class="vps-pricing-row">
                        <td data-value="Available"><?=fetch_domain_tld($d,'domain')?><span class="color-primary">.<?=fetch_domain_tld($d,'tld')?></span></td>
                        <td data-value="Price">
                            <p>
                                <span class="rate"><?=$_price?><span>/Yr</span></span>
                                <span class="pricing-onsale">On sale - <span class="badge color-3 color-3-bg">Save 30%</span></span>
                            </p>
                        </td>
                        <td>
                            <!--<a href="javascript:;" class="btn btn-brand-01 btn-sm"><i class="fa fa-shopping-cart"></i> Add to Cart</a>-->
                            <?php
                            echo Modules :: run('cart/domain_button',$d);
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            
            </tbody>
        </table>
        <?php
        endif;
    }
    function domain_checker(){ 
        // $this->load->module('cart');
        $domain = $keyword = $tld = '';
        $suggestions =  $domains = [];
        if($get = $this->input->get()){
            $domain = $get['domain'];
            if(isset($get['domainType'])){
                $domain .= "." . $get['domainType'];
            }
        }
        else if($post = $this->input->post()){
            $domain = $post['domain'];
        }
        
        
        if(!empty($domain)){
        
            $domain = (!($point = strpos($domain,'.')))  ?  "$domain.com" : $domain;
            
            $keyword = fetch_domain_tld($domain,'domain');
            
            $tld     = fetch_domain_tld($domain,'tld');
            
        }
            
        
        
        
        $this-> render('domain-checker',[
                                    'domain' => $domain,
                                    'keyword' => $keyword,
                                    'tld' => $tld
                                ]);
             
    }
    
    function logout(){
        $this->sesion->unset_userdata([
                                                    'CLIENT_LOGIN',
                                                    'CLIENT_ID'  ,
                                                    'CUSTOMER_ID',
                                                    'CUSTOMER_ID',
                                                ]);
        redirect('login');
    }
    
    function test(){
        // $this->load->module('domain');
        // $x = $this->domain->price('sitejeannie12.com');
        pre($this->domainPrice());
    }
    
    function checkout()
    {
        
        if($this->session->has_userdata('CLIENT_LOGIN')){
            /*
            $return['btn'] = false;
            
            if($total = $this->cart->total()){
                /*
                $api = $this->razorpay;
                $orderData = [
                    'receipt'         => rand(11111,999999),
                    'amount'          => $total * 100, // 2000 rupees in paise
                    'currency'        => 'INR',
                    'payment_capture' => 1 // auto capture
                ];
                
                $razorpayOrder = $api->order->create($orderData);
                
                $razorpayOrderId = $razorpayOrder['id'];
                
                $_SESSION['razorpay_order_id'] = $razorpayOrderId;
                
                $displayAmount = $amount = $orderData['amount'];
                $displayCurrency = 'INR';
                if ($displayCurrency !== 'INR')
                {
                    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                    $exchange = json_decode(file_get_contents($url), true);
                
                    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
                }
                
                $checkout = 'manual';
                
                if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
                {
                    $checkout = $_GET['checkout'];
                }
                $client_details = $this->db->where('id', $this->session->userdata('CLIENT_ID'))->get('clients')->row();
                $data = [
                    "key"               => razorpay_key,
                    "amount"            => $orderData['amount'],
                    "name"              => "Bizknowindia",
                    "description"       => "Software & Website",
                    "image"             => base_url('upload/bizknowindiaLogo.jpeg'),
                    "prefill"           => [
                            "name"              => "$client_details->firstname $client_details->lastname",
                            "email"             => $client_details->email,
                            "contact"           => $client_details->mobile,
                        ],
                    "notes"             => [
                                                "address"           => $client_details->address1,
                                                "merchant_order_id" => rand(1111111,9999999).'-' . $client_details->id,
                                            ],
                    "theme"             => [
                                                "color"             => "#0267e2"
                                           ],
                    "order_id"          => $razorpayOrderId,
                ];
                
                if ($displayCurrency !== 'INR')
                {
                    $data['display_currency']  = $displayCurrency;
                    $data['display_amount']    = $displayAmount;
                }
                
                $return['json'] = json_encode($data);
                $return['btn'] = true;
            }
            */
            
            
            extract($this->db->select('id,firstname,lastname,email,mobile')->where('id', $this->session->userdata('CLIENT_ID'))->get('clients')->row_array());
            if($post = $this->input->post()){
               // pre($post);
                if(isset($post['method']) AND $grand_total = $this->cart->total()){
                    
                    switch($post['method']){
                        
                        case 'payu':
                            $this->pum->init('vi5xgOsKL4','4Ff9Td5F');
                            $this->pum->add_field('amount', $grand_total);
                            $this->pum->add_field('firstname', "$firstname $lastname");
                            $this->pum->add_field('email', $email);
                            $this->pum->add_field('phone', $mobile);
                            $this->pum->add_field('udf1', $id);
        
                            $this->pum->add_field('surl', base_url().'cart/finish');
                            $this->pum->add_field('furl', base_url().'cart/finish');
                           // pre($this->pum->all_fields());
                            // submit the fields to pum
                            $this->pum->submit_pum_post();
                            die();
                        break;
                        
                        
                    }
                    
                }
                else
                    $return['error'] = 'Something went wrong.';
            }
            //else{
                $return['page'] = __FUNCTION__;
                $this->render('cart',$return);
            //}
        }
        else{
            $_SESSION['login_url'] = current_url();
           $this->session->mark_as_temp('login_url', 300);
           redirect(site_url('login'));
        }
    }
    
    private function domain_register(){
        
        $domain = new \Resellerclub\Domain;
        
            $customer = ($this->db->select('customer_id,contact_id')->where('id', $this->session->userdata('CLIENT_ID'))->get('clients')->row());
                
                $customerId = $customer->customer_id;
                $contactId = $customer->contact_id;
        foreach($this->cart->contents() as $rowId => $item){
            
            if($item['type'] == 'domain'){
                
                $domainDetails = array(
                  'years' => $item['duration'],
                  'ns' => array('ns1.bizknowindia.co.in', 'ns2.bizknowindia.co.in'),
                  'customer-id' => $customerId,
                  'reg-contact-id' => $contactId,
                  'admin-contact-id' => $contactId,
                  'tech-contact-id' => $contactId,
                  'billing-contact-id' => $contactId,
                  'invoice-option' => 'NoInvoice',
                );
                
                $apiOut = $domain->register($item['name'], $domainDetails);
                
            }
            
        }
    }
    /*
    function cart($para1 = 'list', $para2 = '', $para3 = '', $para4 = '')
    {
        
        @$this->cart->product_name_rules = '[:print:]';
        $post = $this->input->post();
        
        if($para1 == 'finish'){
            $this->load->model('order_model');
            if(isset($post['payuMoneyId'])){
                if($post['status'] == 'success'){
                    $data = [
                            'client_id' => $post['udf1'],
                            'ttl_items' => $this->cart->total_items(),
                            'price' => $this->cart->total(),
                            'order_id' => time(),
                            'payment_method' => 'payumoney',
                            'payment_data' => json_encode($post)
                    ];
                    $this->order_model->create($data);
                    
                    $this->domain_register();
                    redirect(base_url());
                }
                else{
                    pre($post);
                }
            }
        }
        else if($para1 == 'search_doamin'){
            echo json_encode($post);
        }
        else if ($para1 == "add") {
            $year = isset($post['duration']) ? $post['duration'] : 1;
            $duration_type = isset($post['duration_type']) ? $post['duration_type'] : 'year';
            $name = '';
            $price = 0;
            $qty = 1;
            $id = 0;
            if($para2 == 'domain'){
                $name = $id = $para3;
                $price = $this->fetch_domain_price($name);
                
            }
        
            if($para3 == 'pp') {
                $carted = $this->cart->contents();
                foreach ($carted as $items) {
                    if ($items['id'] == $para2) {
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => 0
                        );
                    } else {
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => $items['qty']
                        );
                    }
                    $this->cart->update($data);
                }
            }

           // $qty = 1;

            $data = array(
                'id' => $id,
                'qty' => $qty,
                'type' => $para2,
                'duration' => $year,
                'duration_type' => $duration_type,
                'option' => '',
                'price' => $price,
                'name' => $name,
                'coupon' => ''
            );
            
            $__data = $data;
           
            if (!$this->cart_model->is_added_to_cart($id) ) {
                
                $this->cart->insert($__data);
                echo 'added';
                
            } else {
                echo 'already';
            }
            //var_dump($this->cart->contents());
            //exit;
        }
        else if($para1  == 'list'){
            $this -> render('cart');
        }
        
       // echo 1;
    }
    */
    function login(){
        if($post = $this->input->post()){
            $return = ['status' => false, 'errors' => [] ];
            if($this->form_validation->run()){
                $data = [
                        'email' => $post['username'],
                        'password' => $post['password']
                    ];
                $get = $this->db->where($data)->get('clients');
                if($get->num_rows()){
                    $row = $get->row();
                    $this->session->set_userdata([
                                                    'CLIENT_LOGIN'  => true,
                                                    'CLIENT_ID'     => $row->id,
                                                    'CUSTOMER_ID'   => $row->customer_id,
                                                    'CUSTOMER_ID'   => $row->contact_id
                                                ]);
                    $return['status'] = true;
                    $return['href'] =  site_url('clientarea');
                    if($url = $this->session->userdata('login_url')){
                        $return['href'] = $url;
                    }
                    
                }
                else{
                    $return['errors'][] = 'Wrong Username Or Password , Please Try Again..';
                }
            }
            else{
                $return['errors'] = $this->form_validation->error_array();//();
            }
            
            echo json_encode($return);  
        }
        else
            $this -> render('login');
    }
    function register(){
        $return = ['status' => false, 'errors' => [] ];
        if($post = $this->input->post()){
            if($this->form_validation->run()){
                 
                $customer = new \Resellerclub\Customer;
                $contact = new \Resellerclub\Contact;

                $customerDetails = array(
                  'username' => $post['email'],
                  'passwd' => $post['password'],
                  'name' => $post['firstname'] .' ' . $post['lastname'],
                  'company' => empty($post['companyname']) ? 'N/A' : $post['companyname'],
                  'address-line-1' => $post['address1'],
                  'city' => $post['city'],
                  'state' => $post['state'],
                  'country' => $post['country'],
                  'zipcode' => $post['postcode'],
                  'phone-cc' => '91',
                  'phone' => $post['mobile'],
                  'lang-pref' => 'en',
                );
                unset($post['accepttos']);
                unset($post['password2']);
                
                $customer_id = response( $customer->createCustomer($customerDetails) );
                
                if(isset($customer_id['status'])){
                    $return['errors'][] = $customer_id['message'];
                }
                else if(is_numeric($customer_id[0])){
                    $customer_id = $customer_id[0];
                    $post['customer_id'] = ($customer_id);
                    unset($customerDetails['username']);
                    unset($customerDetails['passwd']);
                    unset($customerDetails['state']);
                    unset($customerDetails['lang-pref']);
                    
                    $customerDetails['customer-id'] = $customer_id;
                    $customerDetails['email'] = $post['email'];
                    $customerDetails['type'] = 'Contact';
                    //pre($customerDetails);
                    $contact_d = $contact->createContact($customerDetails);
                   // pre($contact_d);
                   unset($post['register']);
                    @$post['contact_id'] = $contact_d;
                    $this->db->insert('clients',$post);
                    $id = $this->db->insert_id();
                    $this->session->set_userdata([
                                                    'CLIENT_LOGIN'  => true,
                                                    'CLIENT_ID'     => $id,
                                                    'CUSTOMER_ID'   => $customer_id,
                                                    'CUSTOMER_ID'   => @$post['contact_id']
                                                ]);
                    
                    $return['status'] = true;
                }
                
            }
            else{
                $return['errors'] = $this->form_validation->error_array();//();
            }
            
            echo json_encode($return);  
             
        }
        else
            $this -> render('register');
    }
    
    
    public function index()
	{
        $this->load->library('gravatar');
        $email = 'ajaykumararya963983@gmail.com';
        $gravatar_url = $this->gravatar->get( $email );
        
	    $data = array(
            'title'     => 'BizKnow India Site',
            'name'      => 'Developer',
            'compani'   => 'BizKnow India',
            'gavatar'   => $gravatar_url,
            'url'       => 'https://bizknowindia.org.in/',
            'heading'   => 'Welcome to HMVC!'
        );
        
		$this->render('index',$data);
	}
    
    public function hmvc()
    {
       $data = array(
            'title' => 'BizKnow India Site',
            'name' => 'Developer',
            'compani' => 'BizKnow India',
            'url' => 'https://bizknowindia.org.in/',
            'heading' => 'Welcome to HMVC!' 
        );
       // print_r($data);
       $this->load->view('welcome_message', $data); 
    }
    
    public function parse()
    {
        $this->load->library('parser');
        $data = array(
            'title' => 'Первая страница из шаблона',
            'name' => 'Александр Мороз',
            'compani' => 'RAMStudio',
            'url' => 'http://moroz.rv.ua',
            'heading' => 'Страница из шаблона тем (шаблон acme)- Welcome to CodeIgniter HMVC!'
        );
        
        $this->parser->parse(DIR_THEMS.'/welcome_message_header.tpl', $data);
        $this->parser->parse(DIR_THEMS.'/welcome_message_tpl.tpl', $data);
    }
    
}
