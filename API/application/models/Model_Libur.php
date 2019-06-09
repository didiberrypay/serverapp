<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Libur extends CI_Model {

        
    function _getlibur($id){
        $this->db->reset_query();
        // $this->db->where("(id_unit=$id_unit)");
        // $datas = $this->db->get('tgl_libur')->result_array();
        $this->db->where('id_pelapak', $id);
		    $query = $this->db->get('tgl_libur')->result_array();
		    
        return array('STATUS' => '200',
		                    'MESSAGE'=> 'Success',
		                    'DATA'   => $query);
        }
        
        function _deletelibur($id){
            $this->db->where('id_tgl_libur', $id);
            $this->db->delete('tgl_libur');
            return array(
                    'STATUS'  => 200,
                    'MESSAGE' => 'Success',
                    'DATA'    => null);
        }
        
        function _insertlibur($data = array()){
            
            $query = $this->db->insert('tgl_libur', $data);
            
            if ($query){
                $this->db->reset_query();
                // $this->db->where('id_pelapak',$data['id_pelapak']);
                $datas = $this->db->get('tgl_libur')->result_array();
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
        
        function _updatelibur($id, $data = array()){
                    
            $this->db->where('id_tgl_libur', $id);
            $this->db->update('tgl_libur', $data);
            
            if ($this){
                $this->db->reset_query();
                // $this->db->where('id_pelapak',$data['id_pelapak']);
                $datas = $this->db->get('tgl_libur')->result_array();
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