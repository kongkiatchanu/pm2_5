<style>
.table-column-custom:nth-of-type(2) {
  text-align: left !important;
  -ms-flex-preferred-size: 50%;
  flex-basis: 60%;
  font-size: 14px;
  -webkit-box-pack: start;
  -ms-flex-pack: start;
  justify-content: flex-start;
  white-space: nowrap;
  text-overflow: ellipsis;
  display: block;
  overflow: hidden;
}
.table-column:first-of-type {
  flex-basis: 10%;
}
.table-column:nth-of-type(3),
.table-column:nth-of-type(4) {
  flex-basis: 30%;
  text-align: center;
}
</style>
<h5 class="text-center"><span id="rgname">อันดับค่าฝุ่นทุกสถานี</span></h5>
<div class="text-center mb-3">
	<button type="button" class="btn btn-sm btn-top btn-secondary" top="10" style="margin-right: 10px;"> Top 10 </button>
	<button type="button" class="btn btn-sm btn-top btn-secondary" top="20" style="margin-right: 10px;"> Top 20</button>
	<button type="button" class="btn btn-sm btn-top btn-success" top="All" style="margin-right: 10px;"> All </button>
	<button type="button" class="btn btn-sm btn-search" style="margin-right: 10px;" data-toggle="modal" data-target="#searchModel"><i class="fa fa-filter"></i></button>
</div>

<div class="loader">
	<p class="text-center text-warning">กำลังประมวลผล</p>
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
		<input type="text" class="form-control mb-2" id="txt_search" placeholder="ค้นหา" onkeyup="filter()"/>
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


