
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-bar">
				<div class="page-title-breadcrumb">
					<div class=" pull-left">
						<div class="page-title"><?=$pagename?></div>
					</div>
					<ol class="breadcrumb page-breadcrumb pull-right">
						<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
								href="<?=base_url()?>">ภาพรวม</a>&nbsp;<i class="fa fa-angle-right"></i>
						</li>
						<li class="active"><?=$pagename?></li>
					</ol>
				</div>
			</div>
					
					
			<div class="card card-boxz">
				<div class="card-head">
					<header><a href="<?=base_url()?>admin/web_contactus/edit" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a></header>				
				</div>	
				<div class="card-body">
					<?=$rs[0]->site_contactus?>
				</div>
			</div>
		</div>
	</div>