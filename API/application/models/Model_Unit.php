<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Unit extends CI_Model {

        
    function _getunit($id_pemesan){
        $this->db->reset_query();
        // $this->db->where("(id_unit=$id_unit)");
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
        
        for ($i=0; $i < sizeof($datas); $i++) { 
            $this->db->reset_query();
            $this->db->where('id_pelapak',$datas[$i]['id_pelapak']);
            $isi = $this->db->get('pelapak')->result_array();
            $datas[$i]['pelapak'] = $isi[0];
            
            
            // if ($id_pelapak == $datas[$i]['id_pelapak']) {
                $datas[$i]['is_libur'] = '0';
                $this->db->where('id_pelapak',$datas[$i]['id_pelapak']);
                // $this->db->where('id_unit',$datas[$i]['id_unit']);
                $cek = $this->db->get('tgl_libur')->result_array(); 
                if (sizeof($cek) > 0) {
                    $datas[$i]['is_libur'] = '1';
                }          
            // }


        }
        
        for ($j=0; $j < sizeof($datas); $j++) { 
            $this->db->reset_query();
            $this->db->where('id_kategori',$datas[$j]['id_kategori']);
            $kategori = $this->db->get('kategori_unit')->result_array();
            $datas[$j]['kategori_unit'] = $kategori[0];
        }
        // for($i=0;$i<sizeof($datas);$i++){
        //     $this->db->reset_query();
        //     $this->db->where('id_unit',$datas[$i]['id_unit']);
        //     $isi = $this->db->get('unit')->result_array();
        //     $datas[$i]['isi_pesanan'] = $isi;
        // }

		    return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
		 
        }
        
        function _getunitid($id){
		$this->db->where('id_unit', $id);
		    $query = $this->db->get('unit')->result();
		    if($query) {
		        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $query);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($query),
		                    'DATA'   => null);
		    }
	    }
	    
	    public function get_unit_all(){
	        
		    $data = $this->db->get('kategori_unit')->result_array();
            if($data) {
            for ($i=0; $i < sizeof($data) ; $i++) { 
                $this->db->reset_query();
            $this->db->where('id_kategori',$data[$i]['id_kategori']);
                $isi = $this->db->get('unit')->result_array();
                $data[$i]['unit'] = $isi;
    
            }
            
		        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $data);
		                    
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($data),
		                    'DATA'   => null);
		    }
	    }
    
    function getunit_($id){
        $this->db->reset_query();
        $this->db->where('id_unit',$id);
        $data = $this->db->get('unit')->result_array();
        if(sizeof($data)>0){
            return $data[0];
        }
        return null;
    }
	    
    function _getunitkategori($id){
		$this->db->where('id_kategori', $id);
		    $query = $this->db->get('unit')->result();
		    if($query) {
		        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $query);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($query),
		                    'DATA'   => null);
		    }
	    }
	    
    function _getunitkategoriandpelapak($id_pelapak,$id_kategori){
	    $this->db->reset_query();
        $this->db->where("(id_pelapak=$id_pelapak AND id_kategori=$id_kategori)");
        $datas = $this->db->get('unit')->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_kategori',$datas[$k]['id_kategori']);
            $isi = $this->db->get('kategori_unit')->result_array();
            $datas[$k]['kategori'] = $isi;
        }
        
		       return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
		    
	    }
	    
	    function _getunit_by_id_pelapak($id){
		$this->db->where('id_pelapak', $id);
		    $query = $this->db->get('unit')->result();
		    if($query) {
		        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $query);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($query),
		                    'DATA'   => null);
		    }
	    }
        
        function _deleteunit($id){
            $this->db->where('id_unit', $id);
            $this->db->delete('unit');
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => null);
        }
        
        function _insertunit($data = array()){
            // $query = $this->db->insert('unit', $data);
            // if ($query){
            //     $this->db->reset_query();
            //     $this->db->where('id_pelapak',$data['id_pelapak']);
            //     $datas = $this->db->get('unit')->result_array();
            //     return array(
            //         'STATUS'  => 200,
            //         'MESSAGE' => 'Success',
            //         'DATA'    => $datas[0]);
            // } else {
            //     return array(
            //         'STATUS'  => 200,
            //         'MESSAGE' => mysqli_error($query),
            //         'DATA'    => null);
            // }
            
            $query = $this->db->insert('unit', $data);
            return $this->db->insert_id();
        }
        
        function _updateunit($id, $data = array()){
            $this->db->where('id_unit', $id);
            $this->db->update('unit', $data);
            $this->db->reset_query();
            $datas = $this->db->where('id_unit',$id);
            $datas = $this->db->get('unit')->result_array();

            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => $datas[0]);
                    
                    
            // $this->db->where('id_unit', $id);
            // $this->db->update('unit', $data);
            // return $this->db->insert_id();
        }
        
        
    //Wishlist
    
    public function wishlist_post($id_pemesan){
        $this->db->reset_query();
        // $id_pemesan = $this->post('id_pemesan');
        $this->db->select('id_isi_wishlist');
        $this->db->select('id_unit');
        $this->db->where('id_pemesan',$id_pemesan);
        $data = $this->db->get('isi_wishlist')->result_array();

        $response = array();
        for ($i=0; $i < sizeof($data); $i++) { 
            array_push($response, $this->dapatkan_produk($data[$i]['id_unit'],$id_pemesan));
        }
        
        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $response);
		    
		    
        //  $this->response(array('data'=>$response,'message'=>'success','status' => 200),200);
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
            
            
            $this->db->reset_query();
            $this->db->where('id_kategori',$datas[$i]['id_kategori']);
            $isi = $this->db->get('kategori_unit')->result_array();
            $datas[$i]['kategori_unit'] = $isi[0];
        }
        
        return $datas[0];
		            
    }
    
    public function add_wishlist_post($id_unit, $id_pemesan){
        $this->db->reset_query();
        $this->db->where("(id_pemesan=$id_pemesan AND id_unit=$id_unit)");
        $cek = $this->db->get('isi_wishlist')->result_array();
        $this->db->reset_query();
        if (sizeof($cek) == 0) {
            $wishlist = array('id_unit' => $id_unit,'id_pemesan'=>$id_pemesan);
            $insert = $this->db->insert('isi_wishlist',$wishlist);
            $wishlist['id_isi_wishlist'] = (string)$this->db->insert_id();
            if ($insert) {
                return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success insert wishlist',
		                    'DATA'   => $wishlist);
                // $this->response(array('data'=>$wishlist,'message'=>'success','status' => 200),200);
            }else{
                    return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($this),
		                    'DATA'   => null);

                // $this->response(array('data'=>null,'message'=>'Gagal menyimpan data','error'=>$this->db->error(),'status' => 400),200);
            }
        }else{
            $this->db->where("(id_pemesan=$id_pemesan AND id_unit=$id_unit)");
            // $this->db->where('id_pemesan',$id_pemesan);
            // $this->db->where('id_unit',$id_unit);
            $delete =$this->db->delete('isi_wishlist');
            // if ($delete) {
                        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success delete wishlist',
		                    'DATA'   => null);

                // $this->response(array('data'=>null,'message'=>'success','status' => 200),200);
            // }else{
            //     return array(
		          //          'STATUS' => '500',
		          //          'MESSAGE'=> mysqli_error($this),
		          //          'DATA'   => null);
            //     // $this->response(array('data'=>null,'message'=>'Gagal menghapus data','error'=>$this->db->error(),'status' => 400),200);
            // }
        }
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
    
    

}