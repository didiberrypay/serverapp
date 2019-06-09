<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Pemesan extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Pemesan'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
	
	public function getpemesan() {
		$data = $this->Model_Pemesan->_getpemesan();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getpemesanid() {
	    $id = $_POST['id_pemesan'];
		$data = $this->Model_Pemesan->_getpemesanid($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function deletepemesan() {
	    $id = $_POST['id_pemesan'];
	    $delete = $this->Model_Pemesan->_deletepemesan($id);
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete))
                ->_display();
        exit;
	    
	}
	
	public function updatepemesan($id) {
	    $data = array(
	                'nama_pemesan'      => $_POST['nama_pemesan'],
	                'id_prov'           => $_POST['id_prov'],
	                'id_kab'            => $_POST['id_kab'],
	                'id_kec'            => $_POST['id_kec'],
	                'id_kel'            => $_POST['id_kel'],
	                'no_telp_pemesan'   => $_POST['no_telp_pemesan'],
	                'alamat_pemesan'    => $_POST['alamat_pemesan']);
	   $update = $this->Model_Pemesan->_updatepemesan($id,$data);
	   //return $update;
	   
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
        exit;
	}
	
	public function updatepemesanfoto($id,$foto=null) {
	    $data = array(
	                'nama_pemesan'      => $_POST['nama_pemesan'],
	                'id_prov'           => $_POST['id_prov'],
	                'id_kab'            => $_POST['id_kab'],
	                'id_kec'            => $_POST['id_kec'],
	                'id_kel'            => $_POST['id_kel'],
	                'no_telp_pemesan'   => $_POST['no_telp_pemesan'],
	                'alamat_pemesan'    => $_POST['alamat_pemesan'],
	                'poto_pemesan'      => $foto);
	   $update = $this->Model_Pemesan->_updatepemesan($id,$data);
	   return $update;
	}
	
	function insertpemesan($foto=null) {
	    $id_pemesan = _GenerateAutoPemesan('pemesan');
	    $data = array(
	                'nama_pemesan'      => $_POST['nama_pemesan'],
	                'id_prov'           => $_POST['id_prov'],
	                'id_kab'            => $_POST['id_kab'],
	                'id_kec'            => $_POST['id_kec'],
	                'id_kel'            => $_POST['id_kel'],
	                'no_telp_pemesan'   => $_POST['no_telp_pemesan'],
	                'alamat_pemesan'    => $_POST['alamat_pemesan'],
	                'poto_pemesan'      => $foto,
	                'id_login'          => $_POST['id_login']);
	   $insert = $this->Model_Pemesan->_insertpemesan($data);
	   return $insert;
	}
	
	public function savepemesan($id = null) {
	    if($id == null){
	        $code_pemesan = _GenerateAutoPemesan('pemesan');
	    } else (
	        $code_pemesan = $id
	        );
	    $uploaddir = '../File/Pemesan/'.$code_pemesan.'/';
	    if (!file_exists($uploaddir)) {
	        @mkdir($uploaddir);
	    }
	    
	    //Upload a Photos
	if (isset($_POST['poto_pemesan'])) {
        $file_name = 'images1.jpg';
        $uploadfile = $uploaddir.$file_name;
        $foto  = 'images1.jpg';
        if (file_put_contents($uploadfile, base64_decode($_POST['poto_pemesan']))) {
             if($id == null) {
                $result = $this->insertpemesan($foto);
            } else {
                $result = $this->updatepemesanfoto($id,$foto);
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