<?php

class PaymentModel extends Ci_Model
{

	

	function __construct()

	{

		parent::__construct();

		$this->load->database();

	}

	public function addPaymentMethod($data)
	{
		if(!$this->db->where(array('method'=>$data['method'],'admin_id'=>$data['admin_id']))->get('payment_method')->num_rows())
		return $this->db->insert('payment_method',$data);
		else{
		    unset($data['admin_id']);
		    $method = $data['method'];
		    unset($data['method']);
		return $this->db->where(['admin_id'=>CLIENT_ID,'method'=>$method ])->update('payment_method',$data);
		}
	}

	public function getPaymentMethod($where=0)
	{	if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->get('payment_method');
	}
	public function removeMethod($where)
	{
		$this->db->where($where)->where('admin_id',CLIENT_ID)->update('payment_method',['key1'=>'','key2'=>'']);
	}

	public function transactionInit($data)
	{
		if($this->db->insert('transaction_record',$data))
			return $this->db->insert_id();//$this->db->order_by('id','desc')->limit(1)->get('transaction_record')->row()->id;
		else
			return false;
	}

	public function updateTransactionRecord($where,$data)
	{
		$this->db->where($where)->where('admin_id',CLIENT_ID)->update('transaction_record',$data);
	}

	public function addFinalTransaction($data)
	{
		$this->db->insert('transaction_final',$data);
	}
	public function getTransactionRecord($where)
	{
		if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->get('transaction_record');
	}
}