<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"/>
<h5 class="text-center"><span id="rgname"></span></h5>
<h5 class="text-center"><span id="rgname2"><?=$rs->station_name_th?></span></h5>


<div class="container">
	<div class="row">
		<div class="col-12">
			<div id="chart_container">
			<?php if($rs->forecast_days){?>
				<?php $i=0;foreach($rs->forecast_days as $k=>$v){$i++;?>
				<?php if($i>1){?>
					<div class="card mb-3" id="card_<?=$k?>">
						<div class="card-header bg_color" style="background-color: rgb(<?=$v->day_th_color?>);">
							<div class="row">
								<div class="col-3 text-center"><img class="bg_icon" alt="image" src="/template/image/<?=$v->day_th_icon?>.svg" width="59" height="85"></div>
								<div class="col-9" style="background-color: rgb(255,255,255);">
									<p class="text-center day_name"> <?=$v->day_name_th?> </p>
									<div class="text-center bg_color" style="padding: 5px; color: rgb(255,255,255); background-color: rgb(<?=$v->day_th_color?>);"> <span class="avg_name">PM2.5 เฉลี่ย</span> : <?=$v->day_avg_pm25?> (μg/m<sup>3</sup>) </div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<canvas id="my-chart-<?=$k?>"></canvas>
						</div>
					</div>
				<?php }?>
				<?php }?>
			<?php }else{echo '<p class="text-center">ไม่มีช้อมูล</p>';}?>
			</div>
		</div>
	</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>