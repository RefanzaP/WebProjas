<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price_m extends CI_Model {
    public function get(){
        $res = $this->db->get("servis");

        return $res->result_array();
    }
    public function add($data){
        $res = $this->db->insert("servis",$data);

        return $res;
    }
    public function find($id_servis){
        $res = $this->db->where("id_servis",$id_servis)->get("servis");

        return $res->row_array();
    }
    public function del($id_servis){
        $res = $this->db->where("id_servis", $id_servis)->delete("servis");

        return $res;
    }
    public function edit($data){
        $res = $this->db->where("id_servis", $data['id_servis'])
                        ->update("servis",$data);
        return $res;
    }
}