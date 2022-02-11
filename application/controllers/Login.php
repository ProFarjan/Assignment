<?php

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index () {

		if (isset($_POST['email']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			$email = $this->input->post('email', true);
			$password = $this->input->post('password');

			if ($this->form_validation->run() == false){
				$this->form_validation->set_message('form_invalid','Form All Fields Must Be Required!!');
				$this->load->view('login');
			}else{
				$this->db->from("db_admin");
				$this->db->where(['email' => $email]);
				$user = $this->db->get()->row();
				if($user){
					if(password_verify($password, $user->password)){
						$this->session->set_userdata('is_login',true);
						$this->session->set_userdata('user',$user);
						redirect("dashboard");
					}else{
						$this->form_validation->set_message('invalid_pwd', "Password Can't Match!! Please try again!");
						$this->load->view('login');
					}
				}else{
					$this->form_validation->set_message('username_check',"User account can't found!!");
					$this->load->view('login');
				}
			}
		} else {
			$this->load->view('login');
		}

	}

}
