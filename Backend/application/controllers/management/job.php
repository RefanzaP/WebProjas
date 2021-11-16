<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
    public function __construct(){
       parent::__construct();
        $this->load->language('general');
        $this->load->language('management');
        $this->load->model('management/job_m');

        //Notification
        $this->load->model('notification/notification_m',"nm");
        $this->load->language('notification');
        $this->load->library("email");

        if(!$this->session->userdata('email')){
            $this->session->set_flashdata('errorMessage', lang('not_login'));
            redirect('welcome');
        }
    }

    /* --------------------------- LOCAL FUNCTION ------------------------------*/
    public function is_success($res,$error,$redirect){
        if(!$res){
            $this->session->set_flashdata('errorMessage', $error);
            redirect($redirect);
        }
    }
    private function give_validation(){
        $this->form_validation->set_rules('id_user', lang("id_user"), 'required');
        $this->form_validation->set_rules('jumlah', lang("jumlah"), 'required');

        return $this->form_validation->run()!=FALSE;
    }

    /* --------------------------- LOAD PAGES ------------------------------*/
    public function index(){
        $this->load->view("content/management/index", array(
            'output' => $this->job_m->get_output(),
        ));
    }
    public function payroll(){
        $this->load->view("content/management/payroll", array(
            'user' => $this->job_m->get_payroll(),
        ));
    }
    public function fin_history(){
        $this->load->view("content/management/fin_history", array(
            'output' => $this->job_m->get_other_output(),
            'servisan' => $this->job_m->get_riwayat_servisan(),
        ));
    }

    /* --------------------------- SUBMIT PAGES / ACTIONS ------------------------------*/
    public function check_valid($id_pengeluaran){
        $redirect = base_url("management/job");

        $find = $this->job_m->find_output($id_pengeluaran);
        $this->is_success($find,lang("not_find"),$redirect);

        $check = $this->job_m->check_valid($id_pengeluaran);
        $this->is_success($check,lang("failed"),$redirect);

        /*Start Notif Email*/
        $this->cur_user_notif(array(
            "user" => $this->nm->find_teknisi($find['id_servisan']),
            "body" => "Pengeluaran ".$find['keterangan']." anda telah dinyatakan valid. Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Divalidasi Oleh: ".$this->session->userdata("nama"),
            "subject" => "Validasi Pengeluaran",
        ));
        /*End Notif Email*/

        $this->session->set_flashdata('successMessage', lang("success"));
        redirect($redirect);
    }
    public function check_invalid($id_pengeluaran){
        $redirect = base_url("management/job");

        $find = $this->job_m->find_output($id_pengeluaran);
        $this->is_success($find,lang("not_find"),$redirect);

        $check = $this->job_m->check_invalid($id_pengeluaran);
        $this->is_success($check,lang("failed"),$redirect);

        /*Start Notif Email*/
        $this->cur_user_notif(array(
            "user" => $this->nm->find_teknisi($find['id_servisan']),
            "body" => "Pengeluaran ".$find['keterangan']." anda telah dinyatakan tidak valid. Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Divalidasi Oleh: ".$this->session->userdata("nama"),
            "subject" => "Validasi Pengeluaran",
        ));
        /*End Notif Email*/

        $this->session->set_flashdata('successMessage', lang("success"));
        redirect($redirect);
    }
    public function give(){
        $redirect = base_url("management/job/payroll");

        $data = $this->input->post();
        $this->is_success($this->give_validation(),validation_errors(),$redirect);

        $find = $this->job_m->find_user($data['id_user']);
        $this->is_success($find,lang("not_find"),$redirect);

        $data['gaji'] = $find['gaji'] - $data['jumlah'];
        unset($data['jumlah']);
        $this->is_success($data['gaji']>=0,lang("gaji_tidak_cukup"),$redirect);

        $give = $this->job_m->give($data);
        $this->is_success($give,lang("failed"),$redirect);

        /*Start Notif Email*/
        $this->cur_user_notif(array(
            "user" => $this->nm->find_cur_user($find['id_user']),
            "body" => "Gaji anda telah diberikan sejumlah: Rp. ".$this->input->post("jumlah")." Oleh: ".$this->session->userdata("nama").". Sisa gaji anda: Rp. ".$data['gaji'].".",
            "subject" => "Pengambilan Gaji",
        ));
        /*End Notif Email*/

        $this->session->set_flashdata('successMessage', lang("success"));
        redirect($redirect);
    }

    /* --------------------------- Notification Email ------------------------------*/
    function cur_user_notif($data){
        $content = $this->load->view("content/notification/index",$data,TRUE);

        $this->email->to($data['user']['email']);
        $this->email->from("scum2018@gmail.com", 'Service Center UM');
        $this->email->subject("Notifikasi ".$data['subject']);
        $this->email->message($content);

        $this->email->send();
    }
}