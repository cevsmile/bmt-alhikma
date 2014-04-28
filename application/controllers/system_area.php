<?php

class System_area extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> validation();
		$this -> load -> model('pegawai');
	}

	function bmt_center() {
		$data['title'] = 'BMT System Home Page';
		$data['main_content'] = 'system_area/welcome';
		$this -> load -> view('system_area/temp/template', $data);
	}

	function menu_pegawai() {
		$data['title'] = 'BMT System Home Page';
		$data['main_content'] = 'system_area/menu_pegawai/pegawai';
		$this -> load -> view('system_area/temp/template', $data);
	}

	function menu_tester() {
		$data['title'] = 'BMT System Home Page';
		$data['main_content'] = 'system_area/menu_tester/tester';
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

	function read() {
		echo json_encode($this -> pegawai -> getAll());
	}

	function getByRecid($recid) {
		if (isset($recid))
			echo json_encode($this -> pegawai -> getByRecid($recid));
	}
	
	public function update() {
		$arr = $_POST;
		print_r($arr);
		//Uraikan data yang dikirim AJAX
		$nama     = $arr['record']['nama'];
		$alamat   = $arr['record']['alamat'];
		$username = $arr['record']['username'];


		//$data = $this->input->post( 'record[Alamat]', true );
//debuggiing ci		echo "<pre>"; die(print_r($_POST, TRUE));
		echo "<pre>"; die(print_r($nama, TRUE));
		if( !empty( $_POST ) ) {
			$this->pegawai->update();
			echo json_encode('Record updated successfully!');
		}
	}

}// End of system area
