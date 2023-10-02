
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
					<header>รายการข้อมูลการติดต่อ</header>				
				</div>	
				<div class="card-body">
					<div class="table-scrollable" style="border:none;">
                        <table id="example1" class="display" style="width:100%;">
                            <thead>
                                <tr>
									<th>#</th>
									<th>หัวข้อ</th>
									<th>ผู้ติดต่อ</th>
									<th>วันที่ เวลา</th>
									<th></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $i=0; foreach ($rsList as $key => $value) { $i++; ?>  
							<?php 
								$bg='';
								if($value->contact_view==0){
									$bg='style="font-weight: 500;background-color: #d8d8d8;"';
								}
							?>
								<tr <?=$bg?>>
									<td><?=$i?></td>
									<td><?=$value->contact_subject?></td>
									<td><?=$value->contact_name?></td>
									<td><?=$value->contact_datetime?></td>
									<td>
										<a href="<?=base_url()?>admin/contact/view/<?=$value->idcontact?>" class="btn btn-info btn-xs">
											<i class="fa fa-eye"></i>	
											ดูรายละเอียด
										</a>

										<a href="<?=base_url()?>admin/contact/del/<?=$value->idcontact?>" class="btn btn-danger btn-xs" onclick="return confirm('คุณต้องการลบใช่หรือไม่');">
											<i class="fa fa-trash"></i>	
											ลบ
										</a>	
									</td>
								</tr>
							<?php }?>
                            </tobdy>       
                        </table>
					</div>	
				</div>
			</div>
		</div>
	</div>