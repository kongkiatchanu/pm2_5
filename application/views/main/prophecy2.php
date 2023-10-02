<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$version = md5('signOutz3');
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
    <link rel="stylesheet" href="<?=base_url()?>template/css/bootstrap-4.3.1/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>template//fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url()?>template/plugins/leaflet/leaflet.css" />
	<link rel="stylesheet" href="<?=base_url()?>template/plugins/leaflet-velocity_tkws/leaflet-velocity.css" />
	<link rel="stylesheet" href="<?=base_url()?>template/plugins/leafletTimeDimension/leaflet.timedimension.control.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>template/css/style_nrct.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template/css/custom.css?v=<?=$version?>">
	

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
	<?php $this->load->view('main/analytics');?>
</head>

<body>
    <div class="warpper">
        <!-- menu (mobile) -->
        <?php $this->load->view('main/template_nav_sidebar');?>
        <div id="content">
            <!-- menu (com) -->
			<?php $this->load->view('main/template_nav_main');?>
            
            <div class="tab-content">
                <!-- map -->
				<style>
				table.dataTable thead{background-color: #522363; color: #fff;}
				table.dataTable thead th{border:none;}
				.pm-bage{
					background-color: #cecece;
					color: #fff;
					padding: 2px 10px;
					border-radius: 5px;
					width: 50px;
					margin: 0 auto;
				}
				.leaflet-control-container .leaflet-top {margin-top: 10px;}
				.map{margin-top:300px;height:65vh !important;}
				@media (max-width: 575.98px) {
					.map{margin-top:250px;}
				}

				@media (min-width: 576px) and (max-width: 767.98px) {
					.map{margin-top:250px;}
				}
				</style>
		<h5 class="text-center"><span id="rgname">ค่าพยากรณ์ PM2.5 ล่วงหน้า</span></h5>
		<div class="loader">
			<p class="text-center text-warning">กำลังประมวลผล</p>
			<p class="text-center"><img style="max-width:100%" src="<?=base_url()?>template/image/loader.gif"></p>
		</div>
		<div class="container">
			<?php 
			$today = date('Y-m-d');
			$today_add = date('Y-m-d', strtotime('+1 day', strtotime(date('y-m-d'))));
			$today_add2 = date('Y-m-d', strtotime('+2 day', strtotime(date('y-m-d'))));
			$today_add3 = date('Y-m-d', strtotime('+3 day', strtotime(date('y-m-d'))));
			?>

			<input type="hidden" id="today_add" value="<?=$today_add?>">
			<input type="hidden" id="today_add2" value="<?=$today_add2?>">
			<input type="hidden" id="today_add3" value="<?=$today_add3?>">
			<?php for($i=1; $i<=7; $i++){?>
			<div class="row mb-3" id="box_<?=$i?>" style="display:none;">
				<div class="col-12">
					<h5 class="forecast-title<?=$i?>"></h5>
					<div class="clearfix mb-2">
						<button class="btn btn-sm btn-secondary blurinator" mapid="<?=$i?>"><i class="far fa-file-pdf"></i> ดาวน์โหลด</button>
						<!--
						<?php 
						$filename = $_SERVER['DOCUMENT_ROOT'] . '/uploads/reports/'.$i.'-'.date('YmdH').'.png';
						$display = '';
						if (!file_exists($filename)) {
							$display = 'display:none;';
						} 

						?>
						<a target="_blank" href="#" id="btnExport<?=$i?>" class="btn btn-sm btn-secondary" style="<?=$display?>"><i class="far fa-file-pdf"></i> ดาวน์โหลด</a>
						-->
					</div>
					<div id="snapshot<?=$i?>"></div>
					<div id="mapForecast<?=$i?>" style="width:100%;height:350px;margin-bottom:20px;z-index: 1;"></div>
					<div class="clearfix"></div>
					<table class="table" id="tblProphecy<?=$i?>">
						<thead class="text-center">
							<tr>
								<th rowspan="2">จุดติดตั้ง</th>
								<th rowspan="2">จังหวัด</th>
								<th>วันนี้</th>
								<th colspan="3">คาดการณ์</th>
							</tr>
							<tr>
								<th><?=ConvertToThaiDateCutYear($today,1)?></th>
								<th><?=ConvertToThaiDateCutYear($today_add,1)?></th>
								<th><?=ConvertToThaiDateCutYear($today_add2,1)?></th>
								<th><?=ConvertToThaiDateCutYear($today_add3,1)?></th>
							</tr>
						</thead>
						<tbody>
						</tdoby>
					</table>
				</div>
			</div>	
			<?php }?>
			
			
		</div>

	
    <script src="<?=base_url()?>template/js/all/compress.min.js?v=v=<?=$version?>"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
	<script src="<?=base_url()?>template/plugins/esri-leaflet/esri-leaflet.js?v=<?=$version?>"></script>
	
   
    <script src="<?=base_url()?>template/js/minify/prophecy.js?v=<?=$version?>"></script>
</body>

</html>