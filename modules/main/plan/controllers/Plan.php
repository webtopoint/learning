<?php

class Plan extends Main_Controller{
    function __construct(){
        parent :: __construct();
    }
    
    
    function create(){
        $this->render([],'create');
    }
    function index(){
        $this->list();
    }
    function list(){
        $this->render([],'list');
    }
    
    
    
}



?>