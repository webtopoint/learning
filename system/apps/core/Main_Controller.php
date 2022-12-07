<?php
class Main_Controller extends MY_Controller{
    public $data = array(),$default_language = 'english',$crud = 0,$roles = [],$permission_denied = false,$select_status = ['0' => 'In-Active','1' => 'Active'];
    protected static $instance ;
    function __construct(){
        parent :: __construct();
        self :: $instance = &$this;
        $this->load->database();
        
        $this->load->model('pages_model');
        $this->load->library('common/main_lib');

       $this->load->model('Users_model');
       
       
        if(!isset($_SESSION["lang"])){
            $result = $this->db->select('*')->where('default', '1')->get('language')->row_array();
            $this->default_language = $result['language'];
        }else{ 
            $this->default_language = $_SESSION["lang"]; 
        }
        $this->load->config('grocery_crud');
        $this->config->set_item('grocery_crud_default_language',$this->default_language);
        $this->load_crud();
        $directory = 'modules/admin/language/'.$this->default_language; 
       
        $this->load->library('common/language',$directory);
        $this->language->load('common/login');
        $this->lang->load($this->default_language,$this->default_language);
    
        $class = $this->router->fetch_class();
        $method = $this->router->fetch_method();
        if( ( $class == 'admin' AND !in_array( $method,['set_language','index'] )) ||  !$this->session->has_userdata('logged_in') ){
            
            //redirect('admin/');
            if(!$this->session->has_userdata('logged_in')){
                 echo Modules :: run('admin/index'); //Admin::index();
                exit;
            }
        }
        $this->config->set_item('theme_skin',$this->session->has_userdata('theme_skin')
                                        ? $this->session->theme_skin : 'dark');
        $this->data = array(
                'title' => 'Admin Panel',
                'text_home_site' => lang('text_home_site'),
                'text_profile' => lang('text_profile'),
                'text_exit' => lang('text_exit'),
                'text_pages' => lang('text_pages'),
                'text_pages_view' => lang('text_pages_view'),
                'text_pages_add' => lang('text_pages_add'),
                'text_add' => lang('text_add'),
                'text_files' => lang('text_files'),
                'text_plugins' => lang('text_plugins'),
                'text_add_plugins' => lang('text_add_plugins'),
                'text_settings' => lang('text_settings'),
                'text_edit' => lang('text_edit'),
                'text_delete' => lang('text_delete'),
                'text_users' => lang('text_users'),
                'text_profile' => lang('text_profile'),
                'text_themes' => lang('text_themes'),
                'text_system' => lang('text_system'),
                'text_icon' => lang('text_icon'),
                'text_all_users_1' => lang('text_all_users_1'),
                'text_pagess' => lang('text_pagess'),
                'text_records' => lang('text_records'),
                'text_pages_load' => lang('text_pages_load'),
                'text_load_time' => lang('text_load_time'),
                'text_chenge' => lang('text_chenge'),
                'text_page_title' => lang('text_page_title'),
                'text_page_content' => lang('text_page_content'),
                'text_page_tegs' => lang('text_page_tegs'),
                'text_page_record' => lang('text_page_record'),
                'text_user_profile' => lang('text_user_profile'),
                'text_img' => lang('text_img'),
                'text_Login' => lang('text_Login'),
                'text_Email' => lang('text_Email'),
                'text_Surname' => lang('text_Surname'),
                'text_Name' => lang('text_Name'),
                'text_About' => lang('text_About'),
                'text_Role' => lang('text_Role'),
                'text_Skin_admins' => lang('text_Skin_admins'),
                'text_Password' => lang('text_Password'),
                
                'text_Blue' => lang('text_Blue'),
                'text_Red' => lang('text_Red'),
                'text_Yellow' => lang('text_Yellow'),
                'text_Green' => lang('text_Green'),
                'text_Purple' => lang('text_Purple'),
                'text_Russian' => lang('text_Russian'),
                'text_English' => lang('text_English'),
                'text_Ukrainian' => lang('text_Ukrainian'),
                'text_Demo' => lang('text_Demo'),
                'text_Administrator' => lang('text_Administrator'),
                'text_Update' => lang('text_Update'),
                'text_Characters' => lang('text_Characters'),
                'text_Add_User' => lang('text_Add_User'),
                'text_Login_Surename_Name' => lang('text_Login_Surename_Name'),
                
                'user_img' => base_url("upload/admin/profile/".$this->session->userdata('user_img')),
                'name' => $this->session->userdata('name'),
                'user_id' => $this->session->userdata('user_id'),
                'them_skin' => $this->session->userdata('them_skin'),
                'lang' => $this->session->userdata('lang'),
                'all_users' => $this->pages_model->count_all_user('users'),
                'all_pages' => $this->pages_model->count_all_user('pages')    ,
                'type' => $this->session->userdata('type'),
                'username' => $this->session->userdata('username'),
                'css_admin_files'  => array(),
                'js_admin_files' => array(
                                        'static/back/js/custom.js'
                ),
                'theme_skin' => config_item('theme_skin'),
            );
            $this->data = array_merge($this->data,$this->lang->language);
            
            
            $AllLang = $this->db->get('language_items');
            
            if($AllLang->num_rows()){
               $LoadLang = [];
                foreach($AllLang->result() as $Lang)
                    $LoadLang[$Lang->text] = $Lang->{$this->default_language};
                
                $this->data = array_merge($this->data,$LoadLang);
            }
            
            
            if($this->roles = $this->Users_model->get_user_role_menu() AND $this->session->userdata('role') != 1){
                
               $get = $this->db->where('controller',$class)->where('method',$method)->get('permission');
               if($get->num_rows()){
                  $rows = $get->row();
                  if(!in_array($rows->permission_id,$this->roles)){
                      $this->data['title'] = 'Permission Denied';
                      $this->permission_denied = true;
                  }
               }
               else
                    $this->permission_denied = true;
                
            }
            
        
            
    }
    
    function crud_table($table = '', $admin_with_addon = false, $dbprf = true){
        $table = empty($table) ? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2)[1]['function'] : $table;
        $table = $dbprf ? TOOL_DB_DBPREFIX.$table : $table ;
        // exit($table);
        $this->crud->set_table($table);
        $this->crud->unset_read()->unset_clone();
        return $this->crud;
    }
    function set_js($array = []){
        $CI = &main_instance();
        $CI->data['js_admin_files'] = array_merge($CI->data['js_admin_files'],$array);
        return $CI;
    }
    function render_page($page ,$data  = []){
        $this->render($data,$page);
    }
    function render($data = [],$page = ''){
        $data= (array)$data;
        $data = array_merge($this->data,$data);
        $this->parser->parse('header.tpl', $data);
        
        
        // echo $this->permission_denied;
        // exit;
        if($this->permission_denied){
            $this->parser->parse('permission_denied.tpl',$data);
        }
        else if(!empty($page)){
            $page = strpos($page,'.tpl') ? $page : "$page.tpl";
            $this->parser->parse($page,$data);
        }
        //$this->parser->parse('home.tpl', $data);
        $this->parser->parse('footer.tpl', $data);
    }
    public static function &main_instance(){
        return self :: $instance;
    }
    
	function first_role_record_not_update($post ,$key){
	    if($key == 1)
	        return false;
	    return $post;
	}
	function first_role_record_not_delete($primary_key){
	    
	    if($primary_key == 1){
	        return false;//['status' => false,'message' => "permission denied"];
	    }
	    return true;
	}
}


?>