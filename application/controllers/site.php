<?php

class Site extends CI_Controller {

	function index() {
		$this ->load -> model ('user_model');
		$query = $this -> user_model -> first_time_use();

		if ($query)// if return true than use installation folder
			{
				$data['title'] = 'Set Up For The First Time';
				$data['main_content'] = 'installation/registration';
				$this -> load -> view('installation/temp/template', $data);
			} else {
				$data['title'] = 'Wellcome';
				$data['main_content'] = 'public/wellcome';
				$this -> load -> view('public/temp/template', $data);
		}		
	}

// Delete This Code if you already set up the application
	function first_installation(){
		$this -> load -> model('installation');
		$query = $this -> installation -> add_pegawai();
		redirect('');
	} // end of first_installation function
//====================End Of Delete========================================	

	function validate(){
		$this->load->model('bmtsystem_area');
		$query = $this->bmtsystem_area->check_user();
		
		if($query) // if data were found..
		{
			$data = array(
				'nama' => $this->input->post('nama'),
				'imlogin' => true
			);
			
			$this->session->set_userdata($data); //saving data to session
			redirect('bmtsystem_area/bmtsystem_area'); // and redirect user to bmtsystem_area menu.
		}
		else 
		{
			$this -> session -> sess_destroy();
			$this->index(); // if not validate than kick user butt.
		}
		
	}



}// end of Site controller
