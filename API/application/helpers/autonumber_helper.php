<?php

    function _GenerateAutoPelapak($table){
        $i =& get_instance();
        $q = $i->db->query("SELECT MAx(id_pelapak) AS idmax FROM ".$table);
        $kd = "1";
        if (!empty($q)){
            foreach ($q->result() as $k) {
            $tmp = ((int)$k->idmax)+1;
            $kd = sprintf("%01s", $tmp);
            }
        }else{
            $kd = "1";
        }
        return $kd;
    }
    
    function _GenerateAutoPemesan($table){
        $i =& get_instance();
        $q = $i->db->query("SELECT MAx(id_pemesan) AS idmax FROM ".$table);
        $kd = "1";
        if (!empty($q)){
            foreach ($q->result() as $k) {
            $tmp = ((int)$k->idmax)+1;
            $kd = sprintf("%01s", $tmp);
            }
        }else{
            $kd = "1";
        }
        return $kd;
    }
    
    // function _GenerateAutoKurir($table){
    //     $i =& get_instance();
    //     $q = $i->db->query("SELECT MAx(id_kurir) AS idmax FROM ".$table);
    //     $kd = "1";
    //     if (!empty($q)){
    //         foreach ($q->result() as $k) {
    //         $tmp = ((int)$k->idmax)+1;
    //         $kd = sprintf("%01s", $tmp);
    //         }
    //     }else{
    //         $kd = "1";
    //     }
    //     return $kd;
    // }
    
    // function _GenerateAutoBarang($table){
    //     $i =& get_instance();
    //     $q = $i->db->query("SELECT MAx(id_barang) AS idmax FROM ".$table);
    //     $kd = "1";
    //     if (!empty($q)){
    //         foreach ($q->result() as $k) {
    //         $tmp = ((int)$k->idmax)+1;
    //         $kd = sprintf("%01s", $tmp);
    //         }
    //     }else{
    //         $kd = "1";
    //     }
    //     return $kd;
    // }

?>