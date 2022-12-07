<?php

require_once 'header.php';
$allPage= $this->SiteModel->list_page();
$form = $this->FormModel->getFormModel();
?>

<div class="app-page-title">

	<div class="page-title-wrapper">

	    <div class="page-title-heading">

	        <div class="page-title-icon">

	            <i class="pe-7s-note2 icon-gradient bg-mean-fruit">

	            </i>

	        </div>

	        <div>Add a Popup

	            <div class="page-title-subheading">

	            </div>

	        </div>

	    </div>  

	</div>

</div>

<form method="post" accept="">
<div class="main-card mb-3 card">
	<div class="card-header"> Add Popup </div>
	<div class="card-body">
		<div class="form-group">
			<label>Choose Page</label>
			<select class="form-control" name="page_id" required><option value="all">All</option>
				<?php

				foreach ($allPage->result() as $page)
					echo'<option value="'.$page->id.'">'.$page->page_name.'</option>';
			?>
			</select>
		</div>
		<div class="form-group">
			<label>What to show on Popup</label>
			<select class="form-control"  name="type" onchange="content_type(this)">
				<option value="data">Data</option>
				<option value="form">Form</option>
			</select>
		</div>
		<div class="form-group" id="databox">
			<label>Data</label>
			<textarea id="aryaeditor" name="data"></textarea>
		</div>
		<div class="form-group" id="formbox" style="display: none;">
			<label>Select Form</label>
			<select class="form-control" name="form_id" disabled="disabled">
			<?php
                foreach($form->result() as $data)
                    echo'<option value="'.$data->id.'">'.$data->title.'</option>';
            ?>
			</select>
		</div>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
				<label>Popup Height</label>
				<input type="" name="height" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Popup Width</label>
				<input type="" name="width" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label>Popup Frequency</label>
				<select name="frq" class="form-control" required>
						<option value="1">Every time</option>
						<option value="0">Once in a day</option>
				</select>
			</div>
		</div>
	</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-success">Save</button>
	</div>
</div>
</form>


<?php
$pop = $this->SiteModel->getPopup();
?>
<div class="main-card mb-3 card">
	<div class="card-header">Available Popup</div>
	<div class="card-body">
		<table class="table table-bordered table-striped">
			<tr><th>#</th><th>Type</th><th>Page</th><th>Details</th><th>Action</th></tr>
		
		<?php
		$i=1;
		foreach ($pop->result() as $res)
		{
			$d = '';
			foreach (json_decode($res->details) as $key => $value) 
			{
				if($key =='frq')
				{
					$key = 'Frequency';
					$value = $key=='0'?'Once in a Day':'Everytime';
				}
				$d.='<strong><small>'.strtoupper($key).'</small></strong> : '.$value.'<br>';
			}

			if($res->page_id=='all')
			{
				$pname = 'All';
			}
			else
			{
					$pag = $this->SiteModel->list_page($res->page_id);
					$p = $pag->row();
					$pname= $p->page_name;
			}
		
			echo'<tr><td>'.$i++.'</td><td>'.$res->type.'</td><td>'.$pname.'</td><td>'.$d.'</td><td><button class="btn btn-danger" onclick="del(this)" data-id="'.AJ_ENCODE($res->id).'"><i class="fa fa-trash"></i> Delete</button></td></tr>.';	
		}
		?>
		</table>
	</div>
</div>

<script type="text/javascript">
	function content_type(e)
	{ 
		if(e.value=='data')
		{
			$("#formbox").hide();
			$("select[name=form_id]").attr("disabled","disabled");
			
			$("#databox").show()
			$("textarea[name=data]").removeAttr("disabled");
		}
		else
		{
			$("#databox").hide();
			$("textarea[name=data]").attr("disabled","disabled");

			$("#formbox").show();
			$("select[name=form_id]").removeAttr("disabled");

		}
	}
	function del(e)
	{	
		if(confirm("Are you sure to Delete?"))
		{
			$.ajax({
				url:'<?=site_url('Admin/delete-popup')?>',
				type:'post',
				data:{id:$(e).data('id')},
				success:function(q)
				{
					$(e).parent().parent().hide(300);
					roastr.success("Popup Deleted");
				},
				error:function(u,v,w)
				{
					alert(w);
				}
			});
		}
	}
//CKEDITOR.replace('aryaeditor');
</script>

<script type="text/javascript" src="<?=base_url?>/public/custom/ckeditor.js"> </script>

<?php

require_once 'footer.php';

?>