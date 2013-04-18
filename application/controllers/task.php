<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('task_model', '', TRUE);
	}

	function create($project_id) {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$user_id = $s_data['id'];

			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('start', 'Start Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('end', 'End Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE) {

				$this->load->view('header_view', $s_data);
				$this->load->view('home_view', $s_data);
				$this->load->view('footer_view');
			} else {

				$data = array(
							'name' => $this->input->post('name'),
							'project' => $project_id,
							'user' => $user_id,
							'desc' => $this->input->post('desc'),
							'start' => $this->input->post('start'),
							'end' => $this->input->post('end'),
							'status' => $this->input->post('status')
						);

				$values = $_POST['assigned_to'];
				$this->task_model->create_task($data, $values);
				redirect('project/main/'.$project_id, 'refresh');
			}
		} else {
			redirect('home', 'refresh');
		}
	}

	function update($project_id, $task_id) {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$user_id = $s_data['id'];

			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('start', 'Start Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('end', 'End Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE) {

				/*$this->load->view('header_view', $s_data);
				$this->load->view('project_main_view', $s_data);
				$this->load->view('footer_view');*/
				redirect('project/main/'.$project_id, 'refresh');
			} else {

				$data = array(
							'name' => $this->input->post('name'),
							'user' => $user_id,
							'desc' => $this->input->post('desc'),
							'start' => $this->input->post('start'),
							'end' => $this->input->post('end'),
							'status' => $this->input->post('status')
						);

				$values = $_POST['assigned_to'];
				$this->task_model->update_task($data, $values, $task_id, $s_data['id']);
				redirect('project/main/'.$project_id, 'refresh');
			}
		} else {
			redirect('home', 'refresh');
		}
	}

	function delete($project_id, $task_id) {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$user_id = $s_data['id'];
			$this->task_model->delete_task($task_id, $user_id);
			redirect('project/main/'.$project_id, 'refresh');
		} else {
			redirect('home', 'refresh');
		}
	}
}

?>