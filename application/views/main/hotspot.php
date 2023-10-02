<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$version = md5('signOutz');
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
				.legend {
  font-size: 10px !important;
  bottom: 5%;
  position: absolute;
  right: 16px;
  width: 150px;
  background: rgba(0, 0, 0, 0.5);
}

.legend .legend-color {
  width: 20%;
}

.legend .legend-name {
  width: 80%;
  text-align: left;
  color: #ffffff;
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
				<div class="text-center">
					<h5 id="pagename">แสดงจุดความร้อนทั้งหมดในประเทศ</h5>
					<p>ในช่วงเวลา&nbsp; &nbsp;
						<button type="button" class="btn btn-sm btn-locations btn-success" style="margin-right: 10px;"> 24h </button>
						<button type="button" class="btn btn-sm btn-locations" style="margin-right: 10px;"> 48h </button>
						<button type="button" class="btn btn-sm btn-search" style="margin-right: 10px;" data-toggle="modal" data-target="#searchModel"><i class="fa fa-filter"></i></button><br/>
						จำนวนจุดความร้อนทั้งหมด : <span id="hotspot_count"><img src="/template/img/loader.gif"></span>
					</p>
				</div>
				<?php $today = date('Y-m-d');?>
				<input type="hidden" id="date24" value="<?=date( 'Y-m-d', strtotime( $today . ' -1 day' ) )?>">
				<input type="hidden" id="date48" value="<?=date( 'Y-m-d', strtotime( $today . ' -2 day' ) )?>">
				<input type="hidden" id="dateEnd" value="<?=$today?>">
                <div id="mapid" class="map"></div>
				<div class="legend"><div class="table"><div class="table-footer"><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(0, 255, 64);"></div><div class="p-1 legend-name">ป่าอนุรักษ์</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(70, 140, 0);"></div><div class="p-1 legend-name">ป่าสงวนแห่งชาติ</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(255, 0, 255);"></div><div class="p-1 legend-name">เขตสปก</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(128, 0, 0);"></div><div class="p-1 legend-name">พื้นที่เกษตร</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(192, 192, 192);"></div><div class="p-1 legend-name">พื้นที่ริมทางหลวง(50 เมตร)</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(194, 195, 190);"></div><div class="p-1 legend-name">ชุมชนและอื่นๆ</div></div><div class="table-row"><div class="m-1 p-1 legend-color" style="background-color: rgb(51, 51, 51);"></div><div class="p-1 legend-name">จุดความร้อนนอกประเทศ</div></div></div></div></div>
                <!-- popup -->
                <div id="popupDetail" class="card card-marker col-md-3" style="display:none;padding: 0px;">
                    <div class="card-body" style="border-radius: 12px!important;background-color: rgb(0, 191, 243);" >
                        <button type="button" class="btn btn-close" style="background-color: rgb(0, 191, 243);">
                            <img alt="image" src="<?=base_url()?>template/image/icon-close.svg" width="14" height="14">
                        </button>
                        <h5 class="card-title"> xxxx </h5>
                        <div class="card-description">
							<p>
							<span id="des">ตำบลลวงเหนือ อำเภอดอยสะเก็ด</span><br/>
							<span id="latlon">18.9669151306, 99.1412963867</span><br/>
							</p>
                        </div>
						<div class="card-date text-center">
                                <img alt="image" class="data-date" src="<?=base_url()?>template/image/icon-calendar-w.svg" width="16" height="16"><span id="datadate"> พ. 10 ก.พ. 2021 </span>
                                <img alt="image" class="data-time" src="<?=base_url()?>template/image/icon-time-w.svg" width="16" height="16"><span id="datatime"> 09:00 </span>
                        </div>
                    </div>
                   
                </div>

            </div>
        </div>
    </div>
    <div class="overlay"></div>
	
	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="searchModel" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModelLabel">เลือกจังหวัด</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select class="form-control mb-3" id="select-search" size="10">
			<option value=""> - เลือกจังหวัดทั้งหมด - </option>
		</select>
		<p class="text-center">
			<button type="button" class="btn btn-sm btn-search btn-success"> เลือก </button>
		</p>
      </div>
    </div>
  </div>
</div>

    <script src="<?=base_url()?>template/js/all/compress.min.js?v=<?=$version?>"></script>
	<script src="<?=base_url()?>template/plugins/leaflet/leaflet.js?v=<?=$version?>" ></script>
	<script src="<?=base_url()?>template/plugins/esri-leaflet/esri-leaflet.js?v=<?=$version?>"></script>
   
    <script src="<?=base_url()?>template/js/minify/hotspot.js?v=<?=$version?>"></script>
</body>

</html>