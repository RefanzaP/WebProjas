<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	public function __construct(){
       parent::__construct();
		$this->load->language('general');
		$this->load->language('admin');
		$this->load->language('account');
		$this->load->model("admin/employee_m");

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
    private function employee_validation(){
    	$this->form_validation->set_rules('nama', lang("nama"), 'required');
    	$this->form_validation->set_rules('email', lang("email_address"), 'required|valid_email|is_unique[user.email]');
    	$this->form_validation->set_rules('password', lang("password"), 'required');
    	$this->form_validation->set_rules('jk', lang("jk"), 'required');
    	$this->form_validation->set_rules('alamat', lang("alamat"), 'required');
    	$this->form_validation->set_rules('no_telp', lang("no_telp"), 'required');
		
		return $this->form_validation->run()!=FALSE;
    }
	public function index(){
		$this->load->view('content/admin/employee/index',array("employee"=>$this->employee_m->get()));
	}
	public function add(){
		$redirect = base_url("admin/employee");
		$this->is_success($this->employee_validation(),validation_errors(),$redirect);

		$data = $this->input->post();

		$add = $this->employee_m->add($data);
		$this->is_success($add,lang("failed"),$redirect);

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
	public function del($id_user){
		$redirect=base_url("admin/employee");
		$find = $this->employee_m->find($id_user);
		$this->is_success($find,lang("not_find"),$redirect);

		$del = $this->employee_m->del($id_user);
		$this->is_success($del,lang("failed"),$redirect);

		unlink("./dist/pp_users/".$find['foto']);

		$this->session->set_flashdata('successMessage', lang("del_success"));
		redirect($redirect);
	}
	public function edit($id_user){
		$find = $this->employee_m->find($id_user);
		$this->is_success($find, lang("not_find"), base_url("admin/employee"));

		$this->load->view('content/admin/employee/edit',array("user"=>$find));
	}

	//Account
	public function account_validation(){
    	$this->form_validation->set_rules('nama', lang("nama"), 'required');
    	$this->form_validation->set_rules('jk', lang("jk"), 'required');
    	$this->form_validation->set_rules('alamat', lang("alamat"), 'required');
    	$this->form_validation->set_rules('no_telp', lang("no_telp"), 'required');

		return $this->form_validation->run()!=FALSE;
    }
    public function password_validation(){
    	$this->form_validation->set_rules('new', lang("password_baru"), 'trim|required|min_length[8]');
    	$this->form_validation->set_rules('re', lang("konfirmasi_password"), 'trim|required|matches[new]');

		return $this->form_validation->run()!=FALSE;
    }
    public function email_validation(){
    	$this->form_validation->set_rules('email', lang("email_address"), 'required|valid_email|is_unique[user.email]');

		return $this->form_validation->run()!=FALSE;
    }
    public function save_data(){
    	$data = $this->input->post();

    	$redirect = base_url("admin/employee/edit/".$data['id_user']);
    	$this->is_success($this->account_validation(),validation_errors(),$redirect);

    	$find = $this->employee_m->find($data['id_user']);
    	$this->is_success($find,lang("not_find"),$redirect);

    	$save = $this->employee_m->save_data($data);
    	$this->is_success($save,lang("failed"),$redirect);

    	$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
    }
    public function save_password(){
    	$data = $this->input->post();

    	$redirect = base_url("admin/employee/edit/".$data['id_user']);
    	$this->is_success($this->password_validation(),validation_errors(),$redirect);

    	$find = $this->employee_m->find($data['id_user']);
    	$this->is_success($find,lang("not_find"),$redirect);

    	$save = $this->employee_m->save_password($data['new'],$data['id_user']);
    	$this->is_success($save,lang("failed"),$redirect);

    	$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
    }
    public function save_email(){
    	$data = $this->input->post();

    	$redirect = base_url("admin/employee/edit/".$data['id_user']);
    	$this->is_success($this->email_validation(),validation_errors(),$redirect);

    	$find = $this->employee_m->find($data['id_user']);
    	$this->is_success($find,lang("not_find"),$redirect);

    	$save = $this->employee_m->save_email($data['email'],$data['id_user']);
    	$this->is_success($save,lang("failed"),$redirect);

    	$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
    }
    public function save_photo(){
    	$data = $this->input->post();
    	
    	$redirect = base_url("admin/employee/edit/".$data['id_user']);
    	$this->is_success(isset($_FILES['foto']['name']),lang("foto_profil").lang("required"),$redirect);
    	
    	$this->load->library('upload');

    	$user = $this->employee_m->find($data['id_user']);
    	$this->is_success($this->upload_photo($user),$this->upload->display_errors(),$redirect);

    	$photo = $this->upload->data();
    	$save = $this->employee_m->save_photo($photo['file_name'],$data['id_user']);
    	$this->is_success($save,lang("failed"),$redirect);

    	unlink("./dist/pp_users/".$user['foto']);

    	$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
    }
    public function change_role(){
        $data = $this->input->post();

        $redirect = base_url("admin/employee/edit/".$data['id_user']);
        $this->is_success($data['role']<4 && $data['role']>0,lang("failed"),$redirect);

        $find = $this->employee_m->find($data['id_user']);
        $this->is_success($find,lang("not_find"),$redirect);

        $save = $this->employee_m->change_role($data);
        $this->is_success($save,lang("failed"),$redirect);

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
}