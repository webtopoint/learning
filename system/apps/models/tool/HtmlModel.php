<?php
class HtmlModel extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    /*   Tab Section Start  */
    function create_tab($data){
        $data['admin_id'] = CLIENT_ID;
        return $this->db->insert('tabs',$data);
    }

    function update_tab($data= [], $where = []){
        $this->db->where($where);
        $this->db->where([ 'admin_id' => CLIENT_ID ]);
        return $this->db->update('tabs',$data);
    }
    
    function list_tabs($id = 0){
        if($id)
            $this->db->where('id',$id);
        return $this->db->get_where('tabs',['admin_id'=>CLIENT_ID])->result_array();
    }



    /*   Tab Section End  */
    function select_payment_getway($trans_id){
        echo $trans_id;
        exit;
        // $rec = $this->PaymentModel->getTransactionRecord(array('id'=>$trans_id,'status'=>'init'));
        
        // $tform_ids = $this->FormModel->getTransactionForm(['id'=>$rec->row()->tform_id])->row();
        // $html = '';
        
        // $html .= '<div class="col-md-3">
                    
                
        //         </div>';
        
        
        // print_r($tform_ids->id);
        
        // exit;
        $page_data['trans_id'] = $trans_id;
        $this->w999->view('front/select_box/choose_payment_options',$page_data);
    }
    
    public function useContent($data)
	{
		if($this->db->where($data)->get('web_schema')->num_rows())
		{
			$this->db->where($data)->delete('web_schema');
		}
		else
		{
			$this->db->insert('web_schema',$data);
		}
	}
    
}





?>