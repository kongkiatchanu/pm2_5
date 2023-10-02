<?php 
	function translate($label){
		$ci=& get_instance();
		$rs=$ci->lang->line($label);
		if($rs){
			return $rs;
		}else{
			return $label;
		}
	}
	
	function ConvertToThaiDateHeader ($strDate) {
		$nameOfDay = date('D', strtotime($strDate));
		$arDayName =array(
			'Sun'=>	'วันอาทิตย์',
			'Mon'=>	'วันจันทร์',
			'Tue'=>	'วันอังคาร',
			'Wed'=>	'วันพุธ',
			'Thu'=>	'วันพฤหัสบดี',
			'Fri'=>	'วันศุกร์',
			'Sat'=>	'วันเสาร์',
		);
		return $arDayName[$nameOfDay];
	}
	
	function ConvertToThaiDate($strDate,$short)
	{
		if($short){
			$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		}else{
			$strMonthCut = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		}
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	
	function ConvertToThaiDateCutYear($strDate,$short)
	{
		if($short){
			$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		}else{
			$strMonthCut = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		}
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai";
	}
	
	function ConvertToThaiDateMonth($strDate,$short)
	{
		if($short){
			$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		}else{
			$strMonthCut = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		}
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strYear = substr($strYear,2,2);
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strMonthThai$strYear";
	}
	
	
	function ConvertToThaiDateForcast ($date,$short) {
		
		if($date){
			if($short){
				$MONTH = array("", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			}else{
				$MONTH = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			}
			$dt = explode("-", $date);
			$tyear = $dt[0];
			$dt[0] = $dt[2] +0;
			$dt[1] = $MONTH[$dt[1]+0];
			$dt[2] = substr($tyear+543,2,2);
			return join(" ", $dt);
		}else{
			return "<font color=\"#FF0000\">ไม่ระบุ</font>";
		}	
	}
	
	function getAVGDays($date,$short){
		if($date){
			if($short){
				$MONTH = array("", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			}else{
				$MONTH = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			}
			$dt = explode("-", $date);
			$tyear = $dt[0];
			$dt[0] = $dt[2] +0;
			$dt[1] = $MONTH[$dt[1]+0];
			$dt[2] = $tyear+543;
			return join(" ", $dt).' เวลา 00:00-'.substr($date,11,5).' น.';
		}else{
			return "<font color=\"#FF0000\">ไม่ระบุ</font>";
		}	
	}
	
	function getProfileDate($date,$short){
		if($date){
			if($short){
				$MONTH = array("", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			}else{
				$MONTH = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			}
			$dt = explode("-", $date);
			$tyear = $dt[0];
			$dt[0] = $dt[2] +0;
			$dt[1] = $MONTH[$dt[1]+0];
			$dt[2] = $tyear+543;
			return join(" ", $dt);
		}else{
			return "<font color=\"#FF0000\">ไม่ระบุ</font>";
		}
	}
	function getProfilehour($date){
		if($date){
			return substr($date,11,5).' น.';
		}else{
			return "<font color=\"#FF0000\">ไม่ระบุ</font>";
		}
	}
	
	function getAVGHour($date,$short){
		if($date){
			if($short){
				$MONTH = array("", "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
			}else{
				$MONTH = array(1=>"มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
			}
			$dt = explode("-", $date);
			$tyear = $dt[0];
			$dt[0] = $dt[2] +0;
			$dt[1] = $MONTH[$dt[1]+0];
			$dt[2] = $tyear+543;
			return join(" ", $dt).' เวลา '.substr($date,11,5).' น.';
		}else{
			return "<font color=\"#FF0000\">ไม่ระบุ</font>";
		}	
	}
	
	function getDustboyVersion($id){
		$text = '[';
		if($id<5000){
			$text .= 'PRO' ;
		}else{
			$text .= 'IN' ;
		}
		if($id>2000 && $id<3000){
			$text .= '-NB' ;
		}
		$text .= ']';
		
		return $text;
	}
	
	function txtDescription($txt,$shot){
		return strip_tags(mb_substr($txt,0,$shot,'utf-8'));
		
	}
	
	function addhttp($url) {
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			$url = "http://" . $url;
		}
		return $url;
	}
	
	function calAQIPM10($val){
	
		if($val<=50){
			$data = (((25-0)*($val-0))/(50-0))+0;
		}else if(($val<=80) && ($val>50)){
			$data = (((50-25)*($val-50))/(80-50))+25;
		}else if(($val<=120) && ($val>80)){
			$data = (((100-50)*($val-80))/(120-80))+50;
		}else if(($val<=180) && ($val>120)){
			$data = (((200-100)*($val-120))/(180-120))+100;
		}else if(($val<=600) && ($val>180)){
			$data = (((500-200)*($val-180))/(600-180))+300;
		}else{
			$data = 500;
		}
		return number_format($data,2);
	}
	
	function map($v,$v1,$v2,$a1,$a2){
		return round($a1+ ($a2-$a1)*($v-$v1)/($v2-$v1));
	}

	function calAQIPM25($val){
		/*
		if($val<=25){
			$data = (((25-0)*($val-0))/(25-0))+0;
		}else if($val<=37 && $val>25){
			$data = (((50-26)*($val-26))/(37-26))+26;
		}else if($val<=50 && $val>37){
			$data = (((100-51)*($val-38))/(50-38))+51;
		}else if($val<=90 && $val>50){
			$data = (((200-101)*($val-51))/(90-51))+101;
		}else if($val<=600 && $val>90){
			$data = (((500-201)*($val-91))/(600-91))+201;
		}else{
			$data = 500;
		}
		return number_format($data,2);*/
		if(round($val)<=25){
			$data =map(round($val),0,25,0,25);
		}else if(round($val)>25 && round($val)<=37){
			$data = map(round($val),26,37,26,50);
		}else if(round($val)>37 && round($val)<=50){
			$data = map(round($val),38,50,51,100);
		}else if(round($val)>50 && round($val)<=90){
			$data = map(round($val),51,90,101,200);
		}else if(round($val)>90){
			$data = round($val)-90+200;
		}
		return $data;
	}
	
	function report_type($val){
		if($val<=50){
			$txt = 'good';
		}else if($val>50 && $val<=100){
			$txt = 'moderate';
		}else if($val>100 && $val<=200){
			$txt = 'unhealthy';
		}else if($val>200 && $val<=300){
			$txt = 'very-unhealthy';
		}else if($val>300 && $val<=600){
			$txt = 'hazardous';
		}else{
			$txt = 'hazardous';
		}
		return $txt;
	}
	
	function report_type_test($val){
		if($val<=15){
			$txt = '1';
		}else if($val>15 && $val<=25){
			$txt = '2';
		}else if($val>25 && $val<=37){
			$txt = '3';
		}else if($val>37 && $val<=75){
			$txt = '4';
		}else if($val>75 && $val<=600){
			$txt = '5';
		}else{
			$txt = '5';
		}
		return $txt;
	}
	
	function report_type_test_text($val){
		if($val<=15){
			$txt = '01b0f1';
		}else if($val>15 && $val<=25){
			$txt = '00af50';
		}else if($val>25 && $val<=37){
			$txt = 'ffff01';
		}else if($val>37 && $val<=75){
			$txt = 'f46e0b';
		}else if($val>75 && $val<=600){
			$txt = 'fe0000';
		}else{
			$txt = 'fe0000';
		}
		return $txt;
	}

	function report_typePM10($val){
		if($val>0){
			if($val<=50){
				$txt = 'good';
			}else if($val>50 && $val<=80){
				$txt = 'moderate';
			}else if($val>80 && $val<=120){
				$txt = 'unhealthy';
			}else if($val>120 && $val<=180){
				$txt = 'very-unhealthy';
			}else if($val>180 && $val<=600){
				$txt = 'hazardous';
			}else{
				$txt = 'hazardous';
			}
		}else{
			$txt = 'vempty';
		}
		return $txt;
	}
	
	function report_typePM25($val){
		if($val>0){
			if($val<=15){
				$txt = 'good';
			}else if($val>15 && $val<=25){
				$txt = 'moderate';
			}else if($val>25 && $val<=37){
				$txt = 'unhealthy';
			}else if($val>37 && $val<=75){
				$txt = 'very-unhealthy';
			}else if($val>75 && $val<=600){
				$txt = 'hazardous';
			}else{
				$txt = 'hazardous';
			}
		}else{
			$txt = 'vempty';
		}
		return $txt;
	}
	
	function report_typeAQI($val){
		if($val>0){
			if($val<=25){
				$txt = 'good';
			}else if($val>25 && $val<=50){
				$txt = 'moderate';
			}else if($val>50 && $val<=100){
				$txt = 'unhealthy';
			}else if($val>100 && $val<=200){
				$txt = 'very-unhealthy';
			}else if($val>200 && $val<=600){
				$txt = 'hazardous';
			}else{
				$txt = 'hazardous';
			}
		}else{
			$txt = 'vempty';
		}
		return $txt;
	}
	
	function od_display($val){
		if($val>0){
			if($val<=25){
				$txt = 'good';
			}else if($val>25 && $val<=50){
				$txt = 'mod';
			}else if($val>50 && $val<=100){
				$txt = 'un';
			}else if($val>100 && $val<=200){
				$txt = 'veryun';
			}else if($val>200 && $val<=600){
				$txt = 'haza';
			}else{
				$txt = 'haza';
			}
		}else{
			$txt = 'vempty';
		}
		return $txt;
	}
	
	function calAQIImg($val){
		if($val>0){
			if($val<=25){
				$img = 1;
			}else if($val>25 && $val<=50){
				$img = 2;
			}else if($val>50 && $val<=100){
				$img = 3;
			}else if($val>100 && $val<=200){
				$img = 4;
			}else if($val>200 && $val<=600){
				$img = 5;
			}else{
				$img = 5;
			}
		}else{
			$img = 0;
		}
		return $img;
	}
	
	function getStationsGroup($s){
		
		
		$name = array(
			' Other ', 
			' CNX ', 
			' BKK ', 
			' Southeast Asia ', 
			' Meahongson ', 
			' Phayao  ', 
			' Phrae ', 
			' Chiang rai ', 
			' Tak ', 
			' Lampang ',
			' Lamphun ',
			' Nan '
			);

		return trim($name[$s]);
	}
	
	function usPM25AQI($val){
		$data = 0;
		if($val>0){
			if($val<=12){
				$data=(((50-0)*($val-0))/(12-0))+0;
			}
			else if( ($val<=35.4) && ($val>12) ){
				$data=(((100-50)*($val-12))/(35.4-12))+50;
			}
			else if( ($val<=55.4) && ($val>35.4) ){
				$data=(((150-100)*($val-35.4))/(55.4-35.4))+100;
			}
			else if( ($val<=150.4) && ($val>55.4) ){
				$data=(((200-150)*($val-55.4))/(150.4-55.4))+150;
			}
			else if( ($val<=250.4) && ($val>150.4) ){
				$data=(((300-200)*($val-150.4))/(250.4-150.4))+200;
			}
			else if( ($val<=350.4) && ($val>250.4) ){
				$data=(((400-300)*($val-250.4))/(350.4-250.4))+300;
			}
			else if( ($val>350.4) ){
				$data=(((500-400)*($val-350.4))/(500.4-350.4))+400;
			}
			return number_format($data,2);
		}
	}
	function usPM10AQI($val){
		$data = 0;
		if($val>0){
			if($val<=54){
				$data=(((50-0)*($val-0))/(54-0))+0;
			}
			else if(($val<=154) && ($val>54)){
				$data=(((100-50)*($val-54))/(154-54))+50;
			}
			else if(($val<=254) && ($val>154)){
				$data=(((150-100)*($val-154))/(254-154))+100;
			}
			else if(($val<=354) && ($val>254)){
				$data=(((200-150)*($val-254))/(354-254))+150;
			}
			else if(($val<=424) && ($val>354)){
				$data=(((300-200)*($val-354))/(424-354))+200;
			}
			else if(($val<=504) && ($val>424)){
				$data=(((400-300)*($val-424))/(504-424))+300;
			}
			else if(($val>504)){
				$data=(((500-400)*($val-504))/(604-504))+400;
			}
			return number_format($data,2);
		}
	}
	
	function report_typeUSAQI($val){
		$data = 0;
		if($val>0){
			if($val<=50){
				$data="bg-green";
			}
			else if(($val<=100) && ($val>50)){
				$data="bg-yellow";
			}
			else if(($val<=150) && ($val>100)){
				$data="bg-orange";
			}
			else if(($val<=200) && ($val>150)){
				$data="bg-red";
			}
			else if(($val<=300) && ($val>200)){
				$data="bg-purper";
			}
			else if(($val<=500) && ($val>300)){
				$data="bg-blood";
			}
			else if(($val>504)){
				$data="bg-blood";
			}
			return $data;
		}
	}
	
	function report_typeUSAQI2($val){
		$data = 0;
		if($val>0){
			if($val<=54){
				$data="bg-green";
			}
			else if(($val<=154) && ($val>54)){
				$data="bg-yellow";
			}
			else if(($val<=254) && ($val>154)){
				$data="bg-orange";
			}
			else if(($val<=354) && ($val>254)){
				$data="bg-red";
			}
			else if(($val<=424) && ($val>354)){
				$data="bg-purper";
			}
			else if(($val<=504) && ($val>424)){
				$data="bg-blood";
			}
			else if(($val>500)){
				$data="bg-blood";
			}
			return $data;
		}
	}
	
	function calUSAQIImg($val){
		$data = 0;
		if($val>0){
			if($val<=50){
				$data="us_1";
			}
			else if(($val<=100) && ($val>50)){
				$data="us_2";
			}
			else if(($val<=150) && ($val>100)){
				$data="us_3";
			}
			else if(($val<=200) && ($val>150)){
				$data="us_4";
			}
			else if(($val<=300) && ($val>200)){
				$data="us_5";
			}
			else if(($val<=500) && ($val>300)){
				$data="us_6";
			}
			else if(($val>500)){
				$data="us_6";
			}
			return $data;
		}
	}
	
	function calUSAQIImg2($val){
		$data = 0;
		if($val>0){
			if($val<=54){
				$data="us_1";
			}
			else if(($val<=154) && ($val>54)){
				$data="us_2";
			}
			else if(($val<=254) && ($val>154)){
				$data="us_3";
			}
			else if(($val<=354) && ($val>254)){
				$data="us_4";
			}
			else if(($val<=424) && ($val>354)){
				$data="us_5";
			}
			else if(($val<=504) && ($val>424)){
				$data="us_6";
			}
			else if(($val>504)){
				$data="us_6";
			}
			return $data;
		}
	}
	
	function getDBModel(){
		$ar = array(
			'PRO' 	=>'Model PRO',
			'IN' 	=>'Model IN', 
			'N'		=>'Model N', 
			'P'		=>'Model P',
			'NB-CMMC'	=>'Model NB-CMMC',
			'NB-TIC'	=>'Model NB-TIC',
		);
		return $ar;
	}

	function getHospital($id=null){
		$ar_hospital = array(
			'10713'	=> 'โรงพยาบาลนครพิงค์',
			'11119'	=> 'โรงพยาบาลจอมทอง',
			'11120'	=> 'โรงพยาบาลเทพรัตนเวชชานุกูล เฉลิมพระเกียรติ ๖๐ พรรษา',
			'11121'	=> 'โรงพยาบาลเชียงดาว',
			'11122'	=> 'โรงพยาบาลดอยสะเก็ด',
			'11123'	=> 'โรงพยาบาลแม่แตง',
			'11124'	=> 'โรงพยาบาลสะเมิง',
			'11125'	=> 'โรงพยาบาลฝาง',
			'11126'	=> 'โรงพยาบาลแม่อาย',
			'11127'	=> 'โรงพยาบาลพร้าว',
			'11128'	=> 'โรงพยาบาลสันป่าตอง',
			'11129'	=> 'โรงพยาบาลสันกำแพง',
			'11131'	=> 'โรงพยาบาลหางดง',
			'11132'	=> 'โรงพยาบาลฮอด',
			'11133'	=> 'โรงพยาบาลดอยเต่า',
			'11134'	=> 'โรงพยาบาลอมก๋อย',
			'11135'	=> 'โรงพยาบาลสารภี',
			'11137'	=> 'โรงพยาบาลไชยปราการ',
			'11138'	=> 'โรงพยาบาลแม่วาง',
		);
		
	
		return $id!=''? $ar_hospital[$id]:$ar_hospital;

	}

	function getDisease($id){
		$ar = array(
			'I00'	=> 'กลุ่มโรคหัวใจและหลอดเลือดรวมทุกชนิด',
				'I64'	=> 'อัมพาตฉับพลัน',
				'I21'	=> 'กล้ามเนื้อหัวใจตายฉับพลัน',
				'I50'	=> 'หัวใจล้มเหลว',
				'I60'	=> 'หลอดเลือดสมอง',
				'I67'	=> 'หลอดเลือดสมองอื่น',
			'J00'	=> 'กลุ่มโรคทางเดินหายใจรวมทุกชนิด',
				'J10'	=> 'ไข้หวัดใหญ่ร่วมกับปอดบวม ตรวจพบไวรัสไข้หวัดใหญ่',
				'J11'	=> 'ไข้หวัดใหญ่ร่วมกับปอดบวม ตรวจไม่พบไวรัสไข้หวัดใหญ่',
				'J12'	=> 'ปอดบวม',
				'J44'	=> 'ปอดอุดกั้นเรื้อรัง',
				'J45'	=> 'หืด',
				'J46'	=> 'หืดในระยะเฉียบพลัน',
		);
		return $ar[$id];
	}
	
	function th_strcoll($stringA, $stringB)
{
	$regex = '(^[เแโใไ]*)((.)(.*))';
	$matchesA = $matchesB = null;
	mb_ereg($regex, $stringA, $matchesA);
	mb_ereg($regex, $stringB, $matchesB);

	if ($matchesA[1] !== $matchesB[1] && $matchesA[3] === $matchesB[3]) {
		if ($matchesA[1] === false) {
			return -1;
		} else if ($matchesB[1] === false) {
			return 1;
		} else {
			return strcoll($matchesA[1], $matchesB[1]);
		}
	}
	
	return strcoll($matchesA[2], $matchesB[2]);
}
function color($pm25){
	$color = '';
	if($pm25>=0&&$pm25<26){    
		$color = '0,191,243';
	}else if($pm25>=26&&$pm25<38){
		$color = '0,166,81';
	}else if($pm25>=38&&$pm25<51){
		$color = '253,192,78';
	}else if($pm25>=51&&$pm25<91){
		$color = '242,101,34';
	}else if($pm25>=91&&$pm25<1000){
		$color = '205,0,0';
	}else{
		$color = '255,255,255';
	}
	return $color;
}
function color_th($pm25){
	$color = '';
	if($pm25>=0&&$pm25<26){    
		$color = array(0,191,243);
	}else if($pm25>=26&&$pm25<38){
		$color = array(0,166,81);
	}else if($pm25>=38&&$pm25<51){
		$color = array(253,192,78);
	}else if($pm25>=51&&$pm25<91){
		$color = array(242,101,34);
	}else if($pm25>=91&&$pm25<1000){
		$color = array(205,0,0);
	}else{
		$color = array(255,255,255);
	}
	return $color;
}
function color_us($pm25){
	$color = '';
	if($pm25>=1&&$pm25<=12){    
		$color = array(0, 153, 107);
	}else if($pm25>=13&&$pm25<=35){
		$color = array(253, 192, 78);
	}else if($pm25>=36&&$pm25<=55){
		$color = array(235, 132, 63);
	}else if($pm25>=56&&$pm25<=150){
		$color = array(205, 0, 0);
	}else if($pm25>=151&&$pm25<=250){
		$color = array(129, 21, 185);
	}else if($pm25>=251&&$pm25<999){
		$color = array(160, 7, 54);
	}else{
		$color = array(82, 86, 89);
	}
	return $color;
}

function color_us_type($pm25){
	$type = '1';
	if($pm25>=1&&$pm25<=12){    
		$type = '1';
	}else if($pm25>=13&&$pm25<=35){
		$type = '2';
	}else if($pm25>=36&&$pm25<=55){
		$type = '3';
	}else if($pm25>=56&&$pm25<=150){
		$type = '4';
	}else if($pm25>=151&&$pm25<=250){
		$type = '5';
	}else if($pm25>=251&&$pm25<999){
		$type = '6';
	}else{
		$type = '0';
	}
	return $type;
}

function color_dev_type($pm25){
	$type = '1';
	if($pm25>=1&&$pm25<=15){    
		$type = '1';
	}else if($pm25>=15.1&&$pm25<=25){
		$type = '2';
	}else if($pm25>=25.1&&$pm25<=37.5){
		$type = '3';
	}else if($pm25>=37.6&&$pm25<=75){
		$type = '4';
	}else if($pm25>=75){
		$type = '5';
	}else{
		$type = '0';
	}
	return $type;
}
function pin_nrct($pm25){
	$pin = '';
	if($pm25>=0&&$pm25<=25.9){    
		$pin = 'pin-01.png';
	}else if($pm25>=26&&$pm25<=37.9){
		$pin = 'pin-02.png';
	}else if($pm25>=38&&$pm25<=50.9){
		$pin = 'pin-03.png';
	}else if($pm25>=51&&$pm25<=90.9){
		$pin = 'pin-04.png';
	}else{
		$pin = 'pin-05.png';
	}
	return $pin;
}
function line_nrct($pm25){
	$line = '';
	if($pm25>=0&&$pm25<=25.9){    
		$line = 'line1.png';
	}else if($pm25>=26&&$pm25<=37.9){
		$line = 'line2.png';
	}else if($pm25>=38&&$pm25<=50.9){
		$line = 'line3.png';
	}else if($pm25>=51&&$pm25<=90.9){
		$line = 'line4.png';
	}else{
		$line = 'line5.png';
	}
	return $line;
}
function ConvertToThaiDate_l($date) {
	if($date){
		$date == 'Monday'?$date = 'จันทร์':'';
		$date == 'Tuesday'?$date = 'อังคาร':'';
		$date == 'Wednesday'?$date = 'พุธ':'';
		$date == 'Thursday'?$date = 'พฤหัสบดี':'';
		$date == 'Friday'?$date = 'ศุกร์':'';
		$date == 'Saturday'?$date = 'เสาร์':'';
		$date == 'Sunday'?$date = 'อาทิตย์':'';
		return $date;
	}else{
		return "<font color=\"#FF0000\">ไม่ระบุ</font>";
	}	
}
function ConvertToThaiDate_m($date) {
	if($date){
		$date == 1?$date = 'มกราคม':'';
		$date == 2?$date = 'กุมภาพันธ์':'';
		$date == 3?$date = 'มีนาคม':'';
		$date == 4?$date = 'เมษายน':'';
		$date == 5?$date = 'พฤษภาคม':'';
		$date == 6?$date = 'มิถุนายน':'';
		$date == 7?$date = 'กรกฎาคม':'';
		$date == 8?$date = 'สิงหาคม':'';
		$date == 9?$date = 'กันยายน':'';
		$date == 10?$date = 'ตุลาคม':'';
		$date == 11?$date = 'พฤศจิกายน':'';
		$date == 12?$date = 'ธันวาคม':'';
		return $date;
	}else{
		return "<font color=\"#FF0000\">ไม่ระบุ</font>";
	}	
}
?>