<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Pelapak extends CI_Model {

        
        function _getpelapak(){
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
        
        public function get_pelapak_id($id){
        $this->db->reset_query();
        $this->db->where("(id_pelapak=$id)");
        $datas = $this->db->get('pelapak')->result_array();
        
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_prov',$datas[$k]['id_prov_pelapak']);
            $isi = $this->db->get('provinsi')->result_array();
            $datas[$k]['provinsi'] = $isi[0];
            
            
            $this->db->reset_query();
            $this->db->where('id_kab',$datas[$k]['id_kab_pelapak']);
            $isi = $this->db->get('kabupaten')->result_array();
            $datas[$k]['kabupaten'] = $isi[0];
            
            
            $this->db->reset_query();
            $this->db->where('id_kec',$datas[$k]['id_kec_pelapak']);
            $isi = $this->db->get('kecamatan')->result_array();
            $datas[$k]['kecamatan'] = $isi[0];
            
            
            $this->db->reset_query();
            $this->db->where('id_kel',$datas[$k]['id_kel_pelapak']);
            $isi = $this->db->get('kelurahan')->result_array();
            $datas[$k]['kelurahan'] = $isi[0];
        }
        
        return array(
                    'STATUS' => '200',
		            'MESSAGE'=> 'Success',
		            'DATA'   => $datas[0]);
    }
        
        
        function _getpelapakid($id){
		$this->db->where('id_pelapak', $id);
		    $query = $this->db->get('pelapak')->row();
		    if($query) {
			$information = array(
						'id_pelapak' => $query->id_pelapak,
						'nama_pelapak' => $query->nama_pelapak,
						'email_pelapak'=> $query->email_pelapak,
						'nohp_pelapak' => $query->nohp_pelapak,
						'alamat_pelapak' => $query->alamat_pelapak,
						'photo_pelapak' => $query->photo_pelapak,
						'id_login' => $query->id_login,
					);

				$info = array_merge($information);
		        return array(
		                    'STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $info);
		    } else {
		        return array(
		                    'STATUS' => '500',
		                    'MESSAGE'=> mysqli_error($query),
		                    'DATA'   => null);
		    }
	    }
        
        function _deletepelapak($id){
            $this->db->where('id_pelapak', $id);
            $this->db->delete('pelapak');
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => null);
        }
        
        function _insertpelapak($data = array()){
            $query = $this->db->insert('pelapak', $data);
            if ($query){
                $this->db->reset_query();
                $this->db->where('id_login',$data['id_login']);
                $datas = $this->db->get('pelapak')->result_array();
                return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => $datas[0]);
            } else {
                return array(
                    'STATUS'  => 500,
                    'MESSAGE' => mysqli_error($query),
                    'DATA'    => null);
            }
        }
        
        function _updatepelapak($id, $data = array()){
            $this->db->where('id_pelapak', $id);
            $this->db->update('pelapak', $data);
            $this->db->reset_query();
            $datas = $this->db->where('id_pelapak',$id);
            $datas = $this->db->get('pelapak')->result_array();

            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => $datas[0]);
        }
}