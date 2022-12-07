<?php
$CI = & get_instance();
?>
        <div id="overlay" style=" padding: 26px; ">
        	<button class="btn btn-danger " style="    position: absolute;    right: 21px; "><i class="fa fa-times"></i> Close</button>
        	<br>
        	<center></center>
        
        </div>
        
        <div id="fileView">
        	<a class="downloadButton" href="" download=""><button class="btn btn-success"><i class="fa fa-download"></i> Download</button></a>
        	<button class="btn btn-danger " onclick="$(this).parent().hide()"><i class="fa fa-times"></i> Close</button>
        	<br>
        	<embed  width="100%" height="100%" style="z-index: 99999999" />
        
        </div>
        
        
        <?php
        $f =  $CI->ThemeModel->getCustomCss(array('element'=>'footer'));
        if($f->num_rows())
        {
        	$css = json_decode($f->row()->css); 
        	if(isset($css->wno) && strlen($css->wno))
        	{  	
                echo'<a href="https://wa.me/'.$css->wno.'" target="_blank" style="'.$css->walign.':10px"  class="wplogo">
                    		<img src="'.base_url.'/public/temp/whatsapplogo.png" ></a>';
                
        	}
        	if(isset($css->callBackNo) && strlen($css->callBackNo))
        	{	
        	    $align = isset($css->callBackAlign) ? $css->callBackAlign : 'right';
                echo'<a href="tel:'.$css->callBackNo.'" style="'.$align.':10px"  class="wplogo">
                    		<img src="'.base_url.'/public/images/phone/'.$css->CallBackImg.'"></a>';
                
        	}
        	
        }
        
        echo '{_chatCode_}';
        
        // $utilitySocial  = $CI->db->where(array('type'=>'social','admin_id'=>CLIENT_ID,'status'=>1))->get('utilities');
        
        if($srow = web_plugin('social_links'))
        {	
            // $srow  = json_decode($utilitySocial->row()->data);
        
        	echo'
			
			<div class="height-0 icon-bar social_links " style="'.$srow->position.':0;">';
        	if($srow->facebook)
        		echo'<a target="_blank" class="facebook" href="'.$srow->facebook.'"><i class="fa fa-facebook"></i></a>';
        	
        	if($srow->twitter)
        		echo'<a target="_blank" class="twitter" href="'.$srow->twitter.'"><i class="fa fa-twitter"></i></a>';
        	
        	if($srow->instagram)
        		echo'<a target="_blank" class="instagram" href="'.$srow->instagram.'"><i class="fa fa-instagram"></i></a>';
        	
        	if($srow->linkedin)
        		echo'<a target="_blank" class="linkedin" href="'.$srow->linkedin.'"><i class="fa fa-linkedin"></i></a>';
        	
        	if($srow->pinterest)
        		echo'<a target="_blank" class="pintrest" href="'.$srow->pinterest.'"><i class="fa fa-pinterest"></i></a>';
        	
        	if($srow->youtube)
        		echo'<a target="_blank" class="youtube" href="'.$srow->youtube.'"><i class="fa fa-youtube"></i></a> ';  
        		
    		if(isset($srow->telegram))
				if($srow->telegram)
        			echo'<a target="_blank" class="twitter" href="'.$srow->telegram.'"><i class="fa fa-telegram"></i></a> ';      
        	echo'</div>';
        }
        
        
        $pop  = $CI->SiteModel->getPopup("(page_id = 'all' or page_id = ".$page_id.")");
        
        if($pop->num_rows())
        {
        	
        	$popup = $pop->row();
        	$de = json_decode($popup->details);
        	$act = 1;
        	if($de->frq=='0')
        	{
        		if(!isset($_COOKIE['popup_'.CLIENT_ID.'_'.$popup->id]))
        			setcookie('popup_'.CLIENT_ID.'_'.$popup->id, 'true', time() + (86400), "/");
        		else
        			$act=0;
        	}
        
        
        	if($act)
        	{
        		$con = 	$popup->type=='data'?$popup->content: Modules :: run('template/PopupForm',$popup->form_id);
        
        		echo'<div id="popup" align="center" style="overflow:auto;">
        			<span class="" style="margin:10px; font-size:38px; position:fixed; right:0; color:red; z-index:99999999; background: white;padding: 6px 10px;border-radius: 50%;border: 2px solid black;" onclick="$(\'#popup\').hide()"><i class="fa fa-times"></i></span>
        			<div class="container" style="background: white; width: '.$de->width.'px; max-width:100%; min-height: '.$de->height.'px; margin-top: 20px; padding:10px; border:2px solid black; border-radius:4px; box-shadow:4px 10px 13px -5px black">
        					'.$con.' 
        			</div>  
        		</div>';	
        	}
        	
        	
        }
        ?>
        
