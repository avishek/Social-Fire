<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('comment_model', '', TRUE);
	}

	function insert($project_id) {

		$s_data = $this->session->userdata('logged_in');
		if($s_data) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('msg', 'Message', 'trim|required|xss_clean');
			$this->form_validation->set_rules('activityId', 'Activity Id', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE) {

				redirect('project/main/'.$project_id, 'refresh');
			} else {

				$comment_data = array(
								'activity' => $this->input->post('activityId'),
								'user' => $s_data['id'],
								'msg' => $this->input->post('msg'),
								);
				$this->comment_model->insert_comment($comment_data);
				redirect('project/main/'.$project_id, 'refresh');
			}

		} else {
			redirect('home', 'refresh');
		}
	}

	function insert_home() {

		$s_data = $this->session->userdata('logged_in');
		if($s_data) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('msg', 'Message', 'trim|required|xss_clean');
			$this->form_validation->set_rules('activityId', 'Activity Id', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE) {

				redirect('home', 'refresh');
			} else {

				$comment_data = array(
								'activity' => $this->input->post('activityId'),
								'user' => $s_data['id'],
								'msg' => $this->input->post('msg'),
								);
				$this->comment_model->insert_comment($comment_data);
				redirect('home', 'refresh');
			}

		} else {
			redirect('home', 'refresh');
		}
	}
}

?>