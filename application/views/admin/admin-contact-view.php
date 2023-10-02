
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
					<header><?=$rs[0]->contact_subject?></header>				
				</div>	
				<div class="card-body">
					<p><strong>รายละเอียด : </strong><p>
					<p><?=$rs[0]->contact_message?><p><br/>
					
					<p><strong>ชื่อผู้ติดต่อ : </strong><?=$rs[0]->contact_name?><p>
					<p><strong>อีเมล์ : </strong><?=$rs[0]->contact_email?><p>
					<p><strong>เวลา : </strong><?=$rs[0]->thaidate?><p>
					<p><a href="mailto:<?=$rs[0]->contact_email?>" class="btn btn-primary btn-sm"><i class="fa fa-reply"></i> ตอบกลับ</a></p>
				</div>
			</div>
		</div>
	</div>