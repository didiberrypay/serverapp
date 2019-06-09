<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Review extends CI_Model {

    
    public function get_review_pelapak($id, $id_transaksi){
        $this->db->reset_query();
    	$cekSql = "Select AVG(rating) from review";
    // 	$cekReview = "Select* from review where id_pelapak = '$id' AND id_transaksi = '$id_transaksi'";
    	$rating = $this->db->query($cekSql)->result_array();
        $this->db->where("(id_pelapak='$id' AND id_transaksi='$id_transaksi')");
        $datas = $this->db->get('review')->result_array();
    
        if(sizeof($datas) > 0) {
           return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'rating' => $rating[0],
		                    'DATA'   => $datas);
		    }else {
		        return array(
		                    'STATUS' => '500',
		                    'rating' => 0,
		                    'DATA'   => null);
		    }
    
    
        // return array('STATUS' => '200',
		      //              'MESSAGE'=> 'Success',
		      //              'rating' => $rating[0],
		      //              'DATA'   => $datas);
    }
    
    
    public function get_cek_review($id){
        $this->db->reset_query();
    	$cekSql = "Select AVG(rating) from review where id_pelapak = '$id'";
        $this->db->where('id_pelapak',$id);
    	$rating = $this->db->query($cekSql)->result();
        $datas = $this->db->get('review')->result_array();
        for ($i=0; $i < sizeof($datas); $i++) { 
            $this->db->reset_query();
            $this->db->where('id_pemesan',$datas[$i]['id_pemesan']);
            $isi = $this->db->get('pemesan')->result_array();
            $datas[$i]['pemesan'] = $isi[0];
            
             
            $this->db->reset_query();
            $this->db->where('id_transaksi',$datas[$i]['id_transaksi']);
            $isi = $this->db->get('transaksi')->result_array();
            $datas[$i]['transaksi'] = $isi[0];
            
            $this->db->reset_query();
            $this->db->where('id_pelapak',$datas[$i]['id_pelapak']);
            $isi = $this->db->get('pelapak')->result_array();
            $datas[$i]['pelapak'] = $isi[0];
            
        }
        if(sizeof($datas) > 0) {
           return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'rating' => $rating[0],
		                    'DATA'   => $datas);
		    }else {
		        return array(
		                    'STATUS' => '500',
		                    'rating' => 0,
		                    'DATA'   => null);
		    }
    }
    
   
    public function get_review_all(){
        $this->db->reset_query();
		
        // $this->db->where('id_pelapak',$id);
        $datas = $this->db->get('review')->result_array();
        // for($i=0;$i<sizeof($datas);$i++){
        //     $this->db->reset_query();
        //     $this->db->where('id_pelapak',$datas[$i]['id_pelapak']);
        //     $isi = $this->db->get('pelapak')->result_array();
    		
        //     $datas[$i]['pelapak'] = $isi;

        // }
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }
    
    
        function insert_review($data = array()){
            $query = $this->db->insert('review', $data);
            if ($query){
                $this->db->reset_query();
                // $this->db->where('id_pelapak',$data['id_pelapak']);
                $datas = $this->db->get('review')->result_array();
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
            
            // $query = $this->db->insert('review', $data);
            // return $this->db->insert_id();
        }
    
    
}
?>