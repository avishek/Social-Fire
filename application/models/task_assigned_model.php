<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_assigned_model extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	function insert_assigned_task($data) {

		$this->db->insert('task_assigned', $data);
	}

	function get_assigned_to($t_id) {

		$query = $this->db->query("SELECT * FROM task_assigned WHERE task = $t_id");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function delete($task_id) {

		$this->db->where('task', $task_id);
		$this->db->delete('task_assigned');
	}
}
