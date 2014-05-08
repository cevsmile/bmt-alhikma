<?php

class Ctrl_identitas_bmt extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> validation();
		$this -> load -> model('mod_identitas_bmt');
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
*/
	public function update() {
		//debuggiing ci		echo "<pre>"; die(print_r($_POST, TRUE));
		if (!empty($_POST)) {
			$this -> mod_identitas_bmt -> update();
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
		   	$data = $this -> mod_identitas_bmt -> create();
			$data['recid']= $data['Kode_Cabang'];
			
			$res = Array();
			$res['status'] = 'success';
			$res['recid'] = $data['Kode_Cabang']; 
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

		$this -> mod_identitas_bmt -> delete($recid);
		$res = Array();
		$res['status'] = 'success';
		//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
		//$res['postData']= $_REQUEST;
		echo json_encode($res);
	}

	function tester() {
		$data = $this -> mod_identitas_bmt -> getAll();
		$newaray = Array();
		$sums = count($data);
		if ($sums==0){
			$newaray['status']  = 'error';
			$newaray['message'] = 'Data Masih Kosong';
			echo json_encode($newaray);		
		}else{
			$newaray['status'] = 'success';
			$newaray['total'] = $sums;
			$newaray['records'] = $data;
			for ($i = 0; $i < $sums; $i++) {
				$data[$i] -> recid = $data[$i]->Kode_Cabang;
			}
			echo json_encode($newaray);
		}
		//"<pre>"; die(print_r($data, TRUE));
	}

}// End of system area
