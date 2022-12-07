<?php
class Reseller_Controller extends MY_Controller{

    function __construct(){
        parent :: __construct();
		$this->load->helper('tool/custom');
		
        $this->load->module('view');
		// echo getRadomNumber(10);
		// exit;

    }
    function file_up($file){
        if(!empty($_FILES[$file]['name'])){
            
            $filename = $_FILES[$file]['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
			 $x = getRadomNumber(10).'.'.$ext;
		     $config['upload_path'] = 'public/temp/reseller/'.RID.'/'; 
		     $config['allowed_types'] = 'jpg|jpeg|png|gif';
		     $config['max_size'] = '2048'; // max_size in kb
		     $config['file_name'] = $x;
		     $this->load->library('upload',$config); 
		     if($this->upload->do_upload($file)){

		       $uploadData = $this->upload->data();

		       $data = array('file_name'=>$x,'admin_id'=>RID);
               $this->db->insert('manage_files',$data);
		       return $x;
		     }
		   } 
		  return '';
    }
    
}

?>