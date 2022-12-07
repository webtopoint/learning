<?php

class Errors extends WEB_Controller{
    
    function __construct(){
        parent :: __construct();
    }
    
    function page_missing(){
        //$this->output->set_status_header('404'); 
        $this->load->view(DIR_THEMS.'/errors/main_site_404');
    }
}


?>