	<?php $users = $this->session->userdata('admin_logged_in');?>
	<div class="sidebar-container">
				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div id="remove-scroll" class="left-sidemenu">
						<ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
							data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
							<li class="sidebar-toggler-wrapper hide">
								<div class="sidebar-toggler">
									<span></span>
								</div>
							</li>
							<li class="sidebar-user-panel">
								<div class="user-panel">
									<div class="pull-left image">
										<img src="https://cdn4.iconfinder.com/data/icons/avatars-xmas-giveaway/128/batman_hero_avatar_comics-512.png" class="img-circle user-img-circle"
											alt="User Image" />
									</div>
									<div class="pull-left info">
										<p> <?=$users["display"]?></p>
										<a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline">
												Online</span></a>
									</div>
								</div>
							</li>

							<li class="nav-item start <?=$page=="index"?'active':''?>">
								<a href="<?=base_url('admin')?>" class="nav-link"> <i class="material-icons">dashboard</i>
									<span class="title">หน้าแรก</span>
								</a>
							</li>
							
							<li class="nav-item start <?=$page=="content"?'active':''?>">
								<a href="javascript:;" class="nav-link nav-toggle">
									<i class="material-icons">subtitles</i>
									<span class="title">โพส </span>
									<span class="arrow"></span>
								</a>
								<ul class="sub-menu">
									<li class="nav-item <?=$pagesub=='content'?'active':''?>"><a href="<?=base_url()?>admin/section/1" class="nav-link "><span class="title">เนื้อหา</span></a></li>
									<li class="nav-item <?=$pagesub=='category'?'active':''?>"><a href="<?=base_url()?>admin/category" class="nav-link "><span class="title">หมวดหมู่</span></a></li>
								</ul>
							</li>
							<li class="nav-item <?=$page=="report"?'active':''?>">
								<a href="<?=base_url('admin/report')?>" class="nav-link"> <i class="material-icons">report</i>
									<span class="title">รายงาน วช.</span>
								</a>
							</li>
							<li class="nav-item <?=$page=="site_api"?'active':''?>">
								<a href="<?=base_url('admin/site_api')?>" class="nav-link"> <i class="material-icons">data_usage</i>
									<span class="title">APIs</span>
								</a>
							</li>
							<li class="nav-item <?=$page=="site_alertmessage"?'active':''?>">
								<a href="<?=base_url('admin/alertmessage')?>" class="nav-link"> <i class="material-icons">data_usage</i>
									<span class="title">alertmessage</span>
								</a>
							</li>
							<li class="nav-item <?=$page=="site_history"?'active':''?>">
								<a href="<?=base_url('admin/site_history')?>" class="nav-link"> <i class="material-icons">history</i>
									<span class="title">ประวัติการใช้งาน</span>
								</a>
							</li>
							
							
							
						</ul>
					</div>
				</div>
			</div>