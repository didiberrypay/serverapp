<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Searh extends CI_Model {

        
        function byunit(){
		$query = $this->db->query('SELECT * FROM unit');
			if($query->num_rows() > 0) {
			$data = $query->result();
		    return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $data);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($query),
		                    'DATA'   => null);
		    }
        }
        
        function bypelapak(){
		    $query = $this->db->query('SELECT * FROM pelapak');
			if($query->num_rows() > 0) {
			$data = $query->result();
		    return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $data);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($query),
		                    'DATA'   => null);
		    }
        }
        
        function bykategori(){
		    $query = $this->db->query('SELECT * FROM kategori');
			if($query->num_rows() > 0) {
			$data = $query->result();
		    return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $data);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($query),
		                    'DATA'   => null);
		    }
        }
        
        function _getwishlistidpemesan($id){
            $this->db->reset_query();
		    $this->db->where('id_pemesan', $id);
		    $query = $this->db->get('isi_wishlist')->result_array();
		    
		    for($i=0;$i<sizeof($query);$i++){
                $this->db->reset_query();
                $this->db->where('id_unit',$query[$i]['id_unit']);
                $isi = $this->db->get('unit')->result_array();
                for ($j=0; $j < sizeof($isi); $j++) { 
                    $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                    $isi[$j]['pelapak'] = $pelapak;
            }
            $query[$i]['isi_pesanan'] = $isi;

	        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $query);
    	    }
            
        }
	    
	    public function get_wishlist($id_pemesan){
        // $this->db->reset_query();
		$this->db->where('id_pemesan', $id_pemesan);
        // $id_pemesan = $this->post('id_pemesan',$id_pemesan);
        $query = "SELECT * from isi_wishlist WHERE id_pemesan = '$id_pemesan' AND is_transaction = '0'";
        // $data = $this->db->get('isi_wishlist')->result_array();
        $data = $this->db->query($query)->result_array();
        for ($i=0; $i < sizeof($data) ; $i++) { 
            $this->db->reset_query();
            // $this->db->where('id_isi_wishlist',$data[$i]['id_isi_wishlist']);
            // $isi = $this->db->get('isi_wishlist')->result_array();
            // for ($j=0; $j < sizeof($isi); $j++) { 
                
                $id_pelapak = $this->getpelapak($data[$i]['id_pelapak']);
                $data[$i]['pelapak'] = $id_pelapak;
                
                $produk = $this->getunit($data[$i]['id_unit']);
                $data[$i]['unit'] = $produk;
                
                    
            // }
            // $data[$i]['isi_wishlist'] = $data;
            
        }
        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'success',
		                    'DATA'   => $data);

    }
    
    function _insertwishlist($data = array()){
            
            $query = $this->db->insert('isi_wishlist', $data);
            
            if ($query){
                $this->db->reset_query();
                // $this->db->where('id_pelapak',$data['id_pelapak']);
                $datas = $this->db->get('isi_wishlist')->result_array();
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => $datas[0]);
            } else {
                return array(
                    'STATUS'  => 200,
                    'MESSAGE' => mysqli_error($query),
                    'DATA'    => null);
            }
            // return $this->db->insert_id();
    }
        
    function _updatewishlist($id, $data = array()){
            // $this->db->where('id_unit', $id);
            // $this->db->update('unit', $data);
            // $this->db->reset_query();
            // $datas = $this->db->where('id_unit',$id);
            // $datas = $this->db->get('unit')->result_array();

            // return array(
            //         'STATUS'  => 200,
            //         'MESSAGE' => 'Success',
            //         'DATA'    => $datas[0]);
                    
                    
            $this->db->where('id_isi_wishlist', $id);
            $this->db->update('isi_wishlist', $data);
            
            if ($this){
                $this->db->reset_query();
                // $this->db->where('id_pelapak',$data['id_pelapak']);
                $datas = $this->db->get('isi_wishlist')->result_array();
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => $datas[0]);
            } else {
                return array(
                    'STATUS'  => 200,
                    'MESSAGE' => mysqli_error($query),
                    'DATA'    => null);
        }
            
            // return $this->db->insert_id();
    }
    
    function _deleteisiwishlist($id){
            $this->db->where('id_isi_wishlist', $id);
            $this->db->delete('isi_wishlist');
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => null);
        }
    
    
    function getunit($id){
        $this->db->reset_query();
        $this->db->where('id_unit',$id);
        $data = $this->db->get('unit')->result_array();
        if(sizeof($data)>0){
            return $data[0];
        }
        return null;
    }
    
    function getpelapak($id){
        $this->db->reset_query();
        $this->db->where('id_pelapak',$id);
        $data = $this->db->get('pelapak')->result_array();
        if(sizeof($data)>0){
            return $data[0];
        }
        return null;
    }
    
    public function cek_produk_wishlist_post($id_pemesan,$id_unit)
    {
        // $id_pemesan = $this->post('id_pemesan');
		$this->db->where('id_pemesan', $id_pemesan);
		$this->db->where('id_unit', $id_unit);
        // $id_produk = $this->post('id_unit');
        $this->db->reset_query();
        $cekwishlist = "SELECT * from wishlist where id_pemesan = '$id_pemesan'and is_transaction = '0' ";
        $cek = $this->db->query($cekwishlist)->result_array();
        if (sizeof($cek) == 0) {
            $this->response(array('data' => null,'message'=>'Produk belum ada diwishlist','status'=>200 ), 200); 
            return;
        }
        
        $id_wishlist = $cek[0]['id_wishlist'];
        $cekIsiwishlist = "SELECT * from isi_wishlist where id_wishlist = $id_wishlist and id_unit = $id_unit";
        $cekLagi = $this->db->query($cekIsiwishlist)->result_array();
        if (sizeof($cekLagi) == 0) {
            $this->response(array('data' => null,'message'=>'Produk belum ada diwishlist','status'=>200 ), 200); 
            return;
        }else{
            $this->response(array('data' => null,'message'=>'Produk sudah ada diwishlist','status'=>400 ), 200); 
            return;
        }
    }
    
    public function add_to_wishlist_post($id_pemesan,$id_unit,$id_pelapak){
		$this->db->where('id_pemesan', $id_pemesan);
		$this->db->where('id_unit', $id_unit);
		$this->db->where('id_pelapak', $id_pelapak);
        // $id_pemesan = $this->post('id_pemesan');
        // $id_unit = $this->post('id_unit');
        // $jumlah_beli = $this->post('jumlah_beli');
        // $data = $this->getgetget($id_pemesan);
        // $id_wishlist = $data['id_wishlist'];
        $cekSql = "SELECT * from isi_wishlist where id_unit = '$id_unit' AND id_pemesan = '$id_pemesan' ";
        $cek = $this->db->query($cekSql)->result_array();
            if (sizeof($cek) > 0) {
                return array('data' => null,'message'=>'Produk sudah ada di wishlist Anda','status'=>400 );
            }
        $this->db->reset_query();
        $isi_wishlist = array('id_pemesan' => $id_pemesan,'id_unit'=>$id_unit,'id_pelapak'=>$id_pelapak );
        $insert = $this->db->insert('isi_wishlist',$isi_wishlist);
        if ($insert) {
            return array('data' => "Berhasil dimasukkan wishlist",'message'=>'success','status'=>200);     
        }else{
            return array('data' => null,'message'=>'failed','error'=> $this->db->error(),'status'=>400 );
            // $this->response(array('data' => null,'message'=>'failed','error'=> $this->db->error(),'status'=>400 ), 200); 
        }
    }
    
    function getgetget($id_pemesan){    
        $this->db->reset_query();
        $sql = "SELECT * from wishlist WHERE id_pemesan = '$id_pemesan' AND is_transaction = '0'";
        $data = $this->db->query($sql)->result_array();

        if (sizeof($data) == 0) {
            $this->db->reset_query();
            $wishlist = array('id_pemesan' => $id_pemesan,'is_transaction' => '0');
            $this->db->insert('wishlist',$wishlist);
            $id = $this->db->insert_id();

            $this->db->reset_query();            
            $sql = "SELECT * from wishlist WHERE id_wishlist = '$id' AND is_transaction = '0'";
            $data = $this->db->query($sql)->result_array();

            }
        return $data[0]; 
    }
    
    // function _updatewishlist($id, $data = array()){
    //         $this->db->where('id_wishlist', $id);
    //         $this->db->update('langkah', $data);
    //         return array(
    //                 'STATUS'  => 200,
    //                 'MESSAGE' => 'Success',
    //                 'DATA'    => $data);
    //     }
        
    public function update_produk_wishlist_post($id_isi_wishlist){
        // $id_isi_wishlist = $this->post('id_isi_wishlist');
        
        
        $this->db->where('qty',$qty);
        // $qty = $this->post('qty');
        $this->db->reset_query();
        $this->db->where('id_isi_wishlist',$id_isi_wishlist);
        $data = array('jumlah_beli' => $qty);
        $update = $this->db->update('isi_wishlist',$data);

        if ($update) {
            $this->response(array('data' => null,'message'=>'Berhasil diupdate','status'=>200 ), 200); 
        }else{
            $this->response(array('data' => null,'message'=>'Gagal diupdate','status'=>400 ), 200); 
        }
    }
    
    public function delete_from_wishlist_post($id_isi_wishlist){
        $this->db->reset_query();
		$this->db->where('id_isi_wishlist', $id_isi_wishlist);
        // $id_isi_wishlist = $this->post('id_isi_wishlist');
        // $this->db->where('id_isi_wishlist',$id_isi_wishlist);
        $data = $this->db->get('isi_wishlist')->result_array();
        $id_wishlist = $data[0]['id_wishlist'];

        $this->db->reset_query();
        $this->db->where('id_wishlist',$id_wishlist);
        $data = $this->db->get('isi_wishlist')->result_array();
        
        $this->db->reset_query();
        if (sizeof($data) > 1) {
            $this->db->where('id_isi_wishlist',$id_isi_wishlist);
            $delete = $this->db->delete('isi_wishlist');
            if ($delete) {
                $this->response(array('data' => "Berhasil menghapus produk dari wishlist",'message'=>'success','status'=>200 ), 200);     
            }else{
                $this->response(array('data' => null,'message'=>'failed','error'=> $this->db->error(),'status'=>400 ), 200); 
            }
        }else{
            $this->db->where('id_wishlist',$id_wishlist);
            $delete = $this->db->delete('wishlist');
            if ($delete) {
            $this->response(array('data' => "Berhasil menghapus wishlist",'message'=>'success','status'=>200 ), 200);     
            }else{
                $this->response(array('data' => null,'message'=>'failed','error'=> $this->db->error(),'status'=>400 ), 200); 
            }
        }
    }
    
    public function wishlist_to_transaksi_post($id_pemesan,$id_unit,$id_pelapak,$alamat_acara,$tanggal_acara,$tanggal_transaksi, $metode_transaksi){
        

        // $this->db->reset_query();
        // $this->db->where('id_wishlist',$id_wishlist);

        // $dataUpdate = array('is_transaction' => '1' );
        // $update = $this->db->update('wishlist',$dataUpdate);
        // if ($update) {
            
            $this->db->reset_query();
            $insertData = array('id_pemesan' => $id_pemesan,'id_unit' => $id_unit,'id_pelapak' => $id_pelapak, 'alamat_acara' => $alamat_acara, 'tanggal_acara' =>$tanggal_acara, 'tanggal_transaksi' =>$tanggal_transaksi , 'metode_transaksi' =>$metode_transaksi );
            $insert = $this->db->insert('transaksi',$insertData);
            
            if ($insert) {
                
                $id_transaksi = $this->db->insert_id();
                $this->db->reset_query();
                $this->db->where('id_transaksi',$id_transaksi);
                $data = $this->db->get('transaksi')->result_array();
                
                return array('data'=>$data[0],'message'=> 'success','status' => 200);        
                
            } else {
                
                return array('data'=>null,'error' => $this->db->error(),'message'=> 'Gagal menyimpan data','status' => 400);
                
            }
        // } else {
        //     return array('data'=>null,'error' => $this->db->error(),'message'=> 'Gagal menyimpan data','status' => 400);
        // }
    }
    
    function _transaksi_pemesan_post($id_pemesan){
        $this->db->reset_query();
        $this->db->where('id_pemesan',$id_pemesan);
        $transaksi = $this->db->get('transaksi')->result_array();
        for ($i=0; $i < sizeof($transaksi) ; $i++) { 
            // get pemesan info
            $id_pemesan = $transaksi[$i]['id_pemesan'];
            $this->db->reset_query();
            $this->db->where('id_pemesan',$id_pemesan);
            $pemesan = $this->db->get('pemesan')->result_array();
            $this->db->reset_query();
            $this->db->where('id_user',$pemesan[0]['id_user']);
            $resultUser = $this->db->get('login')->result_array();
            $transaksi[$i]['pemesan'] = $pemesan[0];

            // get produk transaksi
            $id_wishlist = $transaksi[$i]['id_wishlist'];
            $this->db->reset_query();
            $this->db->where('id_wishlist',$id_wishlist);
            $produk_list= $this->db->get('isi_wishlist')->result_array();
            for ($j=0; $j<sizeof($produk_list) ; $j++) { 
                $this->db->reset_query();
                $id_produk = $produk_list[$j]['id_produk'];
                // echo "id_produk = $id_produk";
                $produk = $this->dapatkan_produk($id_produk,$id_pemesan);
                $produk_list[$j]['produk'] = $produk;
            }
            $transaksi[$i]['produk_list'] = $produk_list;
        }
        
            if($this) {
		        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $this);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($this),
		                    'DATA'   => null);
		    }
        // $this->response(array('data'=>$transaksi,'message'=> 'success','status' => 200),200);

    }
    
    public function konfirmasi_transaksi_post()
    {
        
        $this->db->where('id_transaksi',$id_transaksi);
        $this->db->where('ongkos_kirim',$ongkos_kirim);
        // date_default_timezone_set('Asia/Jakarta');
        // $update_at = date("Y-m-d H:i:s");
        $data = $this->post('data');
        // $data = '[{"id_isi_wishlist":"34","harga":"350000.0"},{"id_isi_wishlist":"35","harga":"500000.0"}]';
        $data = json_decode($data,true);
        for ($i=0; $i < sizeof($data)  ; $i++) { 
            $id_isi_wishlist = $data[$i]['id_isi_wishlist'];
            $harga = $data[$i]['harga'];
            $this->db->reset_query();
            $this->db->where('id_isi_wishlist',$id_isi_wishlist);
            $update = array('harga'=>$harga );
            $update = $this->db->update('isi_wishlist',$update);
            if (!$update) {
                 $this->response(array('data'=>$this->db->error(),'message'=> 'error','status' => 400),200);
            }
        }
        $this->db->reset_query();
        // date_default_timezone_set('Asia/Jakarta');
        // $date_kadarluarsa = date("Y-m-d H:i:s",strtotime('+2 days'));
        $update_transaksi = array('ongkos_kirim' =>$ongkos_kirim,'updated_at' => $update_at,'status'=>'2','is_read_owner'=>'1','is_read_pemesan'=>'0');
        $this->db->where('id_transaksi',$id_transaksi);
        $update = $this->db->update('tb_transaksi',$update_transaksi);
        if ($update) {
            $this->response(array('data'=>"Berhasil menyimpan transaksi",'message'=> 'success','status' => 200),200);
        }else{
            $this->response(array('data'=>$this->db->error(),'message'=> 'error','status' => 400),200);
        }
    }

    public function batal_transaksi_post()
    {
        $id_transaksi = $this->post('id_transaksi');
        date_default_timezone_set('Asia/Jakarta');
        $update_at = date("Y-m-d H:i:s");
        $update_transaksi = array('updated_at' =>$update_at,'status' => '6','is_read_pemesan'=>'1','is_read_owner' =>'1');
        $this->db->where('id_transaksi',$id_transaksi);
        $update = $this->db->update('tb_transaksi',$update_transaksi);
        if ($update) {
            $this->response(array('data'=>"Berhasil membatalkan transaksi",'message'=> 'success','status' => 200),200);
        }else{
            $this->response(array('data'=>$this->db->error(),'message'=> 'error','status' => 400),200);
        }
    }
        
        
        public function hapus_isi_wishlist($id_isi_wishlist){
            $this->db->reset_query();
            $this->db->where('id_isi_wishlist',$id_isi_wishlist);
            $datas = $this->db->get('isi_wishlist')->result_array();
            $this->db->reset_query();
            // if(sizeof($datas) == 1){
            //     // todo isi wishlist = 1
            //     $this->db->where('id_wishlist',$id_wishlist);
            //     $delete = $this->db->delete('wishlist');
            // }else{
                // todo isi wishlist > 1
                $this->db->where('id_isi_wishlist',$id_isi_wishlist);
                $delete = $this->db->delete('isi_wishlist');
            // }
            if($delete){
                return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => "Berhasil menghapus isi wishlist");
            }else{
                return array(
                    'STATUS'  => 500,
                    'MESSAGE' => $this->db->error(),
                    'DATA'    => null);
            }
        }
        
        public function ubah_jumlah_beli($data = array()){
            $this->db->where('id_isi_wishlist',$data['id_isi_wishlist']);
            // $datas = array('jumlah_beli',$data['jumlah_beli']);
            $update = $this->db->update('isi_wishlist',$data);
            if($update){
                        return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => "Berhasil merubah jumlah beli");
            }else{
                        return array(
                    'STATUS'  => 500,
                    'MESSAGE' => $this->db->error(),
                    'DATA'    => null);
            }
        }
        
}