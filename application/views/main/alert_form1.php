<div class="warpper py-3">
    <div class="container">
        <div class="row mb-1">
            <div class="col-12">
                <a class="btn btn-light" href="<?=base_url('alertform')?>"><i class="fas fa-arrow-circle-left"></i> กลับหน้าแจ้งเหตุ</a>
            </div>
        </div>
      
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="form-title text-center m-0 py-2">หัวข้อ แจ้งแหล่งกำเนิด PM2.5</h3>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <div class="containerz alert alert-warning" style="display:none;">
                    <h5>กรุณากรอกข้อมูลให้ครบถ้วน</h5>
                    <ol class="m-0"></ol>
                </div>
                <form method="post" enctype="multipart/form-data" id="form1">
                    <div class="form-group">
                        <label for="alert_type">เหตุ*</label>
                        <?php $ar_list = array(1=>'ไฟป่า', 'ไอเสียรถ', 'โรงงาน', 'อื่นๆ');?>
                        <?php foreach($ar_list as $k=>$v){?>
                            <div class="form-check">
                                <input class="form-check-input frm1_ch_type" title="เหตุ" type="radio" name="alert_type" id="exampleRadios<?=$k?>" value="<?=$k?>" required>
                                <label class="form-check-label" for="exampleRadios<?=$k?>">
                                    <?=$v?>
                                </label>
                            </div>
                        <?php }?>
                        <input type="text" class="form-control" name="alert_type_add" id="alert_type_add" required title="อื่นๆ โปรดระบุ" placeholder="อื่นๆ โปรดระบุ" style="display:none;">
                    </div>
                    <div class="form-group">
                        <label for="alert_message">สถานที่*</label>
                        <input type="text" class="form-control" name="alert_addr" required title="สถานที่">
                    </div>
                    <div class="form-group">
                        <label for="alert_message">อัปโหลดรูป*</label>
						<div id="dropzone" name="content_thumbnail" class="dropzone"></div>
                    </div>
                    <div class="form-group">
                        <label for="alert_message">ชื่อผู้แจ้ง*</label>
                        <input type="text" class="form-control" name="alert_send_name" required title="ชื่อผู้แจ้ง">
                    </div>
                    <div class="form-group">
                        <label for="alert_contact">ช่องทางการติดต่อกลับ*</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_contact" id="exampleRadios_tel" value="tel" required title="ช่องทางการติดต่อกลับ">
                            <label class="form-check-label" for="exampleRadios_tel">โทรศัพท์</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_contact" id="exampleRadios_line" value="line">
                            <label class="form-check-label" for="exampleRadios_line">Line ID</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="alert_contact" id="exampleRadios_other" value="other">
                            <label class="form-check-label" for="exampleRadios_other">อื่นๆ</label>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="alert_contact_message" required placeholder="กรอกช่องทางการติดต่อกลับ.." title="กรอกช่องทางการติดต่อกลับ">
                    </div>
                    <input type="hidden" id="h_image" name="h_image" required title="รูปภาพ">
                    <input type="hidden" name="alert_form" value="form1">
                    <button type="submit" class="btn btn-theme btn-block">ส่งข้อความ</button>
                </form>
            </div>
        </div>
    </div>
</div>