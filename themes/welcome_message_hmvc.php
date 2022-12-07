<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to HMVC</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1><?  echo $heading; ?></h1>

	<div id="body">
	    <?
	    /*
        <p>Это вид в template. Посмотреть  <a href="<?php echo base_url('admin'); ?>">АДМИНКА</a></p>
        <p>&nbsp;&nbsp;<a href="<?  echo $url; ?>" title="<? echo $name; ?>" target="_blank"><? echo $compani; ?></a>
        <br /><img style="border-radius: 50%;" src="<? echo $gavatar; ?>" />
        </p>
        
        <p>default_controller срабатывающий призагрузке прописан в файле:</p>
		<code>system/apps/routes.php</code>

		<p>Контроллер обрабатывающий этот вывод:</p>
		<code>modules/welcome/controllers/Welcome.php</code>

		<p>Вид размещен:</p>
		<code>themes/welcome_message_hmvc.php</code>

        <p>Ну а это вызов модуля по HMVC</p>
        <code><?php echo Modules::run('modules/frontend/hmvc'); ?></code>
        */
        ?>
	</div>

	<p class="footer">Elapsed Time <strong>{elapsed_time}</strong> Environment <?php echo  (ENVIRONMENT === 'development') ?  ' HMVC <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>