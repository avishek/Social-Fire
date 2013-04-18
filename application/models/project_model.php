<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model {

	function __construct() {

		parent::__construct();
		$this->load->model('setting_model', '', TRUE);
		$this->load->model('activity_model', '', TRUE);
	}

	function insert_project($data) {

		$this->db->insert('project', $data);

		$query = $this->db->query("SELECT id FROM project WHERE name = '".$data['name']."'");
		if($query->num_rows() > 0) {
			$row = $query->row();

			$r_data = array(
						'user' => $data['creator_id'],
						'project' => $row->id,
						'role' => 1 
						);
			$this->setting_model->insert_role($r_data);
		}

		$project_info = $this->get_by_name($data['name']);
		$activity_data = array(
						'project' => $project_info->id,
						'user' => $data['creator_id'],
						'subject' => "project",
						'subject_name' => $project_info->name,
						'type' => 1  
						);
		$this->activity_model->insert_activity($activity_data);
	}

	function update_project($data, $p_id) {

		$activity_data = array(
						'project' => $p_id,
						'user' => $data['creator_id'],
						'subject' => "project",
						'subject_name' => $data['name'],
						'type' => 2  
						);
		$this->activity_model->insert_activity($activity_data);

		$this->db->where('id', $p_id);
		$this->db->update('project', $data);
	}

	function get_all($user_id) {

		$query = $this->db->query("SELECT project.id AS id, name, start, end, project.desc AS description, status
		 FROM project, setting WHERE project.id = setting.project AND setting.user = $user_id ORDER BY status ASC");	

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function get($id) {

		$query = $this->db->query("SELECT * FROM project WHERE id = $id");
		
		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	function get_by_name($name) {

		$query = $this->db->query("SELECT * FROM project WHERE name = $name");
		
		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}
}

?>