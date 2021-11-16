<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_m extends CI_Model {
    public function get_all_user(){
        $res = $this->db->join("personal_data p","p.id_user = u.id_user","left")
                        ->get("user u");
        return $res->result_array();
    }
    public function get_admin(){
        $res = $this->db->join("personal_data p","p.id_user = u.id_user","left")
                        ->where("role",1)
                        ->get("user u");
        return $res->result_array();
    }
    public function get_management(){
        $res = $this->db->join("personal_data p","p.id_user = u.id_user","left")
                        ->where("role",3)
                        ->get("user u");
        return $res->result_array();
    }
    public function find_cur_user($id_user){
        $res = $this->db->join("personal_data p","p.id_user = u.id_user","left")
                        ->where("u.id_user",$id_user)
                        ->get("user u");
        return $res->row_array();
    }
    public function find_teknisi($id_servisan){
        $res = $this->db->join("personal_data p","p.id_user = s.teknisi","left")
                        ->join("user u", "u.id_user = s.teknisi", "left")
                        ->where("s.id_servisan",$id_servisan)
                        ->get("servisan s");
        return $res->row_array();
    }
}