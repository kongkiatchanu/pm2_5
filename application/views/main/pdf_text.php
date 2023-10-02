<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
    include_once('template/prophecy/pdf/Thaidate/Thaidate.php');
	include_once('template/prophecy/pdf/Thaidate/thaidate-functions.php');
	
	foreach($rsList as $zones){
		if($id==$zones->zone_id){
			$data = $zones->provinces;
		}
	}
	$today_add = date('Y-m-d', strtotime('+1 day', strtotime(date('y-m-d'))));
	$today_add2 = date('Y-m-d', strtotime('+2 day', strtotime(date('y-m-d'))));
	$today_add3 = date('Y-m-d', strtotime('+3 day', strtotime(date('y-m-d'))));
	
	function getPMDate($weather, $d){
		$text = '';
		foreach($weather as $item){
			$d_filter = explode("T",$item->ForecastDate);
			if($d==$d_filter[0]){
				$text= $item->PM25;
			}
		}
		return $text;
	}
?>
<style>
	p.text_header{
		color:#000000;
		font-size: 14px;
		text-align: center;
		/* font-weight: bold; */
	}
	table{
		border-collapse: collapse;
		width: 100%;
		color: #000000;
	}
	table .subject{
		width: 25%;
	}
	table .content{
		width: 75%;
	}
	th,td{
		/* vertical-align: top; */
		/* text-align:left; */
		border: 2px solid #ffffff;
		font-size: 14px;
		/* border: none; */
	}
	table.in_table th,table.in_table td{
		border: none;
	}
	table thead th {
		text-align:left;
	}
	table th.title{
		/* background-color: #cdcdcd; */
		font-size: 14px;
		color: #000000;
	}
	.font12{
		font-size: 12px;
	}
	.color-title{
		background-color: #99bf3d;
	}
	.color{
		background-color: #dedede;
	}
	.text-center{
		text-align:center;
	}
	.align-mid{
		vertical-align:middle;
	}
	.w-100{
		width:100%;
	}
	.w-70{
		width:70%;
	}
	.w-60{
		width:60%;
	}
	.w-30{
		width:30%;
	}
	.w-20{
		width:20%;
	}
	.w-18{
		width:18%;
	}
	.w-10{
		width:10%;
	}
	.h-35{
		/* height: 3px; */
	}
	.text-underline{
		text-decoration: underline;
	}
</style>

<p class="w-100 text-center">
	รายงานค่าฝุ่นละอองขนาดเล็ก (PM2.5) ไมโครกรัมต่อลูกบาศก์เมตรจากเครื่องวัดฝุ่นละออง DustBoy
	<br>
	<span>
		ประจำวันที่ <span style="color:red;"><?php echo thaidate('j F Y'); ?></span> 
		<!-- <b class="text-underline">ข้อมูลรายชั่วโมง ณ เวลา <span style="color:red;">00:00</span> น.</b> -->
	</span>
</p>
<p></p>
	<p> </p>
	<p> </p>
	<p> </p>
	<p> </p>
	<br>
<p style="width: 100%;font-size: 12px;text-align: right;">ที่มา: https://pm2_5.nrct.go.th</p>
<table cellpadding="5">
	<tr>
		<th class="title color text-center w-10 h-35" rowspan="2" style="background-color:#dedede;"><br><br>PM 2.5</th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(0);?>);"> 0-25 ug/m<sup>3</sup> </th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(26);?>);"> 26-37 ug/m<sup>3</sup> </th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(38);?>);"> 38-50 ug/m<sup>3</sup> </th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(51);?>);"> 51-90 ug/m<sup>3</sup> </th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(91);?>);"> > 90 ug/m<sup>3</sup> </th>
	</tr>
	<tr>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(0);?>);"> อากาศดีมาก </th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(26);?>);"> อากาศดี </th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(38);?>);"> อากาศปานกลาง </th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(51);?>);"> เริ่มมีผลกระทบต่อสุขภาพ </th>
		<th class="title text-center w-18 h-35" style="background-color:rgb(<?=color(91);?>);"> มีผลกระทบต่อสุขภาพ </th>
	</tr>
</table>
<p></p>
<table cellpadding="5">
	<thead>
		<tr>
			<th class="title text-center w-60"> </th>
			<th class="title text-center w-10"> <b>วันนี้</b> </th>
			<th class="title text-center w-30" colspan="3"> <b>คาดการณ์</b> </th>
		</tr>
		<tr>
			<th class="title text-center w-60"> <b>สถานนี</b> </th>
			<th class="title text-center w-10"> <b><?php echo thaidate('j') .' '.thaidate('M'); ?></b> </th>
			<th class="title text-center w-10"> <b><?php echo thaidate('j')+1 .' '.thaidate('M'); ?></b> </th>
			<th class="title text-center w-10"> <b><?php echo thaidate('j')+2 .' '.thaidate('M'); ?></b> </th>
			<th class="title text-center w-10"> <b><?php echo thaidate('j')+3 .' '.thaidate('M'); ?></b> </th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($data as $province){?>
		<?php if($province->stations!=null){?>
		<tr>
			<td class="title color-title" colspan="5"><?=$province->province_name_th?></td>
		</tr>
		<?php foreach($province->stations as $station){?>
			<tr>
				<td class="title color w-60"> <b><?= $station->location_name; ?></b> </td>
				<?php if($station->pm25->PM25!=null){ ?>
					<td class="text-center color font12 w-10" style="background-color:rgb(<?=color($station->pm25->PM25);?>);"> <b><?=$station->pm25->PM25;?></b> </td>
				<?php }else{ ?>
					<td class="text-center color font12 w-10"> <b>N/A</b> </td>
				<?php } ?>
				<?php if($station->weather!=null){?>
				<?php 
					$storevalue_1 = getPMDate($station->weather, $today_add);
					$storevalue_2 = getPMDate($station->weather, $today_add2);
					$storevalue_3 = getPMDate($station->weather, $today_add3);
				
				?>
					<td class="text-center color font12 w-10" style="<?=$storevalue_1!=''? 'background-color:rgb('.color($storevalue_1).');':''?>"> <b><?=$storevalue_1!=''?$storevalue_1:'N/A'?></b> </td>
					<td class="text-center color font12 w-10" style="<?=$storevalue_2!=''? 'background-color:rgb('.color($storevalue_2).');':''?>"> <b><?=$storevalue_2!=''?$storevalue_2:'N/A'?></b> </td>
					<td class="text-center color font12 w-10" style="<?=$storevalue_3!=''? 'background-color:rgb('.color($storevalue_3).');':''?>"> <b><?=$storevalue_3!=''?$storevalue_3:'N/A'?></b> </td>
				<?php }else{?>
					<td class="text-center color font12 w-30" colspan="3"> <b>ไม่มีข้อมูล</b> </td>
				<?php }?>
			</tr>
		<?php }?>
		
		<?php }?>
	<?php }?>
	</tbody>
</table>

