<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {
	public function __construct(){
       parent::__construct();
		$this->load->language('general');
		$this->load->language('admin');
		$this->load->model("admin/price_m");

		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('errorMessage', lang('not_login'));
			redirect('welcome');
		}
    }
    private function is_success($res,$error,$redirect){
    	if(!$res){
    		$this->session->set_flashdata('errorMessage', $error);
    		redirect($redirect);
    	}
    }
    private function servis_validation(){
    	$this->form_validation->set_rules('nama_servis', lang("nama_servis"), 'required');
    	$this->form_validation->set_rules('biaya', lang("biaya"), 'required');
		
		return $this->form_validation->run()!=FALSE;
    }
	public function index(){
		$this->load->view('content/admin/price/index',array("servis"=>$this->price_m->get()));
	}
	public function add(){
		$redirect = base_url("admin/price");
		$this->is_success($this->servis_validation(),validation_errors(),$redirect);

		$data = $this->input->post();

		$add = $this->price_m->add($data);
		$this->is_success($add,lang("failed"),$redirect);

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
	public function del($id_servis){
		$redirect=base_url("admin/price");
		$find = $this->price_m->find($id_servis);
		$this->is_success($find,lang("not_find"),$redirect);

		$del = $this->price_m->del($id_servis);
		$this->is_success($del,lang("failed"),$redirect);

		$this->session->set_flashdata('successMessage', lang("del_success"));
		redirect($redirect);
	}
	public function edit(){
		$redirect=base_url("admin/price");
		$this->is_success($this->servis_validation(),validation_errors(),$redirect);

		$data = $this->input->post();

		$find = $this->price_m->find($data['id_servis']);
		$this->is_success($find,lang("not_find"),$redirect);

		$edit = $this->price_m->edit($data);
		$this->is_success($edit,lang("failed"),$redirect);

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
}