<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Pelapak extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Pelapak'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
	
	public function getpelapak() {
		$data = $this->Model_Pelapak->_getpelapak();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getpelapakid() {
	    $id = $_POST['id_pelapak'];
		$data = $this->Model_Pelapak->_getpelapakid($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getpelapak_id() {
	    $id = $_POST['id_pelapak'];
		$data = $this->Model_Pelapak->get_pelapak_id($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function deletepelapak() {
	    $id = $_POST['id_pelapak'];
	    $delete = $this->Model_Pelapak->_deletepelapak($id);
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete))
                ->_display();
        exit;
	    
	}
	
	public function updatepelapak($id) {
	    $data = array(
	                'nama_pelapak'      => $_POST['nama_pelapak'],
	                'id_prov_pelapak'   => $_POST['id_prov_pelapak'],
	                'id_kab_pelapak'    => $_POST['id_kab_pelapak'],
	                'id_kec_pelapak'    => $_POST['id_kec_pelapak'],
	                'id_kel_pelapak'    => $_POST['id_kel_pelapak'],
	                'alamat_pelapak'    => $_POST['alamat_pelapak'],
	                'no_telp_pelapak'   => $_POST['no_telp_pelapak'],
	                'deskripsi_pelapak' => $_POST['deskripsi_pelapak'],
	                'medsos_pelapak'    => $_POST['medsos_pelapak']);
	   $update = $this->Model_Pelapak->_updatepelapak($id,$data);
	   //return $update;
	   
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
        exit;
	}
	
	public function updatepelapakfoto($id,$foto=null) {
	    $data = array(
	                'nama_pelapak'      => $_POST['nama_pelapak'],
	                'id_prov_pelapak'   => $_POST['id_prov_pelapak'],
	                'id_kab_pelapak'    => $_POST['id_kab_pelapak'],
	                'id_kec_pelapak'    => $_POST['id_kec_pelapak'],
	                'id_kel_pelapak'    => $_POST['id_kel_pelapak'],
	                'alamat_pelapak'    => $_POST['alamat_pelapak'],
	                'no_telp_pelapak'   => $_POST['no_telp_pelapak'],
	                'deskripsi_pelapak' => $_POST['deskripsi_pelapak'],
	                'medsos_pelapak'    => $_POST['medsos_pelapak'],
	                'poto_pelapak'      => $foto);
	   $update = $this->Model_Pelapak->_updatepelapak($id,$data);
	   return $update;
	}
	
	
	public function updatesaldopelapak($id) {
	   // $id = $_POST['id_pelapak'];
	    $data = array(
	                'saldo_pelapak'    => $_POST['saldo_pelapak']);
	   $update = $this->Model_Pelapak->_updatepelapak($id,$data);
	   //return $update;
	   
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
        exit;
	}
	
	function insertpelapak($foto=null) {
	    $id_pemesan = _GenerateAutoPelapak('pelapak');
	    $data = array(
	                'nama_pelapak'      => $_POST['nama_pelapak'],
	                'id_prov_pelapak'   => $_POST['id_prov_pelapak'],
	                'id_kab_pelapak'    => $_POST['id_kab_pelapak'],
	                'id_kec_pelapak'    => $_POST['id_kec_pelapak'],
	                'id_kel_pelapak'    => $_POST['id_kel_pelapak'],
	                'alamat_pelapak'    => $_POST['alamat_pelapak'],
	                'no_telp_pelapak'   => $_POST['no_telp_pelapak'],
	                'deskripsi_pelapak' => $_POST['deskripsi_pelapak'],
	                'medsos_pelapak'    => $_POST['medsos_pelapak'],
	                'poto_pelapak'      => $foto,
	                'id_login'          => $_POST['id_login']);
	   $insert = $this->Model_Pelapak->_insertpelapak($data);
	   return $insert;
	}
	
	public function savepelapak($id = null) {
	    if($id == null){
	        $code_pelapak = _GenerateAutoPelapak('pelapak');
	    } else (
	        $code_pelapak = $id
	        );
	    $uploaddir = '../File/Pelapak/'.$code_pelapak.'/';
	    if (!file_exists($uploaddir)) {
	        @mkdir($uploaddir);
	    }
	    
	    //Upload a Photos
	if (isset($_POST['poto_pelapak'])) {
        $file_name = 'images1.jpg';
        $uploadfile = $uploaddir.$file_name;
        $foto  = 'images1.jpg';
        if (file_put_contents($uploadfile, base64_decode($_POST['poto_pelapak']))) {
             if($id == null) {
                $result = $this->insertpelapak($foto);
            } else {
                $result = $this->updatepelapakfoto($id,$foto);
            }
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
	
}