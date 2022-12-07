<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends Main_Controller {
    function __construct(){
        parent :: __construct();
    }
    
    function index(){
        if($post = $this->input->post()){
	        if($post['type'] == 'logo'){
	            $logo = Modules :: run('addons/file_upload','avatar');
	            if($logo)
	                $this->db->where('id',1)->update('settings',['code' => $logo]);
	        }
	        
	        redirect(current_url());
	    }
	    else
	        $this->render_page('setting');
    }
    // function footer(){
    //     $this->render_page('setting/footer');
    // }
    function social_links(){
        if($post = $this->input->post()){
            $table  = 'social_links';
            foreach($post as $name => $value){
                $where = ['name' => $name];
                $data = ['value' => $value];
                $get = $this->db->get_where($table,$where);
                if($get->num_rows())
                    $this->db->update($table,$data,$where);
                else
                    $this->db->insert($table,$data+$where);
            }
            $this->session->set_flashdata('success','Links Updated Successfully..');
            redirect(current_url());
        }
        else
            $this->render_page(__FUNCTION__);
    }
    
    function important_links(){
        $types = [
                    'left_topbar' => 'Left Topbar' ,
                    'right_topbar' => 'Right Topbar',
                    'footer_first' => 'Footer (Resources Section )',
                    'footer_second' => 'Footer (Products Section )',
                    'footer_third' => 'Footer (Company Section )',
                    'footer_forth' => 'Footer (Support Section )',
                    'bottom_footer' => 'Bottom Footer'
        ];
        $this->crud -> set_table('links');
        $this->crud -> field_type('status','dropdown',['1' => 'Active','0' => 'In-Active'])
                    -> columns('icon','type','index','value','status')
                    -> field_type('value','textarea')
                    -> field_type('type','dropdown',$types)
                    -> required_fields(['index','value','status'])
                    -> set_subject('Important Links','Important Links(s)')
                    -> display_as('index','Title')
                    -> display_as('value','Url')
                    -> display_as('icon','Icon')
                    -> field_type('status','dropdown',['1' => 'Active','0' => 'In-Active'])
                    -> unset_read()
                    -> unset_clone()
                    ->callback_column('icon',function($value = '', $primary_id = null){
                        $value = $value ? $value : 'fas fa-ban';
                        return '<i id="GetIcon" class="'.$value.'"></i>';
                    })
                    ->callback_column('value',function($value,$row){
                        return '<a href="'.$value.'">'.$row->index.'</a>';
                    })
                    -> callback_add_field('icon',[$this,'init_icon'])
                    ->callback_edit_field('icon',[$this,'init_icon']); 
        $this       -> render( $this  ->  crud  ->  render() );
    }
    
    
    function init_icon($value = '',$primary = 0){
        $icon = empty($value) ? '<i class="fas fa-ban" id="GetIcon"></i>' : '<i id="GetIcon" class="'.$value.'"></i>';
        return '<input type="hidden" name="icon" class="menu-icon" id="IconInput6691" value="'.$value.'"><span title="Select Icon" style="cursor:pointer" class="icon-link" href="javascript:void(0)" id="GetIconPicker" data-iconpicker-input="input#IconInput6691" data-iconpicker-preview="i#GetIcon">'.$icon.'</span>' ;
    }
    
    function language_text(){
        $this->crud -> set_table('language_items');
        $this->crud -> field_type('status','dropdown',['1' => 'Active','0' => 'In-Active']);
      
        $this->crud -> required_fields(['text','english','status'])
                    -> set_subject('Language Text','Language Text(s)')
                    -> display_as('text','Title')
                    -> display_as('english','In English')
                    -> display_as('hindi','In Hindi')
                    -> unset_read()
                    -> unset_clone()
                    -> unset_delete()
                    -> set_rules('text','Title','is_unique[language_items.text]',array('is_unique' => 'This %s Already Exists..'));
        $this       -> render( $this  ->  crud  ->  render() );
    }
    
    private function update($type,$code,$type_index = 'type'){
        return $this->db->update('settings',['code' => $code],[$type_index => $type]);
    }
    
}

?>