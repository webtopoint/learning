<?php
class MY_Controller extends MX_Controller{
    public $data = ['title' => 'Bizknow India'],$cPanel;
    function __construct(){
        parent :: __construct();
        $this->load->library('session');
        cPanelAPILoad();
        $this->cPanel = new cpanelAPI(C_USER, C_KEY, C_HOST);
        $this->config->set_item('admin_logo',base_url('upload/'.Modules :: run('addons/get')));
    }

    function load_crud($database = ''){
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD($database);
        return $this;
    }

    function print_price($value){
        return $value .' <i class="fa fa-rupee"></i>';
    }
    function print_timestamp($time){

        return date(config_item('timestring'),strtotime($time));
    }
    function json_data_print_in_table($data = ''){
        $data = json_decode($data,true);
        $html = '';
        if($data){
            $html .= '<table class="table table-striped table-bordered table-hover">
                            <tbody>';
                foreach($data as $index => $value)
                    $html .= '<tr><th>'.$index.'</th><td>'.$value.'</td></tr>';

            $html .='        </tbody>
            
                     </table>';
        }
        return $html;
    }
    function payment_type_print($value,$row){
        switch($value){
            case 'wallet_failed':
                return '<label class="badge badge-danger">Wallet load Falied.</label> ';
            break;  
            case 'wallet':
                return '<label class="badge badge-success">Wallet loaded Successfully.</label> ';
            break;            
            case 'failure':
                return '<label class="badge badge-danger">Failed</label>';
            break;
            case 'success':
                return '<label class="badge badge-success">Success</label>';
            break;
        }
    }
}


// require __DIR__.'/Main_Controller.php';
// require __DIR__.'/WEB_Controller.php';
?>