<?php
class Plans extends Reseller_Controller{
    function __construct(){
        parent :: __construct();
    }


    function index(){
        $this->list();
    }

    function list(){
        // $this->
        $this->view->display('list',['list' => 'ok']);
    }


}



?>