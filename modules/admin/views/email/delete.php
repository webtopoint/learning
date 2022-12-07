<?
        try{
            
            $get = $this->db->get_where('emails',['id'=>AJ_DECODE($id)])->row();
           
            $email  = $get->email;
            $id     = $get->id;
            $add_email_address = $this->cPanel->api2->Email->delpop(
                array(
                        'domain'          => FRESH_DOMAIN, 
                        'email'           => $email 
                    ) 
                );
                
           
            
            
                
        } catch(Exception $e) {
            $msg = '<div class="alert alert-danger">ERROR</div>';
        }
        
          $main_result = $add_email_address->cpanelresult->data[0];
      
        
        if($main_result->result){
            $msg = '<div class="alert alert-success">Mail DELETE Successfuly..</div>';
             $this->db->where([ 'id' => $id ])->delete('emails');
        }else{
            $msg = '<div class="alert alert-danger">'.$main_result->reason.'</div>';
        }
        echo $msg;
        ?>
        <script>
            setTimeout(function(){location.href="<?=base_url?>/Admin/email";},3000);
        </script>
        <?php
?>