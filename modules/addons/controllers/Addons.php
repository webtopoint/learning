<?php
class Addons extends Tool_Controller{
    public $form,$hidden_array = [],$form_url ;
    function __construct(){
        parent :: __construct();
        $this->hidden_array['type'] = @debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT,6)[3]['args'][0];
        $this->form_url =  current_url();
        $_form_url = &$this->form_url ;
        $_form_hidden_array = &$this->hidden_array;
        $this->form = form_open_multipart($_form_url,'',$_form_hidden_array);
        $this->load->model('System_model','SM');
    }
    
    function view($file = '', $data = [], $return = 'tool'){
        $data['return'] = true;
        return $this->load->view('addons/'.$file,$data,$return);
    }
    
    
    function print_menu(){
        $list = $this->SM->client_module();
        if($list->num_rows()){
            foreach($list->result() as $row){
                $this->load->view("menu_sections/$row->value");
            }
        }
    }
    
    function site_addons(){
        $this->admin_view(__FUNCTION__);
    }
    
    function payment_fail(){
        // regenrate_login();
        $this->admin_view('payment_status',['status' => 'fail']);
    }
    function check(){
        echo CLIENT_ID.'<br>';
        echo $this->SM->not_exists_client_addon(['addon_id' => 1,'client_id' => CLIENT_ID]) ? 'ok' : 'yes';
    }
    function payment_success(){
        // regenrate_login();
        if($post = $this->input->post()){
            
            $this->db->insert('addon_setting',['client_id' => CLIENT_ID,'addon_id' => $post['udf1'],'payment_id' => $post['payuMoneyId'],'status' => 1]);
            $this->db->insert('all_transactions',['client_id' => CLIENT_ID,'time' => $post['payuMoneyId'],'amount' => $post['amount'],'type' => 'purchase_addon','type_id'=>$_POST['udf1'],'data' => json_encode($_POST)]);
           
            redirect(current_url());
        }
        else
            $this->admin_view('payment_status',['status' => 'success']);
    }
    
    function go_to_payment(){
        if($post = $this->input->post()){
            $details = $this->SiteModel->self_details();
            $this->load->model('System_model');
            $addon = $this->System_model->get($post['id'])->row();
            
            $data = [
                'firstname' => $details->name,
                'email'  => $details->_email,
                'phone' => $details->phone,
                'amount' => $addon->price,
                'surl'  => base_url('addons/payment-success'),
                'furl' => base_url('addons/payment-fail'),
                'udf1' => $addon->id,
                'udf2' => CLIENT_ID,
                'productinfo' => 'Payment With Payumoney for Purchase Addon Service '.$addon->title.'.'
            ];
            echo json_encode(['form' => Modules :: run('payment/genrate_payuform',$data)]);
        }
    }
    
    private function admin_view($page = '404_index',$data = []){
        $this->load->module('admin');        
        $data['output'] = $this->load->view($page,$data,true);
        $this->admin->view($data);
    }
    function submit(){
        if($post = $this->input->post()){
            echo '<pre>';
            print_r($post);
        }
    }
}
?>