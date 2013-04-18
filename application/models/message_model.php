<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model {

	function __construct() {

		parent::__construct();
	}

	function insert($data) {

		$this->db->insert('message', $data);
	}

	function delete($u_id, $msg_id) {

		$query = $this->db->query("UPDATE message SET status = 1 WHERE id = $msg_id AND from_user_id = $u_id AND status = 0");
		$query = $this->db->query("UPDATE message SET status = 3 WHERE id = $msg_id AND from_user_id = $u_id AND status = 2");

		$query = $this->db->query("UPDATE message SET status = 2 WHERE id = $msg_id AND to_user_id = $u_id AND status = 0");
		$query = $this->db->query("UPDATE message SET status = 3 WHERE id = $msg_id AND to_user_id = $u_id AND status = 1");

		$query = $this->db->query("DELETE FROM message WHERE id = $msg_id AND status = 3");
	}

	function get_all_inbox($user_id) {

		$query = $this->db->query("SELECT user.id AS id, name, message.id AS message_id,
		 from_user_id, to_user_id, subject, content, date_time
		 FROM message, user WHERE user.id = message.from_user_id AND message.to_user_id = $user_id AND status IN (0, 1) ORDER BY message.date_time DESC");	

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function get_all_sent($user_id) {

		$query = $this->db->query("SELECT user.id AS id, name, message.id AS message_id,
		 from_user_id, to_user_id, subject, content, date_time
		 FROM message, user WHERE user.id = message.to_user_id AND message.from_user_id = $user_id AND status IN (0, 2) ORDER BY message.date_time DESC");

		if($query) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function get($msg_id) {

		$query = $this->db->from('message')->where('id', $msg_id)->get();
		
		if($query) {
			return $query;
		} else {
			return FALSE;
		}
	}
}

?>