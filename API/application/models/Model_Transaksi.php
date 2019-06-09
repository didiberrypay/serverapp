<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Transaksi extends CI_Model {
    
       function _getTransaksiPelapak($id){
		$this->db->where('id_pelapak', $id);
		$this->db->order_by("id_transaksi", "desc");
		$query = $this->db->get('transaksi')->result();
		    if($query) {
			
		        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Berhasil',
		                    'DATA'   => $query);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> 'Transaksi Kosong',
		                    'DATA'   => null);
		    }
        }
        
        function _getTransaksiPemesan($id){
		$this->db->where('id_pemesan', $id);
		$this->db->order_by("id_transaksi", "desc");
		$query = $this->db->get('transaksi')->result();
		    if($query) {
			
		        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Berhasil',
		                    'DATA'   => $query);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> 'Transaksi Kosong',
		                    'DATA'   => null);
		    }
	    }
	    
        
        function _updateTransaksi($id, $data = array()){
            $this->db->where('id_transaksi', $id);
            $this->db->update('transaksi', $data);
            return $this->db->insert_id();
        }
        
        function _deleteTransaksi($id){
            $this->db->where('id_transaksi', $id);
            $this->db->delete('transaksi');
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Transaksi Terhapus',
                    'DATA'    => null);
        }
        
    //     function _insertTransaksi($data){
		  //  $query = $this->db->insert('transaksi',$data);
		  //  if($query) {
		  //      $id_transaksi = $this->db->insert_id();
		        
    //             return array(
    //                     'STATUS'  => 200,
    //                     'MESSAGE' => 'Success',
    //                     'DATA'    => $query);
		  //    //  return $id_transaksi;
		  //  } else {
		  //      return null;
		  //  }
	   // }
	    
        function _insertTransaksi($id, $tanggal, $data){
	        $cek = $this->cek_libur($id, $tanggal);
	        if ($cek == false) {
            $query = $this->db->insert('transaksi', $data);
            
            if ($query){
                //$this->db->reset_query();
                // $this->db->where('id_pelapak',$data['id_pelapak']);
                $datas = $this->db->get('transaksi')->result_array();
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => null);
            } else {
                return array(
                    'STATUS'  => 200,
                    'MESSAGE' => mysqli_error($query),
                    'DATA'    => null);
            }
	        } else {
	            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Pelapak Libur',
                    'DATA'    => $cek);
	        }
            // return $this->db->insert_id();
        }
        
        public function cek_libur($id_pelapak, $tanggal) {
	    // $tanggal_acara = $data;
            $this->db->where('tgl_libur', $tanggal);
            $this->db->where('id_pelapak', $id_pelapak);
            $cek = $this->db->get('tgl_libur');
            if($cek->num_rows() == 1) {
                return $cek->row();
            } else {
                return false;
            }
	}
	    
	    
	   public function add_to_keranjang_post($id_pemesan,$id_unit,$id_pelapak){
		$this->db->where('id_pembeli', $id_pembeli);
		$this->db->where('id_unit', $id_unit);
		$this->db->where('id_pelapak', $id_pelapak);
        // $id_pembeli = $this->pot('id_pembeli');
        // $id_barang = $this->post('id_barang');
        // $jumlah_beli = $this->post('jumlah_beli');
        $data = $this->getgetget($id_peesan);
        $id_keranjang = $data['id_keranjang'];
        $cekSql = "SELECT * from isi_keranjang where id_keranjang = '$id_keranjang' AND id_barang = '$id_barang' ";
        $cek = $this->db->query($cekSql)->result_array();
        if (sizeof($cek) > 0) {
            return array('data' => null,'message'=>'Produk sudah ada dikeranjang','status'=>400 );
            // $this->response(array('data' => null,'message'=>'Produk sudah ada dikeranjang','status'=>400 ), 200); 
            // return;
        }
        $this->db->reset_query();
        $isi_keranjang = array('id_keranjang' => $id_keranjang,'id_barang'=>$id_barang,'jumlah_beli'=>$jumlah_beli,'harga'=>$harga );
        $insert = $this->db->insert('isi_keranjang',$isi_keranjang);
        if ($insert) {
            return array('data' => "Berhasil dimasukkan keranjang",'message'=>'success','status'=>200);
            // $this->response(array('data' => "Berhasil dimasukkan keranjang",'message'=>'success','status'=>200 ), 200);     
        }else{
            return array('data' => null,'message'=>'failed','error'=> $this->db->error(),'status'=>400 );
            // $this->response(array('data' => null,'message'=>'failed','error'=> $this->db->error(),'status'=>400 ), 200); 
        }
    }
	    
}