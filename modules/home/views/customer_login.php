<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url('public/login/')?>images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/')?>css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<!--===============================================================================================-->
<style type="text/css">.input100{color:white;}</style>
</head> 
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?=site_url('/public/login/')?>images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50" >
				<span class="login100-form-title p-b-41">
					Admin Login
				</span>
				<div class="message"></div>
				<form autocomplete="off" action="<?=site_url('/customer-login')?>" method="post" class="login100-form validate-form p-b-33 p-t-5" style="background-color: rgb(0,0,0,0.9);box-shadow:0 0 20px 0 black inset" autocomplete="off">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="email" name="username" placeholder="User name" autofocus="" autocomplete="false">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password" autocomplete="false">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login 
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="<?=base_url('public/login/')?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/')?>vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/')?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?=base_url('public/login/')?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/')?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/')?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=base_url('public/login/')?>vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/')?>vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/')?>js/main.js"></script>
    
</body>
</html>