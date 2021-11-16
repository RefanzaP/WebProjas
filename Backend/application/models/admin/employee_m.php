<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_m extends CI_Model {
    public function get(){
        $res = $this->db->join("personal_data p","u.id_user=p.id_user")
                        ->where("role >",1)
                        ->get("user u");

        return $res->result_array();
    }
    public function add($data){
        $res = $this->db->insert("user",array(
            "email" => $data['email'],
            "password" => md5($data['password']),
            "repassword" => $data['password'],
            "role" => $data['role'],
            "create_at" => date("Y-m-d H:i:s")
        ));

        $res = $this->db->insert("personal_data",array(
            "id_user" => $this->db->insert_id(),
            "nama" => $data['nama'],
            "jk" => $data['jk'],
            "no_telp" => $data['no_telp'],
            "alamat" => $data['alamat'],
        ));

        return $res;
    }
    public function find($id_user){
        $res = $this->db->join("personal_data p","u.id_user=p.id_user")
                        ->where("role >",1)
                        ->where("u.id_user", $id_user)
                        ->get("user u");

        return $res->row_array();
    }
    public function del($id_user){
        $res = $this->db->where("id_user", $id_user)->delete("user");
        $res = $this->db->where("id_user", $id_user)->delete("personal_data");

        return $res;
    }
    //Account
    public function save_data($data){
        $res = $this->db->where("id_user", $data['id_user'])
                        ->update("personal_data",$data);
        return $res;
    }
    public function save_email($email,$id_user){
        $res = $this->db->where("id_user", $id_user)
                        ->set("email", $email)
                        ->update("user");
        return $res;
    }
    public function save_password($password,$id_user){
        $data = array(
            "password" => md5($password),
            "repassword" => $password
        );
        $res = $this->db->where("id_user", $id_user)
                        ->update("user",$data);
        return $res;
    }
    public function save_photo($foto,$id_user){
        $res = $this->db->where("id_user", $id_user)
                        ->set("foto",$foto)
                        ->update("personal_data");
        return $res;
    }
    public function change_role($data){
        $res = $this->db->where("id_user", $data['id_user'])
                        ->update("user",$data);
        return $res;
    }
}