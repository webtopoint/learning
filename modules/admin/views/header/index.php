<?php
$this->load->view('header');//.php';
?>
<style type="text/css">
	.card-body{
		overflow-x: hidden!important;
	}
	 
        .wrapper {
             width: 100%;
            height:100%;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            padding:0;
            margin:0;
            padding:10px 0 0 ;
            border:3px dashed #3f6ad8;
            background:white;
        }
        .wrapper div {
            border:3px solid red;
            height:100%;
        }
        .drop-li {
            width: 100%;
            border: 1px solid black;
            padding: 7px;
            margin:0;
        }
        .drop-delete{
            height: 200px;
            background: red;
            width: 100%;
            text-align: center;
            top: 0;
            z-index: 9999999;
            border: 1px groove black;
            display:none;
            color:white;
            font-size:40px;
        }
        .col-md-3.drag.ui-draggable {
            border: 1px solid gray;
            padding: 10px;
            border-radius: 28px;
        }
</style>
<div class="row">
	<div class="col-md-12">
		<?
		if(_view_exists('admin','header/'.$page)){
			 $this->load->view('header/'.$page);//.php';
		}
		else
			echo '<div class="alert alert-danger"><h1> Page not found. </h1></div>';

		?>
	</div>
</div>

<?
$this->load->view('footer');
?>