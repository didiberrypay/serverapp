<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Pesanan extends CI_Model {

    public function get_pesanan_pemesan($id){
        $this->db->reset_query();
        // $this->db->where("(is_cancel!=0)");
        $this->db->where("(id_pemesan=$id AND is_cancel=1)");
        $datas = $this->db->get('transaksi')->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }
        }
            
            $a = 0;
            for($i=0 ;$i<sizeof($datas);$i++){
                if($datas[$i]['is_rating'] == 0){
                    $data[$a] = $datas[$i];
                    $a++;
                }
            }

        return array(
                    'STATUS' => '200',
		            'MESSAGE'=> 'Success',
		            'DATA'   => $data);
    }
    
    public function get_pesanan_pemesan_proses($id){
        $this->db->reset_query();
        $sql = "SELECT * from transaksi where (status != '5') AND (id_pemesan = '$id' AND is_cancel != '1') ";
        // $this->db->where("(id_pemesan=$id AND status=5 AND is_cancel=0)");
        
        $datas = $this->db->query($sql)->result_array();
        // $datas = $sql->db->get('transaksi')->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;
            
            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }
            
        }


            $a = 0;
            for($i=0 ;$i<sizeof($datas);$i++){
                
                if($datas[$i]['is_rating'] == 1){
                    $data[$a] = $datas[$i];
                    $a++;
                }
            }
            
            // $datas[$i]['rating'] = getRating($);

        // }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }


    public function get_pesanan_pemesan_riwayat($id){
        $this->db->reset_query();
        $sql = "SELECT * from transaksi where (status = '5') AND (id_pemesan = '$id' AND is_cancel = '0') ";
        // $this->db->where("(id_pemesan=$id AND status=5 AND is_cancel=0)");
        
        $datas = $this->db->query($sql)->result_array();
        // $datas = $sql->db->get('transaksi')->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;
            
            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }
            
        }


            $a = 0;
            for($i=0 ;$i<sizeof($datas);$i++){
                if($datas[$i]['is_rating'] == 1){
                    $data[$a] = $datas[$i];
                    $a++;
                }
            }
            
            // $datas[$i]['rating'] = getRating($);

        // }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $data);
    }

    
    public function get_pesanan_pelapak_proses($id){
        $this->db->reset_query();
        
        $sql = "SELECT * from transaksi where (status != '5') AND (id_pelapak = '$id' AND is_cancel = '0') ";
        // $this->db->where("(id_pelapak=$id AND status=5)");
        // $datas = $sql->db->get('transaksi')->result_array();
        $datas = $this->db->query($sql)->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }
            
            
            
            // if ($id_pelapak==$id) {
            //     $datas[$i]['is_libur'] = '0';
            //     $this->db->where('id_pelapak',$id_pelapak);
            //     // $this->db->where('id_unit',$datas[$i]['id_unit']);
            //     $cek = $this->db->get('tgl_libur')->result_array(); 
            //     if (sizeof($cek) > 0) {
            //         $datas[$i]['is_libur'] = '1';
            //     }          
            // }

        }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }
    
    public function get_pesanan_pelapak_riwayat($id){
        $this->db->reset_query();
		
        $sql = "SELECT * from transaksi where (status = '5') AND (id_pelapak = '$id' AND is_cancel = '0') ";
        // $this->db->where("(id_pelapak=$id AND status=5)");
        $datas = $this->db->query($sql)->result_array();
        // $datas = $this->db->get('transaksi')->result_array();
        
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }

        }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }

    
    public function get_pesanan_pemesan_batal($id){
        $this->db->reset_query();
        // $this->db->where("(is_cancel!=0)");
        $this->db->where("(id_pemesan=$id AND is_cancel!=1)");
        $datas = $this->db->get('transaksi')->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }
        }
            $a = 0;
            for($i=0 ;$i<sizeof($datas);$i++){
                if($datas[$i]['is_rating'] == 0){
                    $data[$a] = $datas[$i];
                    $a++;
                }
                
                // if($datas[$i]['is_cancel'] == 0){
                //     $data[$a] = $datas[$i];
                //     $a++;
                // }
            }
            
            // $datas[$i]['rating'] = getRating($);

        return array(
                    'STATUS' => '200',
		            'MESSAGE'=> 'Success',
		            'DATA'   => $data);
    }
    
        public function get_pesanan_pelapak_batal($id){
        $this->db->reset_query();
        // $this->db->where("(is_cancel!=0)");
        $this->db->where("(id_pelapak=$id AND is_cancel!=1)");
        $datas = $this->db->get('transaksi')->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }
        }
            $a = 0;
            for($i=0 ;$i<sizeof($datas);$i++){
                if($datas[$i]['is_rating'] == 0){
                    $data[$a] = $datas[$i];
                    $a++;
                }
                
                // if($datas[$i]['is_cancel'] == 0){
                //     $data[$a] = $datas[$i];
                //     $a++;
                // }
            }
            
            // $datas[$i]['rating'] = getRating($);

        return array(
                    'STATUS' => '200',
		            'MESSAGE'=> 'Success',
		            'DATA'   => $data);
    }
    
    
    
    
    
    public function get_pesanan_all_proses(){
        $this->db->reset_query();
        
        $sql = "SELECT * from transaksi where (status != '5'AND is_cancel = '0') ";
        $datas = $this->db->query($sql)->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }

        }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }
    
    public function get_pesanan_all_riwayat(){
        $this->db->reset_query();
		
        $sql = "SELECT * from transaksi where (status = '5' AND is_cancel = '0') ";
        $datas = $this->db->query($sql)->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }

        }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }

    
    public function get_pesanan_all_batal(){
        $this->db->reset_query();
        $this->db->where("(is_cancel!=1)");
        $datas = $this->db->get('transaksi')->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }
        }
            $a = 0;
            for($i=0 ;$i<sizeof($datas);$i++){
                if($datas[$i]['is_rating'] == 0){
                    $data[$a] = $datas[$i];
                    $a++;
                }
            }
        return array(
                    'STATUS' => '200',
		            'MESSAGE'=> 'Success',
		            'DATA'   => $data);
    }
    
    
    
    
    
    
    
    
    
    public function get_pesanan_all(){
        $this->db->reset_query();
		
        // $this->db->where('id_pelapak',$id);
        $datas = $this->db->get('transaksi')->result_array();
        
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }

        }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
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
    
    public function get_pesanan_status_riwayat($id){
        $this->db->reset_query();
        // $this->db->where('id_pemesan',$id);
        // $this->db->where('status','sudah sampai');
        // $this->db->where('status','tidak sampai');
        $sql = "SELECT * from transaksi where (status = '4') AND (id_pelapak = '$id' AND is_cancel = '0') ";
        $datas = $this->db->query($sql)->result_array();

        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }

        }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }
    
    public function get_pesanan_status_riwayat_all(){
        $this->db->reset_query();
        $sql = "SELECT * from transaksi where is_pay ='1' ";
        $datas = $this->db->query($sql)->result_array();
        
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }

        }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }
    
    // public function get_pesanan_status_proses($id){
    //     $this->db->reset_query();
    //     // $this->db->where('id_pemesan',$id);
    //     // $this->db->where('status','menunggu');
    //     $sql = "SELECT * from transaksi where status != '5' AND id_pemesan = $id";
    //     // $this->db->where status in('menunggu','dalam pengiriman');
    //     $datas = $this->db->query($sql)->result_array();
    //     for($i=0;$i<sizeof($datas);$i++){
            
    //         $this->db->reset_query();
    //         $this->db->where('id_unit',$datas[$i]['id_unit']);
    //         $isi = $this->db->get('unit')->result_array();
    //         for ($j=0; $j < sizeof($isi); $j++) { 
                
    //             $id_pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
    //             $isi[$j]['pelapak'] = $id_pelapak;
                
    //             // $produk = $this->getunit($isi[$j]['id_unit']);
    //             // $isi[$j]['unit'] = $produk;
    //         }
            
    //         $datas[$i]['isi_pesanan'] = $isi;

    //     }
    //     return array('STATUS' => '200',
		  //                  'MESSAGE'=> 'Success',
		  //                  'DATA'   => $datas);
    // }
    
    public function get_pesanan_status_proses_all(){
        $this->db->reset_query();
        $sql = "SELECT * from transaksi where  status != '5'";
        $datas = $this->db->query($sql)->result_array();

        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$k]['pemesan'] = $isi;
        }
        
        for($i=0;$i<sizeof($datas);$i++){
            $this->db->reset_query();
            $this->db->where('id_unit',$datas[$i]['id_unit']);
            $isi = $this->db->get('unit')->result_array();
            for ($j=0; $j < sizeof($isi); $j++) { 
                $pelapak = $this->getpelapak($isi[$j]['id_pelapak']);
                $isi[$j]['pelapak'] = $pelapak;
            }
            $datas[$i]['isi_pesanan'] = $isi;


            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $rating = $this->db->get('review')->result_array();
            if(sizeof($rating) == 0){
                $datas[$i]['is_rating'] = 0;
            }else{
                $datas[$i]['is_rating'] = 1;
            }

        }

        // for ($k=0; $k < sizeof($datas); $k++) { 
        //     $this->db->reset_query();
        //     $this->db->where('id_pemesan',$datas[$k]['id_pemesan']);
        //     $isi = $this->db->get('pemesan')->result_array();
        //     $datas[$k]['pemesan'] = $isi;
        // }
        // for($i=0;$i<sizeof($datas);$i++){
        //     $this->db->reset_query();
        //     $this->db->where('id_wishlist',$datas[$i]['id_wishlist']);
        //     $isi = $this->db->get('isi_wishlist')->result_array();
        //     for ($j=0; $j < sizeof($isi); $j++) { 
        //         $produk = $this->getunit($isi[$j]['id_unit']);
        //         $isi[$j]['unit'] = $produk;
        //     }
        //     $datas[$i]['isi_pesanan'] = $isi;

        // }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }
    
    function _updatepesanan($id, $data = array()){
            $this->db->where('id_transaksi', $id);
            // $data = array('status' => $_POST['status'] );
            $update = $this->db->update('transaksi', $data);
            if($update){
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Sukses',
                    'DATA'    => 'Berhasil');
        }else{
            
            return array(
                    'STATUS'  => 500,
                    'MESSAGE' => $this->db->error(),
                    'DATA'    => 'Gagal');
        }
    }
    
    function _updatetransaksi($id, $data = array()){
            $this->db->where('id_transaksi', $id);
            $this->db->update('transaksi', $data);
            $this->db->reset_query();
            $datas = $this->db->where('id_transaksi',$id);
            $datas = $this->db->get('transaksi')->result_array();

            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => $datas[0]);
    }
    
    function _updatepesanan_transaksi($id, $data = array()){
        $this->db->reset_query();
        $this->db->where('id_transaksi', $id);
        // $updateData = array('status_transaksi'=>'1');
        $update = $this->db->update('transaksi',$updateData);
            if($update){
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => 'Berhasil');
        }else{
            
            return array(
                    'STATUS'  => 500,
                    'MESSAGE' => $this->db->error(),
                    'DATA'    => 'Gagal');
        }
    }
    
}
?>