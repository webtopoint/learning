<?php

class FormModel extends CI_MODEL

{

	

	function __construct()

	{

		parent::__construct();

		$this->load->database();

	}


	public function addForm($data)
	{
		return $this->db->insert('form_model',$data);
	}

	public function getFormModel($where=0, $select = FALSE)
	{
	    if(is_string($select))
	        $this->db->select($select);
	        
		if($where)
			$this->db->where($where);
			
		return $this->db->where('admin_id',CLIENT_ID)->get('form_model');
	}

	public function getFormLink($where=0)
	{
		if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->get('form_link');
	}

	public function getTransactionFormLink($where=0)
	{
		if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->get('transaction_form_link');
	}

	public function checkFormUse($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('form_link')->num_rows();
	}
	function checkFormUseInProductGallery($where){
	    return $this->db->where($where)->where('form_type','form')->where('admin_id',CLIENT_ID)->get('product_gallery')->num_rows();
	}

	public function useForm($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('form_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('form_link');
			$schema = array('type'=>'form',
							'key_id'=>$data['form_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('form_link',$data);

			$schema = array('type'=>'form',
							'key_id'=>$data['form_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}
    function getSearchResultForm_View($where=[]){
        if(count($where))
          $this->db->where($where);
        return $this->db->get_where('resull_search_form',['admin_id'=>CLIENT_ID]);
    }
    function deleteResultData($where){
        return $this->db->where($where)->delete('result_data');
    }
    function userResultForm($data){
        if($this->db->where($data)->where(['admin_id'=>CLIENT_ID,'type'=>'rform'])->get('web_schema')->num_rows())
		{
			$schema = array('type'=>'rform',
							'key_id'=>$data['key_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
			return 'remove';
		}
		else
		{
			$schema = array('type'=>'rform',
							'key_id'=>$data['key_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
			return 'insert';
		}
		return 'nothing';
    }

	public function useTransactionForm($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('transaction_form_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('transaction_form_link');

			$schema = array('type'=>'tform',
							'key_id'=>$data['form_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else{
			$this->db->set('admin_id',CLIENT_ID)->insert('transaction_form_link',$data);
			$schema = array('type'=>'tform',
							'key_id'=>$data['form_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}

	public function checkTransactionFormUse($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('transaction_form_link')->num_rows();
	}

	public function formModel($where,$data)
	{
		$this->db->where($where);
		$this->db->update('form_model',$data);
	}

	public function getFormData($where=0)
	{
		if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->order_by('id','desc')->get('form_data');
	}

	public function submitForm($data)
	{
		$this->db->insert('form_data',$data);
	}


	public function editForm($where,$data)
	{
		$this->db->where($where);
		$this->db->update('form_model',$data);
	}

	public function deleteForm($where)
	{
		$this->db->where($where)->delete('form_model');
	}

	public function deleteFormLink($where)
	{
		$this->db->where($where)->delete('form_link');
	}
	public function addTransactionForm($data)
	{
		$this->db->insert('transaction_form',$data);
	}
	function delete_transform($wh){
	    $this->db->where($wh)->delete('transaction_form');
	}
	public function getTransactionForm($where=0)
	{
		if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->get('view_transaction_form');
	}

	public function getTransactionView($where)
	{
		return $this->db->where($where)->order_by('id','desc')->get('view_transaction');
	}
}
?>