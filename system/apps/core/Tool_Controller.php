<?php
 defined('FOLDER') or define('FOLDER','public/temp/'.CLIENT_ID);
class Tool_Controller extends MY_Controller{
    
	public $page_id = 0,$pageData,$group_id,$crud,$theme_path,$default_theme_path; 

    function __construct(){ 
        parent :: __construct(); 
        $this->load->library('session');
        
        $this->theme_path = realpath(APPPATH.'../../themes').'/'.FileDirecory;
        $this->default_theme_path = realpath(APPPATH.'../../themes').'/default';
        $this->load->model(array(
							'tool/AdminModel',
							'tool/SiteModel',
							'tool/GalleryModel',
							'tool/MenuModel',
							'tool/ThemeModel',
							'tool/WidgetModel',
							'tool/PaymentModel',
							'tool/FormModel',
							'tool/ServiceModel',
							'tool/HtmlModel',
							'tool/crud_model',
							'tool/SmsModel',
							'tool/NewsModel'
						));
        $this->load->helper('tool/custom_helper');
        //$this->init_id();
        // $this->init_site();
        $this->load_crud();
    }
    
    
    function load_crud($database = ''){
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD($database);
        return $this;
    }
    function crud_table($table = '', $admin_with_addon = false, $dbprf = true){
        $table = empty($table) ? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2)[1]['function'] : $table;
        $table = $dbprf ? TOOL_DB_DBPREFIX.$table : $table ;
        // exit($table);
        $this->crud->set_table($table);
        $this->crud->unset_read()->unset_clone()->field_type('admin_id','hidden',CLIENT_ID);
        return $this->crud;
    }
    
    
    function init_id($page_id = DefaultPage){
       
        $this->page_id  = $page_id;
        $this->init_site();
    }
    function all_config(){
        $items = $this->config;
        echo '<pre>';
        print_r($items);
    }
    function file_up($file){
        if(!empty($_FILES[$file]['name'])){
            
            $filename = $_FILES[$file]['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
			$x = getRadomNumber(10).'.'.$ext;
			$saveName = 'public/temp/'.CLIENT_ID.'/'.$x;
		     $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
		     $config['allowed_types'] = 'jpg|jpeg|png|gif';
		     $config['max_size'] = '2048'; // max_size in kb
		     $config['file_name'] = $x;
		     $this->load->library('upload',$config); 
		     if($this->upload->do_upload($file)){

		       $uploadData = $this->upload->data();

		       $data = array('file_name'=>$x,'admin_id'=>CLIENT_ID);
                $this->db->insert('manage_files',$data);
		       $data['size'] = $_FILES[$file]['size'];
		       $this->SiteModel->insert_file_size($data);
		       return $x;
		     }
		   } 
		  return '';
    }
    function init_site($flag = false){
        /*
        $class = strtolower( $this->router->fetch_class() );
        
        
        if( $class != 'admin' OR $flag) {
            
            $L = $this->SiteModel->getPageData($this->page_id);
            if($L->num_rows()){
                $this->pageData = $L->row();
            }
            else
                show_404();
            
            $website= $this->SiteModel->getWebsiteData()->row();
            
            if($website->favicon)
               load_web_plugin('favicon', '<link rel="icon" href="'.client_file($website->favicon).'" type="image/gif" sizes="16x16">');
               
            if($website->logo)
                load_web_plugin('logo', client_file($website->logo));
                
            if($website->contact)
                load_web_plugin('contact',json_decode($website->contact, true )[0]);
                
            if($website->email)
               load_web_plugin('email',json_decode($website->email, true )[0]);
            
            if($website->box_layout)
                load_web_plugin('box_layout', json_decode($website->box_layout, true ) );
                
            if($website->title){
                
                $link = $this->SiteModel->list_page($this->page_id);
                
        		$page = $link->row();
                $title = $website->title;
                
                load_web_plugin('title',$title);
                
                $title = ' <title>' . $title;
         
                if($this->SiteModel->getDefaultPage(CLIENT_ID) != $this->page_id){  
                	$title.=  ' | '  .  $page->page_name;
                }
                
                $title .=' </title> ';
                
                load_web_plugin('title_tag',$title);
                
            }
            
            
            if($this->page_id){
                
                $meta = '';
                
                if(strlen($this->pageData->keywords)>0) {	
                    
                    $meta.='<meta name="keywords" content="';
                	foreach (json_decode($this->pageData->keywords) as $key)
                		$meta .= $key.',';
                	$meta.='"/>';
                	
                }
                
                load_web_plugin('meta',$meta);
                
            }
            
            $adsense = $this->db->where('admin_id',CLIENT_ID)->get('google_adsense');
            
            if($adsense->num_rows())
            {
            	$code = $adsense->row()->code;
            	load_web_plugin('google_adsense',  ( is_html($code) ? $code : '' ) );
            }
        
        }
        */
    }
    public function menu_items(){
         $group = $this->MenuModel->get_menu_groups([],1,0,1);
         $this->group_id = $group_id = ($group->num_rows()) ? $group->row()->id : 0;
         $query = $this->MenuModel->get_menus($group_id);                   

          $ref   = [];

          $items = [];
          
         $menuCSS = $this->MenuModel->getMenuCSS(['group_id' => $this->group_id]);
         $me      = $menuCSS->row();
        
        
          if($check=!($me->menu=='' && $me->menu_hover==''))
          {
             $css = json_decode($me->menu,true);
             $cssHover=json_decode($me->menu_hover,true);
          
              $submenuCss = json_decode(json_encode(json_decode($me->submenu)),true);
              $subMenuCssHover=json_decode($me->submenu_hover,true);
              if($check):     
                load_web_plugin('menu_css',\C::printMenuCSS($css,$cssHover,$submenuCss,$subMenuCssHover,$this->group_id));
              endif;
          
          }
          
          foreach($query->result() as $k => $data) {

	            $icons = (array) ( !empty( $data->iconCss ) ? json_decode($data->iconCss) : C::isIconStyle() );
                   
                $iconStyle = 'style="';
                foreach($icons as $i => $v){
                    if( ! in_array( $i , [ 'position' , 'title_hide' , 'icon_hide' ] ) ){
                        
                            $iconStyle .= $i.':'.$v;
                            $iconStyle .= ($i == 'font-size') ? 'px;' : ';';
                    }
                }
                $iconStyle .= '"';
                $pageName = $data->label;
                
                if(isset($icons['title_hide']))
                    $pageName = $icons['title_hide'] == 'false' ? '' : $pageName;
                
                $Hide_icon = false;
                if(isset($icons['icon_hide']))
                    $Hide_icon = ($icons['icon_hide'] == 'false') ? false : true;
                    
                
                 
              $thisRef                  =       &$ref[$data->id];
              $thisRef['parent']        =       $data->parent;
              $thisRef['type']          =       $data->type;
              $thisRef['page_name']     =       $data->label;
              $thisRef['link']          =       $data->link;
              $thisRef['url']           =       (base_url.'/web/'.AJ_ENCODE($data->page_id).'/');
              $thisRef['id']            =       $data->id;
              $thisRef['page_id']       =       $data->page_id;
              $thisRef['target']        =        '';
              
              $thisRef['left_icon']     =  ( $icons['position'] == 'left' AND $Hide_icon ) ? 
                                                            empty($data->icon) ? '' : '<i '.$iconStyle.' class="'.$data->icon.'"></i>' : '';
              $thisRef['right_icon']    =  ( $icons['position'] == 'right' AND $Hide_icon ) ? 
                                                            empty($data->icon) ? '' : '<i '.$iconStyle.' class="'.$data->icon.'"></i>' : '';
                                                            
              $thisRef['label']         =   $thisRef['left_icon'].' '.$pageName.' '.$thisRef['right_icon'];                                             
              
              $chR = $this->SiteModel->list_page($data->page_id);
              if($chR->num_rows()){
                    $MENURow = $chR->row();
                    $thisRef['target'] = $MENURow->redirection ? ' target="_blank" ' : '';
                    if($MENURow->link)
                        $thisRef['url'] = $MENURow->link;
                    else
                        $thisRef['url'] = $thisRef['url'] . Print_page($MENURow->page_name);
              }

             if($data->parent == 0) 
                  $items[$data->id]                         =       &$thisRef;
             else 
                  $ref[$data->parent]['child'][$data->id]   =       &$thisRef;

          }
          return $items;
    }
    
}

?>