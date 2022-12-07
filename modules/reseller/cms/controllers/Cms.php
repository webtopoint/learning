<?php
class Cms extends Reseller_Controller{
    function __construct(){
        parent :: __construct();
        $this->load_crud();
    }

    function test(){
        echo Modules :: run('page/test');
        exit;
		$str = 'https://test.com';
		$str2 = 'about-us';


		echo strpos($str,'http') ? 'yes this is link' : 'no';

		echo '<br>';


		echo strpos($str2,'http') ? 'yes this is link' : 'no';
	}
    function menu(){
        $this->view->display('menu');
    }

    function website(){
        $domain = 'http://ajaydemo.in.net';
        echo "<iframe src='$domain' id='myload' style='width:100%;height:300px'></iframe>
            <script>
            setInterval(function () {
                document.getElementById('myload').contentWindow.location.href = '".$domain."';
            }, 1000);
            

            </script>
        
        
        ";
    }

    function page(){
        $this->config->set_item('csrf_protection',true);
        $crud = $this->crud->set_table('rs_his_pages');
        $crud->change_field_type('admin_id','hidden',RID)
            ->change_field_type('parent_id','hidden')
            ->change_field_type('sort','hidden')
            ->required_fields('page_name')
            ->set_subject('Page','Page(s)')
            ->callback_add_field('link',[$this,'page_link_input'])
            ->callback_edit_field('link',[$this,'page_link_input'])
            ->field_type('redirection','dropdown',['0' => 'No','1' => 'New Window'])
            ->columns('page_name','link','redirection')
            ->unset_clone()
            ->unset_read()
            ->add_action('Page Content','',base_url('cms/page_content/'),'file')
            ->add_action('Page Schrma');
        $this->view->display($crud);
    }

    function page_content($page_id){
        if($page_id){
            $crud = $this->crud->set_table('rs_his_page_content');
            $crud->columns('title','content')
                ->field_type('admin_id','hidden',RID)
                ->field_type('page_id', 'hidden', 2)
                ->where('page_id',$page_id)
                ->fields('title','content','admin_id')
                ->set_relation('page_id','rs_his_pages','page_name')
                ->unset_clone()
                ->unset_read();
            $this->view->display($crud);
        }
        else
            show_404();
    }

    function page_link_input($value = ''){
        return $this->load->view(__FUNCTION__,['value' => $value],true);
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
		    $this->db->where('id',$row['id'])->update('his_pages',$d);

		}
		
		echo json_encode(['status' => true]);
	}
    function menu_section(){
        $items = ($_POST['group_id'] == 'add') ? [] : Modules :: run('page/print_menu_items');
        $return['html'] = '<input type="hidden" id="group_id" value="'.$_POST['group_id'].'">
                    				        <div class="cf nestable-lists"><div class="dd" id="nestable" style="width:100%">'.$this->get_menu($items).'</div></div>
                    			    
                    			            <input type="hidden" id="nestable-output">';
        echo json_encode($return);
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
    // protected function update_setting($data){
    //     $this->db->whete()
    // }
    function setting(){
        if($post = $this->input->post()){
            $type = $this->uri->segment(3,0);
            $success= false;
            $unsuccess_message = $success_message = '';
            switch($type){
                case 'logo':
                    $success = $this->file_up('logo');
                    echo $success;
                    exit;
                    $success_message= 'Logo Update Successfully..';
                break;
            }

            if($success)
                $this->session->set_flashdata('success',$success_message);
            else                    
                $this->session->set_flashdata('error',$unsuccess_message);


            redirect('cms/setting');
        }
        else{
            $this->view->display('setting');
        }
    }
}


?>