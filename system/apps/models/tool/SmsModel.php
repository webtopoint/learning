<?php
class SmsModel extends CI_Model{
    
    function createSMSPanel(){
        
        $d = $this->db->get_where('sms_setting',['admin_id'=>CLIENT_ID]);
        
        if($d->num_rows())
            return (array) $d->row();
        else{
            $this->db->insert('sms_setting',['admin_id'=>CLIENT_ID]);
            return $this->createSMSPanel();
        }
    }
    
    function update( $post ){
        return $this->db->where('id',$this->createSMSPanel()['id'])->update('sms_setting',$post);
    }
    function updateMessage($id , $data){
        return $this->db->where('id',$id)->update('message',$data);
    }
    function addMessage($d){
        return $this->db->insert('message',$d);
    }
    function listMessage($id = 0, $type = 'sms'){
        if($id)
            $this->db->where(['form_id'=>$id,'status' => 1]);
        return $this->db->get_where('message',['admin_id' => CLIENT_ID, 'type'=>$type])->result_array();
    }
    function sendSMS($rwo,$post,$labels){
        $newLabel = [];
        foreach($labels as $t => $s){
            $newLabel['['.$s.']'] = isset($post['field_'.$t]) ? $post['field_'.$t] : '';
        }
        
        $msg = '';
        
            if($rwo->sms){
                foreach($this->listMessage($rwo->id) as $t){
                  
                    $msg = str_replace( '&nbsp;',' ',strip_tags( str_replace(['<p>','</p>'],[" ","\n"],$t['message']) ));
                  
                    foreach($newLabel as $key => $value){
                        $msg = trim( str_replace($key,$value,$msg) , "\xC2\xA0");
                    }
                    if(isJson($t['send_by'])){
                        
                        $send_by = (array)json_decode($t['send_by']);
                        $mobile = '';
                        foreach($send_by as $by){
                            $mobile = trim( trim( ($post[$by]).',' ,',') );
                        }
                         \C::SEND_MOBILE_MESSAGE($mobile,$msg);
                        
                    }
                    
                }
            
            }
            
            if($rwo->email){
                foreach($this->listMessage($rwo->id,'email') as $t){
                  
                    $msg = $t['message'];
                  
                    foreach($newLabel as $key => $value){
                        $msg =  str_replace($key,$value,$msg) ;
                    }
                    if(isJson($t['send_by'])){
                        
                        $send_by = (array)json_decode($t['send_by']);
                        $email = [];
                        foreach($send_by as $by){
                            $email[] = filter_var($post[$by], FILTER_SANITIZE_EMAIL);
                        }
                        $system_email = empty($t['from_email']) ? 'noreply@'.getDomain() : $t['from_email'];
                         $this->do_email( $system_email , $t['email_title'] , $email , $t['subject'] , $msg );
                        
                    }
                    
                }
            }
            
        return;
    }
     function do_email($from = '', $from_name = '', $to = '', $sub = '', $msg = '',$mail_type = false)
    {

        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $config['priority'] = 1;
		$config['mailtype'] = $mail_type ? $mail_type : 'html';


        if (!empty($config)) {
            $this->email->initialize($config);
        }

        $this->email->from($from, $from_name);
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($msg);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
    
}
?>