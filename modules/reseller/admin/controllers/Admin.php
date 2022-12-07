<?php
class Admin extends Reseller_Controller{
    function __construct(){
        parent :: __construct();
        // $this->load->module('view');        
    }
    
    function index(){
    //   $this->load->view('index');
        $this->view->display('index');
    }

    function wallet(){
        $this->view->display('wallet');
    }
    function wallet_payment_status(){
        // echo 'Data Length is High. Please Configure your data.';
        // echo '<pre>';
        // print_r($_POST);
        if($post = $this->input->post()){

            $transction_id = time();//$_POST['mihpayid'];
            $type = 'wallet_failed';
            $this->view->relogin();
            if($post['status'] == 'success'){
                $type = 'wallet';
                $get = $this->AM->get_account(['id' => $post['udf1']])->row();
                $o_balance = $post['udf2'] == 'wallet' ? $get->wallet : $get->domain_wallet;
                $data = [
                    'wallet_type' => $post['udf2'],
                    'trans_status' => 'credit',
                    'o_balance' => $o_balance,
                    'c_balance' => $post['amount'] + $o_balance,
                    'transaction' => $post['amount'],
                    'order_id'    => $post['payuMoneyId'],
                    'trans_data' => json_encode($post),  
                ];
                $this->WM->wallet_update($post['amount']);
                $transction_id = $this->WM->add_wallet_transaction($data);
                $this->session->set_flashdata('success','Wallet Add Amount '. $post['amount'] .' Successfully..');
            }
            else    
                $this->session->set_flashdata('error',$post['error_Message']);
            $data = [
                'account_id' => $post['udf1'],
                'type_id' => $transction_id,
                'type' => $type,
                'status' => $post['status'],
                'provider' => 'payumoney',
                'amount' => $post['amount'],
                'data' => json_encode($post)
            ];
            
            $this->PM->add_transaction($data);
            redirect(site_url('admin/wallet'));
            // pre($data);
        }
        else    
            show_error('Something Went Wrong.');
    }
    function websites(){
        $this->load_crud('tool');
        $crud = $this->crud->set_table('w999_websites');
        
        $crud->set_subject('List Website')

            ->columns('name','last_name','domain_name','_email','_pass')
            ->unset_read()
            ->unset_add()
            ->unset_delete()
            ->unset_edit()
            ->unset_clone();
        $crud->where('reseller_id',4)->where('addedBy','');
        // echo $this->crud->myTableName;
        // exit;
        // $output = $crud->render();
        $this->view->display($crud);

    }
}
 
?>