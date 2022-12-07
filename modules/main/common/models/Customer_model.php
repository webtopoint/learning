<?php
class Customer_model extends CI_Model
{
	public $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('tool',true);
	}
	public function getCustomer($where) 
	{
		return $this->db->get_where('websites',$where);
	}
}
?>