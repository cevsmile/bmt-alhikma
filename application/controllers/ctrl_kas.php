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
			$res 					= Array();
			$data 					= $this->input->post("record", TRUE);
			$data_nomor_rekening 	= $this -> mod_kas -> get_data_nomor_rekening($data['Kode_Norek']);
			$jml_saldo 				= $data_nomor_rekening->Saldo_Akhir;
			$jml_tarik				= $data["Jumlah"];
			$jml_tabungan			= $data["Jumlah"];

			// if tarik tunai 
			if ($data["Id_Daftar_Sandi"] == '03'){
				$subjumlah = $jml_saldo - $jml_tarik;
				//if saldo akhir on nomor rekening smaller than jml_rekening than show the errror message
				if ($subjumlah < 10000){
					$res['status'] = 'error';
					$res['message'] = 'Maaf. Saldo anda hanya Rp. '.$jml_saldo.' <br>tabungan tidak mencukupi, <br>Saldo minimum = Rp. 10000';
					echo json_encode($res);
				}else{
					$jumlah = $jml_saldo - $jml_tarik;
				   	$created_data 	= $this -> mod_kas -> create();
				   	//if create kas success than update saldo nomor rekening record
				   	if ($created_data){
			   			$this -> mod_kas -> update_nomor_rekening($created_data['Kode_Norek'], $jumlah);
			   		}
					$created_data['recid']	= $created_data['Kode_Norek'];
					$res['status'] 	= 'success';
					$res['recid'] 	= $created_data['Kode_Norek']; 
					$res['records'] = $created_data; 
					echo json_encode($res);
				}
			}else{
			   	$created_data 	= $this -> mod_kas -> create();
			   	$jumlah = $jml_saldo + $jml_tabungan;
			   	if ($created_data){
			   		$this -> mod_kas -> update_nomor_rekening($created_data['Kode_Norek'], $jumlah);
			   	}
				$created_data['recid']	= $created_data['Kode_Norek'];
				$res['status'] 	= 'success';
				$res['recid'] 	= $created_data['Kode_Norek']; 
				$res['records'] = $created_data; 
				echo json_encode($res);
			}
		}
	}

	function delete($recid = null, $Jumlah_Debit, $Jumlah_Kredit, $Kode_Norek, $Validasi) {
		
		if (is_null($recid)) {
			echo 'ERROR: Id not provided.';
			return;
		}

		if ($Validasi == 'kas'){
			$res 	= Array();
			$res['status'] = 'error';
			$res['message'] = 'Maaf. Kas Tidak Dapat Dihapus';
			echo json_encode($res);
			return;
		}else{

		$data_nomor_rekening 	= $this -> mod_kas -> get_data_nomor_rekening($Kode_Norek);
		$saldo_nomor_rekening	= $data_nomor_rekening->Saldo_Akhir;
		$Jumlah = $saldo_nomor_rekening - $Jumlah_Debit + $Jumlah_Kredit ;
		

		$this -> mod_kas -> delete($recid);
	    $this -> mod_kas -> update_nomor_rekening($Kode_Norek, $Jumlah);
	   	

		$res = Array();
		$res['status'] = 'success';
		echo json_encode($res);
		}
	}


	function Qread() {
		$data = $this -> mod_kas -> getQread();
		//$sumdata for calculate summary of kas
		$sumdata = $this -> mod_kas -> getSumKas();

		$newaray = Array();
		$sums = count($data);
		//echo "<pre>"; die(print_r($sums, TRUE));
		if ($sums==0){
			$newaray['status']  = 'error';
			$newaray['message'] = 'Kas Saldo Periode Sebelumnya Otomatis Ditambahkan';
			$kas = $this -> mod_kas -> get_saldo_kas();
			if (!empty($kas)) {
			   	$data = $this -> mod_kas -> create_saldo_kas($kas);
			}			
			echo json_encode($newaray);
		}else{
			$newaray['status'] = 'success';
			$newaray['total'] = $sums;
			
			$newaray['records'] = $data;
			for ($i = 0; $i < $sums; $i++) {
				$data[$i] -> recid = $data[$i]->Id_Kas;
				$data[$i] -> namagabungan = $data[$i]->NamaPegawai.$data[$i]->NamaNasabah.$data[$i]->NamaSupplier;
				//$data[$i] -> summary = true;
			}
			$newaray['records'][] = Array('summary' => true, 'recid'=>'S-1', 'Id_Daftar_Akun_Kredit'=>'<span style="float: right;">Total:</span>', 'Jumlah_Debit'=>$sumdata[0]->TotalDebet, 'Jumlah_Kredit'=>$sumdata[0]->TotalKredit);
			$newaray['records'][] = Array('summary' => true, 'recid'=>'S-2', 'Id_Daftar_Akun_Kredit'=>'<span style="float: right;">Saldo:</span>', 'Jumlah_Debit'=>$sumdata[0]->GrandTotal);
			
			//echo "<pre>"; die(print_r($newaray, TRUE));
			echo json_encode($newaray);
		}
			
	}



	
	function kas_validation() {
		$acak = mt_rand(10000,99999);
		echo json_encode($acak);	
	}
	
}// End of system area
