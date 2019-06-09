<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Alamat extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Alamat'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
	
	public function get_provinsi() {
		$data = $this->Model_Alamat->_get_provinsi();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function get_kabupaten() {
	    $id = $_POST['id_prov'];
		$data = $this->Model_Alamat->get_kabupaten($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function get_kecamatan() {
	    $id = $_POST['id_kab'];
		$data = $this->Model_Alamat->get_kecamatan($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function get_kelurahan() {
	    $id = $_POST['id_kec'];
		$data = $this->Model_Alamat->get_kelurahan($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getunitkategori() {
	    $id = $_POST['id_kategori'];
		$data = $this->Model_Unit->_getunitkategori($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getunitallkategori() {
	   // $id = $_POST['id_kategori'];
		$data = $this->Model_Unit->get_unit_all();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getunitkategoripelapak() {
	    $id_kategori = $_POST['id_kategori'];
	    $id_pelapak = $_POST['id_pelapak'];
		$data = $this->Model_Unit->_getunitkategoriandpelapak($id_kategori, $id_pelapak);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getunit_by_id_pelapak() {
	    $id = $_POST['id_pelapak'];
		$data = $this->Model_Unit->_getunit_by_id_pelapak($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	//uli : by id pembeli
	public function getkeranjang_post(){
        $id = $_POST['id_pembeli'];
		$data = $this->Model_Keranjang->_getbarangidpembeli($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;

    }
	
}