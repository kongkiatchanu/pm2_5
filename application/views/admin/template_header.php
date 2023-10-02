<?php $users = $this->session->userdata('admin_logged_in');?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template" />
	<meta name="author" content="SmartUniversity" />
	<title><?=$this->config->item('title_name')?></title>
	<!-- google font -->

	<!-- icons -->
	<link href="<?=base_url('assets/css/')?>fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/css/')?>fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/css/')?>fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
	<!--bootstrap -->
	<link href="<?=base_url('assets/')?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/plugins/dropzone/dropzone.css" rel="stylesheet"/>
	<link href="<?=base_url('assets/')?>plugins/summernote/summernote.css" rel="stylesheet">

	<link href="<?=base_url('assets/')?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" media="screen">
	<!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/')?>plugins/material/material.min.css">
	<link rel="stylesheet" href="<?=base_url('assets/')?>css/material_style.css">
	<!-- inbox style -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/tagsinput/bootstrap-tagsinput.css"/>
	<link href="<?=base_url('assets/')?>plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/')?>css/pages/inbox.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/')?>css/pages/inbox.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme Styles -->
	<link href="<?=base_url('assets/')?>css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
	<link href="<?=base_url('assets/')?>css/plugins.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/')?>css/theme/light/style.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/')?>css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/')?>css/theme/light/theme-color.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/')?>css/custom.css" rel="stylesheet" type="text/css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="<?=base_url('assets/')?>img/favicon.ico" />

</head>
<!-- END HEAD -->

<body
	class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
	<div class="page-wrapper">
		<!-- start header -->
		<div class="page-header navbar navbar-fixed-top">
			<div class="page-header-inner ">
				<!-- logo start -->
				<div class="page-logo">
					<a href="<?=base_url()?>admin">
						<span class="logo-default">NRCT</span> </a>
				</div>
				<!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
				</ul>

				<!-- start mobile menu -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span></span>
				</a>
				<!-- end mobile menu -->
				<!-- start header menu -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<li><a href="javascript:;" class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>
						
						<!-- start message dropdown -->
						<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
								data-close-others="true">
								<i class="fa fa-envelope-o"></i>
								<?php if($rsInbox[0]->total_row>0){?>
								<span class="badge headerBadgeColor2"> <?=$rsInbox[0]->total_row?> </span>
								<?php }?>
							</a>
							<ul class="dropdown-menu">
								<li class="external">
									<h3><span class="bold">ข้อความ</span></h3>
									<?php if($rsInbox[0]->total_row>0){?>
									<span class="notification-label cyan-bgcolor"><?=$rsInbox[0]->total_row?> รายการ</span>
									<?php }?>
								</li>
								<li>
									<ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
									<?php foreach($rsInboxAll as $val){?>
										<li>
											<a href="<?=base_url()?>admin/contact/view/<?=$val->idcontact?>">
												<span class="photo">
													<img src="/assets/img/prof/prof2.jpg" class="img-circle" alt="">
												</span>
												<span class="subject">
													<span class="from"> <?=$val->contact_name?> </span>
													<span class="time"><?=get_time_ago(strtotime($val->contact_datetime))?> </span>
												</span>
												<span class="message"> <?=mb_substr($val->contact_message,0,100,'utf-8')?> </span>
											</a>
										</li>
									<?php }?>
									</ul>
									<div class="dropdown-menu-footer">
										<a href="<?=base_url()?>admin/contact"> ดูทั้งหมด </a>
									</div>
								</li>
							</ul>
						</li>
						<!-- end message dropdown -->
						<!-- start manage user dropdown -->
						<li class="dropdown dropdown-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
								data-close-others="true">
								<img alt="" class="img-circle " src="https://cdn4.iconfinder.com/data/icons/avatars-xmas-giveaway/128/batman_hero_avatar_comics-512.png" />
								<span class="username username-hide-on-mobile"> <?=$users["display"]?> </span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="<?=base_url()?>admin/profile">
										<i class="icon-user"></i> โปรไฟล์ </a>
								</li>
								<li>
									<a href="<?=base_url()?>admin/logout">
										<i class="icon-logout"></i> ออกจากระบบ </a>
								</li>
							</ul>
						</li>
						<!-- end manage user dropdown -->

					</ul>
				</div>
			</div>
		</div>