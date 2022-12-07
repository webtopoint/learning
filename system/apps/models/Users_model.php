<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }

    //Функция выбирает каталог по meta_url
    function get_table($table)
    {
        $query = $this->db->get($table)->result_array(); 
        return $query;
        
    }
    
    function get_user_role_menu($where = 0){
        if($where)
            $this->db->where($where);
        $get = $this->db->where('role_id',$this->session->userdata('role'))->get('role');
        if($get->num_rows()){
            $row = $get->row();
            $id = [1];
            if($row->role_id != 1){
                $ids = (array) multi_to_single_array(json_decode($row->permission,true));
              
                $perimssion = $this->db->where_in('permission_id',$ids)->get('permission');
                
            }
            else
                $perimssion = $this->db->get('permission');
            
            if($perimssion->num_rows()){
                $permissions = [];
                foreach($perimssion->result() as $perm){
                    $permissions[] = $perm->	permission_id;
                }
                return $permissions;
            }
        }
        
        return false;
    }
    
    function get_user($id){
        $result = $this->db->select('*')->where('id', $id)->get('users')->row_array();
        return $result;
    }

    function count_user($table,$permiss){
        //$result = $this->db->count_all_results($id); // всего записей
        $result = $this->db->where('group_id', $permiss);
        $result = $this->db->from($table);
        $result =$this->db->count_all_results();
        return $result;
    }
    
    


}