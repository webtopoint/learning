<?php
class MY_Model extends CI_Model{
    function __construct(){
        parent :: __construct();
    }
    
}


class Tool_Model extends MY_Model{
    function __construct(){
        parent :: __construct();
        $this->db = $this->load->database('tool',true);
    }
}



?>