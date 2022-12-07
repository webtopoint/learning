<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Tool_Controller {
    
    function __construct()
    {
        parent::__construct();
        load_web_plugin('extra_setting_form',form_open_multipart('settings/v1/submit'));
        load_web_plugin('close_form',form_close());
        load_web_plugin('form_save_button','<button class="btn btn-primary fa fa-save"> Save</button>');
        $this->load->model('tool/extra_setting','ES');
    }
    
    function printThemeMenu($item){
        
    }

    function getSliderTemplates(){
        $sliderTemp = $this->theme_path.'/config/slider_templates'.EXT;
        $temp = [];
        if(file_exists($sliderTemp)){
            require $sliderTemp;
            if(isset($templates)){
                $temp = $templates;
            }
        }
        return str_replace('{_theme_url_}',theme_url(),json_encode($temp));//json_encode($temp);
    }
    function test(){
        $this->load->module('template',true);
        echo web_plugin('web_theme_color');
        // $html = "abc<p></p><p>dd</p><b>non-empty</b>"; 
        // $pattern = "/<p[^>]*><\\/p[^>]*>/"; 
        // //$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";  use this pattern to remove any empty tag
        
        // echo preg_replace($pattern, '', $html); 
        // output
        //abc<p>dd</p><b>non-empty</b>
    }
    function all_widgtes($data = []){
        $this->load->model('tool/WidgetModel');
        return $this->load->view('tinymce_config',$data,true);
	   // return "{
    //                                   type: 'menuitem',
    //                                   text: 'Sub menu item 1',
    //                                   icon: 'unlock',
    //                                   onAction: function () {
    //                                     editor.insertContent('&nbsp;<em>You clicked Sub menu item 1!</em>');
    //                                   }
    //                                 },
    //                                 {
    //                                   type: 'menuitem',
    //                                   text: 'Sub menu item 2',
    //                                   icon: 'lock',
    //                                   onAction: function () {
    //                                     editor.insertContent('&nbsp;<em>You clicked Sub menu item 2!</em>');
    //                                   }
    //                                 }";
	}
    function create_links($type = '',$heading = '',$header_input = false,$content = false){
        // $data['links'] = $this->db->get_where('extra_setting',['type' => $type,'admin_id' => ]);
        $data['name'] = $type;
        $data['value'] = $heading;
        $data['content'] = $content;
        $data['header_input']  = $header_input;
        $this->load->view('custom_links',$data);
    }
    
    function get(){
        // $this->load->library('parser');
        // $this->parser->set_delimiters('-','-');
        // $this->parser->parse('test.tpl',['files' => $this->db->get('extra_setting')->result_array()]);
        echo getContentCss();
    }
     /*
    function test(){
        // $data = [
        //             1 => 0,
        //             2 => 0,
        //             3 => 0,
        //             4 => 2,
        //             7 => 4,
        //             6 => 7,
        //             5 => 7
            
        // ];
        // $ref = $item = [];
        // foreach($data as $id => $d){
        //     $thisRef = &$ref[$id];
        //     $thisRef['id'] = $id;
        //     $thisRef['parent'] = $d;
        //     if($d)
        //         $ref[$d]['child'][$id] = &$thisRef;
        //     else
        //         $item[$id] = &$thisRef;
        // }
        // echo '<pre>';
        // print_r($item);
        $this->load->model('tool/ThemeModel');
        $listTHemeMenu = $this->ThemeModel->getMenu();
	    echo '<pre>';
	    print_r($listTHemeMenu);
	    exit;
        
    }
    */
    function v1(){
        $type = $this->uri->segment(3,0);
        $page_data = '<div class="alert alert-danger">Please Select A Method.</div>';
        
        if($type == 'submit' AND $post = $this->input->post()){
            $return = ['status' => false];
            if(isset($post['type'])){
                
            }
            else{
                foreach($_POST as $index => $value){
                    $data = $where = ['type' => $index,'admin_id' => CLIENT_ID];
                    if(empty($value))
                        continue;
                    $data['value'] = is_array($value) ? json_encode($value) : $_POST[$index];
                    if($this->ES->get($where)){
                        $return['status'] = $this->ES->update($data,$where);
                        $return['message'] = 'Setting Update Successfull..';
                    }
                    else{
                        $this->ES->insert($data);
                        $return['message'] = 'Setting Added Successfull..';
                    }
                }
            }
            
            echo json_encode($return);
        
            exit(1);
        }   
        
        $extraJS = base_url.'/public/custom/extra-setting.js';
        $data['js_files'] = [$extraJS];
        if($type){
                $this->load->module('settings');
                $this->load->model('tool/ThemeModel');
                
                 $data['output'] = '<div class="alert alert-danger">Permission Deined.</div>';
            
                if($this->ThemeModel->isValidMenu($type,true)){
                    if(findMulWordsFromString($type,['menu','menus','link','links'])){
                        $data = (array)$this->create_custom_link($type);
                        array_push($data['js_files'],$extraJS);
                    }
                    elseif(method_exists($this,$type)){
                        $data = (array)$this->$type();
                    }
                    else
                         $data['output'] = $this->load->view("settings/$type",['return' => true,'CI' => $this],'tool');
                }
        }
        
        $this->load->Module('admin');
        $this->admin->view($data);
    }
     function create_custom_link($type){
        // exit($type);
        $crud = $this->crud_table('extra_setting');
        $crud->where('admin_id',CLIENT_ID)->set_subject('Link','Links')
             ->where('type',$type)->columns(['title'])->unset_texteditor('value','full_text')
             ->callback_column('title',function($value,$row){
                 return '<a href="'.$row->value.'" target="_blank" >'.$value.'</a>';
             })
             ->unset_add_fields('content')
             ->unset_edit_fields('content')
             ->callback_add_field('value',[$this,'_link_textarea'])->unset_jquery()
             ->callback_edit_field('value',[$this,'_link_textarea'])
             ->field_type('type','hidden',$type)->display_as('value','Link')->required_fields(['title','value']);
        return $crud->render();
    }
    
    function _link_textarea($value = '',$primary = 0){
        return '<textarea id="field-value" name="value" class="form-control">'.$value.'</textarea>
                <button class="our-page-links btn btn-xs btn-sm btn-info mt-3" type="button">Set Our Page in this link</button>
            ';
    }
    private function slider(){
        $crud = $this->crud_table('extra_setting');
        $file = $this->theme_path.'/settings/slider'.EXT;
        $config_theme = $this->theme_path.'/config/theme'.EXT;
        if(file_exists($config_theme))
            require $config_theme;

        $crud->where('admin_id',CLIENT_ID)
                ->set_subject('Slider Image','Slider Images')
                ->where('type','slider')
                ->columns('value')
                ->set_field_upload('value',FOLDER)
                ->field_type('type','hidden','slider')
                ->display_as('value','Slider Image')
                ->required_fields('value');
        $editor = false;
        if(isset($theme['slider_content'])){
            if($editor = $theme['slider_content']){
                $crud->callback_add_field('content',[$this,'editor_slider_contnet']);
                $crud->callback_edit_field('content',[$this,'editor_slider_contnet']);
            }
        }
        
        if(!$editor){
            $crud->unset_add_fields('content')->unset_edit_fields('contnet');
        }

        if(file_exists($file)){
            // require $file;
        }

        return $crud->render();
    }

    function editor_slider_contnet($row = ''){
        $custom_templates = $this->getSliderTemplates();
        $content_style = 'body#tinymce{background:#9585fa!important}';
        return $this->load->view('settings/slider-content-tinymce',['value' => $row,'custom_templates' => $custom_templates,'content_style'=>$content_style],true);
    }

    function set_in_page_button($title = '', $type = '', $type_id = 0,$btn_class = 'btn-info extra-set-in-page'){
        return " &nbsp; <button class='btn $btn_class' type='button' data-type='$type' data-type_id='$type_id' data-title='$title'> $title Set In Page </button>";
    }

    function set_in_page_submit(){
        $data = ['status' => false,'message' => 'Something Went Wrong..'];
        if($post = $this->input->post()){
            $status = $this->ES->set_in_page($post);
            if($status){
                $data['status'] = true;
                if($status == 'add')
                    $data['message'] = 'Add in Page Successfully..';
                else
                    $data['message'] = 'Removed from page Successfully..';
            }
            // echo json_encode($post);
        }   
        
        echo json_encode($data);
    }
    function get_settings(){

        $settings = $this->db->get('settings')->result_array();
        $data = array();
        foreach ($settings as $key => $value)
        {
            $data[$value['name']] = $value['value'];
        }
        return $data;
    }
 
    function get_one_setting($name)
    {
        $this->db->where("name", $name);
        $query = $this->db->get('settings');
        $data = $query->row_array();
        return $data['value'];
    }
    
    function tt(){
        return $this->load->view('tinymce_test',['js_files' => 'https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin'],true);
    }
    
    function tinymce($data = []){
        $this->load->helper('tool/custom');
        return $this->load->view('tinymce',$data,true);
    }

}