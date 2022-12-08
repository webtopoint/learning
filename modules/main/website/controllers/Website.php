<?php
use Utopia\Domains\Domain;
class Website extends Main_Controller{
    function __construct(){
        parent :: __construct();
        $this->DB = $this->load->database('tool',true);
        $this->load->model('WebsiteModel');
        // exit('a');
    }
    function update_status(){
        $this->WebsiteModel->id($_POST['id'])->update(['active' => $_POST['status']]);
        echo json_encode(['status' => true,'message' => ( $_POST['status'] ? 'Active' : 'De-Active' ) ]);
    }
    function list(){
        $this->load->library('Ajax_pagination');
        //total rows count
        $totalRec = count($this->WebsiteModel->getRows());
        
        //pagination configuration
        $config = $this->pagination_ul();
        $config['target']      = '#list_website';
        $config['base_url']    = base_url().'website/ajaxPaginationwebsiteData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = 10;
        $config['link_func']   = 'searchFilter';
        $config['uri_segment'] = 3;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['websites'] = $this->WebsiteModel->getRows(array('limit'=>10));
        
        return $this->load->view('list',$data,true);
    }
    function create(){
        if($post = $this->input->post()){
             $this-> db = $this->load->database('tool',true);
            $domain = trim(strtolower($post['domain_name']));//,FILTER_SANITIZE_DOMAIN);
            unset($post['domain_name']);
            // $data = ['status' => false, 'html' => 'wallet balance is '.amount(isReseller('wallet',$post['parent_id']))];
            $this->form_validation->set_rules('domain_name',$domain,'required'); 
            $this->form_validation->set_rules('email','Email','required');
            if($this->form_validation->run() == FALSE){
                $data = ['status' => false,'html' => validation_errors('<div class="alert alert-danger">','</div>')];
            }
            else{
                if(isset($post['theme_id'])){
                    $response = $this->domain_add($domain);
                    if(is_bool($response)){
                        // $plan = $plan->row();
                        $time = time();
                        $details = json_encode([
                                'payment_receive'   => $post['payment_receive'],
                                'total_payment'     => $post['total_payment'],
                                'arrearages'        => $post['total_payment'] - $post['payment_receive'],
                                'payment_mode'      => $post['payment_mode'],
                                'payment_info'      => $post['payment_info'],
                                'address'           => $post['address'],
                                'city'              => $post['city'],
                                'state'             => $post['state'],
                                'pincode'           => $post['pincode'],
                                'company_name'      => $post['company_name'],
                                'gst_no'            => $post['gst_no']
                            ]);
                        
                        $website = array(
                                                'name'          =>      ucwords($post['firstname']),
                                                'last_name'     =>      $post['lastname'],
                                                'reseller_id'   =>      $post['parent_id'],
                                                'domain_name'   =>      $domain,
                                                '_email'        =>      $post['email'],
                                                '_pass'         =>      $post['password'],
                                                'phone'         =>      $post['mobile'],
                                                'status'        =>      '1',
                                                'start_time'    =>      $time,
                                                'duration'       =>     1,//$post['duration'],
                                                'default_page_id'=>     '0',
                                                'details'       =>      $details,
                                                'theme_id'      =>      $post['theme_id'],
                                                'free_domain'   =>      '',
                                                'domain_info'   =>      '',
                                                'plan_id'       =>      $post['plan_id'],
                                                'account_manager_id' => $post['account_manager_id']
                                );
                        switch('informative'){
                            case 'informative':
                                $this->DB->insert('websites',$website);
                                $wid = $this->DB->insert_id();
                                if($post['payment_receive'] > 0)
                                    $this->DB->insert('website_payment',['payment_time' => $time, 'amount' => $post['payment_receive'] ,'payment_status' => $post['payment_status'], 'payment_info' => $post['payment_info'] ,'admin_id' => $wid,'payment_mode' => $post['payment_mode'], 'dis_type' => $post['dis_type'], 'dis_value' =>  $post['dis_value'],'pay_amount' => $post['total_payment'] ]);
                                
                                if(!mkdir('public/temp/'.$wid))
                                    $this->session->set_flashdata('error','Unable to Create Directory for website.');    
                                
                                $this->DB->insert('admin_theme',array('top_bar'=>'bg-focus header-text-light','slider_bar'=>'bg-dark sidebar-text-light','admin_id'=>$wid));
                                $this->DB->insert('counter',array('admin_id'=>$wid,'val'=>0));
            
                                $this->DB->insert('menu_css',array('admin_id'=>$wid));
            
                                $this->DB->insert('storage',array('admin_id'=>$wid,'email_limit'=>5,'page_limit'=>10,'email_storage'=>104857600));
                                
                                $this->DB->insert('website_data',array('admin_id'=>$wid));
                                
                            
                                
                                $this->DB->set('default_page_id',$this->install_informative($wid))->where('id',$wid)->update('websites');
                            break;
                            
                            case 'ecommerce':
                                  $this->DB->insert('websites',$website);
                                
                                $wid = $this->DB->insert_id();
                                
                                if($post['payment_receive'] > 0)
                                    $this->DB->insert('website_payment',['payment_time' => $time, 'amount' => $post['payment_receive'] ,'payment_status' => $post['payment_status'], 'payment_info' => $post['payment_info'] ,'admin_id' => $wid,'payment_mode'      => $post['payment_mode'], 'dis_type' => $post['dis_type'], 'dis_value' =>  $post['dis_value'],'pay_amount' => $post['total_payment']]);
                                
                                if(!mkdir('public/temp/'.$wid)) 
                                    $this->session->set_flashdata('error','Unable to Create Directory for website');    
                                
                                $edb = $this->w999->database(EDB_NAME,true);//load_ecommerce_database();
                                $edb->insert('logo',['admin_id'=>$wid]);
                                $logo_id = $edb->insert_id();
                                
                                if(!copy('uploads/logo.png','public/temp/'.$wid.'/logo_'.$logo_id.'.png'))
                                    $this->session->set_flashdata('error','Unable to Create Logo for website');
                                
                                
                                if(!copy('uploads/others/parralax_vendor.jpg','public/temp/'.$wid.'/parralax_vendor.jpg'))
                                    $this->session->set_flashdata('error','Unable to Create parralax_vendor for website');
                                
                                
                                if(!copy('uploads/others/parralax_search.jpg','public/temp/'.$wid.'/parralax_search.jpg'))
                                    $this->session->set_flashdata('error','Unable to Create parralax_search for website');
                                
                                
                                if(!copy('uploads/others/parralax_blog.jpg','public/temp/'.$wid.'/parralax_blog.jpg'))
                                    $this->session->set_flashdata('error','Unable to Create parralax_blog.jpg for website');
                                
                                
                                $general_setting = $edb->get_where('general_settings',['admin_id'=>0]);
                                foreach($general_setting->result()  as $k => $g){
                                    $edb->insert('general_settings',array('general_settings_id'=>$g->general_settings_id,'type'=>$g->type,'value'=>$g->value,'admin_id'=>$wid));
                                }
                                $email_template = $edb->get_where('email_template',['admin_id'=>0]);
                                foreach($email_template->result() as $k => $email){
                                    $edb->insert('email_template',array('title'=>$email->title,'subject'=>$email->subject,' body'=>$email->body,'admin_id'=>$wid));
                                }
                                $business_settings = $edb->get_where('business_settings',['admin_id'=>0]);
                                foreach($business_settings->result() as $ki => $bus){
                                    $edb->insert('business_settings',array('business_settings_id'=>$bus->business_settings_id,'type'=>$bus->type,'status'=>$bus->status,'value'=>$bus->value,'admin_id'=>$wid));
                                }
                                $ui_settings = $edb->get_where('ui_settings',['admin_id'=>0]);
                                foreach($ui_settings->result() as $ok => $ui){
                                    $ui_value = $ui->value;
                                    if($ui->type == 'admin_login_logo' || $ui->type == 'admin_nav_logo' || $ui->type == 'home_top_logo' || $ui->type == 'home_bottom_logo')
                                    $ui_value = $logo_id;
                                    
                                    $edb->insert('ui_settings',array('ui_settings_id'=>$ui->ui_settings_id,'type'=>$ui->type,'value'=>$ui_value,'admin_id'=>$wid));
                                }
                                $social = $edb->get_where('social_links',['admin_id'=>0]);
                                foreach($social->result() as $i => $sss){
                                    $edb->insert('social_links',array('type'=>$sss->type,'value'=>$sss->value,'admin_id'=>$wid));
                                }
                                
                                $edb->where(['admin_id'=>$wid,'general_settings_id'=>58]);
                                $edb->update('general_settings',['value'=>isset($post['multivendor']) ? 'ok' : 'no']);
                            break;
                        }
                        
                        /*
                         $this->db->insert('wallet',[
                            'transaction_id' => $time,
                            'transaction'    => $post['total_payment'],
                            'balance'        => 0,
                            'report_by'      =>  'website',
                            'report_by_id'   =>  $wid,
                            'type'           =>  'DR',
                            'message'        =>   'Create Website',
                            'parent_id'      =>  $web->id
                        ]);
                        */
                        $data = ['status' => true, 'html' => '<div class="alert alert-success">Wesite Created Successfully..</div>' ];
                    }
                    else{
                        $data = ['status' => false, 'html' => '<div class="alert alert-danger">'.$response.'</div>' ];
                    }
                }
                else
                    $data = ['status' => false,'html' => 'Something Went Wrong..'];
            }
            echo json_encode($data);
        }
        else
            return $this->load->view('create',[],true);
    }
    function ajaxPaginationwebsiteData(){
        
        // $this->self['page'] = 'website/ajax-pagination-list';
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        $limit = 10;
        if($this->input->post('limit'))
            $limit  = $this->input->post('limit');
        
        //total rows count
        $totalRec = ($this->WebsiteModel->getRows($conditions,true));
        
        //pagination configuration
        $config = $this->pagination_ul();
        $config['target']      = '#list_website';
        $config['base_url']    = base_url().'website/ajaxPaginationwebsiteData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $limit;
        $config['link_func']   = 'searchFilter';
        $config['uri_segment'] = 3;
        
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $limit;
        
        //get posts data
        $data['websites'] = $this->WebsiteModel->getRows($conditions);
        $data['isAjax'] = true;
        //print_r($this->self);
        // //load the view
        $this->load->view('list', $data, false);
    }
    function pagination_ul(){
        $config = [];
        $config['full_tag_open'] = '<ul class="pagination pagination-dark mg-b-0">';

        $config['full_tag_close'] = '</ul>';

        //$config['use_page_numbers'] = false;

        $config['next_link'] = '<i class="fas fa-angle-double-right"></i>';
        $config['next_tag_open'] = '<li  class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = ' <i class="fas fa-angle-double-left"></i>';
        $config['prev_tag_open'] = '<li  class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active page-item"><a class="page-link" href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        return $config;
    }
    function install_informative($admin_id){
      
        $content = '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>';
    
        $pages = [
            'Home'                  =>  ['',$content],
            'About Us'              =>  ['about_us_page.gif',$content],
            'Product & Service'     =>  ['service_banner.jpg',$content],
            'Photo Gallery'         =>  ['photo_gallery_header.jpg',$content],
            'Video Gallery'         =>  ['gallery_header.png',$content]
        ];
        $ret = $page_id = $i = 0;
        foreach($pages as $page => $v){
            
            
            $this->DB->insert('his_pages',['page_name'=>$page,'admin_id'=>$admin_id]);
            $page_id = $this->DB->insert_id();
            
            $this->DB->insert('web_schema',['type'=>'content','key_id'=>0,'seq'=>0,'admin_id'=>$admin_id,'page_id'=>$page_id]);
            if( !empty( $v[0] ) )
                @copy('public/install/'.$v[0],'public/temp/'.$admin_id.'/'.$v[0]);
            $this->DB->insert('his_page_content',['page_id'=>$page_id,'title'=>$page,'admin_id'=>$admin_id,'heading_image' => $v[0],'heading_height'=>250,'content'=>$v[1] ]);
            $ret = ( !$ret ) ? $page_id : $ret;
            $this->DB->insert('menu',[ 'label' => $page, 'type' => 'page', 'sort' => ++$i, 'page_id' => $page_id, 'admin_id' => $admin_id ]);   
            
        }
        
        $this->DB->insert('image_gallery',['gallery_name' => 'Gallery Image', 'layout' => 4, 'admin_id' => $admin_id ]);
        $key = $this->DB->insert_id();
        for($i = 1; $i <= 4; $i++){
            @copy('public/install/image_'.$i.'.jpg','public/temp/'.$admin_id.'/image_'.$i.'.jpg');
            $this->DB->insert('gallery_images',['gallery_id' => $key , 'image' => 'image_'.$i.'.jpg' , 'admin_id' => $admin_id ]);
            
            $this->DB->insert('gallery_link',[
                    'gal_id'  =>   $this->DB->insert_id(),
                    'page_id' =>  ( $ret + 3 ),
                    'admin_id'  =>   $admin_id
            ]);
        }
        $this->DB->insert('web_schema',['type'=>'igallery','key_id'=>$key,'seq'=>0,'admin_id'=>$admin_id,'page_id'=>( $ret + 3 )]);
        
        $this->DB->insert('product_gallery',['gallery_name' => 'Product & Service Gallery Image', 'layout' => 4, 'btn_css' => '{"text":"Buy Now","color":"#ffffff","textHover":"#000000","backColor":"#000000","backHover":"#ffffff","Bsize":"4","Bcolor":"#000000","Bstyle":"double","padL":"15","padR":"15","padT":"5","padB":"5"}', 'admin_id' => $admin_id ]);
        $key = $this->DB->insert_id();
        
        for($i = 1; $i <= 4; $i++){
            
            @copy('public/install/product_'.$i.'.jpg','public/temp/'.$admin_id.'/product_'.$i.'.jpg');
            $this->DB->insert('product_gallery_images',[
                    'title'         =>  'Product Title '.$i,
                    'image'         =>  'product_'.$i.'.jpg',
                    'description'   =>  '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>',
                    'gallery_id'    =>  $key,
                    'admin_id'      =>  $admin_id
            ]);
                
            $this->DB->insert('product_gallery_link',[
                'gal_id' => $this->DB->insert_id(),
                'page_id' => ($ret + 2),
                'admin_id' => $admin_id
            ]);
            
        }
        
        $this->DB->insert('web_schema',['type'=>'pgallery','key_id'=>$key,'seq'=>0,'admin_id'=>$admin_id,'page_id'=>( $ret + 2 )]);
        
        $this->DB->insert('video_gallery',['gallery_name' => 'Gallery Image', 'layout' => 4, 'admin_id' => $admin_id ]);
        $key = $this->DB->insert_id();
        
        for($i = 0; $i <=3; $i++){
            
            $this->DB->insert('gallery_videos',[
                'gallery_id' => $key,
                'video' =>  '', 
                'admin_id' => $admin_id
            ]);
            
            $this->DB->insert('video_gallery_link',[
                'gal_id'    => $key,
                'admin_id'  => $admin_id,
                'page_id'   => ($ret + 4) 
            ]);
            
        }
        
        $this->DB->insert('web_schema',['type'=>'vgallery','key_id'=>$key,'seq'=>0,'admin_id'=>$admin_id,'page_id'=>( $ret + 4 )]);
        
        $getDomain = $this->DB->get_where('websites',['id' => $admin_id ])->row()->domain_name;
        for( $i = 1;  $i <= 3; $i++ ){
            
            @copy('public/install/slider_'.$i.'.jpg','public/temp/'.$admin_id.'/slider_'.$i.'.jpg');
   
           $data[] = 'http://'.$getDomain.'/public/temp/'.$admin_id.'/slider_'.$i.'.jpg'; 
            
        } 
        
        $this->DB->insert('carousel',[
                    'name' => 'Home',
                    'images' => json_encode($data),
                    'details' => '{"perSlide":"1","speed":"normal","height":"400"}',
                    'admin_id' => $admin_id
        ]);
        $key = $this->DB->insert_id();
        $this->DB->insert('carousel_link',[
                    'car_id' => $key,
                    'page_id'   =>  $ret,
                    'admin_id'  =>  $admin_id
        ]);
        
        $this->DB->insert('web_schema',['type'=>'slider','key_id'=>$key,'seq'=>1,'admin_id'=>$admin_id,'page_id'=>$ret]);
        $this->DB->where(['admin_id'=>$admin_id,'type'=>'content'])->update('web_schema',['seq'=>2]);
        
         for( $i = 1;  $i <= 4; $i++ ){
            
            @copy('public/install/slider-'.$i.'.jpg','public/temp/'.$admin_id.'/slider-'.$i.'.jpg');
          
           $data[] = 'http://'.$getDomain.'/public/temp/'.$admin_id.'/slider-'.$i.'.jpg'; 
            
        }
        
        
        $this->DB->insert('carousel',[
                    'name' => 'Slider',
                    'images' => json_encode($data),
                    'details' => '{"perSlide":"4","speed":"normal","height":"300"}',
                    'admin_id' => $admin_id
        ]);
        $key = $this->DB->insert_id();
        $this->DB->insert('carousel_link',[
                    'car_id' => $key,
                    'page_id'   =>  $ret,
                    'admin_id'  =>  $admin_id
        ]);
        $this->DB->insert('web_schema',['type'=>'slider','key_id'=>$key,'seq'=>3,'admin_id'=>$admin_id,'page_id'=>$ret]);
        
        $i = 1;
        foreach($this->DB->get_where('widget_table',['admin_id'=>0])->result() as $wid){
            
            $this->DB->insert('widget_table',[
                            'widget_type'       =>  $wid->widget_type,
                            'widget_title'      =>  $wid->widget_title,
                            'widget_data'       =>  $wid->widget_data,
                            'widget_metadata'   =>  $wid->widget_metadata,
                            'admin_id'          =>  $admin_id
            ]);
            
            $this->DB->insert('widget_link',[
                'pos_type'      =>      'footer',
                'page_id'       =>      'all',
                'widget_id'     =>      $this->DB->insert_id(),
                'sequence'      =>      $i++,
                'admin_id'      =>      $admin_id
            ]);
            
            
        }
        
        return $ret;
    }
    
    function test(){
        $post = [
            'payment_receive' => '1499',
            'total_payment'   => '1499',
            'payment_mode'    => 'cash',
            'payment_info'     => 'done',
            'address'   => '',
            'city'   => '',
            'state'  => '',
            'pincode' => '',
            'company_name' => '',
            'gst_no' => '',
            'firstname' => 'Raman',
            'lastname' => 'Singh',
            'parent_id'  => 0,
            'email' => 'ajay@gmail.com',
            'theme_id' => '1',
            'plan_id' => 1,
            'account_manager_id' => 0,
            'password' => 'admin',
            'mobile' => '8533898539',
            'payment_status' => 'success',
            'dis_type' => '',
            'dis_value' => ''
        ];

        $domain = 'baalgopalkids.com';

        $time = time();
        $details = json_encode([
                'payment_receive'   => $post['payment_receive'],
                'total_payment'     => $post['total_payment'],
                'arrearages'        => $post['total_payment'] - $post['payment_receive'],
                'payment_mode'      => $post['payment_mode'],
                'payment_info'      => $post['payment_info'],
                'address'           => $post['address'],
                'city'              => $post['city'],
                'state'             => $post['state'],
                'pincode'           => $post['pincode'],
                'company_name'      => $post['company_name'],
                'gst_no'            => $post['gst_no']
            ]);
        
        $website = array(
                                'name'          =>      ucwords($post['firstname']),
                                'last_name'     =>      $post['lastname'],
                                'reseller_id'   =>      $post['parent_id'],
                                'domain_name'   =>      $domain,
                                '_email'        =>      $post['email'],
                                '_pass'         =>      $post['password'],
                                'phone'         =>      $post['mobile'],
                                'status'        =>      '1',
                                'start_time'    =>      $time,
                                'duration'       =>     1,//$post['duration'],
                                'default_page_id'=>     '0',
                                'details'       =>      $details,
                                'theme_id'      =>      $post['theme_id'],
                                'free_domain'   =>      '',
                                'domain_info'   =>      '',
                                'plan_id'       =>      $post['plan_id'],
                                'account_manager_id' => $post['account_manager_id']
                );

                // pre($website,true);
        switch('informative'){
            case 'informative':
                $this->DB->insert('websites',$website);
                $wid = $this->DB->insert_id();
                if($post['payment_receive'] > 0)
                    $this->DB->insert('website_payment',['payment_time' => $time, 'amount' => $post['payment_receive'] ,'payment_status' => $post['payment_status'], 'payment_info' => $post['payment_info'] ,'admin_id' => $wid,'payment_mode' => $post['payment_mode'], 'dis_type' => $post['dis_type'], 'dis_value' =>  $post['dis_value'],'pay_amount' => $post['total_payment'] ]);
                
                if(!mkdir('public/temp/'.$wid))
                    $this->session->set_flashdata('error','Unable to Create Directory for website.');    
                
                $this->DB->insert('admin_theme',array('top_bar'=>'bg-focus header-text-light','slider_bar'=>'bg-dark sidebar-text-light','admin_id'=>$wid));
                $this->DB->insert('counter',array('admin_id'=>$wid,'val'=>0));

                $this->DB->insert('menu_css',array('admin_id'=>$wid));

                $this->DB->insert('storage',array('admin_id'=>$wid,'email_limit'=>5,'page_limit'=>10,'email_storage'=>104857600));
                
                $this->DB->insert('website_data',array('admin_id'=>$wid));
                
            
                
                $this->DB->set('default_page_id',$this->install_informative($wid))->where('id',$wid)->update('websites');
            break;
            
            case 'ecommerce':
                    $this->DB->insert('websites',$website);
                
                $wid = $this->DB->insert_id();
                
                if($post['payment_receive'] > 0)
                    $this->DB->insert('website_payment',['payment_time' => $time, 'amount' => $post['payment_receive'] ,'payment_status' => $post['payment_status'], 'payment_info' => $post['payment_info'] ,'admin_id' => $wid,'payment_mode'      => $post['payment_mode'], 'dis_type' => $post['dis_type'], 'dis_value' =>  $post['dis_value'],'pay_amount' => $post['total_payment']]);
                
                if(!mkdir('public/temp/'.$wid)) 
                    $this->session->set_flashdata('error','Unable to Create Directory for website');    
                
                $edb = $this->w999->database(EDB_NAME,true);//load_ecommerce_database();
                $edb->insert('logo',['admin_id'=>$wid]);
                $logo_id = $edb->insert_id();
                
                if(!copy('uploads/logo.png','public/temp/'.$wid.'/logo_'.$logo_id.'.png'))
                    $this->session->set_flashdata('error','Unable to Create Logo for website');
                
                
                if(!copy('uploads/others/parralax_vendor.jpg','public/temp/'.$wid.'/parralax_vendor.jpg'))
                    $this->session->set_flashdata('error','Unable to Create parralax_vendor for website');
                
                
                if(!copy('uploads/others/parralax_search.jpg','public/temp/'.$wid.'/parralax_search.jpg'))
                    $this->session->set_flashdata('error','Unable to Create parralax_search for website');
                
                
                if(!copy('uploads/others/parralax_blog.jpg','public/temp/'.$wid.'/parralax_blog.jpg'))
                    $this->session->set_flashdata('error','Unable to Create parralax_blog.jpg for website');
                
                
                $general_setting = $edb->get_where('general_settings',['admin_id'=>0]);
                foreach($general_setting->result()  as $k => $g){
                    $edb->insert('general_settings',array('general_settings_id'=>$g->general_settings_id,'type'=>$g->type,'value'=>$g->value,'admin_id'=>$wid));
                }
                $email_template = $edb->get_where('email_template',['admin_id'=>0]);
                foreach($email_template->result() as $k => $email){
                    $edb->insert('email_template',array('title'=>$email->title,'subject'=>$email->subject,' body'=>$email->body,'admin_id'=>$wid));
                }
                $business_settings = $edb->get_where('business_settings',['admin_id'=>0]);
                foreach($business_settings->result() as $ki => $bus){
                    $edb->insert('business_settings',array('business_settings_id'=>$bus->business_settings_id,'type'=>$bus->type,'status'=>$bus->status,'value'=>$bus->value,'admin_id'=>$wid));
                }
                $ui_settings = $edb->get_where('ui_settings',['admin_id'=>0]);
                foreach($ui_settings->result() as $ok => $ui){
                    $ui_value = $ui->value;
                    if($ui->type == 'admin_login_logo' || $ui->type == 'admin_nav_logo' || $ui->type == 'home_top_logo' || $ui->type == 'home_bottom_logo')
                    $ui_value = $logo_id;
                    
                    $edb->insert('ui_settings',array('ui_settings_id'=>$ui->ui_settings_id,'type'=>$ui->type,'value'=>$ui_value,'admin_id'=>$wid));
                }
                $social = $edb->get_where('social_links',['admin_id'=>0]);
                foreach($social->result() as $i => $sss){
                    $edb->insert('social_links',array('type'=>$sss->type,'value'=>$sss->value,'admin_id'=>$wid));
                }
                
                $edb->where(['admin_id'=>$wid,'general_settings_id'=>58]);
                $edb->update('general_settings',['value'=>isset($post['multivendor']) ? 'ok' : 'no']);
            break;
        }
        echo 'done';
        exit;
        // $domain  =  'demo.bizknowindia.org.in';
        // echo $this->domain_add('ajay.business.in');
        // $testArray = array(
        //     'sub1.sub2.example.co.uk',
        //     'sub1.example.com',
        //     'shahuagri.business.in',
        //     'sub1.sub2.sub3.example.co.uk',
        //     'sub1.sub2.sub3.example.com',
        //     'sub1.sub2.example.com'
        // );
        // echo '<pre>';
        // foreach($testArray as $k => $v)
        // {
        //     echo $k." => ".extract_subdomains($v)."\n";
        // }
        
        // function extract_domain($domain)
        // {
        //     if(preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", $domain, $matches))
        //     {
        //         return $matches['domain'];
        //     } else {
        //         return $domain;
        //     }
        // }
        
        // function extract_subdomains($domain)
        // {
        //     $subdomains = $domain;
        //     $domain = extract_domain($subdomains);
        
        //     $subdomains = rtrim(strstr($subdomains, $domain, true), '.');
        
        //     return $subdomains;
        // }
    }
    
    public function domain_add($domain){
        //$domain = trim(strtolower($domain));//,FILTER_SANITIZE_DOMAIN);
        try{
            $domain = new Domain($domain);
            $subdomain = $domain->getSub();
            $myDomain = $domain->getRegisterable();
            $getName = $domain->getName();
            // $subdomain = extract_subdomains($domain);
            if(!empty($subdomain)){
                // $domain = extract_domain($domain);
                $response =  $this->cPanel->api2->SubDomain->addsubdomain(
                        array(
                        'domain'                => $subdomain,
                        'rootdomain'            => $myDomain,
                        'dir'                   =>  '/home/'.$this->cPanel->user.'/public_html',
                        'disallowdot'           => '1',
                    )
                );        
                   
            }
            else{
                $response =  $this->cPanel->api2->AddonDomain->addaddondomain(
                           array('newdomain'     => strtolower($myDomain),
                               'dir' => '/home/'.$this->cPanel->user.'/public_html',
                               'subdomain' => $getName//explode('.',strtolower($myDomain ) )[0]
                               )
                    );
            }
             
                    
              $res = (array)$response->cpanelresult;
              
              if(isset($res['error'])){
                  return $res['error'];//show_error('cPanel Api does not work.');
              }
              else{
                  $er = $res['data'][0];
                  if(isset($er->result)){
                      if($er->result != 1){
                          return $er->reason;
                      }
                  }
              }
            
        }catch(Exception $s){
           return json_encode($s);
        }
           
        return true; 
    }
    
    function details($website_id = 0){
        $data['website_id'] = $website_id;
        $data['row'] = $this->WebsiteModel->get_websites($website_id);
        $this->load->view('details-box',$data);
        // echo 'ok';
    }
    
}
?>