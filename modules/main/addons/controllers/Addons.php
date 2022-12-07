<?php
class Addons extends MY_Controller{
    
    function __construct(){
        parent :: __construct();
        // $this->load->model('main/common/SiteModel');
    }
    
    
    function render($page = ''){
        return $this->load->view();
    }
    function get_where($table , $where = []){
        if(count($where))
            $this->db->where($where);
        return $this->db->get($table);
    }
    
    
    function get($type = 'logo', $field = 'code'){
        $get = $this->db->get_where('settings',['type' => $type]);
        if($get->num_rows()){
            $row = $get->row();
            if($field){
                return $row->{$field};
            }
            return $row;
        }
        return;
    }
    
    function create_links($type = '',$heading = '',$header_input = false){
        $data['links'] = $this->get_where('links',['type' => $type]);
        $data['type'] = $type;
        $data['heading'] = $heading;
        $data['header_input']  = $header_input;
        $this->load->view('custom_links',$data);
    }
    function get_header($id , $type = 'page'){
        $get = $this->db->get_where('page_content',['page_id' => $id,'type' => $type,'section' => 'header']);
        if($get->num_rows()){
            return $get->row()->content;            
        }
        return;
    }
    
    function get_links($type = ''){
        $this->db->where('type' ,$type)->where('status',1);
        return $this->db->get('links');
    }
    
    function file_upload($file,$path = ''){
        if(!empty($_FILES[$file]['name'])){ 
            
            $filename = $_FILES[$file]['name'];
            //$ext = pathinfo($filename, PATHINFO_EXTENSION);
            $realpath = 'upload';
             if(!empty($path)){
                 $realpath = $realpath.'/'.$path;
             }
		     $config['upload_path'] = $realpath; 
		     $config['allowed_types'] = 'jpg|jpeg|png|gif';
		     $config['max_size'] = 1024 * 4; // max_size in kb
		     $config['encrypt_name'] = true;
		     $this->load->library('upload',$config); 
		     if($this->upload->do_upload($file)){

		       $uploadData = $this->upload->data();

		       return $uploadData['file_name'];
		     }
		     else{
		         echo $this->upload->upload_path;
		         pre($this->upload->display_errors());
		         exit;
		     }
		   } 
		  return '';
    }
    
    function response($data,$header = 201){
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($header)
            ->set_output(json_encode($data));
    }
    
    function set_in_page($type = '',$flag = false,$data = []){
        $data['type'] = $type;
        $data['flag'] = $flag;
        if($post = $this->input->post()){
            if($this->db->where($post)->get('page_schema')->num_rows())
                $this->db->delete('page_schema',$post);     
            else
                $this->db->insert('page_schema',$post);  
            $this->response(['status' => true]);
        }
        else
            return $this->load->view(__FUNCTION__,['data' => $data],true);
    }
}

?>