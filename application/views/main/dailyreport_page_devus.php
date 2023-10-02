<link rel="stylesheet" href="/template/font/ThaiSansNeue-Black/stylesheet.css">
<link rel="stylesheet" href="/template/font/ArialRoundedMTBold/stylesheet.css">
<style>

.font_text{font-family:ThaiSans Neue;}
.font_number{font-family:Arial Rounded MT;}
.ab{position: absolute;}

.ab.temp{left: 210px;
top: 105px;
font-size: 47px;
color: #8d461b;}
.db_name{font-size:17px;line-height: 17px;}
.ab.d {top: -42px;
font-size: 126px;
left: 14px;
width: 138px;
text-align: center;}
.ab.m {top: 80px;
font-size: 55px;
left: 16px;
text-align: center;
width: 132px;}
.ab.t {top: 160px;
font-size: 64px;
left: 180px;
width: 219px;
text-align: center;}

.box{position:relative;}
.hourly{top: -5px;left: 0;font-size: 45px;width: 80px;text-align: center;}
.daily{top: 15px;left: 12px;font-size: 30px;width: 56px;text-align: center;}

.a1_h{top:245px;left:131px}.a1_d{top:248px;left:205px}.a2_h{top:401px;left:57px}.a2_d{top:405px;left:131px}.a3_h{top:542px;left:56px}.a3_d{top:546px;left:129px}.a4_h{top:672px;left:174px}.a4_d{top:676px;left:248px}.a5_h{top:795px;left:135px}.a5_d{top:799px;left:208px}.a6_h{top:978px;left:135px}.a6_d{top:981px;left:208px}.a7_h{top:467px;left:823px}.a7_d{top:471px;left:897px}.a8_h{top:538px;left:435px}.a8_d{top:544px;left:508px}.a9_h{top:162px;left:444px}.a9_d{top:165px;left:517px}.a10_h{top:192px;left:687px}.a10_d{top:195px;left:760px}.a11_h{top:332px;left:718px}.a11_d{top:336px;left:791px}.a12_h{top:692px;left:765px}.a12_d{top:697px;left:838px}.a13_h{top:764px;left:506px}.a13_d{top:768px;left:579px}.a14_h{top:901px;left:494px}.a14_d{top:907px;left:567px}
</style>
<h5 class="text-center">รายงานค่าฝุ่น</h5>
<h5 class="text-center">ประวันจำวันวันที่ <?=ConvertToThaiDate(date('Y-m-d'),0)?> เวลา <?=$ar_info['t']?></h5>

<?php 
	$ar_marker = array(1=>
		'คณะสังคมศาสตร์ มช.',
		'สำนักงานสาธารณสุข จ.พิษณุโลก',
		'รพ.อุ้มผาง จ.ตาก',
		'กองทัพภาคที่ 1',
		'สำนักงานเทศบาลเมืองกระทุ่มแบน จ.สมุทรสาคร',
		'ศูนย์พัฒนาทักษะการเรียนรู้ CIC จ.ภูเก็ต',
		'ชุมชุนหมู่ 5 บ้านเขามะกอก จ.สระบุรี',
		'สำนักงานการวิจัยแห่งชาติ วช.',
		'โรงเรียนอนุบาลจุน จ.พะเยา',
		'ศาลากลาง จ.มหาสารคาม',
		'ศาลากลาง จ.อุบลราชธานี',
		'สำนักงานทรัพยากรธรรมชาติ และวิ่งแวดล้อม จ.ตราด',
		'สำนักงานเทศบาลตำบลซำฆ้อ จ.ระยอง',
		'หอดูดาวเฉลิมพระเกียรติ 7 รอบ พระชนมพรรษา จ.สงขลา',
	);
	$time_color = 'ffc000';
	$image_bg = site_url().'template/image/report/us/report_bg_us.png?v=1';
	$image_text = site_url().'template/image/report/report_text.png?v=1';
	
	$data = json_decode($rsConfig[0]->marker_config);
?>
<div class="container">
	<div class="row">
		<div class="col-12 text-center">
			<div class="mb-3">
				<button type="button" id="save_image_locally" class="btn btn-info btn-sm"><i class="far fa-file-image"></i> Download JPEG file</button>
				<!--<a href="<?=base_url()?>dailyreportpdf/<?=$this->uri->segment(2)?>" target="_blank" class="btn btn-danger btn-sm"><i class="far fa-file-pdf"></i> Download PDF file</a>-->
			</div>

			<div id="imagesave" style="width:1024px;margin:0 auto;position: relative;">
                <img src="<?=$image_bg?>" style="width:1024px;margin:0 auto;">
                <div class="ab font_text temp"><?=$ar_info['temp']?></div>
  
                <div class="ab font_text d"><?=$ar_info['d']?></div>
                <div class="ab font_text m"><?=$ar_info['m']?></div>
                <div class="ab font_text t" style="color:#<?=$time_color?>"><?=$ar_info['t']?></div>
                <img class="ab" src="<?=$image_map?>" style="width: 466px;margin: 0 auto;left: 285px;top: 295px;">
                <img class="ab" src="<?=$image_text?>" style="width:1024px;margin:0 auto;left: 0;top: 0;">
          
				<?php 
							
								foreach($ar_marker as $k=>$item){
									$res_ids = explode(",",$data->$k);
									$res = getResult($ar_list, $res_ids);
									if($res!=null){
										$pm25 = $res->pm25;
										$daily_pm25 = $res->daily_pm25;
										$name = $res->dustboy_name;
									}else{
										$pm25 = 'N/A';
										$daily_pm25 = 'N/A';
										$name = 'N/A';
									}?>
									
									<div class="ab a<?=$k?>_h">
										<div class="box">
											<img src="/template/image/report/us/US realtime_<?=color_us_type($pm25)?>.png" width="80">
											<div class="ab hourly font_text" style="color:#<?=color_us_type($pm25)!=2?'fff':'333'?>"><?=$pm25?></div>
										</div>
									</div>
									<div class="ab a<?=$k?>_d">
										<div class="box">
											<img src="/template/image/report/us/US 24hr_<?=color_us_type($daily_pm25)?>.png" width="80">
											<div class="ab daily font_text" style="color:#<?=color_us_type($daily_pm25)!=2?'fff':'666'?>"><?=$daily_pm25?></div>
										</div>
									</div>
									<?php
								}
								?>


            </div>
		</div>
	</div>
</div>

<?php 
	function getResult($ar_list,$ar){
		foreach($ar as $id){
			if($ar_list[trim($id)]!=null){
				return $ar_list[trim($id)];
				exit;
			}
		}
	}
?>
<script src="https://www.jqueryscript.net/demo/Capture-HTML-Elements-Screenshot/html2canvas.min.js"></script>
<script src="https://www.jqueryscript.net/demo/Capture-HTML-Elements-Screenshot/canvas2image.js"></script>
<script>
	var test = $("#imagesave").get(0);
	
	$('#save_image_locally').click(function(){
		html2canvas(test).then(function(canvas) {
			var canvasWidth = canvas.width;
			var canvasHeight = canvas.height;
			Canvas2Image.saveAsImage(canvas, canvasWidth, canvasHeight, 'jpeg', 'dailyreport');
		});
	});

</script>

