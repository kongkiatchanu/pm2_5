<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public $siteinfo=array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		$this->load->model('main_model');
		$this->load->library('PDF2');
		$this->site_cache();
	}
	
	function site_cache(){
		
		$this->siteinfo['site_img'] 		= site_url().'uploads/timthumb.php?src='.site_url().'template/image/fb_share.jpg&w=476&h=249';
		$this->siteinfo['site_title']		='Air Quality Information Center';
		$this->siteinfo['site_keyword'] 	='pm2.5, pm10, หมวกควัน, NRCT';
		$this->siteinfo['site_des'] 		='สำนักงานการวิจัยแห่งชาติ (วช).';
	}
	
	public function createMapImage(){
		if($_POST){
			$data = $_POST['photo'];
			list($type, $data) = explode(';', $data);
			list(, $data)      = explode(',', $data);
			$data = base64_decode($data);
			
			$file_name = $_POST['mapid'].'-'.date('YmdH');

			file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/uploads/reports/".$file_name.'.png', $data);
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/uploads/reports/".$file_name.'.png')) {
				echo 1;
			} 
			die;
		}
	}

	public function cache_station(){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		if ( ! $stations = $this->cache->get('stations'))
		{
			$url = 'https://www-old.cmuccdc.org/api2/dustboy/stations';
			$rs = json_decode(file_get_contents($url));

			$this->cache->save('stations', $stations, 600);
		}

		echo json_encode($stations);
	}
	
	function cropImage($imagePath,$id) {
		$image = imagecreatefrompng($imagePath);
		$filename = $_SERVER['DOCUMENT_ROOT'] . '/uploads/reports/cropped_map_'.$id.'.png';

		$thumb_width = 750;
		$thumb_height = 230;

		$width = imagesx($image);
		$height = imagesy($image);

		$original_aspect = $width / $height;
		$thumb_aspect = $thumb_width / $thumb_height;

		if ( $original_aspect >= $thumb_aspect )
		{
		   // If image is wider than thumbnail (in aspect ratio sense)
		   $new_height = $thumb_height;
		   $new_width = $width / ($height / $thumb_height);
		}
		else
		{
		   // If the thumbnail is wider than the image
		   $new_width = $thumb_width;
		   $new_height = $height / ($width / $thumb_width);
		}

		$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

		// Resize and crop
		imagecopyresampled($thumb,
						   $image,
						   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
						   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
						   10, 0,
						   $new_width, $new_height,
						   ($width-10), $height);
		imagejpeg($thumb, $filename, 80);
	}
	
	
	public function prophecy_export(){
		$id = $this->uri->segment(2);
		if($id){
			$file_name = 'http://202.28.244.195/pm2_5_uploads_reports/'.$id.'-'.date('YmdH').'.png?v='.date('Ymdhis');
			$this->cropImage($file_name, $id);
			$this->createPDF($id);
		}
	}
	
	function createPDF($id){
		$cover_image = 'http://202.28.244.195/pm2_5_uploads_reports/cropped_map_'.$id.'.png?v='.date('Ymdhis');
	
		$pdf = new PDF2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// กำหนดรายละเอียดของ pdf
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CMUCCDC');
		$pdf->SetTitle('รายงานค่ามลพิษทางอากาศ ฝุ่นละอองขนาดเล็ก (PM2.5)');
		$pdf->SetSubject('ReportPM2.5');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		
		// กำหนดข้อมูลที่จะแสดงในส่วนของ header และ footer
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// $pdf->setFooterData(array(0,64,0), array(0,64,128));
		

		// กำหนดรูปแบบของฟอนท์และขนาดฟอนท์ที่ใช้ใน header และ footer
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// กำหนดค่าเริ่มต้นของฟอนท์แบบ monospaced 
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		// กำหนด margins
		$pdf->SetMargins(15, PDF_MARGIN_TOP, 15);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		// กำหนดการแบ่งหน้าอัตโนมัติ
		// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// กำหนดรูปแบบการปรับขนาดของรูปภาพ 
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// ---------------------------------------------------------
		

		// กำหนดฟอนท์ 
		// ฟอนท์ freeserif รองรับภาษาไทย
		$pdf->SetFont('thsarabunpskb', '', 14, '', true);
		
		// เพิ่มหน้า pdf
		// การกำหนดในส่วนนี้ สามารถปรับรูปแบบต่างๆ ได้ ดูวิธีใช้งานที่คู่มือของ tcpdf เพิ่มเติม
		$pdf->AddPage();
		
		$pdf->Image($cover_image, 15, 45, 180, 80, 'JPG', '', '', false, 300, '', false, false, 0, true, false, false);
		$pdf->SetAutoPageBreak(TRUE, 29);
		//$html = file_get_contents(base_url('main/pdf_pm25/'.$id));
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  

		$html = file_get_contents(base_url('main/pdf_pm25/'.$id), false, stream_context_create($arrContextOptions));
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('ReportPM25_TEST_'.date('YmdH').'.pdf', 'I');
	}
	
	public function pdf_pm25(){
		$id = $this->uri->segment(3);
		$json_data = file_get_contents('https://www-old.cmuccdc.org/api2/dustboy/regionreport');
		$data = array(
			'id'		=> $id,
			'rsList'	=> json_decode($json_data)
		);
		$this->load->view('main/pdf_text',$data);
	}
	
	public function index()
	{
		/*
		$path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tiff/';
		$files = array_diff(scandir($path), array('.', '..'));

		$vmap_file= $files[(count($files)+1)];
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"_pageLink"			=> 'home',
			"vmap_file"			=> $vmap_file
		);
		*/
		$point = 'pm25_all_stn_'.date('YmdH').'-colored-mask.tiff';
		$point_us = 'pm25_all_stn_'.date('YmdH').'-colored-mask-us.tiff';
		$file = 'https://thaq.soc.cmu.ac.th/tmp/stn_obs/pm2.5/'.$point;
		$file_us = 'https://thaq.soc.cmu.ac.th/tmp/stn_obs/pm2.5/'.$point_us;
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"_pageLink"			=> 'home',
			"vmap_file" 		=> $file,
			"vmap_file_us" 		=> $file_us,
		);
				
		$this->load->view("main/index",$rs);	
	}
	
	public function index_dev()
	{
		/*
		$path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tiff/';
		$files = array_diff(scandir($path), array('.', '..'));

		$vmap_file= $files[(count($files)+1)];
		*/
		$point = 'pm25_all_stn_'.date('YmdH').'-colored-mask.tiff';
		$point_us = 'pm25_all_stn_'.date('YmdH').'-colored-mask-us.tiff';
		$file = 'https://thaq.soc.cmu.ac.th/tmp/stn_obs/pm2.5/'.$point;
		$file_us = 'https://thaq.soc.cmu.ac.th/tmp/stn_obs/pm2.5/'.$point_us;
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"_pageLink"			=> 'home',
			"vmap_file" 		=> $file,
			"vmap_file_us" 		=> $file_us,
		);
				
		$this->load->view("main/index_dev",$rs);	
	}
	
	public function pmhours(){
		$this->siteinfo['site_title'] = 'PM2.5 ตามพิกัด | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"view"				=> 'main/pmhours',
			"_pageLink"			=> 'pmhours'
		);
				
		$this->load->view("main/template_main",$rs);	
	}
	
	public function rankhours(){
		$this->siteinfo['site_title'] = 'ค่าฝุ่นรายชั่วโมง | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"view"				=> 'main/rankhours',
			"_pageLink"			=> 'rankhours'
		);
				
		$this->load->view("main/template_main",$rs);	
	}
	
	public function rankdailys(){
		$this->siteinfo['site_title'] = 'ค่าฝุ่นรายวัน | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"view"				=> 'main/rankdailys',
			"_pageLink"			=> 'rankdailys'
		);
				
		$this->load->view("main/template_main",$rs);	
	}
	
	public function prophecy(){
		$this->siteinfo['site_title'] = 'ค่าพยากรณ์ PM2.5 ล่วงหน้า | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"view"				=> 'main/prophecy2',
			"_pageLink"			=> 'prophecy'
		);
				
		$this->load->view("main/prophecy2",$rs);	
	}
	
	public function contactus(){
		$this->siteinfo['site_title'] = 'ติดต่อเรา | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"view"				=> 'main/contactus',
			"_pageLink"			=> 'contactus'
		);
				
		$this->load->view("main/template_main",$rs);
	}
	
	public function snapshot(){
		$this->siteinfo['site_title'] = 'Snapshot | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"view"				=> 'main/snapshot',
			"_pageLink"			=> 'snapshot'
		);
				
		$this->load->view("main/template_main",$rs);
		
	}

	public function hotspot(){
		$this->siteinfo['site_title'] = 'Hotspot | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"view"				=> 'main/hotspot',
			"_pageLink"			=> 'hotspot'
		);
				
		$this->load->view("main/hotspot",$rs);
	}

	public function hotspot_dev(){
		$this->siteinfo['site_title'] = 'Hotspot | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			"view"				=> 'main/hotspot',
			"_pageLink"			=> 'hotspot'
		);
				
		$this->load->view("main/hotspot_dev",$rs);
	}
	
	public function news(){
		$this->siteinfo['site_title'] = 'ข่าวสาร | Air Quality Information Center';
		
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);  

		$response = file_get_contents(site_url().'api/content/list', false, stream_context_create($arrContextOptions));
		$rsList = json_decode($response);
		
		

		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
			'rsList'			=> $rsList,
			"view"				=> 'main/news',
			"_pageLink"			=> 'news'
		);
				
		$this->load->view("main/template_main",$rs);
	}
	
	public function news_detail(){

		$id = $this->uri->segment(2);
		if($id!=null){
			$arrContextOptions=array(
				"ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);  
			$response = file_get_contents(site_url().'api/content/list/'.$id, false, stream_context_create($arrContextOptions));
			$rs = json_decode($response);

			$this->siteinfo['site_title'] = $rs[0]->content_title.' | Air Quality Information Center';

			$rs = array( 
				"siteInfo" 			=> $this->siteinfo,
				'rs'				=> $rs,
				"view"				=> 'main/newsdetail',
				"_pageLink"			=> 'newsdetail'
			);
			$this->load->view("main/template_main",$rs);
		}else{
			redirect(site_url());
		}
	}

	
	public function forecast(){
		$id = $this->uri->segment(2);
		if($id!=null){
			$rs = json_decode(file_get_contents('https://www-old.cmuccdc.org/api2/dustboy/forecast/'.$id));

			if($rs->station_id){
				$this->siteinfo['site_title'] = $rs->station_name_th.' | Air Quality Information Center';
			}else{
				$this->siteinfo['site_title'] = 'Air Quality Information Center';
			}
			

			$rs = array( 
				"siteInfo" 			=> $this->siteinfo,
				'rs'				=> $rs,
				"view"				=> 'main/forecast',
				"_pageLink"			=> 'forecast'
			);
			$this->load->view("main/template_main",$rs);
		}else{
			redirect(site_url());
		}
	}
	public function station(){
		$id = $this->uri->segment(2);
		if($id!=null){
			$arrContextOptions=array(
				"ssl"=>array(
					"verify_peer"=>false,
					"verify_peer_name"=>false,
				),
			);  

			$response = file_get_contents(site_url().'api/station/id/'.$id, false, stream_context_create($arrContextOptions));
			$rs = json_decode($response);
			
			if(@$rs->id){
				$this->siteinfo['site_title'] = $rs->dustboy_name.' | Air Quality Information Center';
			}else{
				$this->siteinfo['site_title'] = 'Air Quality Information Center';
			}
			

			$rs = array( 
				"siteInfo" 			=> $this->siteinfo,
				'rs'				=> $rs,
				"view"				=> 'main/station',
				"_pageLink"			=> 'station'
			);
			$this->load->view("main/station",$rs);
		}else{
			redirect(site_url());
		}
	}
	
	public function dailyreport_dev(){
		$qid = $this->uri->segment(2);
		
		if($qid!=null){
			$this->siteinfo['site_title'] = 'Daily report';
			$rsConfig = $this->main_model->getMarkerConfig(1);
			
			$ar_list = array();
			$data = json_decode($rsConfig[0]->marker_config);
			
			
			foreach($data as $item){
				$rows = explode(",",$item);
				if($rows!=null){
					foreach($rows as $val){
						array_push($ar_list, trim($val));
					}
				}
			}			
		
			$ar_info = array(
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				't'		=> ($qid<10? '0'.$qid:$qid).":00 น.",
				'd'		=> (date('d')*1),
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				'd2'	=> ConvertToThaiDateHeader(date('Y-m-d')).' ที่',
				'temp'	=> ceil($this->temp())
			);
			
			$qid = ($qid<10? '0'.$qid:$qid);
			$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/temp_aun/'.date('Ymd').$qid.'_stations.json?v='.date('Ymd');
			
		
			$stations = json_decode(file_get_contents($uri));
			$data_full = array();
			foreach($stations as $item){
				if (in_array($item->id, $ar_list)){
					$data_full[$item->id] = $item;
				}
			}

			$filename = '/home/pm25v2/public_html/uploads/vmap/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask.png';
			if (!file_exists($filename)) {
			
				$v ='https://thaq.soc.cmu.ac.th/tmp/stn_obs/pm2.5/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask.png';
				$file_name = 'pm25_all_stn_'.date('Ymd').$qid.'-colored-mask.png';

				$arrContextOptions=array(
					"ssl"=>array(
						"verify_peer"=>false,
						"verify_peer_name"=>false,
					),
				);  
				
				$img_file = file_get_contents($v, false, stream_context_create($arrContextOptions));
				
				
				$file_loc=$_SERVER['DOCUMENT_ROOT'].'/uploads/vmap/'.$file_name;
				$file_handler=fopen($file_loc,'w');
				if(fwrite($file_handler,$img_file)==false){
					echo 'error';
				}
				fclose($file_handler);
			}
			$image_map = '/uploads/vmap/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask.png';

			$rs = array( 
				"siteInfo" 			=> $this->siteinfo,
				'ar_info'			=> $ar_info,
				'ar_list'			=> $data_full,
				'image_map'			=> $image_map,
				'rsConfig'			=> $rsConfig,
				"view"				=> 'main/dailyreport_page_dev',
				"_pageLink"			=> 'dailyreport'
			);
			$this->load->view("main/template_main",$rs);
		}else{ redirect(site_url());}
	}

	public function dailyreport_dev3(){
		$qid = $this->uri->segment(2);
		
		if($qid!=null){
			$this->siteinfo['site_title'] = 'Daily report';
			$rsConfig = $this->main_model->getMarkerConfig(1);
			
			$ar_list = array();
			$data = json_decode($rsConfig[0]->marker_config);
			
			
			foreach($data as $item){
				$rows = explode(",",$item);
				if($rows!=null){
					foreach($rows as $val){
						array_push($ar_list, trim($val));
					}
				}
			}			
		
			$ar_info = array(
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				't'		=> ($qid<10? '0'.$qid:$qid).":00 น.",
				'd'		=> (date('d')*1),
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				'd2'	=> ConvertToThaiDateHeader(date('Y-m-d')).' ที่',
				'temp'	=> ceil($this->temp())
			);
			
			$qid = ($qid<10? '0'.$qid:$qid);
			$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/temp_aun/'.date('Ymd').$qid.'_stations.json?v='.date('Ymd');
			
		
			$stations = json_decode(file_get_contents($uri));
			$data_full = array();
			foreach($stations as $item){
				if (in_array($item->id, $ar_list)){
					$data_full[$item->id] = $item;
				}
			}

			$filename = '/home/pm25v2/public_html/uploads/vmap/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask-us.png';
			if (!file_exists($filename)) {
			
				$v ='https://thaq.soc.cmu.ac.th/tmp/stn_obs/pm2.5/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask-us.png';
				$file_name = 'pm25_all_stn_'.date('Ymd').$qid.'-colored-mask-us.png';

				$arrContextOptions=array(
					"ssl"=>array(
						"verify_peer"=>false,
						"verify_peer_name"=>false,
					),
				);  
				
				$img_file = file_get_contents($v, false, stream_context_create($arrContextOptions));
				
				
				$file_loc=$_SERVER['DOCUMENT_ROOT'].'/uploads/vmap/'.$file_name;
				$file_handler=fopen($file_loc,'w');
				if(fwrite($file_handler,$img_file)==false){
					echo 'error';
				}
				fclose($file_handler);
			}
			$image_map = '/uploads/vmap/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask-us.png';

			$rs = array( 
				"siteInfo" 			=> $this->siteinfo,
				'ar_info'			=> $ar_info,
				'ar_list'			=> $data_full,
				'image_map'			=> $image_map,
				'rsConfig'			=> $rsConfig,
				"view"				=> 'main/dailyreport_page_devus',
				"_pageLink"			=> 'dailyreport'
			);
			$this->load->view("main/template_main",$rs);
		}else{ redirect(site_url());}
	}

	public function dailyreport_dev4(){
		$qid = $this->uri->segment(2);
		
		if($qid!=null){
			$this->siteinfo['site_title'] = 'Daily report';
			$rsConfig = $this->main_model->getMarkerConfig(1);
			
			$ar_list = array();
			$data = json_decode($rsConfig[0]->marker_config);
			
			
			foreach($data as $item){
				$rows = explode(",",$item);
				if($rows!=null){
					foreach($rows as $val){
						array_push($ar_list, trim($val));
					}
				}
			}			
		
			$ar_info = array(
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				't'		=> ($qid<10? '0'.$qid:$qid).":00 น.",
				'd'		=> (date('d')*1),
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				'd2'	=> ConvertToThaiDateHeader(date('Y-m-d')).' ที่',
				'temp'	=> ceil($this->temp())
			);
			
			$qid = ($qid<10? '0'.$qid:$qid);
			$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/temp_aun/'.date('Ymd').$qid.'_stations.json?v='.date('Ymd');
			
		
			$stations = json_decode(file_get_contents($uri));
			$data_full = array();
			foreach($stations as $item){
				if (in_array($item->id, $ar_list)){
					$data_full[$item->id] = $item;
				}
			}

			// $filename = '/home/pm25v2/public_html/uploads/vmap/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask-us.png';
			// if (!file_exists($filename)) {
			
			// 	$v ='https://thaq.soc.cmu.ac.th/tmp/stn_obs/pm2.5/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask-us.png';
			// 	$file_name = 'pm25_all_stn_'.date('Ymd').$qid.'-colored-mask-us.png';

			// 	$arrContextOptions=array(
			// 		"ssl"=>array(
			// 			"verify_peer"=>false,
			// 			"verify_peer_name"=>false,
			// 		),
			// 	);  
				
			// 	$img_file = file_get_contents($v, false, stream_context_create($arrContextOptions));
				
				
			// 	$file_loc=$_SERVER['DOCUMENT_ROOT'].'/uploads/vmap/'.$file_name;
			// 	$file_handler=fopen($file_loc,'w');
			// 	if(fwrite($file_handler,$img_file)==false){
			// 		echo 'error';
			// 	}
			// 	fclose($file_handler);
			// }
			// $image_map = '/uploads/vmap/pm25_all_stn_'.date('Ymd').$qid.'-colored-mask-us.png';
			$image_map = '';

			$rs = array( 
				"siteInfo" 			=> $this->siteinfo,
				'ar_info'			=> $ar_info,
				'ar_list'			=> $data_full,
				'image_map'			=> $image_map,
				'rsConfig'			=> $rsConfig,
				"view"				=> 'main/dailyreport_page_dev4',
				"_pageLink"			=> 'dailyreport'
			);
			$this->load->view("main/template_main",$rs);
		}else{ redirect(site_url());}
	}

	public function dailyreport(){
		$qid = $this->uri->segment(2);
		
		if($qid!=null){
			$this->siteinfo['site_title'] = 'Daily report';
			$rsConfig = $this->main_model->getMarkerConfig(1);
			
			$ar_list = array();
			$data = json_decode($rsConfig[0]->marker_config);
			
			
			foreach($data as $item){
				$rows = explode(",",$item);
				if($rows!=null){
					foreach($rows as $val){
						array_push($ar_list, trim($val));
					}
				}
			}			
		
			$ar_info = array(
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				't'		=> ($qid<10? '0'.$qid:$qid).":00 น.",
				'd'		=> (date('d')*1),
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				'd2'	=> ConvertToThaiDateHeader(date('Y-m-d')).' ที่',
				'temp'	=> ceil($this->temp())
			);
			
			$qid = ($qid<10? '0'.$qid:$qid);
			$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/temp_aun/'.date('Ymd').$qid.'_stations.json?v='.date('Ymd');
			
			
		
			$stations = json_decode(file_get_contents($uri));
			$data_full = array();
			foreach($stations as $item){
				if (in_array($item->id, $ar_list)){
					$data_full[$item->id] = $item;
				}
			}

			$rs = array( 
				"siteInfo" 			=> $this->siteinfo,
				'ar_info'			=> $ar_info,
				'ar_list'			=> $data_full,
				'rsConfig'			=> $rsConfig,
				"view"				=> 'main/dailyreport_page',
				"_pageLink"			=> 'dailyreport'
			);
			$this->load->view("main/template_main",$rs);
		}else{ redirect(site_url());}
	}
	
	public function definition(){
		// if($rs->station_id){
		// 		$this->siteinfo['site_title'] = 'คำนิยาม | Air Quality Information Center';
		// 	}else{
		// 		$this->siteinfo['site_title'] = 'Definition | Air Quality Information Center';
		// 	}
			$this->siteinfo['site_title'] = 'Definition | Air Quality Information Center';
		$rs = array( 
			"siteInfo" 			=> $this->siteinfo,
				// 'rs'				=> $rs,
			"view"				=> 'main/definition',
			"_pageLink"			=> 'definition'
		);
		$this->load->view("main/template_main",$rs);
	}
	
	public function dailyreportpdf(){
		/*
		$qid = $this->uri->segment(2);
		if($qid){
			$uri = 'https://docs.google.com/gview?embedded=true&url=cmuccdc.org%2Freport%2Fnrct_pm25v5%2F'.$qid;

			$this->siteinfo['site_title'] = 'รายงานค่ามลพิษทางอากาศ ฝุ่นละอองขนาดเล็ก (PM2.5) | Air Quality Information Center';
			$rs = array( 
				"siteInfo" 			=> $this->siteinfo,
				'uri'				=> $uri,
			);
			$this->load->view("main/nrct_report",$rs);
		}else{
			redirect(site_url());
		}
		*/
		$qid = $this->uri->segment(2);
		$m = ConvertToThaiDateMonth(date('Y-m-d'),0);
		$t = ($qid<10? '0'.$qid:$qid).":00 น.";
		$d = date('d');
		$d2 = ConvertToThaiDateHeader(date('Y-m-d')).' ที่';
		$temp = ceil($this->temp());

		
		$id = array(5315,5356,5068,5324,5281,5051,5212,5388,5084,5352,5152,5344,5342,5047);
        $ids = array(5361,6019,5326,5380,5262,4040,5279,5205,5078,5070,5154,5344,5380,5047);
		$default_color = array(125,125,125);		
		$ar_list = array(
			5281=> null,
			5212=> null,
			5047=> null,
			5315=> null,//5319
			5324=> null,
			5152=> null,
			5051=> null,
			5068=> null,
			5084=> null,
			5356=> null,
			5388=> null,
			5344=> null,
			5342=> null,
			5352=> null,
			
			5380=> null,
			5154=> null,
			5070=> null,
			5078=> null,
			5078=> null,
			5205=> null,
			5279=> null,
			4040=> null,
			5262=> null,
			5326=> null,
			6019=> null,
			5361=> null,
		);
		$qid = ($qid<10? '0'.$qid:$qid);
		$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/temp_aun/'.date('Ymd').$qid.'_stations.json?v='.date('Ymd');
		
		
		$stations = json_decode(file_get_contents($uri));
		

		foreach($stations as $item){
			if (array_key_exists($item->id, $ar_list)){
				$ar_list[$item->id] = $item;
			}
		}

		$this->load->library('pdf');
		$this->pdf=new FPDF('P','mm','A4');
				
		$this->pdf->AddPage();
		$this->pdf->SetMargins( 20,30,20 );
		$this->pdf->AddFont('supermarket','','supermarket.php');
		$this->pdf->SetFont('supermarket','',20);
		$this->pdf->Image($this->uri->segment(2)<13? site_url().'template/image/bg-nrctv3.14_7.jpg?v=11':site_url().'template/image/bg-nrctv3.14_16.jpg?v=11', 0, 0, 210, 297, 'JPG');
		
		$this->pdf->SetFont('supermarket','',26);		
		$this->pdf->setXY( 22, 9  );
		$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $temp), 0, 0, 'R' );
		$this->pdf->SetFont('supermarket','',20);
		$this->pdf->setXY( 30, 20  );
		$this->pdf->Cell( 50, 7, iconv( 'UTF-8','cp874' , $d2), 0, 0, 'R' );
		$this->pdf->SetFont('supermarket','',25);
		$this->pdf->setXY( 82, 20  );
		$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $d), 0, 0, 'C' );
		$this->pdf->SetFont('supermarket','',20);
		$this->pdf->setXY( 95, 20  );
		$this->pdf->Cell( 45, 7, iconv( 'UTF-8','cp874' , $m), 0, 0, 'L' );
		$this->pdf->setXY( 145, 20  );
		$this->pdf->Cell( 30, 7, iconv( 'UTF-8','cp874' , $t), 0, 0, 'C' );
		
		

		if($ar_list[5281]!=null || $ar_list[5262]!=null){
			if($ar_list[5281]!=null){
				$id = 5281;
			}else{
				$id = 5262;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 35, 48  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 52, 51  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 35, 48  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 52, 51  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5212]!=null || $ar_list[5279]!=null){
			if($ar_list[5212]!=null){
				$id = 5212;
			}else{
				$id = 5279;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 27, 78  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 43, 81  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 27, 78  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 43, 81  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		
		if($ar_list[5047]!=null){
			$id = 5047;
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 29, 101  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 45, 104  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 29, 101  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 45, 104  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5315]!=null || $ar_list[5361]!=null){
			if($ar_list[5315]!=null){
				$id = 5315;
			}else{
				$id = 5361;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 16, 130  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 32, 133  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 16, 130  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 32, 133  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5324]!=null || $ar_list[5380]!=null){
			if($ar_list[5324]!=null){
				$id = 5324;
			}else{
				$id = 5380;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 35, 156  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 51, 159  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 35, 156  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 51, 159  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5152]!=null || $ar_list[5154]!=null){
			if($ar_list[5152]!=null){
				$id = 5152;
			}else{
				$id = 5154;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 27, 187  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 43, 190  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 27, 187  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 43, 190  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5051]!=null || $ar_list[4040]!=null){
			if($ar_list[5051]!=null){
				$id = 5051;
			}else{
				$id = 4040;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 112, 50  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 128, 53  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 112, 50  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 128, 53  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5068]!=null || $ar_list[5326]!=null){
			if($ar_list[5068]!=null){
				$id = 5068;
			}else{
				$id = 5326;
			}
		
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 88, 88  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 105, 91  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 88, 88  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 105, 91  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5084]!=null || $ar_list[5078]!=null){
			if($ar_list[5084]!=null){
				$id = 5084;
			}else{
				$id = 5078;
			}
			
			//5084 5078
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 152, 62  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 169, 65  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 152, 62  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 169, 65  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5356]!=null || $ar_list[6019]!=null){
			if($ar_list[5356]!=null){
				$id = 5356;
			}else{
				$id = 6019;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 109, 108  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 125, 111  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 109, 108  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 125, 111  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5388]!=null || $ar_list[5205]!=null){
			if($ar_list[5388]!=null){
				$id = 5388;
			}else{
				$id = 5205;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 171, 89  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 188, 92  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 171, 89  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 188, 92  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5344]!=null){
			$id = 5344;
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 170, 128  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 186, 131  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 170, 128  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 186, 131  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5342]!=null || $ar_list[5380]!=null){
			if($ar_list[5342]!=null){
				$id = 5342;
			}else{
				$id = 5380;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 122, 153  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 138, 156  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 122, 153  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 138, 156  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		if($ar_list[5352]!=null || $ar_list[5070]!=null){
			if($ar_list[5352]!=null){
				$id = 5352;
			}else{
				$id = 5070;
			}
			$color = explode(',',$ar_list[$id]->th_color);
			$color_day = explode(',',$ar_list[$id]->daily_th_color);

			$this->pdf->SetFont('supermarket','',25);
			$this->pdf->SetTextColor($color[0],$color[1],$color[2]);
			$this->pdf->setXY( 98, 180  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->pm25!=null?$ar_list[$id]->pm25:'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',20);
			$this->pdf->SetTextColor($color_day[0],$color_day[1],$color_day[2]);
			$this->pdf->setXY( 114, 183  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , $ar_list[$id]->daily_pm25!=null?$ar_list[$id]->daily_pm25:'N/A'), 0, 0, 'C' );
		}else{
			$this->pdf->SetFont('supermarket','',15);
			$this->pdf->SetTextColor($default_color[0], $default_color[1], $default_color[2]);
			$this->pdf->setXY( 98, 180  );
			$this->pdf->Cell( 13, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
			
			$this->pdf->SetFont('supermarket','',13);
			$this->pdf->setXY( 114, 183  );
			$this->pdf->Cell( 10, 7, iconv( 'UTF-8','cp874' , 'N/A'), 0, 0, 'C' );
		}
		
		/*
		5281	คณะสังคมศาสตร์ มหาวิทยาลัยเชียงใหม่
		5212	สำนักงานสาธารณสุขจังหวัดพิษณุโลก
		5047	โรงพยาบาลอุ้มผาง จ. ตาก
		5319	ศาลาว่าการกรุงเทพมหานคร (กอ.รมน. กรุงเทพฯ)
		5324	สำนักงานเทศบาลเมืองกระทุ่มแบน 
		5313	ห้าแยกฉลอง จ.ภูเก็ต
		5051	โรงพยาบาลเชียงคำ จ. พะเยา
		5068	ชุมชนหมู่ 5 บ้านเขามะกอก จ. สระบุรี
		5084		เทศบาลนครขอนแก่น
		5356	สำนักงานการวิจัยแห่งชาติ 
		5388	ศาลากลางจังหวัดอุบลราชธานี 
		5344	สำนักงานทรัพยากรธรรมชาติและสิ่งแวดล้อ
		5342	สำนักงานเทศบาลตำบลซำฆ้อ 
		5352	สำนักงานเทศบาลนครหาดใหญ่
		*/
		
		$this->pdf->Output();
	}
	
	function temp()
	{
		$uri = 'http://api.openweathermap.org/data/2.5/weather?q=bangkok&appid=a8219f8dc98e941510ed5403f9a364be&units=metric';
		$weather = json_decode(file_get_contents($uri));
		if($weather){
			return ceil($weather->main->temp);
		}
	}

	public function alertform(){
		$form = $this->uri->segment(2);
		if($this->input->post()!=null){
			$ar = $this->input->post();
			$ar['alert_image'] = $ar['h_image'];
			unset($ar['h_image']);
			$message_key = $this->generateRandomString();
			$ar_post = array(
				'message_key'	=> $message_key,
				'message_obj'	=> json_encode($ar),
				'message_form'	=> $ar['alert_form'],
				'createdate'	=> date('Y-m-d H:i:s'),
			);
			
			$id = $this->main_model->insertMessage($ar_post);
			if($id){
				redirect('/alertform/success?key='.$message_key);
			}else{
				echo '<pre>';
				print_r($ar_post);
				echo '</pre>';
			}
		}
		$data['view'] = 'main/alert_index';
		if($form!=null){
			$rs = array();
			if($form=="success" && $this->input->get('key')!=null){
				$rs = $this->main_model->getMessage($this->input->get('key'));
			}
			$data['rs']	= $rs;
			$data['view'] = 'main/alert_'.$form;
		}
		$this->load->view("main/alertform", $data);
	}

	function generateRandomString() {
		return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,10))), 1, 10);
	}

	function dropbox_upload(){
		if ($_FILES['file']['name']) {
			if (!$_FILES['file']['error']) {
				
				$dir = './uploads/alert/';
				$oldmask = umask(0);
				if (!is_dir($dir)) {
					mkdir($dir, 0777);
					umask($oldmask);
				}
				$storeFolder = $_SERVER["DOCUMENT_ROOT"]."/uploads/alert/";
				
				$name = date('YmdHis').md5(rand(100, 200));
				$ext = explode('.', $_FILES['file']['name']);
				$ext = end($ext);
				$filename = $name . '.' . $ext;
				$destination = $storeFolder . $filename; //change this directory
				$location = $_FILES["file"]["tmp_name"];
				move_uploaded_file($location, $destination);
				echo $filename;//change this URL
				
			}else{
				
			  echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
			}
		}
		
	}
}
