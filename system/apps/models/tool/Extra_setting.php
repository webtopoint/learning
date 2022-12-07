<?php
class Extra_setting extends CI_Model{
    function __construct(){
        parent::__construct();
        $this-> db = $this->load->database('tool',true);
    }
    
    function get($type = '',$value = true,$default_val = ''){
        if($type){
            $where = $type == 'all' ? [] : (is_array($type) ? $type : ['type' => $type]);
            $where['admin_id'] = CLIENT_ID;
            $this->db->where($where);
            $get = $this->db->get('extra_setting');
            if($type == 'all'){
                return $get;
            }
            else if($value == 'get_row' AND !is_bool($value)){
                return $get->result();
            }
            else if($get->num_rows()){
                $row = $get -> row();
                return $value ?
                                is_bool($value) ? $row->value : $row->{$value}
                            : false;
            }
            return $default_val;
        }
        return false;
    }
    
    function insert($data){
        $data['admin_id'] = CLIENT_ID;
        return $this->db->insert('extra_setting',$data);
    }
    
    function update($data,$where){
        return $this->db->update('extra_setting',$data,$where);
    }

    function set_in_page($data){
        $data['admin_id'] = CLIENT_ID;
        $data['key_id'] = $data['type_id'];
        unset($data['type_id']);
        if($this->db->where($data)->get('web_schema')->num_rows()){
            $this->db->where($data)->delete('web_schema');
            return 'delete';
        }
        else
            $this->db->insert('web_schema',$data);
        return 'add';
    }

} // 