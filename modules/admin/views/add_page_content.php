<?php

require_once 'header.php';
?>



<div class="app-page-title">

    <div class="page-title-wrapper">

        <div class="page-title-heading">

            <div class="page-title-icon">

                <i class="pe-7s-file icon-gradient bg-mean-fruit">

                </i>

            </div>

            <div>Page Content Area

                <div class="page-title-subheading">

                </div>

            </div>

        </div>   

    </div>

</div>  



	<form action="" method="post" class="mb-3 text-left card main-card" enctype="multipart/form-data">

<div class="row">
    	<div class="col-md-8">
    
    <?php
    $page = $this->SiteModel->list_page(AJ_DECODE($pageid));
    $page = $page->row();
   
    if(!isset($page->link))
    {
    	$pageData = $this->SiteModel->getPageData(AJ_DECODE($pageid));
    
    	$data = $pageData->row();
    
    	$key  = strlen($data->keywords)?implode(',',json_decode($data->keywords)):"";
    ?>
    
    
    		
    
    				<div class="card-body">
    
    					<input type="hidden" name="status" value="content">
    					<div class="form-group">
    
    						<label><strong>Page Name</strong></label>
    
    						<input type="text" name="page_name" class="form-control bg-warning" value="<?=$page->page_name?>">
    
    					</div>
    
    					<div class="form-group">
    
    						<label>Add Keywords for Page</label>
    
    						<input id="keywords" type="text" name="keywords" class="form-control" value="<?=$key?>">
    
    					</div>
    
    					<!--div class="form-group">
    
    						<label>Enter Title</label>
    
    						<input type="text" name="page_title" class="form-control" placeholder="Enter Title" value="<?=$data->title?>">
    
    					</div-->
    
    
    
    
    
    					<div class="form-group">
    
    						<label>Add Page Heading Background Image</label>
    
    						<input type="file" name="heading_image" class="form-control" onchange="readURL(event)" accept="image/*" placeholder="Enter Image Link" value="" >
    
    					</div>
    
    					<div class="form-group">
    
    						<label>Heading Background Image height</label>
    
    						<input type="number" name="heading_height" class="form-control" placeholder="Enter height" value="<?=$data->heading_height?>" onkeyup="viewDemo()">
    
    					</div>					
    
    					<!--div class="form-group">
    
    						<label>Add Page Heading</label>
    
    						<input type="text" name="heading" class="form-control" placeholder="Enter Heading" value="<?=$data->heading?>" onkeyup="viewDemo()">
    
    					</div-->
    
                        <?php
                        $src = ''; $btnDisplay = 'none';$height='0px'; $is_file = 0;
                        if($data->heading_image){
                            $src = 'src="'.base_url.'/public/temp/'.CLIENT_ID.'/'.$data->heading_image.'" style="width:100%;height:100%"';
                            $btnDisplay = 'block';
                            $height = $data->heading_height.'px';
                            $is_file = 1;
                        }
                        ?>
    					<div class="form-group Hdemo " style="background-size:100% 100%; width: 100%;height:<?=$height?>" align="center">
    					    <!--h3 style="position: absolute;color: white;font-size: 41px;left: 100px;margin-top:10px"></h3-->
    					    <button class="btn btn-danger btn-sm btn-xs remove-image" type="button" style="position:absolute;right: 10px;margin-top: -10px;display:<?=$btnDisplay?>"><i class="fa fa-trash"></i></button>
                            <img alt <?=$src?>>
                            <input class="is_file" type="hidden" name="is_file" value="<?=$is_file?>">
    					</div>
    
    					<script type="text/javascript">
    					var height = '0px';
    						function viewDemo()
    						{	//var link = $("input[name=heading_image]").val();
    							 height = $("input[name=heading_height]").val()+'px';
    							var text = $("input[name=heading]").val();
    							
    							//$('.Hdemo').css('background-image','url('+link+')');
    							$('.Hdemo').css('height',height);
    							//$('.Hdemo h3').html(text);
    						}
        					function readURL(event){
                                 var getImagePath = URL.createObjectURL(event.target.files[0]);
                                 console.log(getImagePath);
                                 $('.remove-image').show();
                                 $("input[name=heading_height]").val(100);
                                 $('.Hdemo').css('height','100px');
                                 $('.is_file').val(1);
                                 $('.Hdemo img').attr('src', getImagePath).css({'height':'100%','width':'100%'});
                            }
                            $('.remove-image').click(function(){
                                $("input[name=heading_height]").val('');
                                $("input[name=heading]").val('');
                                $("input[name=heading_image").val('');
                                //$('.Hdemo h3').html('');
                                $('.is_file').val(0);
                                $('.Hdemo img').removeAttr('src').css({'height':'0%','width':'0%'}).parent().css('height','0px');;
                                $(this).hide();
                            });
    					</script>
    
    					
    
    				</div>
    
    <script type="text/javascript">
    
    $("#keywords").tagsInput({
       'height':'100px',
       'width':'100%',
       'interactive':true,
       'defaultText':'Add',
       'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
       'removeWithBackspace' : true,
       'placeholderColor' : '#666666'
    });
     	
    </script>
        <?php
       
    }
    else	
    {
    ?>
    
    				<div class="card-body">
    					<input type="hidden" name="status" value="link">
    					<div class="form-group">
    
    						<label><strong>Page Name</strong></label>
    
    						<input type="text" name="page_name" class="form-control bg-warning" value="<?=$page->page_name?>">
    
    					</div>
    					<div class="form-group">
    
    						<label>Enter Link</label>
                            
    						<input type="text" name="link" class="form-control"  value="<?=$page->link?>">
    
    					</div>
    
    					
    				</div>
    <?php
    }
    ?>
    	</div>
    	
    
    
    
    	<div class="col-md-4">
    
    		<div class="mb-3 text-center card main-card">
    
    			<div class="card-header">
    
    				<button class="btn btn-outline-focus"  style="width: 100%" onclick="$('form').submit()">
    
    					<i class="pe-7s-paper-plane"></i> Publish
    
    				</button>
    
    			</div>
    
                <div class="card-body">
    
                     <!--button class="btn btn-success manage-images">Manage Images</button-->
                     <?php
                            $chk = ($page->redirection)
                                    ? $chk = 'checked' 
                                    : '';
                            
                     ?>
                    <label>
                        <input type="checkbox" name="redirection" <?=$chk?> > Redirect A New Page
                    </label>
                </div>
    
            </div>
    
    	</div>
	<?php
	if(!isset($page->link)){
	    ?>
	    <div class="col-md-12">
	        <div class="form-group">
    
				<label>Enter Content</label>

				<textarea cols="80" id="aryaeditor" class="texteditor" name="editor2" rows="10"><?=$data->content?></textarea>

			</div>
	    </div>
	                
    	<?php
                        if(isCustom){
                            echo Modules :: run('settings/tinymce',$data);
                        }
                        else{
                        ?>
                        <script type="text/javascript" src="<?=site_url('public/custom/ckeditor.js')?>"> </script>
                        
                        
                        <?php
                        }
	    
	}
	
	?>
	

</div>

	</form>
	
<script type="text/javascript">$('.page_setting').addClass('mm-active');

    $('.all_pages').addClass('mm-active');
    setInterval(function(){
        $('.app-container').addClass('closed-sidebar');
    },500);
</script>

<?php

require_once 'footer.php';

?>