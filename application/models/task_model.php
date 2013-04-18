<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_model extends CI_Model {

	function __construct() {

		parent::__construct();
		$this->load->model('task_assigned_model', '', TRUE);
		$this->load->model('activity_model', '', TRUE);
	}

	function create_task($data, $values) {

		$this->db->insert('task', $data);

		$query = $this->db->query("SELECT id FROM task WHERE name = '".$data['name']."'");
		if($query->num_rows() > 0) {
			$row = $query->row();

			foreach ($values as $k) {
				$r_data = array(
							'task' => $row->id,
							'user' => $k 
							);
				$this->task_assigned_model->insert_assigned_task($r_data);
			}
		}

		$activity_data = array(
						'project' => $data['project'],
						'user' => $data['user'],
						'subject' => "task",
						'subject_name' => $data['name'],
						'type' => 1  
						);
		$this->activity_model->insert_activity($activity_data);
	}

	function update_task($data, $values, $t_id, $user) {

		$task_info = $this->get_task_info($t_id);
		$activity_data = array(
						'project' => $task_info->project,
						'user' => $user,
						'subject' => "task",
						'subject_name' => $task_info->name,
						'type' => 2  
						);
		$this->activity_model->insert_activity($activity_data);

		$this->db->where('id', $t_id);
		$this->db->update('task', $data);

		$this->task_assigned_model->delete($t_id);
		foreach ($values as $k) {
			$r_data = array(
						'task' => $t_id,
						'user' => $k 
						);
			$this->task_assigned_model->insert_assigned_task($r_data);
		}
	}

	function delete_task($t_id, $user) {

		$task_info = $this->get_task_info($t_id);
		$activity_data = array(
						'project' => $task_info->project,
						'user' => $user,
						'subject' => "task",
						'subject_name' => $task_info->name,
						'type' => 3  
						);
		$this->activity_model->insert_activity($activity_data);

		$this->db->where('id', $t_id);
		$this->db->delete('task');

		$this->task_assigned_model->delete($t_id);
	}

	function get_tasks_information($p_id) {

		$query = $this->db->query("SELECT * FROM task WHERE project = $p_id");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function get_task_info($task_id) {

		$query = $this->db->query("SELECT * FROM task WHERE id = $task_id");

		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}
}

?>