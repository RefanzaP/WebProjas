<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class To_technician extends CI_Controller {
	public function __construct(){
       parent::__construct();
		$this->load->language('general');
		$this->load->language('admin');
		$this->load->model("admin/to_technician_m","ttm");

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
    private function to_technician_validation(){
    	$this->form_validation->set_rules('teknisi', lang("teknisi"), 'required');
		
		return $this->form_validation->run()!=FALSE;
    }

    /* --------------------------- LOAD PAGES ------------------------------*/
	public function index(){
		$this->load->view('content/admin/to_technician/index',array("servisan" => $this->ttm->get()));
	}

	/* --------------------------- SUBMIT PAGES / ACTIONS ------------------------------*/
	public function save(){
		$redirect = base_url("admin/to_technician");
		$validation = $this->to_technician_validation();
		$this->is_success($validation,validation_errors(),$redirect);

		$data = $this->input->post();
		$find = $this->ttm->find($data['id_servisan']);
		$this->is_success($find,lang("not_find"),$redirect);

		$save = $this->ttm->save($data);
		$this->is_success($save,lang("failed"),$redirect);

		/*Start Notif Email*/
        $this->cur_user_notif(array(
            "user" => $this->nm->find_cur_user($data['teknisi']),
            "body" => "Anda telah ditugaskan untuk menangani servisan atas nama ".$find['nama_cust']." oleh Admin ".$this->session->userdata("nama").". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.",
            "subject" => "Tugas Servisan",
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