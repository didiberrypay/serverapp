<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Register');
    }
	
	public function createUser() {
	    $e = $_POST['email'];
	    $p = $_POST['password'];
	    $l = $_POST['level'];
		$data = $this->Model_Register->_createUser($e,$p,$l);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function signup() {
	    $email = $_POST['email'];
	    $data = array(
	                'email'    => $_POST['email'],
	                'password' => $_POST['password'],
	                'level'    => $_POST['level']);
	    $insert = $this->Model_Register->_checkemail($data, $email);
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($insert))
                ->_display();
        exit;
	}
	
}