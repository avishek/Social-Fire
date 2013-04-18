<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_model extends CI_Model {

	function __construct() {

		parent::__construct();
		$this->load->model('activity_model', '', TRUE);
	}

	function get_file_info($project_id) {

		$query = $this->db->query("SELECT * FROM file_info WHERE project = $project_id");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function get_one_file_info($file_id) {

		$query = $this->db->query("SELECT * FROM file_info WHERE id = $file_id");

		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	function insert_file_info($data) {

		$this->db->insert('file_info', $data);

		$activity_data = array(
						'project' => $data['project'],
						'user' => $data['user'],
						'subject' => "file",
						'subject_name' => $data['name'],
						'type' => 1  
						);
		$this->activity_model->insert_activity($activity_data);
	}

	function delete_file_info($file_id, $user) {

		$file_details = $this->get_one_file_info($file_id);
		$this->db->where('id', $file_id)->delete('file_info');

		$activity_data = array(
						'project' => $file_details->project,
						'user' => $user,
						'subject' => "file",
						'subject_name' => $file_details->name,
						'type' => 3  
						);
		$this->activity_model->insert_activity($activity_data);
	}
}

?>