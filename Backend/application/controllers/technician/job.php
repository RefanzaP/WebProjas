<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
	public function __construct(){
       parent::__construct();
		$this->load->language('general');
		$this->load->language('technician');
		$this->load->model('technician/job_m');

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
    public function repair_validation(){
    	$this->form_validation->set_rules('servis', lang("servis"), 'required');
		
		return $this->form_validation->run()!=FALSE;
    }
    private function upload_nota($keterangan){
    	$nmfile = time()."_".$keterangan."_".date("d-m-Y");
        $config['upload_path'] = "./dist/nota/";
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['max_width']  = '10576';
        $config['max_height']  = '5536';
        $config['file_name'] = $nmfile;

        $this->upload->initialize($config);
        return $this->upload->do_upload('nota');
    }

    /* --------------------------- LOAD PAGES ------------------------------*/
	public function index(){
		$this->load->view('content/technician/index',array("servisan" => $this->job_m->get_servisan()));
	}
	public function lists(){
		$this->load->view('content/technician/own',array("servisan" => $this->job_m->get_own_job()));
	}
	public function detail($id_servisan){
		$this->is_success(
			$this->job_m->find_job($id_servisan), 
			lang("not_find"),
			base_url("technician/job/lists")
		);

		$this->load->view('content/technician/detail',array(
			"servisan" => $this->job_m->find_detail($id_servisan),
			"servis" => $this->job_m->get_data_servis($id_servisan),
			"output" => $this->job_m->get_data_output($id_servisan),
			"id_servisan" => $id_servisan,
			"total" => $this->job_m->get_total($id_servisan)
		));
	}
	public function output_list(){
		$this->load->view("content/technician/output", array(
			'output' => $this->job_m->get_output_current_user(),
		));
	}

	/* --------------------------- SUBMIT PAGES / ACTIONS ------------------------------*/
	public function take_job($id_servisan){
		$redirect = base_url("technician/job");

		$find = $this->job_m->find($id_servisan);
		$this->is_success($find,lang("not_find"),$redirect);

		$save = $this->job_m->take_job($id_servisan);
		$this->is_success($save,lang("failed"),$redirect);

		/*Start Notif Email*/
		$this->admin_notif(array(
			"body" => "Servisan atas nama ".$data['nama_cust']." telah dikerjakan oleh ".$this->session->userdata("nama").". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.",
			"subject" => "Ambil Pekerjaan",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
	}
	public function save_repair(){
		$redirect = base_url("technician/job/detail/".$this->input->post("id_servisan"));
		$this->is_success($this->repair_validation(),validation_errors(),$redirect);

		$data = $this->input->post();
		$find = $this->job_m->find_own_job($data['id_servisan']);
		$this->is_success($find,lang("not_find"),$redirect);

		foreach ($data['servis'] as $s) {
			$find_servis = $this->job_m->find_servis($s);
			$this->is_success($find_servis,lang("not_find"),$redirect);

			$save = $this->job_m->save_repair(array(
				"id_servisan" => $data['id_servisan'],
				"id_servis" => $s,
				"id_teknisi" => $this->session->userdata("id_user"),
				"biaya" => $find_servis['biaya'],
				"create_at" => date("Y-m-d H:i:s"),
			));
		}

		$this->is_success($save,lang("failed"),$redirect);

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
	public function save_output(){
		$redirect = base_url("technician/job/detail/".$this->input->post("id_servisan"));
    	$this->is_success(isset($_FILES['nota']['name']),lang("nota").lang("required"),$redirect);

    	$this->load->library('upload');

    	$data = $this->input->post();
    	$find = $this->job_m->find_own_job($data['id_servisan']);
		$this->is_success($find,lang("not_find"),$redirect);

    	$upload = $this->upload_nota($data['keterangan']);
    	$this->is_success($upload,$this->upload->display_errors(),$redirect);

    	$nota = $this->upload->data();
    	$save = $this->job_m->save_output(array(
    		"id_servisan" => $data['id_servisan'],
    		'id_user' => $this->session->userdata("id_user"),
    		"nota" => $nota['file_name'],
    		'jumlah' => $data['jumlah'],
    		"keterangan" => $data['keterangan'],
    		"create_at" => date("Y-m-d H:i:s"),
    	));

    	/*Start Notif Email*/
		$this->management_notif(array(
			"body" => "Pengeluaran baru oleh ".$this->session->userdata("nama")." untuk servisan atas nama ".$find['nama_cust'].". Segera lakukan validasi nota pengeluaran tersebut. <br><br>Keterangan Pengeluaran: ".$data['keterangan'],
			"subject" => "Pengeluaran Baru",
		));
		/*End Notif Email*/

    	$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}

	public function add_output(){
		$redirect = base_url("technician/job/output_list");
    	$this->is_success(isset($_FILES['nota']['name']),lang("nota").lang("required"),$redirect);

    	$this->load->library('upload');

    	$data = $this->input->post();

    	$upload = $this->upload_nota($data['keterangan']);
    	$this->is_success($upload,$this->upload->display_errors(),$redirect);

    	$nota = $this->upload->data();
    	$save = $this->job_m->save_output(array(
    		'id_user' => $this->session->userdata("id_user"),
    		"nota" => $nota['file_name'],
    		'jumlah' => $data['jumlah'],
    		"keterangan" => $data['keterangan'],
    		"create_at" => date("Y-m-d H:i:s"),
    	));

    	/*Start Notif Email*/
		$this->management_notif(array(
			"body" => "Pengeluaran baru oleh ".$this->session->userdata("nama").". Segera lakukan validasi nota pengeluaran tersebut. <br><br>Keterangan Pengeluaran: ".$data['keterangan'],
			"subject" => "Pengeluaran Baru",
		));
		/*End Notif Email*/

    	$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}

	public function mark_finish($id_servisan){
		$redirect = base_url("technician/job/lists");

		$find = $this->job_m->find_own_job($id_servisan);
		$this->is_success($find,lang("not_find"),$redirect);

		$save = $this->job_m->mark_finish($id_servisan);
		$this->is_success($save,lang("failed"),$redirect);

		/*Start Notif Email*/
		$this->admin_notif(array(
			"body" => "Telah Selesai Servisan atas nama ".$find['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Diselesaikan Oleh: ".$this->session->userdata("nama"),
			"subject" => "Servisan Selesai",
		));
		$this->management_notif(array(
			"body" => "Telah Selesai Servisan atas nama ".$find['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Diselesaikan Oleh: ".$this->session->userdata("nama"),
			"subject" => "Servisan Selesai",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
	}

	public function del_data_servis($id_servisan,$id_data_servis){
		$redirect = base_url("technician/job/detail/".$id_servisan);

		$find = $this->job_m->find_data_servis($id_data_servis);
		$this->is_success($find,lang("not_find"),$redirect);

		$del = $this->job_m->del_data_servis($id_data_servis);
		$this->is_success($del,lang("failed"),$redirect);

		$this->session->set_flashdata('successMessage', lang("del_success"));
    	redirect($redirect);
	}
	public function del_data_output($id_servisan,$id_pengeluaran){
		$redirect = base_url("technician/job/detail/".$id_servisan);

		$find = $this->job_m->find_data_output($id_pengeluaran);
		$this->is_success($find,lang("not_find"),$redirect);

		$del = $this->job_m->del_data_output($id_pengeluaran);
		$this->is_success($del,lang("failed"),$redirect);

		unlink("./dist/nota/".$find['nota']);

		$this->session->set_flashdata('successMessage', lang("del_success"));
    	redirect($redirect);
	}
	public function back($id_servisan){
		$redirect = base_url("technician/job/lists");

		$find = $this->job_m->find_finished_job($id_servisan);
		$this->is_success($find,lang("not_find"),$redirect);

		$back = $this->job_m->back($id_servisan);
		$this->is_success($back,lang("failed"),$redirect);

		$this->session->set_flashdata('successMessage', lang("success"));
    	redirect($redirect);
	}
	public function edit_servis(){
		$redirect = base_url("technician/job/detail/".$this->input->post("id_servisan"));

		$data = $this->input->post();
		$find_servisan = $this->job_m->find_own_job($data['id_servisan']);
		$this->is_success($find_servisan,lang("not_find"),$redirect);

		$find_data_servis = $this->job_m->find_data_servis($data['id_data_servis']);
		$this->is_success($find_data_servis,lang("not_find"),$redirect);

		$find_servis = $this->job_m->find_servis($data['id_servis']);
		$this->is_success($find_servis,lang("not_find"),$redirect);

		$edit = $this->job_m->edit_servis(array(
			"id_data_servis" => $data['id_data_servis'],
			"id_servis" => $data['id_servis'],
			"biaya" => $find_servis['biaya'],
			"create_at" => date("Y-m-d H:i:s"),
		));

		$this->is_success($edit,lang("failed"),$redirect);

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
	public function edit_output(){
		$redirect = base_url("technician/job/detail/".$this->input->post("id_servisan"));
		$this->is_success(isset($_FILES['nota']['name']),lang("nota").lang("required"),$redirect);

		$data = $this->input->post();
		$find_servisan = $this->job_m->find_own_job($data['id_servisan']);
		$this->is_success($find_servisan,lang("not_find")."1",$redirect);

		$find_data_output = $this->job_m->find_data_output($data['id_pengeluaran']);
		$this->is_success($find_data_output,lang("not_find")."2",$redirect);

		$this->load->library('upload');

		$upload = $this->upload_nota($data['keterangan']);
    	$this->is_success($upload,$this->upload->display_errors(),$redirect);

    	$nota = $this->upload->data();

		$edit = $this->job_m->edit_output(array(
			"id_pengeluaran" => $data['id_pengeluaran'],
			"nota" => $nota['file_name'],
    		'jumlah' => $data['jumlah'],
    		"keterangan" => $data['keterangan'],
    		"create_at" => date("Y-m-d H:i:s"),
    		"status" => 0
		));

		$this->is_success($edit,lang("failed"),$redirect);

		unlink("./dist/nota/".$find_data_output['nota']);

		/*Start Notif Email*/
		$this->management_notif(array(
			"body" => "Telah diperbarui pengeluaran ".$data['keterangan']." untuk servisan atas nama ".$find_servisan['nama_cust'].". Segera lakukan validasi nota pengeluaran tersebut. <br><br>Diperbarui oleh: ".$this->session->userdata("nama"),
			"subject" => "Perbarui Pengeluaran",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
	public function edit_output_2(){
		$redirect = base_url("technician/job/output_list");
		$this->is_success(isset($_FILES['nota']['name']),lang("nota").lang("required"),$redirect);

		$data = $this->input->post();

		$find_data_output = $this->job_m->find_data_output($data['id_pengeluaran']);
		$this->is_success($find_data_output,lang("not_find")."2",$redirect);

		$this->load->library('upload');

		$upload = $this->upload_nota($data['keterangan']);
    	$this->is_success($upload,$this->upload->display_errors(),$redirect);

    	$nota = $this->upload->data();

		$edit = $this->job_m->edit_output(array(
			"id_pengeluaran" => $data['id_pengeluaran'],
			"nota" => $nota['file_name'],
    		'jumlah' => $data['jumlah'],
    		"keterangan" => $data['keterangan'],
    		"create_at" => date("Y-m-d H:i:s"),
    		"status" => 0
		));

		$this->is_success($edit,lang("failed"),$redirect);

		unlink("./dist/nota/".$find_data_output['nota']);

		/*Start Notif Email*/
		$find_servisan = $this->nm->find_teknisi($find_data_output['id_servisan']);
		$this->management_notif(array(
			"body" => "Telah diperbarui pengeluaran ".$data['keterangan']." untuk servisan atas nama ".$find_servisan['nama_cust'].". Segera lakukan validasi nota pengeluaran tersebut. <br><br>Diperbarui oleh: ".$this->session->userdata("nama"),
			"subject" => "Perbarui Pengeluaran",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}
	public function cancel($id_servisan){
		$redirect = base_url("technician/job/lists");

		$find = $this->job_m->find_own_job($id_servisan);
		$this->is_success($find,lang("not_find")."2",$redirect);

		$data_output = $this->job_m->get_data_output($id_servisan);
		foreach ($data_output as $d) {
			echo $d['nota']."<br>";
			unlink("./dist/nota/".$d['nota']);
		}

		$cancel = $this->job_m->cancel($id_servisan);
		$this->is_success($cancel,lang("failed"),$redirect);

		/*Start Notif Email*/
		$this->admin_notif(array(
			"body" => "Telah Dibatalkan Servisan atas nama ".$find['nama_cust'].". Untuk informasi lebih lanjut, silahkan cek di website Service Center UM.<br><br>Dibatalkan Oleh: ".$this->session->userdata("nama"),
			"subject" => "Cancel Servisan",
		));
		/*End Notif Email*/

		$this->session->set_flashdata('successMessage', lang("success"));
		redirect($redirect);
	}

	/* --------------------------- Notification Email ------------------------------*/
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
	function management_notif($data){
		$management = $this->nm->get_management();

		foreach ($management as $a) {
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