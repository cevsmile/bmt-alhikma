<?php

class Ctrl_nasabah extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library("authentication");
		$this->authentication->validation();
		$this -> load -> model('mod_nasabah');
	}

	function update() {
		//debuggiing ci		echo "<pre>"; die(print_r($_POST, TRUE));
		if (!empty($_POST)) {
			$data = $this -> mod_nasabah -> update();
			$res = Array();
			$res['status'] = 'success';
			$res['records'] = $data;
			$res['records']['Tanggal_Masuk'] = date('m/d/Y', strtotime($data['Tanggal_Masuk']));
			$res['records']['Tanggal_Keluar'] = date('m/d/Y', strtotime($data['Tanggal_Keluar']));
			$res['records']['Id_Nasabah'] = $this->input->post( 'recid', true );
			$res['records']['selected'] = true;
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			echo json_encode($res);
		}
	}

	function create() {
		if (!empty($_POST)) {
		   	$data = $this -> mod_nasabah -> create();
			$data['recid']= $data['Id_Nasabah'];
			$res = Array();
			$res['status'] = 'success';
			$res['recid'] = $data['Id_Nasabah']; 
			$res['records'] = $data; 
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			//echo "<pre>"; die(print_r($data, TRUE));
			echo json_encode($res);
		}
	}

	function delete($recid = null) {
		if (is_null($recid)) {
			echo 'ERROR: Id not provided.';
			return;
		}

		$this -> mod_nasabah -> delete($recid);
		$res = Array();
		$res['status'] = 'success';
		//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
		//$res['postData']= $_REQUEST;
		echo json_encode($res);
	}

	function read() {
		$data = $this -> mod_nasabah -> getAll();
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
				$data[$i] -> recid = $data[$i]->Id_Nasabah;
				$data[$i] -> Tanggal_Masuk = date('m/d/Y', strtotime($data[$i]->Tanggal_Masuk));
				$data[$i] -> Tanggal_Keluar = date('m/d/Y', strtotime($data[$i]->Tanggal_Keluar));
			}
			echo json_encode($newaray);
		}
		//"<pre>"; die(print_r($data, TRUE));
	}


}// End of system area
