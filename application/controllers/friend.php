<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('friend_model', '', TRUE);
	}

	function index() {

		$s_data = $this->session->userdata('logged_in');
		$ans = array();

		if($s_data) {

			$result = $this->friend_model->load($s_data['id']);
			
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

			$data = array('result' => $ans );

			$this->load->view('header_view', $s_data);
			$this->load->view('friends_view', $data);
			$this->load->view('footer_view');
		} else {
			redirect('home', 'refresh');
		}
	}

	function search() {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$opt = $this->input->post('opt');
			$ans = array();
			
			switch ($opt) {
				case 1:
					$result = $this->friend_model->load_all($s_data['id']);					
					break;
				case 2:
					$result = $this->friend_model->load_name($s_data['id'], $this->input->post('name'));
					break;
				case 3:
					$result = $this->friend_model->load_email($s_data['id'], $this->input->post('email'));
					break;
				case 4:
					$result = $this->friend_model->load_matric($s_data['id'], $this->input->post('matric'));
					break;
			}

			$ids = $this->friend_model->get_friend_ids($s_data['id']);

			$x = 0;
			foreach ($result as $row) {
				
				$state = FALSE;
				if($ids) {
					foreach ($ids as $r) {
						if($row->id == $r->friend_id) {
							$state = TRUE;	
						}
					}
				}

				if($state == TRUE) {		
					$ans[$x] = array(
							'id' => $row->id,
							'name' => $row->name,
							'matric' => $row->matric,
							'email' => $row->email,
							'friends' => 1 
						);
					$x++;
				} else {
					$ans[$x] = array(
							'id' => $row->id,
							'name' => $row->name,
							'matric' => $row->matric,
							'email' => $row->email,
							'friends' => 0 
						);
					$x++;
				}
			}

			$data = array('result' => $ans );
			$this->load->view('header_view', $s_data);
			$this->load->view('friends_view', $data);
			$this->load->view('footer_view');			
			
		} else {
			redirect('home', 'refresh');
		}
	}

	function add($id) {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {
			
			$d = array(
					'id' => $s_data['id'],
					'friend_id' => $id
					 );
			$this->friend_model->insert($d);
			redirect('friend', 'refresh');
		} else {
			redirect('home', 'refresh');
		}
	}

	function delete($id) {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {
			
			$this->friend_model->delete($s_data['id'], $id);
			redirect('friend', 'refresh');
		} else {
			redirect('home', 'refresh');
		}
	}
}

?>