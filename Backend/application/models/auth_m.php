<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Auth_m extends Base_m
{
    // USER
    protected $table = 'user';

    function cek_login($where){
        $res = $this->db->join("personal_data p","p.id_user=u.id_user","left")
                        ->get_where("user u", $where)->row_array();
        return $res;
    }

    function log_login($id_user){
        $log = $this->db->where("id_user",$id_user)
                        ->set("last_login", date("Y-m-d H:i:s"))
                        ->update("user");
        return $log;
    }

    function logout(){
        $log = $this->db->where('id_user', $this->session->userdata("id_user"))
                        ->set('last_logout', date('Y-m-d H:i:s'))
                        ->update('user');
        return $log;
    }
}