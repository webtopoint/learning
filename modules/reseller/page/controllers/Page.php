<?php
class Page extends Reseller_Controller{
	function __construct(){
		parent :: __construct();
	}
	function view(){
		$page = $this->uri->segment(2,0);
		if($page){
			$get = $this->db->where('link',$page)->get('his_pages');
			if($get->num_rows()){
				$get = $get->row();
				$data['title'] = $get->page_name;
				$this->config->set_item('page_id',$get->id);
				echo Modules :: run('web/load',$data);
			}
			else
				show_404();

		}
		else	
			show_404();
	}

    function print_menu_items($where=[]){
	    if(count($where))
	        $this->db->where($where);
	    $query = $this->db->order_by('sort')->get('his_pages');

		$ref = $items = [];

		foreach($query->result() as $k => $data) {

			$thisRef           	= &$ref[$data->id];
			$thisRef['parent'] 	= $data->parent_id;
			$thisRef['label']  	= ucwords($data->page_name);
			$thisRef['link']   	= (defaultPage == $data->id) ? base_url() : ( (filter_var($data->link, FILTER_VALIDATE_URL) ) ?  $data->link : base_url('page/'.$data->link) ) ;
			$thisRef['id'] 		= $thisRef['page_id']     = $data->id;
			$thisRef['target'] 	= $data->redirection ? ' target="_blank" ' : '';

			if($data->parent_id == 0)
				$items[$data->id] = &$thisRef;
			else 
				$ref[$data->parent_id]['child'][$data->id] = &$thisRef;			   
		}
		return $items;
	}

}


?>