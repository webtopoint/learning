<?php
class ThemeModel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this-> db = $this->load->database('tool',true);
    }
    
    function get_theme_menu($theme_id = 0){
		if(is_array($theme_id)){
			$this->db->where($theme_id);
		}
		elseif($theme_id){
			$this->db->where('id',$theme_id);
		}
		return $this->db->get('theme_menu');
	}
	function isValidMenu($method = '',$returnNum = false){
	    if($method){
	        $methods = $this->db->where(['theme_id' => THEME_ID,'status'=>1,'method' => $method])->get('theme_menu');
	        return $returnNum ? $methods->num_rows() : $methods->row();
	    }
	    return false;
	}
    function getMenu(){
        $item = $ref = [];
        $get = $this->db->where(['theme_id' => THEME_ID,'status' => 1])->order_by('seq','ASC')->get('theme_menu');
        if($get->num_rows()){
            foreach($get->result() as $row){
                $thisRef = &$ref[$row->id];
                $thisRef['label'] = $row->title;
                $thisRef['method'] = $row->method;
                if($row->parent_id == 0)
                    $item[$row->id] = &$thisRef;
                else
                    $item[$row->parent_id]['child'][$row->id] = &$thisRef;
            }
            return $item;
        }
        return false;
    }
    public function getAllTheme($where=array()){
        if(count($where))
           $this->db->where($where);
        return $this->db->get('web_themes');
    }
    public function setCustomCss($data)
    {
    	if($this->db->where(array('element'=>$data['element'],'admin_id'=>CLIENT_ID))->get('custom_css')->num_rows())
    		$this->db->where(array('element'=>$data['element'],'admin_id'=>CLIENT_ID))->update('custom_css',$data);
    	else
    		$this->db->insert('custom_css',$data);

    }
    
    function get_theme_templates($id = 0,$field = 'all'){

        if($id)
            $this->db->where('id',$id);
        $get = $this->db->get_where('theme_template',['theme_id' => THEME_ID]);
        
            
        $temp = ($get->num_rows()) ? 
              $get->result_array() : [];
        
        /*
              
        $temp[] = [
                'title' => 'test',
                'description' => 'test',
                'content' => '<div class="section-full bg-img-fix content-inner-2 overlay-black-dark contact-action style2" >
				<div class="container">
					<div class="row relative">
						<div class="col-md-12 col-lg-8 wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInLeft;">
							<div class="contact-no-area">
								<h2 class="title">Create your free account now and get immediate access to 100s of online courses.</h2>
								<form action="script/mailchamp.php" method="post" class="dzSubscribe subscribe-box row align-items-center sp15">
									<div class="col-lg-12">
										<div class="dzSubscribeMsg"></div>
									</div>
									<div class="col-lg-4 col-md-4">
										<div class="input-group">
											<input name="dzName" required="required" type="text" class="form-control" placeholder="Your Name ">
										</div>
									</div>
									<div class="col-lg-4 col-md-4">
										<div class="input-group">
											<input name="dzEmail" required="required" type="email" class="form-control" placeholder="Your Email Address">
										</div>
									</div>
									<div class="col-lg-4 col-md-4">
										<div class="input-group">
											<button name="submit" value="Submit" type="submit" class="site-button btn-block btnhover13">Subscribe</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-12 col-lg-4 contact-img-bx wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.2s; animation-name: fadeInRight;">
							<img src="_theme_url_/images/pic1.png" alt="">	
						</div>
					</div>
				</div>
			</div>'
            ];
        */
            return ($id) ? ( $get->num_rows() ? ( $field  == 'all' ? $get->row() : $get->row()->{$field} ) : '' )
                        :
                         str_replace('_theme_url_',theme_url(),json_encode($temp));
    }

    public function getCustomCss($where)
    {
    	return $this->db->where($where)->where('admin_id',CLIENT_ID)->get('custom_css');
    }
}