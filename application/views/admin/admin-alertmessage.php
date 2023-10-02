
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
			



            <?php 
            $ar_name = array(
                'form1' => 'หัวข้อ แจ้งแหล่งกำเนิด PM2.5',
                'form2' => 'หัวข้อ แจ้งตรวจสอบเครื่องวัดฝุ่น',
                'form3' => 'หัวข้อ ส่งข้อความถึงผู้ดูแล Application',
            );
			?>
			<div class="card card-boxz">
				<div class="card-head">
					<header>แจ้งเหตุ</header>				
				</div>	
				<div class="card-body">
					<div class="table-scrollable" style="border:none;">
                        <table id="example1" class="display" style="width:100%;">
                            <thead>
                                <tr>
									<th>#</th>
									<th>รหัส</th>
									<th>ประเภท</th>
									<th>เวลา</th>
                                </tr>
                            </thead>
                            <tbody>
							<?php $i=0; foreach ($rsList as $key => $value) { $i++; ?>
                               <!-- Button trigger modal -->
                                

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter<?=$value->message_key?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><?=$ar_name[$value->message_form]?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                       <?php 
                                       $ar_text = array(
                                            'form1' => 'แจ้งแหล่งกำเนิด PM2.5',
                                            'form2' => 'แจ้งตรวจสอบเครื่องวัดฝุ่น',
                                            'form3' => 'ส่งข้อความถึงผู้ดูแล Application',
                                        );
                                        $message_obj =(array)json_decode($value->message_obj);
                                        
                                       ?>
                                       <?php if($message_obj['alert_form']=="form1"){?>
                    <?php $ar_list = array(1=>'ไฟป่า', 'ไอเสียรถ', 'โรงงาน', 'อื่นๆ');?>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">เหตุ</div>
                        <div class="col-9"><?=$ar_list[$message_obj['alert_type']]?><?=@$message_obj['alert_type_add']!=null? '<br>'.$message_obj['alert_type_add']:''?></div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">สถานที่</div>
                        <div class="col-9">
                            <p class="m-0"><?=$message_obj['alert_addr']?></p>   
                        </div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">รูปภาพ</div>
                        <div class="col-9">  
                            <p class="m-0"><img src="/uploads/alert/<?=$message_obj['alert_image']?>" class="img-fluid"></p>
                        </div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">ชื่อผู้แจ้ง</div>
                        <div class="col-9"><?=$message_obj['alert_send_name']?></div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-12">ช่องทางการติดต่อกลับ <?=$message_obj['alert_contact']?> (<?=$message_obj['alert_contact_message']?>)</div>
                    </div>
                <?php }else if($message_obj['alert_form']=="form2"){?>
                    <?php $ar_list = array(1=>'ค่าฝุ่นต่ำเกินจริง', 'ค่าฝุ่นสูงเกินจริง', 'เครื่องเสีย โปรดระบุอาการ');?>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">หัวข้อ</div>
                        <div class="col-9"><?=$ar_list[$message_obj['alert_type']]?><br/><?=$message_obj['alert_symptom']?></div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">จุดที่พบ</div>
                        <div class="col-9"><?=$message_obj['alert_addr']?></div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">รูปภาพ</div>
                        <div class="col-9">  
                            <p class="m-0"><img src="/uploads/alert/<?=$message_obj['alert_image']?>" class="img-fluid"></p>
                        </div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">ชื่อผู้แจ้ง</div>
                        <div class="col-9"><?=$message_obj['alert_send_name']?></div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-12">ช่องทางการติดต่อกลับ <?=$message_obj['alert_contact']?> (<?=$message_obj['alert_contact_message']?>)</div>
                    </div>
                <?php }else if($message_obj['alert_form']=="form3"){?>
                    <?php $ar_list = array(1=>'แนะนำ', 'ติชม', 'แจ้งปัญหา Application', 'อื่นๆ');?>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">หัวข้อ</div>
                        <div class="col-9"><?=$ar_list[$message_obj['alert_type']]?></div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-3">ข้อความ</div>
                        <div class="col-9"><?=$message_obj['alert_message']?></div>
                    </div>
                    <div class="row mb-2 py-1 rowp">
                        <div class="col-12">ช่องทางการติดต่อกลับ <?=$message_obj['alert_contact']?> (<?=$message_obj['alert_contact_message']?>)</div>
                    </div>
                <?php }?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>  
                                <tr>
                                    <td><?=$i?></td>
                                    <td>
                                    <a style="cursor:pointer;color:red" data-toggle="modal" data-target="#exampleModalCenter<?=$value->message_key?>">
                                        <?=$value->message_key?>
                                    </a>
                                   </td>
                                    <td><?=$ar_name[$value->message_form]?></td>
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

