<h5 class="text-center" id="pagename">ค่า PM2.5 รายชั่วโมง จากสถานีเครื่องวัดที่อยู่ในระยะ</h5>
<div class="text-center mb-3">
	<button type="button" class="btn btn-sm btn-locations btn-secondary" style="margin-right: 10px;"> 10 km </button>
	<button type="button" class="btn btn-sm btn-locations btn-secondary" style="margin-right: 10px;"> 20 km </button>
	<button type="button" class="btn btn-sm btn-locations btn-success" style="margin-right: 10px;"> All </button>
</div>

<div class="loader">
	<p class="text-center text-warning">กรุณาอนุญาตให้อุปกรณ์เข้าถึงตำแหน่งของคุณ</p>
	<p class="text-center"><img style="max-width:100%" src="<?=base_url()?>template/image/loader.gif"></p>
</div>

<p class="text-center update-time"></p>

<div class="container">
	
	
	<div id="tblResult" class="mb-3 mt-3" style="display:none;">
		<div class="row">
			<div class="col-12">
				<img style="max-width:100%" src="<?=base_url()?>template/image/loader.gif">
			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-12">
			<div class="standard_sqi_legend_footer" style="display:none"></div>
		</div>
	</div>

</div>



