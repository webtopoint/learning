<?

require_once 'header.php';

?>


<div class="app-page-title">

                            <div class="page-title-wrapper">

                                <div class="page-title-heading">

                                    <div class="page-title-icon">

                                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

                                        </i>

                                    </div>

                                    <div>Add Carousel

                                         
                                    </div>

                                </div>  
                                <div class="page-title-actions">
							        <button class="btn btn-success manage-images">Manage Images</button>
						                                   
						        </div>

                            </div>
</div>  




<div class="row">

	<div class="col-md-12">
		<form action="<?=site_url('Admin/add-carousel')?>" class="needs-validation" method="post" enctype="multipart/form-data">

		<div class="mb-3 text-center card main-card">

			<div class="card-header">

				<h5>Add Carousel</h5>
 				
			</div>

            <div class="card-body" align="left">
	            <div class="form-group">
	            	<label>Carousel Name</label>
	                <input type="text" name="carousel_name" placeholder="Enter Carousel Name.." class="form-control" required="">
	           	</div>
	            
	            <div class="form-group">
	            	<label>Image view per slide</label>
	                <select name="per_slide" class="form-control">
	                	<option>1</option>
	                	<option>2</option>
	                	<option>3</option>
	                	<option>4</option>
	                	<option>5</option>
	                	<option>6</option>
	                	<option>7</option>
	                	<option>8</option>
	                	<option>9</option>
	                	<option>10</option>
	                </select>
	           	</div>
	           	<div class="form-group">
	            	<label>Slide Speed</label>

	                <select name="speed" class="form-control">
	                	<option value="verySlow">Very Slow</option>
	                	<option value="slow">Slow</option>
	                	<option value="normal" selected>Normal</option>
	                	<option value="fast">Fast</option>
	                	<option value="veryFast">Very Fast</option>
	                </select>
	           	</div>
	           	 <div class="form-group">
	            	<label>Carousel Height</label>
	                <input type="number" name="height" placeholder="Carousel Height (In px) " class="form-control" required="" value="400">
	           	</div>
	         
	           	<div class="form-group imglist">
	           	</div>
	           	<!--div class="form-group">
	               <button class="btn btn-info addImg pull-left" type="button">Add Images to Carousel</button>
	            </div-->
	            <div class="form-group">
                	<label class="control-label col-md-3">Select Image</label>
                	<div class="col-md-12">
                		<div class="">
                			<div id="coba" class="row row-sm"></div>
                		</div>
                	</div>
                	<script type="text/javascript" src="<?=base_url?>/public/spartan-multi-image-picker.js"></script>
<script type="text/javascript">
		$(function(){

			$("#coba").spartanMultiImagePicker({
				fieldName:        'imgs[]',
				maxCount:         50,
				rowHeight:        '200px',
				groupClassName:   'col-md-3 col-sm-3 col-xs-6',
				maxFileSize   :      '',
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

           </div>

            <div class="card-footer	">

            	<button class="btn btn-outline-focus" type="submit"  style="width: 100%">

					<i class="pe-7s-paper-plane"></i> Add

				</button>

            </div>

        </div></form>

	</div>
<?php
$car = $this->SiteModel->getAllCarousel();
?>

		<div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Total Carousel : <?=$car->num_rows()?></h5>
                    <table class="mb-0 table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Carouse Name</th>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                      <?php
                      $i=1;
                      foreach ($car->result() as $res)
                      {
                      		$imgs = $res->images?json_decode($res->images):array();
                      		$l="";
                      		foreach ($imgs as $img)
                      		{
                      			$l.='<img width="40" class="rounded-circle" src="'.$img.'" alt="">';
                                                           // <a href='".$img."' target='_blank' class='label label-success'>".$img."</a><br>";
                      		}
                      	echo'<tr>
                            <th scope="row">'.$i++.'</th>
                            <td>'.$res->name.'</td>
                            <td>'.$l.'</td>
                            <td><div class="dropdown d-inline-block">

                                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-focus">Action</button>

                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 34px, 0px);">

                                                <a href="'.site_url('admin/edit-carousel/'.AJ_ENCODE($res->id)).'"><button type="button" tabindex="0" class="dropdown-item"><i class="fa fa-edit"></i> Edit</button></a>

                                                <button type="button" tabindex="0" class="dropdown-item" onclick="delCar('.$res->id.',this)"><i class="fa fa-trash"></i> Delete</button>

                                            </div>

                            </div></td>
                       	 </tr>';
                      }
                        
                      ?>
                        </tbody>
                    </table>
                </div>
            </div>
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