
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
					<header>ประวัติการเข้าใช้งาน</header>				
				</div>	
				<div class="card-body">
					<div class="table-scrollable" style="border:none;">
                        <table id="example1" class="display" style="width:100%;">
                            <thead>
                                <tr>
									<th>#</th>
									<th>ชื่อผู้ใช้</th>
									<th>อุปกรณ์</th>
									<th>ไอพี</th>
									<th>เวลา</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $i=0; foreach ($rsList as $key => $value) { $i++; ?>  

								<tr>
									<td><?=$i?></td>
									<td><?=$value->user?></td>
									<td><?=$value->ua?></td>
									<td><?=$value->ip?></td>
									<td><?=$value->createdate?></td>
								</tr>
							<?php }?>
                            </tobdy>       
                        </table>
					</div>	
				</div>
			</div>
		</div>
	</div>