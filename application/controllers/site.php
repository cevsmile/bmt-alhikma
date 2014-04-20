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

	function site_first_installation(){
		
	} // end of site_first_installation function
	
	
	function validasi() {
		$this -> load -> model('user_model');
		$query = $this -> user_model -> check_user();

		if ($query)// jika user tervalidasi...
		{
			$data = array('Username' => $this -> input -> post('Username'), 'approved' => true);

			$this -> session -> set_userdata($data);
			//save data to session
			redirect('members_area/members_area');
			// redirect user to members area page.
		} else {
			$this -> index();
			// redirect user bact to index function above.
		}

	}

}
