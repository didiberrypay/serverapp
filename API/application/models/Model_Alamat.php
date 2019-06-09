<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Alamat extends CI_Model {

        
        function _get_provinsi(){
		$query = $this->db->query('SELECT * FROM provinsi');
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
        
        function get_kabupaten($id){
		$this->db->where('id_prov', $id);
		    $query = $this->db->get('kabupaten')->result();
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
	    
	    function get_kecamatan($id){
		$this->db->where('id_kab', $id);
		    $query = $this->db->get('kecamatan')->result();
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
	    
	    function get_kelurahan($id){
		$this->db->where('id_kec', $id);
		    $query = $this->db->get('kelurahan')->result();
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
	    
}