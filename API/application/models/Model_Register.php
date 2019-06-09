<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Register extends CI_Model {

        
        function _createUser($e,$p,$l){
		$query = $this->db->query('INSERT INTO login (email, password, level)
                                    VALUES ("'.$e.'", "'.$p.'", "'.$l.'")');
		if($query) {
				$result = array(
			            'STATUS' => 200,
			            'MESSAGE'=> 'Success');
		} else {
		    	$result = array(
			            'STATUS' => 500,
			            'MESSAGE'=> 'Failed');
		}
		        return $result; 
        }
        
        function _signup($data = array(), $email){
            $query = $this->db->insert('login', $data);
            
            if ($query){
                $result = $this->db->query('SELECT * FROM login WHERE email = "'.$email.'"');
                $results = $result->result();
                return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => $results);
            } else {
                return array(
                    'STATUS'  => 500,
                    'MESSAGE' => mysqli_error($query),
                    'DATA'    => null);
            }
        }
        
        function _checkemail($data = array(), $email) {
        	$result = $this->db->query('SELECT * FROM login WHERE email = "'.$email.'"');

            if($result->num_rows() > 0){
                return array(
                    'STATUS'  => 500,
                    'MESSAGE' => 'Email is Already Exist',
                    'DATA'    => null);
            }else{
                $signup = $this->_signup($data, $email);
                return $signup;
            }
        }
}