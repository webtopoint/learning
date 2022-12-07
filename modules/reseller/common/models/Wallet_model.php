<?php
class Wallet_model extends Reseller_Model{
    
    function wallet_update($amount){
        return $this->db->set('wallet','wallet + '.$amount,false)->where('id',$this->data['account_id'])
                        ->update('accounts');
    }

    function add_wallet_transaction($data){
        $this->set($data);
        $this->db->insert('wallet_transactions',$this->data);
        return $this->db->insert_id();
    }

    function get_wallet_transaction($where = 0){
        if($where)
            $this->db->where($where);
        else
            $this->db->or_where(['type' => 'wallet','type' => 'wallet_failed']);

        return $this->db->order_by('id','DESC')->where('account_id',RID)

            ->get('payment_details');
    }
}