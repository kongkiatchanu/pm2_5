<?php 
$idsection=1;
$idcontent="";
$content_title="";
$content_short_description="";
$category_parent="";
$content_full_description="";
$content_thumbnail="";
$id_category="";
$content_hashtag="";
$content_status="";
$content_public=date('Y-m-d H:i:s');
if($rs!=null){
$idcontent=$rs[0]->idcontent;
$content_title=$rs[0]->content_title;
$content_short_description=$rs[0]->content_short_description;
$content_full_description=$rs[0]->content_full_description;
$content_thumbnail=$rs[0]->content_thumbnail;
$id_category=$rs[0]->id_category;
$content_hashtag=$rs[0]->content_hashtag;
$content_status=$rs[0]->content_status;
$content_public=$rs[0]->content_public;
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
					<header><a href="<?=base_url()?>admin/section/<?=$idsection?>" class="btn btn-info"><i class="fa fa-undo"></i> กลับ</a></header>				
				</div>	
				<div class="card-body">
					<form class="form-horizontal" method="post" role="form" id="frm_content_validate" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-sm-2 control-label">หัวข้อ</label>
							<div class="col-sm-10 text-left">
								<input type="text" class="form-control" name="content_title" id="content_title" title="ชื่อเรื่อง" required value="<?=html_escape($content_title)?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">เนื้อหา</label>
							<div class="col-sm-10 text-left">
								<textarea class="summernote" name="content_full_description" style="display: none;"><?=$content_full_description?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">รูปภาพ</label>
							<div class="col-sm-10 text-left">
								<?php if(!empty($content_thumbnail)){ ?>
									<div id="image_cover_show">
										<img src="<?=base_url()?>uploads/images/<?=$content_thumbnail?>" style="max-width:100%;max-height:250px;"><br/>
										<button type="button" id="remove_image_cover" class="btn btn-default btn-sm" style="margin-top:10px;">
										<i class="fa fa-trash-o"></i> Remove Image</button>
									</div>
								<?php	} ?>
								<div id="dropzone" name="content_thumbnail" class="dropzone" <?php if(!empty($content_thumbnail)){echo 'style="display:none;"';}?>></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">หมวดหมู่</label>
							<div class="col-sm-10 text-left">
								<select class="form-control" name="id_category" id="id_category" title="หมวดหมู่" required>
									<option value=""> - select category - </option>
									<?php  foreach ($category as $key => $value) {?>  
										<?php if($value->id_section==$idsection){?>
											  <option value="<?=$value->id_category?>" <?=$id_category==$value->id_category?'selected':''?>> <?=$value->category_name?> </option> 
										<?php }?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">คำค้นหา</label>
							<div class="col-sm-10 text-left">
								<input type="text" class="form-control" name="content_hashtag" id="content_hashtag" required title="content_hashtag" value="<?=$content_hashtag?>" data-role="tagsinput">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">สถานะ</label>
							<div class="col-sm-10 text-left">
								<div class="radio-list">
									<label class="radio-inline">
									<input type="radio" name="content_status" value="1" <?=$content_status==1?'checked':''?> <?=$content_status==''?'checked':''?>> แสดง </label>
									<label class="radio-inline">
									<input type="radio" name="content_status" value="0" <?=$content_status==0?'checked':''?> > ซ่อน </label>	
								</div>
							</div>
						</div>

						
						<div class="form-group row">
							<div class="offset-md-2 col-md-10">
								<input type="hidden" name="h_image" id="h_image" value="<?=$content_thumbnail?>">
								<input type="hidden" name="idcontent" id="idcontent" value="<?=$idcontent?>">
								<button type="submit" id="btn_submit" class="btn btn-primary">บันทึก</button>
								<a href="javascript:history.back()" class="btn btn-default">ยกเลิก</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>