<?

require_once 'header.php';

$car = $this->SiteModel->getCarousel(array('id'=>$carid));

if(!$car->num_rows())
{
	echo'<div class="alert alert-daner">Sorry No Carousel Found</div>';
}
$car = $car->row();
$de = json_decode($car->details);

?>


<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Edit Carousel

                                         
                                    </div>

                                </div>  
                                <div class="page-title-actions">
							        <button class="btn btn-success manage-images">Manage Images</button>
						                                   
						        </div>

                            </div>
</div>  




<div class="row">

	<div class="col-md-12">
		<form action="<?=site_url('Admin/edit-carousel/'.AJ_ENCODE($carid))?>" class="needs-validation" method="post" enctype="multipart/form-data">

		<div class="mb-3 text-center card main-card">

			<div class="card-header">

				<h5>Edit Carousel</h5>
 				
			</div>

            <div class="card-body" align="left">
	            <div class="form-group">
	            	<label>Enter Carousel Name</label>
	                <input type="text" name="carousel_name" placeholder="Enter Carousel Name.." class="form-control" required="" value="<?=$car->name?>">
	           	</div>
	            
	          	<div class="form-group">
	              
	           	</div>
	           	<div class="form-group imglist">
	           		<?php
	           //		if($car->images)
	           //		{	$i=1;
	           //			foreach (json_decode($car->images) as $img)
		          // 		{
		          // 			echo'<div><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">'.$i.' </span></div><input type="text" class="form-control" name="imgs[]" placeholder="Enter Image Link" required="" value="'.$img.'"><div class="input-group-append" onclick="viewImg(this)"><span class="input-group-text  bg-info text-white">view</span></div><div class="input-group-append" onclick="rmImg(this)"><span class="input-group-text  bg-danger text-white"><i class="fa fa-trash"></i></span></div></div><div class="view_box" onclick="$(this).html(\'\')"></div></div>';	
		          // 			$i++;
		          // 		}
	           //		}
	           		?>	
	           	</div>
	           		<div class="form-group">
                	<label class="control-label col-md-3">Select Image</label>
                	<div class="col-md-12">
                		<div class="">
                			<div id="coba" class="row row-sm">
                			    	<?php
                			    	$ttl = 0;
	           		if($car->images)
	           		{	$i=50;
	           		
	           			foreach (json_decode($car->images) as $img)
		           		{
		           			//echo'<div><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">'.$i.' </span></div><input type="text" class="form-control" name="imgs[]" placeholder="Enter Image Link" required="" value="'.$img.'"><div class="input-group-append" onclick="viewImg(this)"><span class="input-group-text  bg-info text-white">view</span></div><div class="input-group-append" onclick="rmImg(this)"><span class="input-group-text  bg-danger text-white"><i class="fa fa-trash"></i></span></div></div><div class="view_box" onclick="$(this).html(\'\')"></div></div>';	
		           			echo '<div class="col-md-3 col-sm-3 col-xs-6 spartan_item_wrapper" data-spartanindexrow="'.$i.'" style="margin-bottom : 20px; ">
                			        <div style="position: relative;">
                			            <div class="spartan_item_loader" data-spartanindexloader="'.$i.'" style=" position: absolute; width: 100%; height: 200px; background: rgba(255,255,255, 0.7); z-index: 22; text-align: center; align-items: center; margin: auto; justify-content: center; flex-direction: column; display : none; font-size : 1.7em; color: #CECECE">
                			            <i class="fas fa-sync fa-spin"></i>
                			            </div>
                			            <label class="file_upload" style="width: 100%; height: 200px; border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; display: flex; align-items: center; margin: auto; justify-content: center; flex-direction: column;">
                			               <a href="javascript:void(0)" data-spartanindexremove="'.$i.'" style="right: 3px; top: 3px; background: rgb(237, 60, 32); border-radius: 3px; width: 30px; height: 30px; line-height: 30px; text-align: center; text-decoration: none; color: rgb(255, 255, 255); position: absolute !important;" class="spartan_remove_row">
                			                <i class="fas fa-times"></i>
                			                </a>
                			                <img style="width: 100%; margin: 0px auto; vertical-align: middle; display: none;" data-spartanindexi="'.$i.'" src="'.base_url.'/public/placeholder.png" class="spartan_image_placeholder"> 
                			                <p data-spartanlbldropfile="'.$i.'" style="color : #5FAAE1; display: none; width : auto; ">Drop Here</p>
                			                <img style="width: 100%; vertical-align: middle;" class="img_" data-spartanindeximage="'.$i.'" src="'.$img.'">
                			                <input class="form-control spartan_image_input" accept="image/*" data-spartanindexinput="'.$i.'" style="display : none" name="imgs[]" type="text" value="'.$img.'">
                			                </label> 
                			             </div>
                			     </div>';
		           			$i--;
		           			$ttl++;
		           		}
	           		}
	           		?>
                			    
                			</div>
                		</div>
                	</div>
                	<script type="text/javascript" src="<?=base_url?>/public/spartan-multi-image-picker.js"></script>
                    <script type="text/javascript">
                    		$(function(){
                    
                    			$("#coba").spartanMultiImagePicker({
                    				fieldName:        'imgs[]',
                    				maxCount:         <?=50-$ttl?>,
                    				rowHeight:        '200px',
                    				groupClassName:   'col-md-3 col-sm-3 col-xs-6',
                    				maxFileSize:      '',
                    				placeholderImage: {
                    				    image: '<?=base_url?>/public/placeholder.png',
                                    	width : '100%'
                    				},
                    				dropFileLabel : "Drop Here",
                    				onAddRow:       function(index){
                    					console.log(index);
                    					console.log('add new row');
                    				},
                    				onRenderedPreview : function(index){
                    					console.log(index);
                    					console.log('preview rendered');
                    				},
                    				onRemoveRow : function(index){
                    					console.log(index);
                    				},
                    				onExtensionErr : function(index, file){
                    					console.log(index, file,  'extension err');
                    					alert('Please only input png or jpg type file')
                    				},
                    				onSizeErr : function(index, file){
                    					console.log(index, file,  'file size too big');
                    					alert('File size too big');
                    				}
                    			});
                    		});
                    	</script>
                </div>
	           
	           	 <div class="form-group">
	            	<label>Image view per slide </label>

	                <select name="per_slide" class="form-control">
	                	<option <?=$de->perSlide=='1'?'selected':''?>>1</option>
	                	<option <?=$de->perSlide=='2'?'selected':''?>>2</option>
	                	<option <?=$de->perSlide=='3'?'selected':''?>>3</option>
	                	<option <?=$de->perSlide=='4'?'selected':''?>>4</option>
	                	<option <?=$de->perSlide=='5'?'selected':''?>>5</option>
	                	<option <?=$de->perSlide=='6'?'selected':''?>>6</option>
	                	<option <?=$de->perSlide=='7'?'selected':''?>>7</option>
	                	<option <?=$de->perSlide=='8'?'selected':''?>>8</option>
	                	<option <?=$de->perSlide=='9'?'selected':''?>>9</option>
	                	<option <?=$de->perSlide=='10'?'selected':''?>>10</option>
	                </select>
	           	</div>

	           	<div class="form-group">
	            	<label>Slide Speed</label>

	                <select name="speed" class="form-control">
	                	<option value="verySlow" <?=$de->speed=='verySlow'?'selected':''?>>Very Slow</option>
	                	<option value="slow" <?=$de->speed=='slow'?'selected':''?>>Slow</option>
	                	<option value="normal" <?=$de->speed=='normal'?'selected':''?>>Normal</option>
	                	<option value="fast" <?=$de->speed=='fast'?'selected':''?>>Fast</option>
	                	<option value="veryFast" <?=$de->speed=='veryFast'?'selected':''?>>Very Fast</option>
	                </select>
	           	</div>

	           	 <div class="form-group">
	            	<label>Carousel Height</label>
	                <input type="number" name="height" placeholder="Carousel Height (In px) " class="form-control" required="" value="<?=$de->height?>">
	           	</div>

	           	<!--<div class="form-group">-->
	            <!--   <button class="btn btn-info addImg pull-left" type="button">Add Images to Carousel</button>-->
	            <!--</div>-->

           </div>

            <div class="card-footer	">

            	<button class="btn btn-outline-focus" type="submit"  style="width: 100%">

					<i class="pe-7s-paper-plane"></i> Update

				</button>

            </div>

        </div></form>

	</div>

</div>
<script type="text/javascript">

	$(".addImg").on("click",function(){
		var k="''";
			$(".imglist").append('<div><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"> </span></div><input type="text" class="form-control" name="imgs[]" placeholder="Enter Image Link" required><div class="input-group-append" onclick="viewImg(this)"><span class="input-group-text  bg-info text-white">view</span></div><div class="input-group-append" onclick="rmImg(this)"><span class="input-group-text  bg-danger text-white"><i class="fa fa-trash"></i></span></div></div><div class="view_box" onclick="$(this).html('+k+')"></div></div>');
		
	arrenge();
	});

	function arrenge()
	{	
		var x = 1;
		var l = $(".imglist .input-group .input-group-prepend .input-group-text");
		for(x=1; x<=l.length;x++)
		{
			$(l[x-1]).html(x);
		}
	}
	function rmImg(ele)
	{
		$(ele).parent().remove();
		arrenge();
	}

	function viewImg(ip)
	{

		 var link  = $(ip).parent().find('input').val();	
		 //alert(link);
		$(ip).parent().parent().find('div.view_box').html("<img src='"+link+"' style='max-width:100%;'>");
	
	}


function delCar(carid,ele)
{
	if(confirm("Are you sure?"))
	{

		$.ajax({
			url:'<?=site_url("Admin/delete-carousel/")?>',
			type:'POST',
			data:{carid:carid},
			success:function(q)
			{
				toastr.success("Deleted Successfully");
				$(ele).parent().parent().parent().parent().hide(200);
			}

		});
	}
}


</script>

<?

require_once 'footer.php';

?>