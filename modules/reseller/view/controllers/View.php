<?php
class View extends Reseller_Controller{
    public $permission_denied = false,$data = [];
    function __construct(){
        parent :: __construct();

        $this->load->model('common/Payment_model','PM');
        $this->load->model('common/Wallet_model','WM');
        $this->load->model('common/Account_model','AM');
        $this->load->model('common/Plan_model','plan');
        $get = $this->plan->get();//->num_rows();
        if($plansttl = $get->num_rows()){
            
        }
        
        $this->load->vars(['havePlans' => $plansttl]);
        // echo 
        // exit;
    }   

    function test(){
        $this->load_crud();
        $this->crud->set_table('websites');
        pre($this->crud);
        // if($this->crud->render())
        //     echo 'yes';
        // else    
        //     echo 'no';
    }
    function relogin(){
        
        $this->load->model('common/Auth_model','AuM');
        $get = $this->AM->get_account(['id' => RID]);
        if($get->num_rows()){
            $this->AuM->back_login($get->row());
        }
        else    
            show_error('something went wrong.');
    }
    function display($page = 'index',$data = []){
        $data = array_merge($this->data,$data);
        $this->config->set_item('backend',1);
        $page = ($this->permission_denied) ? 'permission_denied' : $page;
        
        if(is_object($page)){
            if($page->myTableName)
                $data['output'] = (json_decode(json_encode($page->render()),true));
        }
        else{
            $data['page'] = $page = strpos($page,'.tpl') ? $page : "$page.tpl";
            $data['page_data'] = $this->parser->parse($page,$data,true);
        }

        if(!$this->session->has_userdata('reseller_login'))
            $this->load->view('admin/login');
        else
            $this->parser->parse('admin/template',$data);
    }
    
    function web($page = '',$data = []){
        $data = array_merge($this->data,$data);

        $data['page'] = strpos($page,'.tpl') ? $page : "$page.tpl";
        
        $data['page_data'] = $this->parser->parse($page,$data,true);
        $this->parser->parse('template',$data);
    } 
    
    function output($data,$header = 200){
        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header($header)
                        ->set_output(json_encode($data));
    }
}

?>