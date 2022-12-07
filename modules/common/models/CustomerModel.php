<?
class CustomerModel extends CI_MODEL
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getCustomer($where) 
	{
		return $this->db->get_where('websites',$where);
	}
}
?>