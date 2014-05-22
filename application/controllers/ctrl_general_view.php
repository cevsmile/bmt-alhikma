<?php

class Ctrl_general_view extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library("authentication");
		$this->authentication->validation();
		$this -> load -> model('mod_general_view');
	}


	function get_det_rek_nasabah() {
		$data = $this -> mod_general_view -> get_det_rek_nasabah();
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
				$data[$i] -> recid = $data[$i]->Kode_Norek;
			}
			echo json_encode($res);
		}
		//"<pre>"; die(print_r($data, TRUE));
	}

	function get_det_rek_nasabah2() {
		$data = $this -> mod_general_view -> get_det_rek_nasabah2();
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
				$data[$i] -> recid = $data[$i]->Kode_Norek;
			}
			echo json_encode($res);
		}
		//"<pre>"; die(print_r($data, TRUE));
	}

}// End of system area
