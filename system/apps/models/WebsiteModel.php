<?php
class WebsiteModel extends Tool_Model{
    public $domain,$webid,$website = 'websites';
	function __construct(){
		parent :: __construct();
		
	}
	function id($id){
		$this->webid = $id;
		return $this;
	}
	function insert_to_db_with_insert_id($table_name,$data){
	    $Query = $this->db->insert($table_name,$data);
        if($Query){
            return $this->db->insert_id();
        } else {
            return false;
        }
	}
    
	function get_websites($id = 0){

		if($id)
			$this->db->where('id',$id);
		if(is_array($id))
		    $this->db->where($id);
		    
		return $this->db->get_where($this->website);
	}
	function getTypeNameMyPlan($plan_id){
	    $this->db->from('plans', 'theme_types');
        $this->db->join('theme_types', 'theme_types.id = plans.theme_type_id AND plans.id = '.$plan_id);
        $result = $this->db->get();
        if($result->num_rows()){
            return $result->row();
        }
        return 0;
	}
	function getWebsiteData($id){
	   $d = $this->db->get_where('website_data',['admin_id' => $id]); 
	    if($d){
	       return $d->row(); 
	    } 
	    return;
	}
	public function getOrder($OD_ID){ 
        $this->db->select('details.*,party.*');
        $this->db->from('invoice_details as details');
        $this->db->join('party', 'party.partyId = details.partyId');
        $this->db->where(array('details.isDeleted' => 0,'details.invoiceId' => $OD_ID));
        $Query = $this->db->get();
        if($Query->num_rows() > 0) {
            $Data = $Query->row();
            $Data->packingCharge = json_decode($Data->packingCharge,true);
            $Data->transportCharge = json_decode($Data->transportCharge,true);
            $Data->invoiceDiscount = json_decode($Data->invoiceDiscount,true);
            $this->db->select('items.*,website_payment.payment_time');
            $this->db->from('invoice_items as items');
            $this->db->join('website_payment', 'website_payment.id = items.productId');
            $this->db->where(array('items.isDeleted' => 0,'items.invoiceId' => $OD_ID));
            $Invoice_Item_Query = $this->db->get();
            if($Invoice_Item_Query->num_rows() > 0) {
                $Data->OrderItems = $Invoice_Item_Query->result_array();
            }
            $Query2 = $this->db->query("SELECT invoiceId FROM ".PREFIX."_invoice_details WHERE isDeleted=0 and invoiceId > $OD_ID limit 1");
            if($Query2->num_rows()>0){
                $Data->next_id = $Query2->row()->invoiceId;
            } else {
                $Data->next_id = false;
            }
            $Query3 = $this->db->query("SELECT invoiceId FROM ".PREFIX."_invoice_details WHERE isDeleted=0 and invoiceId < $OD_ID ORDER BY invoiceId DESC limit 1");
            if($Query3->num_rows()>0){
                $Data->previous_id = $Query3->row()->invoiceId;
            } else {
                $Data->previous_id = false;
            }
            return $Data;
        } else {
            return false;
        }
    } 
	function getSaleByMonth($date = 0){
	    $mdate = date('Y-m-').'01 12:00:00';
	    if($date)
	        $mdate = ($date);
	        	   
	    $date = new DateTime( $mdate );
	    $mdate = strtotime($mdate);
        $date->modify('last day of this month');
        $endDt = strtotime( $date->format('Y-m-d H:i:s') );   
        $return = [];
        $get = $this->db->query("SELECT * FROM w999_websites,w999_web_themes WHERE w999_websites.reseller_id = '".RID."' AND w999_websites.web_type = 1 AND w999_web_themes.id = w999_websites.theme_id AND w999_web_themes.type = 1 AND w999_websites.start_time >= '".$mdate."' AND w999_websites.start_time <= '".$endDt."' ");
	   // $get =  $this->db->where('start_time >=', $mdate)->where('start_time <=', $endDt)->where(['reseller_id'=>RID])->get( $this->website );
	    $ttl = 0;
	    foreach($get->result() as $web){
	        
	        $payment = $this->db->select('*,SUM(amount) as amount')->group_by('admin_id')->where('admin_id' , $web->id )->get('website_payment');
	        if($payment->num_rows()){
	            $ttl += $payment->row()->amount;
	        }
	    }
	    /*
	    $return['informative_websites'] = $this->db->query("SELECT * FROM w999_websites,w999_web_themes WHERE w999_websites.reseller_id = '".RID."' AND w999_websites.web_type = 1 AND w999_web_themes.id = w999_websites.theme_id AND w999_web_themes.type = 1 AND w999_websites.start_time >= '".$mdate."' AND w999_websites.start_time <= '".$endDt."' ")->num_rows();
	    $return['ecommerce_websites'] = $this->db->query("SELECT * FROM w999_websites,w999_web_themes WHERE w999_websites.reseller_id = '".RID."' AND w999_websites.web_type = 2 AND w999_web_themes.id = w999_websites.theme_id AND w999_web_themes.type = 2 AND w999_websites.start_time >= '".$mdate."' AND w999_websites.start_time <= '".$endDt."' ")->num_rows();
	    
	    $return['total_payment'] = number_format($ttl,2);*/
	    
	    $return['total_websites'] = $get->num_rows();
	    return $return;

	}
	function getRows($params = array(),$getNumberRows = false){
        $this->db->select('*');
        $this->db->from($this->website);
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('domain_name',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('name',$params['search']['sortBy']);
        }else{
            $this->db->order_by('id','desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        // $this->db->where(['reseller_id'=>RID]);
        $query = $this->db->get();
        //return fetched data
        return $getNumberRows ? 
                        $query->num_rows()
                        :
                            (  ($query->num_rows() > 0)?$query->result_array():FALSE );
    }

	function update($data){
	    return $this->db->where('id',$this->webid)->update($this->website,$data);
	}
	
	function getExipreTime($id = 0){
	    $d = $this->get_websites($id);
	    if($d->num_rows()){
	        $row = $d->row();
	        if(!empty($row->expire_time) )
	            return $row->expire_time;
	        else
	            return $row->start_time;
	    }
	    return time();
	}
	function running_label($title = ''){
	    $color = 'yellow';
	    if(!empty($this->domain)):
	        $domain = 'https://'.parse_url($this->domain,PHP_URL_PATH);
	        $color = (isSiteAvailible($domain))
	                        ?    'green'
	                        :    'red';
	                        
	            $title =  $title
	                        ? $color == 'green' 
	                                ? 'Running'
	                                :  'Closed'
	                       : '';
	       
	                            
	   endif;
	   
	   return "<label style='background:$color;width:15px;height:15px;border:1px solid black;border-radius:50%'></label> $title";
	}
	public function getOrders($w = []){ 
        
        $this->db->select('details.*,party.partyName');
        $this->db->from('invoice_details as details');
        $this->db->join('party', 'party.partyId = details.partyId');
        $this->db->where(array('details.isDeleted' => 0,'details.admin_id' => $w['admin_id']));
        $Query = $this->db->get();
        if($Query->num_rows() > 0) {
            return $Query->result_array();
        } else {
            return false;
        }
    }
	 public function last_invoiceNo(){ 
        $this->db->select('invoiceNumber');
        $this->db->order_by('invoiceId', 'DESC');
        $Query = $this->db->get('invoice_details',1);
        if($Query->num_rows() > 0) {
            return $Query->row();
        } else {
            return false;
        }
    }
	function get_website_payment($where){
	    return $this->db->where($where)->get('website_payment');
	}
	function get_expire_websites($where = [], $limit = 0,$perPage = 0,$param = ' -11 months'){
	    $all = [];
	    $time = strtotime(date("Y-m-d"). $param );
	    $this->db->where(['reseller_id'=>RID])->where('start_time < ', $time )->where('expire_time','');
	    $this->db->order_by('start_time','desc');
	    if($limit)
	        $this->db->limit($limit,$perPage);
	        return  $this->db->get($this->website);
	    /*
	    foreach( $this->db->get('websites')->result() as $record){
	        $all[] = $record;
	    }
	    
	   // echo '<pre>';
	   // print_r($all);
	   // exit;
	    return $all;*/
	}
	function expire_days_message($days = 0){
	        
	       if(($days) < 0)
                return '+' . abs($days) .' Days  '	 ;
           else if(!$days)
                return 'Today, is Exipre.';
           else
                return abs($days) .' Days To expire.';
	}
	function days_to_expire($id = 0,$flag = false){
	       $web = $this->get_websites($id)->row();
	       $start_time = $web->start_time;
	       //return $start_time;
	       $ttlDays = (int) ( ( time() - $start_time) / (24*60*60) );
	       
	       return $flag
	                ? $ttlDays
	                : $this->expire_days_message(365 - $ttlDays);
	       
                
                
	}

}


?>