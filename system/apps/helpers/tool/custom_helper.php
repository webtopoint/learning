<?php
// error_reporting(-1);
function print_ddd($value){
    if(file_exists(client_file($value))){
        $file = client_file($value,true);
        $ex = pathinfo($file , PATHINFO_EXTENSION);
        if(in_array($ex,['png','jpeg','jpg'])){
            return "<img class='imgClass' style='width:100px;height:100px' src='$file' >";
        }
    }
    
    return $value;
}

function isHTML($string){
    return ($string != strip_tags($string));
}
if(!function_exists('starts_with')){
    function starts_with($haystack, $needle)
    {
    	return substr($haystack, 0, strlen($needle))===$needle;
    }
}
function getFormButtonClass(){
    switch(THEME_ID){
        case 3:
            return 'theme-btn btn-style-one';
        break;
        
        default:
            return 'btn';
        break;
    }
}
// check whether a string ends with the target substring
function ends_with($haystack, $needle)
{
	return substr($haystack, -strlen($needle))===$needle; 
} 

function findMulWordsFromString($str , array $arr){
    foreach ($arr as $word) {
        if (strpos($str, $word)) return true;
    }
    return false;
}
function arrayContainsWord($str, array $arr)
{
    foreach ($arr as $word) {
        if (preg_match('/(?<=[\s,.:;"\']|^)' . $word . '(?=[\s,.:;"\']|$)/', $str)) return true;
    }
    return false;
}
function extra_setting($first , $second = false , $value = ''){
    // $CI = &get_instance();
    return get_instance()->SiteModel->extra_setting($first,$second,$value); 
}
function container($type,$key)
{
	$page_id    = $GLOBALS['page_id'];
	$cw         = $GLOBALS['cw']; 
	$pageData   = $GLOBALS['page_data'];        
    //print_r($GLOBALS);
	switch($type)
	{
	    case 'typing_master':
	        echo get_instance()->load->view('home/plugins/dir/'.$type,['id' => $key , 'cw' => $cw ],true);
	    break;
	    case 'main_slider':  
	        echo get_instance()->load->view('home/plugins/main_slider',$GLOBALS,true);
	    break;
		case 'slider':
            if(function_exists('getCarousel')){
    	        echo'<div class="" style="margin-top:0px; padding-top:0; margin-bottom:10px; width:100%;">';
    		      getCarousel($key);
    	        echo '</div>';
    	    }
		break;
        case 'pgallery':
		    if(function_exists('getProductGallery'))
			    getProductGallery($key,$cw);
		break;
		case 'igallery':
            if(function_exists('getGallery'))
			    getGallery($key,$cw);
		break;
        
        case 'fdgallery':
            if(function_exists('getFileDownloadGallery'))
                getFileDownloadGallery($key,$cw);
        break;
        
		case 'vgallery':
		    if(function_exists('getVideoGallery'))
			getVideoGallery($key,$cw);
		break;

		case 'content':
			echo isset($pageData->content)? $pageData->content :"";
		break;

		case 'form':
			echo '<div class="container" style="padding:10px;">';
			if(function_exists('getForm'))
				getForm($key);
			echo'</div>';
		break;

		case 'tform':
			echo '<div class="container" style="padding:10px;">';
			if(function_exists('getTransactionForm'))
			    getTransactionForm($key);
			echo'</div>';
		break;

		case 'fbox':
		    if(function_exists('getFeatureBox'))
			    getFeatureBox($key);
		break;

		case 'fservice':
			if(function_exists('getFileService'))
			    getFileService($key);
		break;
		case 'ads': 
			if(function_exists('getAds'))
				getAds($key);
		break;

		case 'marquee':
		    if(function_exists('getMarquee'))
			  getMarquee($key);
		break;
		
		case 'rform':
		    if(function_exists('getSearchResultForm') && get_instance()->crud_model->get_general_setting_by_type('result_section') == 'ok')
			   getSearchResultForm($key);
		break;
		
		case 'content_category':
	        echo get_instance()->load->view('home/plugins/content',$GLOBALS,true);
		break;


		case 'tab':
	        echo get_instance()->load->view('home/plugins/tab_scheme',$GLOBALS,true);
		break;
		
		default:
		    //echo $type;
		    if(function_exists($type))
		        $type();
		break;
		
	}
}
function social_input($type = 'header', $types = []){
 
    //$headerRight = ['facebook','twitter','youtube','instagram'];
    foreach($types as $headerDD){
        $name = $type.'_'.$headerDD;
        $uc = ucwords( str_replace('_' , ' ', $headerDD) );
        echo '  <div class="form-group">
                    <label for="'.$name.'"><i class="fa fa-'.$headerDD.'"></i> '.$uc.'</label>
                    <input id="'.$name.'" type="text" name="'.$name.'" placeholder="Enter '.$uc.'"  class="form-control" value="'.extra_setting($name,true).'">
                </div>';
    }
}
function print_social_input($type = 'header', $types = []){
    foreach($types as $headerDD){
        $name = $type.'_'.$headerDD;
        if($link = extra_setting($name)){
            echo '<li><a href="'.$link.'"><i class="fa fa-'.$headerDD.'" aria-hidden="true"></i></a></li>';
        }
    }
}
function getContentCss($theme = FileDirecory,$tt = false){
    $ci = get_instance();
     $html = '';
    if(file_exists(APPPATH.'../../themes/'.FileDirecory.'/_assets/header.php')){
        
        $html = file_get_contents(APPPATH.'../../themes/'.FileDirecory.'/_assets/header.php');
        $linkers = [];
        $document = new DOMDocument;
        $document ->loadHTML($html);
        $links = $document->getElementsByTagName('link');

        //Array that will contain our extracted links.
        $extractedLinks = array();
        
        foreach($links as $link){
        
            //Get the link in the href attribute.
            $linkHref = $link->getAttribute('href');
        
            //If the link is empty, skip it and don't
            //add it to our $extractedLinks array
            if(strlen(trim($linkHref)) == 0){
                continue;
            }
        
            //Skip if it is a hashtag / anchor link.
            if($linkHref[0] == '#'){
                continue;
            }
             $lnk = str_replace('{_theme_url_}',theme_url(),$linkHref);//starts_with($linkHref, '{_theme_url_}') ? str_replace('{$linkHref : theme_assets().$linkHref;
             $linkers[] = "'$lnk'";
        }
        $html = implode(',',$linkers);
    }
    else{
        $ci->load->config('theme_css');
        $get = $ci->config->item($theme);
       
        if(isset( $get['css'])){
            foreach($get['css'] as $css){
                $url = starts_with($css, 'http') ? $css : theme_path().$css;
                $html .= "'$url',";
            }
            if($tt)
                return  $get['css'];
        }
    }
    return trim($html,',');
}

function theme_url($append = ''){
    return base_url('themes/'.FileDirecory.'/').$append;
}

function getContnetModels($theme = FileDirecory){
    $ci = get_instance();  $html = '';
    $where = ['theme_id' => THEME_ID];
    $type = $ci->uri->segment(1);
    if($type == 'sliders'){
        $where['type'] = $type;
    }
    $get = $ci->db->get_where('theme_modals',$where);
    if($get->num_rows()){
        foreach($get->result() as $g){
            $html .= "{
                        'title' : `$g->title`,
                        'description' : `$g->description`,
                        'content' : `$g->content`
                    },";
        }
    }
    else{
        $ci->load->config('theme_css');
        $get = $ci->config->item($theme);
       
        if(isset( $get['content_model'])){
            //echo '<pre>';
            foreach($get['content_model'] as $model)
            {
                $html .= '{';
                foreach($model as $key => $value){
                    $html .= ' "'.$key.'" : `'.$value.'`,';  
                }
                $html .= '},';
            }
        }
    }
   return trim($html,',');
}
function client_file($file = '',$flag = false){
    return base_url(trim('assets/file/'.$file) );
}
function page_link($id = 1, $page_name = ''){
    return DefaultPage==$id
                    ?  '/'
                    :  (base_url.'/web/'.AJ_ENCODE($id).'/'.Print_page($page_name));
}

function view_page(){
    if(isCustom){
        return VIEWPATH. 'process.php';
    }
    return  VIEWPATH. 'index.php';  
}
function theme_assets($base = ''){
    return base_url("public/theme/".FileDirecory."/$base");
}
function load_web_plugin($index,$value,$flag = false){
    $ci = &get_instance();
    if($ci->config->item($index) AND $flag)
        $value .= $ci->config->item($index);
    return $ci->config->set_item($index,$value);
} 
function _view_exists($modules,$view)
{
   $mod_dir = '../../modules/'. $modules .'/';
   return (
       (file_exists(APPPATH .'views/'. $view . EXT) or file_exists(APPPATH .'views/'. $view))
       or
       (file_exists(APPPATH . $mod_dir .'views/'. $view . EXT) or file_exists(APPPATH . $mod_dir .'views/'. $view))
     );
}
function web_plugin($item){
    $ci = &get_instance();
    $item = $ci->config->item($item);
    if($item)
        return $item;
    return '';
}

class C{
    public static function LoadCk($instance = '#aray-editor'){
        if(is_bool($instance))
            return '<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>';
        return '<script src="'.site_url('public/web/').'jquery.min.js"></script><script src="'.base_url.'/public/custom/ckeditor/ckeditor.js"></script><script>CKEDITOR.replace("'.$instance.'")</script>';
    }
    static function clearWebCache(){

        $url = BASEPATH.'cache';
            
        if(intval( self :: GetDirectorySize($url) )  > 83886080 )
            self :: deleteDir($url);       
        
    }
    static function isIconStyle(){
        return [
                'position' => 'left',
                'color'    => '#ffffff',
                'font-size' => '17',
                'icon_hide' => 'false',
                'title_hide' => 'true'
            ];
        
    }
    static function TOPWIDGET($id = 0, $action = ''){
        $that = get_instance();
        switch($action){
            
            case 'logo':
                $webdata        =           $that->SiteModel->getWebsiteData();
                $logo           =           "";
                if($webdata->num_rows())
                {
                    $wdata = $webdata->row();
                    if($wdata->logo)
                        echo '<a href="/"><img style="width:100%;height:100%" src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$wdata->logo.'"></a>';
                }
            break;
            
            case 'widget':
                echo getWidget($id);
            break;
            case 'menu':
                $query = $that->MenuModel->get_menus($id);                   

                  $ref   = [];

                  $items = [];

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
                            
                        
                         
                      $thisRef = &$ref[$data->id];
                      $thisRef['parent']        =       $data->parent;
                      $thisRef['type']          =       $data->type;
                      $thisRef['page_name']     =       $data->label;
                      $thisRef['link']          =       $data->link;
                      $thisRef['id']            =       $data->id;
                      $thisRef['page_id']       =       $data->page_id;
                      $thisRef['target']        =        '';
                      
                      $thisRef['left_icon']     =  ( $icons['position'] == 'left' AND $Hide_icon ) ? 
                                                                    empty($data->icon) ? '' : '<i '.$iconStyle.' class="'.$data->icon.'"></i>' : '';
                      $thisRef['right_icon']    =  ( $icons['position'] == 'right' AND $Hide_icon ) ? 
                                                                    empty($data->icon) ? '' : '<i '.$iconStyle.' class="'.$data->icon.'"></i>' : '';
                                                                    
                      $thisRef['label'] =  $thisRef['left_icon'].' '.$pageName.' '.$thisRef['right_icon'];                                             
                      
                      $chR = $that->SiteModel->list_page($data->page_id);
                      if($chR->num_rows())
                       $thisRef['target'] = $chR->row()->redirection ? ' target="_blank" ' : '';

                     if($data->parent == 0) {

                          $items[$data->id] = &$thisRef;

                     } else {

                          $ref[$data->parent]['child'][$data->id] = &$thisRef;

                     }



                  }

                   $pageCount = 0;

                  print \C::get_menuTopBar( $items );
            break;
        }
    }
    static function get_menuTopBar($items,$class = 'site-menu topbar js-clone-nav d-none d-lg-block') {



                      $html = "<ul class=\"".$class."\" id=\"menu-id\">";



                      foreach($items as $key=>$value) {
                          $_page_url = DefaultPage==$value['page_id']?'/':(base_url.'/web/'.AJ_ENCODE($value['page_id']).'/'.Print_page($value['page_name']));
                          $activeCss = getActiveMenu($value['page_id']);

                          if($value['type'] == 'category'){
                            $_page_url = base_url.'/category/'.get_instance()->NewsModel->getCategorylink($value['page_id']);
                            $activeCss = getActiveMenu($value['page_id'],'active-menu',true);
                          }
                          
                        $iconWithTExt =  $value['label'];
                         /* 
                        if(array_key_exists('child',$value))

                          $html.= '<li class="has-children"><a href="'.$_page_url.'" '.$value['target'].' class="menu-css '.$activeCss.'">'.$iconWithTExt.'</a>'; 

                        else
                        */
                          $html.= '<li><a class="menu-css '.$activeCss.'" href="'.$_page_url.'" '.$value['target'].' >'.$iconWithTExt.'</a>';

                                     

                          if(array_key_exists('child',$value))

                              $html .= get_menu($value['child'],'dropdown submenu-ul');

                          $html .= "</li>";

                      }

                      $html .= "</ul>";



                      return $html;



                  }
    static function isSiteAvailible($url){
        // Check, if a valid url is provided
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            return false;
        }
    
        // Initialize cURL
        $curlInit = curl_init($url);
        
        // Set options
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
    
        // Get response
        $response = curl_exec($curlInit);
        
        // Close a cURL session
        curl_close($curlInit);
    
        return $response?true:false;
    }
    static function isNewsPortal($id = 0,$flag = FALSE){
        $ids = [17];
        if($flag && !$id)
            return $ids;
        $id = !$id ? THEME_ID : $id;
        return in_array($id,$ids)
                    ?   TRUE
                    :   FALSE;
    }
    static function newsEvents($index = ''){
        $data = [ 
            'title'                         =>              'Title',
            'thumbnail'                     =>              'News Thumbnail',
            'share'                         =>              'Share',
            'description'                   =>              'Description',
            'time_and_author'               =>              'Time and Author',
            'like_comment_count_show'       =>              'Like & Comment Count Show',
            'like_and_comment_btn'          =>              'Like & Comment Button'
        ];
        if(isset($data[$index]))
            return $data[$index];
        return $data;
    }
    static function deleteDir($dirPath) {
        
        if (! is_dir($dirPath)) 
            throw new InvalidArgumentException("$dirPath must be a directory");
        
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') 
            $dirPath .= '/';
        
        $files = glob($dirPath . '*', GLOB_MARK);
        
        foreach ($files as $file) {
            
            if (is_dir($file)) 
                self :: deleteDir($file);
            else 
                unlink( $file );
                
        }
        rmdir($dirPath);
    }
    static function fontFamily(){
        return [
                'serif',
                'monospace',
                'cursive',
                'fantasy',
                'sans-serif',
            ];
    
    }
    static function fontawesomeIcons(){
       return ['fa-align-left' => '&#xf036; fa-align-left',
            'fa-align-right' => '&#xf038; fa-align-right',
            'fa-amazon' => '&#xf270; fa-amazon',
            'fa-ambulance' => '&#xf0f9; fa-ambulance',
            'fa-anchor' => '&#xf13d; fa-anchor',
            'fa-android' => '&#xf17b; fa-android',
            'fa-angellist' => '&#xf209; fa-angellist',
            'fa-angle-double-down' => '&#xf103; fa-angle-double-down',
            'fa-angle-double-left' => '&#xf100; fa-angle-double-left',
            'fa-angle-double-right' => '&#xf101; fa-angle-double-right',
            'fa-angle-double-up' => '&#xf102; fa-angle-double-up',
        
            'fa-angle-left' => '&#xf104; fa-angle-left',
            'fa-angle-right' => '&#xf105; fa-angle-right',
            'fa-angle-up' => '&#xf106; fa-angle-up',
            'fa-apple' => '&#xf179; fa-apple',
            'fa-archive' => '&#xf187; fa-archive',
            'fa-area-chart' => '&#xf1fe; fa-area-chart',
            'fa-arrow-circle-down' => '&#xf0ab; fa-arrow-circle-down',
            'fa-arrow-circle-left' => '&#xf0a8; fa-arrow-circle-left',
            'fa-arrow-circle-o-down' => '&#xf01a; fa-arrow-circle-o-down',
            'fa-arrow-circle-o-left' => '&#xf190; fa-arrow-circle-o-left',
            'fa-arrow-circle-o-right' => '&#xf18e; fa-arrow-circle-o-right',
            'fa-arrow-circle-o-up' => '&#xf01b; fa-arrow-circle-o-up',
            'fa-arrow-circle-right' => '&#xf0a9; fa-arrow-circle-right',
            'fa-arrow-circle-up' => '&#xf0aa; fa-arrow-circle-up',
            'fa-arrow-down' => '&#xf063; fa-arrow-down',
            'fa-arrow-left' => '&#xf060; fa-arrow-left',
            'fa-arrow-right' => '&#xf061; fa-arrow-right',
            'fa-arrow-up' => '&#xf062; fa-arrow-up',
            'fa-arrows' => '&#xf047; fa-arrows',
            'fa-arrows-alt' => '&#xf0b2; fa-arrows-alt',
            'fa-arrows-h' => '&#xf07e; fa-arrows-h',
            'fa-arrows-v' => '&#xf07d; fa-arrows-v',
            'fa-asterisk' => '&#xf069; fa-asterisk',
            'fa-at' => '&#xf1fa; fa-at',
            'fa-automobile' => '&#xf1b9; fa-automobile',
            'fa-backward' => '&#xf04a; fa-backward',
            'fa-balance-scale' => '&#xf24e; fa-balance-scale',
            'fa-ban' => '&#xf05e; fa-ban',
            'fa-bank' => '&#xf19c; fa-bank',
            'fa-bar-chart' => '&#xf080; fa-bar-chart',
            'fa-bar-chart-o' => '&#xf080; fa-bar-chart-o',
        
            'fa-battery-full' => '&#xf240; fa-battery-full',
            'fa-beer' => '&#xf0fc; fa-beer',
            'fa-behance' => '&#xf1b4; fa-behance',
            'fa-behance-square' => '&#xf1b5; fa-behance-square',
            'fa-bell' => '&#xf0f3; fa-bell',
            'fa-bell-o' => '&#xf0a2; fa-bell-o',
            'fa-bell-slash' => '&#xf1f6; fa-bell-slash',
            'fa-bell-slash-o' => '&#xf1f7; fa-bell-slash-o',
            'fa-bicycle' => '&#xf206; fa-bicycle',
            'fa-binoculars' => '&#xf1e5; fa-binoculars',
            'fa-birthday-cake' => '&#xf1fd; fa-birthday-cake',
            'fa-bitbucket' => '&#xf171; fa-bitbucket',
            'fa-bitbucket-square' => '&#xf172; fa-bitbucket-square',
            'fa-bitcoin' => '&#xf15a; fa-bitcoin',
            'fa-black-tie' => '&#xf27e; fa-black-tie',
            'fa-bold' => '&#xf032; fa-bold',
            'fa-bolt' => '&#xf0e7; fa-bolt',
            'fa-bomb' => '&#xf1e2; fa-bomb',
            'fa-book' => '&#xf02d; fa-book',
            'fa-bookmark' => '&#xf02e; fa-bookmark',
            'fa-bookmark-o' => '&#xf097; fa-bookmark-o',
            'fa-briefcase' => '&#xf0b1; fa-briefcase',
            'fa-btc' => '&#xf15a; fa-btc',
            'fa-bug' => '&#xf188; fa-bug',
            'fa-building' => '&#xf1ad; fa-building',
            'fa-building-o' => '&#xf0f7; fa-building-o',
            'fa-bullhorn' => '&#xf0a1; fa-bullhorn',
            'fa-bullseye' => '&#xf140; fa-bullseye',
            'fa-bus' => '&#xf207; fa-bus',
            'fa-cab' => '&#xf1ba; fa-cab',
            'fa-calendar' => '&#xf073; fa-calendar',
            'fa-camera' => '&#xf030; fa-camera',
            'fa-car' => '&#xf1b9; fa-car',
            'fa-caret-up' => '&#xf0d8; fa-caret-up',
            'fa-cart-plus' => '&#xf217; fa-cart-plus',
            'fa-cc' => '&#xf20a; fa-cc',
            'fa-cc-amex' => '&#xf1f3; fa-cc-amex',
            'fa-cc-jcb' => '&#xf24b; fa-cc-jcb',
            'fa-cc-paypal' => '&#xf1f4; fa-cc-paypal',
            'fa-cc-stripe' => '&#xf1f5; fa-cc-stripe',
            'fa-cc-visa' => '&#xf1f0; fa-cc-visa',
            'fa-chain' => '&#xf0c1; fa-chain',
            'fa-check' => '&#xf00c; fa-check',
            'fa-chevron-left' => '&#xf053; fa-chevron-left',
            'fa-chevron-right' => '&#xf054; fa-chevron-right',
            'fa-chevron-up' => '&#xf077; fa-chevron-up',
            'fa-child' => '&#xf1ae; fa-child',
            'fa-chrome' => '&#xf268; fa-chrome',
            'fa-circle' => '&#xf111; fa-circle',
            'fa-circle-o' => '&#xf10c; fa-circle-o',
            'fa-circle-o-notch' => '&#xf1ce; fa-circle-o-notch',
            'fa-circle-thin' => '&#xf1db; fa-circle-thin',
            'fa-clipboard' => '&#xf0ea; fa-clipboard',
            'fa-clock-o' => '&#xf017; fa-clock-o',
            'fa-clone' => '&#xf24d; fa-clone',
            'fa-close' => '&#xf00d; fa-close',
            'fa-cloud' => '&#xf0c2; fa-cloud',
            'fa-cloud-download' => '&#xf0ed; fa-cloud-download',
            'fa-cloud-upload' => '&#xf0ee; fa-cloud-upload',
            'fa-cny' => '&#xf157; fa-cny',
            'fa-code' => '&#xf121; fa-code',
            'fa-code-fork' => '&#xf126; fa-code-fork',
            'fa-codepen' => '&#xf1cb; fa-codepen',
            'fa-coffee' => '&#xf0f4; fa-coffee',
            'fa-cog' => '&#xf013; fa-cog',
            'fa-cogs' => '&#xf085; fa-cogs',
            'fa-columns' => '&#xf0db; fa-columns',
            'fa-comment' => '&#xf075; fa-comment',
            'fa-comment-o' => '&#xf0e5; fa-comment-o',
            'fa-commenting' => '&#xf27a; fa-commenting',
            'fa-commenting-o' => '&#xf27b; fa-commenting-o',
            'fa-comments' => '&#xf086; fa-comments',
            'fa-comments-o' => '&#xf0e6; fa-comments-o',
            'fa-compass' => '&#xf14e; fa-compass',
            'fa-compress' => '&#xf066; fa-compress',
            'fa-connectdevelop' => '&#xf20e; fa-connectdevelop',
            'fa-contao' => '&#xf26d; fa-contao',
            'fa-copy' => '&#xf0c5; fa-copy',
            'fa-copyright' => '&#xf1f9; fa-copyright',
            'fa-creative-commons' => '&#xf25e; fa-creative-commons',
            'fa-credit-card' => '&#xf09d; fa-credit-card',
            'fa-crop' => '&#xf125; fa-crop',
            'fa-crosshairs' => '&#xf05b; fa-crosshairs',
            'fa-css3' => '&#xf13c; fa-css3',
            'fa-cube' => '&#xf1b2; fa-cube',
            'fa-cubes' => '&#xf1b3; fa-cubes',
            'fa-cut' => '&#xf0c4; fa-cut',
            'fa-cutlery' => '&#xf0f5; fa-cutlery',
            'fa-dashboard' => '&#xf0e4; fa-dashboard',
            'fa-dashcube' => '&#xf210; fa-dashcube',
            'fa-database' => '&#xf1c0; fa-database',
            'fa-dedent' => '&#xf03b; fa-dedent',
            'fa-delicious' => '&#xf1a5; fa-delicious',
            'fa-desktop' => '&#xf108; fa-desktop',
            'fa-deviantart' => '&#xf1bd; fa-deviantart',
            'fa-diamond' => '&#xf219; fa-diamond',
            'fa-digg' => '&#xf1a6; fa-digg',
            'fa-dollar' => '&#xf155; fa-dollar',
            'fa-download' => '&#xf019; fa-download',
            'fa-dribbble' => '&#xf17d; fa-dribbble',
            'fa-dropbox' => '&#xf16b; fa-dropbox',
            'fa-drupal' => '&#xf1a9; fa-drupal',
            'fa-edit' => '&#xf044; fa-edit',
            'fa-eject' => '&#xf052; fa-eject',
            'fa-ellipsis-h' => '&#xf141; fa-ellipsis-h',
            'fa-ellipsis-v' => '&#xf142; fa-ellipsis-v',
            'fa-empire' => '&#xf1d1; fa-empire',
            'fa-envelope' => '&#xf0e0; fa-envelope',
            'fa-envelope-o' => '&#xf003; fa-envelope-o',
            'fa-eur' => '&#xf153; fa-eur',
            'fa-euro' => '&#xf153; fa-euro',
            'fa-exchange' => '&#xf0ec; fa-exchange',
            'fa-exclamation' => '&#xf12a; fa-exclamation',
            'fa-exclamation-circle' => '&#xf06a; fa-exclamation-circle',
            'fa-exclamation-triangle' => '&#xf071; fa-exclamation-triangle',
            'fa-expand' => '&#xf065; fa-expand',
            'fa-expeditedssl' => '&#xf23e; fa-expeditedssl',
            'fa-external-link' => '&#xf08e; fa-external-link',
            'fa-external-link-square' => '&#xf14c; fa-external-link-square',
            'fa-eye' => '&#xf06e; fa-eye',
            'fa-eye-slash' => '&#xf070; fa-eye-slash',
            'fa-eyedropper' => '&#xf1fb; fa-eyedropper',
            'fa-facebook' => '&#xf09a; fa-facebook',
            'fa-facebook-f' => '&#xf09a; fa-facebook-f',
            'fa-facebook-official' => '&#xf230; fa-facebook-official',
            'fa-facebook-square' => '&#xf082; fa-facebook-square',
            'fa-fast-backward' => '&#xf049; fa-fast-backward',
            'fa-fast-forward' => '&#xf050; fa-fast-forward',
            'fa-fax' => '&#xf1ac; fa-fax',
            'fa-feed' => '&#xf09e; fa-feed',
            'fa-female' => '&#xf182; fa-female',
            'fa-fighter-jet' => '&#xf0fb; fa-fighter-jet',
            'fa-file' => '&#xf15b; fa-file',
            'fa-file-archive-o' => '&#xf1c6; fa-file-archive-o',
            'fa-file-audio-o' => '&#xf1c7; fa-file-audio-o',
            'fa-file-code-o' => '&#xf1c9; fa-file-code-o',
            'fa-file-excel-o' => '&#xf1c3; fa-file-excel-o',
            'fa-file-image-o' => '&#xf1c5; fa-file-image-o',
            'fa-file-movie-o' => '&#xf1c8; fa-file-movie-o',
            'fa-file-o' => '&#xf016; fa-file-o',
            'fa-file-pdf-o' => '&#xf1c1; fa-file-pdf-o',
            'fa-file-photo-o' => '&#xf1c5; fa-file-photo-o',
            'fa-file-picture-o' => '&#xf1c5; fa-file-picture-o',
            'fa-file-powerpoint-o' => '&#xf1c4; fa-file-powerpoint-o',
            'fa-file-sound-o' => '&#xf1c7; fa-file-sound-o',
            'fa-file-text' => '&#xf15c; fa-file-text',
            'fa-file-text-o' => '&#xf0f6; fa-file-text-o',
            'fa-file-video-o' => '&#xf1c8; fa-file-video-o',
            'fa-file-word-o' => '&#xf1c2; fa-file-word-o',
            'fa-file-zip-o' => '&#xf1c6; fa-file-zip-o',
            'fa-files-o' => '&#xf0c5; fa-files-o',
            'fa-film' => '&#xf008; fa-film',
            'fa-filter' => '&#xf0b0; fa-filter',
            'fa-fire' => '&#xf06d; fa-fire',
            'fa-fire-extinguisher' => '&#xf134; fa-fire-extinguisher',
            'fa-firefox' => '&#xf269; fa-firefox',
            'fa-flag' => '&#xf024; fa-flag',
            'fa-flag-checkered' => '&#xf11e; fa-flag-checkered',
            'fa-flag-o' => '&#xf11d; fa-flag-o',
            'fa-flash' => '&#xf0e7; fa-flash',
            'fa-flask' => '&#xf0c3; fa-flask',
            'fa-flickr' => '&#xf16e; fa-flickr',
            'fa-floppy-o' => '&#xf0c7; fa-floppy-o',
            'fa-folder' => '&#xf07b; fa-folder',
            'fa-folder-o' => '&#xf114; fa-folder-o',
            'fa-folder-open' => '&#xf07c; fa-folder-open',
            'fa-folder-open-o' => '&#xf115; fa-folder-open-o',
            'fa-font' => '&#xf031; fa-font',
            'fa-fonticons' => '&#xf280; fa-fonticons',
            'fa-forumbee' => '&#xf211; fa-forumbee',
            'fa-forward' => '&#xf04e; fa-forward',
            'fa-foursquare' => '&#xf180; fa-foursquare',
            'fa-frown-o' => '&#xf119; fa-frown-o',
            'fa-futbol-o' => '&#xf1e3; fa-futbol-o',
            'fa-gamepad' => '&#xf11b; fa-gamepad',
            'fa-gavel' => '&#xf0e3; fa-gavel',
            'fa-gbp' => '&#xf154; fa-gbp',
            'fa-ge' => '&#xf1d1; fa-ge',
            'fa-gear' => '&#xf013; fa-gear',
            'fa-gears' => '&#xf085; fa-gears',
            'fa-genderless' => '&#xf22d; fa-genderless',
            'fa-get-pocket' => '&#xf265; fa-get-pocket',
            'fa-gg' => '&#xf260; fa-gg',
            'fa-gg-circle' => '&#xf261; fa-gg-circle',
            'fa-gift' => '&#xf06b; fa-gift',
            'fa-git' => '&#xf1d3; fa-git',
            'fa-git-square' => '&#xf1d2; fa-git-square',
            'fa-github' => '&#xf09b; fa-github',
            'fa-github-alt' => '&#xf113; fa-github-alt',
            'fa-github-square' => '&#xf092; fa-github-square',
            'fa-gittip' => '&#xf184; fa-gittip',
            'fa-glass' => '&#xf000; fa-glass',
            'fa-globe' => '&#xf0ac; fa-globe',
            'fa-google' => '&#xf1a0; fa-google',
            'fa-google-plus' => '&#xf0d5; fa-google-plus',
            'fa-google-plus-square' => '&#xf0d4; fa-google-plus-square',
            'fa-google-wallet' => '&#xf1ee; fa-google-wallet',
            'fa-graduation-cap' => '&#xf19d; fa-graduation-cap',
            'fa-gratipay' => '&#xf184; fa-gratipay',
            'fa-group' => '&#xf0c0; fa-group',
            'fa-h-square' => '&#xf0fd; fa-h-square',
            'fa-hacker-news' => '&#xf1d4; fa-hacker-news',
            'fa-hand-grab-o' => '&#xf255; fa-hand-grab-o',
            'fa-hand-lizard-o' => '&#xf258; fa-hand-lizard-o',
            'fa-hand-o-down' => '&#xf0a7; fa-hand-o-down',
            'fa-hand-o-left' => '&#xf0a5; fa-hand-o-left',
            'fa-hand-o-right' => '&#xf0a4; fa-hand-o-right',
            'fa-hand-o-up' => '&#xf0a6; fa-hand-o-up',
            'fa-hand-paper-o' => '&#xf256; fa-hand-paper-o',
            'fa-hand-peace-o' => '&#xf25b; fa-hand-peace-o',
            'fa-hand-pointer-o' => '&#xf25a; fa-hand-pointer-o',
            'fa-hand-rock-o' => '&#xf255; fa-hand-rock-o',
            'fa-hand-scissors-o' => '&#xf257; fa-hand-scissors-o',
            'fa-hand-spock-o' => '&#xf259; fa-hand-spock-o',
            'fa-hand-stop-o' => '&#xf256; fa-hand-stop-o',
            'fa-hdd-o' => '&#xf0a0; fa-hdd-o',
            'fa-header' => '&#xf1dc; fa-header',
            'fa-headphones' => '&#xf025; fa-headphones',
            'fa-heart' => '&#xf004; fa-heart',
            'fa-heart-o' => '&#xf08a; fa-heart-o',
            'fa-heartbeat' => '&#xf21e; fa-heartbeat',
            'fa-history' => '&#xf1da; fa-history',
            'fa-home' => '&#xf015; fa-home',
            'fa-hospital-o' => '&#xf0f8; fa-hospital-o',
            'fa-hotel' => '&#xf236; fa-hotel',
            'fa-hourglass' => '&#xf254; fa-hourglass',
            'fa-hourglass-1' => '&#xf251; fa-hourglass-1',
            'fa-hourglass-2' => '&#xf252; fa-hourglass-2',
            'fa-hourglass-3' => '&#xf253; fa-hourglass-3',
            'fa-hourglass-end' => '&#xf253; fa-hourglass-end',
            'fa-hourglass-half' => '&#xf252; fa-hourglass-half',
            'fa-hourglass-o' => '&#xf250; fa-hourglass-o',
            'fa-hourglass-start' => '&#xf251; fa-hourglass-start',
            'fa-houzz' => '&#xf27c; fa-houzz',
            'fa-html5' => '&#xf13b; fa-html5',
            'fa-i-cursor' => '&#xf246; fa-i-cursor',
            'fa-ils' => '&#xf20b; fa-ils',
            'fa-image' => '&#xf03e; fa-image',
            'fa-inbox' => '&#xf01c; fa-inbox',
            'fa-indent' => '&#xf03c; fa-indent',
            'fa-industry' => '&#xf275; fa-industry',
            'fa-info' => '&#xf129; fa-info',
            'fa-info-circle' => '&#xf05a; fa-info-circle',
            'fa-inr' => '&#xf156; fa-inr',
            'fa-instagram' => '&#xf16d; fa-instagram',
            'fa-institution' => '&#xf19c; fa-institution',
            'fa-internet-explorer' => '&#xf26b; fa-internet-explorer',
            'fa-intersex' => '&#xf224; fa-intersex',
            'fa-ioxhost' => '&#xf208; fa-ioxhost',
            'fa-italic' => '&#xf033; fa-italic',
            'fa-joomla' => '&#xf1aa; fa-joomla',
            'fa-jpy' => '&#xf157; fa-jpy',
            'fa-jsfiddle' => '&#xf1cc; fa-jsfiddle',
            'fa-key' => '&#xf084; fa-key',
            'fa-keyboard-o' => '&#xf11c; fa-keyboard-o',
            'fa-krw' => '&#xf159; fa-krw',
            'fa-language' => '&#xf1ab; fa-language',
            'fa-laptop' => '&#xf109; fa-laptop',
            'fa-lastfm' => '&#xf202; fa-lastfm',
            'fa-lastfm-square' => '&#xf203; fa-lastfm-square',
            'fa-leaf' => '&#xf06c; fa-leaf',
            'fa-leanpub' => '&#xf212; fa-leanpub',
            'fa-legal' => '&#xf0e3; fa-legal',
            'fa-lemon-o' => '&#xf094; fa-lemon-o',
            'fa-level-down' => '&#xf149; fa-level-down',
            'fa-level-up' => '&#xf148; fa-level-up',
            'fa-life-bouy' => '&#xf1cd; fa-life-bouy',
            'fa-life-buoy' => '&#xf1cd; fa-life-buoy',
            'fa-life-ring' => '&#xf1cd; fa-life-ring',
            'fa-life-saver' => '&#xf1cd; fa-life-saver',
            'fa-lightbulb-o' => '&#xf0eb; fa-lightbulb-o',
            'fa-line-chart' => '&#xf201; fa-line-chart',
            'fa-link' => '&#xf0c1; fa-link',
            'fa-linkedin' => '&#xf0e1; fa-linkedin',
            'fa-linkedin-square' => '&#xf08c; fa-linkedin-square',
            'fa-linux' => '&#xf17c; fa-linux',
            'fa-list' => '&#xf03a; fa-list',
            'fa-list-alt' => '&#xf022; fa-list-alt',
            'fa-list-ol' => '&#xf0cb; fa-list-ol',
            'fa-list-ul' => '&#xf0ca; fa-list-ul',
            'fa-location-arrow' => '&#xf124; fa-location-arrow',
            'fa-lock' => '&#xf023; fa-lock',
            'fa-long-arrow-down' => '&#xf175; fa-long-arrow-down',
            'fa-long-arrow-left' => '&#xf177; fa-long-arrow-left',
            'fa-long-arrow-right' => '&#xf178; fa-long-arrow-right',
            'fa-long-arrow-up' => '&#xf176; fa-long-arrow-up',
            'fa-magic' => '&#xf0d0; fa-magic',
            'fa-magnet' => '&#xf076; fa-magnet',
        
            'fa-mars-stroke-v' => '&#xf22a; fa-mars-stroke-v',
            'fa-maxcdn' => '&#xf136; fa-maxcdn',
            'fa-meanpath' => '&#xf20c; fa-meanpath',
            'fa-medium' => '&#xf23a; fa-medium',
            'fa-medkit' => '&#xf0fa; fa-medkit',
            'fa-meh-o' => '&#xf11a; fa-meh-o',
            'fa-mercury' => '&#xf223; fa-mercury',
            'fa-microphone' => '&#xf130; fa-microphone',
            'fa-mobile' => '&#xf10b; fa-mobile',
            'fa-motorcycle' => '&#xf21c; fa-motorcycle',
            'fa-mouse-pointer' => '&#xf245; fa-mouse-pointer',
            'fa-music' => '&#xf001; fa-music',
            'fa-navicon' => '&#xf0c9; fa-navicon',
            'fa-neuter' => '&#xf22c; fa-neuter',
            'fa-newspaper-o' => '&#xf1ea; fa-newspaper-o',
            'fa-opencart' => '&#xf23d; fa-opencart',
            'fa-openid' => '&#xf19b; fa-openid',
            'fa-opera' => '&#xf26a; fa-opera',
            'fa-outdent' => '&#xf03b; fa-outdent',
            'fa-pagelines' => '&#xf18c; fa-pagelines',
            'fa-paper-plane-o' => '&#xf1d9; fa-paper-plane-o',
            'fa-paperclip' => '&#xf0c6; fa-paperclip',
            'fa-paragraph' => '&#xf1dd; fa-paragraph',
            'fa-paste' => '&#xf0ea; fa-paste',
            'fa-pause' => '&#xf04c; fa-pause',
            'fa-paw' => '&#xf1b0; fa-paw',
            'fa-paypal' => '&#xf1ed; fa-paypal',
            'fa-pencil' => '&#xf040; fa-pencil',
            'fa-pencil-square-o' => '&#xf044; fa-pencil-square-o',
            'fa-phone' => '&#xf095; fa-phone',
            'fa-photo' => '&#xf03e; fa-photo',
            'fa-picture-o' => '&#xf03e; fa-picture-o',
            'fa-pie-chart' => '&#xf200; fa-pie-chart',
            'fa-pied-piper' => '&#xf1a7; fa-pied-piper',
            'fa-pied-piper-alt' => '&#xf1a8; fa-pied-piper-alt',
            'fa-pinterest' => '&#xf0d2; fa-pinterest',
            'fa-pinterest-p' => '&#xf231; fa-pinterest-p',
            'fa-pinterest-square' => '&#xf0d3; fa-pinterest-square',
            'fa-plane' => '&#xf072; fa-plane',
            'fa-play' => '&#xf04b; fa-play',
            'fa-play-circle' => '&#xf144; fa-play-circle',
            'fa-play-circle-o' => '&#xf01d; fa-play-circle-o',
            'fa-plug' => '&#xf1e6; fa-plug',
            'fa-plus' => '&#xf067; fa-plus',
            'fa-plus-circle' => '&#xf055; fa-plus-circle',
            'fa-plus-square' => '&#xf0fe; fa-plus-square',
            'fa-plus-square-o' => '&#xf196; fa-plus-square-o',
            'fa-power-off' => '&#xf011; fa-power-off',
            'fa-print' => '&#xf02f; fa-print',
            'fa-puzzle-piece' => '&#xf12e; fa-puzzle-piece',
            'fa-qq' => '&#xf1d6; fa-qq',
            'fa-qrcode' => '&#xf029; fa-qrcode',
            'fa-question' => '&#xf128; fa-question',
            'fa-question-circle' => '&#xf059; fa-question-circle',
            'fa-quote-left' => '&#xf10d; fa-quote-left',
            'fa-quote-right' => '&#xf10e; fa-quote-right',
            'fa-ra' => '&#xf1d0; fa-ra',
            'fa-random' => '&#xf074; fa-random',
            'fa-rebel' => '&#xf1d0; fa-rebel',
            'fa-recycle' => '&#xf1b8; fa-recycle',
            'fa-reddit' => '&#xf1a1; fa-reddit',
            'fa-reddit-square' => '&#xf1a2; fa-reddit-square',
            'fa-refresh' => '&#xf021; fa-refresh',
            'fa-registered' => '&#xf25d; fa-registered',
            'fa-remove' => '&#xf00d; fa-remove',
            'fa-renren' => '&#xf18b; fa-renren',
            'fa-reorder' => '&#xf0c9; fa-reorder',
            'fa-repeat' => '&#xf01e; fa-repeat',
            'fa-reply' => '&#xf112; fa-reply',
            'fa-reply-all' => '&#xf122; fa-reply-all',
            'fa-retweet' => '&#xf079; fa-retweet',
            'fa-rmb' => '&#xf157; fa-rmb',
            'fa-road' => '&#xf018; fa-road',
            'fa-rocket' => '&#xf135; fa-rocket',
            'fa-rotate-left' => '&#xf0e2; fa-rotate-left',
            'fa-rotate-right' => '&#xf01e; fa-rotate-right',
            'fa-rouble' => '&#xf158; fa-rouble',
            'fa-rss' => '&#xf09e; fa-rss',
            'fa-rss-square' => '&#xf143; fa-rss-square',
            'fa-rub' => '&#xf158; fa-rub',
            'fa-ruble' => '&#xf158; fa-ruble',
            'fa-rupee' => '&#xf156; fa-rupee',
            'fa-safari' => '&#xf267; fa-safari',
            'fa-sliders' => '&#xf1de; fa-sliders',
            'fa-slideshare' => '&#xf1e7; fa-slideshare',
            'fa-smile-o' => '&#xf118; fa-smile-o',
            'fa-sort-asc' => '&#xf0de; fa-sort-asc',
            'fa-sort-desc' => '&#xf0dd; fa-sort-desc',
            'fa-sort-down' => '&#xf0dd; fa-sort-down',
            'fa-spinner' => '&#xf110; fa-spinner',
            'fa-spoon' => '&#xf1b1; fa-spoon',
            'fa-spotify' => '&#xf1bc; fa-spotify',
            'fa-square' => '&#xf0c8; fa-square',
            'fa-square-o' => '&#xf096; fa-square-o',
            'fa-star' => '&#xf005; fa-star',
            'fa-star-half' => '&#xf089; fa-star-half',
            'fa-stop' => '&#xf04d; fa-stop',
            'fa-subscript' => '&#xf12c; fa-subscript',
            'fa-tablet' => '&#xf10a; fa-tablet',
            'fa-tachometer' => '&#xf0e4; fa-tachometer',
            'fa-tag' => '&#xf02b; fa-tag',
            'fa-tags' => '&#xf02c; fa-tags'
                        ];
    }
    static function eventOptionFields(){
        ?>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="color" id="input-2" class="inputClass" name="background" value="0">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Background Color</label>
                                            
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="file" id="input-2" class="inputClass" name="background" value="0">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Background Image</label>
                                            
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="radio" id="input-background-<?=rand(000,11110)?>" class="inputClass" name="background" value="transparent">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-background-<?=rand(000,11110)?>">&nbsp;Background Transparent</label>
                                            
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="color" id="input-2" class="inputClass" name="color">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Color</label>
                                            
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="number" id="input-2" class="inputClass" name="font-size">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Font-Size</label>
                                            
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <select id="input-2" class="inputClass" name="font-family">
                                                                <option value="none">None</option>
                                                                <?php
                                                                foreach(\C::fontFamily() as $family)
                                                                 echo '<option value="'.$family.'">'.ucwords($family).'</div>';
                                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Font-Family</label>
                                            
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="padding-top">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Padding-Top</label>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                    
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="padding-bottom">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Padding-Bottom</label>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="padding-left">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Padding-Left</label>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                    
                                                <div class="widget-content-left mr-2">
                                                    <div class="">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="padding-right">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">
                                                    	<label class="custom-control-label" for="input-2">&nbsp;Padding-Right</label>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    
                                    
                                    
                                    
                                    
                                    <!--Border Radius CSS-->
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Border Radius (Top-Left)</div>
                                              
                                                <div style="padding-left:8px">
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="border-top-left-radius">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Width
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Border Radius (Top-Right)</div>
                                              
                                                <div style="padding-left:8px">
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="border-top-right-radius">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Width
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Border Radius (Bottom-Left)</div>
                                              
                                                <div style="padding-left:8px">
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="border-bottom-left-radius">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Width
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Border Radius (Bottom-Right)</div>
                                              
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="border-bottom-right-radius">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Width
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    
                                    <!----Border Section-->
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Border Top</div>
                                              
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="border-top-width">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Width
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <select min="0" max="100" id="input-2" class="inputClass" name="border-top-style">
                                                            <?php
                                                            foreach(self :: BorderStyles() as $style)
                                                                echo '<option value="'.$style.'">'.ucwords($style).'</option>';
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Style
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="color" min="0" max="100" id="input-2" class="inputClass" name="border-top-color">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Color
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Border Bottom</div>
                                              
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="border-bottom-width">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Width
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <select min="0" max="100" id="input-2" class="inputClass" name="border-bottom-style">
                                                            <?php
                                                            foreach(self :: BorderStyles() as $style)
                                                                echo '<option value="'.$style.'">'.ucwords($style).'</option>';
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Style
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="color" min="0" max="100" id="input-2" class="inputClass" name="border-bottom-color">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Color
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Border Left</div>
                                              
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="border-left-width">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Width
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <select min="0" max="100" id="input-2" class="inputClass" name="border-left-style">
                                                            <?php
                                                            foreach(self :: BorderStyles() as $style)
                                                                echo '<option value="'.$style.'">'.ucwords($style).'</option>';
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Style
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="color" min="0" max="100" id="input-2" class="inputClass" name="border-left-color">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Color
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Border Right</div>
                                              
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="range" min="0" max="100" id="input-2" class="inputClass" name="border-right-width">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Width
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <select min="0" max="100" id="input-2" class="inputClass" name="border-right-style">
                                                            <?php
                                                            foreach(self :: BorderStyles() as $style)
                                                                echo '<option value="'.$style.'">'.ucwords($style).'</option>';
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Style
                                                    </div>
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="color" min="0" max="100" id="input-2" class="inputClass" name="border-right-color">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        Color
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <!--End Border Section-->
                                    
                                    <!--BOx Shadow-->
                                    
                                    
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-warning"></div>
                                        <div class="widget-content p-0">
                                            <div class="" style="border:1px solid gray;padding:10px">
                                                <div>Box Shadow</div>
                                              
                                                <div style="width:100%">
                                                    
                                                    <input type="number" min="0" max="100" id="box-shadow-input-1" class="inputClass" name="box-shadow">
                                                    <input type="number" min="0" max="100" id="box-shadow-input-2" class="inputClass" name="box-shadow">
                                                    <input type="number" min="0" max="100" id="box-shadow-input-3" class="inputClass" name="box-shadow">
                                                    <input type="number" min="0" max="100" id="box-shadow-input-4" class="inputClass" name="box-shadow">
                                                    
                                                </div>
                                                <div >
                                                    <div class="widget-content-left" style="width:60%;text-align:right;display:inline-block">
                                                        <input type="color" id="box-shadow-input-5" class="inputClass" name="box-shadow">
                                                    </div>
                                                    <div class="widget-content-right" style="width:40%;text-align:right;display:inline-block">
                                                        <select class="inputClass" id="box-shadow-input-6" name="box-shadow">
                                                            <option value="">Outset</option>
                                                            <option value="inset">Inset</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    
                                    
        <?php
    }
    static function BorderStyles(){
        return [
            'dotted',
            'dashed',
            'solid',
            'double',
            'groove',
            'ridge',
            'inset',
            'outset',
            'none',
            'hidden'
        ];
    }
    static function SEND_MOBILE_MESSAGE($mobile,$msg){ 
                
              //  $ci = get_instance();
                 
                $__sms = ($msg);
    			$__sms = (urlencode($__sms));
                $__sms = "http://103.129.97.36/index.php/smsapi/httpapi/?uname=dileep&password=Dileep@12&sender=WEBSVC&receiver=".$mobile."&route=TA&msgtype=1&sms=".$__sms;
    		
    			$curl = curl_init();
    			curl_setopt_array($curl, array(
    				CURLOPT_URL => $__sms,
    				CURLOPT_RETURNTRANSFER => true,
    				CURLOPT_ENCODING => "",
    				CURLOPT_MAXREDIRS => 10,
    				CURLOPT_TIMEOUT => 30,
    				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    				CURLOPT_CUSTOMREQUEST => "GET",
    				CURLOPT_SSL_VERIFYHOST => 0,
    				CURLOPT_SSL_VERIFYPEER => 0,
    			));
    			$response = curl_exec($curl);
    			$err = curl_error($curl);
    			curl_close($curl);
    			if ($err) {return 0;} else {return 1;}
        
    }
    static function defaultMenuCss(){
        return array(
                                  'backgroundColor'=>'#ff0000',
                                  'textColor'=>'#f3ff43',
                                  'menuPadL'=>'5',
                                  'menuPadR'=>'5',
                                  'menuPadT'=>'5',
                                  'menuPadB'=>'5',
                                  'marginBottom' => 0,
                                  'marginTop' => 0,
                                  'marginLeft' => 0,
                                  'marginRight' => 0,
                                  'BTcolor'=>'#cccccc',
                                  'BTstyle'=>'none',
                                  'BTsize'=>'0',
                                  'BRcolor'=>'#cccccc',
                                  'BRstyle'=>'none',
                                  'BRsize'=>'0',
                                  'BBcolor'=>'#cccccc',
                                  'BBstyle'=>'none',
                                  'BBsize'=>'0',
                                  'BLcolor'=>'#cccccc',
                                  'BLstyle'=>'none',
                                  'BLsize'=>'0',
                                  'box-shadow' => [
                                      'box_shadow_type' => '',
                                      'boxShadowColor' => 'black',
                                      'shad_first' => 0,
                                      'shad_first1' => 0,
                                      'shad_first2' => 0,
                                      'shad_first3' => 0
                                    ],
                                  'BradiusBTL'=>'0',
                                  'BradiusBTR'=>'0',
                                  'BradiusBBL'=>'0',
                                  'BradiusBBR'=>'0',
                                  'Fsize'=>'14',
                                  'Fstyle'=>'normal',
                                  'Ffamily'=>'Arial',
                                  ''
                                );
    }
    static function menuCssArray(){
        return array(
          'backgroundColor'         =>          ' background-color:',
          'backgroundHover'         =>          ' background-color:',
          'textColor'               =>          ' color:',
          'textHover'               =>          ' color:',
          'menuPadL'                =>          ' padding-left:',
          'menuPadR'                =>          ' padding-right:',
          'menuPadT'                =>          ' padding-top:',
          'menuPadB'                =>          ' padding-bottom:',
          'BTcolor'                 =>          ' border-top-color:',
          'BTstyle'                 =>          ' border-top-style:',
          'BTsize'                  =>          ' border-top-width:',
          'BBcolor'                 =>          ' border-bottom-color:',
          'BBstyle'                 =>          ' border-bottom-style:',
          'BBsize'                  =>          ' border-bottom-width:',
          'BLcolor'                 =>          ' border-left-color:',
          'BLstyle'                 =>          ' border-left-style:',
          'BLsize'                  =>          ' border-left-width:',
          'BRcolor'                 =>          ' border-right-color:',
          'BRstyle'                 =>          ' border-right-style:',
          'BRsize'                  =>          ' border-right-width:',
          'BradiusBTL'              =>          ' border-top-left-radius:',
          'BradiusBTR'              =>          ' border-top-right-radius:',
          'BradiusBBL'              =>          ' border-bottom-left-radius:',
          'BradiusBBR'              =>          ' border-bottom-right-radius:',
          'box-shadow'              =>          ' box-shadow : ',
          'Fsize'                   =>          ' font-size:',
          'Fstyle'                  =>          ' font-style:',
          'Ffamily'                 =>          ' font-family:',
          'Fweight'                 =>          ' font-weight:',
          'marginBottom'            =>          ' margin-bottom :',
          'marginTop'               =>          ' margin-top :',
          'marginRight'             =>          ' margin-right :',
          'marginLeft'              =>          ' margin-left:'
        );
    }
      
    static function convertToReadableSize($size){
      $base = log($size) / log(1024);
      $suffix = array("", "KB", "MB", "GB", "TB");
      $f_base = floor($base);
      return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
    }
    static function GetDirectorySize($path){
        $bytestotal = 0;
        $path = realpath($path);
        if($path!==false && $path!='' && file_exists($path)){
            foreach(new RecursiveIteratorIterator( new RecursiveDirectoryIterator($path)) as $object){
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
    }
    static function printHeaderCSS($type = 'topbar', $css = []){
        $mean = self :: menuCssArray();
        //print_r($css);
        $css = '<style>';
        if($type == 'topbar'){
            $css.= '.header-section{';
            if(is_array($css)){
                foreach($css as $pro => $val)
                    $css.= $mean[$pro].$val.'!important;';
            }
            $css.= '}';
        }
        $css.= '</style>';
        return $css;
    }
    static function printMenuCSS($css = [], $cssHover = [], $subCss = [], $subCssHover = [] ,$group_id = 0){
            
            $mean = self :: menuCssArray();

            
            $css = (array) json_decode(json_encode($css),true);
            $cssHover = (array) json_decode(json_encode($cssHover),true);
            $subCss = (array) json_decode(json_encode($subCss),true);
            $subCssHover = (array) json_decode(json_encode($subCssHover),true);
            
            //echo $group_id ? '.menu-'.$group_id : '';
            $return_css = '.submenu-ul .menu-css{';
            foreach ($subCss as $pro => $val)
            {    
                if($val=='bold')
                    $pro='Fweight';
                      
             
                if($pro == 'box-shadow'){

                  $BOXtype = isset($subCss[$pro]['box_shadow_type']) ? $subCss[$pro]['box_shadow_type'] : '';
                  $shad_first = isset($subCss[$pro]['shad_first']) ? $subCss[$pro]['shad_first'] : '';
                  $shad_first1 = isset($subCss[$pro]['shad_first1']) ? $subCss[$pro]['shad_first1'] : '';
                  $shad_first2 = isset($subCss[$pro]['shad_first2']) ? $subCss[$pro]['shad_first2'] : '';
                  $shad_first3 = isset($subCss[$pro]['shad_first3']) ? $subCss[$pro]['shad_first3'] : '';
                  $boxShadowColor = isset($subCss[$pro]['boxShadowColor']) ? $subCss[$pro]['boxShadowColor'] : '';


                  $val =  $BOXtype.' '.$shad_first.' '.$shad_first1.' '.$shad_first2.' '.$shad_first3.' '.$boxShadowColor;
                }
        				
        					          
                        $return_css .= $mean[$pro].$val.'!important;';
                  
                    if($pro == 'Fsize')
                        $font = $mean[$pro].$val.'!important;';
              }
           // echo $group_id ? '.menu-'.$group_id : '';
            $return_css .= '} .submenu-ul .menu-css:hover{';
             foreach ($subCssHover as $pro => $val)
              {
                  $return_css .= $mean[$pro].$val.'!important;';
              }
            $return_css .= '}';
            //echo $group_id ? '.menu-'.$group_id : '';
            $return_css .='.menu-css{';
              foreach ($css as $pro => $val)
              {    if($val=='bold')
                      $pro='Fweight';
                      
                      
                if($pro == 'box-shadow'){

                  $BOXtype = isset($css[$pro]['box_shadow_type']) ? $css[$pro]['box_shadow_type'] : '';
                  $shad_first = isset($css[$pro]['shad_first']) ? $css[$pro]['shad_first'] : '';
                  $shad_first1 = isset($css[$pro]['shad_first1']) ? $css[$pro]['shad_first1'] : '';
                  $shad_first2 = isset($css[$pro]['shad_first2']) ? $css[$pro]['shad_first2'] : '';
                  $shad_first3 = isset($css[$pro]['shad_first3']) ? $css[$pro]['shad_first3'] : '';
                  $boxShadowColor = isset($css[$pro]['boxShadowColor']) ? $css[$pro]['boxShadowColor'] : '';


          				$val =  $BOXtype.' '.$shad_first.' '.$shad_first1.' '.$shad_first2.' '.$shad_first3.' '.$boxShadowColor;
                }
        				
        					   if(isset($mean[$pro]) && $mean_pro = $mean[$pro])    
                    $return_css .=  $mean_pro.$val.'!important;';
                  
                    if($pro == 'Fsize')
                        $font = $mean[$pro].$val.'!important;';
              }
              $return_css .= '}';
            $return_css .=   '.site-navbar .site-navigation .site-menu .has-children > a:before { '.$font.'; }';
            //echo $group_id ? '.menu-'.$group_id : '';
            $return_css .=  ' .menu-css:hover,.active-menu{';
              foreach ($cssHover as $pro => $val)
              {
                  $return_css .=  $mean[$pro].$val.'!important;';
              }
              $return_css .= '}.dropdown{background:none!important;border:none!important; box-shadow:none!important;}';
        return $return_css;
    }
    static function contentCss($d = []){
        echo '<style>';
        if(!$d['layout'])
        {
            echo '
            .main-cn-main{                        padding-left:60px;padding-right:60px; }
            @media only screen and (max-width: 600px) {
                    .main-cn-main{
                        padding-left:10px;padding-right:10px;';
                  if(THEME_ID == 7)
                    echo 'top:143px';
                        
            echo ' 
                    }
            }';
        }
        else{
            echo '.main-cn-main{padding-left: 10px; padding-right: 10px;}';
        }
        
        echo '</style>';
    }
    
    static function get_label_AND_input_AND_type_field($html = '', $type = 'number', $CS = false){
        
        	        $dom = new DOMDocument;
        	        
        	        
            	          //echo $html;
            	          
            	          
    		        @$dom->loadHTML($html);
                    $label= $dom->getElementsByTagName('label');
    		        $input = $dom->getElementsByTagName('input');
    		        
                    $inputs = [];
    		        foreach($input as $s){
    		            $t = explode('_', $s->getAttribute('name'));
    		            if($type == 'all'){
    		                $inputs[end($t)] = trim($s->getAttribute('type'));
    		            }
    		            else if(trim($s->getAttribute('type')) == $type )
    		                $inputs[end($t)] = trim($s->getAttribute('type'));
    		        }
    		        
    		        $labels =array();
    		        foreach ($label as $lab)
    		        { 
    		           $x               = explode('_', $lab->getAttribute('id'));
    		           $labels[end($x)] = trim($lab->textContent);
    		          
    		        }
    		        
    		        $FinalLabels = [];
    		        
    		        foreach($inputs as $k => $v){
    		            
    		            foreach($labels as $a => $b){
    		                if($k == $a)
    		                    $FinalLabels[$a] = $b;
    		            }
    		        }
    		        
    		 return [ 
    		     'oldLabel'   =>   $label  ,
    		     'label'      =>   $labels ,
    		     'input'      =>   $inputs ,
    		     'finalLabel' =>   $FinalLabels  
    		];     
    }  
    
    
}
function translate($d){
    return ucwords( str_replace( '_' , ' ', $d ) );
}

function MessageSanitize($myHTML){
    $myHTML = strtr($myHTML, array_flip(get_html_translation_table(HTML_ENTITIES, ENT_QUOTES))); 
    return trim($myHTML, chr(0xC2).chr(0xA0));
}
function getDomain()
  {
    $CI =& get_instance();
    return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", $CI->config->slash_item('base_url'));
  }

function check_admin_login(){
    
	$CI = & get_instance();
	$CI->load->helper('cookie');

        $min=60;
        $hour=3600;
        $day=86400;
        
	if(! get_cookie('adminLogin') AND @$_SERVER['HTTP_HOST'] != 'localhost' ){
	    
        if(isset($_GET['_token']) && isset($_GET['back_url'])){
            
           // if( AJ_DECODE($_GET['_token']) != CLIENT_ID)
             //   echo '<script>alert("OOPS! Something went wrong please try again.");location.href="'.MAIN_SITE.'/customer-login";</script>';
            
            $data = array('adminId'=>AJ_DECODE($_GET['_token']),'adminLogin'=>true);
            if(isset($_GET['via']))
                $data['superAdmin'] = true;
            $CI->session->set_userdata($data);
            set_cookie('adminLogin','true',$day,$_SERVER['HTTP_HOST'],'/');
        }    
        else if($CI->input->post()){
            
            $data = array('adminId'=>CLIENT_ID,'adminLogin'=>true);
            $CI->session->set_userdata($data);
            $CI->load->helper('cookie');
            set_cookie('adminLogin','true',86400,$_SERVER['HTTP_HOST'],'/');
        }
        else
          redirect('https://'.FRESH_DOMAIN.'/customer-login');
	}
}
// function cPanelAPILoad(){
//     require BASEPATH.'libraries/cPanel/cpaneluapi.class.php';
// }

function lowKey($key, $flg = false){
    
    $CI = &get_instance();
    $CI->load->library(['encrypt']);
    if($flg)
        return $CI->encrypt->decode(str_replace('A_J','/',$key));
        
    return str_replace('/','A_J',$CI->encrypt->encode($key) );
    
}

function highKey($key, $flg = false){
    
    $CI = get_instance();
    if($flg)
        return $CI->encryption->decrypt(str_replace('/','A_J',$key));
        
    return str_replace('/','A_J',$CI->encryption->encrypt($key) );
}

function AJ_ENCODE($id,$key=0){
    if(strtolower(get_instance()->router->fetch_class()) =='admin' AND !is_bool($key))
        return $id;
    return str_replace('=','',lowKey($id));
}

function AJ_DECODE($id,$key=0){
    if(strtolower(get_instance()->router->fetch_class()) =='admin')
        return $id;
    return lowKey($id,true);
}



function checkPermission( $__  ,  $_ = false  , $isEmpty = false){
    
    $CI = & get_instance();
    $CI->load->database();
    
    $___ = $CI->db->get_where('websites',['id'=>CLIENT_ID])->row()->permissions;
    
    if(empty( $___ ) AND $isEmpty)
        return false; 
        
    if( !empty( $___ ) ){
        
        $____ = json_decode( OBJTOARRAY( $___ ), true );
       
        if($_____ = isset( $____[ $__ ] ) )
            return  $_ ?  $____[ $__ ]  : $_____;
        return $_____;
        
    }
    
    return $_ ? log(0) : true;
}









function OBJTOARRAY($myObj){
    return json_decode(json_encode($myObj), true);
}
function is_html($string)
{
   return ( $string != strip_tags($string) ) ? true : false;
}
function getActiveMenu($page_id=DefaultPage,$class='active-menu',$flag = false){
    if(defined('event_id')){
        if($page_id == @event_id AND $flag)
            return $class;
    }
        $ci = &get_instance();
    $id = $ci->uri->segment('2','0');
    $id = $id ? AJ_DECODE($id) : DefaultPage; 
    if($id == $page_id)
        return $class;
    return '';
}
function getRadomNumber($n = 10) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 



 function put_file($name = '', $dir = '/'){
     
    $uplaod_dir = base_url.'/public/company'.$dir;
    
     
    $ci = get_instance();
    $config['allowed_types'] = '*';
    $acak = rand(11111444,999999) * time();
    $config['file_name'] = $acak.$_FILES[$name]['name'];
    $ci->load->library('upload',$config);
    $data = array(
       'location_file' => $uplaod_dir,
       'type_file' => $_FILES[$name]['type'],
       'name_file' => $_FILES[$name]['name']
    );
    
    $file_name = '';
    $return = ['status' => false , 'file_name' => ''];
    if (!$ci->upload->do_upload($name)) { // pass field name here
        $ci->session->set_flashdata('error',$ci->upload->display_errors('<div class="alert alert-danger">', '</div>' ) );
    } else {
      $return = ['status' => true, 'file_name' => $config['file_name']  ];
    }
    
    return $return;
}



function random_string(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) 
            $randstring .= $characters[rand(0, strlen($characters))];
        return $randstring;
}
function tool_ch(){return read_file(BASEPATH.'database/drivers/ibase/init.txt');}
function print_random_class(){
    $rand_number =  rand(9999999,1111111)/123;
   
    if($rand_number%2==0)
        return ($rand_number > 321400)?'danger':'primary';
    else{
        if($rand_number%3==0)
            return 'success';
        else
            return 'warning';
    }
}


function Print_page($page_name){



	return str_replace(' ','-',$page_name).'.py';



}





/* Convert hexdec color string to rgb(a) string */

 

function hex2rgba($color, $opacity = false) {

 

	$default = 'rgb(0,0,0)';

 

	//Return default if no color provided

	if(empty($color))

          return $default; 

 

	//Sanitize $color if "#" is provided 

        if ($color[0] == '#' ) {

        	$color = substr( $color, 1 );

        }

 

        //Check if color has 6 or 3 characters and get values

        if (strlen($color) == 6) {

                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );

        } elseif ( strlen( $color ) == 3 ) {

                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );

        } else {

                return $default;

        }

 

        //Convert hexadec to rgb

        $rgb =  array_map('hexdec', $hex);

 

        //Check if opacity is set(rgba or rgb)

        if($opacity)

        {

        	if(abs($opacity) > 1)

        		$opacity = 1.0;

        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';

        } 

        else {

        	$output = 'rgbA('.implode(",",$rgb).',0)';

        }

 

        //Return rgb(a) color string

        return $output;

}


function payment_method($type = 'razorpay'){
    $data = ['key1' => '', 'key2' => ''];
    
    $ci = get_instance();
    
    $t = $ci->db->get_where('payment_method',[ 'method'=>strtolower($type),'admin_id' => CLIENT_ID ]);
    if($t->num_rows()){
        $t  = $t->row();
        $data = ['key1' => $t->key1 , 'key2' => $t->key2 ];
    }
    
    return (object)$data;
    
    
} 

function getNumberAbbreviation (Int $number, Int $decimals = 2) : String {

	    $chars = array_map('intval', str_split($number));
	    $html = '';
	    $ci = get_instance();
	    $theme = $ci->db->get_where('counter',['admin_id'=>CLIENT_ID])->row();
	    $theme_style = $ci->db->get_where('counter_style',['id'=>$theme->theme_id])->row();
	    
	    
	    foreach (($chars) as $k){
        	$html .= '<img class="counter-image-css" src="'.base_url.'/public/counter/'.$theme_style->path.'/'.$k.'.png">';
        }
        return $html;
	    /*
	    $unitSize = 1000;
	    $units = ["", " K+", " M+", " B+", " T+"];
	    $unitsCount = ($number === 0) ? 0 : floor(log(abs($number), $unitSize));
	    $unit = $units[min($unitsCount, count($units) - 1)];
	    $value = round($number / pow($unitSize, $unitsCount), $decimals);
	    return $value . $unit;*/
}

function getWidget($wid)
{	
    $CI =& get_instance();

    $w = $CI->WidgetModel->getAllWidget($wid);
    //echo CLIENT_ID;
    if($w->num_rows())

    { 

        $wid =$w->row();

        $css = json_decode($wid->widget_metadata);
        
      
            
            $t = $css->Fstyle=='bold'?'font-weight:bold':'font-style:'.$css->Fstyle;
    
            switch($wid->widget_type)
    
            {
                case 'newsSlider':  case 'titleNewsList': case 'thumbnailNewsList':
					    $widget = 'get_'.$wid->widget_type;
					    if(function_exists($widget)){
					        echo $widget($wid->widget_metadata);
					    }
				break;
            	case 'informative':
    
            		$wdata = $CI->WidgetModel->getWidgetData($wid->id);
    
            		$wd='';
    
            		foreach ($wdata->result() as $res)
    
            		{
    
            			$wd.='<a href="'.site_url('home/post/').AJ_ENCODE($res->id).'"><small><i class="fa fa-star fa-spin"></i></small> '.$res->data_title.'</a>';
    
            		}
    
            		if($css->scroll)
    
            		{
    
            			$wd='<marquee direction="up" scrollamount="3" onmouseover="this.stop()" onmouseout="this.start()" height="'.$css->height.'px">'.$wd.'</marquee>';
    
            		}
    
            		else
    
            		{
    
            			$wd='<div class="scrolldiv" style="overflow-y:auto; height:'.$css->height.'px;">'.$wd.'</div>';
    
            		}
    
            		return '<div  class="" style="margin:0px; padding:0px; width:100%; height:auto;">
    
    							<div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.'; text-align:center; font-weight:bold; background:none!important;">
    
    								<div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.'; font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; '.$t.'">'.$wid->widget_title.' </div>
    
    								<div class="info_body" style="height:'.$css->height.'px; background-color:none;">'.$wd.'</div>
    
    	         				</div>
    
    	      			 	 </div>';
    
            	break;
    
    
    
              case 'quick_form':
    
                  $wd='<form id="quick_form_'.$wid->id.'" class="quick_form" style="text-align:left; padding:4px; padding-bottom:0px;">
    
                      <div class="form-group">
    
                        <input type="text" name="name" class="form-control" placeholder="Your Name">
    
                      </div>
    
                       <div class="form-group">
    
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number">
    
                      </div>
    
                      <div class="form-group">
    
                        <input type="text" name="email" class="form-control" placeholder="Email">
    
                      </div>
    
                      <div class="form-group">
    
                        <input type="text" name="message" class="form-control" placeholder="Message">
    
                      </div>
    
                      <div class="form-group">
    
                        <button type="submit" class="btn btn-primary btn-primary rounded-0 py-2 px-4">Submit</button>
    
                      </div>
    
                      
    
                  </form>
    
                  <style>.quick_form button{background-color:'.$css->backColor.'; width:100%; border-color:'.$css->backColor.'} .quick_form button:hover{background-color:'.$css->backColor.';filter: brightness(80%)!important;}</style>';
    
                return '<div class="" style="margin:0px; padding:0px; width:100%; height:auto;">
    
                  <div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.'; text-align:center; font-weight:bold; background:none!important;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; '.$t.'">'.$wid->widget_title.'</div>
    
                    <div class="" style="height:auto; background-color:none;">
    
                      <div class="formCover" style="position: absolute;height:100%;width: 100%;background: #0000008f;  z-index: 99; display:none; color:white; padding-top:30%"><font size="33px"><i class="fa fa-spinner fa-spin"></i></font></div>
    
                    '.$wd.'</div>
    
                      </div>
    
                     </div>';
    
              break;
    
    // Sarvodaya Group Of Education, Bagh Chhingamal, Comapny Baag, Firozabad, Uttar Pradesh
    
              case 'g_map':
    
              // $wd='<iframe src="https://www.google.com/maps/search/'.urldecode($css->fullAddress).'" width="100%" height="'.$css->mapHeight.'px"></iframe>';
    
    
    
    
    
              $main=$css->mapCode;
    
              $set = explode('/', $main);
    
    
    
              $x=end($set);
    
              $set2 = explode(':', $x);
    
              $f = explode('1s', $set2[0]);
    
              $s = explode('!', $set2[1])[0];
    
    
    
              $link='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3550.0455809208524!2d78.38407961466523!3d27.154856056161734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s'.end($f).'%3A'.$s.'!2s'.urldecode($set[5]).'!5e0!3m2!1sen!2sin!4v1584934463667!5m2!1sen!2sin" height="'.$css->mapHeight.'" width="100%"></iframe>';
    
    
    
    
    
                return '<div class="" style="margin:0px; padding:0px; width:100%; height:auto;">
    
                  <div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.'; text-align:center; font-weight:bold; background:none;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; '.$t.'">'.$wid->widget_title.'</div>
    
                    <div class="mapBox" style="height:'.$css->mapHeight.'px; background-color:white;">'.$link.'</div>
    
                      </div>
    
                     </div>
    
                     ';
    
              break;
    
              case 'counter':
    
              $val = $CI->WidgetModel->getVisit();
    
            //   return getNumberAbbreviation($val);
    
                return '<style>.counter-images img{width:36px}</style><div class="" style="margin:0px; padding:0px; width:100%; height:auto;">
    
                  <div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.'; text-align:center; font-weight:bold; background:none;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; '.$t.'">'.$wid->widget_title.'</div>
    
                    <div class="counter-images" style="min-height:50px; background-color:transparent;text-shadow:0 0 2px white; padding:3px; font-family:fantasy; font-size:28px; color:black;" title="'.$val.'">'.($val).'</div>
    
                      </div>
    
                     </div>';
    
              break;
    
              case 'fb_page':
    
    
    
                $link = '<iframe src="https://www.facebook.com/plugins/page.php?href='.$css->fbPageLink.'&tabs=timeline%2C%20events%2C%20messages&width=&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="'.$css->height.'" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>';
    
    
    
                 return '<div  style="margin:0px; padding:0px; width:100%;">
    
                  <div style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.'; text-align:center; font-weight:bold; background:none;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; '.$t.'">'.$wid->widget_title.'</div>
    
                    <div class="mapBox" style="height:'.$css->height.'px; background-color:white;">'.$link.'</div>
    
                      </div>
    
                     </div>';
    
              break;
    
              case 'social_links':
    
              $s='';
    
              $s .= $css->facebook?'<a href="'.$css->facebook.'"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png" style="margin:3px;"></a>':'';
    
              $s .= $css->instagram?'<a href="'.$css->instagram.'"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-instagram-m.png" style="margin:3px;"></a>':'';
    
              $s .= $css->youtube?'<a href="'.$css->youtube.'"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-youtube-m.png" style="margin:3px;"></a>':'';
    
              $s .= $css->twitter?'<a href="'.$css->twitter.'"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter-m.png" style="margin:3px;"></a>':'';
    
              $s .= $css->linkedin?'<a href="'.$css->linkedin.'"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-linkedin-m.png" style="margin:3px;"></a>':'';
    
              $s .= $css->pinterest?'<a href="'.$css->pinterest.'"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-pinterest-m.png" style="margin:3px;"></a>':'';
    
              
    
             
    
                 return '<div class="" style="margin:0px; padding:0px; width:100%;">
    
                  <div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.'; text-align:center; font-weight:bold; background:none;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; '.$t.'">'.$wid->widget_title.'</div>
    
                    <div class="" style="height:auto; background-color:none; padding:3px; font-family:fantasy; font-size:28px; color:black;">'.$s.'</div>
    
                      </div>
    
                     </div>';
    
              break;
    
              case 'translate':
                $rand = rand(10,100) * intval( microtime(true) );
                return '<div class="" style="margin:0px; padding:0px; width:100%;">
    
                  <div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.'; text-align:center; font-weight:bold; background:none;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; '.$t.'">'.$wid->widget_title.'</div>
    
                    <div class="" style="min-height:50px; background-color:none; padding:3px; font-family:fantasy; font-size:28px; color:black;"><div id="google_translate_element_'.$rand.'"></div>
    
    
    
                    <script type="text/javascript">
                    
                    function googleTranslateElementInit() {
                    
                      new google.translate.TranslateElement({pageLanguage: \'en\'}, \'google_translate_element_'.$rand.'\');
                    
                    }
                    
                    </script>
                    
                    
                    
                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script></div>
    
                      </div>
    
                     </div>';
    
              break;
    
    
    
              case 'text_box':
    
              return '<div class="" style="margin:0px; padding:0px; width:100%; ">
    
                  <div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.';font-weight:bold; background:none;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; text-align:center  '.$t.'">'.$wid->widget_title.'</div>
    
                    <div style="height:'.$css->height.'px; background:none;" align="left">'.$css->info.'</div>
    
                      </div>
    
                     </div>';
    
    
    
              break;
    
              case 'menu_widget':
    
    
    
              $list = '';
            
            if(isset($css->pageList)){
              foreach ($css->pageList as $res){
                  
                 $page = $CI->SiteModel->list_page($res);
    
                if($page->num_rows()){
                      $r = $page->row();
                      $list.='<li><a style="color:'.$css->textColor.'; " href="'.site_url('web/'.AJ_ENCODE($r->id).'/'.str_replace(' ', '-', $r->page_name)).'">'.$r->page_name.'</a></li>';
                }
    
              }
            }
            
            if(isset($css->category)){
                
                
                
                foreach($css->category as $res){
                    $cat = $CI->NewsModel->get_category(['id'=>$res]);
                    $actionBtn  = '';
                    if(isset($css->numPost)){
                        $actionBtn = $css->numPost == 'show' ? '<label class="badge badge-success">'.$CI->NewsModel->countCategoryPost($res).'</label>' : '';
                    }
                    if($cat->num_rows()){
                        $r = $cat->row();
                        $list.='<li><a style="color:'.$css->textColor.'; " href="#">'.$r->name.'  '.$actionBtn.'</a></li>';
                    }
                }
                
            }
    
              
    
    
    
                return '<div class="" style="margin:0px; padding:0px; width:100%;">
    
                  <div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.'; text-align:center; font-weight:bold; background:none;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; '.$t.'" align="left">'.$wid->widget_title.'</div>
    
                    <div style="height:'.$css->height.'px; background:none; color:'.$css->textColor.'; text-align:left;  list-style:none;">'.$list.'</div>
    
                      </div>
    
                     </div>';
    
    
    
              break;
    
              case 'ads':
    
    
              return '<div class="" style="margin:0px; padding:0px; width:100%; overflow:hidden;">
    
                  <div class="" style="padding:0px; border:'.$css->Bsize.'px '.$css->Bstyle.' '.$css->backColor.';font-weight:bold; background:none;">
    
                    <div style="background:'.hex2rgba($css->backColor,round($css->opacity/100,2)).'; color:'.$css->textColor.';  font-size:'.$css->Fsize.'px; font-family:'.$css->Ffamily.'; text-align:center  '.$t.'">'.$wid->widget_title.'</div>
    
                    <div style="height:'.$css->height.'px; background:none;" align="left">'.$css->ads_code.'</div>
    
                      </div>
    
                     </div>';
    
              break;
                 default:
    
                    return $wid->widget_type;
    
            }
            

    }



}


  //function imageSelector()

  function imageSelector($id,$curURL,$res)

  { // return "KH";



        $img = explode('/',$curURL);

        $curImg = $img[sizeof($img)-1];

      echo'<div class="row imgSelectBox '.$id.'">

            <div class="col-sm-4">

              <ul class="imageList">';



                  $CI=&get_instance();

                  $imgs = $CI->GalleryModel->getImages();

                  if($imgs->num_rows())

                  {

                    echo '<img src="'.base_url.'/public/temp/no-photo.png">';

                    foreach ($imgs->result() as $r)

                    {

                      echo '<img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$r->file_name.'">';

                    }

                  }

                  else

                  {

                    echo'<div class="alert alert-danger">No Photos Available</div>';

                  }

                

              echo'</ul>

            </div>

            <div class="col-sm-8">

              <label>Selected Image : [<span id="selImg">'.$curImg.'</span>]</label>

              <img id="seletedImg" src="'.$curURL.'" style="width:100%; height:400px;">

            </div>

          </div>';



echo'<style type="text/css">

  .imageList

  {

    padding: 0px;

    margin: 0px;

    list-style: none;

    overflow-y: auto;

    height: 450px;

  }



  .imageList img

  {

    margin: 5px;

    height: 120px;

    width: 140px;

    float:left;

    border: 1px solid white;

  }

  .imageList img:hover

  {

    filter:brightness(0.4);

    

  }

  /* width */

.imageList::-webkit-scrollbar {

  width: 5px;

}



/* Track */

.imageList::-webkit-scrollbar-track {

  background: #f1f1f1; 

}

 

/* Handle */

.imageList::-webkit-scrollbar-thumb {

  background: #888; 

}



/* Handle on hover */

.imageList::-webkit-scrollbar-thumb:hover {

  background: #555; 



}



 #selectedImg{

  height: 400px;

 }

</style>



<script type="text/javascript">

  $(".'.$id.' img").on("click",function()

  {

    var x = this.src;

    var nm = x.split("/");



    $(".'.$id.' #seletedImg").attr("src",x);

    $("input[name='.$res.']").val(nm[nm.length-1]);

    $(".'.$id.' #selImg").html(nm[nm.length-1]=="no-photo.png"?"":nm[nm.length-1]);

  });

</script>';

}





function isJson($string) 

{

  json_decode($string);

 return (json_last_error() == JSON_ERROR_NONE);

}

?>