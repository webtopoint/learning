<?php

class ServiceModel extends Ci_Model
{

	function __construct()

	{

		parent::__construct();

		$this->load->database();

	}

	public function addFileService($data)
	{
		$this->db->insert('file_service',$data);
	}

	public function getFileService($where=0)
	{
		if($where)
			$this->db->where($where);
		$this->db->where('admin_id',CLIENT_ID);
		return $this->db->get('file_service');
	}

	public function getFileServiceData($where=0)
	{
		if($where)
			$this->db->where($where);
		$this->db->where('admin_id',CLIENT_ID);
		return $this->db->get('file_service_data');
	}

	public function checkFileServiceUse($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('file_service_link')->num_rows();
	}

	public function userFileService($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('file_service_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('file_service_link');
			$schema = array('type'=>'fservice',
							'key_id'=>$data['service_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('file_service_link',$data);

			$schema = array('type'=>'fservice',
							'key_id'=>$data['service_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}
	
	function deleteFileService($data){
	        $this->db->where('id',$data['service_id'])->delete('file_service');
	        $this->db->where($data)->where('admin_id',CLIENT_ID)->delete('file_service_link');
			$schema = array('type'=>'fservice',
							'key_id'=>$data['service_id'],
							'admin_id'=>CLIENT_ID
						);
			$this->db->where($schema)->delete('web_schema');
	}

	public function findFile($key,$service_id) 
	{
		$res = $this->db->where(array('data'=>$key,'service_id'=>$service_id))->limit(1)->get('file_service_data');
		return $res;
	}
}