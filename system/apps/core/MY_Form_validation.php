<?php if ( defined('BASEPATH') === FALSE ) exit('No direct script access allowed');
 

class MY_Form_validation extends CI_Form_validation
{

    function __construct($rules = array())
    {
        parent::__construct($rules);
        $this->CI->db2 = $this->load->database('tool',true);
    }

    public function is_db2_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.]', $table, $field);
        return isset($this->CI->db2)
            ? ($this->CI->db2->limit(1)->get_where($table, array($field => $str))->num_rows() === 0)
            : FALSE;
    }
}