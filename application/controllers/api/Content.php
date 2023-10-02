<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';


class Content extends REST_Controller {

    function __construct(){
        // Construct the parent class
        parent::__construct();
		$this->load->model('admin_model');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
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
		
	public function list_get(){
		if($this->uri->segment(4)!=null){
			$rs = $this->admin_model->getContentRow($this->uri->segment(4));
			$this->response($rs, 200);
		}else{
			$rs = $this->admin_model->getContentsList(1);
			$this->response($rs, 200);
		}
	}
}
