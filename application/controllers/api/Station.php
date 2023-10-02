<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';


class Station extends REST_Controller {

    function __construct(){
        // Construct the parent class
        parent::__construct();
		$this->load->model('admin_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->load->model('main_model');
    }
	
	function allowed_origin(){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header("Access-Control-Allow-Headers: X-Requested-With");
	}
	
    public function index_get(){
		$data = array(
			"status" => TRUE,
			"message" => "welcome nrct api :)"
		);
		$this->response($data, 200);
	}
		
	public function id_get(){
		$id = $this->uri->segment(4);
		$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/detail/'.$id.'.json';
		$rs = json_decode(file_get_contents($uri));
		if($rs){

			$profile = json_decode(file_get_contents('https://www-old.cmuccdc.org/assets/api/haze/pwa/json/stations_temp.json'));
			if($profile){
				foreach($profile as $item){
					if($item->id == $id){
						$rs->dustboy_uri=$item->dustboy_uri;
						$rs->dustboy_name=$item->dustboy_name;
						$rs->dustboy_name_en=$item->dustboy_name_en;
						$rs->dustboy_lat=$item->dustboy_lat;
						$rs->dustboy_lon=$item->dustboy_lon;
					}
				}
			}

			$value = $rs->dustboy_value;
			$newValue = array();
			
			$c = count($value);
			for($i=($c-24); $i<$c; $i++){
				array_push($newValue, $value[$i]);
			}
			$rs->dustboy_value = $newValue;
			$this->response($rs, 200);
		}else{
			$data = array(
				"status" => TRUE,
				"message" => "id not found"
			);
			$this->response($data, 200);
		}
	}
	
	public function ids_get(){
		$id = $this->uri->segment(4);
		$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/detail2/'.$id.'_daily.json';
		$rs = json_decode(file_get_contents($uri));
		if($rs){

			$profile = json_decode(file_get_contents('https://www-old.cmuccdc.org/assets/api/haze/pwa/json/stations_temp.json'));
			if($profile){
				foreach($profile as $item){
					if($item->id == $id){
						$rs->dustboy_uri=$item->dustboy_uri;
						$rs->dustboy_name=$item->dustboy_name;
						$rs->dustboy_name_en=$item->dustboy_name_en;
						$rs->dustboy_lat=$item->dustboy_lat;
						$rs->dustboy_lon=$item->dustboy_lon;
					}
				}
			}
			
			$value = $rs->dustboy_value;
			$newValue = array();
			
			$c = count($value);
			if($c<7){
				for($i=0; $i<$c; $i++){
					array_push($newValue, $value[$i]);
				}
			}else{
				for($i=($c-7); $i<$c; $i++){
					array_push($newValue, $value[$i]);
				}
			}
			$rs->dustboy_value = $newValue;
			$this->response($rs, 200);
		}else{
			$data = array(
				"status" => TRUE,
				"message" => "id not found"
			);
			$this->response($data, 200);
		}
	}
	
	public function info_get(){
		$val = $this->uri->segment(4);
		$data = array();
		if($val!=null){
			$data['USAQI'] =  $this->standard_api($val, 'us_aqi');
			$data['THAQI'] =  $this->standard_api($val, 'th_aqi');
		}
		$this->response($data, 200);
	}
	
	public function markerconfig_get(){
		$rsConfig = $this->main_model->getMarkerConfig(1);
		$data = json_decode($rsConfig[0]->marker_config);
		$this->response($data, 200);
	}
	public function markerreport_get(){
		set_time_limit(0);
		$qid = $this->uri->segment(4);
		
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
		if($qid!=null){
			
			$qid = ($qid<10? '0'.$qid:$qid);
			$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/temp_aun/'.date('Ymd').$qid.'_stations.json';
			
		
			$stations = json_decode(file_get_contents($uri));
			if($stations!=null){
				$data_full = array();
				foreach($stations as $item){
					if (in_array($item->id, $ar_list)){
						$data_full[$item->id] = $item;
					}
				}
				$this->response($data_full, 200);
			}else{
				$qid = $qid-1;
				$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/temp/'.date('Ymd').$qid.'_stations.json';
				$stations = json_decode(file_get_contents($uri));
				$data_full = array();
				foreach($stations as $item){
					if (in_array($item->id, $ar_list)){
						$data_full[$item->id] = $item;
					}
				}
				$this->response($data_full, 200);
			}
			
		}
		//$this->response($data, 200);
	}
	
	function standard_api($val, $type){
		$point=0;
		$data=array();
		if($type=="us_aqi"){
			$ar_color = array(1=>'0, 153, 107', '253,192,78', '235, 132, 63', '205,0,0', '129, 21, 185', '160, 7, 54', '160, 7, 54');
			$ar_icon = array(1=>'us-dust-boy-01', 'us-dust-boy-02', 'us-dust-boy-03', 'us-dust-boy-04', 'us-dust-boy-05', 'us-dust-boy-06', 'us-dust-boy-07');
			$ar_title = array(1=>
				'คุณภาพอากาศดี', 
				'คุณภาพอากาศปานกลาง', 
				'คุณภาพอากาศไม่ดีต่อกลุ่มเสี่ยง', 
				'คุณภาพอากาศไม่ดี', 
				'คุณภาพอากาศไม่ดีอย่างยิ่ง', 
				'คุณภาพอากาศอันตราย', 
				'คุณภาพอากาศอันตราย'
			);
			$ar_caption = array(1=>
				'ประชาชนสามารถทำกิจกรรมต่างๆ ได้ตามปกติ', 
				'ประชาชนที่ไวต่อมลพิษมากกว่าคนทั่วไปควรลดการออกแรงหนักหรือเวลานานสังเกตอาการไอหรือหอบ, ประชาชนกลุ่มเสี่ยงและประชาชนทั่วไปสามารถใช้ชีวิตได้ปกติ', 
				'ประชาชนที่ไวต่อมลพิษมากกว่าคนทั่วไปควรลดการออกแรงหนักหรือเวลานานสังเกตอาการไอหรือหอบ และควรงดกิจกรรมนอกอาคาร, ประชาชนกลุ่มเสี่ยงควรงดกิจกรรมนอกอาคารที่ใช้แรงหนักหรือเป็นเวลานาน สามารถทำกิจกรรมนอกอาคารได้ แต่ไม่ควรออกแรงมากและควรพักบ่อยๆ สังเกตอาการไอหรือหอบ, ประชาชนทั่วไปสามารถใช้ชีวิตได้ตามปกติ, โรงเรียนหรือสถานศึกษาควรลดกิจกรรมกลางแจ้งที่ใช้แรงหนักหรือเป็นเวลานานและต้องจัดเตรียมหน้ากากอนามัยและห้องสะอาดสำหรับนักเรียนที่มีความเสี่ยง', 
				'ประชาชนที่ไวต่อมลพิษมากกว่าคนทั่วไปควรงดกิจกรรมนอกอาคาร, ประชาชนในกลุ่มเสี่ยงควรงดกิจกรรมนอกอาคารที่ใช้แรงหนักหรือเป็นเวลานานทำกิจกรรมในอาคารแทน หรือเลื่อนเป็นวันอื่น, ประชาชนทั่วไปควรงดกิจกรรมนอกอาคารที่ใช้แรงหนักหรือเป็นเวลานานพักบ่อยๆ, โรงเรียนหรือสถานศึกษาควรลดกิจกรรมกลางแจ้งที่ใช้แรงหนักหรือเป็นเวลานานและต้องจัดเตรียมหน้ากากอนามัยและห้องสะอาดสำหรับนักเรียนทุกคน', 
				'ประชาชนที่ไวต่อมลพิษมากกว่าคนทั่วไปควรอยู่ในห้องสะอาด(Clean room), ประชาชนกลุ่มเสี่ยงควรงดกิจกรรมนอกอาคารทุกชนิด ทำกิจกรรมในอาคารแทนหรือเลื่อนเป็นวันอื่น, โรงเรียนหรือสถานศึกษางดกิจกรรมกลางแจ้งทุกชนิดและต้องจัดเตรียมหน้ากากอนามัยและห้องสะอาดสำหรับนักเรียนทุกคน', 
				'ประชาชนทุกคนควรงดกิจกรรมนอกอาคารทุกชนิดทำกิจกรรมในอาคารแทน, โรงเรียนหรือสถานศึกษางดกิจกรรมกลางแจ้งทุกชนิดและต้องจัดเตรียมหน้ากากอนามัยและห้องสะอาดสำหรับนักเรียนทุกคนหรือพิจารณาปิดโรงเรียน', 
				'ประชาชนทุกคนควรงดกิจกรรมนอกอาคารทุกชนิดทำกิจกรรมในอาคารแทน, โรงเรียนหรือสถานศึกษางดกิจกรรมกลางแจ้งทุกชนิดและต้องจัดเตรียมหน้ากากอนามัยและห้องสะอาดสำหรับนักเรียนทุกคนหรือพิจารณาปิดโรงเรียน'
			);
			$ar_title_en = array(1=>
				'Good', 
				'Moderate', 
				'Unhealthy for Sensitive Groups', 
				'Unhealthy', 
				'Very Unhealthy', 
				'Hazardous', 
				'Hazardous'
			);
			$ar_caption_en = array(1=>
				'Air quality is considered satisfactory, and air pollution poses little or no risk', 
				'Air quality is acceptable; however, for some pollutants there may be a moderate health concern for a very small number of people who are unusually sensitive to air pollution.', 
				'Members of sensitive groups may experience health effects. The general public is not likely to be affected.', 
				'Everyone may begin to experience health effects; members of sensitive groups may experience more serious health effects', 
				'Health warnings of emergency conditions. The entire population is more likely to be affected', 
				'Health alert: everyone may experience more serious health effects', 
				'Health alert: everyone may experience more serious health effects'
			);
			if($val>0){
				if($val<=11.9){
					$point=1;
				}
				else if( ($val<=35.4) && ($val>11.9) ){
					$point=2;
				}
				else if( ($val<=55.4) && ($val>35.4) ){
					$point=3;
				}
				else if( ($val<=150.4) && ($val>55.4) ){
					$point=4;
				}
				else if( ($val<=250.4) && ($val>150.4) ){
					$point=5;
				}
				else if( ($val<=350.4) && ($val>250.4) ){
					$point=6;
				}
				else if( ($val>350.4) ){
					$point=6;
				}
				$data['color'] = $ar_color[$point];
				$data['icon'] = $ar_icon[$point];
				$data['title'] = $ar_title[$point];
				$data['title_en'] = $ar_title_en[$point];
				$data['caption'] = $ar_caption[$point];
				$data['caption_en'] = $ar_caption_en[$point];
				
				return $data;
			}
			
		}else if($type=="th_aqi"){
			$point=0;
			$data=array();
			$ar_color = array(1=>'0,191,243', '0,166,81', '253,192,78', '242,101,34', '205,0,0');
			$ar_icon = array(1=>'th-dust-boy-01', 'th-dust-boy-02', 'th-dust-boy-03', 'th-dust-boy-04', 'th-dust-boy-05');
			$ar_title = array(1=>
				'คุณภาพอากาศดีมาก', 
				'คุณภาพอากาศดี', 
				'คุณภาพอากาศปานกลาง', 
				'คุณภาพอากาศมีผลกระทบต่อสุขภาพ', 
				'คุณภาพอากาศมีผลกระทบต่อสุขภาพมาก'
			);
			$ar_caption = array(1=>
				'คุณภาพอากาศดีมาก เหมาะสำหรับกิจกรรมกลางแจ้งและการท่องเที่ยว', 
				'คุณภาพอากาศดี สามารถทำกิจกรรมกลางแจ้งและท่องเที่ยวได้ตามปกติ', 
				'[ประชาชนทั่วไป] สามารถทำกิจกรรมกลางแจ้งได้ตามปกติ [ผู้ที่ต้องดูแลสุขภาพเป็นพิเศษ] หากมีอาการเบื้องต้น เช่น ไอ หายใจลำบาก ระคายเคือง ตา ควรลดระยะเวลาการทำกิจกรรมกลางแจ้ง', 
				'[ประชาชนทั่วไป] ควรเฝ้าระวังสุขภาพ ถ้ามีอาการเบื้องต้น เช่น ไอ หายใจลาบาก ระคาย เคืองตา ควรลดระยะเวลาการทำกิจกรรมกลางแจ้ง หรือใช้อุปกรณ์ป้องกันตนเองหากมีความจำเป็น [ผู้ที่ต้องดูแลสุขภาพเป็นพิเศษ] ควรลดระยะเวลาการทากิจกรรมกลางแจ้ง หรือใช้อุปกรณ์ ป้องกันตนเองหากมีความจำเป็น ถ้ามีอาการทางสุขภาพ เช่น ไอ หายใจลำบาก ตา อักเสบ แน่นหน้าอก ปวดศีรษะ หัวใจเต้นไม่เป็นปกติ คลื่นไส้ อ่อนเพลีย ควรพบแพทย์', 
				'ประชาชนทุกคนควรหลีกเลี่ยงกิจกรรมกลางแจ้ง หลีกเลี่ยงพื้นที่ที่มีมลพิษทางอากาศสูง หรือใช้อุปกรณ์ป้องกันตนเองหากมีความจำเป็น หากมีอาการทางสุขภาพควรพบแพทย์' 
			);
			$ar_title_en = array(1=>
				'Very Good', 
				'Good', 
				'Moderate', 
				'Unhealthy', 
				'Very Unhealthy'
			);
			$ar_caption_en = array(1=>
				'', 
				'Air quality is considered satisfactory, and air pollution poses little or no risk', 
				'Air quality is acceptable; however, for some pollutants there may be a moderate health concern for a very small number of people who are unusually sensitive to air pollution', 
				'Everyone may begin to experience health effects; members of sensitive groups may experience more serious health effects', 
				'Health warnings of emergency conditions. The entire population is more likely to be affected' 
			);
			if(round($val)<=25){
				$point = 1;
			}else if(round($val)>25 && round($val)<=37){
				$point = 2;
			}else if(round($val)>37 && round($val)<=50){
				$point = 3;
			}else if(round($val)>50 && round($val)<=90){
				$point = 4;
			}else if(round($val)>90){
				$point = 5;
			}
			$data['color'] = $ar_color[$point];
			$data['icon'] = $ar_icon[$point];
			$data['title'] = $ar_title[$point];
			$data['title_en'] = $ar_title_en[$point];
			$data['caption'] = $ar_caption[$point];
			$data['caption_en'] = $ar_caption_en[$point];
				
			return $data;
		}
	}
}
