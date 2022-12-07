<?php
class Payment extends Reseller_Controller{
    function __construct(){
        parent :: __construct();
    }
    
    //rsemAwhviRm8luVaPlmLUWMABaPcoAp5
// JCAsFi
    function test(){
        echo RID;
    }
    function create_transaction($data = []){
        if($post = $this->input->post()){
            extract($post);
            $row = $this->db->where('id',RID)->get('accounts')->row();
            $dataTemp = [
                'firstname' => $row->name,
                'email'  => $row->email,
                'phone' => $row->phone,
                'amount' => $amount,
                'surl'  => $surl,
                'furl' => $furl,
                'udf1' => RID,
                'udf2' => $udf2,
                'productinfo' => $message
            ];
            $data = array_merge($data,$dataTemp);
        }
        echo json_encode(['form' => $this->genrate_payuform($data)]); 
        
    }
    function genrate_payuform($data = []){
        $this->pum->init('vi5xgOsKL4','4Ff9Td5F');
        $this->pum->add_field($data);
        return $this->pum->submit_pum_ajax();
    }


    function all_transactions(){
        $this->load_crud();
        $this->load->module('view');
        // $this->view->display('list-all-transactions');
        $this->config->set_item('timestring','d M Y');
        $crud  = $this->crud->set_table('rs_payment_details');
        
        $crud->where('account_id',RID)
            ->columns('timestamp','type_id','amount','provider','type','status')
            ->unset_add()
            ->set_subject('All Transactions')
            ->unset_edit()
            ->unset_read()
            ->unset_delete()
            ->display_as('type_id','PaymentId')
            ->display_as('timestamp','Time')
            ->unset_clone()
            ->callback_column('amount',[$this,'print_price'])
            ->callback_column('type',[$this,'payment_type_print'])
            ->callback_column('status',[$this,'payment_type_print'])
            ->callback_column('timestamp',[$this,'print_timestamp']);
        $this->view->display($crud);
    }
}

?>