<div class="warpper py-3">
    <div class="container">
        <div class="row mb-1">
            <div class="col-12">
                <a class="btn btn-light" href="<?=base_url('alertform')?>"><i class="fas fa-arrow-circle-left"></i> กลับหน้าแจ้งเหตุ</a>
            </div>
        </div>
      
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="form-title text-center m-0 py-2">หัวข้อ แจ้งตรวจสอบเครื่องวัดฝุ่น</h3>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <div class="containerz alert alert-warning" style="display:none;">
                    <h5>กรุณากรอกข้อมูลให้ครบถ้วน</h5>
                    <ol class="m-0"></ol>
                </div>
                <form method="post" id="form2">
                    <div class="form-group">
                        <label for="alert_type">หัวข้อที่ต้องการให้ตรวจสอบ*</label>
                        <?php $ar_list = array(1=>'ค่าฝุ่นต่ำเกินจริง', 'ค่าฝุ่นสูงเกินจริง', 'เครื่องเสีย โปรดระบุอาการ');?>
                        <?php foreach($ar_list as $k=>$v){?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="alert_type" id="exampleRadios<?=$k?>" value="<?=$k?>" required title="หัวข้อที่ต้องการให้ตรวจสอบ">
                                <label class="form-check-label" for="exampleRadios<?=$k?>">
                                    <?=$v?>
                                </label>
                            </div>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="alert_symptom" required placeholder="ระบุอาการ.." title="ระบุอาการ">
                    </div>
                    <div class="form-group">
                        <label for="alert_message">ชื่อจุดที่พบ*</label>
                        <input type="text" class="form-control" name="alert_addr" required title="ชื่อจุดที่พบ">
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
                            <input class="form-check-input" type="radio" title="ช่องทางการติดต่อกลับ" name="alert_contact" id="exampleRadios_tel" value="tel" required>
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
                        <input type="text" class="form-control" name="alert_contact_message" title="กรอกช่องทางการติดต่อกลับ" required placeholder="กรอกช่องทางการติดต่อกลับ..">
                    </div>
                    <input type="hidden" id="h_image" name="h_image" required title="รูปภาพ">
                    <input type="hidden" name="alert_form" value="form2">
                    <button type="submit" class="btn btn-theme btn-block">ส่งข้อความ</button>
                </form>
            </div>
        </div>
    </div>
</div>