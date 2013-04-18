<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity_model extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	function insert_activity($data) {

		$this->db->insert('activity', $data);
	}

	function get_activities($project_id) {

		$query = $this->db->query("SELECT * FROM activity WHERE project = $project_id ORDER BY date_time DESC");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}
}

?>