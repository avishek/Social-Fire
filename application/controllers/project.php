<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('project_model', '', TRUE);
		$this->load->model('user_model', '', TRUE);
		$this->load->model('setting_model', '', TRUE);
		$this->load->model('task_model', '', TRUE);
		$this->load->model('task_assigned_model', '', TRUE);
		$this->load->model('file_model', '', TRUE);
		$this->load->model('activity_model', '', TRUE);
		$this->load->model('comment_model', '', TRUE);
	}

	function index() {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$result = $this->project_model->get_all($s_data['id']);
			$prj = array();
			if($result) {
				$x = 0;
				foreach ($result as $row) {
					
					$prj[$x] = array(
							'id' => $row->id,
							'name' => $row->name,
							'start' => $row->start,
							'end' => $row->end,
							'desc' => $row->description,
							'status' => $row->status
						);
					$x++;
				}
			}

			$data = array('projects' => $prj);
			$this->load->view('header_view', $s_data);
			$this->load->view('project_all_view', $data);
			$this->load->view('footer_view');
		} else {
			redirect('home', 'refresh');
		}
	}

	function create() {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('start', 'Start Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('end', 'End Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE) {

				$this->load->view('header_view', $s_data);
				$this->load->view('project_all_view', $s_data);
				$this->load->view('footer_view');
			} else {

				$data = array(
							'name' => $this->input->post('name'),
							'desc' => $this->input->post('desc'),
							'start' => $this->input->post('start'),
							'end' => $this->input->post('end'),
							'status' => $this->input->post('status'),
							'creator_id' => $s_data['id']
						);
				$this->project_model->insert_project($data);
				redirect('project', 'refresh');
			}
		} else {
			redirect('home', 'refresh');
		}
	}

	function main($id) {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			/* 
				Project settings code 
			*/
			$row = $this->project_model->get($id);
			$temp = array();
			$usr = $this->user_model->get_all($s_data['id']);
			$c = $this->setting_model->get_contributors($id);
			if($row) {

				$temp_c = array();
				$x = 0;
				foreach ($usr as $rowu) {
					$cont = 0;
					foreach ($c as $rowc) {
						if($rowu->id == $rowc->user) {
							$cont = 1;
						}
					}
					$temp_c[$x] = array(
									'id' => $rowu->id,
									'name' => $rowu->name,
									'cont' => $cont
									);
					$x++;
				}

				$r = $this->user_model->get_user($row->creator_id);

				$temp = array(
							'id' => $id,
							'name' => $row->name,
							'desc' => $row->desc,
							'start' => $row->start,
							'end' => $row->end,
							'status' => $row->status,
						);
			}

			/*
				Project task code 
			*/
			$tasks = $this->task_model->get_tasks_information($id);
			$temp_tasks = array();
			$m = 0;
			if($tasks) {
				foreach ($tasks as $value) {
					$task_creator_info = $this->user_model->get_user($value->user);

					$assigned = $this->task_assigned_model->get_assigned_to($value->id);
					$assigned_to_details = array();
					$z = 0;
					foreach ($c as $cntb) {
						$asd = 0;
						$assigned_to_info = $this->user_model->get_user($cntb->user);
						foreach ($assigned as $val) {
							if($cntb->user == $val->user) {
								$asd = 1;
							}
						}
						$assigned_to_details[$z] = array('id' => $assigned_to_info->id, 'name' => $assigned_to_info->name, 'task_asd' => $asd);
						$z++;
					}
					
					$temp_tasks[$m] = array(
										'task_id' => $value->id,
										'task_name' => $value->name,
										'task_start_date' => $value->start,
										'task_end_date' => $value->end,
										'task_status' => $value->status,
										'task_creator' => $task_creator_info->name,
										'task_assigned_to' => $assigned_to_details,
										'task_desc' => $value->desc
										 );
					$m++;
				}
			}

			/*
				Activity code
			*/
			$activity_details = $this->activity_model->get_activities($id);
			$temp_activities = array();
			$h = 0;
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

			/*
				File info code
			*/
			$file_details = $this->file_model->get_file_info($id);
			$temp_file_details = array();
			$w = 0;
			if($file_details) {
				foreach ($file_details as $file_value) {
					$file_creator_info = $this->user_model->get_user($file_value->user);

					$my_file = 0;
					if($file_value->user == $s_data['id']) {
						$my_file = 1;
					}

					$temp_file_details[$w] = array(
												'file_id' => $file_value->id,
												'file_name' => $file_value->name,
												'file_creator_name' => $file_creator_info->name,
												'file_type' => $file_value->type,
												'file_size' => $file_value->size,
												'file_upload_datetime' => $file_value->date_time ,
												'file_mine' => $my_file
												);

					$w++; 
				}
			}

			$data = array('project' => $temp, 'contributors' => $temp_c, 'creator' => array('id' => $r->id, 'name' => $r->name), 
				'tasks' => $temp_tasks, 'files' => $temp_file_details, 'activities' => $temp_activities);
			$this->load->view('header_view', $s_data);
			$this->load->view('project_main_view', $data);
			$this->load->view('footer_view');
		} else {
			redirect('home', 'refresh');
		}
	}

	function update($id) {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('start', 'Start Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('end', 'End Date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE) {

				$this->load->view('header_view', $s_data);
				$this->load->view('project_main_view', $s_data);
				$this->load->view('footer_view');
			} else {

				$data = array(
							'name' => $this->input->post('name'),
							'desc' => $this->input->post('desc'),
							'start' => $this->input->post('start'),
							'end' => $this->input->post('end'),
							'status' => $this->input->post('status'),
							'creator_id' => $this->input->post('creator_id')
						);

				$values = $_POST['contributors'];
				$t_data = array();
				$x=0;
				foreach ($values as $k) {
					if($k == $this->input->post('creator_id')) {
						$t_data[$x] = array('user' => $k, 'project' => $id, 'role' => 0);
					} else {
						$t_data[$x] = array('user' => $k, 'project' => $id, 'role' => 2);
					}
					$x++;
				}

				$this->project_model->update_project($data, $id);
				$this->setting_model->update_setting($t_data, $id);
				redirect('project/main/'.$id, 'refresh');
			}
		} else {
			redirect('home', 'refresh');
		}	
	}
}

?>