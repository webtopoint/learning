<?php

class SiteModel extends Ci_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    
    
    function extra_setting($where = [],$field = '',$value = ''){
        $field = is_bool($field) ? 'value' : $field; 
        if(!is_array($where))
           $where = [ 'type' => $where ];
        $where['admin_id'] = CLIENT_ID;
        $get = $this->db->where($where)->get('extra_setting');
        if($get->num_rows()){
            if(!empty($field) AND is_string($field) AND $field != 'all')
                return $get->row()->$field;
            return $field == 'all' ? $get : $get->row();
        }
        return $value;
    }
    function add_extra_setting($data){
        $data['admin_id'] = CLIENT_ID;
        return $this->db->insert('extra_setting',$data);
    }
    
    function update_extra_setting($where , $data){
        if(!is_array($where))
           $where = [ 'id' => $where ];
        $this->db->where($where);    
        return $this->db->update('extra_setting',$data);
    }
    
    
    function addTopBar($data = []){
        return $this->db->insert('topbar',$data);
    }
    function updateTopBar($id = 0, $data = []){
        if($id){
            return $this->db->where(['admin_id'=>CLIENT_ID,'id'=>$id])->update('topbar',$data);
        }
        return;
    }
    
    function addHeader($data = []){
        return $this->db->insert('header',$data);
    }
    function updateHeader($id = 0, $data = []){
        if($id){
            return $this->db->where(['admin_id'=>CLIENT_ID,'id'=>$id])->update('header',$data);
        }
        return;
    }
    
    
    function getTopBar(){
        return $this->db->get_where('topbar',['admin_id'=>CLIENT_ID]);
    }
    
    function getHeader(){
        return $this->db->get_where('header',['admin_id'=>CLIENT_ID]);
    }
    function Google_Analytics(){
        $get = $this->db->select('google_analytics')->where('id',CLIENT_ID)->get('websites')->row()->google_analytics;
		
		return (isJson($get) AND !empty($get))
    				? (array) OBJTOARRAY(json_decode($get))
    				: [];
    }
	function facebook_pixel(){
		$get = $this->db->select('facebook_pixels')->where('id',CLIENT_ID)->get('websites')->row()->facebook_pixels;
		
		return (isJson($get) AND !empty($get))
    				? (array) OBJTOARRAY(json_decode($get))
    				: [];
	} 
	function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
        if ($type_id != '') {
            $l = $this->db->get_where($type, array(
                $type . '_id' => $type_id,
                'admin_id' => CLIENT_ID
            ));
            $n = $l->num_rows();
            if ($n > 0) {
                return $l->row()->$field;
            }
            return;
        }
    }
    function updateGeneralSetting($id = 0, $data = []){
        if($id AND count($data))
            return $this->db->where(['general_settings_id'=>$id,'admin_id'=>CLIENT_ID])->update('general_settings',$data);
        return false;
    }
    function general_slider(){
            if(!$this->db->get_where('general_settings',['admin_id' => CLIENT_ID,'type' => 'slider' ])->num_rows())
                return $this->db->insert('general_settings',['admin_id'=>CLIENT_ID , 'type' => 'slider' , 'value' => 0, 'general_settings_id' => 2 ]);
    }
    
	public function update_website($data,$where){

	     $this->db->where($where);

	     return $this->db->update('websites',$data);

	}

	
	public function getSecondaryMenu()
	{
		return $this->db->where(array('admin_id'=>CLIENT_ID))->get('other');
	}
	

	public function list_page($id=0){

		if($id)

			$this->db->where('id',$id);

		$this->db->where('admin_id',CLIENT_ID);

		return $this->db->get('his_pages');

	}

	public function deletePage($where)
	{
		$this->db->where($where)->delete('his_pages');
	}
	public function updatePage($where,$data)
	{
		$this->db->where($where)->where('admin_id',CLIENT_ID)->update('his_pages',$data);
	}

	public function manage_files(){

		return $this->db->where('admin_id',CLIENT_ID)->order_by('id','DESC')->get('manage_files');

	}

	public function insert_manage_file($data){

		return $this->db->insert('manage_files',$data);

	}

	public function AdminTheme($data){

		$data['admin_id'] = CLIENT_ID;

		$t = $this->db->where('admin_id',CLIENT_ID)->get('admin_theme');

		if($t->num_rows())

			$this->db->where('admin_id',CLIENT_ID)->update('admin_theme',$data);

		else

			$this->db->insert('admin_theme',$data);

	}

	public function delete_manage_file($where){

		$t = $this->db->get_where('manage_files',$where)->row();

		$this->db->where(array('file_name'=>$t->file_name));

		$this->db->delete('usespace'); 

		$this->db->where(array('file_name'=>$t->file_name));

		return 	$this->db->delete('manage_files'); 

	}
	
	public function delete_usespace($where){
	    $this->db->where($where);
	    return     $this->db->delete('usespace');
	}

	public function getTheme(){

	    return $this->db->where('admin_id',CLIENT_ID)->get('admin_theme')->row();

	}

	public function getPageData($pid)
	{
		return $this->db->where('page_id',$pid)->get('his_page_content');
	}

	public function insert_file_size($data){

		return $this->db->insert('usespace',$data);

	}

	public function insertPageData($data)
	{
		if($this->db->where(array('page_id'=>$data['page_id'],'admin_id'=>CLIENT_ID))->get('his_page_content')->num_rows())
			return $this->db->where(array('page_id'=>$data['page_id'],'admin_id'=>CLIENT_ID))->update('his_page_content',$data);
		return $this->db->insert('his_page_content',$data);
	}

	public function deletePageContect($where)
	{
		$this->db->where($where)->delete('his_page_content');
	}

	public function websiteData($data)
	{
		if($this->db->where(array('admin_id'=>CLIENT_ID))->get('website_data')->num_rows())
    		$this->db->where(array('admin_id'=>CLIENT_ID))->update('website_data',$data);
    	else
    		$this->db->insert('website_data',$data);
	}

	public function getWebsiteData()
	{
		return $this->db->where('admin_id',CLIENT_ID)->get('website_data');
	}



	public function getWebsiteOtherData()
	{
		return $this->db->where('admin_id',CLIENT_ID)->get('other');
	}

	
	public function addCarousel($data)
	{
		$this->db->insert('carousel',$data);
	}

	public function getAllCarousel()
	{
		return $this->db->where('admin_id',CLIENT_ID)->get('carousel');
	}

	public function getCarousel($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('carousel');
	}
	public function updateCarousel($where,$data)
	{
		$this->db->where($where)->where('admin_id',CLIENT_ID)->update('carousel',$data);
	}
	public function checkCarouselUse($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('carousel_link')->num_rows();
	}


	public function getCarouselLink($where)
	{
		return	$this->db->where($where)->where('admin_id',CLIENT_ID)->get('carousel_link');
	}
	function useTab($data,$c= false){
		if($c)
			return $this->db->delete('web_schema',$data);
		else
			return $this->db->insert('web_schema',$data);

	}
	function checkTabUseOrUnUse($data){
		return $this->checkEventUseOrNot($data);
	}
	function checkEventUseOrNot($data){
	    $data['admin_id'] = CLIENT_ID;
		return $this->db->get_where('web_schema',$data)->num_rows();
	}
	function update_webSchema($data) {
	    $new = [
	        'type'  => $data['type'],
	        'key_id' => $data['key_id'],
	        'page_id' => $data['page_id'],
	        'admin_id' => CLIENT_ID
	        ];
	        
	   if($this->checkEventUseOrNot($new))
	        $this->db->delete('web_schema',$new);
	   else
	        $this->db->insert('web_schema',$new);
	   return true;
	}
	public function useCarousel($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('carousel_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('carousel_link');
			$schema = array('type'=>'slider',
							'key_id'=>$data['car_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('carousel_link',$data);

			$id = 	$this->db->where($data)->limit(1)->get('carousel_link')->row()->id;
			$schema = array('type'=>'slider',
							'key_id'=>$data['car_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}
	
	public function self_details($clientid = CLIENT_ID){
	    return $this->db->where('id',$clientid)->get('websites')->row();
	}

	public function getDefaultPage($clientid)
	{
		return $this->self_details($clientid)->default_page_id;
	}

	public function addPopup($data)
	{
		$this->db->insert('popup',$data);
	}

	public function getPopup($where=0)
	{
		if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->get('popup');

	}
	public function getPageSchema($where)
	{	if($where)
		$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->order_by('seq','asc')->get('web_schema');
	}

	public function setPageSchema($where,$data)
	{
		if($this->db->where($where)->get('web_schema')->num_rows())
			$this->db->where($where)->update('web_schema',$data);
		else
			$this->db->insert('web_schema',$data);
	}

	public function addFeatureBox($data)
	{
		$this->db->insert('feature_box',$data);
	}

	public function getFeatureBox($where=0)
	{
		if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->get('feature_box');
	}

	public function useFeatureBox($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('feature_box_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('feature_box_link');
			$schema = array('type'=>'fbox',
							'key_id'=>$data['box_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('feature_box_link',$data);

			$id = 	$this->db->where($data)->limit(1)->get('feature_box_link')->row()->id;
			$schema = array('type'=>'fbox',
							'key_id'=>$data['box_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}

	public function checkFeatureBoxUse($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('feature_box_link')->num_rows();
	}


	public function getGoogleAds($where=0)
	{
		if($where)
			$this->db->where($where);
		return $this->db->where('admin_id',CLIENT_ID)->get('google_ads');
	}

	public function checkAdsUse($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('ads_link')->num_rows();
	}

	public function useAds($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('ads_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('ads_link');
			$schema = array('type'=>'ads',
							'key_id'=>$data['ads_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('ads_link',$data);

			$id = 	$this->db->where($data)->limit(1)->get('ads_link')->row()->id;
			$schema = array('type'=>'ads',
							'key_id'=>$data['ads_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}

	public function getMarquee($where=0)
	{
		if($where)
		 $this->db->where($where);

		return $this->db->where('admin_id',CLIENT_ID)->get('marquee');
	}

	public function checkMarqueeUse($where)
	{
		return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('marquee_link')->num_rows();
	}

	public function useMarquee($data)
	{
		if($this->db->where($data)->where('admin_id',CLIENT_ID)->get('marquee_link')->num_rows())
		{
			$this->db->where($data)->where('admin_id',CLIENT_ID)->delete('marquee_link');
			$schema = array('type'=>'marquee',
							'key_id'=>$data['marquee_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->where($schema)->delete('web_schema');
		}
		else
		{
			$this->db->set('admin_id',CLIENT_ID)->insert('marquee_link',$data);

			$id = 	$this->db->where($data)->limit(1)->get('marquee_link')->row()->id;
			$schema = array('type'=>'marquee',
							'key_id'=>$data['marquee_id'],
							'admin_id'=>CLIENT_ID,
							'page_id'=>$data['page_id']
						);
			$this->db->insert('web_schema',$schema);
		}
	}

}
?>