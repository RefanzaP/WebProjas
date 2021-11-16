<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_m extends CI_Model {
    public function get(){
        $res = $this->db->join("personal_data p","p.id_user=u.id_user","left")
                        ->where("p.id_user",$this->session->userdata("id_user"))
                        ->get("user u");
        return $res->row_array();
    }
    public function save_data($data){
        $res = $this->db->where("id_user", $this->session->userdata("id_user"))
                        ->update("personal_data",$data);
        return $res;
    }
    public function save_email($data){
        $res = $this->db->where("id_user", $this->session->userdata("id_user"))
                        ->update("user",$data);
        return $res;
    }
    public function check_password($password){
        $res = $this->db->where("id_user", $this->session->userdata("id_user"))
                        ->where("repassword", $password)
                        ->get("user");
        return $res->row_array();
    }
    public function save_password($password){
        $data = array(
            "password" => md5($password),
            "repassword" => $password
        );
        $res = $this->db->where("id_user", $this->session->userdata("id_user"))
                        ->update("user",$data);
        return $res;
    }
    public function save_photo($foto){
        $res = $this->db->where("id_user", $this->session->userdata("id_user"))
                        ->set("foto",$foto)
                        ->update("personal_data");
        return $res;
    }
}