<?php
class Reseller_Model extends CI_Model{
    public $data = ['account_id' => RID];
    
    function __constrcut(){
        parent :: __construct();
    }

    function set($data){
        array_push($this->data,$data);
        return $this;
    }
}

?>