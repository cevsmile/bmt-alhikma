<?php

class Ctrl_kas extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library("authentication");
		$this->authentication->validation();
		$this -> load -> model('mod_kas');
	}

	function update() {
		if (!empty($_POST)) {
			$datalist = $this -> mod_kas -> update();
			$res = Array();
			$res['status'] = 'success';
			$res['records'] = $datalist;
			$res['records']['Kode_Norek'] = $this->input->post( 'recid', true );
/*			

			if ( $datalist["Log_Date"] != null){
				$res['records']['Log_Date'] = date('m/d/Y', strtotime($datalist['Log_Date']));
			} else {
				$res['records']['Log_Date'] = "";
			}
*/
			$res['records']['selected'] = true;
			//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
			//$res['postData']= $_REQUEST;
			//echo "<pre>"; die(print_r($_POST, TRUE));
			echo json_encode($res);
		}
	}

	function create() {
		//echo "<pre>"; die(print_r($_POST, TRUE));
		if (!empty($_POST)) {
		   	$data = $this -> mod_kas -> create();
			$data['recid']= $data['Kode_Norek'];
			
			$res = Array();
			$res['status'] = 'success';
			$res['recid'] = $data['Kode_Norek']; 
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

		$this -> mod_kas -> delete($recid);
		$res = Array();
		$res['status'] = 'success';
		//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
		//$res['postData']= $_REQUEST;
		echo json_encode($res);
	}

	function read() {
		$data = $this -> mod_kas -> getAll();
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
				$data[$i] -> recid = $data[$i]->Kode_Norek;
			}
			echo json_encode($newaray);
		}
		//"<pre>"; die(print_r($data, TRUE));
	}
}// End of system area