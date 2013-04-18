<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	function insert_user($data) {

		$this->db->insert('user', $data);
	}

	function login($email, $password) {
		
		$this->db->from('user')->where('email', $email)->where('password', $password)->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function update_user($data, $id) {

		$this->db->where('id', $id)->update('user', $data);
	}

	function get_user($user_id) {

		$query = $this->db->query("SELECT * FROM user WHERE id = $user_id");

		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}

	function get_all($u_id) {

		$query = $this->db->query("SELECT * FROM user");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}
}

?>