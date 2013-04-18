<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend_model extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	function load_all($id) {

		$this->db->select('*')->from('user')->where('id !=', $id);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function load_name($id, $name) {

		$this->db->select('*')->from('user')->where('id !=', $id)->like('name', $name);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return FALSE;
		}	
	}

	function load_email($id, $email) {

		$this->db->select('*')->from('user')->where('id !=', $id)->like('email', $email);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return FALSE;
		}	
	}

	function load_matric($id, $matric) {

		$this->db->select('*')->from('user')->where('id !=', $id)->like('matric', $matric);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return FALSE;
		}	
	}

	function load($id) {

		$this->db->from('friend')->join('user', 'user.id = friend.friend_id')->where('friend.id', $id);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function get_friend_ids($id) {

		$this->db->select('friend_id')->from('friend')->where('id', $id);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function insert($data) {

		$this->db->insert('friend', $data);
	}

	function delete($my_id, $f_id) {

		$this->db->where('id', $my_id)->where('friend_id', $f_id)->delete('friend');
	}
}

?>