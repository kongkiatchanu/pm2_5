<link rel="stylesheet" href="/template/font/ThaiSansNeue-Black/stylesheet.css">
<link rel="stylesheet" href="/template/font/ArialRoundedMTBold/stylesheet.css">
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
			<style>
			    .bootstrap-tagsinput .tag{padding:2px 10px !important;}
			
.font_text{font-family:ThaiSans Neue;}
.font_number{font-family:Arial Rounded MT;}
.ab{position: absolute;}

.ab.temp{left: 165px;
top: 86px;
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
.ab.t {top: 130px;
font-size: 64px;
left: 151px;
width: 219px;
text-align: center;}

.box{position:relative;}
.hourly{top: -5px;left: 0;font-size: 45px;width: 80px;text-align: center;}
.daily{top: 15px;left: 12px;font-size: 30px;width: 56px;text-align: center;}

.a1_h{top: 245px;left: 131px;}
.a1_d{top: 248px;left: 205px;}

.a2_h{top: 401px;left: 57px;}
.a2_d{top: 405px;left: 131px;}

.a3_h{top: 542px;left: 56px;}
.a3_d{top: 546px;left: 129px;}

.a4_h{top: 672px;left: 174px;}
.a4_d{top: 676px;left: 248px;}

.a5_h{top: 795px;left: 135px;}
.a5_d{top: 799px;left: 208px;}
				
.a6_h{top: 978px;left: 135px;}
.a6_d{top: 981px;left: 208px;}

.a7_h{top: 467px;left: 823px;}
				.a7_d{top: 471px;left: 897px;}
				
				.a8_h{top: 538px;left: 435px;}
				.a8_d{top: 544px;left: 508px;}
				
				.a9_h{top: 162px;left: 444px;}
				.a9_d{top: 165px;left: 517px;}
				.a10_h{top: 192px;left: 687px;}
				.a10_d{top: 195px;left: 760px;}
				.a11_h{top: 332px;left: 718px;}
				.a11_d{top: 336px;left: 791px;}
				
				.a12_h{top: 692px;left: 765px;}
				.a12_d{top: 697px;left: 838px;}
				.a13_h{top: 764px;left: 506px;}
				.a13_d{top: 768px;left: 579px;}
				.a14_h{top: 901px;left: 494px;}
				.a14_d{top: 907px;left: 567px;}
</style>
<?php 
	function getResult($ar_list,$ar){
		foreach($ar as $id){
			if($ar_list[trim($id)]!=null){
				return $ar_list[trim($id)];
				exit;
			}
		}
	}
	

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

		$image_bg = $this->uri->segment(2)<13? site_url().'template/image/report/bg_new_7.JPG?v=17':site_url().'template/image/report/bg_new_4.JPG?v=17';
		
		$data = json_decode($rsConfig[0]->marker_config);
?>			
					
			<div class="card card-boxz">
				
				<div class="card-body">
					<div class="row">
						<div class="col-md-8">
							<div id="imagesave" style="width:1024px;margin:0 auto;position: relative;">
								<img src="<?=$image_bg?>" style="width:1024px;margin:0 auto;">
								
								<div class="ab font_text temp"><?=$ar_info['temp']?></div>
  
								<div class="ab font_text d"><?=$ar_info['d']?></div>
								<div class="ab font_text m"><?=$ar_info['m']?></div>
								<div class="ab font_text t" style="color:#<?=$time_color?>"><?=$ar_info['t']?></div>
								
								
								
								<?php 
							
								foreach($ar_marker as $k=>$item){
									$res_ids = explode(",",$data->$k);
									$res = getResult($ar_list, $res_ids);
									$pm25 = 'N/A';
									$daily_pm25 = 'N/A';
									$name = $res_ids;
									if($res!=null){
										$pm25 = $res->pm25;
										$daily_pm25 = $res->daily_pm25;
										$name = $res->dustboy_name;
									}?>
									
									<div class="ab a<?=$k?>_h">
										<div class="box_name">
											<?=print_r($name)?>
										</div>
										<div class="box">
											<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
											<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>"><?=$pm25?></div>
										</div>
									</div>
									<div class="ab a<?=$k?>_d">
										<div class="box">
											<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
											<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
										</div>
									</div>
									<?php
								}
								?>
									
							</div>
							
							<div class="mt-3 mb-3">
								<a target="_blank" href="https://www.cmuccdc.org/line/genDailyReport">https://www.cmuccdc.org/line/genDailyReport</a><br/>
								<a target="_blank" href="https://www.cmuccdc.org/line/genDailyReport/8">https://www.cmuccdc.org/line/genDailyReport/8</a><br/>
								<a target="_blank" href="https://www.cmuccdc.org/line/genDailyReport/16">https://www.cmuccdc.org/line/genDailyReport/16</a><br/>
							</div>
							
							
						</div>
						<div class="col-md-4" style="    background: linear-gradient( 150deg, #95d34c 0, #d1ffff);">
							<h3>กำหนดจุดตรวจวัดแต่ละสถานที่</h3>
							<hr/>
							<div class="dropdown mb-3">
							<a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-clock-o" aria-hidden="true"></i> เลือกเวลา
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php for($i = 0;$i <= date('H');$i++){ if(date('i')>=1)?>
									<a class="dropdown-item" style="font-size: 14px" href="<?=base_url('admin/report/'.$i)?>"><i class="fa fa-clock-o" aria-hidden="true"></i> เวลา <?=$i?>:00 น.</a>
								<?php }?>
							</div>
						</div>

							<form method="post">
							<?php foreach($ar_marker as $k=>$item){?>
								<div class="form-group">
									<label><?=$k?>. <?=$item?></label>
									<input type="text" class="form-control" name="marker[<?=$k?>]" value="<?=$data->$k?>" data-role="tagsinput">
								</div>
							<?php }?>
								<input type="hidden" name="id" value="1"/>
								<button type="submit" class="btn btn-primary">บันทึก</button>
							</form>

						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>