<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Utopia\Domains\Domain;
class Admin extends Main_Controller {

    function __construct()
    {
        parent::__construct();
       $this->load->library('form_validation'); 
        
    }
    function get_links($type = ''){
        $this->db->where('type' ,$type)->where('status',1);
        return $this->db->get('links');
    }
    function view($page = '',$data = []){
        $this->render_page($page ,$data);
    }
    function check_theme(){
        echo $this->data['theme_skin']; 
    }
    
    function create_website(){
         $this->render(['output' => Modules::run('website/create') ]);
    }
    
    function list_website(){
        $this->render(['output' => Modules :: run('website/list')]);
    }
    
    function change_mode(){ 
        $theme = 'dark';
        if($this->data['theme_skin'] == 'dark')
            $theme  = '';
        $data = ['theme_skin' => $theme];
        $this->db->update('users',$data,['id' => $this->session->user_id]);
        $this->session->set_userdata($data);
        redirect($_SERVER["HTTP_REFERER"]);   
    }
	public function index() 
	{
        $login = $this->input->post('login');
        $password = md5($this->input->post('password'));
        
        
        
        if(isset($login)){
            $data = $this->data = $this->main_lib->get_users($login, 'users');
           if(!$data)
            unset($login);
            else
            $passmd5 = md5($data['password']);
        }

        if($this->session->userdata('logged_in') == '1'){
            
            $this->render([],'home');
            
        }elseif(!isset($login)){    
            //$data['text_login'] = $this->language->get('text_login');
            $data = array(
                'continue' => $this->language->get('text_continue'),
                'error' => '',
                'text_name_lang' => $this->language->get('text_name_lang'),
                'text_lang' => $this->language->get('text_lang'),
                'text_login' => $this->language->get('text_login'),
                'text_remember_me' => $this->language->get('text_remember_me'),
                'text_sign_in' => $this->language->get('text_sign_in'),
                'text_forgot' => $this->language->get('text_forgot'),
            );
   // echo 'ff';
             echo $this->parser->parse('login.tpl', $data); 
            
        }elseif($data['username'] != $login or $data['password'] != $password){
             
            $data = array(
                'continue' => $this->language->get('text_continue'),
                'error' => '<div class="alert alert-danger alert-dismissible"><h4>'.$this->language->get('text_error').'</h4></div>',
                'text_name_lang' => $this->language->get('text_name_lang'),
                'text_lang' => $this->language->get('text_lang'),
                'text_login' => $this->language->get('text_login'), 
                'text_remember_me' => $this->language->get('text_remember_me'),
                'text_sign_in' => $this->language->get('text_sign_in'),
                'text_forgot' => $this->language->get('text_forgot'),
            );
           
            $this->parser->parse('login.tpl', $data);  
        
        }elseif($data['username'] == $login and $data['password'] == $password) {
            $data = $this->main_lib->get_users($login, 'users');
            $session_id = $this->session->userdata('session_id');
            $newdata = array(
                'name' => $data['name'],
                'username' => $data['username'],
                'user_img' => $data['img'],
                'user_id' => $data['id'],
                'type' => $data['id'] == 1 ? 'Super Admin' : 'Admin',
                'them_skin' => @$data['theme_skin'],
                'lang' => $this->default_language,
                'role' => $data['role'],
                'logged_in' => TRUE,
                'KCFINDER' => Array('disabled' => TRUE)
            );
            
            $this->session->set_userdata($newdata);
            redirect(current_url());
         }        
	}
    function theme_menu($id = 0){
        if($id ){
            $this->load_crud('tool');
            $this->load->model('tool/ThemeModel','TM');
            $parents = [0 => 'SELF'];
            $get = $this->TM->get_theme_menu(['theme_id' => $id,'parent_id' => '0']);
            if($get->num_rows()){
                foreach($get->result() as $row){
                    $parents[$row->id] = $row->title;
                }
            }
            $crud  = $this->crud_table('theme_menu')->set_subject('Theme Menu');
            $crud->columns('theme_id','title','method','parent_id','status')
                ->where('theme_id',$id)
                ->field_type('theme_id','hidden',$id)
                ->display_as('parent_id','Parent')
                ->fields('title','method','parent_id','status','theme_id')
                ->required_fields('title','method','parent_id','status','theme_id')
                ->set_relation('theme_id','web_themes','theme_name')
                ->callback_column('parent_id',[$this,'print_parent'])
                ->display_as('theme_id','Theme')
                ->field_type('parent_id','dropdown',$parents) 
                ->field_type('status','dropdown',$this->select_status);
            $data = $crud->render();
            $this->render($data);
        }
        else    
            show_404();
    }
    function print_parent($value, $row){
        $this->load->model('tool/ThemeModel','TM');
        $get = $this->TM->get_theme_menu(['id' => $row->parent_id]);
        if($get->num_rows()){
            return $get->row()->title;
        }
        // return $value == 0 ? 'self' : $row->parent_id;
        return '<b><i>SELF</i></b>';
    }
	function theme(){
	    $this->load_crud('tool');
	    $crud  = $this->crud_table('web_themes')->set_subject('Theme','Themes');
	    $crud->columns('theme_name','path','status')
	         ->field_type('status','dropdown',$this->select_status)
	         ->add_action('Template', '', 'admin/theme_template', 'book')
	         ->add_action('Menu', '', 'admin/theme_menu', 'bars');
        $data = $crud->render();
        $this->render($data);
	}
	
	function theme_template($id){
	    $this->load_crud('tool');
	   
	    $crud  = $this->crud_table()->set_subject('Theme\'s Template ')->display_as('theme_id','Theme');
	    $crud->where('theme_id',$id)->required_fields('title','content','description','theme_id')->columns('title','content','description')
	         ->field_type('status','dropdown',$this->select_status)
	         ->field_type('theme_id','hidden',$id)->unset_texteditor('content')
	         ->callback_before_insert($this,'insert_template');
        $data = $crud->render();
        $this->render($data);
	}
	
	function insert_template($post = []){
	    $post['content'] = trim(htmlspecialchars($post['content'],ENT_QUOTES));
	    return $post;
	}
	
	function test(){
        // $domain = new Domain('shahuagri.business.in');
        $domain = new Domain('test.bIzknowindia.org.in');

        echo 'Get = ' .$domain->get(); // demo.example.co.uk
        echo '<br>TLD = '.$domain->getTLD(); // uk 
        echo '<br>SUffix = '.$domain->getSuffix(); // co.uk
        echo '<br> Registerable = '.$domain->getRegisterable(); // example.co.uk
        echo '<br>get Name = '.$domain->getName(); // example
        echo '<br>Sub = '.$domain->getSub(); // demo
        echo '<br>isKnown = '.$domain->isKnown(); // true
        echo '<br> isICANN = '.$domain->isICANN(); // true
        echo '<br>IsPrivate'.$domain->isPrivate(); // false
        echo '<br>IsTest = '.$domain->isTest(); // false
	}
	function role(){
	    $this->crud->set_table('role');
	    $this->crud->required_fields('name'); 
	    $this->crud->unset_clone()->unset_read()->columns(['name','description']);
	    $this->crud->callback_before_delete([$this,'first_role_record_not_delete']);
	    $this->crud->set_lang_string('delete_error_message', 'This data cannot be deleted, because there is a Master Role.');
        
        $this->crud->callback_edit_field('permission',array($this,'set_permission'))->callback_before_insert([$this,'check_post_permission']);
        $this->crud->callback_add_field('permission',array($this,'set_permission'))->callback_before_update([$this,'check_post_permission']);
	    $this->crud->unset_texteditor('permission','description');
        $data = $this->crud->render();
        $this->render($data);
	}
	function check_post_permission($post_array){
	    $per = NULL;
	    if(isset($post_array['permission'])){
    	    if(is_array($post_array['permission']))
    	        $per = json_encode($post_array['permission']);
    	 }
    	
	    $post_array['permission'] = $per;
	    return $post_array;
	}
	function set_permission($array = [],$key = ''){
	   
        $get = $this->db->get_where('permission',['parent_status' => 'parent']);
	    $ids = [];
	    if($key == 1)
	        return form_hidden('permission','').'<label>All Permission Allowed, You can not be changed</label>';
	        
	    if(!empty($key)){
	        $per = $this->db->get_where('role',['role_id' => $key])->row()->permission;
	        //echo $per;
	        $ids = empty($per) ? [] : (array) json_decode($per,true);
	       // exit;
	    }
	    //pre($ids,true);
	 
	    $html = '<div class="row">';
	    foreach($get->result() as $per){
	        $id = $per->permission_id;
	        $checked = in_array($id,$ids) ? 'checked' : '';
	      //  echo "$id = $checked";
	        $html .= '  
	                    <div class="col-md-12">
    	                    <label style="margin-bottom:3px" class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="d-'.$id.'">
    							<input class="form-check-input w-30px h-20px parent-input" type="checkbox" value="'.$id.'" '.$checked.' name="permission[]" id="d-'.$id.'">
    							<span class="pulse-ring ms-n1"></span>
    							<span class="form-check-label text-gray-600 fs-7">'.main_data($per->name).'</span>
    						</label>
    					</div>
    					<div class="col-md-12 row" style="    padding-left: 43px; ">';
    					    $Sub_get = $this->db->get_where('permission',['parent_status' => $id]);
    					    if($Sub_get->num_rows()){
    					        foreach($Sub_get->result() as $sget){
    					            $sub_id = $sget->permission_id;
	                                $checked = isset($ids[$id]) ? 
	                                                    ( in_array($sub_id,$ids[$id]) ? 'checked' : '') : '';
	                               $disabled = in_array($id,$ids) ? '' : 'disabled';
    					            $html .= '
    					                <div class="col-md-4">
    					                    <label style="margin-bottom:3px" class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="d-'.$sub_id.'">
                    							<input class="form-check-input w-30px h-20px input-check-'.$id.'" '.$disabled.' type="checkbox" value="'.$sub_id.'" '.$checked.' name="permission['.$id.'][]" id="d-'.$sub_id.'">
                    							<span class="pulse-ring ms-n1"></span>
                    							<span class="form-check-label text-gray-600 fs-7">'.main_data($sget->name).'</span>
                    						</label>
    					                
    					                </div>
    					            
    					            ';
    					        }
    					    }
    					    
    		   $html .='</div>';
	    }
	    
	    return $html.'</div>';
	}
    function admins(){
        $this->crud->set_table('users');
        $this->crud->where('id!=',1)
                    ->field_type('theme_skin','dropdown',['dark' => 'Dark',' ' => 'Light']);
        $role_option = [];
        foreach($this->db->get('role')->result() as $role){
            $role_option[$role->role_id] = $role->name; 
        }
        $this->crud->field_type('role','dropdown',$role_option)
                   ->set_field_upload('img','upload/admin/profile');
        $this->crud->callback_before_insert(array($this, 'update_md5_password'));
        $this->crud->callback_before_update(array($this, 'update_md5_password'))
                    ->required_fields(['img','surname','name','username','password','email','theme_skin','role'])
                    ->display_as('theme_skin','Theme')
                    ->unset_read()
                    ->unset_clone()
                    ->unset_columns('password')
                    ->unset_edit_fields('password','username','email')
                    ->set_rules('username','Username','is_unique[users.username]',array('is_unique' => 'This %s Already Exists..'))
                    ->set_rules('email','Email','is_unique[users.email]',array('is_unique' => 'This %s Already Exists..'));
        $this->render($this->crud->render());
    }
    function update_md5_password($post_array){
        $post_array['password'] = md5($post_array['password']);
        return $post_array;
    }
    function logoff()
    {
        $data = array(
            'title' => 'Logout',
            'error' => ''
        );
        $this->session->sess_destroy();  
        redirect(base_url().'admin');
    }
    
    
    //forgot
    public function forgot()
	{
	       $data = array(
                'title' => 'Forget Password'
            );
        $this->parser->parse('forgot.tpl', $data);    
    }
      
    public function set_language($lang)
	{
        $newdata = array('lang' => $lang);
        $this->session->set_userdata($newdata); 
        redirect($_SERVER["HTTP_REFERER"]);   
    }  
    
   
       
    public function helpicon()
	{  
        if($this->session->userdata('logged_in') == '1'){
            $data = array(
                'title' => 'Help Icon',
                'user_img' => $this->session->userdata('user_img'),
                'name' => $this->session->userdata('name'),
                'user_id' => $this->session->userdata('user_id'),
                'them_skin' => $this->session->userdata('them_skin'),
                'lang' => $this->session->userdata('lang'),
                'compani' => 'RAMStudio',
                'url' => 'http://moroz.rv.ua',
                'heading' => 'Admin - Welcome to CodeIgniter HMVC!'
            );
            $this->parser->parse('header.tpl', $data);
            $this->parser->parse('icons.tpl', $data);
            $this->parser->parse('footer.tpl', $data);         
        }else{
            $data = array(
                'error' => ''
            );
            redirect(base_url().'admin/');    
        }
		
	}
	
    
}
