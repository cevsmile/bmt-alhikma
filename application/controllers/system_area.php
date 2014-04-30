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
	//debuggiing ci		echo "<pre>"; die(print_r($_POST, TRUE));
		if( !empty( $_POST ) ) {
			$this->pegawai->update();
			$res = Array();
			$res['status']  = 'success';
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			echo json_encode($res);
		}

	}

	public function create() {
		if( !empty( $_POST ) ) {
			$this->pegawai->create();
			$res = Array();
			$res['status']  = 'success';
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			echo json_encode($res);
		}
	}



	public function tester_read(){
		$data['records']=$this->pegawai->getAll();

		//$data['records']= 'recid';
		echo json_encode($data);		
	}


}// End of system area
