<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('setting_model', '', TRUE);
		$this->load->model('activity_model', '', TRUE);
		$this->load->model('comment_model', '', TRUE);
		$this->load->model('user_model', '', TRUE);
		$this->load->model('project_model', '', TRUE);
	}

	function index() {

		$data = $this->session->userdata('logged_in');

		if($data) {

			$user_setting_details = $this->setting_model->get_projects($data['id']);
			$temp_activities = array();
			$h = 0;
			foreach ($user_setting_details as $setting_value) {
				
				$activity_details = $this->activity_model->get_activities($setting_value->project);
				$activity_project_info = $this->project_model->get($setting_value->project);
				if($activity_details) {
					foreach ($activity_details as $activity_value) {
						
						$comments = $this->comment_model->get_comments($activity_value->id);
						$temp_comments = array();
						$e = 0;
						foreach ($comments as $comment_value) {
							
							$comment_user_info = $this->user_model->get_user($comment_value->user);
							$temp_comments[$e] = array(
												'comment_id' => $comment_value->id,
												'comment_activity' => $comment_value->activity,
												'comment_user_name' => $comment_user_info->name,
												'comment_msg' => $comment_value->msg,
												'comment_date_time' => $comment_value->date_time 
												);
							$e++;
						}
						
						$activity_user_info = $this->user_model->get_user($activity_value->user);
						$temp_activities[$h] = array(
											'activity_id' => $activity_value->id,
											'activity_project' => $activity_value->project,
											'activity_project_name' => $activity_project_info->name,
											'activity_user_name' => $activity_user_info->name,
											'activity_subject' => $activity_value->subject,
											'activity_subject_name' => $activity_value->subject_name,
											'activity_date_time' => $activity_value->date_time,
											'activity_type' => $activity_value->type,
											'activity_comments' => $temp_comments
											);
						$h++;
					}
				}
			}

			$h_data = array('activities' => $temp_activities, 'settings' => $user_setting_details);

			$this->load->view('header_view', $data);
			$this->load->view('home_view', $h_data);
			$this->load->view('footer_view');
		} else {
			redirect('login', 'refresh');
		}
	}

	function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('home', 'refresh');
	}
}

?>