<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Kategori extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Kategori'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
	
	public function getkategori() {
		$data = $this->Model_Kategori->_getkategori();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getkategoripelapak() {
	    $id = $_POST['id_pelapak'];
	   // $id_transaksi = $_POST['id_transaksi'];
		$data = $this->Model_Kategori->get_kategori_pelapak($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function insertkategori() {
        $data = array(
	                'id_pelapak'    => $_POST['id_pelapak'],
	                'nama_kategori'    => $_POST['nama_kategori']);
	    $insert = $this->Model_Kategori->_insertkategori($data);
	   
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($insert))
                ->_display();
        exit;
	   //return $insert;
	}
	
	public function updatekategori($id) {
	   $data = array(
	                'nama_kategori'    => $_POST['nama_kategori']);
	   $update = $this->Model_Kategori->_updatekategori($id,$data);
	   $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
        exit;
	   //return $update;
	}
	
	public function deletekategori() {
	    $id = $_POST['id_kategori'];
	    $delete = $this->Model_Unit->_deletekategori($id);
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete))
                ->_display();
        exit;
	    
	}
	
	
}