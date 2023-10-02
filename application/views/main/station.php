<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$version = md5('signOutzv3');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv='content-language' content='th' />
    <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
	
    <title><?=$siteInfo['site_title']?></title>
    <meta name='description' content='<?=$siteInfo['site_des']?>' />
    <meta name='keywords' content='<?=$siteInfo['site_keyword']?>' />

    <meta property="og:url" content="https://pm2_5.nrct.go.th/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?=$siteInfo['site_title']?>">
    <meta property="og:description" content="<?=$siteInfo['site_des']?>">
    <meta property="og:image" content="<?=base_url()?>template/image/logo-nrct.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>template/image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>template/image/favicon-16x16.png">
    <link rel="stylesheet" href="<?=base_url()?>template/css/bootstrap-4.3.1/bootstrap.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template//fontawesome/css/all.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template/plugins/leaflet/leaflet.css?v=<?=$version?>" />
	<link rel="stylesheet" href="<?=base_url()?>template/plugins/leaflet-velocity_tkws/leaflet-velocity.css?v=<?=$version?>" />
	<link rel="stylesheet" href="<?=base_url()?>template/plugins/leafletTimeDimension/leaflet.timedimension.control.min.css?v=<?=$version?>" />
    <link rel="stylesheet" href="<?=base_url()?>template/css/style_nrct.min.css?v=?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template/css/custom.css??v=<?=$version?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"/>
	<?php $this->load->view('main/analytics');?>
</head>
<style>
	.mapz{width:100%;height:200px;}
	.leaflet-control-container .leaflet-top {margin-top: 10px;}
	h1,h2,h3,h4,h5,.tb{font-family: RSUBold;}
	
	#notics_number {
		border-radius: 50%;
		border: 5px solid;
		padding: 7px 7px;
		width: 150px;
		margin: 0 auto;
	}
	#notics_number span.number{
		font-size: 70px;
	}
	#notics_number span.uint{
		display: block;
		font-size: 16px;
	}
</style>
<body>
<script>window.oncontextmenu=function(){return!1},document.onkeydown=function(e){return 123!=e.keyCode&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="I".charCodeAt(0))&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="J".charCodeAt(0))&&((!e.ctrlKey||e.keyCode!="U".charCodeAt(0))&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="C".charCodeAt(0))&&void 0))))};</script>
    <div class="warpper">
        <!-- menu (mobile) -->
        <?php $this->load->view('main/template_nav_sidebar');?>
        <div id="content">
            <!-- menu (com) -->
			<?php $this->load->view('main/template_nav_main');?>
            
			<?php if(@$rs->dustboy_name){?>
			
            <div class="tab-content">
				<div class="container">
					<div class="row mb-5">
						<div class="col-12">
							<h4 class="sensor-title"><?=@$rs->dustboy_name?></h4>
							<hr/>
							<p class="sensor-source">[<?=@$rs->source_name?>]</p>
							<div id="mapid" class="mapz mb-3"></div>
							<h5 class="pm-index">คุณภาพอากาศ</h5>
							<hr/>
							<div class="tb">
								<span class="value-date">-</span>
								<span class="value-time ml-3">-</span>
							</div>
						</div>
					</div>
					
					<div class="row mb-3">
						<div class="col-md-4 text-center">
							<div id="notics_number">
								<span class="number tb">00</span>
								<span class="uint tb">μg/m<sup>3</sup></span>
							</div>
							<h5 class="notics-text mb-3 mt-3">คุณภาพอากาดี</h5>
						</div>
						<div class="col-md-8">
							<h5 class="notics-title">คำแนะนำ</h5>
							<p class="notics-des"></p>
						</div>
					</div>
					<hr/>
					
					<style>
					#forecast_box{display:none;}
					.forecast-card{color:#fff;}
					.forecast-card{border:none;}
					.forecast-card .card-header{border:none;}
					.forecast-card .forecast-notics{background-color: #fff;padding: 5px;border-radius: 5px;font-size: small;font-family: RSUBold;}
					</style>
					
					<div id="forecast_box">
						<div class="row mb-3">
							<div class="col-12">
								<h5 class="forecast-title">ค่าพยากรณ์ PM2.5 ล่วงหน้า</h5>
							</div>
						</div>	
							
						<div class="row mb-3">
							<div class="col-lg-8 offset-lg-2">
								<div class="row">
									
									<div class="col-sm-4 mb-3">
										<div id="forecast1" style="display:none;" class="forecast-card card text-center" style="background-color: rgb(253, 192, 78,0.7);">
											<div class="card-header" style="background-color: rgb(253, 192, 78, 1);">วันศุกร์ (26 ก.พ. 64)</div>
											<div class="card-body" style="">
												<p><img src="/template/image/th-dust-boy-03.svg"></p>
												<span class="forecast-notics" style="color:rgb(253, 192, 78, 1)">PM2.5 = 0-25 (μg/m<sup>3</sup>)</span>
											</div>
										</div>
									</div>
									<div class="col-sm-4 mb-3">
										<div id="forecast2" style="display:none;" class="forecast-card card text-center" style="background-color: rgb(253, 192, 78,0.7);">
											<div class="card-header" style="background-color: rgb(253, 192, 78, 1);">วันศุกร์ (26 ก.พ. 64)</div>
											<div class="card-body" style="">
												<p><img src="/template/image/th-dust-boy-03.svg"></p>
												<span class="forecast-notics" style="color:rgb(253, 192, 78, 1)">PM2.5 = 0-25 (μg/m<sup>3</sup>)</span>
											</div>
										</div>
									</div>
									<div class="col-sm-4 mb-3">
										<div id="forecast3" style="display:none;" class="forecast-card card text-center" style="background-color: rgb(253, 192, 78,0.7);">
											<div class="card-header" style="background-color: rgb(253, 192, 78, 1);">วันศุกร์ (26 ก.พ. 64)</div>
											<div class="card-body" style="">
												<p><img src="/template/image/th-dust-boy-03.svg"></p>
												<span class="forecast-notics" style="color:rgb(253, 192, 78, 1)">PM2.5 = 0-25 (μg/m<sup>3</sup>)</span>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
						
					
					<div class="row mb-3">
						<div class="col-12">
							<h5 class="text-hour"></h5> 
							<div style="width: 100%;height:300px;margin-bottom:30px;">
								<canvas id="chartHour"></canvas>
							</div>
							<div class="row">
								<div class="col-sm-8 offset-sm-2">
									<div class="row">
										<div class="col-sm-6">
											<img src="/template/img/gp-03.png" height="20"/> หมายถึงค่า PM<sub>2.5</sub> เฉลี่ยรายชั่วโมงนั้นๆ 
										</div>
										<div class="col-sm-6">
											<img src="/template/img/gp-04.png" height="20"/> หมายถึงค่า PM<sub>10</sub> เฉลี่ยรายชั่วโมงนั้นๆ 
										</div>
										<div class="col-sm-6">
											<img src="/template/img/gp-01.png" height="20"/> หมายถึงค่า PM<sub>2.5</sub> เฉลี่ย 24 ชั่วโมงย้อนหลัง
										</div>
										<div class="col-sm-6">
											<img src="/template/img/gp-02.png" height="20"/> หมายถึงค่า PM<sub>10</sub> เฉลี่ย 24 ชั่วโมงย้อนหลัง
										</div>
									</div>
								</div>
							</div>
		
						</div>
					</div>
					
					<div class="row mb-3">
						<div class="col-md-12">
							<h5 class="text-pmday"></h5> 
							<div style="width: 100%;height:250px;">
								<canvas id="chartDay"></canvas>
							</div>
						</div>
						<div id="chartAQIDay" style="display:none;"></div>
						<!-- <div class="col-md-6">
							<h5 class="text-pmaqi" style="display:none;"></h5> 
							<div style="width: 100%;height:250px;">
								<canvas id="chartAQIDay"></canvas>
							</div>
						</div> -->
					</div>
					
					<?php if($rs->source_id==1){?>
					<div class="row mb-3">
						<div class="col-12 text-center">
							<p> 
							<a target="_blank" href="https://www.cmuccdc.org/download_json/<?=$rs->id?>" class="btn btn-secondary btn-sm"><i class="fa fa-globe "></i> JSON</a> 
							<a target="_blank" href="https://www.cmuccdc.org/download_excel/<?=$rs->id?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Excel</a> </p>
						</div>
					</div>
					<?php }?>
				</div>
				
				
            </div>
			<?php }else{ echo '<p class="text-center mt-5">ยังไม่มีข้อมูล</p>';}?>
			
        </div>
    </div>
    <div class="overlay"></div>

    <script src="<?=base_url()?>template/js/all/compress.min.js?v=<?=$version?>"></script>
	<script src="<?=base_url()?>template/plugins/leaflet/leaflet.js?v=<?=$version?>" ></script>
	<script src="<?=base_url()?>template/plugins/esri-leaflet/esri-leaflet.js?v=<?=$version?>"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
	<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
    <script src="<?=base_url()?>template/js/minify/station.js?v=<?=$version?>"></script>
</body>

</html>