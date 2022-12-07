<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Main_Controller {

    function __construct()
    {
        parent::__construct();
    }
    function test(){
        $this->load->view('main_site');
    }
    
	
	function save_menu(){
	    $data = json_decode($_POST['data']);
	    $readbleArray = $this->parseJsonArray($data);

		$i=0;

		foreach($readbleArray as $row){

		  $i++;
		    $d = [
		        'sort' => $i,
		        'parent_id' => $row['parentID']
		    ];
		    $this->db->where('id',$row['id'])->update('pages',$d);

		}
		
		echo json_encode(['status' => true]);
	}
	
	function parseJsonArray($jsonArray, $parentID = 0) {



		  $return = array();

		  foreach ($jsonArray as $subArray) {

		    $returnSubSubArray = array();

		    if (isset($subArray->children)) {

		 		$returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id);

		    }



		    $return[] = array('id' => $subArray->id, 'parentID' => $parentID);

		    $return = array_merge($return, $returnSubSubArray);

		  }

		  return $return; 

	}
    function get_menu($items,$class = 'dd-list') {



			    $html = "<ol class=\"".$class."\" id=\"menu-id\">";



			    foreach($items as $key=>$value) {
			        

			        $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >

			                    <div class="dd-handle dd3-handle"></div>

			                    <div class="dd3-content">
			                    
			                        <span id="label_show'.$value['id'].'">'.$value['label'].'</span> 
                                    
                                    
			                       
			                       
			                        <a class="del-button" id="'.$value['id'].'"><i class="fa fa-trash"></i></a></span> 
			                    </div>
			                    
			                    
			                    ';

			        if(array_key_exists('child',$value)) 
			            $html .= $this->get_menu($value['child'],'child');
                    $html .= "</li>";

			    }

			    $html .= "</ol>";



			    return $html;


	}
    function menu_section(){
        $items = ($_POST['group_id'] == 'add') ? [] : Modules :: run('page/print_menu_items',['cat_id'=>$_POST['group_id']]);
        $return['html'] = '<input type="hidden" id="group_id" value="'.$_POST['group_id'].'">
                    				        <div class="cf nestable-lists"><div class="dd" id="nestable" style="width:100%">'.$this->get_menu($items).'</div></div>
                    			    
                    			            <input type="hidden" id="nestable-output">';
        echo json_encode($return);
    }
    function menu(){
        $this->render([],'pages/menu');
    }
    
    function static_pages(){
        $this->crud ->set_table('static_pages')
                    ->unset_read()
	                ->unset_clone() 
	                ->add_action('Header Content','','','file',array($this,'static_header_page_btn'))
                    ->add_action('Content','', '','file',[$this,'btn_static_content_page'])
	                ->unset_add()
	                ->unset_edit()
	                ->unset_delete();
        $data = $this->crud->render();
        $this->render($data);
    }
    function btn_static_content_page($id,$row){
        return site_url('admin/pages/schema/'.$id.'/static');
    }
    function header_content($id,$type ='page'){
        if($post = $this->input->post()){
            $where = ['type' => $type,'page_id' => $id,'section' => 'header'];
            if($this->db->get_where('page_content',$where)->num_rows()){
                $post['content'] = $_POST['content'];
                $this->db->update('page_content',$post,$where);
            }
            else{
                $data = $where;
                $data['content'] = $_POST['content'];
                $this->db->insert('page_content',$data);
            }
            $this->session->set_flashdata('msg','<div class="alert alert-success">Data Update Successfully..');
            redirect(current_url());
        }
        else
            $this->render(['id' => $id,'type' => $type],'pages/header_content');
    }
    function static_header_page_btn($primary_key , $row){
        return site_url('admin/pages/header_content/'.$primary_key.'/static');
    }
    function page_header($id){
        
    }
    function content($content_id){
        if($post = $this->input->post()){
            $post['content'] = $_POST['content'];
            $this->db->where('id',$content_id)->update('page_content',$post);
            $this->session->set_flashdata('msg','<div class="alert alert-success">Content Update Successfull..</div>');
            redirect(current_url());
        }
        else{
            $this->render(['content_id' => $content_id],'pages/content');
        }
    }
    function all_pages(){
        $pages = ['0' => 'SELF'];
        $_pages = $this->db->get('pages');
        foreach($_pages->result() as $page){
            $pages[$page->id] = ucwords($page->title);
        }
        return $pages;
    }
	public function index()
	{
	    $cats = $this->db->get('page_category');
	    
	    $_cats = [];
	    foreach($cats->result() as $_c){
	        $_cats[$_c->id] = $_c->name;
	    }
	    $this->crud ->set_table('pages')
	                ->required_fields('title','cat_id')
	                ->fields('title','cat_id','status','uri','parent_id')
	                ->display_as('uri','Url')
	                ->field_type('uri','textarea')
	                ->display_as('cat_id','Category')
	                ->display_as('parent_id','Parent Page')
	                ->unset_read()
	                ->unset_clone() 
	                
	                    ->add_action('Content','', 'admin/pages/schema','file')
	                ->columns('title','uri','category','status','parent_id')
	                ->field_type('status','dropdown',$this->select_status)
	                ->field_type('parent_id','dropdown',$this->all_pages())
	                
                    ->callback_after_insert(array($this, 'page_after_insert'))
                    
                    ->callback_before_delete(array($this,'page_before_delete'));
         if($this->crud->getState() == 'add')    {       
                    $this->crud->set_rules('title','Page Name','required|is_unique[pages.title]',array(
	                        'is_unique' => 'This %s is already exists..'
	                    ));
	}
         $this->crud->field_type('cat_id','dropdown',$_cats);
        $data = $this->crud->render();
        $this->render($data);
	}
	
	function page_after_insert($post,$page_id){
	    $this->db->insert('page_content',['page_id' => $page_id]);
	    $content_id = $this->db->insert_id();
	    $this->db->insert('page_schema',['type' => 'content','page_id' => $page_id,'type_id' => $content_id]);
	    return true;
	}
	
	function page_before_delete($primary_key){
	    $this->db->where('id',$primary_key);
        $page = $this->db->get('pages')->row();
     
        if(empty($page))
            return false;
        $d = ['page_id' => $primary_key];
        $this->db->delete('page_content',$d);
        $this->db->delete('page_schema',$d);
        return true;
	}
	
    function category(){
        $this->crud->set_table('page_category')
                    ->required_fields('name','status')
                    ->fields('name','status')
                    ->field_type('status' , 'dropdown', $this->select_status)
                    ->unset_operations();
        $data = $this->crud->render();
        $this->render($data);
    }
    function schema($id,$type = 'page'){
        $this->render(['id' => $id, 'type' => $type ],'pages/schema');// $id;
    }
    public function edit($id = FALSE)
	{
        if($this->session->userdata('logged_in') == '1'){
            $data_header = array(
                'title' => 'Страница ',
                'user_img' => $this->session->userdata('user_img'),
                'name' => $this->session->userdata('name'),
                'user_id' => $this->session->userdata('user_id'),
                'them_skin' => $this->session->userdata('them_skin'),
                'lang' => $this->session->userdata('lang')
            );
            
            if ($id === FALSE)
            {
                redirect(base_url().'admin/users');
            }
        
            $data = $this->pages_model->get_page($id);
            
            $this->parser->parse('header.tpl', $data_header);
            $this->parser->parse('pages/edit_pages.tpl', $data);
            $this->parser->parse('footer.tpl', $data);
            
        }else{  
            $data = array(
                'error' => ''
            );
            $this->parser->parse('login.tpl', $data); 
            
        }      
	}
    
    public function add()
	{
	   
        if($this->session->userdata('logged_in') == '1'){
            $data_header = array(
                'title' => 'Добавить страницу',
                'user_img' => $this->session->userdata('user_img'),
                'name' => $this->session->userdata('name'),
                'user_id' => $this->session->userdata('user_id'),
                'them_skin' => $this->session->userdata('them_skin'),
                'lang' => $this->session->userdata('lang')
            );  
            
            if(isset($_POST['add'])){
                
                $this->form_validation->set_rules($this->main_lib->add_rules);
                $check = $this->form_validation->run();
                
                
                if ($check == FALSE)
                {
                    $this->parser->parse('header.tpl', $data_header);
                    $this->parser->parse('pages/add_page.tpl', $data);
                    $this->parser->parse('footer.tpl', $data);
                }
                else
                {
                    $pages_in_base = $this->db->count_all('pages');
                    $add['title'] = $this->input->post('title');
                    $add['text'] = $this->input->post('text');
                    $add['description'] = $this->input->post('description');
                    $add['keywords'] = $this->input->post('keywords');
                    $add['tags'] = $this->input->post('tags');
                    $add['uri'] = $this->input->post('uri');
                    $add['sort'] = $pages_in_base+1;
                    $this->db->insert('pages',$add);
                    redirect(base_url().'admin/pages');
                }
                
            }else{
          
        		$this->parser->parse('header.tpl', $data_header);
                $this->parser->parse('pages/add_page.tpl', $data_header);
                $this->parser->parse('footer.tpl', $data_header);
            }
        }else{
            $data = array(
                'error' => ''
            );
            redirect(base_url().'admin/');
        }
        
	}
    
    //update
    public function update()
	{
	   
        if($this->session->userdata('logged_in') == '1'){
            $data_header = array(
                'title' => 'Изменить страницу',
                'user_img' => $this->session->userdata('user_img'),
                'name' => $this->session->userdata('name'),
                'user_id' => $this->session->userdata('user_id')
            );  
            
            if(isset($_POST['update'])){
                
                $this->form_validation->set_rules($this->main_lib->add_rules);
                $check = $this->form_validation->run();
                
                
                if ($check == FALSE)
                {
                    $pages_id = $this->input->post('id');
                    $data = $this->pages_model->get_page($pages_id);
                    $this->parser->parse('header.tpl', $data_header);
                    $this->parser->parse('pages/edit_pages.tpl', $data);
                    $this->parser->parse('footer.tpl', $data);
                }
                else
                {
                    $pages_id = $this->input->post('id');
                    $update['title'] = $this->input->post('title');
                    $update['text'] = $this->input->post('text');
                    $update['description'] = $this->input->post('description');
                    $update['keywords'] = $this->input->post('keywords');
                    $update['tags'] = $this->input->post('tags');
                    $update['uri'] = $this->input->post('uri');
                    
                    $this->db->where('id',$pages_id);  
                    $this->db->update('pages',$update);
                    redirect(base_url().'admin/pages');
                }
                
            }else{
          
        		$this->parser->parse('header.tpl', $data_header);
                $this->parser->parse('pages/edit_pages.tpl', $data);
                $this->parser->parse('footer.tpl', $data);
            }
        }else{
            $data = array(
                'error' => ''
            );
            redirect(base_url().'admin/');
        }
        
	}
    
    
    
    
    public function remove($id = FALSE)
	{
        if($this->session->userdata('logged_in') == '1'){
            $data_header = array(
                'title' => 'Страница ',
                'user_img' => $this->session->userdata('user_img'),
                'name' => $this->session->userdata('name'),
                'user_id' => $this->session->userdata('user_id')
            );
            
            if ($id === FALSE)
            {
                redirect(base_url().'admin/pages');
            }
        
            $this->db->where('id', $id);
            $this->db->delete('pages');
            
            $data['pages'] = $this->pages_model->get_table('pages');
            $this->parser->parse('header.tpl', $data_header);
            $this->parser->parse('pages/data_pages.tpl', $data);
            $this->parser->parse('footer.tpl', $data);
            
        }else{  
            $data = array(
                'error' => ''
            );
            $this->parser->parse('login.tpl', $data); 
            
        }      
	}
	
    
}
