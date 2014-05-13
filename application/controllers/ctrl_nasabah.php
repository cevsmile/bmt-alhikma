<?php

class Ctrl_nasabah extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library("authentication");
		$this->authentication->validation();
		$this -> load -> model('mod_nasabah');
	}

	function update() {
		if (!empty($_POST)) {
			$datalist = $this -> mod_nasabah -> update();
			$res = Array();
			$res['status'] = 'success';
			$res['records'] = $datalist;
			$res['records']['Id_Nasabah'] = $this->input->post( 'recid', true );
			
			if ( $datalist["Tanggal_Masuk"] != null){
				$res['records']['Tanggal_Masuk'] = date('m/d/Y', strtotime($datalist['Tanggal_Masuk']));
			} else {
				$res['records']['Tanggal_Masuk'] = "";
			}
			
			if ( $datalist["Tanggal_Keluar"] != null){
				$res['records']['Tanggal_Keluar'] = date('m/d/Y', strtotime($datalist['Tanggal_Keluar']));
			} else {
				$res['records']['Tanggal_Keluar'] = "";
			}	

			$res['records']['selected'] = true;
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			//echo "<pre>"; die(print_r($_POST, TRUE));
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
			
			if ( $data["Tanggal_Masuk"] != ""){
				$res['records']['Tanggal_Masuk'] = date('m/d/Y', strtotime($data['Tanggal_Masuk']));
			}
			
			if ( $data["Tanggal_Keluar"] != ""){
				$res['records']['Tanggal_Keluar'] = date('m/d/Y', strtotime($data['Tanggal_Keluar']));
			}			
				
			$res['records']['selected'] = true;
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
				$data[$i] -> recid = $data[$i]->Id_Nasabah;
				if ( $data[$i] -> Tanggal_Masuk  != "") 
					 $data[$i] -> Tanggal_Masuk = date('m/d/Y', strtotime($data[$i]->Tanggal_Masuk));
				if ( $data[$i] -> Tanggal_Keluar  != "") 
					 $data[$i] -> Tanggal_Keluar = date('m/d/Y', strtotime($data[$i]->Tanggal_Keluar));
			}
			echo json_encode($res);
		}
		//"<pre>"; die(print_r($data, TRUE));
	}



}// End of system area
