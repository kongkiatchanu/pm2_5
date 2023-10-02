<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';


class Menu extends REST_Controller {

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

    public function list_get(){
        $rsConfig = $this->admin_model->getMenuAPILists();
		$this->response($rsConfig, 200);
    }
		

}
