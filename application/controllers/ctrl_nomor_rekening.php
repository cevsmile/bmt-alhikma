<?php

class Ctrl_nomor_rekening extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library("authentication");
		$this->authentication->validation();
		$this -> load -> model('mod_nomor_rekening');
	}

	function update() {
		if (!empty($_POST)) {
			$datalist = $this -> mod_nomor_rekening -> update();
			$res = Array();
			$res['status'] = 'success';
			$res['records'] = $datalist;
			$res['records']['Kode_Norek'] = $this->input->post( 'recid', true );
			$res['records']['selected'] = true;
			//echo "<pre>"; die(print_r($_POST, TRUE));
			echo json_encode($res);
		}
	}

	function create() {
		$term1 = $_POST['record']['Id_Nasabah'];
		$term2 = $_POST['record']['Id_Supplier'];
		$term3 = $_POST['record']['NIK'];
		if (!empty($term1) || !empty($term2) || !empty($term3)) {
		   	$data = $this -> mod_nomor_rekening -> create();
			$data['recid']= $data['Kode_Norek'];
			
			$res = Array();
			$res['status'] = 'success';
			$res['recid'] = $data['Kode_Norek']; 
			$res['records'] = $data; 
			echo json_encode($res);
		} else {
			$res = Array();
			$res['status']  = 'error';
			$res['message'] = 'Maaf, Data Terakhir belum di input, SIlakan Dilengkapi dulu.';
			echo json_encode($res);
		}
		
	}

	function create_daftar_akun() {
	   	$data = $this -> mod_nomor_rekening -> create();
		$data['recid']= $data['Kode_Norek'];
		$res = Array();
		$res['status'] = 'success';
		$res['recid'] = $data['Kode_Norek']; 
		$res['records'] = $data; 
		echo json_encode($res);
	}


	function delete($recid = null) {
		if (is_null($recid)) {
			echo 'ERROR: Id not provided.';
			return;
		}

		$this -> mod_nomor_rekening -> delete($recid);
		$res = Array();
		$res['status'] = 'success';
		echo json_encode($res);
	}

	function read() {
		$data = $this -> mod_nomor_rekening -> getAll();
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
	}

	function Qread() {
		$data = $this -> mod_nomor_rekening -> getQread();
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
				$data[$i] -> namagabungan = $data[$i]->NamaPegawai.$data[$i]->NamaNasabah.$data[$i]->NamaSupplier.$data[$i]->Keterangan;
			}
			$newaray['records'][] = Array('summary' => true, 'recid'=>'Keterangan', 'namagabungan'=>'<span style="float: right;">Total Rekening:</span>', 'Saldo_Awal'=>$sums);
			echo json_encode($newaray);
		}
			
	}

	public function cekNorek($norek) {
		$data = $this -> mod_nomor_rekening -> cekNorek($norek);
		$counter = $data + 1;
		$res = $norek.'.'.$counter;
		echo json_encode($res);
	}

	public function cekNorekDaftarAkun($norek) {
		$data = $this -> mod_nomor_rekening -> cekNorek($norek);
		echo json_encode($data);
	}


}// End of system area

//debugger :
//echo "<pre>"; die(print_r($res, TRUE));
