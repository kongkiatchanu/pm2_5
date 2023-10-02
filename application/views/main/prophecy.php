<link rel="stylesheet" href="<?=base_url()?>template/plugins/leaflet/leaflet.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<h5 class="text-center"><span id="rgname">ค่าพยากรณ์ PM2.5 ล่วงหน้า</span></h5>
<div class="loader">
	<p class="text-center text-warning">กำลังประมวลผล</p>
	<p class="text-center"><img style="max-width:100%" src="<?=base_url()?>template/image/loader.gif"></p>
</div>
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
			<div id="mapForecast<?=$i?>" style="width:100%;height:350px;margin-bottom:20px;"></div>
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

