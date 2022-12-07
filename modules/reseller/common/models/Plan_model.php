<?php
class Plan_model extends Reseller_Model
{
    function get($id = 0){
        if($id)
            $this->db->where('plan_id',$id);
        $this->db->where('account_id',RID);
        return $this->db->get('plans');
    }
}


?>