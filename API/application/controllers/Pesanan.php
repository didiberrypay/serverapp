<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Pesanan extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Pesanan'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
    
    public function get_pesanan_pemesan_proses(){
        $id = $_POST['id_pemesan'];
		$data = $this->Model_Pesanan->get_pesanan_pemesan($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }

    public function get_pesanan_pemesan_riwayat(){
        $id = $_POST['id_pemesan'];
		$data = $this->Model_Pesanan->get_pesanan_pemesan_riwayat($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }

    
    public function get_pesanan_pelapak_proses(){
        $id = $_POST['id_pelapak'];
		$data = $this->Model_Pesanan->get_pesanan_pelapak_proses($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    
    public function get_pesanan_pelapak_riwayat(){
        $id = $_POST['id_pelapak'];
		$data = $this->Model_Pesanan->get_pesanan_pelapak_riwayat($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }

    public function get_pesanan_all(){
        // $id = $_POST['id_pelapak'];
		$data = $this->Model_Pesanan->get_pesanan_all();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    
    public function get_pesanan_pemesan_batal(){
        $id = $_POST['id_pemesan'];
		$data = $this->Model_Pesanan->get_pesanan_pemesan_batal($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    
    public function get_pesanan_pelapak_batal(){
        $id = $_POST['id_pelapak'];
		$data = $this->Model_Pesanan->get_pesanan_pelapak_batal($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }





    public function get_pesanan_all_proses(){
		$data = $this->Model_Pesanan->get_pesanan_all_proses();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    
    public function get_pesanan_all_riwayat(){
		$data = $this->Model_Pesanan->get_pesanan_all_riwayat();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    
    public function get_pesanan_all_batal(){
		$data = $this->Model_Pesanan->get_pesanan_all_batal();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }





    
    public function get_pesanan_proses_all(){
        // $id = $_POST['id_pelapak'];
		$data = $this->Model_Pesanan->get_pesanan_status_proses_all();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    
    public function updatepesanan() {
        $id = $_POST['id_transaksi'];
	    $data = array('status' => $_POST['status']);
	    $update = $this->Model_Pesanan->_updatepesanan($id,$data);
	   
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
                exit;
	}
	
	public function update_transaksi() {
        $id = $_POST['id_transaksi'];
	   $update = $this->Model_Pesanan->_updatetransaksi($id);
	   
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
                exit;
	}
	
	public function ubah_is_pay(){
	    $id = $_POST['id_transaksi'];
	    $data = array('is_pay' => '1',
	                    'status' => $_POST['status']);
	    $update = $this->Model_Pesanan->_updatepesanan($id,$data);
	    
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
                exit;
	}
	
	public function ubah_is_delete(){
	    $id = $_POST['id_transaksi'];
	    $data = array('is_delete' => '1');
	    $update = $this->Model_Pesanan->_updatepesanan($id,$data);
	    
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
                exit;
	}
	
	public function ubah_is_canceled(){
	    $id = $_POST['id_transaksi'];
	    $data = array('is_cancel' => '1',
	                    'ket_cancel' => $_POST['ket_cancel'] );
	    $update = $this->Model_Pesanan->_updatepesanan($id,$data);
	    
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
                exit;
	}
	
	public function ubah_tanggal_acara(){
	    $id = $_POST['id_transaksi'];
	    $data = array('tanggal_acara' => $_POST['tanggal_acara']);
	    $update = $this->Model_Pesanan->_updatepesanan($id,$data);
	    
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
                exit;
	}
	
	public function updateStatusIspay($id,$data) {
	    $id = $_POST['id_transaksi'];
	    $data = array(
	               // 'is_pay'       => '1',
	                'status' => $_POST['status']);
	    $update = $this->Model_Pesanan->_updatepesanan($id,$data);
	    
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
                exit;
	}
	
	public function updateTransaksi($id,$foto=null) {
	    $id = $_POST['id_transaksi'];
	    $data = array(
	                'bukti_bayar'       => $foto,
	                'status'            => '3');
	    $update = $this->Model_Pesanan->_updatepesanan($id,$data);
	    
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($update))
                ->_display();
                exit;
	}
	
	
	public function savebuktibayar() {
        $id = $_POST['id_transaksi'];
        $code_transaksi = $id;
	    $uploaddir = '../File/Transaksi/'.$code_transaksi.'/';
	    if (!file_exists($uploaddir)) {
	        @mkdir($uploaddir);
	    }
	    
	    //Upload a Photos
    	if (isset($_POST['bukti_bayar'])) {
            $file_name = 'images1.jpg';
            $uploadfile = $uploaddir.$file_name;
            $foto  = 'images1.jpg';
            if (file_put_contents($uploadfile, base64_decode($_POST['bukti_bayar']))) {
                    $result = $this->updateTransaksi($id,$foto);
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

    
    public function get_pesanan_status_riwayat(){
        $id = $_POST['id_pemesan'];
        // $id = $_POST['status'];
		$data = $this->Model_Pesanan->get_pesanan_status_riwayat($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    
    public function get_pesanan_status_proses(){
        $id = $_POST['id_pemesan'];
        // $id = $_POST['status'];
		$data = $this->Model_Pesanan->get_pesanan_status_proses($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
    
    public function getpesanan_proses_all() {
		$data = $this->Model_Pesanan->get_pesanan_status_proses_all();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getpesanan_riwayat_all() {
		$data = $this->Model_Pesanan->get_pesanan_status_riwayat_all();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
}
?>