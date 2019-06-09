<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Kategori extends CI_Model {

        
    function _getkategori(){
		$query = $this->db->query('SELECT* FROM kategori_unit');
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
        
    public function get_kategori_pelapak($id){
        $this->db->reset_query();
    // 	$cekSql = "Select* from kategori_unit where id_pelapak = '$id_pelapak'";
    // 	$rating = $this->db->query($cekSql)->result_array();
        $this->db->where('id_pelapak',$id);
        $datas = $this->db->get('kategori_unit')->result_array();
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $datas);
    }

        
//         function _getkategori_pelapak(){
// 		$query ="SELECT* FROM kategori_unit where id_pelapak = '$id_pelapak'";
// 			if($query->num_rows() > 0) {
// 			$data = $query->result();
// 		    return array(
// 		                    'STATUS' => '200',
// 		                    'MESSAGE'=> 'Success',
// 		                    'DATA'   => $data);
// 		    } else {
// 		        return array(
// 		                    'STATUS' => '500',
// 		                    'MESSAGE'=> mysqli_error($query),
// 		                    'DATA'   => null);
// 		    }
//         }
        
        function _insertkategori($data = array()){
            
            $query = $this->db->insert('kategori_unit', $data);
            
            if ($query){
                $this->db->reset_query();
                // $this->db->where('id_pelapak',$data['id_pelapak']);
                $datas = $this->db->get('kategori_unit')->result_array();
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
        
        function _updatekategori($id, $data = array()){
            // $this->db->where('id_unit', $id);
            // $this->db->update('unit', $data);
            // $this->db->reset_query();
            // $datas = $this->db->where('id_unit',$id);
            // $datas = $this->db->get('unit')->result_array();

            // return array(
            //         'STATUS'  => 200,
            //         'MESSAGE' => 'Success',
            //         'DATA'    => $datas[0]);
                    
                    
            $this->db->where('id_kategori', $id);
            $this->db->update('kategori_unit', $data);
            
            if ($this){
                $this->db->reset_query();
                // $this->db->where('id_pelapak',$data['id_pelapak']);
                $datas = $this->db->get('kategori_unit')->result_array();
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
}