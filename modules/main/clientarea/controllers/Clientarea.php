<?php
class Clientarea extends CLIENT_Controller{
    
    function __construct(){
        parent :: __construct();
        $this->set_sub_dir('clientarea');
    }
    
    function index(){
        // echo 'INDEX';
        $this -> render(
                'index'
            );
    }
    
    
    
}

?>