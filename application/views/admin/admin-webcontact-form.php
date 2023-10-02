
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
					<header><a href="<?=base_url()?>admin/web_contactus/" class="btn btn-info"><i class="fa fa-undo"></i> กลับ</a></header>				
				</div>	
				<div class="card-body">
					<form class="form-horizontal" method="post" role="form">
						<div class="form-group row">
							<div class="col-sm-12">
								<textarea class="summernote" name="site_contactus"><?=$rs[0]->site_contactus?></textarea>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-12">
								<button type="submit" d="btn_submit" class="btn btn-info m-r-20">บันทึก</button>
								<a href="javascript:history.back()" class="btn btn-default">ยกเลิก</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>