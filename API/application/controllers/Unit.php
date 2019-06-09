<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Unit extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Unit'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
	
	public function getunit() {
	    $id_pemesan = $_POST['id_pemesan'];
		$data = $this->Model_Unit->_getunit($id_pemesan);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getunitid() {
	    $id = $_POST['id_unit'];
		$data = $this->Model_Unit->_getunitid($id);
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
		$data = $this->Model_Unit->_getunitkategoriandpelapak( $id_pelapak,$id_kategori);
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
	
	public function updateunit($id) {
	    $data = array(
	                'nama_unit'     => $_POST['nama_unit'],
	                'harga_unit'    => $_POST['harga_unit'],
	                'deskripsi_unit'=> $_POST['deskripsi_unit'],
	                'id_kategori'   => $_POST['id_kategori'],
	                'id_pelapak'    => $_POST['id_pelapak']);
	   $update = $this->Model_Unit->_updateunit($id,$data);
	   //return $update;
	   
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
        exit;
	}
	
	public function updateunitfoto($id, $foto) {
	    $data = array(
	                'nama_unit'     => $_POST['nama_unit'],
	                'harga_unit'    => $_POST['harga_unit'],
	                'deskripsi_unit'=> $_POST['deskripsi_unit'],
	                'poto_unit'     => $foto,
	                'id_kategori'   => $_POST['id_kategori'],
	                'id_pelapak'    => $_POST['id_pelapak']);
	   $update = $this->Model_Unit->_updateunit($id,$data);
	   return $update;
	}
	
	public function insertunit($foto = null) {
	    $data = array(
	                'nama_unit'     => $_POST['nama_unit'],
	                'harga_unit'    => $_POST['harga_unit'],
	               // 'is_ready'      => $_POST['is_ready'],
	                'deskripsi_unit'=> $_POST['deskripsi_unit'],
	                'poto_unit'     => $foto,
	                'id_kategori'   => $_POST['id_kategori'],
	                'id_pelapak'    => $_POST['id_pelapak']);
	   $insert = $this->Model_Unit->_insertunit($data);
	   return $insert;
	}
	
	public function saveunit($id = null) {
        $foto  = 'images1.jpg';
	    if($id == null){
	        $code_unit = $this->insertunit($foto);
	    } else (
	        $code_unit = $this->updateunitfoto($id,$foto)
	        );
	    $uploaddir = '../File/Unit/'.$code_unit.'/';
	    if (!file_exists($uploaddir)) {
	        @mkdir($uploaddir);
	    }
	    
	    //Upload a Photos
	if (isset($_POST['poto_unit'])) {
	    $file_name = 'images1.jpg';
        $uploadfile = $uploaddir.$file_name;
        if (file_put_contents($uploadfile, base64_decode($_POST['poto_unit']))) {
            $result = array(
                            'STATUS' => '200',
                            'MESSAGE'=> 'Success',
                            'DATA'   => null);
        } else {
            $result = array(
                            'STATUS' => '500',
                            'MESSAGE'=> 'Upload Image Error',
                            'DATA'   => null);       
         }
          $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($result))
                ->_display();
        exit;
	}
	
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
    
    //Wishlist
    
	public function insertDeleteWishlist(){
        $id_pemesan = $_POST['id_pemesan'];
        $id_unit = $_POST['id_unit'];
		$data = $this->Model_Unit->add_wishlist_post($id_unit, $id_pemesan);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;

    }

    public function wishlist_post(){
        $id_pemesan = $_POST['id_pemesan'];
        // $id_unit = $_POST['id_unit'];
		$data = $this->Model_Unit->wishlist_post($id_pemesan);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }

	
}