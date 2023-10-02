<link rel="stylesheet" href="/template/font/ThaiSansNeue-Black/stylesheet.css">
<link rel="stylesheet" href="/template/font/ArialRoundedMTBold/stylesheet.css">
<style>

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
</style>
<h5 class="text-center">รายงานค่าฝุ่น</h5>
<h5 class="text-center">ประวันจำวันวันที่ <?=ConvertToThaiDate(date('Y-m-d'),0)?> เวลา <?=$ar_info['t']?></h5>

<?php 
	$time_color = $this->uri->segment(2)<13? '2e75b5':'ffc000';
	$image_bg = $this->uri->segment(2)<13? site_url().'template/image/report/2023_bg_7_v3.jpg?v=17':site_url().'template/image/report/2023_bg_4_v3.jpg?v=17';
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
                
								
				<?php 
                $res_ids = array(5281,5264,5263,5265,5266,5267);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a1_h{top: 245px;left: 131px;}
				.a1_d{top: 248px;left: 205px;}
				</style>
				<div class="ab a1_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a1_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				<?php 
				//2
                $res_ids = array(5212,5614,5615,5616,5618,5278);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a2_h{top: 401px;left: 57px;}
				.a2_d{top: 405px;left: 131px;}
				</style>
				<div class="ab a2_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a2_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				<?php 
				//3
                $res_ids = array(5047,5031,5032,5046,5399,5428);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a3_h{top: 542px;left: 56px;}
				.a3_d{top: 546px;left: 129px;}
				</style>
				<div class="ab a3_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a3_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				
				<?php 
				//4
                $res_ids = array(5315,5361,5062,6008,110,5242,5240, 5243, 5239);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a4_h{top: 672px;left: 174px;}
				.a4_d{top: 676px;left: 248px;}
				</style>
				<div class="ab a4_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a4_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				
				<?php 
				//5
                $res_ids = array(5324,5291,5323,5338,5337,5638);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a5_h{top: 795px;left: 135px;}
				.a5_d{top: 799px;left: 208px;}
				</style>
				<div class="ab a5_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a5_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				<?php 
				//6
                $res_ids = array(5313,5152);
                $res_ids = array(5151, 5152, 5313, 5419, 5420,5072, 6599, 5671);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a6_h{top: 978px;left: 135px;}
				.a6_d{top: 981px;left: 208px;}
				</style>
				<div class="ab a6_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a6_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				
				<?php 
				//7
                $res_ids = array(5068,5635,5636,6190, 6191, 6193, 6194, 6195, 5609);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a7_h{top: 467px;left: 823px;}
				.a7_d{top: 471px;left: 897px;}
				</style>
				<div class="ab a7_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a7_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				
				<?php 
				//8
                $res_ids = array(5457, 5356, 6000, 4013, 4070, 5357, 6020);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a8_h{top: 538px;left: 435px;}
				.a8_d{top: 544px;left: 508px;}
				</style>
				<div class="ab a8_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a8_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				
				<?php 
				//9
                $res_ids = array(5051, 5688, 5049, 5677, 5676, 5052, 5405);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a9_h{top: 162px;left: 444px;}
				.a9_d{top: 165px;left: 517px;}
				</style>
				<div class="ab a9_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a9_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				
				<?php 
				//10
                $res_ids = array(5444,5293,5294,5295);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a10_h{top: 192px;left: 687px;}
				.a10_d{top: 195px;left: 760px;}
				</style>
				<div class="ab a10_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a10_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				
				<?php 
				//11
                $res_ids = array(5388, 5643, 5202, 5205, 5200, 5198);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a11_h{top: 332px;left: 718px;}
				.a11_d{top: 336px;left: 791px;}
				</style>
				<div class="ab a11_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a11_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				<?php 
				//12
                $res_ids = array(5344,5318,5580,6132,6133);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a12_h{top: 692px;left: 765px;}
				.a12_d{top: 697px;left: 838px;}
				</style>
				<div class="ab a12_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a12_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				<?php 
				//13
                $res_ids = array(5342,5597,5598,6148,5464, 5064);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a13_h{top: 764px;left: 506px;}
				.a13_d{top: 768px;left: 579px;}
				</style>
				<div class="ab a13_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a13_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
				
				<?php 
				//14
                $res_ids = array(5305, 5352,5417,5070,5056,5055);
                $res = getResult($ar_list, $res_ids);
                if($res!=null){
                    $pm25 = $res->pm25;
                    $daily_pm25 = $res->daily_pm25;
                    $name = $res->dustboy_name;
                }else{
                    $pm25 = 'N/A';
                    $daily_pm25 = 'N/A';
                    $name = 'N/A';
                }
                ?>
				<style>
				.a14_h{top: 901px;left: 494px;}
				.a14_d{top: 907px;left: 567px;}
				</style>
				<div class="ab a14_h">
					<div class="box">
						<img src="/template/image/report/realtime_<?=report_type_test($pm25)?>.png" width="80">
						<div class="ab hourly font_text" style="color:#<?=report_type_test($pm25)!=3?'fff':'333'?>;"><?=$pm25?></div>
					</div>
				</div>
				<div class="ab a14_d">
					<div class="box">
						<img src="/template/image/report/24hr_<?=report_type_test($daily_pm25)?>.png" width="80">
						<div class="ab daily font_text" style="color:#<?=report_type_test($daily_pm25)!=3?'fff':'666'?>"><?=$daily_pm25?></div>
					</div>
				</div>
				
            </div>
		</div>
	</div>
</div>

<?php 
	function getResult($ar_list,$ar){
		foreach($ar as $id){
			if($ar_list[$id]!=null){
				return $ar_list[$id];
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

