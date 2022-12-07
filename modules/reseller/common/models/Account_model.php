<?php
class Account_model extends CI_Model{
    function get_account($where = []){
        $this->db->where($where);
        return $this->db->get('accounts');
    }
}
?>