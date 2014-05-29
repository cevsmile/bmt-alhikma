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
		//echo "<pre>"; die(print_r($_POST['record']['Kode_Cabang'], TRUE));
		$term1 = $_POST['record']['Id_Nasabah'];
		$term2 = $_POST['record']['Id_Supplier'];
		$term3 = $_POST['record']['NIK'];
		if (!empty($term1) || !empty($term2) || !empty($term3)) {
		   	$data = $this -> mod_nomor_rekening -> create();
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
		} else {
			$res = Array();
			$res['status']  = 'error';
			$res['message'] = 'Maaf, Data Terakhir belum di input, SIlakan Dilengkapi dulu.';
			echo json_encode($res);			
		}
		
//		echo "<pre>"; die(print_r($hasil, TRUE));
		
/*		
		if (!empty($_POST)) {
		   	$data = $this -> mod_nomor_rekening -> create();
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
 * 
 */
	}

	function delete($recid = null) {
		if (is_null($recid)) {
			echo 'ERROR: Id not provided.';
			return;
		}

		$this -> mod_nomor_rekening -> delete($recid);
		$res = Array();
		$res['status'] = 'success';
		//$res['message'] = 'Command "'.$_REQUEST['cmd'].'" is not recognized.';
		//$res['postData']= $_REQUEST;
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
		//$sumdata = $this -> mod_nomor_rekening -> getSumKas();
		$newaray = Array();
		$sums = count($data);
		if ($sums==0){
			$newaray['status']  = 'error';
			$newaray['message'] = 'Data Masih Kosong';
			echo json_encode($newaray);		
/*			
			$rekening_neraca_saldo = $this -> mod_nomor_rekening -> get_neraca_saldo();
			$sum_rekening_neraca_saldo = count($rekening_neraca_saldo);
			//echo "<pre>"; die(print_r($rekening_neraca_saldo, TRUE));

			if (!empty($rekening_neraca_saldo)) {
			   	$data = $this -> mod_nomor_rekening -> create_neraca_saldo($rekening_neraca_saldo, $sum_rekening_neraca_saldo);
			}else{
				$newaray['status']  = 'error';
				$newaray['message'] = 'Data Masih Kosong, Mohon untuk mengisi Daftar Akun Terlebih Dahulu!';
				echo json_encode($newaray);		
			}		
*/

		}else{
			$newaray['status'] = 'success';
			$newaray['total'] = $sums;
			
			$newaray['records'] = $data;
			for ($i = 0; $i < $sums; $i++) {
				$data[$i] -> recid = $data[$i]->Kode_Norek;
				$data[$i] -> namagabungan = $data[$i]->NamaPegawai.$data[$i]->NamaNasabah.$data[$i]->NamaSupplier;
			}
			$newaray['records'][] = Array('summary' => true, 'recid'=>'Keterangan', 'namagabungan'=>'<span style="float: right;">Total Rekening:</span>', 'Saldo_Awal'=>$sums);
			//$newaray['records'][] = Array('summary' => true, 'recid'=>'S-2', 'Id_Daftar_Akun_Kredit'=>'<span style="float: right;">Saldo:</span>', 'Jumlah_Debit'=>$sumdata[0]->GrandTotal);
			
			//echo "<pre>"; die(print_r($newaray, TRUE));
			echo json_encode($newaray);
		}
			
	}

	public function cekNorek($norek) {
		$data = $this -> mod_nomor_rekening -> cekNorek($norek);
		$counter = $data + 1;
		$res = $norek.'.'.$counter;
		//echo "<pre>"; die(print_r($res, TRUE));
		echo json_encode($res);
	}




}// End of system area
