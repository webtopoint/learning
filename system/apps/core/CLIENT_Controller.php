<?php
class CLIENT_Controller extends WEB_Controller{
    
    function __construct(){
        parent :: __construct();
        
        if(!$this->session->has_userdata('CLIENT_LOGIN')){
            redirect('login');
        }
        else{
            $this->session->sess_expiration = 14400; // 4 Hours
        }
        $this->session->sess_expire_on_close = FALSE;
        
    }
    
}


?>