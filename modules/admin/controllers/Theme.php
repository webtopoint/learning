<?php
class Theme extends Tool_Controller{
    function __construct(){
        parent :: __construct();
    }
    function index(){
        echo 'done';
    }
    
    function setting($type = 0){
        if($type){
            if ( !($view =  Modules :: run('addons/'.$type)))
                $view = Modules :: run('addons/view',$type);
            echo $view;
        }
    }
}

?>