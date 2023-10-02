<?php 
$menu_id=null;
$menu_name="";
$menu_subname="";
$menu_button_text="";

$menu_name_en="";
$menu_subname_en="";
$menu_button_text_en="";
$menu_type="";
$menu_target="";
$menu_color_primary="";
$menu_color_secondary="";
$menu_color_bg="";
$createdadte="";
$is_show="";
if($rs!=null){
$menu_id=$rs[0]->menu_id;
$menu_name=$rs[0]->menu_name;
$menu_subname=$rs[0]->menu_subname;
$menu_button_text=$rs[0]->menu_button_text;
$menu_name_en=$rs[0]->menu_name_en;
$menu_subname_en=$rs[0]->menu_subname_en;
$menu_button_text_en=$rs[0]->menu_button_text_en;
$menu_type=$rs[0]->menu_type;
$menu_target=$rs[0]->menu_target;
$menu_color_primary=$rs[0]->menu_color_primary;
$menu_color_secondary=$rs[0]->menu_color_secondary;
$menu_color_bg=$rs[0]->menu_color_bg;
$createdadte=$rs[0]->createdadte;
$is_show=$rs[0]->is_show;
}
	


?>
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
					<header><a href="<?=base_url()?>admin/site_api/" class="btn btn-info"><i class="fa fa-undo"></i> กลับ</a></header>				
				</div>	
				<div class="card-body">
					<form class="form-horizontal" method="post" role="form" id="<?=$id_category!=null?'frm_content_validate':'frm_cat_validate'?>">
						<div class="form-group row">
							<label class="col-sm-2 control-label">ชื่อเมนู(TH)</label>
							<div class="col-sm-4 text-left">
								<input type="text" class="form-control" name="menu_name" id="menu_name" title="Title" required value="<?=$menu_name?>">
							</div>
							<label class="col-sm-2 control-label">ชื่อเมนู(EN)</label>
							<div class="col-sm-4 text-left">
								<input type="text" class="form-control" name="menu_name_en" id="menu_name_en" title="Title" required value="<?=$menu_name_en?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">รายละเอียดสั้นๆ(TH)</label>
							<div class="col-sm-4 text-left">
								<input type="text" class="form-control" name="menu_subname" id="menu_subname" title="Sub Title" required value="<?=$menu_subname?>">
							</div>
							<label class="col-sm-2 control-label">รายละเอียดสั้นๆ(EN)</label>
							<div class="col-sm-4 text-left">
								<input type="text" class="form-control" name="menu_subname_en" id="menu_subname_en" title="Sub Title" required value="<?=$menu_subname_en?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">ชื่อปุ่ม(TH)</label>
							<div class="col-sm-4 text-left">
								<input type="text" class="form-control" name="menu_button_text" id="menu_button_text" title="Button Text" required value="<?=$menu_button_text?>">
							</div>
							<label class="col-sm-2 control-label">ชื่อปุ่ม(EN)</label>
							<div class="col-sm-4 text-left">
								<input type="text" class="form-control" name="menu_button_text_en" id="menu_button_text_en" title="Button Text" required value="<?=$menu_button_text_en?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">รูปแบบ</label>
							<div class="col-sm-10 text-left">
								<input type="text" class="form-control" name="menu_type" id="menu_type" title="Menu Type" required value="url" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">ปลายทาง</label>
							<div class="col-sm-10 text-left">
								<input type="text" class="form-control" name="menu_target" id="menu_target" title="Menu Targer" required value="<?=$menu_target?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">สีหลัก</label>
							<div class="col-sm-2 text-left">
								<input type="text" class="form-control color_hex" name="menu_color_primary" id="menu_color_primary" title="Primary Color" required value="<?=$menu_color_primary?>">
							</div>
							<label class="col-sm-2 control-label">สีรอง</label>
							<div class="col-sm-2 text-left">
								<input type="text" class="form-control color_hex" name="menu_color_secondary" id="menu_color_secondary" title="Secondary Color" required value="<?=$menu_color_secondary?>">
							</div>
							<label class="col-sm-2 control-label">สีพื้นหลัง</label>
							<div class="col-sm-2 text-left">
								<input type="text" class="form-control color_hex" name="menu_color_bg" id="menumenu_color_bg_target" title="Background Color" required value="<?=$menu_color_bg?>">
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-2 control-label">สถานะ</label>
							<div class="col-sm-10 text-left">
								<div class="radio-list">
									<label class="radio-inline">
									<input type="radio" name="is_show" value="1" <?=$is_show==1?'checked':''?> <?=$is_show==''?'checked':''?>> แสดง </label>
									<label class="radio-inline">
									<input type="radio" name="is_show" value="0" <?=$is_show==0?'checked':''?> > ซ่อน </label>	
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="offset-md-2 col-md-10">
								<input type="hidden" name="menu_id" id="menu_id" value="<?=$menu_id?>">
								<button type="submit" id="btn_submit" class="btn btn-primary">บันทึก</button>
								<a href="javascript:history.back()" class="btn btn-default">ยกเลิก</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>