<?
require_once 'includes/'.FileDirecory.'/header.php';

//===========visit counter===================//
$CI = & get_instance();
$CI->load->helper('cookie');

$min=60;
$hour=3600;
$day=86400;

if(!$val = get_cookie('visitcounter'))
{
	set_cookie('visitcounter','true',$day,$_SERVER['HTTP_HOST'],'/');
	$CI->WidgetModel->siteVisit();
}


//=============================================//

$post = $postData->row();

$rw=$lw=0;
$x=12;
if($leftSide->num_rows())
	$lw=2;
if($rightSide->num_rows())
	$rw=2;
$cw=$x-$lw-$rw;

?>

<div class="container-fluid" style="padding-top: 10px;overflow: hidden;padding: 14px;">
	<div class="row">
		
			<?php
				if($leftSide->num_rows())
				{	echo'<div class="col-sm-'.$lw.'" style="padding: 5px;">';
					foreach ($leftSide->result() as $le)
					{
							echo getWidget($le->widget_id);
					}
					echo'</div>';
				}
				
			?>

		<div class="col-sm-<?=$cw?>"><?php 
			echo '<center><h1>'.$post->data_title.'</h1></center>';
			echo $post->data;
		?></div>

		
			<?php
				if($rightSide->num_rows())
				{
					echo'<div class="col-sm-'.$rw.'" style="padding: 5px;">';
					foreach ($rightSide->result() as $re)
					{
						echo getWidget($re->widget_id);
					}
					echo'</div>';
				}
			?>
		</div>
	</div>
</div>

<?php
require_once 'includes/'.FileDirecory.'/footer.php';
	
?>