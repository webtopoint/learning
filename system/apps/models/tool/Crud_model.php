<?php
class Crud_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    function get_general_setting_by_type($type=0){
        if($type)
           $this->db->where('type',$type);
        $this->db->where('admin_id',CLIENT_ID);
        $td = $this->db->get('general_settings');
        if($td->num_rows()){
            return $td->row()->value;
        }
        else
            return 'no';
    }
    function add_data_by_table_name($data,$table_name,$subject=''){
        $this->db->where($data);
        $get = $this->db->get($table_name);
        if(!$get->num_rows()){
            $this->db->insert($table_name,$data);
          $this->session->set_flashdata('success',ucwords(array_values($data)[0]).' '.$subject.' Added Successfully..');
        }
        else
            $this->session->set_flashdata('error',ucwords(array_values($data)[0]).' '.$subject.' is already Exists.');
    }
    
    function get_class_data($where){
        return $this->db->get_where('classes',$where);
    }
}

?>