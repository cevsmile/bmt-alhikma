<?php

class Ctrl_pegawai extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library("authentication");
		$this->authentication->validation();
		$this -> load -> model('mod_pegawai');
	}

	function update() {
		//debuggiing ci		echo "<pre>"; die(print_r($_POST, TRUE));
		if (!empty($_POST)) {
			$data = $this -> mod_pegawai -> update();
			$res = Array();
			$res['status'] = 'success';
			$res['records'] = $data;
			$res['records']['Tanggal_Masuk'] = date('m/d/Y', strtotime($data['Tanggal_Masuk']));
			$res['records']['Tanggal_Keluar'] = date('m/d/Y', strtotime($data['Tanggal_Keluar']));
			$res['records']['selected'] = true;
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			echo json_encode($res);
		}
	}

	function create() {
		if (!empty($_POST)) {
		   	$data = $this -> mod_pegawai -> create();
			$data['recid']= $data['NIK'];
			$res = Array();
			$res['status'] = 'success';
			$res['recid'] = $data['NIK']; 
			$res['records'] = $data; 
			$res['records']['Tanggal_Masuk'] = date('m/d/Y', strtotime($data['Tanggal_Masuk']));
			$res['records']['Tanggal_Keluar'] = date('m/d/Y', strtotime($data['Tanggal_Keluar']));
			$res['records']['selected'] = true;
			echo json_encode($res);
		}
	}

	function delete($recid = null) {
		if (is_null($recid)) {
			echo 'ERROR: Id not provided.';
			return;
		}

		$this -> mod_pegawai -> delete($recid);
		$res = Array();
		$res['status'] = 'success';
		//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
		//$res['postData']= $_REQUEST;
		echo json_encode($res);
	}

	function read() {
		$data = $this -> mod_pegawai -> getAll();
		$res = Array();
		$sums = count($data);
		if ($sums==0){
			$res['status']  = 'error';
			$res['message'] = 'Data Masih Kosong';
			echo json_encode($res);		
		}else{
			$res['status'] = 'success';
			$res['total'] = $sums;
			$res['records'] = $data;
			for ($i = 0; $i < $sums; $i++) {
				$data[$i] -> recid = $data[$i]->NIK;
				
				if ( $data[$i] -> Tanggal_Masuk  != ""){
					$data[$i] -> Tanggal_Masuk = date('m/d/Y', strtotime($data[$i]->Tanggal_Masuk));
				}

				if ( $data[$i] -> Tanggal_Keluar  != ""){
					$data[$i] -> Tanggal_Keluar = date('m/d/Y', strtotime($data[$i]->Tanggal_Keluar));
				}

			}
			echo json_encode($res);
		}
		//"<pre>"; die(print_r($data, TRUE));
	}

}// End of system area
