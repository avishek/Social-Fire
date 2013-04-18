<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('user_model', '', TRUE);
	}

	function index() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check');

		if($this->form_validation->run() == FALSE ) {
			$this->load->view('login_view');	
		} else {
			redirect('home', 'refresh');
		}
	}

	function check($password) {

		$email = $this->input->post('email');

		$result = $this->user_model->login($email, $password);

		if($result) {
			$s_data = array();
			foreach ($result as $row) {
				$s_data = array(
							'id' => $row->id,
							'name' => $row->name,
							'email' => $row->email,
							'password' => $password,
							'matric' => $row->matric
						  );
				$this->session->set_userdata('logged_in', $s_data);
			}
			return TRUE;
		} else {
			$this->form_validation->set_message('check', 'Invalid email or password');
			return FALSE;
		}
	}

	function up() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('matric', 'Matriculation Number', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|xss_clean|callback_confirm');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('sign_up_view');
		} else {
			$data = array(
						'name' => $this->input->post('name'),
						'matric' => $this->input->post('matric'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password') 
					);

			$this->user_model->insert_user($data);
			$this->load->view('login_view');
		}
	}

	function confirm($c_password) {

		$password = $this->input->post('password');

		if($password == $c_password) {
			return TRUE;
		} else {
			$this->form_validation->set_message('confirm', 'Please enter the same password.');
			return FALSE;
		}
	}
}

?>