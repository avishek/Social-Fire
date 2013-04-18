<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('user_model');
	}

	function index() {
	
		$s_data = $this->session->userdata('logged_in');

		if($s_data) {
			$this->load->view('header_view', $s_data);
			$this->load->view('profile_view', $s_data);
			$this->load->view('footer_view');
		} else {
			redirect('home', 'refresh');
		}		
	}

	function edit() {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('matric', 'Matriculation Number', 'trim|required|xss_clean');		
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('c_password', 'Confim Password', 'trim|required|xss_clean|callback_confirm');

			if($this->form_validation->run() == FALSE) {

				$this->load->view('header_view', $s_data);
				$this->load->view('profile_edit_view', $s_data);
				$this->load->view('footer_view');	
			} else {

				$data = array(
							'name' => $this->input->post('name'),
							'matric' => $this->input->post('matric'),
							'email' => $s_data['email'],
							'password' => $this->input->post('password') 
						);
				$this->user_model->update_user($data, $s_data['id']);

				$u_data = array(
							'id' => $s_data['id'],
							'name' => $this->input->post('name'),
							'email' => $s_data['email'],
							'password' => $this->input->post('password'),
							'matric' => $this->input->post('matric')
							);
				$this->session->unset_userdata('logged_in');
				$this->session->set_userdata('logged_in', $u_data);
				redirect('profile', 'refresh');
			}
			
		} else {
			redirect('home', 'refresh');
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