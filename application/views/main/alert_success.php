<style>
    h2 i{
        background-color: #2cc444;
color: #fff;
border-radius: 50%;
padding: 10px;
    }
    .rowp{
        border-bottom: 1px dashed #eee;
    }
</style>
<div class="warpper py-3">
    <div class="container">
        <div class="row mb-1">
            <div class="col-12">
                <a class="btn btn-light" href="<?=base_url('alertform')?>"><i class="fas fa-arrow-circle-left"></i> กลับหน้าแจ้งเหตุ</a>
            </div>
        </div>
      
        <?php 
            $ar_text = array(
                'form1' => 'แจ้งแหล่งกำเนิด PM2.5',
                'form2' => 'แจ้งตรวจสอบเครื่องวัดฝุ่น',
                'form3' => 'ส่งข้อความถึงผู้ดูแล Application',
            );
            $message_obj =(array)json_decode($rs[0]->message_obj);

            
        ?>
        <div class="card">
            <div class="card-body">
                <h2 class="text-success text-center"><i class="fas fa-check"></i></h2>
                <h5 class="text-success text-center"><?=$ar_text[$rs[0]->message_form]?> เรียบร้อย</h5>
                <hr/>
                <p class="m-0"><strong>รายละเอียด:</strong></p>
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
            
           
        </div>

       
    </div>
</div>