<?php
class Payment_model extends Reseller_Model{
    function add_transaction($data){
        $this->db->insert('payment_details',$data);
    }
}