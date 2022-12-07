<?php
class NewsModel extends Ci_Model
{
	public $table = 'news_category';
	public $post = 'post';
	public $slug  = '';
	public $setting = 'news_setting';
	public $special_category = 'special_category';
	public $ticker = 'news_ticker';
	
	public $cat_id,$news_id,$ticker_id = 0;
	
	function __construct()
	{
		parent :: __construct();
	}
	
	function init_news($id = 0){    $this->news_id   =   $id; return $this;   }
	
	function init_news1($id = 0){    $this->news_id   =   $id; return $this;   }
	
	
	function insert($data){
		 $this->db->insert($this->post,$data);
		 return $this->db->insert_id();
	}
    function ticker_enable($id){
        $get  = $this->getTicker($id);
        if($get->num_rows()){
            $row = $get->row();
            $status = $row->status ? 0 : 1;
            return $this->db->where('id',$row->id)->update($this->ticker,['status'=>$status]);
        }
        return;
    }
    function frontTicker(){
        return $this->db->where_in('position',['top','bottom'])->where('admin_id',CLIENT_ID)->get($this->ticker);
        return $this->db->last_query();
    }
	function useSpecialCategory($r){
	    $get = $this->db->where($r)->get('web_schema');
	    if($get->num_rows())
	        return $this->db->where('id',$get->row()->id)->delete('web_schema');
	    return $this->db->insert('web_schema',$r);
	}
	function special_category($where = []){
	   if(count($where))
	       $this->db->where($where);
	   $this->db->where('admin_id',CLIENT_ID);
	   return $this->db->get(__FUNCTION__);
	}
	function insert_special_category($data){
	    return $this->db->insert($this->special_category,$data);
	}
	function NewsCount($cat_id = 0){
	    
	}
	function pagination_Config(){
	    if(THEME_ID == 17){
	        return [
	        
    	            'full_tag_open'             =>          '<div class="pagination"><ul><li>',
    	            'full_tag_close'            =>          '</li></ul></div>',            
    	            'prev_link'                 =>          '&laquo;',
    	            'next_link'                 =>          '&raquo;',
    	            'cur_tag_open'              =>          '<strong>',
    	            'cur_tag_close'             =>          '</strong>',
    	            'use_page_numbers'          =>          true,
    	   ];
	    }
	    
	    return [
	        
	            'full_tag_open'             =>          '<ul class="pagination  pagination-sm">',
	            'full_tag_close'            =>          '</ul>',            
	            'prev_link'                 =>          '&laquo;',
	            'prev_tag_open'             =>          '<li>',
	            'prev_tag_close'            =>          '</li>',
	            'next_link'                 =>          '&raquo;',
	            'next_tag_open'             =>          '<li>',
	            'next_tag_close'            =>          '</li>',
	            'first_tag_open'            =>          '<li>',
	            'first_tag_close'           =>          '</li>',
	            'last_tag_open'             =>          '<li>',
	            'last_tag_close'            =>          '</li>',
	            'cur_tag_open'              =>          '<li class="active"><a href="#">',
	            'cur_tag_close'             =>          '</a></li>',
	            'num_tag_open'              =>          '<li>',
	            'num_tag_close'             =>          '</li>',
	            'use_page_numbers'          =>          true,
	            
	        
	   ];
	}
	function getPrevNews($id){
	    $this->db->where('id <',$id);
	    $this->db->where('admin_id',CLIENT_ID);
	    $this->db->order_by('id','DESC');
	    $this->db->limit(1);
	    $get = $this->db->get($this->post);
	    if($get->num_rows()){
	        $row = $get->row();
	        $cat = $this->productCategory($row->id);
	        return $this->postLink($row->id,$cat,$row->title);
	    }
	    return 0;
	}
	function productCategory($post_id = 0,$flag = false){
	    if($post_id){
	       
	       if(!$flag)
	            $this->db->limit(1);
	            
	       $this->db->order_by('id','DESC');
	       $get = $this->db->get_where('cats_in_post',['post_id'=>$post_id]);
	       if($get->num_rows()){
	           if($flag)
	                return $get->result();
	           return $get->row()->cat_id;
	       }
	    }
	    return 0;
	}
	function getNextNews($id){
	    $this->db->where('id >',$id);
	    $this->db->where('admin_id',CLIENT_ID);
	    $this->db->order_by('id','DESC');
	    $this->db->limit(1);
	    $get = $this->db->get($this->post);
	    if($get->num_rows()){
	        $row = $get->row();
	        $cat = $this->productCategory($row->id);
	        return $this->postLink($row->id,$cat,$row->title);
	    }
	    return 0;
	}
	function getByLimit( $l = 0,$per =0 ){
		$this->db->limit($per,$L);
		return $this->db->get_where($this->post,['admin_id'=>CLIENT_ID]);
	}
	
	function getNewsSetting($type = 0){
	    if($type)
	        $this->db->where('type',$type);
	   return $this->db->where('admin_id',CLIENT_ID)->get($this->setting);
	}
	function updateNewsSetting($type , $data){
	    $get = $this->db->where('admin_id',CLIENT_ID)->where('type',$type)->get($this->setting);
	    if(!$get->num_rows())
	        $this->db->insert($this->setting,['type'=>$type,'admin_id'=>CLIENT_ID]);
	   return $this->setNewsSetting($type,$data);
	}
	function setNewsSetting($type,$data){
	   return $this->db->where('admin_id',CLIENT_ID)->where('type',$type)->update($this->setting,$data);
	}
	function listCatsPost($id,$record = 0, $perPage = 0){
		$limit = '';
		if( $perPage)
			$limit = "LIMIT ".$record.",".$perPage;
		return  $this->db->query("SELECT P.id,P.title,P.banner_type,P.banner_value,P.create_time,P.content FROM ".PREFIX."_cats_in_post as CP,".PREFIX."_post as P WHERE CP.cat_id = '".$id."' AND CP.post_id = P.id order by P.update_time DESC ".$limit);
	
	}
	function share()
	{
		return '
			            	<!-- AddToAny BEGIN -->
							<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
							<a class="a2a_button_facebook"></a>
							<a class="a2a_button_twitter"></a>
							<a class="a2a_button_email"></a>
							<a class="a2a_button_whatsapp"></a>
							<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
							</div>
							<script async src="https://static.addtoany.com/menu/page.js"></script>
							<!-- AddToAny END -->
			    ';
	}
	function PostThumb($id,$flag = false){
		$get = $this->db->get_where($this->post,['id'=>$id]);
		if($get->num_rows()){
			$row = $get->row();
			$img = '';
			if($row->banner_type == 'image')
				return base_url.'/public/temp/'.CLIENT_ID.'/'.$row->banner_value;
			if($row->banner_type == 'youtube' AND !$flag)
				return 'https://img.youtube.com/vi/'.$this->get_youtube_id_from_url($row->banner_value).'/hqdefault.jpg';
			if($row->banner_type == 'youtube' AND $flag)
				return 'https://youtube.com/embed/'.$this->get_youtube_id_from_url($row->banner_value);
		}
		else
			return 'gray';
	}

	function postLink($id,$cat_id = 0,$slug = ''){
		$cat_id = '/'.AJ_ENCODE($cat_id);
		return base_url.'/post/'.AJ_ENCODE($id).'/'.$this->senitize_Slug($slug).$cat_id;
	}
	function get_youtube_id_from_url($url)
	{
	    if (stristr($url,'youtu.be/'))
	        {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
	    else 
	        {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
	}
	function getAjaxRecord($rowno,$rowperpage) {			
		$this->db->select('*');
		$this->db->from($this->post);
		$this->db->where('admin_id',CLIENT_ID);
        $this->db->limit($rowperpage, $rowno);  
		$query = $this->db->get();       	
		return $query->result_array();
	}
	function linkCatToPost($id,$cat_id){
		$this->db->insert('cats_in_post',['post_id'=>$id,'cat_id'=>$cat_id]);
	}
	function getCategorylink($id='')
	{
		$t = $this->db->where('id',$id)->get($this->table);
		if($t->num_rows())
			return trim($t->row()->slug);
		return '#';
	}
    function getNewsViaMultiCategory($cats = array(),$limit = 0,$random = false){
        $this->db->select('*');
        $this->db->from('cats_in_post');
        $this->db->join('post','post.id = cats_in_post.post_id');
        $this->db->where_in('cats_in_post.cat_id', $cats);
        $this->db->group_by('post.id');
        if($random)
            $this->db->order_by('post.id','RANDOM');
        if($limit)
            $this->db->limit($limit);
        return $this->db->get();
    }
	function get_category($where = []){

		if(count($where))
			$this->db->where($where);
		$this->db->order_by('name','ASC');
		$this->db->where('admin_id',CLIENT_ID);
		return $this->db->get($this->table);

	}
	function get($where = []){
		if(count($where))
				$this->db->where($where);
		return $this->db->get_where($this->post,['admin_id'=>CLIENT_ID]);
	}
	
	function senitize_Slug($slug = ''){
		$string = strtolower(str_replace(' ', '-', trim($slug) ));
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}

	function insertCategory( $data = [] ){
		$data['slug'] = $this->genrateSlug($this->slug);
		$data['admin_id'] = CLIENT_ID;
		return $this->db->insert($this->table,$data);
	}
    
    function updateCategory($data = [], $id = 0){
        return $this->db->where('id',$id)->update($this->table,$data);
    }
    
	function genrateSlug($slug = ''){
		$slug = $this->senitize_Slug($slug);
		$t = $this->db->get_where($this->table,['slug' => $slug]);
		static $x = 1;
		if($t->num_rows()){
			return $this->genrateSlug($this->slug.'-'.$x++);
		}
		else
			return $slug;
	}
	function getTicker($id = 0){
	    if($id)
	        $this->db->where('id',$id);
	   return $this->db->get_where($this->ticker,['admin_id'=>CLIENT_ID]);
	}
	function createTicker($data){
	    return $this->db->insert($this->ticker,$data);
	}
    function countTotalNews(){
        return $this->get()->num_rows();
    }
	function countCategoryPost($cat_id = 0){
		return $this->db->select('id')->get_where('cats_in_post',['cat_id'=>$cat_id])->num_rows();
	}

}
?>