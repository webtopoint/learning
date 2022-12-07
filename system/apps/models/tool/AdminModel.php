<?php
class AdminModel extends CI_MODEL
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getAdmin($where)
	{
		return $this->db->get_where('websites',$where);
	}
	public function updateAdmin($where,$data)
	{
		 $this->db->where($where);
		return $this->db->update('websites',$data);
	}
}
?>