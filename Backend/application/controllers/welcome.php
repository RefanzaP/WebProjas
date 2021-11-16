<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();      
        $this->load->language('general');
        $this->load->model('auth_m');
        if($this->session->userdata('email')){
			redirect(base_url('dashboard'));
		}
    }

	public function index(){
		if($this->input->post("email")!=null){
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			$where = array(
				'email' => $email,
				'password' => md5($password)
			);

			$cek = $this->auth_m->cek_login($where);
			if($cek){
				$this->auth_m->log_login($cek['id_user']);

				$data_session = array(
					'email' => $email,
					'role' => $cek['role'],
					'id_user' => $cek['id_user'],
					'nama' => $cek['nama'],
					'create_at' => $cek['create_at']
				);
				$this->session->set_flashdata("alert_success",lang("login_success"));
				$this->session->set_userdata($data_session);
				redirect(base_url("dashboard"));
			}else{
				$this->session->set_flashdata("errorMessage",lang("invalid_pass"));
				redirect(base_url("welcome"));
			}
		}else{
			$this->load->view('auth/login');
		}
	}
}
