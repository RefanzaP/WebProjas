<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_m extends CI_Model {
    //GET DATA
    public function get_output(){
        $res = $this->db->order_by("create_at","DESC")
                        ->join("personal_data p","p.id_user = d.id_user","left")
                        ->get("data_pengeluaran d");
        return $res->result_array();
    }
    public function get_other_output(){
        $res = $this->db->order_by("create_at","DESC")
                        ->join("personal_data p","p.id_user = d.id_user","left")
                        ->where("id_servisan",null)
                        ->get("data_pengeluaran d");
        return $res->result_array();
    }
    public function get_payroll(){
        $res = $this->db->get("personal_data");
        
        return $res->result_array();
    }
    public function get_riwayat_servisan(){
        $sql = 'select id_servisan, nama_cust, sum(servis) as biaya_servis, sum(pengeluaran) as total_pengeluaran, 
                 sum(servis) + sum(pengeluaran) as biaya_total, sum(servis)*3/10 as gaji_teknisi, 
                 sum(servis)*7/10 as laba_bersih from (
                    select s.id_servisan, nama_cust, sum(jumlah) as pengeluaran,"" as servis from servisan s LEFT OUTER JOIN data_pengeluaran dp
                        on s.id_servisan = dp.id_servisan where status_kembali = 1 GROUP BY s.id_servisan
                    union
                    select s.id_servisan, nama_cust, "", sum(biaya) from servisan s LEFT OUTER JOIN data_servis ds
                        on s.id_servisan = ds.id_servisan where status_kembali = 1 GROUP BY s.id_servisan
                ) x group by id_servisan';
        $res = $this->db->query($sql);

        return $res->result_array();
    }

    //FIND DATA
    public function find_output($id_pengeluaran){
    	$res = $this->db->where('id_pengeluaran', $id_pengeluaran)
                        ->get("data_pengeluaran");
        return $res->row_array();
    }
    public function find_user($id_user){
        $res = $this->db->where("id_user",$id_user)
                        ->get("personal_data");
        return $res->row_array();
    }

    //ACTION
    public function check_valid($id_pengeluaran){
    	$res = $this->db->where('id_pengeluaran', $id_pengeluaran)
    					->set('status', 1)
                        ->update("data_pengeluaran");
        return $res;
    }
    public function check_invalid($id_pengeluaran){
    	$res = $this->db->where('id_pengeluaran', $id_pengeluaran)
    					->set('status', 2)
                        ->update("data_pengeluaran");
        return $res;
    }
    public function give($data){
        $res = $this->db->where("id_user",$data['id_user'])
                        ->update("personal_data",$data);
        return $res;
    }
}