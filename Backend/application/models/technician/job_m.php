<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_m extends CI_Model {
    //GET DATA
    public function get_servisan(){
        $res = $this->db->where("status",0)
                        ->order_by("tgl_masuk","DESC")
                        ->get("servisan");
        return $res->result_array();
    }
    public function get_own_job(){
        $res = $this->db->where("teknisi",$this->session->userdata("id_user"))
                        ->order_by("tgl_masuk","DESC")
                        ->get("servisan");
        return $res->result_array();
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
    public function get_output_current_user(){
        $res = $this->db->where("id_user",$this->session->userdata("id_user"))
                        ->get("data_pengeluaran");
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

    //FIND DATA
    public function find($id_servisan){
        $res = $this->db->where("status",0)
                        ->where("id_servisan",$id_servisan)
                        ->get("servisan");
        return $res->row_array();
    }
    public function find_servis($id_servis){
        $res = $this->db->where("id_servis",$id_servis)
                        ->get("servis");
        return $res->row_array();
    }
    public function find_own_job($id_servisan){
        $res = $this->db->where("status",3)
                        ->where("teknisi",$this->session->userdata("id_user"))
                        ->where("id_servisan",$id_servisan)
                        ->get("servisan");
        return $res->row_array();
    }
    public function find_job($id_servisan){
        $res = $this->db->where("status !=", 0)
                        ->where("teknisi",$this->session->userdata("id_user"))
                        ->where("id_servisan",$id_servisan)
                        ->get("servisan");
        return $res->row_array();
    }
    public function find_detail($id_servisan){
        $res = $this->db->select("s.*,p.nama as nama")
                        ->join("personal_data p", "p.id_user = s.penerima","left")
                        ->where("id_servisan",$id_servisan)
                        ->where("status !=", 0)
                        ->get("servisan s")
                        ->row_array();

        $res2 = $this->db->where("id_user",$res['teknisi'])
                        ->get("personal_data")
                        ->row_array();
        $res['nama_penerima'] = $res['nama'];
        $res['nama_teknisi'] = $res2['nama'];
        return $res;
    }
    public function find_finished_job($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)
                        ->where("status", 1)
                        ->where("teknisi",$this->session->userdata("id_user"))
                        ->get("servisan");
        return $res->row_array();
    }
    public function find_data_servis($id_data_servis){
        $res = $this->db->where("id_data_servis",$id_data_servis)
                        ->get("data_servis");
        return $res->row_array();
    }
    public function find_data_output($id_pengeluaran){
        $res = $this->db->where("id_pengeluaran",$id_pengeluaran)
                        ->get("data_pengeluaran");
        return $res->row_array();
    }

    //ACTION
    public function save_repair($data){
        $res = $this->db->insert("data_servis",$data);

        return $res;
    }
    public function save_output($data){
        $res = $this->db->insert("data_pengeluaran",$data);

        return $res;
    }
    public function take_job($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)
                        ->set("teknisi",$this->session->userdata("id_user"))
                        ->set("status",3)
                        ->update("servisan");
        return $res;
    }
    public function mark_finish($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)
                        ->set("status",1)
                        ->update("servisan");
        return $res;
    }
    public function del_data_servis($id_data_servis){
        $res = $this->db->where("id_data_servis",$id_data_servis)
                        ->delete("data_servis");
        return $res;
    }
    public function del_data_output($id_pengeluaran){
        $res = $this->db->where("id_pengeluaran",$id_pengeluaran)
                        ->delete("data_pengeluaran");
        return $res;
    }
    public function back($id_servisan){
        $res = $this->db->where("id_servisan",$id_servisan)
                        ->set("status",3)
                        ->update("servisan");
        return $res;
    }
    public function edit_servis($data){
        $res = $this->db->where("id_data_servis",$data['id_data_servis'])
                        ->update("data_servis", $data);
        return $res;
    }
    public function edit_output($data){
        $res = $this->db->where("id_pengeluaran",$data['id_pengeluaran'])
                        ->update("data_pengeluaran", $data);
        return $res;
    }
    public function cancel($id_servisan){
        $del1 = $this->db->where("id_servisan",$id_servisan)
                        ->set("status", 2)
                        ->update("servisan");
        $del2 = $this->db->where("id_servisan",$id_servisan)
                        ->delete("data_servis");
        $del3 = $this->db->where("id_servisan",$id_servisan)
                        ->delete("data_pengeluaran");
        return $del3;
    }
}





