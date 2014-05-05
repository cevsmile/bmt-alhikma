<?php

class System_area extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> validation();
		$this -> load -> model('mod_pegawai');
	}

	function bmt_center() {
		$data['title'] = 'BMT System Home Page';
		$data['main_content'] = 'system_area/welcome';
		$this -> load -> view('system_area/vf_temp/vff_template', $data);
	}

	function menu_system_application() {
		$data['title'] = 'BMT System Application';
		$data['main_content'] = 'system_area/vf_system_application/vff_system_application';
		$this -> load -> view('system_area/vf_temp/vff_template', $data);
	}

	function menu_tester() {
		$data['title'] = 'BMT System Home Page';
		$data['main_content'] = 'system_area/menu_tester/tester';
		$this -> load -> view('system_area/vf_temp/vff_template', $data);
	}

	function menu_testing() {
		$data['title'] = 'BMT System Home Page';
		$data['main_content'] = 'system_area/testing/tester';
		$this -> load -> view('system_area/vf_temp/vff_template', $data);
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





/*
	function read() {
		echo json_encode($this -> pegawai -> getAll());
	}

	function getByRecid($recid) {
		if (isset($recid))
			echo json_encode($this -> pegawai -> getByRecid($recid));
	}

	public function update() {
		//debuggiing ci		echo "<pre>"; die(print_r($_POST, TRUE));
		if (!empty($_POST)) {
			$this -> pegawai -> update();
			$res = Array();
			$res['status'] = 'success';
			$res['records'] = $_REQUEST['record'];
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			echo json_encode($res);
		}
	}

	public function create() {
		if (!empty($_POST)) {
		   	$data = $this -> pegawai -> create();
			$data['recid']= $data['NIK'];
			
			$res = Array();
			$res['status'] = 'success';
			$res['recid'] = $data['NIK']; 
			//$res['total'] = intval($data['NIK']) + 1;
			$res['records'] = $data; 
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			//echo "<pre>"; die(print_r($res, TRUE));
			echo json_encode($res);
		}
	}

	public function delete($recid = null) {
		if (is_null($recid)) {
			echo 'ERROR: Id not provided.';
			return;
		}

		$this -> pegawai -> delete($recid);
		$res = Array();
		$res['status'] = 'success';
		//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
		//$res['postData']= $_REQUEST;
		echo json_encode($res);
	}

	function tester() {
		$data = $this -> pegawai -> getAll();
		$newaray = Array();
		$sums = count($data);
		$newaray['status'] = 'success';
		$newaray['total'] = $sums;
		$newaray['records'] = $data;
		for ($i = 0; $i < $sums; $i++) {
			$data[$i] -> recid = $data[$i]->NIK;
		}
		echo json_encode($newaray);
		//"<pre>"; die(print_r($data, TRUE));
	}
*/
}// End of system area