<?php
class File extends MY_Controller{
    public $file_path = ('public/temp/');
    public $original_path;
    public $real_path = ('assets/file/');

    function __construct(){
        parent :: __construct();
        $this->original_path = $this->file_path;
        if(defined('CLIENT_ID'))
            $this->file_path .= CLIENT_ID;
        else if(defined('RID'))
            $this->file_path .= 'reseller/'.RID;
        
        $this->file_path .= '/';
    }

    function set_file_url($url){
        return $this->file_path = $this->original_path.$url.'/';
    }

    function get(){
        $file = $this->uri->segment(3,0);
        $this->render($file);
    }

    function render($file = ''){
        
        $file = $this->file_path.$file;

        if(!file_exists($file)){
            $file = 'public/no_image.png';
        }
        
        $ext = strtolower((substr(strrchr($file,'.'),1)));
        
        switch($ext){
            case 'gif' : $ctype = 'image/gif'; break;
            case 'png' : $ctype = 'image/png'; break;
            case 'jpg' : case 'jpeg': $ctype = 'image/jpeg'; break;
            case 'svg' : $ctype = 'image/svg+xml'; break;
        }
        header('Content-Type: '. $ctype);
        readfile($file);
    }
}

?>