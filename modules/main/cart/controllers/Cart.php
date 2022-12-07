<?php
class Cart extends WEB_Controller{
    
    function __construct(){
        parent :: __construct();
        
         @$this->cart->product_name_rules = '[:print:]';
         
         $this->load->model('common/cart_model');
         $this->load->model('common/order_model');
    }
    
    function index(){
        
        $this -> render('cart');
        
       return false;
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
    }
    function remove($rowId){
        return $this->cart->remove($rowId);
    }
    function isExist($id){
        return $this->cart_model->is_added_to_cart($id);
    }
    function add_item($array,$type = 'domain'){
        
        $array['type'] = $type;
        if (!$this->cart_model->is_added_to_cart($array['id']) ) {
            
            $this->cart->insert($array);
            return 'added';
            
        } else {
            return 'already';
        }
        
        return ;
    }
    
    function add_domain($domain =''){
        $post = $this->input->post();
        $result = false;
        if(!empty($domain)){
            $year = isset($post['duration']) ? $post['duration'] : 1;
            $duration_type = isset($post['duration_type']) ? $post['duration_type'] : 'year';
            $response = Modules :: run('domain/fetch',$domain);
            
            if($response['status']){
                
                $price = 0;
                $qty = 1;
                $id = 0;
                
                $price = $response['price'];//$this->fetch_domain_price($domain);
                   
               // $qty = 1;
    
                $data = array(
                    'id' => $domain,
                    'qty' => $qty,
                    'duration' => $year,
                    'duration_type' => $duration_type,
                    'option' => '',
                    'price' => $price,
                    'name' => $domain,
                    'coupon' => ''
                );
                $result = $this->add_item($data);
            }
        }
        
        if( $this->input->is_ajax_request())
            echo $result;
        else
            return $result;
    }
    
    function finish(){
        
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
    
    function domain_button($domain  , $todo = 'to-add'){
        $todo = $this->isExist($domain) ? 'checkout' : $todo;
        $this->load->view(__FUNCTION__,['domain' => $domain, 'todo' => $todo]);
    }
    
}


?>