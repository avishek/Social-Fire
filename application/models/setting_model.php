<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	function insert_role($data) {

		$this->db->insert('setting', $data);
	}

	function update_setting($data, $p_id) {

		$this->db->query("DELETE FROM setting WHERE project = $p_id");
		$this->db->insert_batch('setting', $data);
	}

	function get_contributors($p_id) {

		$query = $this->db->query("SELECT * FROM setting WHERE project = $p_id");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function get_projects($user) {

		$query = $this->db->query("SELECT * FROM setting WHERE user = $user");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}	
	}
}

?>