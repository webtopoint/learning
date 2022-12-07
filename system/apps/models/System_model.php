<?php
class System_model extends CI_Model{
    function admin_permission($codename)
    {
        if ($this->session->userdata('logged_in') != '1') {
            return false;
        }
        
        
        
        $admin_id   = $this->session->userdata('admin_id');
        
        $admin      = $this->db->get_where('admin', array(
            'id' => $admin
        ))->row();
		$this->benchmark->mark_time();
        $permission = $this->db->get_where('permission', array(
            'codename' => $codename
        ))->row()->permission_id;
        if ($admin->role == 1) {
            return true;
        } else {
            $role             = $admin->role;
            $role_permissions = json_decode($this->get_type_name_by_id('role', $role, 'permission'));
            if (in_array($permission, $role_permissions)) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    /////////GET NAME BY TABLE NAME AND ID/////////////
    function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
        if ($type_id != '') {
            
            $this->db->where([$type . '_id' => $type_id ]);
                
            $l = $this->db->get($type);
            $n = $l->num_rows(); 
            if ($n > 0) {
                return $l->row()->$field;
            }
        }
    }
    
    function extra_setting($where = [],$field = '',$value = ''){
        $field = is_bool($field) ? 'value' : $field; 
        if(!is_array($where))
           $where = [ 'type' => $where ];
        $get = $this->db->where($where)->get('extra_setting');
        if($get->num_rows()){
            if(!empty($field) AND is_string($field))
                return $get->row()->$field;
            return $get->row();
        }
        return $value;
    }
    
    function client_module($id = 0){
        $this->db->select('*');
        $this->db->from('addon_setting');
        $this->db->join('system_addons', 'system_addons.id = addon_setting.addon_id AND addon_setting.client_id = '.CLIENT_ID);
        $this->db->join('all_transactions','all_transactions.time = addon_setting.payment_id AND all_transactions.client_id = '.CLIENT_ID);
        if($id)
            $this->db->where('addon_setting.addon_id',$id);
        return $this->db->get();
    }
    
    function get($id = 0){
        if($id)
            $this->db->where('id',$id);
        return $this->db->get_where('system_addons',['status' => 1]);
    }
    
    function not_exists_client_addon($data){
        return $this->db->get_where('addon_setting',$data)->num_rows() > 1 ? false : true;
    }
    
    function add_addon_of_client($data){
        return $this->db->insert('addon_setting',$data);
    }
    
    
    
}


?>