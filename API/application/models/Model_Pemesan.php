<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Pemesan extends CI_Model {

        
        function _getpemesan(){
            
        $this->db->reset_query();
        // $this->db->where("(id_pelapak=$id)");
        $datas = $this->db->get('pemesan')->result_array();
        
// 		$query = $this->db->query('SELECT * FROM pemesan');
		
		
        for ($k=0; $k < sizeof($datas); $k++) { 
            $this->db->reset_query();
            $this->db->where('id_prov',$datas[$k]['id_prov']);
            $isi = $this->db->get('provinsi')->result_array();
            $datas[$k]['provinsi'] = $isi[0];
            
            
            $this->db->reset_query();
            $this->db->where('id_kab',$datas[$k]['id_kab']);
            $isi = $this->db->get('kabupaten')->result_array();
            $datas[$k]['kabupaten'] = $isi[0];
            
            
            $this->db->reset_query();
            $this->db->where('id_kec',$datas[$k]['id_kec']);
            $isi = $this->db->get('kecamatan')->result_array();
            $datas[$k]['kecamatan'] = $isi[0];
            
            
            $this->db->reset_query();
            $this->db->where('id_kel',$datas[$k]['id_kel']);
            $isi = $this->db->get('kelurahan')->result_array();
            $datas[$k]['kelurahan'] = $isi[0];
        }
        
        
        return array(
                    'STATUS' => '200',
		            'MESSAGE'=> 'Success',
		            'DATA'   => $datas);
        
// 			if($query->num_rows() > 0) {
// // 			$data = $query->result();
// 		    return array(
// 		                    'STATUS' => '200',
// 		                    'MESSAGE'=> 'Success',
// 		                    'DATA'   => $datas);
// 		    } else {
// 		        return array(
// 		                    'STATUS' => '500',
// 		                    'MESSAGE'=> mysqli_error($query),
// 		                    'DATA'   => null);
// 		    }
        }
        
        function _getpemesanid($id){
		$this->db->where('id_pemesan', $id);
		    $query = $this->db->get('pemesan')->row();
		    if($query) {
			$information = array(
					
						'id_pemesan' => $query->id_pemesan,
						'nama_pemesan' => $query->nama_pemesan,
						'email_pemesan'=> $query->email_pemesan,
						'nohp_pemesan' => $query->nohp_pemesan,
						'alamat_pemesan' => $query->alamat_pemesan,
						'photo_pemesan' => $query->photo_pemesan,
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
        
        function _deletepemesan($id){
            $this->db->where('id_pemesan', $id);
            $this->db->delete('pemesan');
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => null);
        }
        
        function _insertpemesan($data = array()){
            $query = $this->db->insert('pemesan', $data);
            if ($query){
                $this->db->reset_query();
                $this->db->where('id_login',$data['id_login']);
                $datas = $this->db->get('pemesan')->result_array();
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
        }
        
        function _updatepemesan($id, $data = array()){
            $this->db->where('id_pemesan', $id);
            $this->db->update('pemesan', $data);
            $this->db->reset_query();
            $datas = $this->db->where('id_pemesan',$id);
            $datas = $this->db->get('pemesan')->result_array();

            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => $datas[0]);
        }
}