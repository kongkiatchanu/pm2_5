<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct() {
        parent::__construct();

       	$this->load->model('admin_model');
        $this->load->library('form_validation');

        $this->load->helper('security');
        /*check session*/
        if($this->uri->segment(2)!="login"){
        	if($this->session->userdata('admin_logged_in')==""){
         		redirect('admin/login');
      	  	}
        }

    }
 
	public function index(){	
		$data = array(
			"page" 		=> 'index',
			"pagesub" 	=> 'index',
			"pageview"	=> 'index',
			'rsInbox'	=> $this->admin_model->getNewInbox(),
			'rsInboxAll'=> $this->admin_model->getInbox()
		);

		$this->load->view('admin/template_main',$data);

	}
	
	public function login(){

		$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view("admin/login");
		}else{

			$data = array(
				'user' => $this->session->userdata('admin_logged_in')['username'],
				'ip' => $_SERVER['REMOTE_ADDR'],
				'ua' => $_SERVER['HTTP_USER_AGENT'],
			);
			$this->admin_model->insert_data('user_log',$data);
			redirect('/admin/');
		}
		
	}
	
	public function check_database($password){
		$username = $this->input->post('username');
		$result = $this->admin_model->login($username, md5(sha1($password)));
		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
					'username' => $row->username,
					'display' => $row->displayname
				);
				$this->session->set_userdata('admin_logged_in', $sess_array);
			}
			return TRUE;
		}else{
			$message='<div class="alert alert-danger"><strong>คำเตือน !</strong> ชื่อผู้ใช้และรหัสผ่านไม่ถูกต้อง</div>';
			$this->form_validation->set_message('check_database', $message);
			return false;
		}
		
	}

	public function logout() {
		$this->session->unset_userdata('admin_logged_in');
		redirect('admin/');
		exit();
    }
	
	public function profile(){	
		if($this->input->post()){
			$ar = array(
		    	'username' => $this->input->post('username'),
		    	'password' => md5(sha1($this->input->post('o_password')))
		    );
		
			$ck = $this->admin_model->checkAdmin($ar);
		
			if($ck!=null){
				$ar = array(
					'username' => $this->input->post('username'),
					'password' => md5(sha1($this->input->post('n_password'))),
					'displayname' => $this->input->post('displayname')
				);
				$rs = $this->admin_model->updateUser($ar); 
				$sess_array = array(
					'username' => $this->input->post('username'),
					'display' => $this->input->post('displayname')
				);
				$this->session->set_userdata('admin_logged_in', $sess_array);
				redirect('admin/profile/success');
			}else{
				redirect('admin/profile/fail');
			}
		
		}

		$data = array(
			"pageview"	=> 'admin-profile',
			"page" 		=> 'config',
			"pagesub" 	=> 'profile',
			"pagename" 	=> 'เปลี่ยนรหัสผ่าน',
			"_user" 	=> $this->session->userdata('admin_logged_in'),
			'rsInbox'	=> $this->admin_model->getNewInbox(),
			'rsInboxAll'=> $this->admin_model->getInbox()

		);
		
		$this->load->view('admin/template_main',$data);
	}
	
	
	
	public function category(){
    	$load = "admin-category";
		$rs="";

		if($this->input->post()){
			/*id post*/
    		if($this->input->post('id_category')){
    			$ar = array(
	    			'id_section' => $this->input->post('id_section'),
	    			'category_name' => $this->input->post('category_name'),
	    			'category_parent' => $this->input->post('category_parent'),
	    			'category_rewrite' => $this->input->post('category_rewrite'),
	    			'id_category' => $this->input->post('id_category')
	    		);

    			$this->admin_model->updateCategory($ar); 
    		}else{
    			$ar = array(
	    			'id_section' => $this->input->post('id_section'),
	    			'category_name' => $this->input->post('category_name'),
	    			'category_parent' => $this->input->post('category_parent'),
	    			'category_rewrite' => $this->input->post('category_rewrite'),
	    			'id_category' => $this->input->post('id_category')
	    		);

				$this->admin_model->insertCategory($ar); 
    		}
    		redirect('admin/category');
		}else{
	    	if($this->uri->segment(3)==null){
	    		/*list*/
	    	}else if($this->uri->segment(3)=="del"){
				$rs = $this->admin_model->getCategoryRow($this->uri->segment(4));
				$this->admin_model->deleteCategory($this->uri->segment(4)); 
				redirect('admin/category');
	    	}else if($this->uri->segment(3)=="edit"){
	    		$load = "admin-category-form";
	    		$rs = $this->admin_model->getCategoryRow($this->uri->segment(4)); 
	    	}else if($this->uri->segment(3)=="add"){
	    		$load = "admin-category-form";
	    	}

			$data = array(
				"pageview"	=> $load,
				"page" 		=> 'content',
				"pagesub" 	=> 'category',
				"pagename" 	=> 'หมวดหมู่',
				"section" => $this->admin_model->getSection(),
				"category" => $this->admin_model->getCategory(),
				"rs" 		=> $rs,
				
				'rsInbox'	=> $this->admin_model->getNewInbox(),
				'rsInboxAll'=> $this->admin_model->getInbox()
			);
		
			$this->load->view('admin/template_main',$data);
		}
    }
	
	public function section(){
    	$idSection=$this->uri->segment(3);/*getSectionIDFromURL*/
    	if($idSection!=null){
		
    		$load = "admin-section";
			$rs_page = $this->admin_model->getSectionByID($idSection);
			$pagename = $rs_page[0]->section_name;;
			$page = "section-".$idSection;
			$rs="";
			$_rsFile="";
			$rsDetail="";
			$content_list = $this->admin_model->getContentsList($idSection);/*listContentBySectionID*/
			
			if($this->input->post()){
				
				
				if($this->input->post('idcontent')){
					
					$ar = array(
		    			'content_title' => $this->input->post('content_title'),
		    			'content_short_description' => $this->input->post('content_short_description'),
		    			'content_full_description' => $this->input->post('content_full_description'),
		    			'content_thumbnail' => trim($this->input->post('h_image')),
						'content_hashtag'=> $this->input->post('content_hashtag'),
						'content_public'=> date('Y-m-d H:i:s'),
		    			'id_category'=> $this->input->post('id_category'),
		    			'content_status'=> $this->input->post('content_status'),
						'idcontent'=> $this->input->post('idcontent')
		    		);
	    			$update = $this->admin_model->updateContents($ar); 
			
					if(@$_FILES["content_file"]!=null){
						for($i=0;$i<count($_FILES["content_file"]['tmp_name']);$i++) {
							if(!empty($_FILES["content_file"]["tmp_name"][$i])) {

								if ($_FILES["content_file"]["type"][$i] == "image/gif") {
									$ext = "gif";
								}elseif ($_FILES["content_file"]["type"][$i] == "image/pjpeg" || $_FILES["content_file"]["type"][$i] == "image/jpeg") {
									$ext = "jpg";
								}elseif ($_FILES["content_file"]["type"][$i] == "image/x-png"  || $_FILES["content_file"]["type"][$i] =="image/png") {
									$ext = "png";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/pdf") {
									$ext = "pdf";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/vnd.ms-excel" || $_FILES["content_file"]["type"][$i] =="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
									$ext = "xlsx";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
									$ext = "docx";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/octet-stream") {
									$ext = "rar";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/zip") {
									$ext = "zip";
								}	
								
								if(!empty($ext)) {
									$ints=date('YmdGis');
									$filenames =  $this->input->post('idcontent').'_'.$ints."_".$i.".".$ext;
									move_uploaded_file($_FILES["content_file"]["tmp_name"][$i],$_SERVER["DOCUMENT_ROOT"]."/uploads/docs/".$filenames); 
									chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/docs/".$filenames, 0777);
										//insert database
									$ar_assets = array(
										'file_idcontent' => $this->input->post('idcontent'),
										'file_name' => $_FILES["content_file"]["name"][$i],
										'file_path' => $filenames,
										'file_type' => $ext,
										'file_time' => date('Y-m-d H:i:s')
									);
								
									$this->admin_model->insertFiles($ar_assets); 
										
								} else {		
									echo "<script>alert('ไฟล์รูปภาพไม่ถูกต้อง');</script>";  
									redirect('/admin/section/1/edit/'.$this->input->post('idcontent'));
								}		
							}
						}
					}
					
					if(@$_FILES["photos"]){
						for($i=0;$i<count($_FILES["photos"]['tmp_name']);$i++) {
							

							$ints=date('YmdGis');
							if(!empty($_FILES["photos"]["tmp_name"][$i])) {
								if ($_FILES["photos"]["type"][$i] == "image/gif") {
									$ext = "gif";
								}elseif ($_FILES["photos"]["type"][$i] == "image/pjpeg" || $_FILES["photos"]["type"][$i] == "image/jpeg") {
									$ext = "jpg";
								}elseif ($_FILES["photos"]["type"][$i] == "image/x-png"  || $_FILES["photos"]["type"][$i] =="image/png") {
									$ext = "png";
								}		
								if(!empty($ext)) {
									$filenames =  'g_'.$ar['idcontent'].'_'.$ints."_".$i.".".$ext;
									copy($_FILES["photos"]["tmp_name"][$i],$_SERVER["DOCUMENT_ROOT"]."/uploads/gallery/".$filenames);	
									//insert database
									$ar_assets = array(
										'img_content_id' => $this->input->post('idcontent'),
										'img_filename' => $filenames,
										'img_size' => $_FILES["photos"]["size"][$i],
										'img_createdate' => date('Y-m-d H:i:s')
									);
									
									$this->admin_model->insertContentGalleryImgDetail($ar_assets); 
									
								} else {		
									echo "<script>alert('ไฟล์รูปภาพไม่ถูกต้อง');</script>";  
									//redirect('admin/gallery/'.$this->input->post('gallery_id'));
								}
							}
		
						}
					}
					
				}else{
				
					$ar = array(
		    			'content_title' => $this->input->post('content_title'),
		    			'content_short_description' => $this->input->post('content_short_description'),
		    			'content_full_description' => $this->input->post('content_full_description'),
		    			'content_thumbnail' => trim($this->input->post('h_image')),
						'content_created'=> date('Y-m-d H:i:s'),
						'content_public'=> date('Y-m-d H:i:s'),	
		    			'content_hashtag'=> $this->input->post('content_hashtag'),
						'content_status'=> $this->input->post('content_status'),
						'content_author'=> $this->session->userdata('admin_logged_in')['display'],
		    			'id_category'=> $this->input->post('id_category')
		    			
		    		);
	    			$in_id = $this->admin_model->insertContents($ar); 

					if(@$_FILES["content_file"]!=null){
						for($i=0;$i<count($_FILES["content_file"]['tmp_name']);$i++) {
							if(!empty($_FILES["content_file"]["tmp_name"][$i])) {
								
								if ($_FILES["content_file"]["type"][$i] == "image/gif") {
									$ext = "gif";
								}elseif ($_FILES["content_file"]["type"][$i] == "image/pjpeg" || $_FILES["content_file"]["type"][$i] == "image/jpeg") {
									$ext = "jpg";
								}elseif ($_FILES["content_file"]["type"][$i] == "image/x-png"  || $_FILES["content_file"]["type"][$i] =="image/png") {
									$ext = "png";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/pdf") {
									$ext = "pdf";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/vnd.ms-excel" || $_FILES["content_file"]["type"][$i] =="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
									$ext = "xlsx";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
									$ext = "docx";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/octet-stream") {
									$ext = "rar";
								}elseif ($_FILES["content_file"]["type"][$i] == "application/zip") {
									$ext = "zip";
								}		
								if(!empty($ext)) {
									$ints=date('YmdGis');
									$filenames =  $in_id.'_'.$ints."_".$i.".".$ext;
									move_uploaded_file($_FILES["content_file"]["tmp_name"][$i],$_SERVER["DOCUMENT_ROOT"]."/uploads/docs/".$filenames); 
									chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/docs/".$filenames, 0777);
										//insert database
									$ar_assets = array(
										'file_idcontent' => $in_id,
										'file_name' => $_FILES["content_file"]["name"][$i],
										'file_path' => $filenames,
										'file_type' => $ext,
										'file_time' => date('Y-m-d H:i:s')
									);

									$this->admin_model->insertFiles($ar_assets); 
										
								} else {		
									echo "<script>alert('ไฟล์รูปภาพไม่ถูกต้อง');</script>";  
									redirect('/admin/section/1/edit/'.$in_id);
								}		
							}
						}
					}// if files

				}

				redirect('admin/section/'.$idSection);

			}else{

				if($this->uri->segment(4)==null){
		    		/*list*/
		    	}else if($this->uri->segment(4)=="del"){
					$rs = $this->admin_model->getContentRow($this->uri->segment(5)); 
					$this->admin_model->deleteContent($this->uri->segment(5)); 
					redirect('admin/section/'.$idSection);
		    	}else if($this->uri->segment(4)=="delfile"){
					$del = $this->admin_model->delQuotationFile($this->uri->segment(5),$this->uri->segment(6));
					if($del!=null){redirect('/admin/section/1/edit/'.$this->uri->segment(6));}
					
		    	}else if($this->uri->segment(4)=="edit"){
		    		$load = "admin-section-form";
		    		$rs = $this->admin_model->getContentRow($this->uri->segment(5)); 
		    		$_rsFile = $this->admin_model->getFileList($this->uri->segment(5)); 
					$rsDetail = $this->admin_model->getCGalleryImgList($this->uri->segment(5)); 
		    	}else if($this->uri->segment(4)=="add"){
		    		$load = "admin-section-form";
		    	}
				
				
				$data = array(
					"pageview"	=> $load,
					"page" 		=> 'content',
					"pagesub" 	=> 'content',
					"pagename" 	=> 'ข่าวประชาสัมพันธ์',
					"section" 	=> $this->admin_model->getSection(),
					"idsection" => $idSection,
					"category" 	=> $this->admin_model->getCategory(),
					"clist"		=> $this->admin_model->getContentsList($idSection),
					"rs" 		=> $rs,
					"rsDetail" 	=> $rsDetail,
					"_rsFile" 	=> $_rsFile,
					'rsInbox'	=> $this->admin_model->getNewInbox(),
					'rsInboxAll'=> $this->admin_model->getInbox()
				);
			
				$this->load->view('admin/template_main',$data);
			}
    	}else{
    		redirect('admin/category');
    	}
    }

	public function site_history(){
		$data = array(
			"pageview"	=> 'admin-history',
			"page" 		=> 'site_history',
			"pagesub" 	=> '',
			"pagename" 	=> 'ประวัติ',
			"rsList" 	=> $this->admin_model->get_log(),
			'rsInbox'	=> $this->admin_model->getNewInbox(),
			'rsInboxAll'=> $this->admin_model->getInbox()
		);
		
		$this->load->view('admin/template_main',$data);
	}

	public function alertmessage(){
		$data = array(
			"pageview"	=> 'admin-alertmessage',
			"page" 		=> 'site_alertmessage',
			"pagesub" 	=> '',
			"pagename" 	=> 'ประวัติ',
			"rsList" 	=> $this->admin_model->get_alertmessage(),
			'rsInbox'	=> $this->admin_model->getNewInbox(),
			'rsInboxAll'=> $this->admin_model->getInbox()
		);
		
		$this->load->view('admin/template_main',$data);
	}

	public function site_api(){
		$do = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$rs = array();
		if($this->input->post()!=null){
			$ar = $this->input->post();
			if($ar['menu_id']!=null){
				$this->admin_model->updateMenuApi($ar);
				redirect('admin/site_api/edit/'.$ar['menu_id']);
			}else{
				$id = $this->admin_model->addMenuApi($ar);
				redirect('admin/site_api/edit/'.$id);
			}
		}else{
			$view = 'admin-api';
			if($do=="del"){

			}else if($do=="add"){
				$view = 'admin-api-form';
			}else if($do=="edit"){
				$view = 'admin-api-form';
				$rs = $this->admin_model->getAPIDetail($id);
			}
			$data = array(
				"pageview"	=> $view,
				"page" 		=> 'site_api',
				"pagesub" 	=> '',
				"rs"		=> $rs,
				"pagename" 	=> 'APIs',
				"rsList" 	=> $this->admin_model->getAPIList(),
				'rsInbox'	=> $this->admin_model->getNewInbox(),
				'rsInboxAll'=> $this->admin_model->getInbox()
			);
			
			$this->load->view('admin/template_main',$data);
		}
	}
	
	public function report(){
		if($this->input->post()!=null){
			$ar = $this->input->post();
			$ar_post = array(
				'id'			=> 1,
				'marker_config'	=> json_encode($ar['marker']),
				'update'		=> date('Y-m-d H:i:s')
			);
			$update = $this->admin_model->updateMarkerConfig($ar_post);
			redirect('admin/report');
		}
		$rsConfig = $this->admin_model->getMarkerConfig(1);
		
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

		$qid = $this->uri->segment(3);
		if($qid!=null){
			$this->siteinfo['site_title'] = 'Daily report';
			$qid = $this->uri->segment(3);
			$ar_info = array(
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				't'		=> ($qid<10? '0'.$qid:$qid).":00 น.",
				'd'		=> (date('d')*1),
				'm'		=> ConvertToThaiDateMonth(date('Y-m-d'),1),
				'd2'	=> ConvertToThaiDateHeader(date('Y-m-d')).' ที่',
				'temp'	=> ceil($this->temp())
			);
			
			$qid = ($qid<10? '0'.$qid:$qid);
			$uri = 'https://www-old.cmuccdc.org/assets/api/haze/pwa/json/temp/'.date('Ymd').$qid.'_stations.json';
			
			
			$stations = json_decode(file_get_contents($uri));
			
			
			$data_full = array();
			foreach($stations as $item){
				if (in_array($item->id, $ar_list)){
					$data_full[$item->id] = $item;
				}
			}
		}else{
			redirect('admin/report/'.date('H'));
		}
		
		$data = array(
			"pageview"	=> 'admin-report',
			"page" 		=> 'report',
			"pagesub" 	=> '',
			"pagename" 	=> 'รายงาน วช.',
			'rsConfig'	=> $rsConfig,
			'ar_info'			=> $ar_info,
			'ar_list'			=> $data_full,
			'rsInbox'	=> $this->admin_model->getNewInbox(),
			'rsInboxAll'=> $this->admin_model->getInbox()
		);
		
		$this->load->view('admin/template_main',$data);
	}
	
	function temp()
	{
		$uri = 'http://api.openweathermap.org/data/2.5/weather?q=bangkok&appid=a8219f8dc98e941510ed5403f9a364be&units=metric';
		$weather = json_decode(file_get_contents($uri));
		if($weather){
			return ceil($weather->main->temp);
		}
	}
	
	public function export_excel(){
		
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"".basename("export-".date('Y-m-d').".xls")."\"");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		
		$rsList = json_decode(file_get_contents('https://www-old.cmuccdc.org/api2/dustboy/stations'));

		?>
		<table>
			<thead>
				<tr>

					<td>ชื่อจุดติดตั้ง(ไทย)</td>
					<td>ชื่อจุดติดตั้ง(อังกฤษ)</td>
					<td>ละติจูต</td>
					<td>ลองติจูต</td>
					<td>เซ็นเซอร์</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($rsList as $v){?>
				<tr>

					<td><?=$v->dustboy_name?></td>
					<td><?=@$v->dustboy_name_en?></td>
					<td><?=@$v->dustboy_lat?></td>
					<td><?=@$v->dustboy_lon?></td>
					<td><?=@$v->source_name?></td>
				</tr>
				<?php }?>
			<tbody>
		</table>
			
		<?php 
	}
	
}