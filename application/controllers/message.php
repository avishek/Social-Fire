<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_COntroller {

	function __construct() {

		parent::__construct();
		$this->load->model('message_model', '', TRUE);
		$this->load->model('friend_model', '', TRUE);
	}

	function index() {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$result = $this->friend_model->load($s_data['id']);
			$ans = array();
			if($result) {
				$x = 0;
				foreach ($result as $row) {
					
					$ans[$x] = array(
							'id' => $row->id,
							'name' => $row->name,
							'matric' => $row->matric,
							'email' => $row->email,
							'friends' => 1 
						);
					$x++;
				}
			}

			$message_inbox = $this->message_model->get_all_inbox($s_data['id']);
			$m = array();
			if($message_inbox) {
				$x = 0;
				foreach ($message_inbox as $row) {
					
					$m[$x] = array(
								'id' => $row->message_id,
								'from_user_id' => $row->from_user_id,
								'name' => $row->name,
								'subject' => $row->subject,
								'content' => $row->content,
								'date_time' =>$row->date_time 
								);
					$x++;
				}
			}

			$data = array('friends' => $ans, 'inbox' => $m);

			$this->load->view('header_view', $s_data);
			$this->load->view('message_inbox_view', $data);
			$this->load->view('footer_view');
		} else {

			redirect('home', 'refresh');
		}
	}

	function sent() {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$result = $this->friend_model->load($s_data['id']);
			$ans = array();
			
			if($result) {
				$x = 0;
				foreach ($result as $row) {
					
					$ans[$x] = array(
							'id' => $row->id,
							'name' => $row->name,
							'matric' => $row->matric,
							'email' => $row->email,
							'friends' => 1 
						);
					$x++;
				}
			}

			$message_sent = $this->message_model->get_all_sent($s_data['id']);
			$m = array();
			if($message_sent) {
				$x = 0;
				foreach ($message_sent as $row) {
					
					$m[$x] = array(
								'id' => $row->message_id,
								'to_user_id' => $row->to_user_id,
								'name' => $row->name,
								'subject' => $row->subject,
								'content' => $row->content,
								'date_time' =>$row->date_time 
								);
					$x++;
				}
			}

			$data = array('friends' => $ans, 'sent' => $m);

			$this->load->view('header_view', $s_data);
			$this->load->view('message_sent_view', $data);
			$this->load->view('footer_view');
		} else {

			redirect('home', 'refresh');
		}
	}

	function compose() {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$this->load->library('form_validation');
			$this->form_validation->set_rules('content', 'Content', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE) {
				redirect('message', 'refresh');
			} else {	
				$data = array(
							'from_user_id' => $s_data['id'],
							'to_user_id' => $this->input->post('to_user'),
							'subject' => $this->input->post('subject'),
							'content' => $this->input->post('content') 
							);

				$this->message_model->insert($data);
				redirect('message', 'refresh');
			}
		} else {
			redirect('home', 'refresh');
		}
	}

	function delete($id) {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$this->message_model->delete($s_data['id'], $id);
			redirect('message', 'refresh');
		} else {
			redirect('home', 'refresh');
		}
	}
}

?>