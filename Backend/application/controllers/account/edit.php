<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->language('general');
		$this->load->language('account');
		$this->load->model('account/account_m');

		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('errorMessage', lang('not_login'));
			redirect('welcome');
		}
    }
    public function is_success($res,$error,$redirect){
    	if(!$res){
    		$this->session->set_flashdata('errorMessage', $error);
    		redirect($redirect);
    	}
    }
    public function account_validation(){
    	$this->form_validation->set_rules('nama', lang("nama"), 'required');
    	$this->form_validation->set_rules('jk', lang("jk"), 'required');
    	$this->form_validation->set_rules('alamat', lang("alamat"), 'required');
    	$this->form_validation->set_rules('no_telp', lang("no_telp"), 'required');

		return $this->form_validation->run()!=FALSE;
    }
    public function password_validation(){
    	$this->form_validation->set_rules('old', lang("password_lama"), 'required');
    	$this->form_validation->set_rules('new', lang("password_baru"), 'trim|required|min_length[8]');
    	$this->form_validation->set_rules('re', lang("konfirmasi_password"), 'trim|required|matches[new]');

		return $this->form_validation->run()!=FALSE;
    }
    public function email_validation(){
    	$this->form_validation->set_rules('email', lang("email_address"), 'required|valid_email|is_unique[user.email]');

		return $this->form_validation->run()!=FALSE;
    }
    public function save_data(){
    	$redirect = base_url("account/edit");
    	$this->is_success($this->account_validation(),validation_errors(),$redirect);

    	$data = $this->input->post();
    	$save = $this->account_m->save_data($data);
    	$this->is_success($save,lang("failed"),$redirect);

    	$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
    }
    public function save_password(){
    	$redirect = base_url("account/edit");
    	$this->is_success($this->password_validation(),validation_errors(),$redirect);

    	$check = $this->account_m->check_password($this->input->post("old"));
    	$this->is_success($check,lang("invalid_pass"),$redirect);

    	$save = $this->account_m->save_password($this->input->post("new"));
    	$this->is_success($save,lang("failed"),$redirect);

    	$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
    }
    public function save_email(){
    	$redirect = base_url("account/edit");
    	$this->is_success($this->email_validation(),validation_errors(),$redirect);

    	$data = $this->input->post();
    	$save = $this->account_m->save_email($data);
    	$this->is_success($save,lang("failed"),$redirect);

    	$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
    }
    public function save_photo(){
    	$redirect = base_url("account/edit");
    	$this->is_success(isset($_FILES['foto']['name']),lang("foto_profil").lang("required"),$redirect);
    	
    	$this->load->library('upload');

    	$user = $this->account_m->get();
    	$this->is_success($this->upload_photo($user),$this->upload->display_errors(),$redirect);

    	$photo = $this->upload->data();
    	$save = $this->account_m->save_photo($photo['file_name']);
    	$this->is_success($save,lang("failed"),$redirect);

    	unlink("./dist/pp_users/".$user['foto']);

    	$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
    }

    private function upload_photo($user){
    	$nmfile = $user['nama']."_".date("d-m-Y")."_".time();
        $config['upload_path'] = "./dist/pp_users/";
        $config['allowed_types'] = 'jpg|png|jpeg|bmp';
        $config['max_size'] = '2048';
        $config['max_width']  = '10576';
        $config['max_height']  = '5536';
        $config['file_name'] = $nmfile;

        $this->upload->initialize($config);
        return $this->upload->do_upload('foto');
    }

	public function index(){
		$this->load->view('content/account/index',array("user" => $this->account_m->get()));
	}
}