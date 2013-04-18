<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('file_model', '', TRUE);
	}

	function do_upload() {

		$s_data = $this->session->userdata('logged_in');

		if($s_data) {

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|png|jpg|jpeg';
			$config['max_size'] = '50000';

			$project_id = $this->input->post('projectId');

			$this->load->library('upload', $config);

			if(! $this->upload->do_upload()) {
				
				$error = array('error' => $this->upload->display_errors());
				print_r($error);

				redirect('project/main/'.$project_id, 'refresh');
			} else {

				$file_data = $this->upload->data();

				$data = array(
					'project' => $project_id,
					'user' => $s_data['id'],
					'name' => $file_data['file_name'],
					'size' => $file_data['file_size'],
					'type' => $file_data['file_type'] 
					);

				//Insert data in the table
				$this->file_model->insert_file_info($data);

				redirect('project/main/'.$project_id, 'refresh');
			}
		} else {
			redirect('home', 'refresh');	
		}
	}

	public function deleteFile($file_id) {

		$s_data = $this->session->userdata('logged_in');

		$file_details = $this->file_model->get_one_file_info($file_id);
		$success =unlink(FCPATH.'uploads/' .$file_details->name);
		$this->file_model->delete_file_info($file_id, $s_data['id']);

		redirect('project/main/'.$file_details->project, 'refresh');	  	
	}
}

?>