<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template" />
	<meta name="author" content="RedstarHospital" />
	<title><?=$this->config->item('title_name')?> | Login</title>
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Sarabun:400,300,600,700&subset=all" rel="stylesheet"
		type="text/css" />
	<!-- icons -->
	<link href="<?=base_url()?>assets/css/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/iconic/css/material-design-iconic-font.min.css">
	<!-- bootstrap -->
	<link href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- style -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/pages/extra_pages.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="<?=base_url()?>assets/img/favicon.ico" />
</head>

<body style="font-family:sarabun;">
	<div class="limiter">
	
		<div class="container-login100 page-background">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?=base_url()?>admin/login/" method="post">
					<p style="text-align: center;"><img alt="" src="/template/image/logo-nrct.svg" style="max-width:70%;"></p>
					<span class="login100-form-title p-b-34 p-t-27">
						กรุณาเข้าสู่ระบบ
					</span>
					<div class="text-center"><?php echo validation_errors(); ?></div>
					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="ชื่อผู้ใช้">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="รหัสผ่าน">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							ยืนยันการเข้าสู่ระบบ
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- start js include path -->
	<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js?v=1"></script>
	<!-- bootstrap -->
	<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js?v=1"></script>
	<script src="<?=base_url()?>assets/js/pages/extra-pages/pages.js?v=1"></script>
	<!-- end js include path -->
</body>

</html>