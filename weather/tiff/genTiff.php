<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

for($i=0; $i<=date('H'); $i++){
	$hour = $i;
	if($i<10){
		$hour = '0'.$i;
	}
	$point = 'pm25_all_stn_'.date('Ymd').$hour.'-colored-mask.tiff';
	$file = 'https://thaq.soc.cmu.ac.th/tmp/stn_obs/pm2.5/'.$point;
	$newfile = '/home/pm25v2/public_html/uploads/tiff/'.$point;
        echo $newfile."\n";
	if(!file_exists($newfile)){
		
		@copy($file, $newfile);
	}
}

