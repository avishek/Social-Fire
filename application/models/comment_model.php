<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	function insert_comment($data) {

		$this->db->insert('comment', $data);
	}

	function get_comments($activity_id) {

		$query = $this->db->query("SELECT * FROM comment WHERE activity = $activity_id ORDER BY date_time ASC");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}
}

?>