<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Login extends CI_Model {

        
        function _ValidationLogin($e,$p){
		$query = $this->db->query('SELECT * FROM login WHERE email = "'.$e.'"
							       AND PASSWORD="'.$p.'"');
		if($query->num_rows() == 1) {
		    $data = $query->row();
				$information_login = array(
						'id_login'  => $data->id_login,
						'email'     => $data->email,
						'password'  => $data->password,
						'level'     => $data->level
					);
				$info = array_merge($information_login);
				$result = array(
			            'STATUS' => 200,
			            'MESSAGE'=> 'Login Success',
			            'DATA'   => $info);
		} else {
		    	$result = array(
			            'STATUS' => 500,
			            'MESSAGE'=> 'Login Failed',
			            'DATA'   => null);
		}
		        return $result; 
        }
        
        function _sign($e,$p){
// 		$query = $this->db->query('SELECT * FROM login WHERE email = "'.$e.'"
// 							       AND password="'.$p.'" AND level ="'.$l.'"');
		
		$query = $this->db->query('SELECT * FROM login WHERE email = "'.$e.'"
							       AND password="'.$p.'"')->result_array();
		if(sizeof($query) == 1) {
		   
// 			$data = $query->row();
// 			$information_login = array(
// 						'id_login' => $data->id_login,
// 						'email' => $data->email,
// 						'password'=> $data->password,
// 						'level' => $data->level);

// 			$info = array_merge($information_login);
		
            if($query[0]['level'] == 'pelapak'){
                $this->db->reset_query();
                $this->db->where('id_login',$query[0]['id_login']);
                $pelapak = $this->db->get('pelapak')->result_array();
                if(sizeof($pelapak) == 1){
                    $query[0]['pelapak'] = $pelapak[0];
                }else{
                    $query[0]['pelapak'] = null;
                }
            } else if($query[0]['level'] == 'pemesan'){
                $this->db->reset_query();
                $this->db->where('id_login',$query[0]['id_login']);
                $pemesan = $this->db->get('pemesan')->result_array();
                if(sizeof($pemesan) == 1){
                    $query[0]['pemesan'] = $pemesan[0];
                }else{
                    $query[0]['pemesan'] = null;
                }
            } else if($query[0]['level'] == 'admin'){
                $this->db->reset_query();
                $this->db->where('id_login',$query[0]['id_login']);
                $admin = $this->db->get('admin')->result_array();
                if(sizeof($admin) == 1){
                    $query[0]['admin'] = $admin[0];
                }else{
                    $query[0]['admin'] = null;
                }
                
            }
            
        	$result = array(
			            'STATUS' => 200,
			            'MESSAGE'=> 'Success',
			            'DATA'   => $query[0]);    
            
		} else {
		    	$result = array(
			            'STATUS' => 500,
			            'MESSAGE'=> 'Failed',
			            'DATA'   => null);
		}
		        return $result; 
        }
}