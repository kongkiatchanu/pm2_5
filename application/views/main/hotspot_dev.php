<?php
defined('BASEPATH') or exit('No direct script access allowed');
$version = md5('signOutz');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv='content-language' content='th' />
  <meta http-equiv='content-type' content='text/html; charset=UTF-8' />

  <title>
    <?= $siteInfo['site_title'] ?>
  </title>
  <meta name='description' content='<?= $siteInfo['site_des'] ?>' />
  <meta name='keywords' content='<?= $siteInfo['site_keyword'] ?>' />

  <meta property="og:url" content="https://pm2_5.nrct.go.th/">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $siteInfo['site_title'] ?>">
  <meta property="og:description" content="<?= $siteInfo['site_des'] ?>">
  <meta property="og:image" content="<?= base_url() ?>template/image/logo-nrct.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>template/image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>template/image/favicon-16x16.png">
  <link rel="stylesheet" href="<?= base_url() ?>template/css/bootstrap-4.3.1/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template//fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/leaflet/leaflet.css" />
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/leaflet-velocity_tkws/leaflet-velocity.css" />
  <link rel="stylesheet"
    href="<?= base_url() ?>template/plugins/leafletTimeDimension/leaflet.timedimension.control.min.css" />
  <link rel="stylesheet" href="<?= base_url() ?>template/css/style_nrct.min.css?v=<?= $version ?>">
  <link rel="stylesheet" href="<?= base_url() ?>template/css/custom.css?v=<?= $version ?>">
  <?php $this->load->view('main/analytics'); ?>
  <style>
    #pills-tab2{display:none;}
  </style>
</head>

<body>
  <div class="warpper">
    <!-- menu (mobile) -->
    <?php $this->load->view('main/template_nav_sidebar'); ?>
    <div id="content">
      <!-- menu (com) -->
      <?php $this->load->view('main/template_nav_main'); ?>

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
          .btn-close{
            position: absolute;
top: 10px;
right: 10px;
color: #fff;
          }
          .leaflet-control-container .leaflet-top {
            margin-top: 10px;
          }

          .map {
            margin-top: 250px;
            height: 73vh !important;
          }

          #popupDetail{
            height: 20%;
            text-align: center;
            background: transparent;
            border: none;
            margin-top: .5rem;
          }

          @media (max-width: 575.98px) {
            .map {
              margin-top: 200px;
            }
          }

          @media (min-width: 576px) and (max-width: 767.98px) {
            .map {
              margin-top: 200;
            }
          }
        </style>
        <div class="text-center">
          <h5 id="pagename">แสดงจุดความร้อนทั้งหมดในประเทศ</h5>
          <div class="row mb-1">
            <div class="col-12">ในช่วงเวลา&nbsp; &nbsp;
              <button type="button" class="btn btn-sm btn-locations btn-success" style="margin-right: 10px;"> 24h</button>
              <button type="button" class="btn btn-sm btn-locations" style="margin-right: 10px;"> 48h </button>
              <button type="button" class="btn btn-sm btn-search" style="margin-right: 10px;" data-toggle="modal"
                data-target="#searchModel"><i class="fa fa-filter"></i></button>
              
              <div class="dropdown" style="display: inline;">
                <a id="sw_source" class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-satellite"></i> TERAA/AQUA
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item btn-type" data_index="TERAA/AQUA">TERAA/AQUA</a>
                  <a class="dropdown-item btn-type" data_index="S-NPP">VIIRS S-NPP</a>
                  <a class="dropdown-item btn-type" data_index="NOAA-20">VIIRS NOAA20</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3"><div class="col-12">จำนวนจุดความร้อนทั้งหมด : <span id="hotspot_count"><img src="/template/img/loader.gif"></span></div></div>
        </div>
        <?php $today = date('Y-m-d'); ?>
          
				<input type="hidden" id="date24" value="1">
				<input type="hidden" id="date48" value="2">
				<input type="hidden" id="date7D" value="7">
				<input type="hidden" id="dateEnd" value="<?=$today?>">
        <div id="mapid" class="map"></div>
        <!-- popup -->
        <div id="popupDetail" style="color:#fff;display:none;" class="card col-12 col-lg-3 offset-lg-4 fade_in_ture anime_delay025">
							<div class="card-header" style="background-color: rgb(0, 191, 243);  border-radius: 0.75rem 0.75rem 0px 0px;position: relative;">
								<h3 class="mt-3 mb-0 text-center card-title" style="width:100%"></h3><button class="btn btn-sm btn-close"><i class="fas fa-times"></i></button> 
							</div>
							<div class="card-body" style="background-color: rgb(0, 191, 243);border-radius: 0 0 .75rem .75rem;">
								
								<div class="detail card-description">
									<div class="row mb-1">	
										<div class="col-3 text-right">ที่อยู่</div>
										<div class="col-9 text-left"><span id="des"></span></div>
									</div>
									<div class="row mb-1">	
										<div class="col-3 text-right">พิกัด</div>
										<div class="col-9 text-left"><span id="latlon"></span></div>
									</div>
									<div class="row mb-1">	
										<div class="col-3 text-right">ความสว่าง</div>
										<div class="col-9 text-left"><span id="s_brightness"></span></div>
									</div>
									<div class="row mb-1">	
										<div class="col-3 text-right">ความเชื่อมั่น</div>
										<div class="col-9 text-left"><span id="s_confidence"></span></div>
									</div>
									<div class="row mb-1">	
										<div class="col-3 text-right">เวอร์ชั่น</div>
										<div class="col-9 text-left"><span id="s_version"></span></div>
									</div>
									<div class="row mb-1">	
										<div class="col-3 text-right">เวลา</div>
										<div class="col-9 text-left"><span id="s_time"></span></div>
									</div>
								</div>
							</div>
						</div>

      </div>
    </div>
  </div>
  <div class="overlay"></div>

  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="searchModel" tabindex="-1" role="dialog" aria-hidden="true">
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

  <script src="<?= base_url() ?>template/js/all/compress.min.js?v=<?= $version ?>"></script>
  <script src="<?= base_url() ?>template/plugins/leaflet/leaflet.js?v=<?= $version ?>"></script>
  <script src="<?= base_url() ?>template/plugins/esri-leaflet/esri-leaflet.js?v=<?= $version ?>"></script>

  <script src="<?= base_url() ?>template/js/minify/hotspot_dev.js?v=<?= $version ?>"></script>
</body>

</html>