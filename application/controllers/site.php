<?php

class Site extends CI_Controller{

	function index() {
		$data['title'] = 'Wellcome';		
		$data['main_content'] = 'public/wellcome';		
		$this->load->view('public/temp/template', $data);
	}
	
	function validasi(){
		$this->load->model('user_model');
		$query = $this->user_model->check_user();
		
		if($query) // jika user tervalidasi...
		{
			$data = array(
				'nama' => $this->input->post('nama'),
				'approved' => true
			);
			
			$this->session->set_userdata($data); //save data to session
			redirect('members_area/members_area'); // redirect user to members area page.
		}
		else 
		{
			$this->index(); // redirect user bact to index function above.
		}
		
	}

	
}
	