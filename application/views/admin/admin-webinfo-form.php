
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
							<div class="col-sm-10 text-left">
								<input type="text" class="form-control" name="site_title" value="<?=$rs[0]->site_title?>">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2 text-right">Meta Keyword</div>
							<div class="col-sm-10 text-left">
								<input type="text" class="form-control" name="site_keyword" value="<?=$rs[0]->site_keyword?>" data-role="tagsinput">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2 text-right">Meta Description</div>
							<div class="col-sm-10 text-left">
								<textarea class="form-control" rows="3" name="site_description"><?=$rs[0]->site_description?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-2 text-right">Meta Image</div>
							<div class="col-sm-10 text-left">
								<?php if(!empty($rs[0]->site_picture)){ ?>
											<div id="image_cover_show">
												<img src="<?=base_url()?>uploads/images/<?=$rs[0]->site_picture?>" style="max-width:100%;max-height:250px;"><br/>
												<button type="button" id="remove_image_cover" class="btn btn-default btn-sm" style="margin-top:10px;">
												<i class="fa fa-trash-o"></i> Remove Image</button>
											</div>
									<?php	} ?>

								<div id="dropzone" name="site_picture" class="dropzone" <?php if(!empty($rs[0]->site_picture)){echo 'style="display:none;"';}?>></div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="offset-md-2 col-md-10">
								<input type="hidden" name="h_image" id="h_image" value="<?=$rs[0]->site_picture?>">
								<button type="submit" id="btn_submit" class="btn btn-primary">บันทึก</button>
								<a href="javascript:history.back()" class="btn btn-default">ยกเลิก</a>
							</div>
						</div>
					
				</form>
				</div>
			</div>
		</div>
	</div>