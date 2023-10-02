<div class="warpper py-3">
    <div class="container">
        <div class="row mb-1">
            <div class="col-12">
                <a class="btn btn-light" href="<?=base_url('alertform')?>"><i class="fas fa-arrow-circle-left"></i> กลับหน้าแจ้งเหตุ</a>
            </div>
        </div>
      
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="form-title text-center m-0 py-2">หัวข้อ ส่งข้อความถึงผู้ดูแล Application</h3>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <div class="containerz alert alert-warning" style="display:none;">
                    <h5>กรุณากรอกข้อมูลให้ครบถ้วน</h5>
                    <ol class="m-0"></ol>
                </div>
                <form method="post" id="form3">
                    <div class="form-group">
                        <label for="alert_type">สอบถาม*</label>
                        <?php $ar_list = array(1=>'แนะนำ', 'ติชม', 'แจ้งปัญหา Application', 'อื่นๆ');?>
                        <?php foreach($ar_list as $k=>$v){?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" title="หัวข้อ" name="alert_type" id="exampleRadios<?=$k?>" value="<?=$k?>" required>
                                <label class="form-check-label" for="exampleRadios<?=$k?>">
                                    <?=$v?>
                                </label>
                            </div>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label for="alert_message">ข้อความ*</label>
                        <textarea name="alert_message" required class="form-control" rows="3" title="ข้อความ"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="alert_contact">ช่องทางการติดต่อกลับ*</label>
                        <div class="form-check">
                            <input class="form-check-input frm3_ch_author" title="ช่องทางการติดต่อกลับ" type="radio" name="alert_contact" id="exampleRadios_tel" value="tel" required>
                            <label class="form-check-label" for="exampleRadios_tel">โทรศัพท์</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input frm3_ch_author"  type="radio" name="alert_contact" id="exampleRadios_line" value="line">
                            <label class="form-check-label" for="exampleRadios_line">Line ID</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input frm3_ch_author" type="radio" name="alert_contact" id="exampleRadios_other" value="other">
                            <label class="form-check-label" for="exampleRadios_other">อื่นๆ</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input frm3_ch_author" type="radio" name="alert_contact" id="exampleRadios_unknow" value="unknow">
                            <label class="form-check-label" for="exampleRadios_unknow">ไม่ประสงค์ออกนาม</label>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="alert_contact_message" id="alert_contact_message" required placeholder="กรอกช่องทางการติดต่อกลับ.." title="กรอกช่องทางการติดต่อกลับ">
                    </div>
                    <input type="hidden" name="alert_form" value="form3">
                    <button type="submit" class="btn btn-theme btn-block">ส่งข้อความ</button>
                </form>
            </div>
        </div>
    </div>
</div>