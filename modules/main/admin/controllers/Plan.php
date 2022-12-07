<?php

class Plan extends Main_Controller{
    function __construct(){
        parent :: __construct();
    }
    
    
    function index(){
        $this->list();
    }
    function list(){
        $this->crud ->set_table('plans')
                    ->unset_read()
	                ->unset_clone() 
	                ->add_action('Permission','','','file',array($this,'list_permission_btn'))
	                ->field_type('status','dropdown',$this->select_status)
	                ->field_type('price','integer')
	                ->required_fields('title','price','status','description');
	                
        $data = $this->crud->render();
        $state = $this->crud->getState();
        if($state == 'add'){
            $data->output .= '<script>
                                    $("textarea").val(`<ul class="list-unstyled pricing-feature-list">
                                    <li id="product24-description">
                                        <ul class="list-unstyled pricing-feature-list"><br>
                                            <li><span>1</span> Website</li><br>
                                            <li><span>10 GB</span> RAID Storage</li><br>
                                            <li><span> Unlimited </span> Bandwidth</li><br>
                                            <li><span>Free</span> SSL Certificate</li><br>
                                            <li><span>Free Domain</span> Included</li><br>
                                            <li><span>99.99%</span> Uptime</li><br>
                                            <li><span>24/7</span> Phone Support</li><br>
                                            <li>Free Site Backup &amp; Restore (Condition Apply)</li><br>
                                        </ul>
                                    </li>
                                </ul>`);
                              </script>';
        }
        $this->render($data);
    }
    
    function plan_set_in_page(){
    //   $data['output'] = ;
       $this->render(['output' => Modules :: run('addons/set_in_page','plan',true)]);
    }
    
    function list_permission_btn($primary_key , $row){
        return site_url('admin/plan/permission/'.$primary_key);
    }
    
}



?>