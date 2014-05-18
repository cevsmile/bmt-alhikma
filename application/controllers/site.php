<?php

class Site extends CI_Controller {

	function index() {
		$this -> load -> model('installation');
		$query = $this -> installation -> first_time_use();

		if ($query)// if return true than use installation folder
		{
			$data['title'] = 'Set Up For The First Time';
			$data['main_content'] = 'installation/registration';
			$this -> load -> view('installation/temp/template', $data);
		} else {
			$data['title'] = 'BMT Al-Hikma';
			$data['main_content'] = 'public/welcome';
			$this -> load -> view('public/temp/template', $data);
		}
	}

	// Delete This Code if you already set up the application
	function first_installation() {
		$this -> load -> model('installation');
		$query = $this -> installation -> add_user();
		redirect('');
	}// end of first_installation function

	

	function validate() {
		$this -> load -> model('system_area');
		
		$query = $this -> system_area -> check_user();
		//echo $query;
		
		if ($query)// if data were found..
		{
			$data = array(
				'username' => $this -> input -> post('username'), 
				'imlogin' => true
			);

			$this -> session -> set_userdata($data);
			//saving data to session
			redirect('system_area/bmt_center');
			// and redirect user to bmtsystem_area menu.
		} else {
			redirect('');
			//$this -> index();
			// if not validate than kick user butt.
		}

	}

}

// end of Site controller
