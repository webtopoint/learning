<?php
class SiteModel extends CI_Model{
    function extra_setting($where = [],$field = '',$value = ''){
        $field = is_bool($field) ? 'value' : $field; 
        if(!is_array($where))
           $where = [ 'type' => $where ];
        $where['admin_id'] = CLIENT_ID;
        $get = $this->db->where($where)->get('extra_setting');
        if($get->num_rows()){
            if(!empty($field) AND is_string($field))
                return $get->row()->$field;
            return $get->row();
        }
        return $value;
    }
}


?>