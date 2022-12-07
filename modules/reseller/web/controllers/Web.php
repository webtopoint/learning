<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends WEB_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('common/template');
        $this->load->model('common/Auth_model','auth');
        $this->load->module('view');
    }


    function index(){
        $this->load();
    }   



    function load($data = []){
        $data['title'] = isset($data['title']) ? $data['title'] : 'Reseller Website';
        $data['css_data'] = '';
        $this->parser->parse('web/common/header',$data);
        $this->parser->parse('index',[]);
        $this->parser->parse('web/common/footer',$data);
    }


    function login(){
        
        if($post = $this->input->post()){
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('password','Password','required');
            
            if($this->form_validation->run()){
                $res = $this->auth->login($post['email'],$post['password']);
            }
            else    
                $res = ['status' => false,'message' => validation_errors()];

            $this->view->output($res);
        }
        else
            $this->load->view('admin/login');
    }
    
    
    
}
?>