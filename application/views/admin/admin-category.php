
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
					<header><a href="<?=base_url()?>admin/category/add" class="btn btn-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a></header>				
				</div>	
				<div class="card-body">
					<div class="table-scrollable" style="border:none;">
                        <table id="example1" class="display" style="width:100%;">
                            <thead>
                                <tr>
									<th>#</th>
									<th>หมวดหมู่</th>
									<th>หมวดย่อย</th>
									<th></th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $i=0;foreach ($category as $key => $value) {$i++;?>  
						
							<tr>
								<td><?=number_format($i)?></td>
								<?php if($value->parent!=null){?>
									<td>-</td>
									<td><?=$value->category_name?></td>
								<?php }else{?>
									<td><?=$value->category_name?></td>
									<td><?=$value->parent?></td>
								<?php }?>
								
								<td>
									<a href="<?=base_url()?>admin/category/edit/<?=$value->id_category?>" class="btn btn-info btn-xs">
										<i class="fa fa-edit"></i>	
										แก้ไข
									</a>

									<a href="<?=base_url()?>admin/category/del/<?=$value->id_category?>" class="btn btn-danger btn-xs" onclick="return confirm('คุณต้องการลบใช่หรือไม่');">
										<i class="fa fa-trash"></i>	
										ลบ
									</a>	

								</td>
							</tr>
						<?php } ?>
                            </tobdy>       
                        </table>
					</div>	
				</div>
			</div>
		</div>
	</div>