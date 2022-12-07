<?php
class Template extends Tool_Controller{
    
    public  $page_id = 0,$pageData,
            $pluginDir = 'home/plugins',
            $is_primary_page = false;
    
    function __construct($flag = false){
        parent :: __construct();
        $id = $this->uri->segment('2','0');
        if($flag){
            $this->page_id = DefaultPage;
            $this->init();
        }
        if(@debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT,6)[2]['class'] != 'Modules' AND !$flag){
            
    		$this->page_id = $id ? AJ_DECODE($id) :DefaultPage; 
    		$this->__vistor_count()->init();
    		load_web_plugin('IS_PRIMARY_PAGE',($this->is_primary_page = ($this->page_id == DefaultPage) ) );
    		load_web_plugin('YEAR',date('Y'));
    		load_web_plugin('NEXT_YEAR',(date('Y') + 1));
    		load_web_plugin('base_url',base_url());
    		load_web_plugin('theme_url',theme_url());
            load_web_plugin('result_form_css','');
    		$this->load->model('tool/extra_setting','ES');
    		$get = $this->ES->get('all');
    		if($get->num_rows()){
    		    foreach($get->result() as $row)
    		        load_web_plugin($row->type,$row->value);
    		}
        }
    }
    private function __vistor_count(){
        $counter_number = $this->WidgetModel->getVisit();
        $width = $height = 0;
        $number = getNumberAbbreviation( $counter_number );
        
	    if($counter_number >= 1000)
	        $width = $height = '43px';
	    else if($counter_number >= 10000)
	        $width = $height = '34px';
	    else if($counter_number >= 100000)
	        $width = $height = '28px';
	    else if($counter_number >= 1000000)
	        $width = $height = '24px';
	    else if($counter_number >= 10000000)
	        $width = $height = '21px';
	    else if($counter_number >= 100000000)
	        $width = $height = '19px';
	    else if($counter_number >= 1000000000)
	        $width = $height = '17px';
	    else if($counter_number >= 10000000000)
	        $number = "<b>$counter_number</b>";
	    
	    if($width AND $height)
	       load_web_plugin('vistor_counter_style_css', sprintf("img.counter-image-css{width:%s;height:%s}",$width,$height) );
        load_web_plugin('all_visits',$number);
        return $this;
    }
    
    
    
    
    function load($data = []){
        $CI = &get_instance();
        $menu_items = $this->menu_items();
        $data['pageData'] = $this->pageData;
        $this->load->view('common/header');
        $this->load->view('_assets/header',$data,'tool');
        $this->load->view('header',['menu_items' => $menu_items,'group_id' => $this->group_id ,'CI' => $CI],'tool');
        $this->load->view('home',$this->container($data),'tool');
        $this->load->view('footer','','tool');
        $this->load->view('common/footer',['fixed_content' => $this->load->view('common/content',$data,true),'footer_data' => $this->load->view('_assets/footer',['return'=> true,'CI' => $CI],'tool')]);
    }
    function test(){
        echo '<pre>';
        print_r(@debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT,6));
    }
    private function container($data){
        
        
        extract($data);
        $data['rw']=$data['lw']=0;
        $data['x']=12;
        if($leftSide->num_rows())
        	$data['lw']=2;
        if($rightSide->num_rows())
        	$data['rw']=2;
        $data['cw']=$data['x']-$data['lw']-$data['rw'];
        extract($data);
        
        $html = '';
        $schema = $this->SiteModel->getPageSchema(array('page_id'=>$this->page_id,'admin_id'=>CLIENT_ID));
        if($schema->num_rows()){
            foreach ($schema->result() as $item)
			{
			    $key = $item->key_id;
			    $type = $item->type;
			    $common_data = ['id' => $key , 'cw' => $cw ];
			    
			    switch($type){
			        case 'content':
			            $html .= $this->pageContent($pageData);
			        break;
			        case 'content_category':
            	        $html .= $this()->pluginView('content',$data);
            		break;
                    case 'typing_master':
            	        $html .= $this->pluginView('dir/'.$type,$common_data);
            	    break;
            	    case 'main_slider':  
            	        $html .= $this->pluginView('main_slider',$data);
            	    break;
            
            		case 'tab':
            	        $html .= $this->pluginView('tab_scheme',$data);
            		break;
            		
            		default:
            		    $html .= $this->themeView($type,$common_data);
            		break;
            
			    }
			    
			}
            load_web_plugin('content',$html);
        }
        return $data;
    }
    function PopupForm($key){
     
        $data['id'] = $key;
         $f = $this->FormModel->getFormModel(array('id'=>$key))->row();
        
        $data['f'] = $f;
        $data['fields']  = json_decode($f->fields);
        return $this->themeView('getForm',$data);
    }
    private function form($data){
        extract($data);
        $f = $this->FormModel->getFormModel(array('id'=>$key));
        if(!$f->num_rows())
            return 'Form Not Found.';
            
        
        $f = $f->row();
        $data['fields']  = json_decode(@$f->fields);
        $data['f'] = $f;
        if($f->theme_id){
            $data['form_id'] = $f->id;
            $data['event'] = $f;
            $data['css'] = $f->css;
            return $this->pluginView('print_form_with_theme',$data);
        }
        else
            return $this->themeView('getForm',$data);
        
    }
    private function tform($data){
        extract($data);
       $f = $this->FormModel->getTransactionForm(array('id'=>$key));

        if(!$f->num_rows())
            return;
            
        
        $f = $f->row();
        $data['fields']  = json_decode(@$f->fields);
        $data['f'] = $f;
        
        return $this->themeView('getTform',$data);
        
    }
    private function marquee($data){
        extract($data);
        $mar = $this->SiteModel->getMarquee(['id'=>$key]);
        
        if($mar->num_rows()){
            $mar1 = $mar->row();
            $data['mar1'] = $mar1;
            return $this->themeView('getMarquee',$data);
        }
        return;
    }
    private function fservice($data){
        extract($data);
        $service = $this->ServiceModel->getFileService(array('id'=>$key))->row();

        $f = $this->FormModel->getFormModel(array('id'=>$service->formid))->row();
    
        $data['fields']  = json_decode($f->fields);
        $data['f'] = $f;
        $data['service'] = $service;
        return $this->themeView('getFileService',$data);
    }
    private function slider($data){
        extract($data);
        $data['data'] = $this->SiteModel->getCarousel(array('id'=>$key));
        return $this->themeView('getCarousel',$data);
    }
    function rform($data){
        extract($data);
        $f = $this->FormModel->getSearchResultForm_View(['id'=>$key])->row();
        $fields = json_decode($f->fields);
        $form_css = json_decode($f->forms_css);
    
        $css = '<style>
                .resultSearchForm-Button-'.$f->id.'{';
                foreach($form_css->button_css as $k => $v){
                    $css .= $k.':'.$v.';';
                }
        $css .= 'cursor:pointer;}</style>';
        unset($form_css->button_css);
        load_web_plugin('result_form_css',$css,true);
        $data['f'] = $f;
        $data['fields'] = $fields;
        $data['form_css'] = $form_css;
        return $this->themeView('getSearchResultForm',$data);
    }
    function themeView($page,$data = []){
        $data['return'] = true;
        $data['key'] = isset($data['id']) ? $data['id'] : '';
        $data['col'] = isset($data['cw']) ? $data['cw'] : '';
        
        if(method_exists($this,$page))
            return $this->$page($data);
        
        if(file_exists($this->theme_path.'/content/'.$page.EXT))
            return $this->load->view("content/$page",$data,'tool');
        else if(file_exists($this->default_theme_path.'/content/'.$page.EXT)){
            return $this->load->view("content/$page",$data,'default');
        }
        
        return isset($_GET['section']) ? $page.'<br>' : '';
    }
    
    private function fdgallery($data){
        extract($data);
        $g = $this->GalleryModel->file_download_gallery(array('file_download_gallery_id'=>$key))->row();
        $files = $this->GalleryModel->files_download_gallery(array('file_download_gallery_id'=>$key,'admin_id'=>CLIENT_ID));
        $lay = 1;//$g->layout?$g->layout:1;
        $data['width']= round(12/$lay,2);
        $data['lay'] = $lay;
        $data['g'] = $g;
        $data['files'] = $files;
        $data['height']= '150';//round((75*$col)/$lay,2);
        
        return $this->themeView('getFileDownloadGallery',$data);
    }
    private function vgallery($data){
        extract($data);
        $g = $this->GalleryModel->getVideoGallery(array('id'=>$key))->row();
        $data['videos'] = $this->GalleryModel->getGalleryVideos(array('gallery_id'=>$key,'admin_id'=>CLIENT_ID));
        $lay = $g->layout?$g->layout:1;
        $data['width']= round(12/$lay,2);
        $data['height']= round((75*$col)/$lay,2);
        $data['lay'] = $lay;
        $data['g'] = $g;
        return $this->themeView('getVideoGallery',$data);
    }
    
    private function pgallery($data){
        extract($data);
       
        $g = $this->GalleryModel->product_gallery(array('id'=>$key))->row();
        $data['images'] = $this->GalleryModel->getGalleryProducts(array('gallery_id'=>$key));
        $lay = $g->layout?$g->layout:1;
        
        $data['btn'] = json_decode($g->btn_css);
        $data['btnClass'] = 'prBtn-'.$g->id;
         
        $data['width']= round(12/$lay,2);
        $data['height']= round((65*$col)/$lay,2);
        $data['lay'] = $lay;
        $data['g'] = $g;
        return $this->themeView('getProductGallery',$data);
    }
    private function igallery($data){
        extract($data);
        $g = $this->GalleryModel->image_gallery($key)->row();
        $data['images'] = $this->GalleryModel->list_galllery_images(array('gallery_id'=>$key,'admin_id'=>CLIENT_ID));
        $lay = $g->layout?$g->layout:1;
        $data['width']= round(12/$lay,2);
        $data['height']= round((75*$col)/$lay,2);
        $data['g'] = $g;
        $data['lay'] = $lay;
        return $this->themeView('getGallery',$data);
    }
    
    
    function pluginView($page,$data = [],$flag = true){
        return $this->load->view("$this->pluginDir/$page",$data,$flag);
    }
    
    function pageContent($pageData){
        $html = isset($pageData->content) ? $pageData->content : "";
        if(file_exists($this->theme_path.'/_assets/content.php'))
             $html = $this->load->view('_assets/content',(array)$pageData+['return' => true],'tool');
        return $html;
    }
    
    function set($index , $value = ''){
        if(is_array($index)){
            foreach($index as $i => $v)
                $this->set($i,$v);
        }
        else
            $this->{$index} = $value;
        return $this;
    }
    
    private function init(){
        $class = strtolower( $this->router->fetch_class() );
        
        
        if( ($class != 'admin') AND $this->page_id) {
            
            $this->page = $link = $this->SiteModel->list_page($this->page_id);
          
            $L = $this->SiteModel->getPageData($this->page_id);
            if($L->num_rows() AND $this->page->num_rows()){
                $this->pageData = $L->row();
            }
            else
                show_404();
                
            
            $website = $this->SiteModel->getWebsiteData()->row();
            
            if($website->favicon)
               load_web_plugin('favicon', '<link rel="icon" href="'.client_file($website->favicon).'" type="image/gif" sizes="16x16">');
               
            if($website->logo)
                load_web_plugin('logo', client_file($website->logo));
            if($website->secondary_logo)
                load_web_plugin('secondary_logo',client_file($website->secondary_logo));
            if($website->contact)
                load_web_plugin('contact',json_decode($website->contact, true )[0]);
            if($website->logo_style != 'null'){
                $logoStyle = json_decode($website->logo_style,true);
                load_web_plugin('logo_style','style="width:'.$logoStyle['width'].'px;height:'.$logoStyle['height'].'px"');
            }
            if($website->email)
               load_web_plugin('email',json_decode($website->email, true )[0]);
            load_web_plugin('header_code','');
            if($website->other)
            {
            	$d = json_decode($website->other);
            	load_web_plugin('header_code', ("\n".isset($d->headerCode) ? $d->headerCode : ''));
            }
            load_web_plugin('chatCode','');
            if($website->other)
            {
            	$d = json_decode($website->other);
            	load_web_plugin('chatCode',$d->chatCode);
            }
            
            $theme_config = $this->theme_path.'/config/theme.php';
            if(file_exists($theme_config)){
                require_once $theme_config;
                if(isset($theme)){
                    foreach($theme as $index  => $config_value)
                        $this->config->set_item( $index , $config_value );
                }
            }
            
            if(!empty($website->theme_color))
            {
                $this->config->set_item('web_theme_color',$website->theme_color);
            }
            load_web_plugin('layout_css','');
            $BODYSTYLE = '';
            if($website->box_layout){
                $boxLayout = ( json_decode($website->box_layout, true ) );
                $layout = false;
                if(is_object($boxLayout)){
                    if($boxLayout->box_layout)
                    {
                        $layout = true;
                        $BODYSTYLE = 'margin-left:6%;margin-right:6%;'; 
                        if($boxLayout->type == 'bg_color')
                              $BODYSTYLE .= 'background:'.$boxLayout->value;
                        if($boxLayout->type == 'bg_image')
                             $BODYSTYLE  .= 'background-image:url('.client_file($boxLayout->value).');background-repeat: no-repeat;background-size: 100% 100%;';
                    }
                }
                load_web_plugin('layout_css',\C::contentCss([ 'layout' => $layout ]));
            }
            
            load_web_plugin('body','<body style="'.$BODYSTYLE.'" >');
            $title_tag = '';
            if($website->title){
                
                
                
        		$page = $link->row();
                $title = $website->title;
                
                load_web_plugin('title',$website->title);
                
                $title_tag = ' <title>';
         
                if($this->SiteModel->getDefaultPage(CLIENT_ID) != $this->page_id){  
                	$title_tag.=  $page->page_name .' | ';
                }
                
                $title_tag .= $title.' </title> ';
                
                load_web_plugin('title_tag',$title_tag);
                
            }
            
            
            if($this->page_id){
                $title_tag = strip_tags($title_tag);
                $meta = '<meta name="description" content="'.$title_tag.'">
    <meta name="language" content="English">
    <meta property="og:locale" content="en_GB" />
    <meta property="og:url" content="'.current_url().'">
    <meta property="og:type" content="page" />
    <meta property="og:title" content="'.$title_tag.'">
    <meta property="og:description" content="'.$title_tag.'" > 
    <meta property="og:image" content="'.web_plugin('logo').'">
    <meta property="og:image:url" itemprop="image" content="'.web_plugin('logo').'" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="600" /> ';
                
                if(strlen($this->pageData->keywords)>0) {	
                    
                    $meta.='<meta name="keywords" content="';
                	foreach (json_decode($this->pageData->keywords) as $key)
                		$meta .= $key.',';
                	$meta.='"/>';
                	
                }
                
                load_web_plugin('meta',$meta);
                
                if(!empty($this->pageData->heading)){
                    load_web_plugin('heading',$this->pageData->heading);
                }
                if(!empty($this->pageData->heading_image)){
                    $frontImage = client_file($this->pageData->heading_image);
                    //exit($frontImage);
                    load_web_plugin('head_image',$frontImage);
                }
                load_web_plugin('page_name',$page->page_name);
                
            }
            
            $adsense = $this->db->where('admin_id',CLIENT_ID)->get('google_adsense');
            
            if($adsense->num_rows())
            {
            	$code = $adsense->row()->code;
            	load_web_plugin('google_adsense',  ( is_html($code) ? $code : '' ) );
            }
            $this->visitor_counter();
            $this->topbar();
            
            
            $utilitySocial  = $this->db->where(array('type'=>'social','admin_id'=>CLIENT_ID,'status'=>1))->get('utilities');
            
            if($utilitySocial->num_rows())
            {	
                load_web_plugin('social_links', json_decode($utilitySocial->row()->data));
            }
            
            
            
            
        }
        else
            show_404();
    }
    
    
    
    
    
    function topbar(){
        //this is basic default theme
        load_web_plugin('topbar_css','');
        $html = '';
        $top = $this->SiteModel->getTopBar();
        if($top->num_rows()){
            $top = $top -> row();
            
            load_web_plugin('topbar_css',\C::printHeaderCSS('topbar',json_decode($top->css,true)));// $top -> css;
             $html = '<div class=" header-section" >
                        <div class="row" style="padding:0;margin:0">';
                    
                    
                    
                    $events = (array) json_decode( $top -> events);
                    foreach($events as $k){
                        
                        $html .= '<div class="'.$k->size.'" style="padding:0">';
                        $html .= \C::TOPWIDGET( $k->id , $k->action );
                        $html .= '</div>';
                    }
                
            $html .= '      </div>
                  </div>';
        }
        load_web_plugin('topbar_widget',$html);
    }
    function visitor_counter(){
        $this->load->helper('cookie');
        $day=86400;
        
        if(!($val = get_cookie('visitcounter'))){
      
        	@set_cookie('visitcounter','true',$day);
        	$this->WidgetModel->siteVisit();
        }
    }
    public function menu_items(){
         $group = $this->MenuModel->get_menu_groups([],1,0,0);
         $this->group_id = $group_id = ($group->num_rows()) ? $group->row()->id : 0;
         $query = $this->MenuModel->get_menus($group_id);                   

          $ref   = [];

          $items = [];
        //   echo $this->group_id;
         $menuCSS = $this->MenuModel->getMenuCSS(['group_id' => $this->group_id]);
         $me      = $menuCSS->row();
        //  print_r($me);
        //  exit;
         load_web_plugin('menubar_color',!empty($me->menubar_color) ? 'style="background: '.$me->menubar_color.'!important;"' : '');
         load_web_plugin('menubar_color_code',!empty($me->menubar_color) ? $me->menubar_color : '');
        
          if($check=!(@$me->menu=='' && @$me->menu_hover==''))
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