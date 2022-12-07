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

	        <div> Change Password

	            <div class="page-title-subheading">

	            </div>

	        </div>

	    </div>  

	</div>

</div>

<form method="post" accept="">
<div class="main-card mb-3 card">
	<div class="card-header">Change Password</div>
	<div class="card-body">
		<div class="form-group">
			<label>Current Password</label>
			<input type="password" name="current_pass" placeholder="Enter Current Password" class="form-control">
		</div>
		<div class="form-group">
			<label>New Password</label>
			<input type="password" name="new_pass" placeholder="Enter New Password" class="form-control">
		</div>
	</div>
	<div class="card-footer">
		<button type="submit" class="btn btn-success">Change Password</button>
	</div>
</div>
</form>


<?php

require_once 'footer.php';

?>