<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Libur extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Libur'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
	public function getlibur() {
	    $id = $_POST['id_pelapak'];
		$data = $this->Model_Libur->_getlibur($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function deletelibur() {
	    $id = $_POST['id_tgl_libur'];
	    $delete = $this->Model_Libur->_deletelibur($id);
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete))
                ->_display();
        exit;
	    
	}
	
	public function updatelibur($id) {
	    $data = array(
	                'tgl_libur'    => $_POST['tgl_libur'],
	                'deskripsi'      => $_POST['deskripsi']);
	   $update = $this->Model_Libur->_updatelibur($id,$data);
	   //return $update;
	        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
        exit;
    }
	
	public function insertlibur() {
	    $data = array(
	                'id_pelapak'     => $_POST['id_pelapak'],
	                'tgl_libur'    => $_POST['tgl_libur'],
	                'deskripsi'      => $_POST['deskripsi']);
	   $insert = $this->Model_Libur->_insertlibur($data);
	   //return $insert;
	           $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($insert))
                ->_display();
        exit;
    }
	
	

}