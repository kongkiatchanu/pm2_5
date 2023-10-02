<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$version = md5('signOutzv1');
$version = date('His');
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
    <meta property="og:image" content="<?=base_url()?>template/image/logo-nrct.png?v=<?=$version?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>template/image/favicon-32x32.png?v=<?=$version?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>template/image/favicon-16x16.png?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template/css/bootstrap-4.3.1/bootstrap.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template//fontawesome/css/all.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template/plugins/leaflet/leaflet.css?v=<?=$version?>" />
	<link rel="stylesheet" href="<?=base_url()?>template/plugins/leaflet-velocity_tkws/leaflet-velocity.css?v=<?=$version?>" />
	<link rel="stylesheet" href="<?=base_url()?>template/plugins/leafletTimeDimension/leaflet.timedimension.control.min.css?v=<?=$version?>" />
    <link rel="stylesheet" href="<?=base_url()?>template/css/style_nrct.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template/css/custom.css?v=<?=$version?>">       
	<?php $this->load->view('main/analytics');?>
</head>

<body>
<script>window.oncontextmenu=function(){return!1},document.onkeydown=function(e){return 123!=e.keyCode&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="I".charCodeAt(0))&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="J".charCodeAt(0))&&((!e.ctrlKey||e.keyCode!="U".charCodeAt(0))&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="C".charCodeAt(0))&&void 0))))};</script>
    <div class="warpper">
        <!-- menu (mobile) -->
        <?php $this->load->view('main/template_nav_sidebar');?>
        <div id="content">
            <!-- menu (com) -->
			<?php $this->load->view('main/template_nav_main');?>
            
            <div class="tab-content">
                <!-- map -->
                <div id="mapid" class="map"></div>
				<div id="floating-panel">
					<ul style="display:none;">
						<li>
							<label>displayValues</label>
							<input id="displayValues" type="checkbox" value="displayValues" checked>
							<output id="displayValuesText" for="displayValues">true</output>
						</li>
					</ul>
					<span id="data-timer">loading...</span>
				</div>
                <!-- popup -->
                <div id="popupDetail" class="card card-marker col-lg-3" style="display: none; padding: 0px;">
                    <div class="card-body" style="background-color: rgb(0, 191, 243);">
                        <button type="button" class="btn btn-close" style="background-color: rgb(0, 191, 243);">
                            <img alt="image" src="<?=base_url()?>template/image/icon-close.svg" width="14" height="14">
                        </button>
                        <h5 class="card-title"> สนามกีฬากลาง มหาวิทยาลัยเชียงใหม่ </h5>
                        <div class="card-description">
                            <div class="card-cover">
                                <img alt="image" class="card-cover-img" src="https://pm2_5.nrct.go.th/img/th-dust-boy-01.8da76418.svg" width="59" height="85">
                            </div>
                            <div class="card-quality">
                                <div class="card-value"> 8 </div>
                                <div class="card-info"> PM2.5 (μg/m<sup>3</sup>) </div>
                            </div>
                        </div>
                        <div class="card-description">
                            <div class="card-detail card-detail-custom">
                                <h4> คุณภาพอากาศดีมาก </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: rgb(0, 191, 243);">
                        <a id="btn-forecast" class="btn-favorite" href="#" target="_blank">
                            <img alt="image" src="<?=base_url()?>template/image/icon-graphic-w.svg" width="18" height="17">
                        </a>
                        <div class="card-items card-items-footer">
                            <div class="card-date">
                                <span class="data-date"> พ. 10 ก.พ. 2021 </span>
                                <span class="data-time"> 09:00 </span>
                                <span class="data-pm10">  </span>
                            </div>
                        </div>
                        <a id="btn-station" class="btn-favorite" href="#" target="_blank">
                            <img alt="image" src="<?=base_url()?>template/image/icon-info-w.svg" width="18" height="17">
                        </a>
                    </div>
                </div>
				
				<div id="popupHotspot" class="card card-marker col-md-4 col-sm-6" style="display:none;padding: 0px;"><div class="card-body" style="border-radius: 12px!important;background-color: rgb(0, 191, 243);" > <button type="button" class="btn btn-close" style="background-color: rgb(0, 191, 243);"> <img alt="image" src="<?=base_url()?>template/image/icon-close.svg" width="14" height="14"> </button><h3 class="card-title"> xxxx</h3><h5 class="text-center"></h5><div class="card-description"><p> <span id="des">ตำบลลวงเหนือ อำเภอดอยสะเก็ด</span><br/> <span id="latlon">18.9669151306, 99.1412963867</span><br/></p></div><div class="card-date text-center"> <img alt="image" class="data-date" src="<?=base_url()?>template/image/icon-calendar-w.svg" width="16" height="16"><span id="datadate"> พ. 10 ก.พ. 2021 </span> <img alt="image" class="data-time" src="<?=base_url()?>template/image/icon-time-w.svg" width="16" height="16"><span id="datatime"> 09:00 </span></div></div></div>
				
				<input type="hidden" id="hotspot_s" value="<?=date( 'Y-m-d', strtotime( $today . ' -1 day' ) )?>"/>
				<input type="hidden" id="hotspot_e" value="<?=date( 'Y-m-d')?>"/>
				
				<div class="mapload">กำลังโหลดข้อมูล...</div>
				<div class="legend2" style="display:none;"><div class="table"><div class="table-footer"></div></div></div>
				<div class="legend" style="display:none"><div class="table"><div class="table-footer"><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(0, 255, 64);"></div><div class="p-1 legend-name">ป่าอนุรักษ์</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(70, 140, 0);"></div><div class="p-1 legend-name">ป่าสงวนแห่งชาติ</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(255, 0, 255);"></div><div class="p-1 legend-name">เขตสปก</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(128, 0, 0);"></div><div class="p-1 legend-name">พื้นที่เกษตร</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(192, 192, 192);"></div><div class="p-1 legend-name">พื้นที่ริมทางหลวง(50 เมตร)</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(194, 195, 190);"></div><div class="p-1 legend-name">ชุมชนและอื่นๆ</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(51, 51, 51);"></div><div class="p-1 legend-name">จุดความร้อนนอกประเทศ</div></div></div></div></div>
				<div class="standard_sqi_legend"></div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>

    <script src="<?=base_url()?>template/js/all/compress.min.js?v=<?=$version?>"></script>
	<script src="<?=base_url()?>template/plugins/leaflet/leaflet.js?v=<?=$version?>" ></script>
	<script src="<?=base_url()?>template/plugins/esri-leaflet/esri-leaflet.js?v=<?=$version?>"></script>
	<script src="<?=base_url()?>template/plugins/leaflet-velocity_tkws/leaflet-velocity.js?v=<?=$version?>"></script>
	<script src="https://unpkg.com/georaster"></script>
    <script src="https://unpkg.com/proj4"></script>
    <script src="https://unpkg.com/georaster-layer-for-leaflet/georaster-layer-for-leaflet.browserify.min.js"></script>
    <script src="<?=base_url()?>template/js/main_wind_2023.js?v=<?=date('His')?>"></script>
	<script>
	var vmap = '<?=$vmap_file?>';
	var vmap_us = '<?=$vmap_file_us?>';
	</script>
</body>

</html>