<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Review extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Review'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
	
	public function getreview() {
		$data = $this->Model_Review->get_review_all();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getreviewpelapak() {
	    $id = $_POST['id_pelapak'];
	    $id_transaksi = $_POST['id_transaksi'];
		$data = $this->Model_Review->get_review_pelapak($id, $id_transaksi);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	public function getreviewpelapak_all() {
	    $id = $_POST['id_pelapak'];
		$data = $this->Model_Review->get_cek_review($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	public function deleteunit() {
	    $id = $_POST['id_unit'];
	    $delete = $this->Model_Unit->_deleteunit($id);
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete))
                ->_display();
        exit;
	    
	}
	
	public function updatereview($id, $foto) {
	    $data = array(
	                'nama_unit'     => $_POST['nama_unit'],
	                'harga_unit'    => $_POST['harga_unit'],
	                'is_ready'      => $_POST['is_ready'],
	                'deskripsi_unit'=> $_POST['deskripsi_unit'],
	                'poto_unit'     => $foto,
	                'id_kategori'   => $_POST['id_kategori'],
	                'id_pelapak'    => $_POST['id_pelapak']);
	   $update = $this->Model_Unit->_updateunit($id,$data);
	   return $update;
	}
	
	public function insertreview() {
	    $data = array(
	                'rating'            => $_POST['rating'],
	                'review'            => $_POST['review'],
	                'id_transaksi'      => $_POST['id_transaksi'],
	                'id_pemesan'        => $_POST['id_pemesan'],
	                'id_pelapak'        => $_POST['id_pelapak']);
	                
	   $insert = $this->Model_Review->insert_review($data);
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($insert))
                ->_display();
        exit;
	   //return $insert;
	}
	
}