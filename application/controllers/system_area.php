<?php

class System_area extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> validation();
		$this->load->model( 'pegawai' );
	}

	function bmt_center() {
		$data['title'] = 'BMT System Home Page';
		$data['main_content'] = 'system_area/welcome';
		$this -> load -> view('system_area/temp/template', $data);
	}

	function validation() {
		$imlogin = $this -> session -> userdata('imlogin');

		if (!isset($imlogin) || $imlogin != TRUE) {
			redirect('site');
			// kick users butt :D
		}
	}

	function logout() {
		$this -> session -> sess_destroy();
		redirect('site');
	}

	public function getById($NIK) {
		if (isset($NIK))
			echo json_encode($this -> pegawai -> getById($NIK));
	}

	public function read() {
		echo json_encode($this -> pegawai -> getAll());
	}

}// End of system area
