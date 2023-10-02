
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
					<header><?=$pagename?></header>				
				</div>	
				<div class="card-body " id="bar-parent">
					<div class="containerz col-md-10 offset-sm-2 alert alert-danger">
						<h4>กรุณาป้อนข้อมูลต่อไปนี้ให้ถูกต้องครบถ้วน</h4>
						<ol></ol>
					</div>
					<?php if($this->uri->segment(3)=='fail'){?>
					<div class="col-md-10 offset-sm-2 msgalert alert alert-danger">
						<h4>คำเตือน! รหัสผ่านไม่ถูกต้อง</h4>
					</div>
					<?php }?>
					<?php if($this->uri->segment(3)=='success'){?>
					<div class="col-md-10 offset-sm-2 msgalert alert alert-success">
						<h4>เรียบร้อย! ระบบดำเนินการเปลี่ยนข้อมูลเรียบร้อย</h4>
					</div>
					<?php }?>
					<form class="form-horizontal" method="post" role="form" id="form_profile">
						<div class="form-group row">
							<label for="horizontalFormEmail" class="col-sm-2 control-label">ชื่อผู้ใช้</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="username" name="username" readonly value="<?=$_user['username']?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="horizontalFormEmail" class="col-sm-2 control-label">ชื่อที่แสดง</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="displayname" name="displayname" value="<?=$_user['display']?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="horizontalFormEmail" class="col-sm-2 control-label">รหัสผ่านเดิม</label>
							<div class="col-sm-3">
								<input type="password" class="form-control" id="o_password" name="o_password" title="รหัสผ่านเดิม" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="horizontalFormEmail" class="col-sm-2 control-label">รหัสผ่านใหม่</label>
							<div class="col-sm-3">
								<input type="password" class="form-control" id="n_password" name="n_password" title="รหัสผ่านใหม่" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="horizontalFormEmail" class="col-sm-2 control-label">ยืนยันรหัสผ่านใหม่</label>
							<div class="col-sm-3">
								<input type="password" class="form-control" id="c_password" name="c_password" title="ยืนยันรหัสผ่านใหม่" required>
							</div>
						</div>
										
						<div class="form-group">
							<div class="offset-md-2 col-md-10">
								<button type="submit" class="btn btn-info m-r-20">บันทึก</button>
								<button type="button" class="btn btn-default">ยกเลิก</button>
							</div>
						</div>
					</form>
				
				</div>
			</div>
		</div>
	</div>