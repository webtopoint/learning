<?php
class Admin extends Tool_Controller
{	
       
    public $Admin  = array(),$addonsMenu = [];
    
    
	function __construct(){   
		parent :: __construct();     
		check_admin_login();
		$this->load->database();       
		$this->Admin['front']  	 = $this->SiteModel->getTheme();    
// 		if(strtolower($this->router->fetch_class()) == 'admin'){
		    
//     		cPanelAPILoad(); 
//     		$this->_api = new cpanelAPI( C_USER, C_KEY, C_HOST ); 
    		
// 		}
        $this->load->model('System_model','SM');
        $getCLientAddon = $this->SM->client_module();
        if($getCLientAddon->num_rows()){
            foreach($getCLientAddon->result() as $rrow){
                $this->addonsMenu[$rrow->value] = 'ok'; 
            }
        }
        
        $theme_config = $this->theme_path.'/config/theme.php';
        if(file_exists($theme_config)){
            require_once $theme_config;
            if(isset($theme)){
                foreach($theme as $index  => $config_value)
                    $this->config->set_item( $index , $config_value );
            }
        }
        
	}
	
	function view($data = [],$return = false){
	    $this->load->view('header',$data);
	    $this->load->view('footer');
	}
	function upload_editor_file(){
	    echo json_encode(['location' => client_file($this->file_up('file'))]);
	}
	function header_setting($page = 'topbar', $id = 0){
	   if($post = $this->input->post()){ 
		
	        $return = ['status' => false];
		
	        $data = array();
	        $id = isset($post['id']) ? $post['id'] : 0;
	        $status  = $post['status'];
	        
	        foreach($post['key']  as $index)
	            $data[$index] = $post['box'][$index];
	            
               unset($post['key']);
               unset($post['box']);
               unset($post['id']);
               unset($post['status']);
           
           
	            $newData = [
            	                'events' => json_encode($data),
            	                'css'  =>  json_encode($post),
            	                'admin_id' => CLIENT_ID
            	           ];  
	           
	           if($status == 'header'){
    	           if($id)
    	                $this->SiteModel->updateHeader( $id ,$newData); 
    	           else
    	                $this->SiteModel->addHeader($newData);
	           }
	           
	           if($status == 'topbar'){
    	           if($id)
    	                $this->SiteModel->updateTopBar( $id ,$newData); 
    	           else
    	                $this->SiteModel->addTopBar($newData);
	           }
	                
	                
	        echo json_encode($post);
	   }
	   else
	    $this->load->view('header/index',['page'=>$page,'id'=>$id]);
	}
	function copy_data(){
	    $return  = [ 'status' => false , 'html' => '' ];
	    $post   = $this->input->post();
	    $status = @$post['status'];
	    unset($post['status']);
	    switch($status){
	       
	       case 'list-websites':
	           $return['html'] = '<div class="col-md-12 parent" style="padding:0">
	                                    <div class="form-group" style="margin:0">
	                                        <input type="search" class="form-control search" autofocus placeholder="Search Website">
	                                    </div>
	                                    <div class="form-group" style="height:400px;overflow-x:hidden;">
	                                        <ul class="list-group">';
	                                           foreach($this->db->select('id,domain_name')->where('id!=',CLIENT_ID)->get('websites')->result() as $web){
        	                    $return['html'] .=   '<li class="list-group-item" data-website_id="'.$web->id.'" >'.$web->domain_name.'
        	                    
        	                                            <button class="btn btn-success _copy-to-website btn-xs btn-sm pull-right" data-event_id="'.$post['id'].'" data-event_type="'.$post['type'].'"><i class="fa fa-reply"></i></button>
        	                                        </li>';                             
        	                                   }
	                                            
	           $return['html'] .=      '   </ul>
	                                    </div>
	                              </div>';
	       break;
	       
	       case 'copy':
	           $return = $post;
	           switch($post['type']){
	               case 'form':
	                   $form = (array) $this->FormModel->getFormModel(['id'=>$post['id']],'title,fields,btn,layout,css')->row();
	                   $form['admin_id'] = $post['webId'];
	                   if($report = $this->FormModel->addForm($form)){
	                       $return = ['status'=>true,'message'=>'Form Added Successfully..','type'=>'green','icon'=>'fa fa-check','title'=>'Success'];
	                       
	                   }
	                   else
	                       $return = ['status'=>false,'message'=>'Something Went Wrong Try Again','type'=>'red','icon'=>'fa fa-exclamation-triangle','title'=>'Error'];
	                   $return['post'] = $form;
	                   $return['return']= $report;
	               break;
	           }
	       break;
	    }
	    echo json_encode($return);
	}
    function news($page = 'list', $id = 0){
        $post = $this->input->post();
    	if($post  AND $page == 'add'){
    	
    		$banner_value = '';
    		if(isset($_FILES['imgs']['name'][0]) && $post['media'] == 'image'){
                            
                   $filename = $_FILES['imgs']['name'][0];
                   $location = "public/temp/".CLIENT_ID.'/'.$filename;
                   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                   $imageFileType = strtolower( $imageFileType );
                
                
                   $valid_extensions = array("jpg","jpeg","png");
                
             
                   if( in_array( strtolower( $imageFileType ) , $valid_extensions ) ) {
              
                      if(move_uploaded_file($_FILES['imgs']['tmp_name'][0],$location)){
                         $banner_value = $filename;
                      }
                   }
            }
            else if($post['image'] == 'youtube')         	
            	$banner_value = $post['youtubeurl'];
            	
	    		$data = [

		    			'title'  		=> trim($post['title']),
		    			'banner_type' 	=> $post['media'],
		    			'banner_value' 	=> $banner_value,
		    			'content'		=>	$_POST['content'],
		    			'admin_id'		=>	CLIENT_ID
		    		];

		    	$id = $this->NewsModel->insert($data);

                if(isset($post['cats'])){
                    foreach ($post['cats'] as $cat) {
                        $this->NewsModel->linkCatToPost($id,$cat);
                    }
                }

		    	$this->session->set_flashdata('success',$data['title'].' News Successfully Create.');
		    	redirect(base_url.'/admin/news');

    	}
    	else if( $page == 'special_category' AND $post ){
    	    
    	    $action = explode(',',$post['action']);
    	    $numPost = explode(',',$post['numPost']);
    	    $boxClass = explode(',', $post['boxClass']);
    	    $category = explode(',',$post['category']);
    	    
    	    $return = ['status' => false, 'message'=>'Something Went Wrong Please Try Again..'];
    	    if(count($action)){
    	        $allWidget = [];
    	        $image = '';
    	        if(isset($_FILES['file']['name']) ){
                            
                   $filename = $_FILES['file']['name'];
                   $location = "public/temp/".CLIENT_ID.'/'.$filename;
                   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                   $imageFileType = strtolower($imageFileType);
                
                
                   $valid_extensions = array("jpg","jpeg","png");
                
             
                   if(in_array(strtolower($imageFileType), $valid_extensions)) {
              
                      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                         $image = $filename;
                      }
                   }
                }
            
    	        foreach($action as $index => $widget)
    	            $allWidget[$widget] = ['numPost' => $numPost[$index], 'category' => explode('|||',$category[$index]), 'boxClass' => $boxClass[$index]];
    	       
    	        $data = [
    	                    'title' => $post['title'],
    	                    'image' => $image,
    	                    'widgets' => json_encode($allWidget),
    	                    'admin_id' => CLIENT_ID
    	           ];    
    	           $this->NewsModel->insert_special_category($data);
    	        $return = ['status' => true , 'message' => 'Scpecial Category Added Successfully.. Added'];    
    	    }
    	    $return['alWidget'] = $allWidget;
    	    echo json_encode( $return );
    	    
    	}
    	else if($page == 'ticker' AND $post){
    	   
    	    $data = [
    	                'title'     => $post['title'],
    	                'title_css' => json_encode([
                	                        'background-color' => $post['title_background'],
                	                        'color'  => $post['title_color'],
                	                        'font-size' => $post['title_fontSize'],
                	                        'display'   => $post['hide_title'] == 'show' ? 'inline-block' : 'none'
                	                    ]),
    	                'cats'      => json_encode($post['cats']),
    	                'cats_css'  => json_encode([
                	                        'background-color' => $post['cat_background'],
                	                        'color'  => $post['cat_color'],
                	                        'font-size' => $post['cat_fontSize']
                	                    ]),
                	    'addons'   => json_encode([
                	                        'position' => $post['position'],
                	                        'thumbanail' => $post['thumbanail'],
                	                        'numPost'    => $post['numPost'],
                	                        'anim_duration' => $post['anim_duration']
                	                    ]),
                	   'position' => $post['position'],
                	   'admin_id'  => CLIENT_ID
    	    
    	       ];
    	       $this->NewsModel->createTicker($data);
    	       $this->session->set_flashdata('success','Ticker Created Successfully.');
    	       redirect(base_url.'/admin/news/'.$page);
    	}
    	else if($page == 'ajax-list'){
    		$this->load->library('pagination');
    		$record = $id;
    		$recordPerPage = 10;
			if($record != 0){
				$record = ($record-1) * $recordPerPage;
			}      	
	      	$recordCount = $this->NewsModel->countTotalNews();
	      	$posts = $this->NewsModel->getAjaxRecord($record,$recordPerPage);
	      	$config['base_url'] = base_url.'/admin/News/list';
	      	$config['use_page_numbers'] = TRUE;
			

			// $config['next_link'] = 'Next';
			// $config['prev_link'] = 'Previous';

			$config['full_tag_open'] = '<ul class="pagination  pagination-sm">';
            $config['full_tag_close'] = '</ul>';            
            $config['prev_link'] = '&laquo;';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';




			$config['total_rows'] = $recordCount;
			$config['per_page'] = $recordPerPage;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$data['count'] = $record;
			$html = '';
			if(!count($posts))
				$html = '<tr><td colspan="6"><div class="alert alert-danger">Post is not available.</div></td></tr>';
			foreach($posts as $k){
			    
				$html .= '<tr>
							<td>'.++$record.'</td>
							<td><a target="_blank" href="'.$this->NewsModel->postLink($k['id'],$this->NewsModel->productCategory($k['id']),$k['title']).' "> '.$k['title'].'</a></td>
							<td>'.date('Y-m-d h:i A',strtotime($k['create_time'])).'</td>
							<td>'.date('Y-m-d h:i A',strtotime($k['update_time'])).'</td>
							<td>';
							
            				foreach($this->NewsModel->productCategory($k['id'],true) as $cat)
            			        $html .= '<a href="'.$this->NewsModel->getCategorylink($cat->cat_id).'" target="_blank" class="badge badge-success">'.$this->NewsModel->get_category(['id'=>$cat->cat_id])->row()->name.'</a>';
            			    
			    $html .=  '</td>
							<td>
							    <div class="btn-group" data-id="'.$k['id'].'">
							        <a href="'.base_url.'/admin/news/edit/'.AJ_ENCODE($k['id']).'" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
							        <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
							    </div>
							</td>
						</tr>';
			}
			$data['postData'] = $html;
			echo json_encode($data);	
		    
    	}
    	else
        	$this->load->view('news/index',['page'=>$page,'id'=>$id]);

    }
    function profile(){
        if($post = $this->input->post()){
            if($post['status'] == 'profile_update'){
                $file = $this->file_up('file');
                $this->db->where('id',CLIENT_ID)->update('websites',['photo'=>$file]);
                echo client_file($file,true);
            }
            else if($post['status'] == 'update_details'){
                
            }
        }
        else
            $this->load->view('profile');
    }
    function news_ajax(){
        $return = ['status' => false,'html' => ''];
        
        $post = $this->input->post();
        
        $status = $post['status'];
        
        unset($post['status']);

        switch($status){
            case 'right_widgets':
                $category = json_encode($post['data']['category']);
                $news = json_encode($post['data']['news']);
                $this->NewsModel->updateNewsSetting('right_widget_in_category',['value'=>$category]);
                $this->NewsModel->updateNewsSetting('right_widget_in_news',['value'=>$news]);
                $return['status'] = true;
                $return['news'] = $news;
                $return['category'] = $category;
                $return = $post;
            break;
            case 'update-news-category':
                $id = intval($post['id']);
                unset($post['id']);
                $post['slug'] = empty($post['slug']) ? $this->NewsModel->genrateSlug($post['name']) : $this->NewsModel->senitize_Slug($post['slug']);
                if($id != 0)
                    $this->NewsModel->updateCategory($post,$id);
                else
                    $this->SiteModel->updateGeneralSetting(2,['value'=>$post['name'],'value1'=>$post['slug']]);
                $return =$post;
                $return['status'] = true;
                $return['id'] = $id;
            break;
            case 'edit-category-box':
                if($post['cat_id']!=0)
                    $get = $this->NewsModel->get_category([ 'id' => $post['cat_id'] ])->row();
                else 
                    $get = (object) ['name' => $this->SiteModel->get_type_name_by_id('general_settings',2,'value'),'slug'=>$this->SiteModel->get_type_name_by_id('general_settings',2,'value1')];
                $return['html'] = '<form action="" method="POST">
                                        <input type="hidden" name="id" value="'.$post['cat_id'].'" >
                                        <div class="form-group">
                                            <label> Title</label>
                                            <input type="text" name="name" class="form-control title" placeholder="Enter Category Title" value="'.$get->name.'" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" name="slug" class="form-control" placeholder="Enter Category Slug" value="'.$get->slug.'" required>
                                        </div>
                
                                  </form>';
            break;
            case 'save_special_category_setting':
                
                $id = AJ_DECODE($post['id']);
                unset($post['id']);
                $this->db->where('id',$id)->update('special_category',['settings' => json_encode( $post)] );
                $return['status'] = true;
                
            break;
            case 'get_news_right_widget':
                $rand = rand(1111,0000);
                $return['html'] = '<div class="card">
                                        <div class="card-header bg-success text-white" id="headingOne">
                                         
                                            <input type="text" id="widget_title" value="'.trim(strip_tags($post['html'])).'">
                                            
                                            <button type="button" style="    position: absolute;    right: 10px;" data-toggle="collapse" href="#collapseExample'.$rand.'" class="btn btn-primary" aria-expanded="false">
                                                <i class="fa fa-cog"></i>
                                            </button>
                                          
                                        </div>
                                        <div class="collapse" id="collapseExample'.$rand.'" style="padding:10px">
                                            <div class="form-group">
                                                <label>Number Of Post(s)</label>
                                                <input type="number" class="form-control " placeholder="No. of POST" id="number_of_post" value="5">
                                            </div>
                                            <div class="form-group">
                                                <label>Select Category(s)</label>
                                                <select class="form-control" id="category_list" multiple>';
                                                foreach($this->NewsModel->get_category()->result() as $cat)
                                $return['html'] .= '<option value="'.$cat->id.'">'.$cat->name.'</option>';                    
                            $return['html'] .= '</select>
                                            </div>
                                        </div>
                                    </div>';
            break;
            case 'get_news_widget':
                $return['html'] = '<div class="card-body md">
                                        <div class="form-group">
                                            <label>Box Size(s)</label>
                                            <select class="form-control" id="size" onchange="changeBOxSize(this)">
                                                <option value="col-md-3">One-Forth</option>
                                                <option value="col-md-4">One-Third</option>
                                                <option value="col-md-6">Half</option>
                                                <option value="col-md-8">Two-Third</option>
                                                <option value="col-md-9">Two-Forth</option>
                                                <option value="col-md-12">Full</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Number Of Post(s)</label>
                                            <input type="number" class="form-control " placeholder="No. of POST" id="number_of_post" value="5">
                                        </div>
                                        <div class="form-group">
                                            <label>Select Category(s)</label>
                                            <select class="form-control" id="category_list" multiple>';
                                            foreach($this->NewsModel->get_category()->result() as $cat)
                            $return['html'] .= '<option value="'.$cat->id.'">'.$cat->name.'</option>';                    
                        $return['html'] .= '</select>
                                        </div>
                                    </div>';
            break;
            case 'list-page-with-special-category':
                
                $allPage= $this->SiteModel->list_page();
                $return['html'] = '<table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#.</th>
                                            <th>Page Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                    foreach($allPage->result() as $rt){
                                        $chk = $this->db->get_where('web_schema',['key_id' => $post['widgetId'],'page_id' => $rt->id,'admin_id' => CLIENT_ID,'type' => 'special_category'])->num_rows() ? 'checked' : '';
                     $return['html'] .= '<tr>
                                            <td><input id="input-'.$rt->id.'" type="checkbox" class="set-in-page-input" '.$chk.' data-widgetId="'.$post['widgetId'].'" value="'.$rt->id.'"></td>
                                            <td><label for="input-'.$rt->id.'">'.$rt->page_name.'</label></td>
                                        </tr>';                       
                                    }
                $return['html'] .= '</tbody></table>';
                
            break;
            case 'use-special-category-in-page':
               
                $post['admin_id'] = CLIENT_ID;
                $return['status'] = $this->NewsModel->useSpecialCategory($post);
            break;
            case 'list-special-category':
                $gets = $this->NewsModel->special_category();
                if($gets->num_rows()){
                    $return['html'] = '<div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#.</th>
                                                        <th>Title</th>
                                                        <th>Image</th>
                                                        <th>Category(s)</th>
                                                        <th colspan="2">Setting</th> 
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                                $i = 1;
                                            foreach($gets->result() as $k){
                                             $return['html'] .= '<tr>
                                                                    <td>'.$i++.'.</td>
                                                                    <td>'.$k->title.'</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td><button class="set-in-page btn btn-sm btn-info" data-widgetId="'.$k->id.'"><i class="fa fa-cog"></i> Set in Page</button></td>
                                                                    <td><a href="'.base_url.'/admin/news/special_category_setting/'.AJ_ENCODE($k->id).'" class="btn btn-sm btn-info"><i class="fa fa-cog"></i> Setting</a></td>
                                                                    <td></td>
                                                                </tr>';                           
                                            }
                    $return['html'] .= '</tbody>
                                </table></div>';
                }
                else
                    $return = ['status' => false, 'html'=>'<div class="alert alert-danger">Data not Found...</div>'];
            break;
            case 'news_setting_layout':
                $return['status'] = $this->NewsModel->setNewsSetting('layout',['value'=>json_encode($post['layout'])]);
            break;

            case 'insertCategory':
                $this->NewsModel->slug = empty($post['slug']) ? $post['name'] : $post['slug'];
                unset($post['slug']);
                $return = $this->NewsModel->insertCategory($post); 
               $return = ['status' => true, 'html' => 'Category Added Successfully'];     
            break;

            case 'list_category':
              $return['html'] = '<div class="alert alert-danger">Category is not Available.</div>';
              $get  = $this->NewsModel->get_category();
              if($get->num_rows()){
                  $return['html'] = '<table id="data" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#.</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Count</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                $return['html'] .= '
                                            
                                            <tr>
                                                <td>1.</td>
                                                <td>'.$this->SiteModel->get_type_name_by_id('general_settings',2,'value').' <label class="badge badge-success">Default</label></td>
                                                <td>'.$this->SiteModel->get_type_name_by_id('general_settings',2,'value1').'</td>
                                                <td></td>
                                                <td>
                                                    <div class="btn-group" data-id="0">
                                                        <button class="btn btn-info btn-xs btn-sm edit-category"><i class="fa fa-edit"></i> </button>
                                                    </div>
                                                </td>
                                            </tr>
                                
                                ';
                                            foreach($get->result() as $k){
                                                static $x = 2;
                                $return['html'] .= '<tr>
                                                        <td>'.$x++.'.</td>
                                                        <td>'.$k->name.'</td>
                                                        <td>'.$k->slug.'</td>
                                                        <td>'.$this->NewsModel->countCategoryPost( $k->id ).'</td>
                                                        <td>
                                                            <div class="btn-group" data-id="' . $k->id . '">
                                                                <button class="btn btn-info btn-xs btn-sm edit-category"><i class="fa fa-edit"></i> </button>
                                                                <button class="btn btn-danger btn-xs btn-sm delete-category"><i class="fa fa-trash"></i> </button>
                                                            </div>
                                                        </td>
                                                     </tr>';

                                            }
                    $return['html'] .= '</tbody>
                                    </table>';
                }

            break;
            case 'add-post':
            	$return = $_POST;
            break;
            case 'list_category-for_post':
                
                $return['html'] = '<div class="alert alert-danger">Category is not found..</div>';
                $re = $this->NewsModel->get_category();
                $cats = [];
                if($post['id']){
                    foreach( $this->NewsModel->productCategory($post['id'],true) as $k)
                        $cats[] = $k->cat_id;
                }
                
                $return['cats'] = $cats;
                if($re->num_rows()){
                 $return['html'] = '<ul class="todo-list-wrapper list-group list-group-flush">';
                          
                                foreach($re->result() as $k){
                                    
                $checked = (in_array($k->id,$cats) AND $post['id']) ? 'checked' : ''; 
                           
               $return['html'] .= '<li class="list-group-item" style="padding: 0;cursor: pointer;">
                                    <div class="todo-indicator bg-warning"></div>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-2">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" name="cats[]" '.$checked.' value="'.$k->id.'" id="exampleCustomCheckbox'.$k->id.'" class="custom-control-input">
                                                    <label class="custom-control-label" for="exampleCustomCheckbox'.$k->id.'">&nbsp;</label>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading"> 
                                                    <label  for="exampleCustomCheckbox'.$k->id.'" style="cursor: pointer;">
                                                        '.$k->name.'
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>';
                            
                                }
                 $return['html'] .= '</ul>';
                }
            break;

        }

        echo json_encode($return);
    }


    function tab($para1 = 'list', $para2 = '', $para3 = '' ){

        if($para1 == 'add') {
            if( $post = $this->input->post() ){

                echo '<pre>';
                print_r($post);
                
            }
            else{
                $list['page'] = $para1;
                $this->load->view('tab',$list);
            }
        }
        else{
            $list['list'] = $this->HtmlModel->list_tabs();
            $list['page'] = $para1;
            $this->load->view('tab',$list);
        }
    }
	
	
	public function index(){
		$this->load->view('temphome');     
	}
	
	function render($data = []){
	    $this->load->view('render',$data);
	}
	
	
	function getFormCss($id=0){
	    $f = $this->FormModel->getFormModel(array('id'=>$id))->row();

        $fields  = json_decode($f->fields);
        echo '<!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
                
                <!-- Optional theme -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                
                <!-- Latest compiled and minified JavaScript -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>';
	    echo '<div style="padding-top:30px">'.$this->load->view('front/plugins/print_form_with_theme',[
        'form_id' => $f->id,
        'fields'  => $fields,
        'event'  =>  $f,
        'css'    => $f->css
      ],true).'</div>';
	}
	
	function slider_use_in_schema(){ 
	    $data = ['admin_id' => CLIENT_ID , 'type' => 'main_slider','page_id'=> $this->input->post('pageid') ];
	    if( ! $this->db->get_where('web_schema',$data)->num_rows() )
            $this->db->insert('web_schema',$data); 
        else  
            $this->db->where($data)->delete('web_schema');
        echo 1;               
	}
	     
	function slider($para1 = 'slider', $para2 = '', $para3 = '')
    {
       // $this->SiteModel->general_slider();  
        if ($para1 == 'list') {
            $this->db->where('admin_id',CLIENT_ID);
            $this->db->order_by('slider_id', 'desc'); 
            $page_data['all_slider'] = $this->db->get('slider')->result_array();
            $this->load->view('slider/list', $page_data);
        } 
        elseif ($para1 == 'use') {
            //$page_data['pages'] = $this->SiteModel->list_page();
            $this->load->view('slider/use'); 
        }
        elseif($para1 == 'use_in_schema'){
            $data = ['admin_id' => CLIENT_ID , 'type' => 'main_slider','page_id'=> $this->input->post('pageid') ];
             $this->db->insert('web_schema',$data);/*
            if( ! $this->db->get_where('web_schema',$data)->num_rows() ) 
                $this->db->insert('web_schema',$data);
            else
                $this->db->where($data)->delete('web_schema');*/
        }
        elseif ($para1 == 'add') {
            $this->load->view('slider/set');
        } elseif ($para1 == 'add_form') {
            $page_data['style_id'] = $para2; 
            $page_data['style']    = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $para2 
            ))->row()->value, true); 
            $this->load->view('slider/add_form', $page_data);
        } else if ($para1 == 'delete') { //ll
            $elements = json_decode($this->db->get_where('slider', array(  
                'slider_id' => $para2
            ))->row()->elements, true);
            $style    = $this->db->get_where('slider', array(
                'slider_id' => $para2
            ))->row()->style;
            $style    = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $style
            ))->row()->value, true);
            
            
            
            
            $images   = $style['images'];
            
            if (file_exists('uploads/slider_image/background_' . $para2 . '.jpg')) {
                unlink('uploads/slider_image/background_' . $para2 . '.jpg');
            }
            foreach ($images as $row) {
                if (file_exists('uploads/slider_image/' . $para2 . '_' . $row . '.png')) {
                    unlink('uploads/slider_image/' . $para2 . '_' . $row . '.png');
                }
            }
            $this->db->where('slider_id', $para2);
            $this->db->delete('slider');
           // recache();
        } else if ($para1 == 'serial') {
            
            $this->db->where('admin_id',CLIENT_ID);
            $this->db->order_by('serial', 'desc');
            $this->db->order_by('slider_id', 'desc');
            $page_data['slider'] = $this->db->get_where('slider', array( 
                'status' => 'ok'
            ))->result_array();
            //print_r($page_data);
            $this->load->view('slider/serial', $page_data); 
            //echo '2';
        } else if ($para1 == 'do_serial') {
            $input  = json_decode($this->input->post('serial'), true);
            $serial = array();
            foreach ($input as $r) {
                $serial[] = $r['id'];
            }
            $serial  = array_reverse($serial);
            $sliders = $this->db->get_where('slider',['admin_id'=>CLIENT_ID])->result_array();
            foreach ($sliders as $row) {
                $data['serial'] = 0;
                $this->db->where('slider_id', $row['slider_id']);
                $this->db->update('slider', $data);
            }
            foreach ($serial as $i => $row) {
                $data1['serial'] = $i + 1;
                $this->db->where('slider_id', $row);
                $this->db->update('slider', $data1);
            }
           // recache();
        } else if ($para1 == 'slider_publish_set') {
            $slider = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
                $data['serial'] = 0;
            }
            $this->db->where('slider_id', $slider);
            $this->db->update('slider', $data);
           // recache();
        } else if ($para1 == 'edit') {
            $page_data['slider_data'] = $this->db->get_where('slider', array(
                'slider_id' => $para2
            ))->result_array();
            $this->load->view('slider/edit_form', $page_data);
            
            
        } elseif ($para1 == 'create') {
            
            $data['style']  = $this->input->post('style_id');
            $data['title']  = $this->input->post('title');
            $data['serial'] = 0;
            $data['status'] = 'ok';
            $data['admin_id'] = CLIENT_ID;
            $style          = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $data['style']
            ))->row()->value, true);
            $images         = array();
            $texts          = array();
            foreach ($style['images'] as $image) {
                if ($_FILES[$image['name']]['name']) {
                    $images[] = $image['name'];
                }
            }
            foreach ($style['texts'] as $text) {
                if ($this->input->post($text['name']) !== '') {
                    $texts[] = array(
                        'name' => $text['name'],
                        'text' => $this->input->post($text['name']),
                        'color' => $this->input->post($text['name'] . '_color'),
                        'background' => $this->input->post($text['name'] . '_background')
                    );
                }
            }
            $elements         = array(               'images' => $images,                'texts' => $texts            );
            $data['elements'] = json_encode($elements);
            $this->db->insert('slider', $data);
            $id = $this->db->insert_id();
            
            move_uploaded_file($_FILES['background']['tmp_name'], 'public/temp/'.CLIENT_ID.'/background_' . $id . '.jpg');
            foreach ($elements['images'] as $image) {
                move_uploaded_file($_FILES[$image]['tmp_name'], 'public/temp/'.CLIENT_ID.'/' . $id . '_' . $image . '.png');
            }
            //recache();
        } elseif ($para1 == 'update') {
            $data['style'] = $this->input->post('style_id');
            $data['title'] = $this->input->post('title');
            $style         = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $data['style']
            ))->row()->value, true);
            $images        = array();
            $texts         = array(); 
            foreach ($style['images'] as $image) {
                
                if ($_FILES[$image['name']]['name'] || $this->input->post($image['name'] . '_same') == 'same') {
                    $images[] = $image['name'];
                }

            }
            foreach ($style['texts'] as $text) {
                if ($this->input->post($text['name']) !== '') { 
                    $texts[] = array(
                        'name' => $text['name'],
                        'text' => $this->input->post($text['name']),
                        'color' => $this->input->post($text['name'] . '_color'), 
                        'background' => $this->input->post($text['name'] . '_background')
                    );
                }
            }
            $elements         = array(
                'images' => $images,
                'texts' => $texts
            );
            $data['elements'] = json_encode($elements);
            $this->db->where('slider_id', $para2);
            $this->db->update('slider', $data);
            
            move_uploaded_file($_FILES['background']['tmp_name'], 'public/temp/'.CLIENT_ID.'/background_' . $para2 . '.jpg');
            foreach ($elements['images'] as $image) {
                move_uploaded_file($_FILES[$image]['tmp_name'], 'public/temp/'.CLIENT_ID.'/' . $para2 . '_' . $image . '.png');
            }
           // recache();
        } else {
            $this->load->view('header');
            $this->load->view('slider/index');
            $this->load->view('footer');
        }
    }
	
	function content($type = 'use', $id = 0){
	    if($post = $this->input->post()){
	        
    	        $data['content_title'] = $_POST['content_title'];
    	        unset($_POST['content_title']);
    	        $data['data'] = json_encode($_POST);
    	        $data['admin_id'] = CLIENT_ID;
    	        
    	        
    	        if($id = AJ_DECODE($id)){
    	            $this->db->where('id',$id)->update('content',$data);
    	            $this->session->set_flashdata('success','Content Update Successfully..');
    	        }
    	        else{
    	            $this->db->insert('content',$data);
    	            $this->session->set_flashdata('success','Content Added Successfully..');
    	        }
    	        
    	        redirect(base_url.'/admin/content/add');
	    }
	    else
	        $this->load->view('main',[ 'page_name' => __FUNCTION__.'/'.$type ,'id' => $id]);
	}
	
    public function change_password(){
        if($post = $this->input->post()){
         
            if(AdminPass == $post['current_pass']){
                $this->AdminModel->updateAdmin(array('id' => CLIENT_ID),array('_pass'=>$post['new_pass']));
                $this->session->set_flashdata('success','Password Change Successfully..');
            }
            else
              $this->session->set_flashdata('danger','Entered Current Password is Wrong Please Enter Current Password.');
            redirect(base_url.'/admin/change-password');
        }
        else
          $this->load->view(__FUNCTION__);
    }

	public function set_default_page()
	{
		if($this->input->post())
		{
			$pageid = AJ_DECODE($_POST['page_id']);
			$this->db->set('default_page_id',$pageid)->where('id',CLIENT_ID)->update('websites');
		}
	}

	public function menu_section($value='')
	{    
		if($post = $this->input->post() ){
		    
		    
		    if(isset($post['status'])){
		        $return = [];
		        switch($post['status']){
		            
		            case 'print-menu':
		                
		                $items = ($post['group_id'] == 'add') ? [] :$this->MenuModel->print_menu_items(['group_id'=>$post['group_id']]);

            			
		                $return['html'] = '<input type="hidden" id="group_id" value="'.$post['group_id'].'">
                    				        <div class="cf nestable-lists"><div class="dd" id="nestable" style="width:100%">'.$this->get_menu($items).'</div></div>
                    			    
                    			            <input type="hidden" id="nestable-output">';
                    			            
                        $menu = $this->MenuModel->get_menu_groups([],1)->row(); 
                        
                        $seconday = ($post['group_id'] == 'add' || $menu->isSecondary ) ? 'checked' : '';
                        
                        $primary = $menu->isPrimary ? 'checked' : '';
                        
                    	$event  = ($menu->id == $post['group_id']) ? 0 : 1;
                    	
		                $return['header'] = '<div class="mb-2 mr-sm-2 mb-sm-0 position-relative form-group">
                                                <label for="group_name" class="mr-sm-2">Menu Name</label>
                                                <input id="group_name" value="'.@$this->MenuModel->get_menu_groups(['id'=>$post['group_id']])->row()->name.'" placeholder="Menu Name" type="text" class="form-control">';
                                                
                                               
                                                
                        $return['header'] .=   ($post['group_id'] != 'add') ? 
                        
                                                        '<button type="button" data-id="'.$post['group_id'].'" data-toggle="tooltip" title="Menu CSS" data-placement="bottom" class="btn-shadow menu-setting ml-2 btn btn-dark">
                                                            <i class="fa fa-cog"></i> STYLE
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-shadow ml-2 delete-menu" data-id="'.$post['group_id'].'" data-event="'.$event.'"><i class="fa fa-trash"></i></button>'  : '';    
                        
                        $return['header'] .=  '</div>';
                                            
                        $return['footer'] = '   <div class="form-group">
                                                    <label class="mr-sm-2">
                                                        <input type="checkbox" id="isPrimary" '.$primary.'> Primary
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="mr-sm-2">
                                                        <input type="checkbox" id="isSecondary" '.$seconday.'> Secondary
                                                    </label>
                                                </div>';                    
                                            
		            break;
		        }
		        
		        echo json_encode($return);
		    }
		    else{
    			echo count($post['page_id']);
    			exit;
		    }
		}	
		else
		    $this->load->view(__FUNCTION__);

	}
    function get_menu($items,$class = 'dd-list') {



			    $html = "<ol class=\"".$class."\" id=\"menu-id\">";



			    foreach($items as $key=>$value) {
			        
			        $icon = empty($value['icon']) ? '<i class="fas fa-ban" style="color:red"></i>' : '<i class="'.$value['icon'].'"></i>'; 

			        $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >

			                    <div class="dd-handle dd3-handle"></div>

			                    <div class="dd3-content">
			                    
			                        <span id="label_show'.$value['id'].'">'.$value['label'].'</span> 
                                    
                                    
                                    <input type="hidden" class="menu-icon"  id="IconInput'.$value['id'].'" value="'.$value['icon'].'">
                                    
                                    
                                    
			                        <span class="span-right"><span id="link_show'.$value['id'].'">'.ucwords($value['type']).'</span> &nbsp;&nbsp; 

			                        <a class="SingleMenuSetting" onclick="SingleMenuSetting('.$value['id'].')"><i class="fa fa-cog"></i></a>     
			                        
			                        
                                    <span title="Select Icon" style="cursor:pointer" class="icon-'.$value['id'].'" href="javascript:void(0)" id="GetIconPicker" data-iconpicker-input="input#IconInput'.$value['id'].'" data-iconpicker-preview="i#IconPreview">'.$icon.'</span>
			                       
			                       
			                       
			                       
			                        <a class="del-button" id="'.$value['id'].'"><i class="fa fa-trash"></i></a></span> 
			                    </div>
			                    
			                    
			                    ';

			        if(array_key_exists('child',$value)) 
			            $html .= $this->get_menu($value['child'],'child');
                    $html .= "</li>";

			    }

			    $html .= "</ol>";



			    return $html;


	}
	public function list_pages()
	{
		if($post=$this->input->post())
		{
			if($post['status']=='delete')
			{
				 $id = AJ_DECODE($post['id']);
				 $this->SiteModel->deletePage(array('id'=>$id,'admin_id'=>CLIENT_ID));
				 $this->db->where(array('page_id'=>$id,'admin_id'=>CLIENT_ID))->delete('menu');
				 $this->SiteModel->deletePageContect(array('page_id'=>$id,'admin_id'=>CLIENT_ID));
				 $this->db->where(array('page_id'=>$id,'admin_id'=>CLIENT_ID))->delete('web_schema');
			}
		}
		else
		    $this->load->view(__FUNCTION__);

	}

	public function add_page_content($pageid)
	{

		$post = $this->input->post();

		if($post)
		{

			$status = $post['status'];
			unset($post['status']);
			
			
			if($status=='content')
			{
			    $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['max_size'] = '1024'; // max_size in kb
                $config['max_filename'] = '255';
                $config['encrypt_name'] = TRUE;
		        
		        $is_file = false; $head_image ='';
			    if (!empty($_FILES['heading_image']['name'])) {
                    
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('heading_image')) {
                        $this->session->set_flashdata('msg','<div class="alert alert-solid-danger">'.$this->upload->display_errors().'</div>');
                        redirect(base_url.'/admin/add_page_content/'.$pageid);
                    } else {
                        $is_file = true;
                        $head_image = $this->upload->data()['file_name'];
                    }
                        
                }
                $rediction = isset($post['redirection']) ? 1 : 0;
				$this->SiteModel->updatePage(array('id'=>AJ_DECODE($pageid)),array('page_name'=>$post['page_name'],'redirection' => $rediction));

				$keyword = strlen($post['keywords'])?json_encode(explode(',',$post['keywords'])):"";

				$data = array('page_id'=>AJ_DECODE($pageid),
								//'title'=>$post['page_title'],
								'content'=>$_POST['editor2'],
								'keywords'=>$keyword,
								'admin_id'=>CLIENT_ID,
								'heading_height'=>$post['heading_height']
							);
				if($post['is_file'] && $is_file)
				    $data['heading_image'] = $head_image;
				if(!$post['is_file'])
				   $data['heading_image'] = $head_image;
				   
				
				$this->SiteModel->insertPageData($data);
				
			}
			else if($status=='link')
			{
			    $rediction = isset($post['redirection']) ? 1 : 0;
				$this->SiteModel->updatePage(array('id'=>AJ_DECODE($pageid)),array('page_name'=>$post['page_name'],'link'=>$post['link'],'redirection' => $rediction));
			}
		

			$this->session->set_flashdata('success','Page Updated Successfully');
			redirect(site_url('admin/add_page_content/'.$pageid));  

		}
		else

			$this->load->view(__FUNCTION__,['pageid'=>$pageid]);

	}

	public function image_gallery()

	{

		$post = $this->input->post();

		if($post){

			$this->form_validation->set_rules('gallery_name', 'Gallery Name', 'trim|required');

			if ($this->form_validation->run() == FALSE)

               $this->session->set_flashdata('error',validation_errors('<div class="alert alert-danger">','</div>'));

            else{
                $flg = true;
                if(checkPermission('image_gallery')){
                    
                    $gten = $this->db->get_where('image_gallery',[ 'admin_id' => CLIENT_ID ])->num_rows();
                    
                    if(checkPermission('image_gallery',true) == 1):
                        if($gten > 0):
                            $flg = false;
                            $this->session->set_flashdata('danger','Limit denied of Image Gallery.');
                        endif;
                    endif;
                    
                }
                
                if($flg):
                	$this->db->insert('image_gallery',array('gallery_name' => $post['gallery_name'] , 'admin_id' => CLIENT_ID));
    
                	$this->session->set_flashdata('success','<span>Gallery added successfully..</span>');
                endif;
            }

            redirect(site_url('admin/image-gallery'));

		}

		else

			$this->load->view(__FUNCTION__);

	}
    
    function file_download_gallery($p1 = 0, $p2 = 0){
        
        
        $page_data['tab'] = $p2;
        if($p2 == 'delete-file' && $p1){
            $data = $this->db->get_where('files_download_gallery',['gallery_file_id' => AJ_DECODE($p1)])->row();
            $link = $data->link;
            $gal_id = $data->file_download_gallery_id;
            $this->db->where(['gallery_file_id' => AJ_DECODE($p1) ])->delete('files_download_gallery');
            if(file_exists('public/temp/'.CLIENT_ID.'/'.$link)){
                unlink('public/temp/'.CLIENT_ID.'/'.$link);
            }
            $this->session->set_flashdata('success','File Delete Successfully.');
			redirect(site_url('admin/file-download-gallery/'.AJ_ENCODE($gal_id).'/view-files'));
            exit;
        }
        $page_data['p1'] = $p1;
        if($post = $this->input->post()){
            $data = array('gallery_name'=>$post['gallery_name'],
								'css' =>json_encode(['btn_name'=>'Download','btn_css'=>json_encode([])]),
								'admin_id'=>CLIENT_ID
							);
			$this->db->insert(__FUNCTION__,$data);
			$this->session->set_flashdata('success','File Download Gallery Added');
			redirect(site_url('admin/file-download-gallery'));
        }
        else
         $this->load->view(__FUNCTION__,$page_data);
    }
    
    function file_download_gallery_use_in_page(){
         if($post = $this->input->post() ){
             $data=  array('gal_id'=>$post['galid'],
							'page_id'=>$post['pageid']
			);
			$this->GalleryModel->usefileDownloadGallery($data);
         }
         else 
         $this->load->view('use_file_download_gallery');
    }
    
    function add_files_in_file_gallery($p1 = 0){
		        
		        $is_file = false; $file ='';
			    if (!empty($_FILES['files']['name'])) {
                    $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
    		        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|PDF';
    		        $config['max_size'] = '51200'; // max_size in kb
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('files')) {
                        $this->session->set_flashdata('msg','<div class="alert alert-danger">'.strip_tags($this->upload->display_errors()).'</div>');
                    } else {
                        $is_file = true;
                        $file = $this->upload->data()['file_name'];
                    }
                        
                }
                
                if($is_file){
                    $data = [
                        'file_name' => $_POST['file_name'],
                        'link'      => $file,
                        'admin_id'  => CLIENT_ID,
                        'file_download_gallery_id' => AJ_DECODE($p1)
                    ];
                    $this->db->insert('files_download_gallery',$data);
                    
                }
                $this->session->set_flashdata('success','File upload Successfully..');
                redirect(base_url.'/admin/file-download-gallery/'.$p1.'/view-files');
    }
	
	public function video_gallery()
	{
		if($post = $this->input->post())
		{
		     $flg = true;
                if(checkPermission(__FUNCTION__)){
                    
                    $gten = $this->db->get_where(__FUNCTION__,[ 'admin_id' => CLIENT_ID ])->num_rows();
                    
                    if(checkPermission(__FUNCTION__,true) == 1):
                        if($gten > 0):
                            $flg = false;
                            $this->session->set_flashdata('danger','Limit denied of Video Gallery.');
                        endif;
                    endif;
                    
                }
                
                if($flg):
    		    
    				$data = array('gallery_name'=>$post['vgallery_name'],
    								'layout' =>'2',
    								'admin_id'=>CLIENT_ID
    							);
    				$this->GalleryModel->addVideoGallery($data);
    				$this->session->set_flashdata('success','Video Gallery Added');
			    endif;
				redirect(site_url('admin/video-gallery'));
		}
		else
		{	
			$this->load->view('video_gallery');
		}
	}

	public function view_videos($galid)
	{
		

		if($post = $this->input->post())
		{
			if($post['status']=='changeLayout')
			{
				$this->GalleryModel->changeVideoLayout(array('id'=>$post['galid']),array('layout'=>$post['lay']));
			}
			else if($post['status']=='addVideo')
			{
			    $video = $post['video'];
			    $type = 'youtube';
			    $flag = true;
			    if($post['type'] == 'video'){
			        
			        if(isset($_FILES['video']['name'])){
			            $type = 'video';
			            $x = time().'-'.$_FILES['video']['name'];

            			//$saveName = 'public/temp/'.CLIENT_ID.'/'.$x;
            
            		     $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
            
            		     $config['allowed_types'] = 'wmv|mp4|avi|mov';
            
            		    // $config['max_size'] = '2048'; // max_size in kb
            
            		     $config['file_name'] = $x;
            
            		     $this->load->library('upload',$config); 
            
            		     if($this->upload->do_upload('video')){
            
                		       $uploadData = $this->upload->data();
                
                		       $video = $x = $uploadData['file_name'];
                
                		       $file = array('size'=> $_FILES['file']['size'],'file_name'=>$x,'admin_id'=>CLIENT_ID);
                
                		       $this->SiteModel->insert_file_size($file);
    			            
    			        } 
    			        else{
    			            $flag = false;
    			            $error = array('error' => $this->upload->display_errors());
                            $this->session->set_flashdata('danger',$error['error']);
    			        }
			       }
			        
			    }
				$data = array('gallery_id'=>AJ_DECODE($galid),'video'=>$video,'type'=>$type,'admin_id'=>CLIENT_ID);
				if($flag){
    				$this->GalleryModel->addVideoToGallery($data);
    				$this->session->set_flashdata('success','Video Added Successfully');
				}
				redirect(site_url('admin/video-gallery/'.$galid.'/view-videos'));
				
			}
			else if($post['status']=='delete'){
				$this->db->where(array('id'=>AJ_DECODE($post['vid']),'admin_id'=>CLIENT_ID))->delete('gallery_videos');
				$this->db->where(array('id'=>AJ_DECODE($post['vid']),'admin_id'=>CLIENT_ID))->delete('gallery_videos');
			}
		}
		else
		{
			$this->load->view('view_videos',['id'=>$galid]);
		}
	}

	public function delete_video_gallery($id)
	{
		$this->db->where(array('id'=>$id,'admin_id'=>CLIENT_ID))->delete('video_gallery');
		$this->db->where(array('gallery_id'=>$id,'admin_id'=>CLIENT_ID))->delete('gallery_videos');
		$this->db->where(array('gal_id'=>$id,'admin_id'=>CLIENT_ID))->delete('video_gallery_link');
		$this->db->where(array('key_id'=>$id,'type'=>'vgallery','admin_id'=>CLIENT_ID))->delete('web_schema');
		redirect(site_url('admin/video-gallery'));
	}
	
	
	public function use_gallery()
	{
		if($post = $this->input->post())
		{
			$data=  array('gal_id'=>$post['galid'],
							'page_id'=>$post['pageid']
			);
			$this->GalleryModel->useGallery($data);
		}
		else
		{
			$this->load->view('use_gallery');
		}
	}




	public function use_product_gallery()
	{
		if($post = $this->input->post())
		{
			$data=  array('gal_id'=>$post['galid'],
							'page_id'=>$post['pageid']
			);
			$this->GalleryModel->useProductGallery($data);
		}
		else
		{
			$this->load->view('use_product_gallery');
		}
	}

	public function use_video_gallery()
	{
		if($post = $this->input->post())
		{
			$data=  array('gal_id'=>$post['galid'],
							'page_id'=>$post['pageid']
			);
			$this->GalleryModel->useVideoGallery($data);
		}
		else
		{
			$this->load->view('use_video_gallery');
		}
	}


	public function product_query($qid=0,$delete=0)
	{
		if($qid and !$delete)
		{	$qid = AJ_DECODE($qid);
			$this->load->view('product_query_view',['qid'=>$qid]);
		}
		else if($qid and $delete)
		{
			$this->db->where(array('id'=>AJ_DECODE($qid),'admin_id'=>CLIENT_ID))->delete('product_query');
			$this->session->set_flashdata('success','Prodcut Query Delete Successfully');
			redirect(site_url('admin/product-query'));
		}
		else
		{
			$this->load->view('product_query');			
		}
	}

	public function setting_theme(){
        //redirect(base_url.'/admin');
	    $this->load->view('theme_setting');

	}

	public function view_images($id='',$title='')

	{

		$post = $this->input->post();

		if($_FILES){

			if(!empty($_FILES['file']['name'])){

			$x = time().'-'.$_FILES['file']['name'];

			//$saveName = 'public/temp/'.CLIENT_ID.'/'.$x;

		     $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 

		     $config['allowed_types'] = 'jpg|jpeg|png|gif';

		     $config['max_size'] = '1024'; // max_size in kb

		     $config['file_name'] = $x;

		     $this->load->library('upload',$config); 

		     if($this->upload->do_upload('file')){

		       $uploadData = $this->upload->data();

		       $x = $uploadData['file_name'];

		       $data = array('image'=>$x,'gallery_id'=>AJ_DECODE($id),'admin_id'=>CLIENT_ID);

		       $this->GalleryModel->insert_gallery_images($data);

		       $file = array('size'=> $_FILES['file']['size'],'file_name'=>$x,'admin_id'=>CLIENT_ID);

		       $this->SiteModel->insert_file_size($file);

		       $this->session->set_flashdata('success','Image Upload successfully');

		     }

		     else{

		     	$this->session->set_flashdata('error',$this->upload->display_errors('<div class="alert alert-danger">', '</div>'));

		     }

		     

		   }
		   else

		   	  $this->session->set_flashdata('error','Please Choose a Image.');

		   redirect(site_url('admin/image-gallery/'.$id.'/view-images')); 

		}
		else if($post)
		{
			if($post['status']=='changeLayout')
			{
				$this->GalleryModel->changeLayout(array('id'=>$post['galid']),array('layout'=>$post['lay']));
			}
			else if($post['status']=='delete')
			{
				$id = AJ_DECODE($post['id']);
				$x = $this->GalleryModel->deleteImage(array('id'=>$id,'admin_id'=>CLIENT_ID));
				echo $x;
			}
		}
		else

			$this->load->view(__FUNCTION__,['id'=>$id]);

	}
    
    
    function permissionset(){
        echo '<pre>';
        echo $this->db->where('admin_id',CLIENT_ID)->get('his_pages')->num_rows();
    }
	
	
	public function add_page(){

		$post = $this->input->post();

		if($post){
		    
			$this->form_validation->set_rules(

				        'page_name', 'Page Name',

				        'required|min_length[3]',

				        array(

				                'required'      => 'You have not provided %s.',

				                'is_unique'     => 'This %s already exists.'

				        )

				);
             if ($this->form_validation->run() == FALSE)

               $this->session->set_flashdata('error',validation_errors('<div class="alert alert-danger">','</div>'));
            
            else {
                ob_start();
                $flag = true;
                if( checkPermission('page_limit',false,true) ){
                  
                    if(  checkPermission('page_limit',true) <= $this->db->where('admin_id',CLIENT_ID)->from("his_pages")->count_all_results() ){
                        $flag = false;
                        $this->session->set_flashdata('danger','<span>Page Limit denied.</span>');
                    }
                }
                
                if($flag):
                
                
            	$post['link']           = isset($post['link'])?$post['link']:NULL;
            	$post['redirection']    = isset($post['redirection']) ? 1 : 0;
            	$this->db->insert('his_pages',array('page_name'=>$post['page_name'],'link'=>$post['link'],'admin_id'=>CLIENT_ID,'redirection'=>$post['redirection']));

            	if(!$post['link'])
            	{
            		$x = $this->db->where(array('admin_id'=>CLIENT_ID))->order_by('id','desc')->limit(1)->get('his_pages');

            		if($x->num_rows())
            		{
            			$y = $x->row();
            			
            			$data = array('page_id'=>$y->id,'title'=>'','content'=>'','keywords'=>'','admin_id'=>CLIENT_ID);
            			$this->db->insert('his_page_content',$data);

            			$this->db->set(array('type'=>'content','admin_id'=>CLIENT_ID,'page_id'=>$y->id))->insert('web_schema');
            		}

            	}

            	$this->session->set_flashdata('success','<span>Page added successfully..</span>');
                endif;

            }

            redirect(site_url('admin/Add-Page'));

		}

		else

			$this->load->view(__FUNCTION__);

	}

	public function product_gallery($value='')
	{

		$post = $this->input->post();

		if($post){

			$this->form_validation->set_rules('gallery_name', 'Gallery Name', 'trim|required');

			if ($this->form_validation->run() == FALSE)

               $this->session->set_flashdata('error',validation_errors('<div class="alert alert-danger">','</div>'));

            else{
                $flg = true;
                if(checkPermission(__FUNCTION__)){
                    
                    $gten = $this->db->get_where(__FUNCTION__,[ 'admin_id' => CLIENT_ID ])->num_rows();
                    
                    if(checkPermission(__FUNCTION__,true) == 1):
                        if($gten > 0):
                            $flg = false;
                            $this->session->set_flashdata('danger','Limit denied of Product Gallery.');
                        endif;
                    endif;
                    
                }
                
                if($flg):
                	$defaultButton='{"text":"TEXT","color":"#000000","textHover":"#ffffff","backColor":"#cdcdcd","backHover":"#939393","Bsize":"1","Bcolor":"#000000","Bstyle":"solid","padL":"15","padR":"15","padT":"5","padB":"5"}';
    
                    $data = array('gallery_name'=>$post['gallery_name'],'layout'=>4,'btn_css'=>$defaultButton,'admin_id'=>CLIENT_ID);
    
                	$this->db->insert(__FUNCTION__,$data);
    
                	$this->session->set_flashdata('success','<span>Product Gallery added successfully..</span>');
                endif;
            }

            redirect(site_url('admin/product-gallery'));

		}

		else

		   $this->load->view(__FUNCTION__);

	}
    function update_product_gallery_setting(){
        if($post = $this->input->post()){
            if($this->GalleryModel->product_gallery($post)->num_rows())
                $this->GalleryModel->update_product_gallery(['id' => $post['id']],['form_id' => 0,'form_type' => NULL]);
            else
                $this->GalleryModel->update_product_gallery(['id' => $post['id']],$post);
            echo json_encode($post);
        }
    }
	public function edit_product_gallery($id)
	{
		if($post= $this->input->post())
		{
			$galname=$post['gallery_name'];
			unset($post['gallery_name']);
			$btn = json_encode($post);

			$data = array('gallery_name'=>$galname,'btn_css'=>$btn);
			$this->db->where('id',AJ_DECODE($id))->update('product_gallery',$data);
			$this->session->set_flashdata('success','Product Gallery Updated');
			redirect(site_url('admin/edit-product-gallery/'.$id));
		}
		else
		{
			$this->load->view('product_gallery_setting',['id'=>AJ_DECODE($id)]);
		}
		
	}

	public function delete_product_gallery($galid)
	{
		
			$gal = $this->GalleryModel->product_gallery(array('id'=>AJ_DECODE($galid)));
			if($gal->num_rows()){
			    
			    $g = $gal->row();
				$this->db->where(array('id'=>$g->id))->delete('product_gallery');
				$this->db->where(array('gal_id'=>$g->id,'admin_id'=>CLIENT_ID))->delete('product_gallery_link');
				$this->db->where(array('key_id'=>$g->id,'type'=>'pgallery','admin_id'=>CLIENT_ID))->delete('web_schema');
				$this->session->set_flashdata('success','Gallery Deleted Successfully');
				
			}
			else
			{
				$this->session->set_flashdata('error','Only Empty Gallery can be delete. Delete all products First');
			}
			redirect(site_url('admin/product-gallery/'));
	}

	public function view_products($id='',$title='')
	{

	

		$post = $this->input->post();

		if($_FILES){

			if(!empty($_FILES['file']['name'])){

			$x = time().'-'.$_FILES['file']['name'];

			//$saveName = 'public/temp/'.CLIENT_ID.'/'.$x;

		     $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 

		     $config['allowed_types'] = 'jpg|jpeg|png|gif';

		     $config['max_size'] = '1024'; // max_size in kb

		     $config['file_name'] = $x;

		     $this->load->library('upload',$config); 

		     if($this->upload->do_upload('file')){

		       $uploadData = $this->upload->data();
		       $x = $uploadData['file_name'];
		       $data = array('gallery_id'=>AJ_DECODE($id),'image'=>$x,'title'=>$post['title'],'description'=>$post['description'],'product_link'=>$post['link'],'admin_id'=>CLIENT_ID);

		       $this->GalleryModel->insert_product_images($data);

		       $file = array('size'=> $_FILES['file']['size'],'file_name'=>$x,'admin_id'=>CLIENT_ID);

		       $this->SiteModel->insert_file_size($file);

		       $this->session->set_flashdata('success','Product Upload successfully');

		     }

		     else{

		     	$this->session->set_flashdata('error',$this->upload->display_errors('<div class="alert alert-danger">', '</div>'));

		     }

		     

		   }

		   else

		   	  $this->session->set_flashdata('error','Please Choose a Image.');

		   redirect(site_url('admin/product-gallery/'.$id.'/view-products')); 

		}
		else if($post)
		{
			if($post['status']=='changeLayout')
			{
				$this->GalleryModel->changeProductLayout(array('id'=>$post['galid']),array('layout'=>$post['lay']));
			}
		}
		else

			$this->load->view('view_products',['id'=>$id]);

	}

	public function edit_product($proid)
	{
		if($post= $this->input->post())
		{

			if($_FILES)
			{

				if(!empty($_FILES['file']['name']))
				{

					$x = time().'-'.$_FILES['file']['name'];

					//$saveName = 'public/temp/'.CLIENT_ID.'/'.$x;

				     $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 

				     $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF';

				     $config['max_size'] = '10240'; // max_size in kb

				     $config['file_name'] = $x;
				     
				     $this->load->library('upload',$config); 

				     if($this->upload->do_upload('file'))
				     {

				      	 $uploadData = $this->upload->data();
		       			//=========remove old records ==============//
// echo '<pre>';
//         print_r($uploadData);
//                     print_r($config);
//                     print_r($_FILES);
//                     exit;
		  				  $pro = $this->GalleryModel->getGalleryProducts(array('id'=>AJ_DECODE($proid)));
							if($pro->num_rows())
							{
								$pro = $pro->row();
								if(file_exists('public/temp/'.CLIENT_ID.'/'.$pro->image)){
    								if(unlink('public/temp/'.CLIENT_ID.'/'.$pro->image) || true)
    									$this->db->where(array('file_name'=>$pro->image,'admin_id'=>CLIENT_ID))->delete('usespace');
    								else
    										$this->session->set_flashdata('error','Old Image is not Delete');
								}

						       $data = array('image'=>$x,'title'=>$post['title'],'description'=>$post['description'],'product_link'=>$post['link'],'admin_id'=>CLIENT_ID);
                        
						       $this->GalleryModel->updateProduct(array('id'=>AJ_DECODE($proid)),$data);

						       $file = array('size'=> $_FILES['file']['size'],'file_name'=>$x,'admin_id'=>CLIENT_ID);

						       $this->SiteModel->insert_file_size($file);

						       $this->session->set_flashdata('success','Product Updated successfully');

							}
							else
							{
								$this->session->set_flashdata('error','Invalid Prodcut Id');
							}
				       //===========================================//	

				     }
				     else
				     {

				     	$this->session->set_flashdata('error',$this->upload->display_errors('<div class="alert alert-danger">', '</div>'));

				     }
				}
				else
				{
					$this->session->set_flashdata('error','Invalid File Name');

				}
		   }
		   else
		   {
		   	 	 $pro = $this->GalleryModel->getGalleryProducts(array('id'=>AJ_DECODE($proid)));
		   	 	
					if($pro->num_rows())
					{
					  $data = array('title'=>$post['title'],'description'=>$post['description'],'product_link'=>$post['link'],'admin_id'=>CLIENT_ID);

					  	$this->GalleryModel->updateProduct(array('id'=>AJ_DECODE($proid)),$data);
						$this->session->set_flashdata('success','Product Updated Successfully');
					}
					else
					{
						$this->session->set_flashdata('error','Invalid Product Id');
					
					}
		   }
		  redirect(site_url('admin/product-gallery/'.$proid.'/edit-product'));
		}
		else
		{
			$this->load->view('edit_product',['id'=>$proid]);
		}
	}

	public function delete_product($proid,$galid)
	{
		$pro = $this->GalleryModel->getGalleryProducts(array('id'=>AJ_DECODE($proid),'gallery_id'=>AJ_DECODE($galid)));
		if($pro->num_rows())
		{
			$pro = $pro->row();
			if(true)
			{
			    if(file_exists('public/temp/'.CLIENT_ID.'/'.$pro->image))
			     unlink('public/temp/'.CLIENT_ID.'/'.$pro->image);
				$this->db->where(array('file_name'=>$pro->image,'admin_id'=>CLIENT_ID))->delete('usespace');
				$this->db->where(array('id'=>AJ_DECODE($proid),'admin_id'=>CLIENT_ID))->delete('product_gallery_images');
				$this->db->where(array('product_id'=>$proid,'admin_id'=>CLIENT_ID))->delete('product_query');
				$this->session->set_flashdata('success','Product Successfully Deleted');		
			}
			else
			{
				$this->session->set_flashdata('error','Error While Deleting Product Image');
			}
		}
		else
			$this->session->set_flashdata('error','Error While Deleting Product Image');
		redirect(site_url('admin/product-gallery/'.$galid.'/view-products'));
	}

	public function feature_box()
	{
		if($post = $this->input->post())
		{
			for($i=0;$i<$post['no'];$i++)
			{
				$item[$i]['icon'] = $post['icon_'.$i];
				$item[$i]['title']= $post['title_'.$i];
				$item[$i]['data'] = $post['data_'.$i];
			}

			$en =  json_encode($item);

			$data = array('name'=>$post['name'],
							'no'=>$post['no'],
							'icolor' =>$post['iconcolor'],
							'boxcolor'=>$post['boxcolor'],
							'size'=>$post['size'],
							'type'=>$post['type'],
							'boxes'=>$en,
							'admin_id'=>CLIENT_ID,
						);

			$this->SiteModel->addFeatureBox($data);
			$this->session->set_flashdata('success','Feature Box Added Successfully');
			redirect(site_url('admin/feature-box'));
		}
		else
		{
			$this->load->view('feature_box.php');
		}
	}
    function file_up($file){
        if(!empty($_FILES[$file]['name'])){
            
            $filename = $_FILES[$file]['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
			$x = getRadomNumber(10).'.'.$ext;
			$saveName = 'public/temp/'.CLIENT_ID.'/'.$x;
		     $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
		     $config['allowed_types'] = 'jpg|jpeg|png|gif';
		     $config['max_size'] = '2048'; // max_size in kb
		     $config['file_name'] = $x;
		     $this->load->library('upload',$config); 
		     if($this->upload->do_upload($file)){

		       $uploadData = $this->upload->data();

		       $data = array('file_name'=>$x,'admin_id'=>CLIENT_ID);
                $this->db->insert('manage_files',$data);
		       $data['size'] = $_FILES[$file]['size'];
		       $this->SiteModel->insert_file_size($data);
		       return $x;
		     }
		   } 
		  return '';
    }
	public function upload_file($value='')
	{

		if(!empty($_FILES['file']['name'])){
            
            $filename = $_FILES['file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
			$x = getRadomNumber(10).'.'.$ext;
			$saveName = 'public/temp/'.CLIENT_ID.'/'.$x;

		     $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 

		     $config['allowed_types'] = 'jpg|jpeg|png|gif';

		     $config['max_size'] = '2048'; // max_size in kb

		     $config['file_name'] = $x;

		     $this->load->library('upload',$config); 

		     if($this->upload->do_upload('file')){

		       $uploadData = $this->upload->data();

		       $data = array('file_name'=>$x,'admin_id'=>CLIENT_ID);
                $this->db->insert('manage_files',$data);
		       //$this->SiteModel->insert_manage_file($data);

		       $data['size'] = $_FILES['file']['size'];

		       $this->SiteModel->insert_file_size($data);

		     }

		   }

	}
	function test(){
		echo 'yes';
	}
  function menutest(){
      $menuCSS = $this->MenuModel->getMenuCSS();
	                $me2=  $me=$menuCSS->row();
      $return['html'] = '
			                           	.menu-css{
			                           	';
			                           	
			                           	
                        $mean=\C::menuCssArray();
						$css = json_decode(json_encode(json_decode($me2->menu)),true);

	                    $cssHover= (array)json_decode($me2->menu_hover);
			                      
                       		 foreach ($css as $pro => $val)
						      {
						          
						          if($pro == 'box-shadow')
				                        $val =  $css[$pro]['box_shadow_type'].' '.$css[$pro]['shad_first'].' '.$css[$pro]['shad_first1'].' '.$css[$pro]['shad_first2'].' '.$css[$pro]['shad_first3'].' '.$css[$pro]['boxShadowColor'];
			
						          
						          
						          if($val=='bold')
						      			$pro='Fweight';
						      			
						         $return['html'].=($mean[$pro].$val.' !important;');
						      }

                       $return['html'].='}
                                        .menu-css:hover{';
                                        		 foreach ($cssHover as $pro => $val)
											      {
											          $return['html'].=$mean[$pro].$val.' !important;';
											      }
                       $return['html'].='}
                                        </div><script>font_select();</script>';
                                        echo $return['html'];
}

public function AJAX($value='')
{

		$return = array('status'=>0,'content'=>'','html'=>'');

		$post = $this->input->post();

		if($post){

			switch ($post['var']) {
			    case 'save_menu_data':
			        $data = [
			            'label' => $post['label'],
			            'link'  => isset($post['link']) ? $post['link'] : ''
			            ];
			            $this->db->where('id',$post['menu_id'])->update('menu',$data);
			    break;
			    case 'delete-menu-group':
			        $return['status'] = $this->MenuModel->removeMenuGroup($post['id']);
			    break;
                case 'enable_ticker':
                    $this->NewsModel->ticker_enable($post['id']);
                break;
                case 'form-setting-css':
                    unset($post['var']);
                    extract($post);
                    $get = $this->FormModel->getFormModel(array('id'=>$form_id))->row();
                    $css = [];
                    if(!empty($get->css) && isJson($get->css)){
                        $css = OBJTOARRAY(json_decode($get->css,true));
                    }
                    if($type == 'form_theme'){
                        
                        $get = $this->db->get_where('form_themes',['id'=>$value]);
                     
                        $data['theme_id'] = $value;
                        $data['css'] = '';
                        if($get->num_rows())
                            $data['css'] = $get->row()->css;
                        
                    }
                    /*
                    else if($type == 'header_design'){
                     
                        $css['header'][$name] = $value.($inputType == 'number' ? 'px' : '');
                        $data['css'] = json_encode($css);
                    }
                    else if($type == 'body_design'){
                        $css['body'][$name] = $value.($inputType == 'number' ? 'px' : '');
                        $data['css'] = json_encode($css);
                    }
                    */
                    else{
                        if(isset($_FILES['file']['name'])){
                            
                           $filename = $_FILES['file']['name'];
                           $location = "public/temp/".CLIENT_ID.'/'.$filename;
                           $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                           $imageFileType = strtolower($imageFileType);
                        
                        
                           $valid_extensions = array("jpg","jpeg","png");
                        
                           $response = 0;
                     
                           if(in_array(strtolower($imageFileType), $valid_extensions)) {
                      
                              if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                                 $response = $location;
                              }
                           }
                            $value =  'url('.base_url.'/'.$location.');background-size:100% 100%;background-repeat:no-repeat';
                        }
                        if($inputType == 'box-shadow')
                            unset($css[$index][$name]);
                        $index = str_replace('_design','',$type);
                        $pxValue = ['range','number'];
                        $css[$index][$name] = $value.(in_array($inputType,$pxValue) ? 'px' : '');
                        $data['css'] = json_encode($css);
                    }
                    $this->db->where('id',$form_id)->update('form_model',$data);
                    $return[$name] = $value;
                break;

			    case 'save_tab_css':
			        $tab_id = $post['tab_id'];
			        unset($post['tab_id']);
			        $tabData = $tabHData = $head = [];
                    foreach($post['head'] as $k => $v){
                        if(!in_array($k,'background') )
                            $v = $v.'px';
                        $head[$k]  = $v;
                    }
                    unset($post['head']);
                    foreach ($post as $k => $v) {
			    		if($k!='var'){

			    			if(!in_array($k, array('box_shadow_type','boxShadowColor','backgroundColor','textColor','BTcolor','BTstyle','BRcolor','BRstyle','BLcolor','BLstyle','BBcolor','BBstyle','backgroundHover','textHover','Fstyle','Ffamily')))
			    				$v=$v."px";
			    				
			    			if(in_array($k,['box_shadow_type','boxShadowColor','shad_first','shad_first1','shad_first2','shad_first3'])){
			    			    $tabData['box-shadow'][$k] = $v;
			    			}
			    			else if($k==='backgroundHover' || $k==='textHover')
			    				$tabHData[$k] = $v;
			    			else
			    				$tabData[$k] = $v;

			    		}
			    	}
			    	
			    	$this->db->where('id',$tab_id)->update('tabs',['headerCss'=>json_encode($head),'css'=>json_encode($tabData),'hoverCss'=>json_encode($tabHData)]);
                break;
			    case 'tab_setting':
			        $listTab = $this->HtmlModel->list_tabs( $post['id'] )[0];



                    $tabCss = $css = \C :: defaultMenuCss();

			        $css =   !empty( $listTab['css'] ) 
                                    ? (array) OBJTOARRAY(json_decode(str_replace( 'px' ,'' , $listTab['css'] ), true)  )
                                    : $css;


                    $tabCss = !empty($listTab['headerCss']) 

                                    ?   (array) OBJTOARRAY(json_decode(str_replace('px', '', $listTab['headerCss']))) 
                                    :   $tabCss;     

			        $cssHover  =  !empty( $listTab['hoverCss'] ) 
                                        
                                    ? (array) OBJTOARRAY(json_decode(str_replace( 'px' ,'' , $listTab['hoverCss'] ) , true) )
                                    : array( 'backgroundHover'=>'#0170de',	'textHover'=>'#57ff43' ); 

			        $return['html'] = $this->load->view('tab_section/tab_css',['css'=>$css,'cssHover'=>$cssHover,'id'=>$post['id'],'tabCss'=>$tabCss],true);
			    break;
			    
                case 'tab_set_in_page':
                    $data =  array(
                                    'type' => 'tab',
                                    'key_id' => $post['key_id'],
                                    'admin_id' => CLIENT_ID,
                                    'page_id' => $post['page_id']
                                );
                                
                    if($post['checked'] == 'true')
                        $this->SiteModel->useTab($data);
                    else
                        $this->SiteModel->useTab($data,true);
                        
                    $return['message'] = 'Successfully';
                break;
                case 'tab_use_in_page':
                    $return['html'] = '<div class="table-responsive">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" disabled></th>
                                    <th>Page Name</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach($this->SiteModel->list_page()->result() as $page){
                                $chked = $this->SiteModel->checkTabUseOrUnUse(['type'=>'tab','key_id'=>$post['id'],'page_id'=>$page->id]) ? 'checked' : '';
                $return['html'] .= '<tr>
                                        <td>
                                            <input type="checkbox" data-tab_id="'.$post['id'].'" class="tab-set-in-page" id="id_'.$page->id.'" value="'.$page->id.'" '.$chked.'>
                                        </td>
                                        <td>
                                            <label for="id_'.$page->id.'">
                                            '.ucwords($page->page_name).'
                                            </label>
                                            <div style="position:relative">
                                                <span class="pull-right text-success loadder-'.$page->id.'" style="display: none;position: absolute;right: 2px;top:-26px;font-size: 14px;">
                                                    <i class="fa fa-spin fa-spinner"></i> Wait..
                                                </span>
                                            </div>
                                        </td>
                                    </tr>';


                            }

        $return['html'] .= '</tbody>
                        </table>

                    </div>';
                break;
                case 'set_event_in_schema':
                    $return['status'] = $this->SiteModel->update_webSchema($post);
                break;
                case 'event_allPages_webSchema':
                    $return['html'] = '<div class="table-responsive">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" disabled></th>
                                    <th>Page Name</th>
                                </tr>
                            </thead>
                            <tbody>';

                            foreach($this->SiteModel->list_page()->result() as $page){
                                $chked = $this->SiteModel->checkEventUseOrNot(['type'=>$post['type'],'key_id'=>$post['id'],'page_id'=>$page->id]) ? 'checked' : '';
                $return['html'] .= '<tr>
                                        <td>
                                            <input type="checkbox" data-type="'.$post['type'].'" data-event_id="'.$post['id'].'" class="event-set-in-page" id="id_'.$page->id.'" value="'.$page->id.'" '.$chked.'>
                                        </td>
                                        <td>
                                            <label for="id_'.$page->id.'">
                                            '.ucwords($page->page_name).'
                                            </label>
                                            <div style="position:relative">
                                                <span class="pull-right text-success loadder-'.$page->id.'" style="display: none;position: absolute;right: 2px;top:-26px;font-size: 14px;">
                                                    <i class="fa fa-spin fa-spinner"></i> Wait..
                                                </span>
                                            </div>
                                        </td>
                                    </tr>';


                            }

        $return['html'] .= '</tbody>
                        </table>

                    </div>';
                break;
                
                case 'add_tab':

                    $data = [];

                    $data['title'] = trim($post['title']);
                    $content = [];
                    foreach($post['tab'] as $key => $val)
                        $content[$key] = [ 'title' => $val , 'content' => $_POST['arya_'.$key] ];
                    $data['content'] = json_encode( $content ); 
                    $return['status'] = $this->HtmlModel->create_tab($data);
                break;
                
                case 'manage_Google_Analytics':
                    $return['html'] = '<div>

                        <div class="">

                            <div class="col-md-6">
                                <form action="" method="POST" id="" class="add-google-pixel">
                                   <div class="input-group"><input type="text" name="pixel_id" required placeholder="Enter Google Analytics Id" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-success"><i class="fa fa-plus"></i> Add!</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12  table-responsive list-pixels" style="min-height:200px">

                            </div>
                        </div>

                    </div>
                    <script>
                    get_Google_Analytics();
                        function get_Google_Analytics(){
                            $x = $(".list-pixels");
                            console.log($x);
                            $x.html("<center><i class=\"fa fa-3x fa-spin fa-refresh\"></i> </center>");
                            $.ajax({
                                        type : "POST",
                                        url  : "'.base_url.'/admin/AJAX",
                                        data : {
                                            var : "list_Google_Analytics"
                                        },
                                        dataType : "json",
                                        success : function(res){
                                            console.log(res);
                                                $($x).html(res.html);
                                        },
                                        error:function(a,b,c){
                                                $x.html(a.responseText); 
                                        }
                            });
                        }
                    </script>';
                break;
                
                case 'remove_Google_Analytics':
                   $pixels = $this->SiteModel->Google_Analytics();
                    $newPixels = []; 
                    foreach($pixels as $pixel){
                        if($this->input->post('id') != $pixel)
                            $newPixels[] = $pixel;
                    }
                    $this->db->where('id',CLIENT_ID)->update('websites',['google_analytics'=>json_encode($newPixels)]);
                    $return['status'] = 1;
                break;
                case 'add_Google_Analytics':
                    $pixels = $this->SiteModel->Google_Analytics();
                    $newPixels = [];
                    foreach($pixels as $pixel)
                        $newPixels[] = $pixel;
                    $newPixels[] = $this->input->post('pixel_id');
                    $this->db->where('id',CLIENT_ID)->update('websites',['google_analytics'=>json_encode($newPixels)]);
                    $return['status'] = 1;
                break;
                case 'list_Google_Analytics':
                    $pixels = $this->SiteModel->Google_Analytics();

                    $return['html'] = '<table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pixel Id</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            $i = 1;
                                            foreach($pixels as $pixel){
                                $return['html'] .= '<tr data-pixel="'.$pixel.'">
                                                        <td>'.$i++.'.</td>
                                                        <td>'.$pixel.'</td>
                                                        <td><button class="btn btn-xs btn-danger  fa fa-trash remove-google-pixel"></button></td>
                                                    </tr>';
                                            }

                    $return['html'] .=  '</tbody>
                                    </table>';
                break;
                
                
                case 'manage_facebook_Pixel':
                    $return['html'] = '<div>

                        <div class="">

                            <div class="col-md-6">
                                <form action="" method="POST" id="" class="add-facebook-pixel">
                                   <div class="input-group"><input type="text" name="pixel_id" required placeholder="Enter Facebook Pixel Id" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-success"><i class="fa fa-plus"></i> Add!</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12  table-responsive list-pixels" style="min-height:200px">

                            </div>
                        </div>

                    </div>
                    <script>
                    get_facebook_pixels();
                        function get_facebook_pixels(){
                            $x = $(".list-pixels");
                            console.log($x);
                            $x.html("<center><i class=\"fa fa-3x fa-spin fa-refresh\"></i> </center>");
                            $.ajax({
                                        type : "POST",
                                        url  : "'.base_url.'/admin/AJAX",
                                        data : {
                                            var : "list_facebook_pixels"
                                        },
                                        dataType : "json",
                                        success : function(res){
                                            console.log(res);
                                                $($x).html(res.html);
                                        },
                                        error:function(a,b,c){
                                                $x.html(a.responseText); 
                                        }
                            });
                        }
                    </script>';
                break;
                case 'remove_facebook_pixel':
                   $pixels = $this->SiteModel->facebook_pixel();
                    $newPixels = []; 
                    foreach($pixels as $pixel){
                        if($this->input->post('id') != $pixel)
                            $newPixels[] = $pixel;
                    }
                    $this->db->where('id',CLIENT_ID)->update('websites',['facebook_pixels'=>json_encode($newPixels)]);
                    $return['status'] = 1;
                break;
                case 'add_facebook_pixel':
                    $pixels = $this->SiteModel->facebook_pixel();
                    $newPixels = [];
                    foreach($pixels as $pixel)
                        $newPixels[] = $pixel;
                    $newPixels[] = $this->input->post('pixel_id');
                    $this->db->where('id',CLIENT_ID)->update('websites',['facebook_pixels'=>json_encode($newPixels)]);
                    $return['status'] = 1;
                break;
                case 'list_facebook_pixels':
                    $pixels = $this->SiteModel->facebook_pixel();

                    $return['html'] = '<table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pixel Id</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            $i = 1;
                                            foreach($pixels as $pixel){
                                                $pixel = (int) $pixel;
                                $return['html'] .= '<tr data-pixel="'.$pixel.'">
                                                        <td>'.$i++.'.</td>
                                                        <td>'.$pixel.'</td>
                                                        <td><button class="btn btn-xs btn-danger  fa fa-trash remove-facebook-pixel"></button></td>
                                                    </tr>';
                                            }

                    $return['html'] .=  '</tbody>
                                    </table>';
                break;
                case 'removeContentArea':
                    $this->db->where(['key_id'=>$post['id'],'admin_id' => CLIENT_ID, 'type' => 'content_category'])->delete('web_schema');
                    $return['status'] = $this->db->where('id',$post['id'])->delete('content');
                break;
                
                case 'contentEventData':
                    $css = '<style>
                                    .radio-toolbar input[type="radio"] {
                                      opacity: 0;
                                      position: fixed;
                                      width: 0;
                                    }
                                    
                                    .radio-toolbar label {
                                        display: inline-block;
                                        background-color: #ddd;
                                        padding: 10px 20px;
                                        font-family: sans-serif, Arial;
                                        font-size: 16px;
                                        border: 2px solid #444;
                                        border-radius: 4px;
                                      cursor:pointer
                                    }
                                    .radio-toolbar label.checked {
                                        background-color:#bfb;
                                        border-color: #4c4;border: 2px dashed #444;
                                    }
                                    .radio-toolbar label:hover {
                                      background-color: #dfd;
                                    }
                                    span.small-form-title {
                                        font-size: .8em;
                                        bottom: 10px;
                                        position: absolute;
                                        left: 21px;
                                    }
                            </style>';
                    $html = '<div class="col-md-12">
                                <label>Enter Title</label>
                                <input type="text" placeholder="Enter Title Here.." class="form-control title-input" id="title" value="'.$post['title'].'">
                            </div>
                            <div class="message" style="    margin-top: 14px;"></div>
                            ';
                    $oldsHtml = $_POST['content'];
                    switch($post['type']){
                        
                        case 'content':
                            $html .= '<style>.jconfirm {z-index:9999}</style>
                                    <div class="col-md-12 form-group">
                                        <label>Enter Content</label>
                                        <textarea class="form-control arya-editor" id="arya-editor" placeholder="Enter Content">'.$oldsHtml.'</textarea>
                                    </div>';
                            $html .='<script src="'.base_url.'/public/custom/ckeditor/ckeditor.js"></script>
                                    <script>CKEDITOR.replace("arya-editor")</script>';                        
                        break;
                        
                        case 'form':
                            
                            $html .= $css.'<div class="col-md-12">
                                            <label>Select A Form</label>
                                            
                                            <div class="form-group col-md-12 radio-toolbar">';
                                            $oldId = empty($oldsHtml) ? 0 : $oldsHtml;
                                            
                                            $forms = $this->FormModel->getFormModel(); 
                                            if($forms->num_rows()){
                                                foreach($forms->result() as $form){
                                                    $chk = $oldId == $form->id ? 'checked' : '';
                                                    $html .= '<input type="radio" class="radioForm_id" id="radioForm_id'.$form->id.'" '.$chk.' value="'.$form->id.'">
                                                              <label for="radioForm_id'.$form->id.'" data-id="'.$form->id.'" class="radioForm  '.$chk.'">'.$form->title.'</label>';
                                                }
                                            }
                                            else
                                                $html .= '<input type="hidden" class="form_id" value="0"><div class="alert alert-danger">Please Create A Form First</div>';
                                            
                            $html .=       '</div>
                                    </div>
                                    <input type="hidden" id="form_id" value="'.$oldId.'">';
                        break;
                        case 'tform':
                            
                            $html .= $css.'<div class="col-md-12">
                                            <label>Select A Form</label>
                                            
                                            <div class="form-group col-md-12 radio-toolbar">';
                                            $oldId = empty($_POST['content']) ? 0 : $_POST['content'];
                                            
                                            $forms = $this->FormModel->getTransactionForm(); 
                                            if($forms->num_rows()){
                                                foreach($forms->result() as $form){
                                                    $chk = $oldId == $form->id ? 'checked' : '';
                                                    $html .= '<input type="radio" class="radioForm_id" id="radioForm_id_'.$form->id.'" '.$chk.'value="'.$form->id.'">
                                                              <label for="radioForm_id_'.$form->id.'" data-id="'.$form->id.'" class="radioForm '.$chk.'">'.$form->tform_name.'</label>';
                                                }
                                            }
                                            else
                                                $html .= '<input type="hidden" class="form_id" value="0"><div class="alert alert-danger">Please Create First A  Transaction Form </div>';
                                            
                            $html .=       '</div>
                                    </div>
                                    <input type="hidden" id="form_id" value="'.$oldId.'">';
                        break;
                        case 'newsSlider': case 'titleNewsList': case 'thumbnailNewsList':
                            $oldsHtml = empty($oldsHtml) ? [] : json_decode($oldsHtml,true);
                            $cats = isset($oldsHtml['category']) ? $oldsHtml['category'] : [];
                            $num = isset($oldsHtml['number_of_post']) ? $oldsHtml['number_of_post'] : 5;
                            $html .= '<div class="row">
                                    <div class="col-md-6">
                                            <label>Select Category</label>
                                            <select class="form-control" id="cat_ids" multiple>';
                                                foreach( $this->NewsModel->get_category()->result() as $cat){
                                                    $select = in_array($cat->id,$cats) ? 'selected' : '';
                                                    $html .= '<option '.$select.' value="'.$cat->id.'">'.$cat->name.'</option>';
                                                }
                            $html .=        '</select>
                            
                                    </div>
                                    <div class="col-md-6">
                                            <label>Number of Post List in This Event [ <b class="text-success">'.$post['title'].'</b> ]</label>
                                            <input type="number" id="number_of_post" class="form-control" value="'.$num.'">
                            
                                     </div></div>';
                        break;
                        
                        default:
                                $html .= '<h3>Select '.ucwords($post['type']).'</h3>';
                        break;
                    }
                    $return['html'] = $html;
                break;
                
                case 'DeleteServiceItem':
                    $this->db->where( 'id' , $post['id'] )->delete('file_service_data');
                    $return['status'] = true;
                break;
                
                case 'GetTextwithIconWidgetAField':
                    $t = time();
                    $return['html'] = '
                    <div class="row" style="background:lightyellow;border-top:1px solid red;border-bottom:1px solid red;margin-bottom:3px" >
                            <div class="form-group col-md-2">
                                <label>Select Icon</label>    
                                <input type="hidden" name="info[icon][]" class="icon-'.time().'" value="">
                                <button style="width:100%" class="btn btn-warning select-icon" data-id="'.time().'" type="button">Select Icon</button>
                            </div>
                        
                            <div class="form-group col-md-9">
                        
                                <label>Enter Title</label>
                                <textarea class="text-widget" name="" id="text'.$t.'" name="info[content][]"></textarea>
                                
                            </div>
                            
                            <div class="form-group col-md-1" style="padding-top:30px">
                                <a href="javascript:void(0)" class="remove-txt-field btn btn-danger"><i class="fa fa-times"></i></a>
                            <div>
                            <script>
                                CKEDITOR.replace("text'.$t.'",{
                                  toolbarGroups:[   { "name": "basicstyles", "groups": ["basicstyles"] },
                                                    { "name": "colors", "groups": [ "colors" ] },
                                                    { "name": "links",  "groups": ["links"] },
                                                    { "name": "styles", "groups": ["styles"] },
                                                    {  name :  "CKAwesome", "items" : ["Image", "ckawesome"] }
                                                ],
                                                removeButtons: "Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar"
                                });
                                
                            </script>
                    </div>';
                break;
                
                case 'saveSingleMenuSetting':
                    $icons = $this->MenuModel->getIconCss($post['MenuId']);
			        $icons = (array) ( !empty( $icons ) ? json_decode($icons) : C::isIconStyle() );
			        
			        $icons[ $post['type'] ] = $post['value'];
			        
			        $this->MenuModel->UpdateIconCss($post['MenuId'],['iconCss' => json_encode($icons) ] );
			        $return = $icons;
                break;
                
			    case 'SingleMenuSetting':
			        
			        $menu = $this->MenuModel->get_menus(0,$post['MenuId']);
			        $menu = $menu->row();
			        $icons = $menu->iconCss;
			        $icons = (array) ( !empty( $icons ) ? json_decode($icons) : C::isIconStyle() );
			        
			        $position = $icons['position'] == 'right' ? 'checked' : ''; 
			        $icon_hide = $icons['icon_hide'] == 'true' || !isset($icons['icon_hide']) ? 'checked' : '';
			        $title_hide = $icons['title_hide'] == 'true' || !isset($icons['title_hide']) ? 'checked' : '';
    			    $return['html'] = '
    			        <style>
    			            .switch {
                              display: inline-block;
                              height: 24px;
                              position: relative;
                              width: 60px;
                            }
                            
                            .switch input {
                              display:none;
                            }
                            
                            .slider {
                              background-color: #ccc;
                              bottom: 0;
                              cursor: pointer;
                              left: 0;
                              position: absolute;
                              right: 0;
                              top: 0;
                              transition: .4s;
                            }
                            
                            .slider:before {
                                background-color: #fff;
                                bottom: -3px;
                                content: "";
                                height: 29px;
                                left: 4px;
                                position: absolute;
                                transition: .4s;
                                width: 30px;
                                border: 1px solid green;
                            }
                            
                            input:checked + .slider {
                              background-color: #66bb6a;
                            }
                            
                            input:checked + .slider:before {
                              transform: translateX(26px);
                            }
                            
                            .slider.round {
                              border-radius: 34px;
                            }
                            
                            .slider.round:before {
                              border-radius: 50%;
                            }
    			        </style>
    			        <div class="row">
    			            <input type="hidden" id="MENU_ID" value="'.$post['MenuId'].'">
    			            <div class="col-md-12 p-0">
        			            <div class=" card">
                                    <div class="card-header">
                                        <ul class="nav nav-justified">
                                            <li class="nav-item"><a data-toggle="tab" href="#icon-style" class="active nav-link">Icon Style</a></li>
                                            <li class="nav-item"><a data-toggle="tab" href="#menu-style" class="nav-link">Menu Style</a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="col-md-12 icon-proccess">
                                                    
                                            </div>
                                            <div class="tab-pane active" id="icon-style" role="tabpanel">
                                                <div class="row">
                                                    
                                                    <div class="col-md-2">
                                                        <label>Position</label><br>
                                                        Left
                                                        <label class="switch" for="checkbox">
                                                            <input type="checkbox" id="checkbox"  class="iconCss" data-event="position" '.$position.'  />
                                                            <div class="slider round"></div>
                                                        </label>
                                                        Right
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <label>Color</label>
                                                        <input type="color"  class="iconCss form-control" data-event="color" value="'.$icons['color'].'"  />
                                                    </div>
                                                     <div class="col-md-2">
                                                        <label>Font-Size</label>
                                                        <input type="number"  class="iconCss form-control" data-event="font-size" value="'.$icons['font-size'].'"  />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Icon Visibility</label><br>
                                                        Hide
                                                        <label class="switch" for="checkbox1">
                                                            <input type="checkbox" id="checkbox1"  class="iconCss" data-event="icon_hide" '.$icon_hide.'  />
                                                            <div class="slider round"></div>
                                                        </label>
                                                        Show
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Title Visibility</label><br>
                                                        Hide
                                                        <label class="switch" for="checkbox2">
                                                            <input type="checkbox" id="checkbox2"  class="iconCss" data-event="title_hide" '.$title_hide.'  />
                                                            <div class="slider round"></div>
                                                        </label>
                                                        Show
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="menu-style" role="tabpanel">
                                                <form class="row update-menu-data">
                                                    <div class="col-md-4 form-group">
                                                        <label>Label</label>
                                                        <input type="text" name="label" class="form-control" value="'.$menu->label.'">
                                                    </div>';
                                                    if(!empty($menu->link)){
                                                        
                                                        $return['html'] .=  '<div class="form-group col-md-4">
                                                                                <label>Label</label>
                                                                                <input type="text" name="link" class="form-control" value="'.$menu->link.'">
                                                                             </div>';    
                                                        
                                                    }
                                $return['html'] .= '
                                                
                                                    <div class="form-group col-md-12">
                                                        <button class="btn btn-success"><i class="fa fa-save"></i></button>
                                                    </div>
                                                
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
    			        </div>
    			    ';
			    break;

			    case 'menu_setting':
			    	
			   
			    	$menuCSS = $this->MenuModel->getMenuCSS(['group_id'=>$post['group_id']]);
	                $me2=  $me=$menuCSS->row();
	                $cur = array();

	                if($me->submenu!=''){
	                	$submenuCss = (array)json_decode(json_encode(json_decode(str_replace('px', '',$me->submenu))),true);;
	                	$submenuCssHover = (array) json_decode(str_replace('px', '',$me->submenu_hover));

                        $submenuCss['Fstyle'] = isset($submenuCss['Fstyle']) ? $submenuCss['Fstyle'] : 'normal';

                        $submenuCss['Ffamily'] = isset($submenuCss['Ffamily']) ? $submenuCss['Ffamily'] : 'Arial'; 

	                } 
	                else{

	                	$submenuCss         =   \C::defaultMenuCss();
	                	$submenuCssHover    =   array( 'backgroundHover'=>'#0170de',	'textHover'=>'#57ff43' );    
	                }

	                if($me->menu!='')
	                {
	                    $css = (array)  json_decode(json_encode(json_decode(str_replace('px', '',$me->menu))),true);
                        
                        $css['BTcolor'] = isset($css['BTcolor']) ? $css['BTcolor'] : $css['Bcolor'];
                        $css['BLcolor'] = isset($css['BLcolor']) ? $css['BLcolor'] : $css['Bcolor'];
                        $css['BBcolor'] = isset($css['BBcolor']) ? $css['BBcolor'] : $css['Bcolor'];
                        $css['BRcolor'] = isset($css['BRcolor']) ? $css['BRcolor'] : $css['Bcolor'];
                        
                        $css['BTsize'] = isset($css['BTsize']) ? $css['BTsize'] : $css['Bsize'];
                        $css['BLsize'] = isset($css['BLsize']) ? $css['BLsize'] : $css['Bsize'];
                        $css['BBsize'] = isset($css['BBsize']) ? $css['BBsize'] : $css['Bsize'];
                        $css['BRsize'] = isset($css['BRsize']) ? $css['BRsize'] : $css['Bsize'];
                        
                        $css['BTstyle'] = isset($css['BTstyle']) ? $css['BTstyle'] : $css['Bstyle'];
                        $css['BLstyle'] = isset($css['BLstyle']) ? $css['BLstyle'] : $css['Bstyle'];
                        $css['BBstyle'] = isset($css['BBstyle']) ? $css['BBstyle'] : $css['Bstyle'];
                        $css['BRstyle'] = isset($css['BRstyle']) ? $css['BRstyle'] : $css['Bstyle'];
                        
                        $css['BradiusBTL'] = isset($css['BradiusBTL']) ? $css['BradiusBTL'] : $css['Bradius'];
                        $css['BradiusBTR'] = isset($css['BradiusBTR']) ? $css['BradiusBTR'] : $css['Bradius'];
                        $css['BradiusBBL'] = isset($css['BradiusBBL']) ? $css['BradiusBBL'] : $css['Bradius'];
                        $css['BradiusBBR'] = isset($css['BradiusBBR']) ? $css['BradiusBBR'] : $css['Bradius'];
                        
                        $css['box-shadow']['shad_first'] = isset($css['box-shadow']['shad_first']) ? $css['box-shadow']['shad_first'] : 0;
                        $css['box-shadow']['shad_first1'] = isset($css['box-shadow']['shad_first1']) ? $css['box-shadow']['shad_first1'] : 0;
                        $css['box-shadow']['shad_first2'] = isset($css['box-shadow']['shad_first2']) ? $css['box-shadow']['shad_first2'] : 0;
                        $css['box-shadow']['shad_first3'] = isset($css['box-shadow']['shad_first3']) ? $css['box-shadow']['shad_first3'] : 0;
                        
                        
                        $css['box-shadow']['boxShadowColor'] = isset($css['box-shadow']['boxShadowColor']) ? $css['box-shadow']['boxShadowColor'] : 'black';
                        $css['box-shadow']['box_shadow_type'] = isset($css['box-shadow']['box_shadow_type']) ? $css['box-shadow']['box_shadow_type'] : '';
                        
                        $css['marginBottom'] = isset($css['marginBottom']) ? $css['marginBottom'] : 0;
                        $css['marginTop'] = isset($css['marginTop']) ? $css['marginTop'] : 0;
                        $css['marginRight'] = isset($css['marginRight']) ? $css['marginRight'] : 0;
                        $css['marginLeft'] = isset($css['marginLeft']) ? $css['marginLeft'] : 0;
                        
	                    $cssHover= (array) json_decode(str_replace('px', '',$me->menu_hover));            
	                }
	                else
	                {
	                  		$css            =   \C::defaultMenuCss();
								
	                  		$cssHover       =   array('backgroundHover'=>'#0170de','textHover'=>'#57ff43');
	         
	                }
	 
			        $return['status'] =1;
                    $return['css'] = $css;
                    $return['cssHover'] = $cssHover;
			        $return['html'] = '

			        <style>

			          .sub-menu-css:hover,.menu-css:hover{text-decoration:none}
			          .nav-item .nav-link { font-weight: normal; border: 1px groove #3f6ad8; border-radius: 5px; }

			        </style>

			                <form  method="POST"  class="row" id="menuStyle">
			                  <div class="col-md-8">			                              

			                            <input type="hidden" name="var" value="updateMenuStyle">
			                            <input type="hidden" name="group_id" id="group_id" value="'.$post['group_id'].'">
			                    <div class="tab-content">
                                    <div class="tab-pane active " id="menu" role="tabpanel">';

                $return['html'] .=  $this->load->view('menu_section/menu',['css'=>$css,'cssHover'=>$cssHover],true);

                                            
                $return['html'] .= '</div>
                                    <div class="tab-pane " id="sub-menu" role="tabpanel">';
                $return['html'] .=  $this->load->view('menu_section/submenu',['css'=>$submenuCss,'cssHover'=>$submenuCssHover],true);
                                    	
                $return['html'] .= '</div>
                                </div>             	 
			                  </div>

			                  <div class="col-md-4" style="height:320px">

			                                <div class="card">

			                                    <div class="card-header">

			                                       Menu Preview

			                                    </div>

			                                    <div class="card-body md" style="overflow-x:hidden;background: rgba(0,0,0,0.8);">

			                                       <ul>

			                                            <li style="list-style:none">

			                                                <a class="menu-css" href="#">Menu</a>
			                                                <ul>
			                                                	<li style="list-style:none;margin-top: 13px;">
			                                                		<a class="sub-menu-css" href="#">SubMenu</a>
			                                                	</li>
			                                                </ul>
			                                            </li>

			                                       </ul>

			                                    </div>
			                                    <div class="card-body md" style="  padding: 10px 10px 0 0px; overflow-x:hidden">
			                                    	<ul class="tabs-animated-shadow nav-justified tabs-animated nav">

                                                            <li class="nav-item">

                                                                <a role="tab" class="nav-link active show" id="tab-c1-0" data-toggle="tab" href="#menu" onclick="" aria-selected="true">

                                                                    <span class="nav-text"><i class="fa fa-cog"></i> Menu </span>

                                                                </a>

                                                            </li>
                                                            <li class="nav-item">

                                                                <a role="tab" class="nav-link" id="tab-c1-0" data-toggle="tab" href="#sub-menu" aria-selected="true">

                                                                    <span class="nav-text"><i class="fa fa-cog"></i> Sub Menu </span>

                                                                </a>

                                                            </li>
                                                    </ul>
			                                    </div>
			                                    <div class="card-footer">
			                                            <button class="btn btn-info" onclick="resetToDefault()">Reset to Default</button>
			                                        	<button class="btn btn-success" type="submit"> <i class="pe-7s-plus"></i> Save</button>
			                                    </div>

			                                </div>

			                  </div>

			                </form> 
			                  <div class="cssBox">
                               </div>


                               ';

			    break;

			    case 'resetToDefault':
			    	$this->db->where('admin_id',CLIENT_ID)->where('group_id',$post['group_id'])->update('menu_css',array('menu'=>'','menu_hover'=>'','menubar_color'=>''));
			    	$return['html']='';
			    break;
                
			    case 'updateMenuStyle':

			    $mdata = array();
			    $mhdata = array();
			    $Submdata = array();
			    $Submhdata = array();
			    	
			    	foreach($post['submenu']  as $k => $v){
			    		if($k!='var'){

			    			if(!in_array($k, array('box_shadow_type','boxShadowColor','backgroundColor','textColor','BTcolor','BTstyle','BRcolor','BRstyle','BLcolor','BLstyle','BBcolor','BBstyle','backgroundHover','textHover','Fstyle','Ffamily')))
			    				$v=$v."px";
			    				
			    			if(in_array($k,['box_shadow_type','boxShadowColor','shad_first','shad_first1','shad_first2','shad_first3'])){
			    			    $Submdata['box-shadow'][$k] = $v;
			    			}
			    			else if($k==='backgroundHover' || $k==='textHover')
			    				$Submhdata[$k] = $v;
			    			else
			    				$Submdata[$k] = $v;


			    		}
			    	}
			    	unset($post['submenu']);
			    	foreach ($post as $k => $v) {
			    		if($k!='var'){

			    			if(!in_array($k, array('box_shadow_type','boxShadowColor','backgroundColor','textColor','BTcolor','BTstyle','BRcolor','BRstyle','BLcolor','BLstyle','BBcolor','BBstyle','backgroundHover','textHover','Fstyle','Ffamily')))
			    				$v=$v."px";
			    				
			    			if(in_array($k,['box_shadow_type','boxShadowColor','shad_first','shad_first1','shad_first2','shad_first3'])){
			    			    $mdata['box-shadow'][$k] = $v;
			    			}
			    			else if($k==='backgroundHover' || $k==='textHover')
			    				$mhdata[$k] = $v;
			    			else
			    				$mdata[$k] = $v;

			    		}
			    	}
			    	//$data2 = array('menu'=>serialize($mdata),'menu_hover'=>serialize($mhdata));
			   	
			 		$data2 = array(
			 						'menu'=>json_encode($mdata),'menu_hover'=>json_encode($mhdata),
			 						'submenu' => json_encode($Submdata), 'submenu_hover' => json_encode($Submhdata)
			 					);


			    $x =	$this->MenuModel->update_menu(array('admin_id'=>CLIENT_ID,'group_id'=>$post['group_id']),$data2);
			    $return['status'] = $x;
			    $return['status'] = true;
			    $return['html'] = $post;

			    break;

			    case 'theme_set':

			        $this->SiteModel->update_website(array('theme_id'=>$post['theme_id']),array('id'=>CLIENT_ID));

			        $return['status'] = 1;

			    break;
                
                case 'delete_file_gallery':
                    $this->db->where(array('file_download_gallery_id'=> $post['id']))->delete('file_download_gallery');
					$this->db->where(array('file_download_gallery_id'=> $post['id'],'admin_id'=>CLIENT_ID))->delete('files_download_gallery');
					$this->db->where(array('key_id'=>$post['id'],'type'=>'fdgallery','admin_id'=>CLIENT_ID))->delete('web_schema');
                    $return['status'] = true;
                break;
                
				case 'delete_image_gallery':

					$this->db->where(array('id'=>$post['id']))->delete('image_gallery');
					$this->db->where(array('gallery_id'=>$img->id))->delete('gallery_images');
					$this->db->where(array('gal_id'=>$post['id'],'admin_id'=>CLIENT_ID))->delete('gallery_link');
					$this->db->where(array('key_id'=>$post['id'],'type'=>'igallery','admin_id'=>CLIENT_ID))->delete('web_schema');
					
				   $return['status'] = 1;

				break;

				case 'delete__manage_file':

					$this->SiteModel->delete_manage_file(array('id'=>$post['id']));

					$return['status'] = 1;

				break;

				case 'chnage_header':

					$return['status'] = 1;

				   $data = array('top_bar' =>$post['header']);

				   $this->SiteModel->AdminTheme($data);

				   $return['content'] = '';

				break;

				case 'chnage_sidebar':

				   $return['status'] = 1;

				   $data = array('slider_bar' =>$post['slider']);

				   $this->SiteModel->AdminTheme($data);

				   $return['content'] = '';

				break;

				case 'manage_files':

				    $manages = $this->SiteModel->manage_files();
    $return['content'] .= '<div style="overflow-x: hidden;height:325px">';
				    if($manages->num_rows()){

$return['content'] .='

                            <div class="col-md-2" style="display:inline-block">

							<div id="zdrop" class="fileuploader" style="height:	35px;">				    

								<div id="upload-label" style="width: 100%;">

									<button class="btn btn-success btn-xs btn-sm" style="width: 100%;"><i class="material-icons">cloud_upload</i></button>

								</div>

							</div>

							<!-- Preview collection of uploaded documents -->

							<div class="preview-container">

								<div class="header">

									<span>Uploaded Files</span>	

									<i id="controller" class="material-icons">keyboard_arrow_down</i>

								</div>

								<div class="collection card" id="previews">

									<div class="collection-item clearhack valign-wrapper item-template" id="zdrop-template">

										<div class="left pv zdrop-info" data-dz-thumbnail>

											<div>

												<span data-dz-name></span> <span data-dz-size></span>

											</div>

											<div class="progress">

												<div class="determinate" style="width:0" data-dz-uploadprogress></div>

											</div>

											<div class="dz-error-message"><span data-dz-errormessage></span></div>

										</div>



										<div class="secondary-content actions">

											<a href="#!" data-dz-remove class="btn-floating ph red white-text waves-effect waves-light"><i class="fa fa-remove"></i></i></a>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div class="col-md-12">

						<table class="table table-bordered table-striped">

						   <thead>

						   	  <tr>

						   	  	<th>Image</th>

						   	  	<th>Copy</th>

						   	  	<th>Delete</th>

						   	  </tr>

						   </thead>

						   <tbody>';	

						foreach ($manages->result() as $key => $rt) {

$return['content'] .=  '<tr>

							<td>

							<img width="50" src="'.site_url('public/temp/'.CLIENT_ID.'/'.$rt->file_name).'" alt>

							</td>

							<td>

								<button class="btn btn-success btn-xs btn-sm" onclick="copy_link(this)" src="'.site_url('public/temp/'.CLIENT_ID.'/'.$rt->file_name).'"><i class="fa fa-copy"></i></button>

							</td>

							<td>

								<button class="btn btn-danger btn-xs btn-sm" onclick="delete__manage('.$rt->id.',this)"><i class="fa fa-trash"></i></button>

							</td>

						</tr>';							

						}

$return['content'] .= '<tbody></table></div>';	    		

				    }

				    else{

				    	$return['content'] = '<div id="zdrop" class="fileuploader ">				    

								<div id="upload-label" style="width: 200px;">

									<i class="material-icons">cloud_upload</i>

									<span class="title">Drag your Files here</span>

									<span>Some description here <span/>

								</div>

							</div>

							<!-- Preview collection of uploaded documents -->

							<div class="preview-container">

								<div class="header">

									<span>Uploaded Files</span>	

									<i id="controller" class="material-icons">keyboard_arrow_down</i>

								</div>

								<div class="collection card" id="previews">

									<div class="collection-item clearhack valign-wrapper item-template" id="zdrop-template">

										<div class="left pv zdrop-info" data-dz-thumbnail>

											<div>

												<span data-dz-name></span> <span data-dz-size></span>

											</div>

											<div class="progress">

												<div class="determinate" style="width:0" data-dz-uploadprogress></div>

											</div>

											<div class="dz-error-message"><span data-dz-errormessage></span></div>

										</div>



										<div class="secondary-content actions">

											<a href="#!" data-dz-remove class="btn-floating ph red white-text waves-effect waves-light"><i class="fa fa-remove"></i></i></a>

										</div>

									</div>

								</div>

							</div>';

							}

$return['content'] .='</div><script>

			 $(document).ready(function(){



                initFileUploader("#zdrop");



                function initFileUploader(target) {

                    var previewNode = document.querySelector("#zdrop-template");

                    previewNode.id = "";

                    var previewTemplate = previewNode.parentNode.innerHTML;

                    previewNode.parentNode.removeChild(previewNode);

                    var zdrop = new Dropzone(target, {

                        url: "'.site_url('admin/upload_file').'",

                        maxFilesize:20,

                        previewTemplate: previewTemplate,

                        autoQueue: true,

                        previewsContainer: "#previews",

                        clickable: "#upload-label"

                    });



                    zdrop.on("addedfile", function(file) { 

                        $(".preview-container").css("visibility", "visible");

                    });



                    zdrop.on("totaluploadprogress", function (progress) {

                        var progr = document.querySelector(".progress .determinate");

                        if (progr === undefined || progr === null)

                            return;



                        progr.style.width = progress + "%";

                        if(progress==100){

                        	toastr.success("File Upload successfully.");

                        	st.close();

                        	manage_gallery();

                        }

                    });



                    zdrop.on("dragenter", function () {

                        $(".fileuploader").addClass("active");

                    });



                    zdrop.on("dragleave", function () {

                        $(".fileuploader").removeClass("active");           

                    });



                    zdrop.on("drop", function () {

                        $(".fileuploader").removeClass("active");   

                    });

                    

                    var toggle = true;

                    /* Preview controller of hide / show */

                    $("#controller").click(function() {

                        if(toggle){

                            $("#previews").css("visibility", "hidden");

                            $("#controller").html("keyboard_arrow_up");

                            $("#previews").css("height", "0px");

                            toggle = false;

                        }else{

                            $("#previews").css("visibility", "visible");

                            $("#controller").html("keyboard_arrow_down");

                            $("#previews").css("height", "initial");

                            toggle = true;

                        }

                    });

                }



            });

			</script>



			';

				break;

				case 'add_cats_TO_menu':
					$return['count']= count($post['page_id']);

					$return['message'] = $return['menu'] = '';
                    $group = $this->MenuModel->get_menu_groups(['id'=>$post['group_id']]);
                    
                    $group_id = $group->num_rows() ? $post['group_id'] : $this->MenuModel->install_menu_group($post['group_name'],false)->id;
				    foreach ($post['cat_id'] as $i => $p) {
                      
				    		$d = array('page_id'=>$p,'label'=>$post['cat_'.$p],'admin_id'=>CLIENT_ID,'type'=>'category');

				    		$this->db->insert('menu',$d);
				    		
				    		$return['menu'] .= '<li class="dd-item dd3-item" data-id="'.$this->db->insert_id().'" >

			                    <div class="dd-handle dd3-handle"></div>

			                    <div class="dd3-content"><span id="label_show'.$this->db->insert_id().'">'.$post['cat_'.$p].'</span>

			                        <span class="span-right"><span id="link_show'.$this->db->insert_id().'">Category</span> &nbsp;&nbsp; 

			                        	<a class="SingleMenuSetting" onclick="SingleMenuSetting('.$this->db->insert_id().')"><i class="fa fa-cog"></i></a>

		                           		<a class="del-button" id="'.$this->db->insert_id().'"><i class="fa fa-trash"></i></a>

			                        </span> 

			                    </div></li>';

				    		$return['message'] .= $post['cat_'.$p].' add Category successfully.<br>';

				    	

				    }

					$return['status']=1;
                    $return['group_id'] = $group_id;
                    $return['group_name'] = $post['group_name'];
                    $return['li'] = '<li class="nav-item"><a data-toggle="tab" href="#print-menu-'.time().'" onclick="print_menu('.$group_id.')" class="nav-link print-menu-'.$group_id.'">'.$post['group_name'].'</a></li>';
                    $return['isGroupAdd'] = !$group->num_rows();
				break;

				case 'add_pages_TO_menu':

					$return['count']= count($post['page_id']);

					$return['message'] = $return['menu'] = '';
                    
                    $group = $this->MenuModel->get_menu_groups(['id'=>$post['group_id']]);
                    
                    $group_id = $group->num_rows() ? $post['group_id'] : $this->MenuModel->install_menu_group($post['group_name'],false)->id;
                    
				    foreach ($post['page_id'] as $i => $p) {
                            
				    		$d = array('page_id'=>$p,'label'=>$post['page_'.$p],'admin_id'=>CLIENT_ID,'type'=>'page','group_id'=>$group_id);

				    		$this->db->insert('menu',$d);
				    		
				    		$return['menu'] .= '<li class="dd-item dd3-item" data-id="'.$this->db->insert_id().'" >

			                    <div class="dd-handle dd3-handle"></div>

			                    <div class="dd3-content"><span id="label_show'.$this->db->insert_id().'">'.$post['page_'.$p].'</span>

			                        <span class="span-right"><span id="link_show'.$this->db->insert_id().'">Page</span> &nbsp;&nbsp; 

			                        	<a class="SingleMenuSetting" onclick="SingleMenuSetting('.$this->db->insert_id().')"><i class="fa fa-cog"></i></a>

		                           		<a class="del-button" id="'.$this->db->insert_id().'"><i class="fa fa-trash"></i></a>

			                        </span> 

			                    </div></li>';

				    		$return['message'] .= $post['page_'.$p].' add successfully.<br>';

				    	

				    }

					$return['status']=1;
                    $return['group_id'] = $group_id;
                    $return['group_name'] = $post['group_name'];
                    $return['li'] = '<li class="nav-item"><a data-toggle="tab" href="#print-menu-'.time().'" onclick="print_menu('.$group_id.')" class="nav-link print-menu-'.$group_id.'">'.$post['group_name'].'</a></li>';
                    $return['isGroupAdd'] = !$group->num_rows();
				break; 

			}

			echo json_encode($return);

		}

	}

	public function add_menu()

	{

		$this->load->database();

		$post = $this->input->post();

		$chk = $this->db->get_where('menu',array('admin_id'=>CLIENT_ID,'label'=>$post['label']))->num_rows();

		$arr['status'] = 0;

		

		if(!$chk){

			$this->db->query("INSERT INTO `".PREFIX."_menu` (`id`, `label`, `link`, `parent`, `sort`, `admin_id` , group_id) VALUES (NULL, '".$post['label']."', '".$post['link']."', '0', '0', '".CLIENT_ID."' , '".$post['group_id']."')");
			

			$arr['menu'] = '<li class="dd-item dd3-item" data-id="'.$this->db->insert_id().'" >

			                    <div class="dd-handle dd3-handle"></div>

			                    <div class="dd3-content"><span id="label_show'.$this->db->insert_id().'">'.$post['label'].'</span>

			                        <span class="span-right">/<span id="link_show'.$this->db->insert_id().'">'.$post['link'].'</span> &nbsp;&nbsp; 

			                        	<a class="edit-button" id="'.$this->db->insert_id().'" label="'.$post['label'].'" link="'.$post['link'].'" ><i class="fa fa-pencil"></i></a>

		                           		<a class="del-button" id="'.$this->db->insert_id().'"><i class="fa fa-trash"></i></a>

			                        </span> 

			                    </div></li>';

			$arr['status'] = 1;

		}

		echo json_encode($arr);

	}

	public function save_menu()

	{

		$this->load->database();
		$post = $this->input->post();
		
		$icons = [];
        foreach(explode(":::",$post['icon']) as $icon){
        	if(!empty($icon)){
        	    
              $ic = explode('|||',$icon);
              $icons[ str_replace('icon_','',$ic[0]) ] = $ic[1];
              
            }
        }
		
        $group = $this->MenuModel->get_menu_groups(['id'=>$post['group_id']]);
                    
        $group_id = $group->num_rows() ? $post['group_id'] : $this->MenuModel->install_menu_group($post['group_name'],false)->id;
        
		$data = json_decode($_POST['data']);
		
		$this->MenuModel->updateMenuGroup($group_id,['name'=>$post['group_name'],'isPrimary'=>$post['isPrimary'] , 'isSecondary' => $post['isSecondary']]);

		$readbleArray = $this->parseJsonArray($data);

		$i=0;

		foreach($readbleArray as $row){

		  $i++;

			$this->db->query("update ".PREFIX."_menu set parent = '".$row['parentID']."', icon = '".$icons[$row['id']]."', sort = '".$i."' where id = '".$row['id']."' AND admin_id = '".CLIENT_ID."'");

		}
		    $return['status']=1;
		    $return['icons'] = $icons;
                    $return['group_id'] = $group_id;
                    $return['group_name'] = $post['group_name'];
                    $return['li'] = '<li class="nav-item"><a data-toggle="tab" href="#print-menu-'.time().'" onclick="print_menu('.$group_id.')" class="nav-link print-menu-'.$group_id.'">'.$post['group_name'].'</a></li>';
                    $return['isGroupAdd'] = !$group->num_rows();
        echo json_encode($return);
    

	}

	function parseJsonArray($jsonArray, $parentID = 0) {



		  $return = array();

		  foreach ($jsonArray as $subArray) {

		    $returnSubSubArray = array();

		    if (isset($subArray->children)) {

		 		$returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id);

		    }



		    $return[] = array('id' => $subArray->id, 'parentID' => $parentID);

		    $return = array_merge($return, $returnSubSubArray);

		  }

		  return $return; 

	}

	public function delete_menu() 

	{

		$this->recursiveDelete($_POST['id']);

	}

	function recursiveDelete($id) {

				$this->load->database();

			    $query = $this->db->query("select * from ".PREFIX."_menu where parent = '".$id."' AND admin_id='".CLIENT_ID."'");

			    if ($query->num_rows()>0) {

			       foreach($query->result() as $j => $current) {

			            $this->recursiveDelete($current->id);

			       }

			    }

			    $this->db->query("delete from ".PREFIX."_menu where id = '".$id."' AND admin_id='".CLIENT_ID."'");

	}
	public function add_widget()
	{
	    $post = $this->input->post();
		if($post)
		{	
		    switch($post['status']){
		        
		        case 'add_widget_from':
		        	// echo'hello chek'; 
		        	// print_r($post);
		        	//exit();
		        	if(!isset($post['widget_title']))
		        		$post['widget_title']="";

		        	$metaData=array();
		        	foreach ($post as $key => $value) 
		        	{
		        		if(!in_array($key, array('widget_type','widget_title','widget_data','status')))
		        			$metaData[$key]=$value;
		        	}

		            // $metaData = array('height'=>$post['height'],'srcoll'=>$post['srcoll']);
		            $data = array('widget_type'=>$post['widget_type'],'widget_title'=>$post['widget_title'],'widget_metadata'=>json_encode($metaData),'admin_id'=>CLIENT_ID);
		            $this->WidgetModel->insertWidget($data);
		            echo 1;
		        break;
		        case 'printFormFields':
		             echo '<div class="card">
		                     <div class="card-header">
		                        <h5>Imfortant Fields</h5>
		                     </div>
		                     <div class="card-body">';
		                     
		                     if(in_array($post['type'],['newsSlider','titleNewsList','thumbnailNewsList'])){
		                         ?>
    		                         <div class="form-group">
            		                     <label><input type="checkbox" name="hide_title" class="form-control">  Hide Title</label>
            		                 </div>
        		                <?php
		                     }
		                     echo '
		                       <div id="widget-boxc">
		                        <div class="form-group">
		                            <label>Enter Widget Title</label>
		                            <input type="text" name="widget_title" class="form-control" placeholder="Enter Widget Title" required>
		                        </div>
		                         <div class="form-group">
		                            <label>Widget Color</label>
		                            <input type="color" class="form-control" name="backColor" value="" placeholder="">
		                            
		                        </div>
		                         <div class="form-group">
		                            <label>Widget Text Color</label>
		                            <input type="color" class="form-control" name="textColor" value="" placeholder="">
		                        </div>

		                        <div class="form-group">
		                            <label>Widget Border</label>
		                            <div class="row">
		                            <div class="col-sm-6">
		                            <label>Size</label>
		                           		 <input type="number" class="form-control" name="Bsize" value="1" placeholder="in px">
		                            </div>
		                            <div class="col-sm-6">
		                           		<label>Style</label>
		                           		<select class="form-control" name="Bstyle">

                                            <option value="none" selected="">None</option>

                                            <option value="solid">Solid</option>

                                            <option value="double">Double</option>

                                            <option value="dashed">Dashed</option>

                                            <option value="dotted">Dotted</option>

                                            <option value="groove">Groove</option>

                                            <option value="ridge">Ridge</option>

                                            <option value="inset">Inset</option>
                                            
                                            <option value="outset">Outset</option>
                                            
                                        </select>
		                           			
		                            </div>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                        <div class="row">
			                        <div class="col-md-4">
				                        <label>Font Size</label>
				                        <div class="input-group">
				                          <input type="number" class="form-control" name="Fsize" placeholder="Font Size" value="14" required="">
				                          <div class="input-group-append">
				                            <span class="input-group-text">px</span>
				                          </div>
				                        </div>
				                    </div>
				                    <div class="col-md-4">
				                        <label>Font Style</label>
				                        <select id="font-style-select" class="form-control" data-cur="normal" name="Fstyle"></select>
				                    </div>
				                    <div class="col-md-4">
				                        <label>Font Family</label>
				                       <select id="font-family-select" class="form-control" data-cur="Arial" name="Ffamily"></select>
				                    </div>
				                </div>
				                </div>

			                    <div class="form-group">
			                        <label>Widget Opacity (0% to 100%)</label>
			                        	<input type="number" class="form-control" name="opacity" value="100">
			                    </div>
		                     ';
		              if($post['type']=='informative'){
		                  echo '
		                        <div class="form-group">
		                           <label>Data Scroll</label>
		                           <div class="">
		                              <label>
		                                    <input type="radio" name="scroll" checked value="0"> No
		                              </label>
		                               <label>
		                                    <input type="radio" name="scroll" value="1"> Yes
		                              </label>
		                           </div>
		                        </div>
		                        <div class="form-group">
		                            <label>Widget Height</label>
		                            <input type="number" class="form-control" name="height" value="200" placeholder="Enter Height..">
		                             <p>This height in px.</p>
		                        </div>
		                       
		                        ';
		              }
		              else if($post['type']=='counter'){
		                  echo '';
		              }
		               else if($post['type']=='g_map'){
		                  echo '
		                        <div class="form-group">
		                           <label>Enter Map Link <small>(Get Help)</small></label>
		                                    <input type="text" class="form-control" name="mapCode">		                         
		                              </label>
		                        </div>
		                        
		                       
		                        <div class="form-group">
		                           <label>Height</label>
		                                    <input type="number" class="form-control" name="mapHeight" value="300">		                         
		                              </label>
		                        </div>	                        
		                      ';
		              }
		               else if($post['type']=='quick_form'){
		                  echo '';
		              }
		              else if($post['type']=='fb_page')
		              {
		              		echo'<div class="form-group">
		                           <label>Enter Facebook Page Link <small>(Get Help)</small></label>
		                                    <input type="text" class="form-control" name="fbPageLink">		                         
		                              </label>
		                        </div>
		                        
		                       
		                        <div class="form-group">
		                           <label>Height</label>
		                                    <input type="number" class="form-control" name="height" value="200">		                         
		                              </label>
		                        </div>';
		              }
		              else if($post['type']=='social_links')
		              {
		              		echo'<div class="form-group">
		              				<label>Facebook Link</label>
			              				<div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png" width=""></div>
			                            <input type="text" class="form-control" name="facebook">  
			                            </div>                 
		                            
		                         </div>
		                         <div class="form-group">
		                            <label>Instagram Link</label>
		                            <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-instagram-m.png" width=""></div>
		                            <input type="text" class="form-control" name="instagram">
		                            </div>                   
		                            
		                         </div>
		                         <div class="form-group">
		                           <label>Twitter Link</label>
		                           <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-twitter-m.png" width=""></div>
		                            <input type="text" class="form-control" name="twitter">    
		                            </div>               
		                           
		                         </div>
		                         <div class="form-group">
		                           <label>LinkedIn Link</label>
		                           <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-linkedin-m.png" width=""></div>
		                            <input type="text" class="form-control" name="linkedin"> 
		                            </div>                  
		                          
		                         </div>
		                         <div class="form-group">
		                           <label>Youtube Link</label>
		                           <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-youtube-m.png" width=""></div>
		                            <input type="text" class="form-control" name="youtube"> 
		                            </div>                  
		                           
		                        </div>
		                        <div class="form-group">
		                           <label>Pinterest Link</label>
		                           <div class="input-group"><div class="input-group-prepend"><img src="https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-pinterest-m.png" width=""></div>
		                            <input type="text" class="form-control" name="pinterest"> 
		                            </div>                  
		                           
		                        </div>';
		              }
		              else if($post['type']=='social_links')
		              {
		              	echo '';
		              }
		              else if($post['type']=='text_box')
		              {
		              	echo' <div class="form-group">
		                           <label>Write Info</label>
		                           <textarea id="aryaeditor" name="info"></textarea>
		                        </div>
		                        <div class="form-group">
		                            <label>Widget Height</label>
		                            <input type="number" class="form-control" name="height" value="200" placeholder="Enter Height..">
		                             <p>This height in px.</p>
		                        </div>
		                        <script type="text/javascript" src="'.site_url().'/public/custom/ckeditor.js"> </script>';
		              }
		              else if($post['type']=='menu_widget')
		              {
		                    $className = \C::isNewsPortal() ? 'col-md-6" style="height:300px;overflow-x:hidden' : 'col-md-12';
		              		echo'
		              		    <div class="row" style="margin:0">
		              		
    		              		<div class="form-group '.$className.'">
    		              				<label>Add Pages to Menu</label>';
    		                          
        		              		$pages = $this->SiteModel->list_page();
        		              		if($pages->num_rows())
        		              		{	
        		              			foreach ($pages->result() as $p)
        		              			{
        		              				echo'<p><input type="checkbox" name="pageList[]" value="'.$p->id.'"	> &nbsp; '.$p->page_name.'</p>';
        		              			}
        		              		
        		              		}
    		              		echo'</div>';
    		              		
    		              		if(\C::isNewsPortal()){
    		              		    echo '<div class="form-group '.$className.'">
    		              		            <label>Add Categories to Menu</label>';
    		              		            foreach($this->NewsModel->get_category()->result() as $cat)
    		              		               echo'<p><label><input type="checkbox" name="category[]" value="'.$cat->id.'"	> &nbsp; '.$cat->name.'</label></p>';
    		              		    echo '</div>
    		              		          
    		              		          <div class="col-md-12 form-group">
    		              		               <label>Number of Post Show with Category Name</label>
    		              		               <select name="numPost" class="form-control">
    		              		                    <option value="hide">Hide</option>
    		              		                    <option value="show">Show</option>
    		              		               </select> 
    		              		          </div>';
    		              		}
    		              		
    		              	 echo '</div>
		              		 <div class="form-group">
		                            <label>Widget Height</label>
		                            <input type="number" class="form-control" name="height" value="200" placeholder="Enter Height..">
		                             <p>This height in px.</p>
		                    </div>
		              		';
		              }
		              else if($post['type']=='ads')
		              {
		              	echo' <div class="form-group">
		                           <label>Ads Code</label>
		                           <textarea name="ads_code" class="form-control" rows="10"></textarea>
		                        </div>
		                        <div class="form-group">
		                            <label>Widget Height</label>
		                            <input type="number" class="form-control" name="height" value="200" placeholder="Enter Height..">
		                            <p>This height in px.</p>
		                        </div>
		                       ';
		              }


		           	echo'</div>';
		           	
		           	if(in_array($post['type'],['newsSlider','titleNewsList','thumbnailNewsList'])){
		                echo '<div class="form-group">
		                          <label>Select Category</label>
		                          <select required class="form-control" name="category[]" multiple>';
		                                foreach( $this->NewsModel->get_category()->result() as $cat){
		                                    echo '<option value="'.$cat->id.'">'.$cat->name.'</option>';
		                                }
		                  echo    '</select>
		                      </div>
		                      
		                      <div class="form-group">
		                        <label>Number Of Post</label>
		                        <input type="number" name="number_of_post" value="5" class="form-control" required>
		                      </div>
		                      
		                      ';  
		            }
		           	
		           	
		           	
		           	
		            
		           echo '
		              <script>font_select();</script>
		                <div class="card-footer">
		                    <button class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
		                </div>
		              </div></div>
		              <script>
		              
		              function CKupdate(){
						    for ( instance in CKEDITOR.instances )
						        CKEDITOR.instances[instance].updateElement();
						}

		                $(".submit-widget-form").submit(function(event){
		                	CKupdate();

                            event.preventDefault();
                            var e = this;

                            $("#load").show();
                            $.ajax({
                                type:"POST",
                                url:"'.base_url.'/admin/add_widget",
                                data:$(this).serialize()+"&status=add_widget_from",
                                beforeSend:function(){
                                	$(e).find("input,select,button").attr("disabled","disabled");
                                },
                                success:function(res){
                                	//	alert(res);
                                   $("#load").hide();
                                   toastr.success("Add Successfully");
                                    	location.reload();
                                }
                                
                            });
                        });
		              </script>';
		        break;
		        
		        case 'printType':
    			    echo '
    			          <div class="card">
                             <div class="card-header">
                                <h5>Create Widget</h5>
                             </div>
                             <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label>Enter Widget Type</label>
                                                <select class="form-control" name="widget_type" onchange="print_form(this)">
                                                    <option value="">--Select-Type-</option>
                                                    <option value="informative">Informative</option>
                                                    <option value="counter">Counter</option>
                                                    <option value="g_map">Google Map</option>
                                                    <option value="quick_form">Quick Form</option>
                                                    <option value="fb_page">Facebook Page</option>
                                                    <option value="social_links">Social Links</option>
                                                  	<option value="translate">Web Translator</option>
                                                  	<option value="text_box">Text Box</option>
                                                  	<option value="menu_widget">Menu Widget</option>
                                                  	<option value="ads">Google Ads</option>';
                                                    if(THEME_ID == 17){
                                                        echo '  <option value="newsSlider">News Slider</option>
                                                              	<option value="titleNewsList">Title News List</option>
                                                              	<option value="thumbnailNewsList">Thumbnail News List</option>';
                                                    }     	
                                       echo '</select>
                                            </div>
                                        </div>
                             </div>
    			          </div>';
		        break;
		    }
		}
		else
		{
			$pageData['allWidget'] = $this->WidgetModel->getAllWidget();
			$this->load->view('add_widget',$pageData);
		}
	}
	public function use_widget()
	{	if($this->input->post())
		{
			if($_POST['status']=='usewidget')
			{
				$left=array();
				$right=array();
				$i=0;
			
				if($_POST['l']!="")
				{	$l = explode(',', $_POST['l']);
					    foreach ($l as $k => $val)
						{
							if($val!='NULL')
								{
									$x          =   explode('_', $val);
									$left[$i]   =   $x[3];
									$i++;
								}
						}
				}
						
				$i=0;
				
				
				if($_POST['r']!="")
				{
					$r = explode(',', $_POST['r']);
						foreach ($r as $k => $val)
						{
							if($val!='NULL')
								{
									$x              =       explode('_', $val);
									$right[$i]      =       $x[3];
									$i++;
								}
						}
				}
				


				if($_POST['page_id']=='all')
					$this->WidgetModel->removeWidget(array('pos_type'=>'sidebar','admin_id'=>CLIENT_ID));
				else
				{
					$this->WidgetModel->removeWidget(array('pos_type'=>'sidebar','page_id'=>'all','admin_id'=>CLIENT_ID));
					$this->WidgetModel->removeWidget(array('pos_type'=>'sidebar','page_id'=>$_POST['page_id'],'admin_id'=>CLIENT_ID));
				}

				foreach ($left as $key => $value)
				{
					$ar = array(
								'pos_type'=>'sidebar',
								'page_id'=>$_POST['page_id'],
								'widget_id'=>$value,
								'position'=>'left',
								'sequence'=>$key,
								'admin_id'=>CLIENT_ID
					);
					$this->WidgetModel->useWidget($ar);
				}

				foreach ($right as $key => $value)
				{
					$ar = array(
								'pos_type'=>'sidebar',
								'page_id'=>$_POST['page_id'],
								'widget_id'=>$value,
								'position'=>'right',
								'sequence'=>$key,
								'admin_id'=>CLIENT_ID
					);
					$this->WidgetModel->useWidget($ar);
				}
				echo'done';
			}
			if($_POST['status']=='usefooter')
			{
				$footer=array();
				$i=0;
			
				if($_POST['f']!="")
				{	$l = explode(',', $_POST['f']);
					foreach ($l as $k => $val)
						{
							if($val!='NULL')
								{
									$x =explode('_', $val);
									$footer[$i]=$x[3];
									$i++;
								}
						}
				}
				
				$this->load->database();
				$this->db->where(array('pos_type'=>'footer','admin_id'=>CLIENT_ID));
				$this->db->delete('widget_link');

				foreach ($footer as $key => $value)
				{
					$ar = array(
								'pos_type'=>'footer',
								'page_id'=>$_POST['page_id'],
								'widget_id'=>$value,
								'position'=>'',
								'sequence'=>$key,
								'admin_id'=>CLIENT_ID
					);
					$this->WidgetModel->useWidget($ar);
				}
				
			}

		}
		else{

			$data['allWidget'] = $this->WidgetModel->getAllWidget();
			$data['allPage']= $this->SiteModel->list_page();
			$this->load->view('use_widget',$data);
		}
	}
	public function modify_widget($wid)
	{	
		if($this->input->post())
		{	$post= $_POST;
			switch ($post['status']) 
			{
				case 'modify_widget_form':
					
						if(!isset($post['widget_title']))
		        		    $post['widget_title']="";

			        	$metaData=array();
			        	foreach ($post as $key => $value) 
			        	{
			        		if(!in_array($key, array('widget_title','widget_data','status')))
			        			$metaData[$key]=$value;
			        	}

			            // $metaData = array('height'=>$post['height'],'srcoll'=>$post['srcoll']);
			            $data = array('widget_title'=>$post['widget_title'],'widget_metadata'=>json_encode($metaData),'admin_id'=>CLIENT_ID);
			            $this->WidgetModel->updateWidget(AJ_DECODE($wid),$data);
			            echo 1;

				break;
				
				case 'add_widget_data':

						$data = array(
										'widget_id'=>AJ_DECODE($wid),
										'data_title'=>$post['data_title'],
										'data'=>$post['widget_data'],
										'admin_id'=>CLIENT_ID
									);
						 $this->WidgetModel->addWidgetData($data);
						 $this->session->set_flashdata('success',"Data Added Successfully");
						 header('Location:'.site_url('admin/modify_widget/'.$wid));
				break;
				
				default:
					# code...
					break;
			}
		}
		else
		{
			$wid= AJ_DECODE($wid);

			
			$pageData['wData']=$this->WidgetModel->getAllWidget($wid);
			$pageData['widget_data']=$this->WidgetModel->getWidgetData($wid);
			$this->load->view('modify_widget',$pageData);
		}
	}


	public function delete_widget($value)
	{
		$id = AJ_DECODE($value);
		$this->db->where(array('id'=>$id,'admin_id'=>CLIENT_ID))->delete('widget_table');
		$this->db->where(array('widget_id'=>$id,'admin_id'=>CLIENT_ID))->delete('widget_link');
		$this->db->where(array('widget_id'=>$id,'admin_id'=>CLIENT_ID))->delete('widget_data');
		$this->session->set_flashdata('success','Widget Delete Successfully');
		redirect(site_url('admin/add-widget'));
	}

	public function edit_post($postid)
	{
		if($post = $this->input->post())
		{
			$where = array('id'=>AJ_DECODE($postid));
			$data = array('data_title'=>$post['data_title'],'data'=>$post['widget_data']);
			$this->WidgetModel->update($where,$data,'widget_data');
			$this->session->set_flashdata('success',"Saved Successfully");	
			redirect(site_url('admin/edit-post/'.$postid));
		}
		else
		{
			$data['postData'] = $this->WidgetModel->getWidgetCustom(array('id'=>AJ_DECODE($postid),'admin_id'=>CLIENT_ID));
			$this->load->view('edit_post',$data);
		}
		
	}

	public function deletePost()
	{
		if($post  =  $this->input->post())
		{
			$res = $this->WidgetModel->delete(array('id'=>$post['post_id']),'widget_data');
			echo $res;
		}
		
	}

	public function website_setting()
	{
		if($post = $this->input->post())
		{
			$status = $post['status'];
			unset($post['status']);
            // echo '<pre>';
            
            // print_r($post);
            // print_r($_FILES);
            // exit;
			if($status=='footer')
			{		        
			        $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
    		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
    		        $config['max_size'] = '1024'; // max_size in kb
                    $config['max_filename'] = '255';
                    $config['encrypt_name'] = TRUE;
    		        
    		        $is_file = false; $imgName ='';
                    if(!empty($_FILES['imgName']['name'])){  
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('imgName')) {
                            $this->session->set_flashdata('msg','<div class="alert alert-solid-danger">'.$this->upload->display_errors().'</div>');
                            redirect(base_url.'/admin/website-setting');
                        } else {
                            $is_file = true;
                            $imgName = $this->upload->data()['file_name'];
                        }
                    }
                    if($post['is_image'] && $is_file){
    			        $data = array('file_name'=>$imgName,'admin_id'=>CLIENT_ID);
    		            $data['size'] = $_FILES['imgName']['size'];
    		            $this->SiteModel->insert_file_size($data);
    		            $post['imgName'] = $imgName;
                    }
                    if(!$post['is_image'])
                         $post['imgName'] = $imgName;//$post['imgName']=='no-photo.png'?"":$post['imgName'];	
        		    $data=array('element'=>'footer','css'=>json_encode($post),'admin_id'=>CLIENT_ID);
        			$this->ThemeModel->setCustomCss( $data );
        			$this->session->set_flashdata('msg','<div class="alert alert-solid-success">Footer Setting Update Successfully.</div>');
    		        redirect(base_url.'/admin/website-setting');
			    
				
			}
			else if($status=='site')
			{
				$data=array('element'=>'site','css'=>json_encode($post),'admin_id'=>CLIENT_ID);
				$this->ThemeModel->setCustomCss($data);
			}
			else if($status=='general')
			{
				$menucolor = $post['menu_bar_color'];
				unset($post['menu_bar_color']);
				

				$post['admin_id']=CLIENT_ID;
/*
				if($post['logo']=='no-photo.png')
					$post['logo']="";
*/				
				if($post['contact'])
				    $post['contact'] = json_encode(explode(',',$post['contact']));
				    
				if($post['email'])
				    $post['email'] = json_encode(explode(',',$post['email']));
				

			//	print_r($post);
				
				$this->SiteModel->websiteData($post);
                unset($post['theme_color']);
				$this->db->where('admin_id',CLIENT_ID)->update('menu_css',array('menubar_color'=>$menucolor));
				// $this->db->where('admin_id',CLIENT_ID)->
			}
			else if($status=='other')
			{
				$data = json_encode($post);
				$this->db->set('other',$data)->where('admin_id',CLIENT_ID)->update('website_data');
			}
			else if($status == 'logo_style'){
			    unset($_POST['status']);
			    $this->db->set('logo_style',json_encode($_POST))->where('admin_id',CLIENT_ID)->update('website_data');	
			    $this->session->set_flashdata('msg','<div class="alert alert-solid-success">Logo Style Update Successfully.</div>');
    		            redirect(base_url.'/admin/website-setting');
			}
			else if($status=='logo'){
			    
			    if(!empty($_FILES['logo']['name'])){
			        
			        $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
    		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
    		        $config['max_size'] = '1024'; // max_size in kb
                    $config['max_filename'] = '255';
                    $config['encrypt_name'] = TRUE;
    		        
    		        $is_file = false; $logo ='';
                        
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('logo')) {
                        $this->session->set_flashdata('msg','<div class="alert alert-solid-danger">'.$this->upload->display_errors().'</div>');
                        redirect(base_url.'/admin/website-setting');
                    } else {
                        $is_file = true;
                        $logo = $this->upload->data()['file_name'];
                    }
                    if($is_file){
                        $this->db->set('logo',$logo)->where('admin_id',CLIENT_ID)->update('website_data');		
    			        $data = array('file_name'=>$logo,'admin_id'=>CLIENT_ID);
    		            $data['size'] = $_FILES['logo']['size'];
    		            $this->SiteModel->insert_file_size($data);
    		            $this->session->set_flashdata('msg','<div class="alert alert-solid-success">Logo Update Successfully.</div>');
    		            redirect(base_url.'/admin/website-setting');
                    }
			    }
			    
			}
			else if($status=='secondary_logo'){
			    if(!empty($_FILES['logo']['name'])){
			        
			        $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
    		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
    		        $config['max_size'] = '1024'; // max_size in kb
                    $config['max_filename'] = '255';
                    $config['encrypt_name'] = TRUE;
    		        
    		        $is_file = false; $logo ='';
                        
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('logo')) {
                        $this->session->set_flashdata('msg','<div class="alert alert-solid-danger">'.$this->upload->display_errors().'</div>');
                        redirect(base_url.'/admin/website-setting');
                    } else {
                        $is_file = true;
                        $logo = $this->upload->data()['file_name'];
                    }
                    if($is_file){
                        $this->db->set('secondary_logo',$logo)->where('admin_id',CLIENT_ID)->update('website_data');		
    			        $data = array('file_name'=>$logo,'admin_id'=>CLIENT_ID);
    		            $data['size'] = $_FILES['logo']['size'];
    		            $this->SiteModel->insert_file_size($data);
    		            $this->session->set_flashdata('msg','<div class="alert alert-solid-success">Secondary Logo Updated Successfully.</div>');
    		            redirect(base_url.'/admin/website-setting');
                    }
			    }
			    else
			    {
			   		$this->session->set_flashdata('msg','<div class="alert alert-solid-danger">Please Choose a file.</div>');
			   		echo'choose file';
    		            //redirect(base_url.'/admin/website-setting');
			    }
			    
			}
			else if($status=='favicon'){
			    if(!empty($_FILES['favicon']['name'])){
			        
			         $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
    		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
    		        $config['max_size'] = '1024'; // max_size in kb
                    $config['max_filename'] = '255';
                    $config['encrypt_name'] = TRUE;
    		        
    		        $is_file = false; $favicon ='';
                        
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('favicon')) {
                        $this->session->set_flashdata('msg','<div class="alert alert-solid-danger">'.$this->upload->display_errors().'</div>');
                        redirect(base_url.'/admin/website-setting');
                    } else {
                        $is_file = true;
                        $favicon = $this->upload->data()['file_name'];
                    }
                    if($is_file){
                        $this->db->set('favicon',$favicon)->where('admin_id',CLIENT_ID)->update('website_data');		
    			        $data = array('file_name'=>$favicon,'admin_id'=>CLIENT_ID);
    		            $data['size'] = $_FILES['favicon']['size'];
    		            $this->SiteModel->insert_file_size($data);
    		            $this->session->set_flashdata('msg','<div class="alert alert-solid-success">Favicon Update Successfully.</div>');
    		            redirect(base_url.'/admin/website-setting');
                    }
			    }
			    
			}
			else if($status == 'front'){
			    
			    $data['box_layout'] = isset($post['box_layout']) ? 'ok' : '';
			    $type = $post['type'];
			    $data['type'] = $type;
			    if($type == 'bg_color')
			       $data['value'] = $post['bg_color'];
			    if($type == 'bg_image')
			       $data['value'] = $this->file_up('bg_image');
			       
			   $this->SiteModel->websiteData(['box_layout'=>json_encode($data)]);
			   $this->session->set_flashdata('success','Front Setting Update Successfully.');
    		   redirect(base_url.'/admin/website-setting');
			}
			
		}
		else
		{
			$this->load->view('websitesetting');
		}
		
	}

	public function add_carousel()
	{
		if($post =$this->input->post())
		{
		    $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['imgs']['name']);
          
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['imgs']['name']= $files['imgs']['name'][$i];
                $_FILES['imgs']['type']= $files['imgs']['type'][$i];
                $_FILES['imgs']['tmp_name']= $files['imgs']['tmp_name'][$i];
                $_FILES['imgs']['error']= $files['imgs']['error'][$i];
                $_FILES['imgs']['size']= $files['imgs']['size'][$i];    
                
                
                $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['encrypt_name'] = TRUE;
              
              
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
    
                if($this->upload->do_upload('imgs')){
                    
                    $imageData = $this->upload->data();
                    $dataInfo[$i] = base_url.'/public/temp/'.CLIENT_ID.'/'.$imageData['file_name'];
                     $this->SiteModel->insert_file_size(array('file_name'=>$imageData['file_name'],'size'=>$_FILES['imgs']['size']));
    
                }
            }
		    
			$details = json_encode(array('perSlide'=>$post['per_slide'],'speed'=>$post['speed'],'height'=>$post['height']));

			$data = array('name'=>$post['carousel_name'],
							'images'=>count($dataInfo)?json_encode($dataInfo):'',
							'details'=>$details,
							'admin_id'=>CLIENT_ID
			);
			$this->SiteModel->addCarousel($data);
			$this->session->set_flashdata('success','Carousel Added Successfully');
			redirect(site_url('admin/add_carousel'));
		}
		else
		$this->load->view('add_carousel');
	}

	public function delete_carousel()
	{
		if($post=$this->input->post())
		{
			$this->db->where(array('id'=>$post['carid'],'admin_id'=>CLIENT_ID))->delete('carousel');
			$this->db->where(array('car_id'=>$post['carid'],'admin_id'=>CLIENT_ID))->delete('carousel_link');

			$this->db->where(array('key_id'=>$post['carid'],'type'=>'slider','admin_id'=>CLIENT_ID))->delete('web_schema');
			//echo $post['carid'];
		}
	}


	public function edit_carousel($carid)
	{
		if($post = $this->input->post())
		{
		    
		    $car = $this->SiteModel->getCarousel(array('id'=>AJ_DECODE($carid)))->row();
		 
		    $t=0;
		    $images = array();
		   if($car->images)
	       {	
	           			foreach (json_decode($car->images) as $img)
		           		{
		           		    if(isset($post['imgs'])){
		           		        
    		           		    if(in_array($img,$post['imgs']))
    		           		        $images[$t++] = $img;
    		           		    else{
    		           		        $del_file = explode('/',$img)[6];
    		           		        if(file_exists('public/temp/'.CLIENT_ID.'/'.$del_file))
    		           		            $this->SiteModel->delete_usespace(array('file_name'=>$del_file));
    		           		        
    		           		    }
    		           		    
		           		    }
		           		}
	       }
	       $files = $_FILES;
           $cpt = count($_FILES['imgs']['name']);
          
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['imgs']['name']= $files['imgs']['name'][$i];
                $_FILES['imgs']['type']= $files['imgs']['type'][$i];
                $_FILES['imgs']['tmp_name']= $files['imgs']['tmp_name'][$i];
                $_FILES['imgs']['error']= $files['imgs']['error'][$i];
                $_FILES['imgs']['size']= $files['imgs']['size'][$i];    
                
                
                $config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['encrypt_name'] = TRUE;
              
              
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
    
                if($this->upload->do_upload('imgs')){
                    
                    $imageData = $this->upload->data();
                    $images[$t++] = base_url.'/public/temp/'.CLIENT_ID.'/'.$imageData['file_name'];
                     $this->SiteModel->insert_file_size(array('file_name'=>$imageData['file_name'],'size'=>$_FILES['imgs']['size']));
    
                }
            }
			$details = json_encode(array('perSlide'=>$post['per_slide'],'speed'=>$post['speed'],'height'=>$post['height']));

			$data = array('name'=>$post['carousel_name'],
							'images'=>count($images)?json_encode($images):'',
							'details'=>$details,
							'admin_id'=>CLIENT_ID
			);
			$this->SiteModel->updateCarousel(array('id'=>AJ_DECODE($carid)),$data);
			$this->session->set_flashdata('success','Carousel Updated Successfully');
			redirect(site_url('admin/add_carousel'));

		}
		else
		{
			$this->load->view('edit_carousel',['carid'=>AJ_DECODE($carid)]);
		}
	}

	public function use_carousel()
	{	
		if($post= $this->input->post())
		{
			if($post['status']=='usecarousel')
			{

					$data=  array('car_id'=>$post['carid'],
							'page_id'=>$post['pageid']
					);
					$this->SiteModel->useCarousel($data);
			}
		}
		else
		{
			$this->load->view('use_carousel');
		}
	}

	public function add_form()
	{
		if($post = $this->input->post())
		{
		    $post['fields'] = json_encode($_POST['fields']);
		    $post['btn'] = $_POST['btn'];
			$post+=array('admin_id'=>CLIENT_ID);
			$this->FormModel->addForm($post); 
			echo 'done';//json_encode($post);  
			
		}
		else
		$this->load->view('add_form');
	}

	function sms_panel(){
	    $data = $this->SmsModel->createSMSPanel();
	    if($post = $this->input->post()){
	        $this->SmsModel->update($post);
	        $this->session->set_flashdata('success','SMS API Details Update Successfully...');
	        redirect(base_url.'/admin/sms-panel');
	    }
	    else
	        $this->load->view('header')->load->view('sms/panel',$data)->load->view('footer');
	}

	function form_setting($form_id = 0,$type = 'sms', $type1 = 'setting', $id = 0){
	    
	    if($post = $this->input->post()){
	        if($type == 'setting'){
	            $sms = isset($post['sms']) ? 1 : 0;
	            $email = isset($post['email']) ? 1: 0;
	            $url = isset($post['redirect']) ? $post['redirect_link'] : '';
	            $this->db->where('id',AJ_DECODE($form_id))->update('form_model',['sms'=>$sms,'email'=>$email,'url'=>$url]);
	        }
	        else{
    	        $data   =['form_id'=>AJ_DECODE($form_id),'type' => $type,'send_by' => json_encode($post['key']),'message'    => $_POST['content'],'admin_id' => CLIENT_ID];
    	        if($type == 'email'){
    	            $data['from_email'] = $post['from_email'];
    	            $data['subject']    = $post['system_name'];
    	            $data['email_title']    =   $post['subject'];
    	        }
    	        $this->SmsModel->addMessage($data);
	        }
	        redirect(current_url());
	    }
	    else{
            if($type == 'Preview-and-design'){

                

                $this->load->view('sms/'.$type, ['form_id'=>$form_id, 'type'=>$type,'id'=>$id]);
            }   
            else
	        $this->load->view(__FUNCTION__ , [ 'form_id' => $form_id, 'type' => $type , 'system_type' => $type1, 'id' => $id ] );
        }
	    
	}

	public function use_form()
	{
		if($post= $this->input->post())
		{
			if($post['status']=='useform')
			{

					$data=  array('form_id'=>$post['formid'],
							'page_id'=>$post['pageid']
					);
					$this->FormModel->useForm($data);
			}
		}
		else
		{
			$this->load->view('use_form');
		}
	}
	
	function use_content(){
	    if($post= $this->input->post())
		{
			if($post['status']=='usecontent')
			{

					$data=  array('key_id'=>$post['contentId'],
        						  'page_id'=>$post['pageid'],
        						  'type' => 'content_category',
        						  'admin_id' => CLIENT_ID
					);
					
					if($this->db->where($data)->get('web_schema')->num_rows())
            		{
            			$this->db->where($data)->delete('web_schema');
            		}
            		else
            		{
            			$this->db->insert('web_schema',$data);
            		}
            		echo json_encode(['status'=>true]);
			}
		}
	}

	public function form_data()
	{
	
		if($post = $this->input->post())
		{
			$da = $this->FormModel->getFormData(array('form_id'=>$post['fid']));
			if($da->num_rows())
			{
				echo'
				<div class="col-md-12">
				    <a href="'.base_url.'/admin/extract-from-data/'.AJ_ENCODE($post['fid']).'" class="btn btn-success btn-xs pull-right "><i class="fa fa-file-archive"></i> Extract Data</a>
				</div>
				
				<div style="margin-top:50px">
				<table class="mb-0 table table-striped table-bordered table-sm">
				        <tr><th>#</th><th>Time</th><th>View</th><th>Action</th></tr>';
				$i=1;
				foreach ($da->result() as $r){
					echo '<tr><td>'.$i++.'</td><td>'.date('d-M-y @ h:i A',strtotime($r->timestamp)).'</td><td><a href="'.site_url('admin/form-data/').AJ_ENCODE($r->id).'"><i class="fa fa-eye"></i></a></td><td><button class="btn btn-danger" onclick="deleteData(this)" data-id="'.AJ_ENCODE($r->id).'"><i class="fa fa-trash"></i> Delete</button></td></tr>';
				}
				echo'</table></div>';
			}
			else
			{
				echo'<div class="alert alert-danger">No Data To show</div>'; 
			}
		}
		else
		$this->load->view('form_data');
	}

    function extract_from_data($id){
        
        $da = $this->FormModel->getFormData( [ 'form_id' => AJ_DECODE($id) ] );
        $ddddd = $this->FormModel->getFormModel(array( 'id'=> AJ_DECODE($id) , 'admin_id' => CLIENT_ID ) )->row();
        $data['num'] = $da->num_rows();
        $data['data'] = $da->result_array();
        $data['struct'] = $ddddd->fields;
        $data['form_title'] = $ddddd->title;
        
        $this->load->view('extract-form-data',$data);
        
    }

	public function form_data_by_id($id)
	{
		$data = $this->FormModel->getFormData(array('id'=>AJ_DECODE($id),'admin_id'=>CLIENT_ID));
		$this->load->view('view_form_data',['data'=>$data]);
	}

	public function edit_form($fid)
	{

		$fservice = $this->db->where(array('formid'=>AJ_DECODE($fid),'admin_id'=>CLIENT_ID))->get('file_service');


		if($fservice->num_rows())
		{
				$data = $fservice->row();
				$this->session->set_flashdata('error','Unable to Edit!<br><small> This form is Used in File Service [<b>'.$data->service_name.'</b>]</small>');
			redirect(site_url('admin/add-form'));
			exit();
		}


		if($post=$this->input->post())
		{
		    $post['fields'] = json_encode($_POST['fields']);
		    $post['btn'] = $_POST['btn'];
			$this->FormModel->editForm(array('id'=>AJ_DECODE($fid),'admin_id'=>CLIENT_ID),$post);
			//echo 'done';
			print_r($post);
		}
		else
		{
			$form = $this->FormModel->getFormModel(array('id'=>AJ_DECODE($fid),'admin_id'=>CLIENT_ID));
			$this->load->view('edit_form',['form'=>$form]);
		}
		
	}

	public function deleteForm($fid)
	{
		$fid = AJ_DECODE($fid);

		$fservice = $this->db->where(array('formid'=>$fid,'admin_id'=>CLIENT_ID))->get('file_service');
		$tform = $this->db->where(array('form_model_id'=>$fid,'admin_id'=>CLIENT_ID))->get('transaction_form');


		if($fservice->num_rows() || $tform->num_rows())
		{
			if($fservice->num_rows())
			{
				$data = $fservice->row();
				$this->session->set_flashdata('error','Unable to Delete!<br><small> This form is Used in File Service [<b>'.$data->service_name.'</b>]</small>');
			}

			if($tform->num_rows())
			{
				$data = $tform->row();
				$this->session->set_flashdata('error','Unable to Delete!<br><small> This form is Used in Transaction Form [<b>'.$data->tform_name.'</b>]</small>');
			}
			redirect(site_url('admin/add-form'));
			exit();
		}

		$this->FormModel->deleteForm(array('id'=>$fid,'admin_id'=>CLIENT_ID));
		$this->FormModel->deleteFormLink(array('form_id'=>$fid,'admin_id'=>CLIENT_ID));

		$this->db->where(array('key_id'=>$fid,'type'=>'form','admin_id'=>CLIENT_ID))->delete('web_schema');
		redirect(site_url("admin/add-form"));
	}

	public function delete_form_data()
	{
		if($post =$this->input->post())
		{
			$this->db->where(array('id'=>AJ_DECODE($post['id']),'admin_id'=>CLIENT_ID))->delete('form_data');
			echo'done';
		}
		
	}

	public function add_payment_method( $type = '')
	{
		if($post = $this->input->post())
		{
		    if($type != ''){
		        $data = array('method'=>strtolower($type),'key1'=>filter_var($post['key1'],FILTER_SANITIZE_STRING),'key2'=>filter_var($post['key2'],FILTER_SANITIZE_STRING),'admin_id'=>CLIENT_ID);
		        if($this->PaymentModel->addPaymentMethod($data))
					$this->session->set_flashdata('success','Process Complete Successfully.');
				else
					$this->session->set_flashdata('error','Method Already in use.');
		    }
		    
		    
		    
		    /*
			if($post['action']=='add')
			{
				switch($post['method']){
					case 'paytm':
    					$msg = 'Payment Method Added.';
					break;
					
					case 'payumoney':
					    $msg = 'Payment Method Added.';
					break;
				}
				
				$mid  = $post['mid'];
    			$mkey = $post['mkey'];
    			$data = array('method'=>$post['method'],'key1'=>$mid,'key2'=>$mkey,'admin_id'=>CLIENT_ID);
    			
				if($this->PaymentModel->addPaymentMethod($data))
					$this->session->set_flashdata('success',$msg);
				else
					$this->session->set_flashdata('error','Method Already in use.');
			}
			else if($post['action']=='remove')
			{
			    $this->PaymentModel->removeMethod(array('method'=>$post['method']));
			    $this->session->set_flashdata('success','Payment Method Deleted');
			}*/
			
			
			redirect(site_url('admin/add-payment-method'));
		}
		else
		{
			$this->load->view('add_payment_method');
		}
	}

	public function create_transaction_form()
	{
		if($post = $this->input->post())
		{  $t = true;
		    if(isset($post['status'])){
		        if($post['status'] == 'delete-transaction-form'){
		            $this->FormModel->delete_transform(['admin_id'=>CLIENT_ID,'id'=>$post['id']]);
		            $this->db->where(['admin_id'=>CLIENT_ID,'type'=>'tform','key_id'=>$post['id']])->delete('web_schema');
		        }
		        echo json_encode(['status'=>true]);
		    }
		    else{
    		    if(is_array($post['methodid']) ){
    		        if(count($post['methodid']) <= 0){
    		          $this->session->set_flashdata('error','Select payment method.');
    		          $t = false;
    		        }
    		        
    		    }
    		    if($t){
        			$data = array('form_model_id'=>$post['formid'],
        							'payment_method_id'=>is_array($post['methodid'])?json_encode($_POST['methodid']):$post['methodid'],
        							'min_amount'=>$post['minamount'],
        							'amount'=>$post['fixamount'],
        							'tform_name'=>$post['tformname'],
        							'admin_id'=>CLIENT_ID,
        			);
        			$this->FormModel->addTransactionForm($data);
        			$this->session->set_flashdata('success','Transaction Form Created');
    		    }
    		      
    			redirect(site_url('admin/create-transaction-form'));
		    }
			/*
			 $data = array('form_model_id'=>$post['formid'],
    							'payment_method_id'=>is_array($post['methodid'])?json_encode($post['methodid']):$post['methodid'],
    							'min_amount'=>$post['minamount'],
    							'amount'=>$post['fixamount'],
    							'tform_name'=>$post['tformname'],
    							'admin_id'=>CLIENT_ID,
    			);
    			$this->FormModel->addTransactionForm($data);
    			$this->session->set_flashdata('success','Transaction Form Created');
    		
    			redirect(site_url('admin/create-transaction-form'));	*/
		}
		else
		{
			$this->load->view('create_transaction_form');
		}
	}

    public function test1(){
        // echo 'gg';
        echo Modules :: run('template/themeView','form',['id' => 110]);//,['key' => 2296]);
        
        // echo Modules :: run('payment/test');//,['key' => 2296]);
        // $this->load->module('Template');
        // echo '<pre>';
        // print_r($this->Template);
        // echo $this->template->form(['key' => 2296]);
       /*
        // $URL = 'http://shreeshanidev.in/';
        
        // if(C::isSiteAvailible($URL)){
        //     echo 'The website is available.';      
        // }else{
        //   echo 'Woops, the site is not found.'; 
        // }
        // echo ;exit;
        getContnetModels();
        if(file_exists('public/theme/'.FileDirecory.'/index.html')){
            exit('Yes');
        }
        echo '<pre>';
        $html = file_get_contents('public/theme/'.FileDirecory.'/index.html');
        $links = [];
        $document = new DOMDocument;
        $document ->loadHTML($html);
        $links = $document->getElementsByTagName('link');

        //Array that will contain our extracted links.
        $extractedLinks = array();
        
        foreach($links as $link){
        
            //Get the link in the href attribute.
            $linkHref = $link->getAttribute('href');
        
            //If the link is empty, skip it and don't
            //add it to our $extractedLinks array
            if(strlen(trim($linkHref)) == 0){
                continue;
            }
        
            //Skip if it is a hashtag / anchor link.
            if($linkHref[0] == '#'){
                continue;
            }
        
            //Add the link to our $extractedLinks array.
            $extractedLinks[] = array(
                'href' => $linkHref
            );
        
        }
        print_r($extractedLinks);
        */
    }

	public function use_transaction_form()
	{
		if($post= $this->input->post())
		{
			if($post['status']=='usetransactionform')
			{

					$data=  array('form_id'=>$post['formid'],
							'page_id'=>$post['pageid'],
					);
					$this->FormModel->useTransactionForm($data);
			}
		}
		else
		{
			$this->load->view('use_transaction_form');
		}
	}


	public function transaction_form_data()
	{
		
		if($post = $this->input->post())
		{
			$id = AJ_DECODE($post['tfid']);
			$da = $this->FormModel->getTransactionView(array('tform_id'=>$id));
			if($da->num_rows())
			{
				echo'<table class="mb-0 table table-striped">
				<tr><th>Init Time</th><th>Order Id<br><small>Click Order id for Details</small></th><th>Type</th><th>Req Amount</th><th>Final Amount</th><th>Final Status</th></tr>';
				$i=1;
				foreach ($da->result() as $r) 
				{	
					if($r->status=='init')
					{
						$c = 'bg-info text-white';
						$t = '<i class="fa fa-clock"></i> New';
						$f = '---';
					}
					else if($r->status=='complete')
					{	$c='';
					    
						if($r->fstatus=='TXN_SUCCESS' || $r->fstatus=='success')
						{
							$c='bg-success text-white';
							$f='<i class="fa fa-check-circle"></i> Success ';
						}
						else if($r->fstatus=='PENDING' || $r->fstatus=='pending')
						{
							$c='bg-warning text-white';
							$f='<i class="fa fa-exclamation-circle"></i> Pending ';
						}
						else if($r->fstatus=='TXN_FAILURE' || $r->fstatus=='failure')
						{
							$c='bg-danger text-white';
							$f='<i class="fa fa-times-circle"></i> Failed ';
						}

						$t = '<i class="fa fa-check"></i> Complete';
					}
					
					echo'<tr class="'.$c.'">
					        <td>'.date('d-M-y @ h:i A',strtotime($r->timestamp)).'</td>
					        <td><a data-id="'.AJ_ENCODE($r->order_id).'" onclick="rqst_status(this)" style="cursor:pointer">'.$r->order_id.'</a></td>
					        <td>'.$t.'</td>
					        <td>'.$r->txn_amount.'</td>
					        <td>'.$r->famount.' </td><td>'.$f.'</td>
					    </tr>';
				}
				echo'</table>';
			}
			else
			{
				echo'<div class="alert alert-danger">No Data To show</div>';
			}
		}
		else
		$this->load->view('transaction_form_data');
	}
	
	public function transaction_status($orderid)
	{
		$oid = AJ_DECODE($orderid);
		$data = $this->FormModel->getTransactionView(array('order_id'=>$oid));
		if($data->num_rows())
		{
			$data = $data->row();
			echo'<html>
				<head><title>Transaction Status for [ '.$oid.' ]</title>
				<!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
				</head>
				<body style="padding:15px;">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-3" align="center">
							Transaction Request
								<br> Date : '.date('d M, Y',strtotime($data->timestamp)).'
								<br> Time : '.date('h:i:s A',strtotime($data->timestamp)).'
							</div>
							<div class="col-xs-6" align="center">
								<h3>'.$oid.'</h3>
							</div>
							<div class="col-xs-3" align="center">
								Transaction Complete
								<br> Date : '.($data->fstamp!=NULL?date('d M, Y',strtotime($data->fstamp)):"").'
								<br> Time : '.($data->fstamp!=NULL?date('h:i:s A',strtotime($data->fstamp)):"").'
							</div>
						</div>
						<hr>
						<div class="row" align="center">
						';
						if($data->fstatus=='TXN_SUCCESS')
						{
							echo '<div class="alert alert-success"><h2><center><i class="fa fa-check-square-o"></i> Transaction Successful</center></h2></div>';
						}
						else if($data->fstatus=='PENDING')
						{
							echo '<div class="alert alert-warning"><h2><center><i class="fa fa-exclamation-circle"></i> Transaction Status Pending</center></h2></div>';
						}
						else if($data->fstatus=='TXN_FAILURE')
						{	
							echo '<div class="alert alert-danger"><h2><center><i class="fa fa-times-circle"></i> Transaction Failed</center></h2></div>';
						}
						else
						{
							echo '<div class="alert alert-info"><h4><center><i class="fa fa-clock-o"></i> Transaction Newly Created. Please Wait for Response</center></h4></div>';
						}


						echo'</div>';

						if($data->status=='complete')
						{
							echo'<div class="row">
							<table class="table table-responsive table-bordered table-striped table-hover">
							<tr><th colspan="2" style="text-align:center">Transaction Details</th></tr>
							<tr><th>Transaction Id</th><td>'.$data->txn_id.'</td></tr>
							<tr><th>Order Id</th><td>'.$data->order_id.'</td></tr>
							<tr><th>Customer Id</th><td>'.$data->customer_id.'</td></tr>
							<tr><th>Amount</th><td>'.$data->famount.'</td></tr>
							<tr><th>Currency</th><td>'.$data->currency.'</td></tr>
							<tr><th>Response Message</th><td>'.$data->resp_msg.'</td></tr>
							<tr><th>Bank Transaction Id</th><td>'.$data->bank_txn_id.'</td></tr>
							</table></div>';

					}
						


						echo'<div class="row">';

						$d = $data->tform_data;

						if($d)
						{
							echo'<table class="table table-responsive table-bordered table-striped table-hover">
							<tr><th colspan="2" style="text-align:center">Form data</th></tr>
							';
							foreach (json_decode($d) as $key => $value)
							{

								echo'<tr><th>'.$key.'</th><td>'.(isJson($value)?implode(' , ',(array)json_decode($value)):$value).'</td></tr>';
							}
							echo'</table>';
						}

						echo'</div>';


						echo'</div>

						<br><br>
						<p align="center" id="cbox" onclick="p()"><button class="btn btn-primary"><i class="fa fa-print"></i> Print</button></p>
				</div>
				</body>
			</html>
			<script>
			function p()
			{
				var c = document.getElementById("cbox");
				c.style.display="none";
				window.print();
				c.style.display="block";
			}
			</script>
			';
		}
	}

	public function add_popup()
	{
		if($post  = $this->input->post())
		{
			if($post['page_id']=='all')
			{
				$this->db->where(array('admin_id'=>CLIENT_ID))->delete('popup');
			}
			else
			{

				$this->db->where(array('page_id'=>'all','admin_id'=>CLIENT_ID))->delete('popup');
				$this->db->where(array('page_id'=>$post['page_id'],'admin_id'=>CLIENT_ID))->delete('popup');
			}

			$key = $post['type']=='data'?'content':'form_id';
			$val = $post['type']=='data'?'data':'form_id';
			$data = array('type'=>$post['type'],'page_id'=>$post['page_id'],$key=>$post[$val],'details'=>json_encode(array('height'=>$post['height'],'width'=>$post['width'],'frq'=>$post['frq'])),'admin_id'=>CLIENT_ID);
			$this->SiteModel->addPopup($data);
			$this->session->set_flashdata('success','Popup Added Successfully');
			redirect(site_url('admin/add-popup'));
		}
		else
		{
			$this->load->view('add_popup');
		}
	}

	public function delete_popup()
	{
		if($post = $this->input->post())
		{	//echo'd';
			$id = AJ_DECODE($post['id']);
			$this->db->where(array('id'=>$id,'admin_id'=>CLIENT_ID))->delete('popup');
		}
	}

	public function arrenge_sidebar_widget()
	{
		if($post = $this->input->post())
		{
			$a = array();
			//$pid = AJ_DECODE($post['pid']);
			$pid  = $post['pid'];
			$res = $this->WidgetModel->widgetLink(array('page_id'=>$pid,'pos_type'=>'sidebar','admin_id'=>CLIENT_ID));
			if($res->num_rows())
			{	$l = 0;
				$r = 0;
				$LEFT = '';
				$RIGHT = '';
				$Lwid = '';
				$Rwid = '';
				foreach ($res->result() as $rec)
				{
					$widget = $this->WidgetModel->getAllWidget($rec->widget_id)->row();

					if($rec->position=='left')
					{
						if($l>0)
							$LEFT.=',';

						$wid = 'L_'.$rec->sequence.'_wid_'.$rec->widget_id;

						$LEFT.=$wid;

						$Lwid.='<div id="'.$wid.'" class="card-shadow-warning border mb-3 card card-body border-warning" draggable="true" ondragstart="pickup(event)" ondragover="override(event)">
						<h5 class="card-title">'.$widget->widget_title.'</h5>
						<div class="mb-2 mr-2 badge badge-danger">'.strtoupper($widget->widget_type).'</div>
					</div>';

						$l++;
					}
					else
					{
						if($r>0)
							$RIGHT.=',';
						
						$wid = 'R_'.$rec->sequence.'_wid_'.$rec->widget_id;

						$RIGHT.=$wid;

						$Rwid.='<div id="'.$wid.'" class="card-shadow-warning border mb-3 card card-body border-warning" draggable="true" ondragstart="pickup(event)" ondragover="override(event)">
						<h5 class="card-title">'.$widget->widget_title.'</h5>
						<div class="mb-2 mr-2 badge badge-danger">'.strtoupper($widget->widget_type).'</div>
					</div>';

						$r++;
					}
				}

				$var = array(
								'ALCount'=>$l,
								'ARCount'=>$r,
								'aLEFT'=>$LEFT,
								'aRIGHT'=>$RIGHT,
								'Lwid'=>$Lwid,
								'Rwid'=>$Rwid,
				);
				echo json_encode($var);
			}
			else
			{
				$var = array(
								'ALCount'=>0,
								'ARCount'=>0,
								'aLEFT'=>'',
								'aRIGHT'=>'',
								'Lwid'=>'',
								'Rwid'=>'',
				);
				echo json_encode($var);

			}

		}
		
	}


	public function arrenge_footer_widget()
	{
		if($post = $this->input->post())
		{
			$a = array();
			//$pid = AJ_DECODE($post['pid']);
			$pid  = 'all';
			$res = $this->WidgetModel->widgetLink(array('page_id'=>$pid,'pos_type'=>'footer','admin_id'=>CLIENT_ID));
			if($res->num_rows())
			{	$footer = 0;
				$FOOTER = '';
				$fwid = '';
				foreach ($res->result() as $rec)
				{
					$widget = $this->WidgetModel->getAllWidget($rec->widget_id)->row();

						if($footer>0)
							$FOOTER.=',';

						$wid = 'F_'.$rec->sequence.'_wid_'.$rec->widget_id;

						$FOOTER.=$wid;

						$fwid.='<div id="'.$wid.'" class="card-shadow-warning border mb-3 card card-body border-warning" draggable="true" ondragstart="pickup(event)" ondragover="override(event)">
						<h5 class="card-title">'.$widget->widget_title.'</h5>
						<div class="mb-2 mr-2 badge badge-danger">'.strtoupper($widget->widget_type).'</div>
					</div>';

						$footer++;
				}

				$var = array(
								'fcount'=>$footer,
								'FOOTER'=>$FOOTER,
								'Fwid'=>$fwid,
				);
				echo json_encode($var);
			}
			else
			{
				$var = array(
								'fcount'=>0,
								'FOOTER'=>'',
								'Fwid'=>'',
				);
				echo json_encode($var);

			}

		}
		
	}

	public function manage_schema()
	{
		if($post = $this->input->post())
		{
			$status = $post['status'];
			unset($post['status']);
			if($status=='load')
			{
				//$this->SiteModel->list_page();
				$list = array('slider'=> 'Slider',
								'igallery'=>'Image Gallery',
								'vgallery'=>'Video Gallery',
								'pgallery'=>'Product Gallery',
								'content'=>'Page Content',
								'form'=>'Form',
								'tform'=>'Transaction Form',
								'fbox'=>'Feature Box',
								'fservice'=> 'File Service',
								'ads'=>'Google Ads',
								'marquee'=>'Marquee',
								'fdgallery' =>'File Download Gallery',
								'rform'     => 'Result Search Form',
								'content_category' => 'Content Category',
								'main_slider'   => 'Main Slider',
								'tab'       =>  'Tab',
								'special_category' => 'News Special Category',
								'newsTicker'    => 'News Ticker'
							);

				$pa = $this->SiteModel->getPageSchema(array('page_id'=>$post['pid']));

					if($pa->num_rows())
					{
						
							foreach($pa->result() as $key)
							{
								switch ($key->type) {
									case 'slider':
								$item = $this->SiteModel->getCarousel(array('id'=>$key->key_id))->row()->name;
									break;
									
									case 'igallery':
								$item = $this->GalleryModel->image_gallery($key->key_id)->row()->gallery_name;
									break;

									case 'vgallery':
								$item = $this->GalleryModel->getVideoGallery(array('id'=>$key->key_id))->row()->gallery_name;
									break;
	
									case 'pgallery':
								$item = $this->GalleryModel->product_gallery(array('id'=>$key->key_id))->row()->gallery_name;
									break;		
									
                                    case 'fdgallery':
                                $item = $this->GalleryModel->file_download_gallery(array('file_download_gallery_id'=>$key->key_id))->row()->gallery_name;
									break;
									
									case 'form':
								$item = $this->FormModel->getFormModel(array('id'=>$key->key_id))->row()->title;
									break;											

									case 'tform':
								$item = $this->FormModel->getTransactionForm(array('id'=>$key->key_id))->row()->tform_name;
									break;											

									case 'content':
								$item = 'Page Content';
									break;
									
									case 'rform':
									    $item = 'Result Search Form';
                                    break;
                                    case 'main_slider':
                                        $item = 'Main Slider';
                                    break;

									case 'fbox':

								$item = $this->SiteModel->getFeatureBox(array('id'=>$key->key_id))->row()->name;

									break;

									case 'fservice':
								$item = $this->ServiceModel->getFileService(array('id'=>$key->key_id))->row()->service_name;
									break;

									case 'ads':
								$item = $this->SiteModel->getGoogleAds(array('id'=>$key->key_id))->row()->name;
									break;

									case 'marquee':
									//continue;
								$item = $this->SiteModel->getMarquee(array('id'=>$key->key_id))->row()->name;
									break;

                                    case 'content_category':
                                $item = $this->db->get_where('content',['id'=>$key->key_id])->row()->content_title;
                                    break;
                                    case 'tab':
                                $item = $this->HtmlModel->list_tabs($key->key_id)[0]['title'];
                                    break;
                                    case 'special_category':
                                $item = $this->NewsModel->special_category(['id'=>$key->key_id])->row()->title;
                                    break;
                                    case 'newsTicker':
                                $item = $this->NewsModel->getTicker(['id'=>$key->key_id])->row()->title;
                                    break;
									default:
								$item = 'Undefined';
										break;
								}
								$type_title = isset($list[$key->type]) ? $list[$key->type] : ucwords(str_replace('_',' ',$key->type));
								echo'<li class="list-group-item" id="'.$key->id.'">'.$item.' <span class="mb-2 mr-2 badge badge-pill badge-info pull-right">'. $type_title.'</span></li>';
							}
					}
					else 
						echo'';
					


			}
			else if($status=='save')
			{
				$i=1;
				foreach ($post['seq'] as $id)
				{
					$this->db->set('seq',$i)->where(array('id'=>$id,'page_id'=>$post['pid'],'admin_id'=>CLIENT_ID))->update('web_schema');
					$i++;
				}
				
			}
			
		}
		else
		{
			$this->load->view('manage_schema');
		}
	}

    public function use_feature_box()
	{
		if($post = $this->input->post())
		{
			$data=  array('box_id'=>$post['boxid'],
							'page_id'=>$post['pageid']
			);
			$this->SiteModel->useFeatureBox($data);
		}
		else
		{
			$this->load->view('use_feature_box');
		}
	}


	public function edit_feature_box($id)
	{
		$id=  AJ_DECODE($id);

		if($post = $this->input->post())
		{
			for($i=0;$i<$post['no'];$i++)
			{
				$item[$i]['icon'] = $post['icon_'.$i];
				$item[$i]['title']= $post['title_'.$i];
				$item[$i]['data'] = $post['data_'.$i];
			}

			$en =  json_encode($item);

			$data = array('name'=>$post['name'],
							'no'=>$post['no'],
							'icolor' =>$post['iconcolor'],
							'boxcolor'=>$post['boxcolor'],
							'size'=>$post['size'],
							'type'=>$post['type'],
							'boxes'=>$en,
							'admin_id'=>CLIENT_ID,
						);

			$this->db->where(array('id'=>$id,'admin_id'=>CLIENT_ID))->update('feature_box',$data);
			$this->session->set_flashdata('success','Feature Box Updated Successfully');
			redirect(site_url('admin/edit-feature-box/'.AJ_ENCODE($id)));
		}
		else
		{
			$this->load->view('edit_feature_box',['id'=>$id]);
		}
	}

	public function delete_feature_box($id)
	{
		$id = AJ_DECODE($id);
		$this->db->where(array('id'=>$id,'admin_id'=>CLIENT_ID))->delete('feature_box');
		$this->db->where(array('box_id'=>$id,'admin_id'=>CLIENT_ID))->delete('feature_box_link');
		$this->db->where(array('key_id'=>$id,'type'=>'fbox','admin_id'=>CLIENT_ID))->delete('web_schema');
		$this->session->set_flashdata('success','Feature Box Deleted Successfully');
		redirect(site_url('admin/feature-box'));	

	}

	public function utility_social()
	{
		if($post = $this->input->post())
		{
			$task = $post['task'];
			unset($post['task']);

			if($task=='save')
			{
				$data = json_encode($post);

				if($this->db->where(array('admin_id'=>CLIENT_ID,'type'=>'social'))->get('utilities')->num_rows())
					$this->db->where(array('admin_id'=>CLIENT_ID,'type'=>'social'))->update('utilities',array('data'=>$data));
				else
					$this->db->insert('utilities',array('type'=>'social','data'=>$data,'status'=>1,'admin_id'=>CLIENT_ID));

				$this->session->set_flashdata('success','Done');
				redirect(site_url('admin/Utilities/social'));
			}
			else if($task=='updateStatus')
			{	
				$this->db->where(array('admin_id'=>CLIENT_ID,'type'=>'social'))->update('utilities',array('status'=>$post['status']));
				echo'don';
			}
		}
		else
		{
			$this->load->view('social');
		}
	}

	public function secondary_menu()
	{
		if($post = $this->input->post())
		{

			$status = $post['status']; unset($post['status']);

			if($status == 'change-order')
			{
				$order = isset($post['order']) ? json_encode($post['order']) : '';

				$data = array('secondary_menu'=>$order);

				if($this->db->where(array('admin_id'=>CLIENT_ID))->get('other')->num_rows())
				{
				
					$this->db->where(array('admin_id'=>CLIENT_ID))->update('other',$data);
				}
				else
				{

					$this->db->set(array('admin_id'=>CLIENT_ID))->insert('other',$data);
				}

			}
			else if($status == 'change-style')
			{	parse_str($post['css'],$chk);

				$css=json_encode($chk);
				
				$data = array('css'=>$css);

				if($this->db->where(array('admin_id'=>CLIENT_ID))->get('other')->num_rows())
				{
					$this->db->where(array('admin_id'=>CLIENT_ID))->update('other',$data);
				}
				else
				{
					$this->db->set(array('admin_id'=>CLIENT_ID))->insert('other',$data);
				}

			}


		}
		else
		{
			$this->load->view('secondary_menu');
		}
	}

	public function file_service()
	{
		if($post = $this->input->post())
		{
			$data = array(
							'formid' =>$post['formid'],
							'service_name'=>$post['serviceName'],
							'download_permission'=>$post['download'],
							'admin_id'=>CLIENT_ID
			);
			$this->ServiceModel->addFileService($data);
			$this->session->set_flashdata('success','File Service Added Successfully');
			redirect(site_url('admin/file-service'));
		}
		else
		{
				$this->load->view('file_service');
		}
	}

	public function manage_file_service($id)
	{
		if($post=$this->input->post())
		{
			$task = $post['task']; unset($post['task']);

			if($task=='update')
			{
				$data = array(
							'service_name'=>$post['serviceName'],
							'download_permission'=>$post['download']
						);
				$this->db->where(array('id'=>$post['id'],'admin_id'=>CLIENT_ID))->update('file_service',$data);
				$this->session->set_flashdata('success','Saved Successfully');
				redirect(site_url('admin/service/'.$id));
			}
			else if($task=='add-file')
			{
				if(isset($_FILES['attechedFile']) and $_FILES['attechedFile']['size']>0)
				{

					$config['upload_path'] = 'public/temp/'.CLIENT_ID.'/'; 
	                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docm|docx';
	                $config['encrypt_name'] = TRUE;
	              
	              
	                $this->load->library('upload', $config);
	                $this->upload->initialize($config);
	    
	                if($this->upload->do_upload('attechedFile'))
	                {
	                    
	                    $imageData = $this->upload->data();
	                  
	                     $this->SiteModel->insert_file_size(array('file_name'=>$imageData['file_name'],'size'=>$_FILES['attechedFile']['size']));

	                     $service_id = $post['id']; unset($post['id']);

	                     $encodeData = json_encode($post);
    					
    					$data = array(
    									'service_id'=>$service_id,
    									'data'=>$encodeData,
    									'file'=> $imageData['file_name'],
    									'admin_id'=> CLIENT_ID,
    						);
    					$this->db->insert('file_service_data',$data);
    					$this->session->set_flashdata('success','Added File Successfully');
                	}	
                	else
                	{
                		$this->session->set_flashdata('msg','<div class="alert alert-solid-danger">'.$this->upload->display_errors().'</div>');
                	}

				}
				else
				{
					$this->session->set_flashdata('error','Please select File to Attech');
				}
				redirect(site_url('admin/service/'.$id));
			}
		}
		else
		{
			$this->load->view('manage_file_service',['id'=>$id]);
		}
	}

	public function use_file_service()
	{
		if($post= $this->input->post())
		{
			if($post['status']=='usefileservice')
			{

					$data=  array('service_id'=>$post['serviceid'],
							'page_id'=>$post['pageid']
					);
					$this->ServiceModel->userFileService($data);
			}
		}
		else
		{
			$this->load->view('use_file_service');
		}
	}
	
		
	function delete_file_service($id){
	    $id = AJ_DECODE($id);
	    
	        
	            $data=  array('service_id'=>$id);
	        	$res = $this->ServiceModel->deleteFileService($data);
	        	$this->session->set_flashdata('success','File Service Deleted Successfully..');
	           
	    	redirect(site_url('admin/file-service'));
	}

	public function add_adsense()
	{
		if($post = $this->input->post())
		{
			if($this->db->where(array('admin_id'=>CLIENT_ID))->get('google_adsense')->num_rows())
			{
				$this->db->where(array('admin_id'=>CLIENT_ID))->update('google_adsense',array('code'=>$post['code']));
			}
			else
			{
				$this->db->insert('google_adsense',array('code'=>$post['code'],'admin_id'=>CLIENT_ID));
			}
			$this->session->set_flashdata('success','Saved Successfully');
			redirect(site_url('admin/add_adsense'));
		}
		else
		{
			$this->load->view('add_google_adsense');
		}
	}

	public function create_ads()
	{
		if($post = $this->input->post())
		{
			$this->db->insert('google_ads',array('name'=>$post['name'],'ads_code'=>$post['ads_code'],'admin_id'=>CLIENT_ID));
			$this->session->set_flashdata('success','Saved Successfully');
			redirect(site_url('admin/create-ads'));
		}
		else
		{
			$this->load->view('create_google_ads');
		}
	}

	public function use_ads()
	{

		if($post= $this->input->post())
		{
			if($post['status']=='useads')
			{

					$data=  array('ads_id'=>$post['adsid'],
							'page_id'=>$post['pageid']
					);
					$this->SiteModel->useAds($data);
			}
		}
		else
		{
			$this->load->view('use_ads');
		}
		
	}

	public function edit_ads($id)
	{
		if($post = $this->input->post())
		{
			$this->db->where(array('id'=>AJ_DECODE($id),'admin_id'=>CLIENT_ID))->update('google_ads',array('name'=>$post['name'],'ads_code'=>$post['ads_code']));
			$this->session->set_flashdata('success','Saved Successfully');
			redirect(site_url('admin/edit-ads/'.$id));
		}
		else
		{
			$this->load->view('edit_google_ads',['id'=>AJ_DECODE($id)]);
		}
	}

	public function delete_ads($id)
	{
		$id = AJ_DECODE($id);
		$this->db->where(array('id'=>$id,'admin_id'=>CLIENT_ID))->delete('google_ads');
		$this->db->where(array('ads_id'=>$id,'admin_id'=>CLIENT_ID))->delete('ads_link');
		$this->db->where(array('key_id'=>$id,'type'=>'ads','admin_id'=>CLIENT_ID))->delete('web_schema');
		redirect(site_url('admin/create-ads'));
	}

	public function add_marquee()
	{
		if($post = $this->input->post())
		{
		   
		    $btn = '';
		    if(isset($post['is_title'])){
		        unset($post['is_title']);
		        $btn = json_encode(['btn_title' => $post['title_text'] , 'btn_position' => $post['title_postion'] ]);
		    }
		    unset($post['title_text']);
		    unset($post['title_postion']);
		    
			$name = $post['name']; unset($post['name']);
			$data = $post['data']; unset($post['data']);
			$pro =  json_encode($post);

			$data = array('name'=>$name,'data'=>$data,'properties'=>$pro,'btn_data'=>$btn,'admin_id'=>CLIENT_ID);
			
			$this->db->insert('marquee',$data);
			$this->session->set_flashdata('success','Marquee Added Successfully');
			redirect(site_url('admin/add_marquee'));
		}
		else
		{
			$this->load->view('add_marquee');
		}
	}

	public function use_marquee()
	{
		if($post = $this->input->post())
		{
			$data=  array('marquee_id'=>$post['marqueeid'],
							'page_id'=>$post['pageid']
			);
			$this->SiteModel->useMarquee($data);
		}
		else
		{
			$this->load->view('use_marquee');
		}
	}

	public function delete_marquee($id)
	{
		$id = AJ_DECODE($id);
		$this->db->where(array('id'=>$id,'admin_id'=>CLIENT_ID))->delete('marquee');
		$this->db->where(array('marquee_id'=>$id,'admin_id'=>CLIENT_ID))->delete('marquee_link');
		$this->db->where(array('key_id'=>$id,'type'=>'marquee','admin_id'=>CLIENT_ID))->delete('web_schema');
		$this->session->set_flashdata('success','Marquee Deleted Successfully');
		redirect(site_url('admin/add-marquee'));	

	}
	
	function general_settings($para1 = "", $para2 = ""){
	    if ($para1 == "set_slider") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "slider");
        $this->db->where('admin_id',CLIENT_ID);
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
	}
    /*   Result code start ( 3:14 PM 06 Aug 2020 ) */
    
    function create_class_for_result(){
        
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/create_class';
        if($post = $this->input->post()){
            //print_r($post);
            $data = [
                'class_name' => $post['classname'],
                'class_numeric_name' => $post['classnamenumeric'],
                'section_name' => $post['section'],
                'admin_id' => CLIENT_ID
            ];
            $this->crud_model->add_data_by_table_name($data,'classes','class');
            redirect(base_url.'/admin/'.str_replace('_','-',__FUNCTION__));
        }
        else
           $this->load->view('main',$page);
    }
    
    function manage_classes_for_result(){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/manage_class';
        $page['classes'] = $this->db->get_where('classes',['admin_id'=>CLIENT_ID])->result_array();
        $this->load->view('main',$page);
    }
    
    function create_subject_for_result(){ 
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/create_subject';
        if($post = $this->input->post()){
            //print_r($post);
            $data = [
                'subject_name' => $post['subject_name'],
                'subject_code' => $post['subject_code'],
                'admin_id' => CLIENT_ID
            ];
            $this->crud_model->add_data_by_table_name($data,'subjects','subject');
            redirect(base_url.'/admin/'.str_replace('_','-',__FUNCTION__));
        }
        else
           $this->load->view('main',$page);
    }
    
    function manage_subjects_for_result(){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/manage_subjects';
        $page['subjects'] = $this->db->get_where('subjects',['admin_id' => CLIENT_ID])->result_array();
        $this->load->view('main',$page);
    }
    
    function add_subject_combination_for_result(){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/add_subject_combination';
        $page['classes'] = $this->db->get_where('classes',['admin_id'=>CLIENT_ID])->result_array();
        if($post = $this->input->post()){
            
        }
        else
           $this->load->view('main',$page);
    }
    
    function add_student_for_result($p = '',$p1 = 0){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/add_student';
        $page['classes'] = $this->db->get_where('classes',['admin_id'=>CLIENT_ID])->result_array();
        
        
        
        if($post = $this->input->post()){
            //   $t = $this->db->where(array('class_id'=>$post['class_id'],'rool_id'=>$post['rool_id']))->get('students');
            //   if($t->num_rows()){
            //       $this->session->set_flashdata();
            //   }
            $post['admin_id'] = CLIENT_ID;
            $post['join_date'] = date('d-m-Y h:i:s');
            $this->db->insert('students',$post);
            $this->session->set_flashdata('success','Student Add Successfully..');
            redirect(base_url.'/admin/'.str_replace('_','-',__FUNCTION__));
        }
        else
           $this->load->view('main',$page);
    }
    
    function manage_students_for_result($p = '', $p1 = 0){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/manage_students';
        $page['students'] = $this->db->get_where('students',['admin_id'=>CLIENT_ID])->result_array();
        if($p == 'delete'){
            $this->db->where('id',$p1)->delete('students');
            $this->db->where('student_id',$p1)->delete('result_data');
            $this->session->set_flashdata('success','Student is delete Successfully..');
            redirect(base_url.'/admin/'.str_replace('_','-',__FUNCTION__));
        }
        $this->load->view('main',$page);
    }
    
    function add_result(){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
            
        $page['page_name'] = 'result_section/add_result';
        $page['classes'] = $this->db->get_where('classes',['admin_id'=>CLIENT_ID])->result_array();
        
        
        if($post = $this->input->post()){
            $data = [
                'class_id'          =>          $post['class_id'],
                'student_id'        =>          $post['student_id'],
                'admin_id'          =>          CLIENT_ID,
                'subject_name'      =>          json_encode($post['a']),
                'max_marks'         =>          json_encode($post['b']),
                'obt_marks'         =>          json_encode($post['c']),
                'grade'             =>          json_encode($post['d']),
                'practical'         =>          json_encode($post['e']),
                'total'             =>          json_encode($post['f']),
                'remark'            =>          json_encode($post['g']),
                'left_h_fields'     =>          json_encode($post['left_h_fields']),
                'left_h_d_fields'   =>          json_encode($post['left_h_d_fields']),
                'left_r_fields'     =>          json_encode($post['left_r_fields']),
                'left_r_d_fields'   =>          json_encode($post['left_r_d_fields'])
            ];
            
            
            $this->db->insert('result_data',$data);
            
            $this->session->set_flashdata('success','Result Declare Successfully..');
            redirect(base_url.'/admin/'.str_replace('_','-',__FUNCTION__));
        }
        else
            $this->load->view('main',$page);
    }
    
    function manage_result(){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
        $page['page_name'] = 'result_section/manage_results';
        $page['result'] = $this->db->get_where('result_data',['admin_id'=>CLIENT_ID])->result_object();
        $this->load->view('main',$page);
    }
    
    function result_setting(){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
        $page['page_name'] = 'result_section/result_setting';
        $d = $this->db->get_where('result_view',['admin_id'=>CLIENT_ID]);
        if($d->num_rows())
            $page['result_view'] = $d->result_array();
        else{
            $this->db->insert('result_view',['admin_id'=>CLIENT_ID]);
            $page['result_view'] = $this->db->get_where('result_view',['admin_id'=>CLIENT_ID])->result_array();
        }
       // 
       if($_FILES){
           $post = $this->input->post();
           $allImg = $page['result_view'][0];
           $top     = $this->file_up('top_img');
           $back    = $this->file_up('back_img');
           $bottom  = $this->file_up('bottom_img');
           $data = [
                'top_image'     => isset($post['top_image']) ? empty($top)?$allImg['top_image']:$top :'',
                'back_image'    => isset($post['back_image']) ? empty($back)?$allImg['back_image']:$back : '',
                'bottom_image'  => isset($post['bottom_image']) ? empty($bottom)?$allImg['bottom_image']:$bottom : ''
            ];
            $this->db->where('admin_id',CLIENT_ID)->update('result_view',$data);
            $this->session->set_flashdata('success','Result View Setting Set Successfully..');
            redirect(base_url.'/admin/'.str_replace('_','-',__FUNCTION__));
       }
       else
        $this->load->view('main',$page); 
    }
    
    function search_form_for_result($id = '', $type = ''){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/search_form';
        $where = ['admin_id'=>CLIENT_ID];
        
        if($type == 'edit'){
            $where['id'] = AJ_DECODE($id);
            $page['page_name'] = 'result_section/edit_search_form';
        }
        
        $page['result_form'] = $this->db->get_where('resull_search_form',$where)->result_array();
        
        if($post = $this->input->post()){
            $return = ['status' => FALSE];
            $data = [];$return['label'] ='';
            if(array_key_exists('field_name', $post)){
                foreach($post['field_name'] as  $v){
                    $data[$v] = $post[$v];
                    $return['label']  .=  '<label style="margin-right:6px" class="badge badge-'.print_random_class().'">'.$post[$v]['label'].'</label>';
                    unset($post[$v]);
                }
                $layout = $post['layout'];
                unset($post['field_name']);
                unset($post['layout']);
                $new_data = array(
                        'fields' => json_encode($data),
                        'forms_css' => json_encode($post),
                        'layout'    => $layout,
                        'admin_id'  => CLIENT_ID
                    );
                    if($type == 'edit')
                        $this->db->where($where)->update('resull_search_form',$new_data);
                    else{
                        $id = $this->db->insert('resull_search_form',$new_data);
                        $form_title = $post['form_title']=='' ? '<strong style="color:red">UNKNOWN TITLE</label>' : $post['form_title'];
                        $return['tr'] = '<tr>
                                <td>New</td>
                                <td>'.$form_title.'</td>
                                <td>'.$return['label'].'</td>
                                <td><a href="#" class="btn btn-primary btn-xs btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><button class="btn btn-danger btn-xs btn-sm delete-form" onclick="delete_form(this,'.$id.')"><i class="fa fa-trash"></i></button></td>
                        </tr>';
                    }
                
                $return['status'] = TRUE;
            }
            echo json_encode($return);
        }
        else
            $this->load->view('main',$page); 
    }
    
    function use_search_form_for_result(){
        if(!isset($this->addonsMenu['result_section']))
            redirect(base_url.'/admin');
            
        $page['page_name'] = 'result_section/use_form';
        $page['result_form'] = $this->db->get_where('resull_search_form',['admin_id'=>CLIENT_ID])->result_array();
        
        $this->load->view('main',$page); 
    }
    
    function result_section_ajax(){
         if(!isset($this->addonsMenu['result_section']))
            $return['status'] = false;
            
            
            
            
        if(($post = $this->input->post()) ){
            $return['status'] = ['status'=>false,'html'=>'<strong style="color:red">Subject is not  Available..</strong>'];
            switch($post['status']){
                case 'delete_search_form':
                    $return['status'] =$this->db->where(['id'=>$post['id']])->delete('resull_search_form');
                     $this->db->where(['type'=>'rform','admin_id'=>CLIENT_ID,'key_id'=>$post['id']])->delete('web_schema');
                break;
                case 'get_subjects':
                    $return['status'] = true;
                    $get = $this->db->get_where('classes',['id'=>$post['id']])->row()->subject_combination;
                    $subject_combination = ($get=='')?[]:json_decode($get);
                    $return['html'] = '<label>List All Subjects</label><div class="row">';
                    $all_subjects = $this->db->get_where('subjects',['admin_id'=>CLIENT_ID]);
                    foreach($all_subjects->result() as $k => $sub){
                        $checked = in_array($sub->id,$subject_combination)?'checked':'';
                        $return['html'] .= '<div class="col-md-2" style="padding:7px;border:1px solid gray;">
                                                <label>
                                                    <input type="checkbox" '.$checked.' name="subjects[]" value="'.$sub->id.'">
                                                  '.ucwords($sub->subject_name).' <small>[ '.ucwords($sub->subject_code).' ]</small>
                                                </label>
                                            </div>';
                    }
                    $return['html'] .= '</div>';
                break;
                
                case 'add_subject_in_class':
                    $return['html'] = '';
                    $return['status'] = true;
                    $data = isset($post['subjects'])?json_encode($post['subjects']):'';
                    $this->db->where('id',$post['class_id'])->update('classes',['subject_combination'=>$data]);
                break;
                
                case 'check_student_result':
                    $t = $this->db->get_where('result_data',['class_id'=>$post['class_id'],'student_id'=>$post['std_id'],'admin_id'=>CLIENT_ID])->num_rows();
                    $return['status'] = $t?true:false;
                    $return['html'] = '';
                    if(!$t){
                        $std = $this->db->get_where('students',['id'=>$post['std_id'],'admin_id'=>CLIENT_ID])->row();
                        $return['html'] .= '<div class="col-md-12">
                                                <div align="center">
                                                <button type="button" class="btn btn-primary add-btn-top-fields"><i class="fa fa-plus"></i> Add Top Field</button></div>
                                             <table class="table table-bordered table-striped  add-top-fields">
                                                <tr id="boxxxx-99">
                                                    <th><input type="" name="left_h_fields[]" class="form-control" placeholder="Head Name" value="Student Name"></th>
                                                    <td><input type="" name="left_h_d_fields[]" class="form-control" placeholder="Field Name" value="'.ucwords($std->full_name).'"></td>
                                                    <th><input type="" name="left_r_fields[]" class="form-control" placeholder="Head Name" value="Roll No."></th>
                                                    <td><input type="" name="left_r_d_fields[]" class="form-control" placeholder="Field Name" value="'.$std->rool_id.'"></td>
                                                    <td width=5%><button class="btn btn-danger remove-top-fields btn-xs btn-sm" onclick="remove_fields(99)" type="button"><i class="fa fa-times"></i></button>
                                                </tr>
                                                 <tr id="boxxxx-98">
                                                    <th><input type="" name="left_h_fields[]" class="form-control" placeholder="Head Name" value="Son/Daughter of Mrs."></th>
                                                    <td><input type="" name="left_h_d_fields[]" class="form-control" placeholder="Field Name" value="'.ucwords($std->mother_name).'"></td>
                                                    <th><input type="" name="left_r_fields[]" class="form-control" placeholder="Head Name" value=""></th>
                                                    <td><input type="" name="left_r_d_fields[]" class="form-control" placeholder="Field Name" value=""></td>
                                                    <td width=5%><button class="btn btn-danger remove-top-fields btn-xs btn-sm" onclick="remove_fields(98)" type="button"><i class="fa fa-times"></i></button>
                                                </tr>
                                                
                                                 <tr id="boxxxx-97">
                                                    <th><input type="" name="left_h_fields[]" class="form-control" placeholder="Head Name" value="Son/Daughter of Mrs."></th>
                                                    <td><input type="" name="left_h_d_fields[]" class="form-control" placeholder="Field Name" value="'.ucwords($std->father_name).'"></td>
                                                    <th><input type="" name="left_r_fields[]" class="form-control" placeholder="Head Name" value=""></th>
                                                    <td><input type="" name="left_r_d_fields[]" class="form-control" placeholder="Field Name" value=""></td>
                                                    <td width=5%><button class="btn btn-danger remove-top-fields btn-xs btn-sm" onclick="remove_fields(97)" type="button"><i class="fa fa-times"></i></button>
                                                </tr>
                                                
                                                
                                                
                                             </table>
                                
                                
                                            </div>
                                            
                                            <script>
                                            let i = 1;
                                                $(".add-btn-top-fields").click(function(){
                                                    
                                                    $(".add-top-fields").append("<tr id=\"boxxxx-"+i+"\">\
                                                        <th><input name=\"left_h_fields[]\" class=\"form-control\" placeholder=\"Head Name\"></th>\
                                                        <td><input name=\"left_h_d_fields[]\" class=\"form-control\" placeholder=\"Field Name\" ></td>\
                                                        <th><input name=\"left_r_fields[]\" class=\"form-control\" placeholder=\"Head Name\"></th>\
                                                        <td><input name=\"left_r_d_fields[]\" class=\"form-control\" placeholder=\"Field Name\"></td>\
                                                        <td width=5%><button class=\"btn btn-danger remove-top-fields btn-xs btn-sm\" onclick=\"remove_fields("+i+")\" type=\"button\"><i class=\"fa fa-times\"></i></button>\
                                                    </tr>");
                                                    i++;
                                                });
                                                function remove_fields(id){
                                                    $.confirm({
                                                        type:"red",
                                                        title:"Confirmation",
                                                        content:"Are you sure for remove this field",
                                                        icon:"fa fa-bell",
                                                        buttons:{
                                                            ok:{
                                                                text:"<i class=\"fa fa-trash\"></i> Delete",
                                                                btnClass:"btn-danger",
                                                                action:function(){
                                                                    $("#boxxxx-"+id).remove();
                                                                }
                                                            },
                                                            cancel:function(){}
                                                        }
                                                        
                                                    });
                                                }
                                            </script>
                                            
                                            
                                            
                                            ';
                    }
                    
                break;
                
                case 'get_students_and_subjects':
                    
                   $return['html'] = '<div class="form-group col-md-12">
                                        <label>Select Student</label>
                                        <select class="form-control get_student" required="" name="student_id">
                                            <option value="">Select A Student</option>';
                                            $students = $this->db->get_where('students',['admin_id'=>CLIENT_ID,'class_id'=>$post['class_id']]);
                                            foreach($students->result()  as $k => $std)
                                             $return['html'] .= '<option value="'.$std->id.'">'.$std->rool_id.'-'.ucwords($std->full_name).'</option>';
                    $return['html'] .= '</select>
                                    </div>
                                    
                                    <div class="chk-student col-md-12 form-group">
                                    
                                    </div>
                                    
                                    <div class="form-group" style="width:100%">
                                        <table class="table table-bordered table-striped  table-sort">
                                            <thead>
                                            <tr>
                                                <th width=15%>Subject</th>
                                                <th width=15%>Max. Marks</th>
                                                <th width=15%>Obtained Marks</th>
                                                <th width=15%>Practical</th>
                                                <th width=15%>Total</th>
                                                <th width=15%>Grade</th>
                                                <th with=15%>Remark</th>
                                            </tr>
                                            </thead>
                                            <tbody class="data-table-html fieldTable ui-sortable">';
                                            $subjects = $this->db->get_where('classes',['id'=>$post['class_id']])->row()->subject_combination;
                                            $subjects = ($subjects=='')?[]:json_decode($subjects);
                                            $i = 1;
                                            foreach($subjects as $subject){
                                                $subject_name = $this->db->get_where('subjects',['id'=>$subject])->row()->subject_name;
                            $return['html'] .=  '<tr class="ui-state-default">
                                                
                                                    <td><input type="text" name="a[]" class="form-control" value="'.$subject_name.'"></td>
                                                    <td><input type="number" name="b[]" class="form-control" required placeholder="Max. Mark"></td>
                                                    <td><input type="number" name="c[]" class="form-control" required placeholder="Obtained Mark"></td>
                                                    <td><input type="number" name="e[]" class="form-control" placeholder="Practical"></td>
                                                    <td><input type="number" name="f[]" class="form-control" required placeholder="Total"></td>
                                                    <td><input type="text" name="d[]" class="form-control"  placeholder="Grade"></td>
                                                    
                                                    <td>
                                                       <input type="text" name="g[]" class="form-control" placeholder="Remark">
                                                    </td>
                            </tr>';
                                            }
                            $return['html'] .=  '</tbody><tfooter><tr>
                                                
                                                    
                                                    <td colspan="7" align="center"><button type="button" class="btn btn-success btn-xs add-field"><i class="fa fa-plus"></i> Add Field</button></td>
                                                    
                                                
                                                </tr></tfooter>';                
                                            
                       $return['html'] .=' </table>
                                        <script>
                                        var i = 1;
                                        $(".get_student").change(function(){
                                            let std_id = this.value;
                                            let class_id = $(".class_id").val();
                                            let btn = $(".card-footer").find("button");
                                            $(".chk-student").html("");
                                            if(std_id=="")
                                                $(btn).prop("disabled",false);
                                            else
                                            {
                                                $("#load").show();
                                                $.post(base_url+"admin/result-section-ajax",{std_id:std_id,status:"check_student_result",class_id:class_id},function(d){
                                                    d = JSON.parse(d);
                                                    console.log(d);
                                                    if(d.status){
                                                        $(btn).prop("disabled",true);
                                                        $(".chk-student").html("<div class=\"alert alert-danger\">Result Already Declared</div>");
                                                        toastr.error("Result Already Declared");
                                                    }
                                                    else{
                                                        $(btn).prop("disabled",false);
                                                        $(".chk-student").html(d.html);
                                                    }
                                                        
                                                    $("#load").hide();
                                                });
                                            }
                                        });
                                            $(".add-field").click(function(){
                                            var data = "<tr id=\"tr-"+i+"\" class=\"ui-state-default\">\
                                                            <td><input  name=\"a[]\" class=\"form-control\" placeholder=\"First Field\"></td>\
                                                            <td><input  name=\"b[]\" class=\"form-control\" placeholder=\"Second Field\"></td>\
                                                            <td><input name=\"c[]\" class=\"form-control\" placeholder=\"Third Field\"></td>\
                                                            <td><input name=\"e[]\" class=\"form-control\" placeholder=\"Forth Field\"></td>\
                                                            <td><input name=\"f[]\" class=\"form-control\" placeholder=\"Fifth Field\"></td>\
                                                            <td><input  name=\"d[]\" class=\"form-control\" placeholder=\"Sixth Field\">\
                                                            </td>\
                                                            <td><input name=\"g[]\" style=\"width:100%;display:inline-block\" class=\"form-control\" placeholder=\"Seventh Field\">\
                                                            <a href=\"javascript:removeTr("+i+")\" style=\"display: inline-block;position: absolute;margin-left: -6px;margin-top: -12px;\" class=\"btn btn-danger btn-xs btn-sm\"><i class=\"fa fa-trash\"></i></a></td>\
                                                        </tr>";
                                            
                                                $(".data-table-html").append(data);
                                                i++;
                                            });
                                             $( function() {                                    
                                                $(".fieldTable").sortable({
                                                    helper: fixWidthHelper
                                                }).disableSelection();
                                                });
                                            function fixWidthHelper(e, ui) {
                                                ui.children().each(function() {
                                                    $(this).width($(this).width());
                                                });
                                                return ui;
                                            }
                                            function removeTr(index){
                                                $.confirm({
                                                    type:"red",
                                                    title:"Confirmation!",
                                                    icon:"fa fa-bell",
                                                    content:"Are you sure for delete it.",
                                                    buttons:{
                                                        ok:{
                                                            text:"Remove",
                                                            btnClass:"btn-danger",
                                                            action:function(){
                                                                $("#tr-"+index).remove();
                                                            }
                                                        },
                                                        cancel:function(){}
                                                    }
                                                });
                                                
                                            }
                                        </script>
                                    </div>';
                break;
                
                case 'user_result_form':
                    $data=  array('key_id'=>$post['formid'],
							'page_id'=>$post['pageid']
					);
					$return['html'] = $this->FormModel->userResultForm($data);
					$return['status'] = true;
                break;
                
                case 'delete_result_data':
                    $where = [ 'id' => $post['id'] ];
                    $return['status'] = $this->FormModel->deleteResultData($where);
                break;
            }
           
            echo json_encode($return);
        }
    }
    
    function get_quick_form_data(){
        $data['page_name'] = 'quick-form-data';
        $data['records'] =  $this->db->query("SELECT * FROM ".PREFIX."_contact_us WHERE admin_id ='".CLIENT_ID."' ORDER BY id DESC ")->result_array();
        $this->load->view('main',$data);
    }
    
    
    function email($type = 'list', $id = 0){
        
        $page['page_name'] = __FUNCTION__.'/'.$type;
        $page['id'] = $id;
        if(  $post = $this->input->post()  ){
         
            try{
             
               $email = array(
                            'domain'          => FRESH_DOMAIN, 
                            'email'           => $_POST['email'].'@'.FRESH_DOMAIN, 
                            'password'        => $_POST['password'],
                            'quota'           => '1024',
                           
                        ); 
                
                    $add_email_address = $this->cPanel->api2->Email->addpop($email);
                    $response = OBJTOARRAY($add_email_address->cpanelresult->data)[0];
                   
                    if($response['result']){
                        unset($email['domain']);
                        $email['admin_id'] = CLIENT_ID;
                        $email['create_time'] = time();
                        $this->db->insert('emails',$email);
                        $url = '';
                        $this->session->set_flashdata('success',$email['email'].' Created Successfully..');
                    }
                    else
                       $url = '?status=danger&message='.$response['reason'];
        
            } catch(Exception $e) {
               $url = '?status=success&message='.$e->getMessage();
            }
            redirect(base_url.'/admin/email/'.urldecode($url));
        
        }else
            $this->load->view('main',$page); 
    }
    /* End result section */
	public function logout()
	{

        $this->load->helper('cookie');
		unset($_SESSION['adminLogin']);		
		unset($_SESSION['adminId']);
        //function delete_cookie($name, $domain = '', $path = '/', $prefix = '')
        //set_cookie('adminLogin','true',$day,$_SERVER['HTTP_HOST'],'/');
        delete_cookie('adminLogin',$_SERVER['HTTP_HOST'],'/');
        
		redirect(site_url('admin'));

	}

}

?>