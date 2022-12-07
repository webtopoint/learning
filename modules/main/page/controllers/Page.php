<?php
class page extends WEB_Controller{
    
    function __construct(){
        parent :: __construct(); 
        
    }
    function print_menu_items($where=[]){
	    if(count($where))
	        $this->db->where($where);
	    $query = $this->db->order_by('sort')

						->get('pages');
			$ref   = [];
			$items = [];

			foreach($query->result() as $k => $data) {

			    $thisRef = &$ref[$data->id];
			    $thisRef['parent'] = $data->parent_id;
			    $thisRef['label'] = ucwords($data->title);
			    $thisRef['link'] = $data->uri;
			    $thisRef['id'] = $data->id;

			   if($data->parent_id == 0)
			        $items[$data->id] = &$thisRef;
			   else 
			        $ref[$data->parent_id]['child'][$data->id] = &$thisRef;
			   
			}
			return $items;
	}
	function ThemeMenu($items,$class = ''){
	    
			    $html = "<ul class=\"".$class."\">";

                foreach($items as $key => $value) {

			    if(array_key_exists('child',$value)){
        	           $html .= '<li class="">
        	                        <a href="#">'.$value['label'].'</a>
        	                    ';
        	           $html .= $this->ThemeMenu($value['child']);
        	        }
        	        else{
        	            $html .= '<li>
        	                        <a class="" href="">'.$value['label'].'</a>
        	                    ';
        	        }
                    $html .=  "</li>";
                }
			    $html .= "</ul>";



			    return $html;
	}
    function menu(){
        $items = $this->print_menu_items(['cat_id'=>1,'status' => 1]);//Modules :: run('admin/pages/print_menu_items',['cat_id'=>1,'status' => 1]);
        

	    $html = "";



	    foreach($items as $key=>$value) {
	        $link = starts_with('http',$value['link']) ? $value['link'] : base_url('page/'.strip_tags($value['link']).config_item('url_suffix'));
	        if(array_key_exists('child',$value)){
	           $html.= '<li class="nav-item hs-has-mega-menu custom-nav-item position-relative">
	                        <a class="nav-link custom-nav-link main-link-toggle" href="javascript:;">'.$value['label'].'</a>
	                    ';
	            $html .= $this->get_menu($value['child'],'hs-sub-menu main-sub-menu animated');
	        }
	        else{
	            $html.= '<li class="nav-item custom-nav-item">
	                        <a class="nav-link custom-nav-link" href="'.$link.'">'.$value['label'].'</a>
	                    ';
	        }
            $html .= "</li>";

	    }



	    return $html;

    }
    
    
    function show($page){
        $this->render('page',['page' => $page]);
    }
    
    function get_menu($items,$class){
        

			    $html = "<ul class=\"".$class."\" id=\"menu-id\">";



			    foreach($items as $key=>$value) {
			        
	        $link = starts_with('http',$value['link']) ? $value['link'] : base_url('page/'.$value['link'].config_item('url_suffix'));

			        if(array_key_exists('child',$value)){
        	           $html.= '<li class="nav-link sub-menu-nav-link sub-link-toggle">
        	                        <a class="nav-link custom-nav-link sub-link-toggle" href="javascript:;">'.$value['label'].'</a>
        	                    ';
        	            $html .= $this->get_menu($value['child'],'hs-sub-menu main-sub-menu animated');
        	        }
        	        else{
        	            $html.= '<li class="nav-item submenu-item">
        	                        <a class="nav-link sub-menu-nav-link" href="'.$link.'">'.$value['label'].'</a>
        	                    ';
        	        }
                    $html .= "</li>";

			    }

			    $html .= "</ul>";



			    return $html;

    }
    
    function get_page_content($where){
        if(count($where))
            $this->db->where($where);
        return $this->db->get('page_content');
    }
    
    function schema($page_id,$type = 'page'){
        $schema = $this->db->order_by('sort','ASC')->get_where('page_schema',['page_id'=>$page_id,'section' => $type]);
        $content = '';
        if($schema->num_rows()){
           foreach($schema->result() as $item){
                switch($item->type){
                    
                    case 'content':
                        $get = $this->get_page_content(['id' => $item->type_id]);
                        if($get->num_rows()){
                            $content .= $this->load->view('content',['content' => $get->row()->content],true);
                        }
                    break;
                    
                    case 'plan':
                        $content .= $this->load->view('plan',[],true);
                    break;
                    
                    // case 'default':
                    //     $return_schema[$item->type] = $item->type_id;
                    // break;
                    
                }
           } 
        }
        
        return $content;
    }
    
}

?>