<?php

class Ctrl_supplier extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library("authentication");
		$this->authentication->validation();
		$this -> load -> model('mod_supplier');
	}

	function update() {
		//debuggiing ci		echo "<pre>"; die(print_r($_POST, TRUE));
		if (!empty($_POST)) {
			$this -> mod_supplier -> update();
			$res = Array();
			$res['status'] = 'success';
			$res['records'] = $_REQUEST['record'];
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			echo json_encode($res);
		}
	}

	function create() {
		if (!empty($_POST)) {
		   	$data = $this -> mod_supplier -> create();
			$data['recid']= $data['Id_Supplier'];
			
			$res = Array();
			$res['status'] = 'success';
			$res['recid'] = $data['Id_Supplier']; 
			//$res['total'] = intval($data['NIK']) + 1;
			$res['records'] = $data; 
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			//echo "<pre>"; die(print_r($res, TRUE));
			echo json_encode($res);
		}
	}

	function delete($recid = null) {
		if (is_null($recid)) {
			echo 'ERROR: Id not provided.';
			return;
		}

		$this -> mod_supplier -> delete($recid);
		$res = Array();
		$res['status'] = 'success';
		//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
		//$res['postData']= $_REQUEST;
		echo json_encode($res);
	}

	function read() {
		$data = $this -> mod_supplier -> getAll();
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
				$data[$i] -> recid = $data[$i]->Id_Supplier;
			}
			echo json_encode($newaray);
		}
		//"<pre>"; die(print_r($data, TRUE));
	}

	function getLastRec() {
		$data = $this -> mod_supplier -> getLastRec();
		$res = $data + 1;
		echo json_encode($res);
	}

}// End of system area
