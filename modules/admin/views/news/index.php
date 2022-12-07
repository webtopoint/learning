<?
include VIEWPATH.'admin/header.php';
?>
<style type="text/css">
	.card-body{
		overflow-x: hidden!important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<?
		if(file_exists(VIEWPATH.'admin/news/'.$page.'.php')){
			require VIEWPATH.'admin/news/'.$page.'.php';
		}
		else
			echo '<div class="alert alert-danger"><h1> Page not found. </h1></div>';

		?>
	</div>
</div>

<?
include VIEWPATH.'admin/footer.php';
?>