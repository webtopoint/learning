<?php
require_once 'header.php';
$CI=&get_instance();

 $menuCSS = $this->MenuModel->getMenuCSS();
 $me=$menuCSS->row();
?>

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-browser icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Website Setting
                <div class="page-title-subheading">Modify Website using this section.
                </div>
            </div>
        </div>
        <div class="page-title-actions">
	        <!--button class="btn btn-success manage-images">Manage Images</button-->
                                   
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="mb-3 card text-primary bg-white">
    		<div class="card-header">Website Logo <label class="badge badge-success pull-right">Main</label></div>
    			<div class="card-body">
    				<form id="" action="" method="POST" enctype="multipart/form-data">
    				    <div class="form-group">
    				        <input type="hidden" name="status" value="logo">
    						<label>Website Logo </label>
    						<?php
    
    
    						$site = $CI->SiteModel->getWebsiteData();
    						$email=$contact="";
    						$curImg='no-photo.png';
    						$imgLink= base_url.'/public/temp/'.'no-photo.png';
    						$siteData;
    						$boxLayout = [];
    						$logoStyle = ['width' => '','height'=>''];
    						if($site->num_rows())
    						{
    							$site = $siteData = $site->row();
    							
    							if($site->theme_color)
    							    $this->config->set_item('web_theme_color',$site->theme_color);
    							//print_r($site);
    							if($site->contact)
    						    	$contact= implode(',',json_decode($site->contact));
    						    	
    							if($site->email)
    						    	$email= implode(',',json_decode($site->email));
    				            if($site->box_layout)
    				                $boxLayout = json_decode($site->box_layout);
    				                
    							$curImg = $site->logo?$site->logo:'no-photo.png';
    							$curntFavi = ($site->favicon)?$site->favicon:'no-photo.png';
    						    $faviLink = $imgLink = base_url.'/public/temp/';
    			                  if($site->logo)
    			                    $imgLink.=CLIENT_ID.'/';
    			                  if($site->favicon)
    			                    $faviLink.=CLIENT_ID.'/';
    			                $faviLink.=$curntFavi;
    			                $imgLink.=$curImg;
    			                
    			                if($site->logo_style != 'null')
    			                 $logoStyle = json_decode($site->logo_style,true);
    
    			                
    						}
    							
    						//	imageSelector('siteLogoSelector',$imgLink,'logo')
    						?>
    						<input type="file" name="logo" accept="image/*" class="form-control" required>
    						<?
    						echo '<img style="margin-top:10px" width="200" height="200" src="'.$imgLink.'">';
    						?>
    					</div>
    					<div class="form-group">
    					    <button class="btn btn-success">Set Logo</button>
    					</div>
    				</form>
    		</div>
    	</div>
    </div>
    <div class="col-md-4">
        <div class="mb-3 card text-primary bg-white">
    		<div class="card-header">Website Logo <label class="badge badge-warning pull-right">Secondary</label></div>
    			<div class="card-body">
    				<form id="" action="" method="POST" enctype="multipart/form-data">
    				    <div class="form-group">
    				        <input type="hidden" name="status" value="secondary_logo">
    						<label>Website Secondary Logo </label>
    						<?php
    
    
    						$site2 = $CI->SiteModel->getWebsiteData();
    						
    						$curImg2='no-photo.png';
    						$imgLink2= base_url.'/public/temp/'.'no-photo.png';
    						$siteData2;
    						if($site2->num_rows())
    						{
    							$site2 = $siteData2 = $site2->row();
    							
    			                  if($site2->secondary_logo)
    			                    $imgLink2= base_url.'/public/temp/'.CLIENT_ID.'/'.$site2->secondary_logo;
    						}
    							
    						//	imageSelector('siteLogoSelector',$imgLink,'logo')
    						?>
    						<input type="file" name="logo" accept="image/*" class="form-control" required>
    						<?
    						echo '<img style="margin-top:10px" width="200" height="200" src="'.$imgLink2.'">';
    						?>
    					</div>
    					<div class="form-group">
    					    <button class="btn btn-success">Set Secondary Logo</button>
    					</div>
    				</form>
    		</div>
    	</div>
    </div>
    <div class="col-md-4">
        <div class="mb-3 card text-primary bg-white">
    		<div class="card-header">Website favicon</div>
    			<div class="card-body">
    				<form id="" action="" method="POST" enctype="multipart/form-data">
    				    <div class="form-group">
    				        <input type="hidden" name="status" value="favicon">
    						<label>Website Favicon </label>
    						<input type="file" name="favicon" accept="image/*" class="form-control" required>
    						<?
    						echo '<img style="margin-top:10px" width="200" height="200" src="'.$faviLink.'">';
    						?>
    					</div>
    					<div class="form-group">
    					    <button class="btn btn-success">Set Favicon</button>
    					</div>
    				</form>
    		</div>
    	</div>
    </div>
    
    
    <div class="col-md-4">
        <form id="" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3 card text-primary bg-white">
        		<div class="card-header">Website Logo Style</div>
        			<div class="card-body">
        				
    				    <div class="form-group">
    				        <input type="hidden" name="status" value="logo_style">
    						<label>Width </label>
    						<input type="number" name="width" class="form-control" placeholder="Width in PX" value="<?=$logoStyle['width']?>">
    					</div>
    					<div class="form-group">
    						<label>Height </label>
    						<input type="number" name="height" class="form-control" placeholder="Height in PX" value="<?=$logoStyle['height']?>">
    					</div>
    					<div class="form-group">
    					    <button class="btn btn-success">Update</button>
    					</div>
        				
        		</div>
        	</div>
        </form>
    </div>
    <div class="col-md-12">
    		<div class="mb-3 card text-primary bg-white">
    			<div class="card-header">General Setting</div>
    			<div class="card-body">
    				<form id="general">
    					
                       
    					<div class="form-group">
    						<label>Website Title</label>
    						<input type="text" value="<?=$site->title?>" class="form-control" name="title">
    					</div>

    					
    					<div class="form-group">
    						<label>Enter Contact Number(s)</label>
    						<input id="contactNumber" name="contact" class="form-control" value="<?=$contact?>">
    					</div>
    
    					<div class="form-group">
    						<label>Enter Email(s)</label>
    						<input id="email" type="text" class="form-control" name="email" value="<?=$email?>">
    					</div>
    					<div class="form-group">
    						<label>Menu-Bar Background-Color</label>
    						<input type="color" value="<?=$me->menubar_color?>" class="form-control" name="menu_bar_color">
    					</div>
    					
    					<div class="form-group">
    						<label>Theme-Color</label>
    						<input type="color" value="<?=config_item('web_theme_color')?>" class="form-control" name="theme_color">
    					</div>
    					
    					
    					<div class="form-group">
    						<button class="btn btn-success" type="" type="submit">Save Website</button>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    	
    	<div class="col-md-12">
    	     <form action="" method="POST" enctype="multipart/form-data">
    	    	<div class="mb-3 card text-primary bg-white">
    			    <div class="card-header">Front Setting</div>
    			    <div class="card-body">
    				    <script>
    				        
                            function checkActive(type){
                                setTimeout(function(){
                                    $('.bg_color,.bg_image').hide();
                                    $('.'+type).show();
                                    $('.change_d').prop('checked',false);
                                    $('input[value='+type+']').prop('checked',true);
                                },1000);
                            }
                            
    				    </script>
    				         <input type="hidden" value="front" name="status">
    				         <?
    				         $b = ($boxLayout);
    				         $box = $type = $value = ''; $chked = 'checked';
    				         if(is_object($b) && $b->box_layout == 'ok'){
    				             $type = $b->type;
    				             $value = $b->value;
    				             $box = $b->box_layout == 'ok' ? 'checked' : '';
    				             echo '<script>
    				                        $(".change_d").prop("checked",false);
    				                        checkActive("'.$type.'");
    				                  </script>';
    				         }
    				         else{
    				           echo '<script>
    				                        $(".change_d").prop("checked",false);
    				                        checkActive("bg_color");
    				                  </script>';
    				         }
    				         ?>
    				         
        	                <div class="form-group">
        					    <label>
        					        <input type="checkbox" name="box_layout" class="box_layout" <?=$box?>> Box Layout
        					    </label>
        					</div>
        					<div class="row data-row" style="<?php if(!$box){ echo 'display:none'; } ?>">
            					<div class="form-group col-md-12">
            					    <label>
            					        <input type="radio" name="type" class="change_d" value="bg_color" checked> Background Color
            					    </label>
            					    <label>
            					        <input type="radio" name="type" class="change_d" value="bg_image">  Background Image
            					    </label>
            					</div>
        					
        					    <div class="col-md-6 form-group input-v bg_color" style="display:none" >
        					        <label>Box Background Color</label>
        					        <input type="color" name="bg_color" class="form-control" value="<?php if($type=='bg_color'){ echo $value; }?>">
        					    </div>
        					    
        					    <div class="col-md-6 form-group input-v bg_image" style="display:none">
        					        <label>Box Background Image</label>
        					        <input type="file" name="bg_image" class="form-control">
        					        <br>
        					        <img src="<?=base_url?>/public/temp/<?=CLIENT_ID?>/<?=$value?>" id="blah"  style="width:100%;height:250px" alt>
        					    </div>
        					</div>
        			
        			</div>
        			<div class="card-footer">
        			    <button class="btn btn-success">Save</button>
        			</div>
        	  </div>
        	</form>
    	</div>
</div>
<script type="text/javascript">
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("input[name=bg_image]").change(function(){
    readURL(this);
});
$('.box_layout').change(function(){
    $('.data-row').toggle(600);
});
$('.change_d').change(function(){
    $('.bg_color,.bg_image').hide();
    $('.'+this.value).show();
    $('input[name=bg_color],input[name=bg_image]').prop('required',false);
    $('input[name='+this.value+']').prop('required',true);
});
$("#contactNumber,#email").tagsInput({
   'height':'40px',
   'width':'100%',
   'interactive':true,
   'defaultText':'Add',
   'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
   'removeWithBackspace' : true,
   'placeholderColor' : '#666666'
});
 	
</script>

<script type="text/javascript">


$("#general").on("submit",function(ev)
{  // alert($(this).serialize());
	ev.preventDefault();	
	$("#load").show();
	$.ajax({
		url:'<?=site_url('Admin/website_setting')?>',
		type:'POST',
		data:$(this).serialize()+'&status=general',
		success:function(q)
		{	//alert(q);
		    $("#load").hide();
			toastr.success("Saved Successfully");
		}
		,
		error : function(r,b,v){
		    console.warn(r.responseText);
		}
	});
});

</script>



<div class="row">
	<div class="col-md-12">
		<div class="mb-3 card text-primary bg-white">
			<div class="card-header">Footer Setting</div>
			<div class="card-body">
				<div class="form-group">
				    
					<?php 
					$CI=&get_instance();
					 //============ setting current setting
		                $curImg='no-photo.png';
		                $imgLink=base_url.'/public/temp/'.$curImg;
		                $cur = $CI->ThemeModel->getCustomCss(array('element'=>'footer'));
                        $is_image = 0;
		                if($num=$cur->num_rows())
		                {
		                  $cur = json_decode($cur->row()->css);
		                  $curImg = $cur->imgName?$cur->imgName:'no-photo.png';
		                  $imgLink = base_url.'/public/temp/';
		                  if($cur->imgName){
		                    $imgLink.=CLIENT_ID.'/';
		                    $is_image = 1;
		                  }
		                  $imgLink.=$curImg;
		                  
		                }
				//	echo imageSelector('footerSelector',$imgLink,'imgName');
		              	//echo imgSel();
		               //echo imageSelector(20);
					?>
					
				</div>
			<form id="" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="status" value="footer">
				<div class="form-group">
				    <label>Select Footer Background Image</label>
				    <input type="file" name="imgName" accept="image/*" class="form-control select-footer-img">
				    <input type="hidden" name="is_image" class="is_image" value="<?=$is_image?>">
				    <?
				    if($num && $cur->imgName){
				        echo '<input type="hidden" name="imgName" value="'.$curImg.'">';
				        echo '<button class="btn btn-danger remove-footer-img btn-xs" type="button" style="position:absolute;right:5px"><i class="fa fa-trash"></i></button>';
				        echo '<img class="img-src" style="margin-top:10px;width:100%" height="200" src="'.$imgLink.'">';
				    }
				    ?>
				</div>
				<script>
				    $('.select-footer-img').change(function(){$('.is_image').val(1);});
				    $('.remove-footer-img').click(function(){$('.is_image').val(0);$('.img-src').hide();$(this).hide();});
				</script>
				<div class="form-group">
					<label>Footer Color:</label>
					<input type="color" class="form-control" name="backColor" value="<?php if($num)echo $cur->backColor ?>">
				</div>
				<div class="form-group">
					<label>Footer Opacity: (0% - 100%)</label>
					<input type="number" name="opacity" value="<?=$num?$cur->opacity:'100'?>" class="form-control">
				</div>
				
				<hr>
				<h4>Whatsapp Number <small>(Optional)</small></h4>
				<hr>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Whatsapp Number</label>	
							<div class="input-group">
							    <?
							    $wno = '';
							    if($num)
							        $wno = isset($cur->wno) ? $cur->wno : '';
							    ?>
								<div class="input-group-prepend"><span class="input-group-text">+91 </span></div>
								<input type="" name="wno" class="form-control" value="<?=$wno?>">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Align</label>
							<select class="form-control" name="walign">
							    <?
							    $wnoPos = 'left';
							    if($num)
							        $wnoPos  = isset($cur->walign) ? $cur->walign : '';
							    ?>
								<option <?=$wnoPos == 'left' ? 'selected' : '' ?> value="left">Left</option>
								<option <?=$wnoPos == 'right' ? 'selected' : '' ?> value="right">Right</option>
							</select>
						</div>
					</div>
				</div>
				<hr>
				<h4>Call Back Number <small>(Optional)</small></h4>
				<hr>
			
				<div class="row">
				    
				    <div class="col-md-2">
				        <div class="form-group">
				            <label>Icon</label>
				            <?
				            $selectImg = '1.png';
				            if($num){
				                 if(isset($cur->callBackNo))
                                        $selectImg = $cur->CallBackImg;
				            }
				            ?>
				            
				            <img src="<?=base_url?>/public/images/phone/<?=$selectImg?>" style="    width: 57%;    height: 5%;" class="form-control whatsIcon">
				        </div>
				    </div>
				    
				    <div class="col-md-2">
				        <div class="form-group">
				            <label>Select Icon</label>
				            <select class="form-control vodiapicker" onchange="$('.whatsIcon').attr('src','<?=base_url?>/public/images/phone/'+this.value)" name="CallBackImg">
                              <?
                              $images = ['png','png','png','png','png'];
                              $i = 1;
                              $chk = '';
                              foreach($images as $img)
                              {
                                  if($num)
                                      if(isset($cur->callBackNo))
                                        $chk = $cur->CallBackImg == $i.'.'.$img ? ' selected' : '';
                                  echo '<option value="'.$i.'.'.$img.'" '.$chk.'> W.P Image '.$i++.'</option>';
                              }
                              ?>
                            </select> 
				        </div>
				    </div>
				    
				    <div class="col-md-4">
				        <div class="form-group">
				            <label>Call Back Number</label>
				            <div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">+91 </span></div>
								<?
								$number = '';
								if($num)
								    $number = isset($cur->callBackNo) ? $cur->callBackNo : '';
								?>
								<input type="" name="callBackNo" class="form-control" value="<?=$number?>">
							</div>
				        </div>
				    </div>
				    
				    <div class="col-md-4">
						<div class="form-group">
							<label>Align</label>
							<?
							$colPos = 'left';
							if($num)
							    $colPos = isset($cur->callBackAlign) ? $cur->callBackAlign : '';
							?>
							<select class="form-control" name="callBackAlign">
								<option <?=$colPos == 'left' ? 'selected' : ''?> value="left">Left</option>
								<option <?=$colPos == 'right' ? 'selected' : ''?> value="right">Right</option>
							</select>
						</div>
					</div>
					
					
				    
				    
				</div>
				<div class="form-group">
					<button class="btn btn-success" type="submit">Save</button>
				</div>
			</form>
				
			</div>
		</div>
	</div>
</div>

<?php
$chatCode='';
$tagline='';
$address ='';
$time='';
$headerCode = '';
if($siteData->other)
{
	$d = json_decode($siteData->other);
	$chatCode=	isset($d->chatCode)?$d->chatCode:"";
	$tagline = isset($d->tagline)?$d->tagline:"";
	$address = isset($d->address)?$d->address:"";
	$time = isset($d->time)?$d->time:"";
	$headerCode = isset($d->headerCode) ? $d->headerCode : '';
}
?>

<div class="row">
	<div class="col-md-12">
		<form id="other">
		<div class="mb-12 card text-primary bg-white">
			<div class="card-header">Other Setting</div>
			<div class="card-body">
			    
			    <div class="form-group">
					<label>Header Code </label>
					<textarea name="headerCode" class="form-control" style="height: 150px;"><?=$headerCode?></textarea>
				</div>
				
				<div class="form-group">
					<label>Chat Code <small>(<a onclick="howto()"><u><b>How to Get Code</b></u></a>)</small></label>
					<textarea name="chatCode" class="form-control" style="height: 150px;"><?=$chatCode?></textarea>
				</div>

				<div class="form-group">
					<label>Website Tagline</label>
					<input type="text" value="<?=$tagline?>" class="form-control" name="tagline">
				</div>

				<div class="form-group">
					<label>Address</label>
					<input type="text" value="<?=$address?>" class="form-control" name="address">
				</div>

				<div class="form-group">
					<label>Service Time</label>
					<input type="text" value="<?=$time?>" class="form-control" name="time" placeholder="Example: Mon to Sat 08:00 - 16:30">
				</div>
				<div class="card-footer">
					<button class="btn btn-success">Save</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>


<script type="text/javascript">


$("#other").on("submit",function(ev)
{  // alert($(this).serialize());
	ev.preventDefault();	
	$("#load").show();
	$.ajax({
		url:'<?=site_url('Admin/website_setting')?>',
		type:'POST',
		data:$(this).serialize()+'&status=other',
		success:function(q)
		{	//alert(q);
		    $("#load").hide();
			toastr.success("Saved Successfully");
		}
	});
});



	$("#footerform").on("submit",function(ev){
		ev.preventDefault();
		$("#load").show();
				$.ajax({
						url:'<?=site_url('/Admin/website_setting')?>',
						type:'POST',
						data:$(this).serialize()+'&status=footer',
						success:function(q)
						{
							toastr.success("Footer Saved Sccessfully");
							$("#load").hide();
						}
				});
	}); 

	function howto()
	{
		window.open("https://www.tawk.to/knowledgebase/getting-started/adding-a-widget-to-your-website/", "mywindow","location=1,status=1,scrollbars=1, width=600,height=700");
		//window.open(,'How to add live chat widget to your website','width=500,height=500');
	}
</script>



<?php
require_once 'footer.php';
?>