<?php
class Ajax extends WEB_Controller{
    public $return = ['status' => false,'message' => ''];
    function __construct(){
        parent :: __construct();
    }
    
    function index(){
        $data = array(
                'id' => $plan,
                'qty' => 1,
                'duration' => 1,
                'duration_type' => 'year',
                'option' => '',
                'price' => $price,
                'name' => ucwords($plan),
                'coupon' => ''
            );
        $x = Modules :: run('cart/add_item',['d'=>3],'plan');
        echo '<pre>';
        print_r($data);
    }
    
    function add_plan_without_domain(){
        
        $plan = $this->input->post('plan',true);
        if(isset($this->system_plans[$plan])){
            $price = $this->system_plans[$plan];
            $data = array(
                'id' => $plan,
                'qty' => 1,
                'duration' => 1,
                'duration_type' => 'year',
                'option' => '',
                'price' => $price,
                'name' => ucwords($plan),
                'coupon' => ''
            );
            $return['status'] = Modules :: run('cart/add_item',$data,'plan');
        }
        echo json_encode($return);
    }
    
    function check_domain_for_plan(){
        $post = $this->input->post();
        $domain  = strtolower($post['domain']);
        $tld = isset($post['tld']) ? (strtolower( strpos($post['tld'],'.') == 0 ? substr($post['tld'],1) : $post['tld'] )) : fetch_domain_tld($post['domain'],'tld');
        if($post['type'] == 'register'){
            $keyword = isset($post['tld']) ? $domain : fetch_domain_tld($post['domain'],'domain');//strtolower($post['domain']);
            $domain = "$keyword.$tld";
            
            $this->load->module('domain');
            $fetch = $this->domain->fetch($domain);
            
            if($fetch['type'] == 'available'){
                $price = $fetch['price'];
                
                $html = '<div id="primaryLookupResult" class="domain-lookup-result domain-lookup-primary-results w-hidden unavailable-block" style="display: block;">
                                            <div class="domain-unavailable domain-checker-unavailable headline" style="display: none;"><span class="domainSearch"><i class="far fa-times-circle"></i><br></span> <strong>'.$domain.'</strong> is unavailable</div>
                                            <div class="domain-available domain-checker-available headline" style="display:block ;"><span class="domainSearch"><i class="far fa-check-circle"></i><br></span> Congratulations! <strong>'.$domain.'</strong> is available!
                                                <div class="domain-price">
                                                    <span class="register-price-label">Continue to register this domain for</span>
                                                    <span class="price mb-0"><i class="fa fa-rupee"></i>  '.$price.' /Yr</span>
                                                </div>
                                            </div>';
                            $html .= Modules :: run('cart/domain_button',$domain);
                $html .='</div>';
            }
            else{
                $html = '<div id="primaryLookupResult" class="domain-lookup-result domain-lookup-primary-results w-hidden unavailable-block" style="display: block;">
                                            <div class="domain-unavailable domain-checker-unavailable headline" style="display: block;"><span class="domainSearch"><i class="far fa-times-circle"></i><br></span> <strong>'.$domain.'</strong> is unavailable</div>
                                            <div class="domain-available domain-checker-available headline" style="display: none;"><span class="domainSearch"><i class="far fa-check-circle"></i><br></span> Congratulations! <strong></strong> is available!
                                               
                                            </div>
                            
                                        </div>';
            }
            
            $this->return['message'] = $html;
            
            
            
        }
        
        echo json_encode($this->return);
    }
    
    function plan_details(){
        if($post = $this->input->post()){
            $theme_id = 0;
            $return['price'] = 0;
            $gettheme_id = $this->db->where('id',$post['theme_id'])->get('plans');
            if($gettheme_id->num_rows()){
                $this->load->model('tool/ThemeModel','TM');
                $theme_id = $gettheme_id->row()->theme_type_id;
                $return['price'] = $gettheme_id->row()->price;
                $return['html']  =  '
                    <div class="item form-data " style="padding:0">
                       <label class="control-label" for="select_theme">Select Theme</label>
                       <select id="select_theme" class="form-control" name="theme_id" required="required" >
                            <option label="Choose any one theme"></option>';
                            
                            $eThemes = $this->TM->getAllTheme(['type'=>$theme_id])->result_array();
                            foreach($eThemes as $theme)
                              $return['html']  .=  '<option value="'.$theme['id'].'">'.ucwords($theme['theme_name']).'</option>';
                            $return['html']  .=  '</select>
                               
                                <div class="loader-1" style="display:none">
                                    <i class="fa fa-spin fa-spinner" aria-hidden="true" style="font-size:20px"></i>
                                </div>
                            </div>
                            
                            <script>
                                var second_base = "'.base_url('ajax/view_theme').'";
                     
                                $("#select_theme").change(function(){
                                    var w = this,loader = $(w).parent().parent().find(".loader-1");
                                    loader.show();
                                    
                                    $.ajax({
                                        type:"post",
                                        url:second_base,
                                        data:{theme_id:w.value},
                                        dataType:"json",
                                        success:function(_res){
                                            $(".theme_view").html((w.value)?_res.html:"");
                                            loader.hide();
                                        },
                                        error:function(a,b,c){
                                            console.log(a);
                                            loader.hide();
                                        }
                                    });
                                });
                            </script>
                            ';
            }
            else{
                $return['html'] = '<b class="text-red">Something Went Wrong</b>'.form_hidden('theme_id',1);
            }
            
            echo json_encode($return);
        }
    }
    
}


?>