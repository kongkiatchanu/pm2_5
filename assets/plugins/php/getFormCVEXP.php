<div class="container-exp">
	
	<div class="form-group row">
		<label class="control-label col-md-1"><a href="javascript:void(0)" id="del-List" class="btn btn-small btn-danger btn-del" style="float:right;"><i class="fa fa-trash"></i></a></label>
		<div class="col-md-2 col-sm-6 col-6 mb-1">
			<input type="number" name="exp_year[<?=$_GET['count']?>]" class="form-control" placeholder="ปีการศึกษา" maxlength="4" required>
		</div>
		<div class="col-md-7 mb-1">
			<input type="text" name="exp_name[<?=$_GET['count']?>]" class="form-control" placeholder="บริษัท, องค์กร" required>
		</div>
		<div class="col-md-2 mb-1">
			<input type="text" name="exp_position[<?=$_GET['count']?>]" class="form-control" placeholder="ตำแหน่ง" required>
		</div>	
		<input type="hidden" name="exp_id[<?=$_GET['count']?>]">
	</div>
</div>