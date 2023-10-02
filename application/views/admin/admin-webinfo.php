
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
					<header><a href="<?=base_url()?>admin/web_info/edit" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไขข้อมูล</a></header>				
				</div>	
				<div class="card-body">
					<form class="form-horizontal" method="post" role="form" id="web_info">
					
						<div class="form-group row">
							<div class="col-sm-2 text-right">Meta Title</div>
							<div class="col-sm-10 text-left"><?=$rs[0]->site_title?></div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2 text-right">Meta Keyword</div>
							<div class="col-sm-10 text-left"><?=$rs[0]->site_keyword?></div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2 text-right">Meta Description</div>
							<div class="col-sm-10 text-left"><?=$rs[0]->site_description?></div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2 text-right">Meta Image</div>
							<div class="col-sm-10 text-left"><img src="<?=base_url()?>uploads/images/<?=$rs[0]->site_picture?>" style="max-width:100%;max-height:250px;"></div>
						</div>
					
				</form>
				</div>
			</div>
		</div>
	</div>