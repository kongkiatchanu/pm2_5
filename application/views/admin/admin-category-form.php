<?php 
$id_section=1;
$category_name="";
$category_parent="";
$category_rewrite="";
$id_category="";
if($rs!=null){
$category_name=$rs[0]->category_name;
$category_parent=$rs[0]->idparent;
$category_rewrite=$rs[0]->category_rewrite;
$id_category=$rs[0]->id_category;
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
					<header><a href="<?=base_url()?>admin/category/" class="btn btn-info"><i class="fa fa-undo"></i> กลับ</a></header>				
				</div>	
				<div class="card-body">
					<form class="form-horizontal" method="post" role="form" id="<?=$id_category!=null?'frm_content_validate':'frm_cat_validate'?>">
						<div class="form-group row">
							<label class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10 text-left">
								<input type="text" class="form-control" name="category_name" id="category_name" title="Category Name" required value="<?=$category_name?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">Rewrite</label>
							<div class="col-sm-10 text-left">
								<input type="text" class="form-control" name="category_rewrite" id="category_rewrite" title="Category rewrite" required <?=$id_category!=null?'readonly':''?> value="<?=$category_rewrite?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">Parent</label>
							<div class="col-sm-10 text-left">
								<select class="form-control" name="category_parent" id="category_parent" title="category parent">
									<option value=""> - select parrent - </option>
									<?php  foreach ($category as $key => $value) {?>  
										<?php if($value->id_section==$id_section){?>
										   <option value="<?=$value->id_category?>" <?=$category_parent==$value->id_category?'selected':''?>> <?=$value->category_name?> </option> 
										<?php }?>
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="offset-md-2 col-md-10">
								<input type="hidden" name="id_section" id="id_section" value="<?=$id_section?>">
								<input type="hidden" name="id_category" id="id_category" value="<?=$id_category?>">
								<button type="submit" id="btn_submit" class="btn btn-primary">บันทึก</button>
								<a href="javascript:history.back()" class="btn btn-default">ยกเลิก</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>