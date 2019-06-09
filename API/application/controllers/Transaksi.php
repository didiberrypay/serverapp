<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Transaksi extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Transaksi'); 
		$this->load->library('upload');
    }
	
	public function getTransaksiPelapak() {
	    $id = $_POST['id_pelapak'];
		$data = $this->Model_Transaksi->_getTransaksiPelapak($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function getTransaksiPemesan() {
	    $id = $_POST['id_pemesan'];
		$data = $this->Model_Transaksi->_getTransaksiPemesan($id);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function deleteTransaksi() {
	    $id = $_POST['id_transaksi'];
	    $delete = $this->Model_Transaksi->_deleteTransaksi($id);
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($delete))
                ->_display();
        exit;
	    
	}
	
	
	public function updateTransaksi($id,$foto=null) {
	    $data = array(
	                'bukti_bayar'       => $foto,
	                'is_pay'            => $_POST['is_pay'],
	                'is_cancel'         => $_POST['is_cancel'],
	                'is_delete'         => $_POST['is_delete']);
	   $update = $this->Model_Transaksi->_updateTransaksi($id,$data);
	   return $update;
	}
	
	function insertTransaksi() {
	    
	    
        date_default_timezone_set('Asia/Jakarta');
	    $data = array(
	                'id_pelapak'        => $_POST['id_pelapak'],
	                'id_pemesan'        => $_POST['id_pemesan'],
	                'metode_transaksi'  => $_POST['metode_transaksi'],
	                'id_unit'           => $_POST['id_unit'],
	                'alamat_acara'      => $_POST['alamat_acara'],
	                'tanggal_acara'     => $_POST['tanggal_acara'],
                    'tanggal_transaksi'  => $tanggal_transaksi = date('Y-m-d'));
        
            
           // If(sizeof($cek) == 0){
                // Insert
        	   $insert = $this->Model_Transaksi->_insertTransaksi($_POST['id_pelapak'], $_POST['tanggal_acara'], $data);
            //} else {
                //return null;
           // }
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($insert))
                ->_display();
        exit;
	   
            // $result = array(
            //                 'STATUS' => '200',
            //                 'MESSAGE'=> 'Success',
            //                 'DATA'   => $insert); 
	}
	
	public function add_to_transaksi_post(){
        $id_pembeli = $_POST['id_pembeli'];
        $id_keranjang = $_POST['id_keranjang'];
        $alamat_tujuan = $_POST['alamat_tujuan'];
        
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_pengiriman = date('Y-m-d');
        $waktu_pengiriman = $_POST['waktu_pengiriman'];
        $ongkos_kirim = $_POST['ongkos_kirim'];
        
		$data = $this->Model_Keranjang->keranjang_to_transaksi_post($id_pembeli,$id_keranjang,$alamat_tujuan,$tanggal_pengiriman,$waktu_pengiriman,$ongkos_kirim);
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
    }
	
	public function savetransaksi($id = null) {
        $file_name = 'images1.jpg';
	    if($id == null){
	        $idTransaksi = $this->insertTransaksi($file_name);
	    } else {
	        $idTransaksi = $this->updateTransaksi($id,$file_name);
	        };
	    $uploaddir = '../FILE/Transaksi/'.$idTransaksi.'/';
	    if (!file_exists($uploaddir)) {
	        @mkdir($uploaddir);
	    }
	    
	    //Upload a Photos
	if (isset($_POST['bukti_bayar'])) {
        $uploadfile = $uploaddir.$file_name;
        if (file_put_contents($uploadfile, base64_decode($_POST['bukti_bayar']))) {
            $result = array(
                            'STATUS' => '200',
                            'MESSAGE'=> 'Berhasil',
                            'DATA'   => null);
        } else {
            $result = array(
                            'STATUS' => '500',
                            'MESSAGE'=> 'Gagal',
                            'DATA'   => null);       
         }
	}
	    $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($result))
                ->_display();
        exit;
	
	}
	
}