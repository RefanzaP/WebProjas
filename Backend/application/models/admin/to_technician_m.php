<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class To_technician_m extends CI_Model {
    public function get(){
        $res = $this->db->where("status",0)
                        ->order_by("tgl_masuk","DESC")
                        ->get("servisan");
        return $res->result_array();
    }
    public function find($id_servisan){
        $res = $this->db->where("status",0)
                        ->where("id_servisan",$id_servisan)
                        ->get("servisan");
        return $res->row_array();
    }
    public function save($data){
        $res = $this->db->where("id_servisan",$data['id_servisan'])
                        ->set("status",3)
                        ->update("servisan",$data);
        return $res;
    }
}