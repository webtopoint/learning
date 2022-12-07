<?php
class Auth_model extends CI_Model{
    
    function login($email,$password){
        // $password = md5($password);
        $get = $this->db->get_where('accounts',['email' => $email]);
        $response = ['status' => false,'message' => 'Something Went Wrong Please Try Again.'];
        if($get->num_rows()){
            $row = $get->row();
            $response['message'] = 'Wrong Username or Password.';
            if($response['status'] = ($row->password == md5($password))){
                $this->back_login($row);
                $response['message'] = "Welcome $row->name Dear";
                $response['url'] = base_url('admin');
            }
        }
        else
            $response['message'] = "This $email Email is not exists..";
            
            
        return $response;
    }
    
    function back_login($row){
        $data = [
                    'name' => $row->name,
                    'email' => $row->email,
                    'reseller_id' => $row->id,
                    'reseller_login' => true
            
            ];
        $this->session->set_userdata($data);
    }
    
}



?>