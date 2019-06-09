<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('asia/jakarta');

class Wishlist extends CI_Controller {

	public function __construct()
    {
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
		$this->load->model('Model_Search'); 
		$this->load->library('upload');
		$this->load->helper('autonumber');
    }
	
	public function getbyunit() {
		$data = $this->Model_Search->byunit();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
		
	public function getbykategori() {
		$data = $this->Model_Search->bykategori();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
		
	public function getbypelapak() {
		$data = $this->Model_Search->bypelapak();
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data))
                ->_display();
        exit;
	}
	
	public function search_produk_post(){
        $this->db->reset_query();
        $key = $this->post('key');
        $id_pembeli = $this->post('id_pemesan');
        $sql = "SELECT unit.id_unit from unit INNER JOIN pelapak ON pelapak.id_pelapak = pelapak.id_pelapak where unit.nama_unit LIKE '%". $key ."%' OR unit.kategori_unit LIKE '%". $key ."%' OR pelapak.nama_pelapak LIKE '%". $key ."%'";
        $data = $this->db->query($sql)->result_array();
        $result = array();
        for ($i=0; $i < sizeof($data); $i++) { 
            array_push($result, $this->dapatkan_produk($data[$i]['id_unit'],$id_pemesan));
        }
        $this->response(array('data'=>$result,'message'=>'success','status' => 200),200);
    }
    
    public function dapatkan_produk($id_unit,$id_pemesan){
        $this->db->reset_query();
        $this->db->where("(id_unit=$id_unit)");
        $datas = $this->db->get('unit')->result_array();
        
        for ($i=0; $i < sizeof($datas); $i++) { 
            $this->db->reset_query();
            $this->db->where('id_pelapak',$datas[$i]['id_pelapak']);
            $isi = $this->db->get('pelapak')->result_array();
            $datas[$i]['pelapak'] = $isi[0];
            
            if ($id_pemesan != '') {
                $datas[$i]['is_wish'] = '0';
                $this->db->where('id_pemesan',$id_pemesan);
                $this->db->where('id_unit',$datas[$i]['id_unit']);
                $cek = $this->db->get('isi_wishlist')->result_array(); 
                if (sizeof($cek) > 0) {
                    $datas[$i]['is_wish'] = '1';
                }          
            }
            
            // tampilin wishlist
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $dataView = $this->db->get('isi_wishlist')->result_array();
            $data[$i]['wish'] = (string)count($dataView);
        }
        
        return $datas[0];
		            
    }
    
	
	
}