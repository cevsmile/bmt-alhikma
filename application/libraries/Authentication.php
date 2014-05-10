<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Authentication {

	public function validation() {
		$CI =& get_instance();
		$imlogin = $CI -> session -> userdata('imlogin');

		if (!isset($imlogin) || $imlogin != TRUE) {
			redirect('site');
			// kick users butt :D
		}
	}

	public function logout() {
		$CI =& get_instance();
		$CI -> session -> sess_destroy();
		redirect('site');
	}

}
