<?php
require_once 'header.php';
$data = $postData->row();
?>

<div class="mb-3 card">
    <div class="card-header-tab card-header">Edit Post</div>
    <div class="card-body">

	 	<form action="<?php site_url('admin/edit_post')?>" class="addWidgetData" method="post">
	      <input type="hidden" name="status" value="add_widget_data" >
	       <div class="col-md-12 mb-3">
	        <label>Enter Title</label>

	        <input type="text" name="data_title" class="form-control" placeholder="Enter Title" value="<?=$data->data_title?>">

	      </div>  

	      <div class="col-md-12 mb-3">
	        <label>Enter Content</label>

	        <textarea cols="80" id="aryaeditor" name="widget_data" rows="10"><?=$data->data?></textarea>

	      </div> 
	       <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Save</button>
	  	</form>
	</div>
</div>

<script type="text/javascript" src="<?=site_url('public/custom/ckeditor.js')?>"> </script>
<script type="text/javascript" src="<?=base_url.'/public/custom/add-widget.js'?>"></script>

<?php
require_once 'footer.php';
?>