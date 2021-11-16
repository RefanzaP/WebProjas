<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
       parent::__construct();
		$this->load->language('general');
		$this->load->language('dashboard');
		$this->load->language('technician');
		$this->load->model('dashboard_m');
		$this->load->model('auth_m');

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
    private function is_success($res,$error,$redirect){
    	if(!$res){
    		$this->session->set_flashdata('errorMessage', $error);
    		redirect($redirect);
    	}
    }
    private function servisan_validation(){
    	$this->form_validation->set_rules('nama_cust', lang("nama_cust"), 'required');
		$this->form_validation->set_rules('no_telp', lang("no_telp"), 'required|numeric');
		$this->form_validation->set_rules('jns_barang', lang("jns_barang"), 'required');
		$this->form_validation->set_rules('kelengkapan', lang("kelengkapan"), 'required');
		$this->form_validation->set_rules('keluhan', lang("keluhan"), 'required');
		return $this->form_validation->run()!=FALSE;
    }

    /* --------------------------- LOAD PAGES ------------------------------*/
	public function index(){
		$data=$this->dashboard_m->count_servisan();
		$data['servisan']=$this->dashboard_m->get_servisan();
		$data['monthly_laba']=$this->dashboard_m->get_monthly_laba();
		
		$this->load->view('content/dashboard/index',$data);
	}
	public function detail_servisan($id_servisan){
		$find = $this->dashboard_m->find_servisan($id_servisan);
		$this->is_success($find, lang("not_find"),base_url("dashboard"));

		$this->load->view('content/dashboard/detail',array(
			"servisan" => $this->dashboard_m->find_detail($id_servisan),
			"servis" => $this->dashboard_m->get_data_servis($id_servisan),
			"output" => $this->dashboard_m->get_data_output($id_servisan),
			"id_servisan" => $id_servisan,
			"total" => $this->dashboard_m->get_total($id_servisan)
		));
	}

	/* --------------------------- SUBMIT PAGES / ACTIONS ------------------------------*/
	public function add_servisan(){
		$redirect=base_url("dashboard");
		$this->is_success($this->servisan_validation(),validation_errors(),$redirect);

		$data = $this->input->post();
		$add = $this->dashboard_m->add_servisan($data);
		$this->is_success($add,lang("failed"),$redirect);

		/*Start Notif Email*/
		$this->all_user_notif(array(
			"body" => "Servisan masuk atas nama ".$data['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM. <br><br>Penerima: ".$this->session->userdata("nama"),
			"subject" => "Servisan Masuk",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
	public function edit_servisan(){
		$redirect=base_url("dashboard");
		$this->is_success($this->servisan_validation(),validation_errors(),$redirect);

		$data = $this->input->post();

		$find = $this->dashboard_m->find_servisan($data['id_servisan']);
		$this->is_success($find,lang("not_find"),$redirect);

		$edit = $this->dashboard_m->edit_servisan($data);
		$this->is_success($edit,lang("failed"),$redirect);

		/*Start Notif Email*/
		$this->all_user_notif(array(
			"body" => "Ada Perubahan data Servisan atas nama ".$find['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Diubah Oleh: ".$this->session->userdata("nama"),
			"subject" => "Edit Servisan",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
	public function del_servisan($id_servisan){
		$redirect=base_url("dashboard");
		$find = $this->dashboard_m->find_del($id_servisan);
		$this->is_success($find,lang("not_find"),$redirect);

		$del = $this->dashboard_m->del_servisan($id_servisan);
		$this->is_success($del,lang("failed"),$redirect);

		/*Start Notif Email*/
		$this->all_user_notif(array(
			"body" => "Telah Dihapus Servisan atas nama ".$find['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Dihapus Oleh: ".$this->session->userdata("nama"),
			"subject" => "Hapus Servisan",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("del_success"));
		redirect($redirect);
	}
	
	public function back_servisan($id_servisan){
		$redirect=base_url("dashboard");
		$find = $this->dashboard_m->find_back($id_servisan);
		$this->is_success($find,lang("not_find"),$redirect);

		$back = $this->dashboard_m->back_servisan($id_servisan);
		$this->is_success($back,lang("failed"),$redirect);

		/*Start Notif Email*/
		$this->all_user_notif(array(
			"body" => "Telah Kembali Servisan atas nama ".$find['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Dikembalikan Oleh: ".$this->session->userdata("nama"),
			"subject" => "Pengembalian Servisan",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("del_success"));
		redirect($redirect);
	}
	public function claim(){
		$id_servisan = $this->input->post("id_servisan");
		$keluhan = $this->input->post("keluhan");

		$find = $this->dashboard_m->find_claim($id_servisan);
		$this->is_success($find,lang("not_find"),$redirect);

		$claim = $this->dashboard_m->claim($id_servisan, $keluhan);
		$this->is_success($claim,lang("failed"),$redirect);

		/*Start Notif Email*/
		$this->cur_user_notif(array(
			"user" => $this->nm->find_cur_user($find['teknisi']),
			"body" => "Klaim Garansi Servisan atas nama ".$find['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Diterima Oleh: ".$this->session->userdata("nama"),
			"subject" => "Klaim Garansi",
		));
		$this->admin_notif(array(
			"body" => "Klaim Garansi Servisan atas nama ".$find['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Diterima Oleh: ".$this->session->userdata("nama"),
			"subject" => "Klaim Garansi",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("del_success"));
		redirect($redirect);
	}
	public function logout(){
		$this->auth_m->logout();
		$this->session->sess_destroy();

		$this->session->set_flashdata('successMessage', lang("logout_success"));
		redirect(base_url("welcome"));
	}

	/* --------------------------- Notification Email ------------------------------*/
	function all_user_notif($data){
		$all_user=$this->nm->get_all_user();

		foreach ($all_user as $a) {
			$data['user'] = $a;
			$content = $this->load->view("content/notification/index",$data,TRUE);

		    $this->email->to($a['email']);
		    $this->email->from("scum2018@gmail.com", 'Service Center UM');
		    $this->email->subject("Notifikasi ".$data['subject']);
		    $this->email->message($content);

		    $this->email->send();
		}
	}
	function cur_user_notif($data){
		$content = $this->load->view("content/notification/index",$data,TRUE);

	    $this->email->to($data['user']['email']);
	    $this->email->from("scum2018@gmail.com", 'Service Center UM');
	    $this->email->subject("Notifikasi ".$data['subject']);
	    $this->email->message($content);

	    $this->email->send();
	}
	function admin_notif($data){
		$admin=$this->nm->get_admin();

		foreach ($admin as $a) {
			$data['user'] = $a;
			$content = $this->load->view("content/notification/index",$data,TRUE);

		    $this->email->to($a['email']);
		    $this->email->from("scum2018@gmail.com", 'Service Center UM');
		    $this->email->subject("Notifikasi ".$data['subject']);
		    $this->email->message($content);

		    $this->email->send();
		}
	}
}