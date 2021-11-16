<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_m extends CI_Model {
    public function count_servisan(){
        $not_yet = $this->db->where('status', 0)->get('servisan')->num_rows();
        $finish = $this->db->where('status', 1)->get('servisan')->num_rows();
        $proccess = $this->db->where('status', 3)->get('servisan')->num_rows();

        $res = array(
            "not_yet" => $not_yet,
            "finish" => $finish,
            "proccess" => $proccess,
        );

        return $res;
    }
    public function get_monthly_laba(){
        $res = $this->db->select("month(tgl_kembali) as bulan, sum(biaya) as total")
                        ->join("data_servis d","s.id_servisan=d.id_servisan","left")
                        ->where("status_kembali",1)
                        ->group_by("bulan")
                        ->get("servisan s");
        return $res->result_array();
    }
    public function get_total($id_servisan){
        $total = 0;
        $servis = $this->db->select("sum(biaya) as total")
                            ->where("id_servisan", $id_servisan)
                            ->get("data_servis")
                            ->row_array();
        $output = $this->db->select("sum(jumlah) as total")
                            ->where("id_servisan", $id_servisan)
                            ->get("data_pengeluaran")
                            ->row_array();

        if($servis)
            $total += $servis['total'];
        if($output)
            $total += $output['total'];

        return $total;
    }
    public function get_servisan(){
        $res = $this->db->order_by("tgl_masuk","DESC")->get("servisan");

        return $res->result_array();
    }
    public function add_servisan($data){
        $data['tgl_masuk']=date("Y:m:d H:i:s");
        $data['penerima']=$this->session->userdata("id_user");
        
        $res = $this->db->insert("servisan",$data);

        return $res;
    }
    public function find_servisan($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)->get("servisan");

        return $res->row_array();
    }
    public function find_del($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)
                        ->where("status",0)
                        ->get("servisan");

        return $res->row_array();
    }
    public function find_back($id_servisan){
        $res = $this->db->query("select *from servisan where id_servisan = $id_servisan AND (status = 1 OR status = 2)");

        return $res->row_array();
    }
    public function find_claim($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)
                        ->where("status_kembali",1)
                        ->get("servisan");

        return $res->row_array();
    }
    public function claim($id_servisan, $keluhan){
        $res = $this->db->where("id_servisan", $id_servisan)
                        ->set("keluhan", $keluhan)
                        ->set("status_kembali", 0)
                        ->set("status", 3)
                        ->update("servisan");
        $gaji = 0;
        $servis = $this->db->select("id_teknisi, sum(biaya) as total")
                            ->where("id_servisan", $id_servisan)
                            ->get("data_servis")
                            ->row_array();
        if($servis)
            $gaji += ($servis['total'] * 3 / 10);

        $hitung = $this->db->query("update personal_data set gaji = gaji - ".$gaji." where id_user = '".$servis['id_teknisi']."'");
        return $res;
    }
    public function back_servisan($id_servisan){
        $res = $this->db->where("id_servisan", $id_servisan)
                        ->set("status_kembali", 1)
                        ->set("tgl_kembali",date("Y:m:d H:i:s"))
                        ->update("servisan");
        $gaji = 0;
        $servis = $this->db->select("id_teknisi, sum(biaya) as total")
                            ->where("id_servisan", $id_servisan)
                            ->get("data_servis")
                            ->row_array();
        if($servis)
            $gaji += ($servis['total'] * 3 / 10);

        $hitung = $this->db->query("update personal_data set gaji = gaji + ".$gaji." where id_user = '".$servis['id_teknisi']."'");

        return $hitung;
    }
    public function del_servisan($id_servisan){
        $res = $this->db->where("id_servisan", $id_servisan)->delete("servisan");

        return $res;
    }
    public function edit_servisan($data){
        $res = $this->db->where("id_servisan", $data['id_servisan'])
                        ->update("servisan",$data);

        return $res;
    }
    public function find_detail($id_servisan){
        $res = $this->db->select("s.*,p.nama as nama")
                        ->join("personal_data p", "p.id_user = s.penerima","left")
                        ->where("id_servisan",$id_servisan)
                        ->get("servisan s")
                        ->row_array();

        $res2 = $this->db->where("id_user",$res['teknisi'])
                        ->get("personal_data")
                        ->row_array();

        $res['nama_penerima'] = $res['nama'];
        $res['nama_teknisi'] = isset($res2['nama'])?$res2['nama']:"Belum ada";
        return $res;
    }
    public function get_data_servis($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)
                        ->join("servis s","d.id_servis = s.id_servis","left")
                        ->get("data_servis d");
        return $res->result_array();
    }
    public function get_data_output($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)
                        ->get("data_pengeluaran");
        return $res->result_array();
    }
}