<?php

class Installation extends CI_Model {

	function first_time_use(){
		$query = $this->db->get('pegawai');
		if ($query->num_rows()==0){
			return true;
		}
	}


	function add_pegawai() {
		$add_records = array(
			'NIK'	=> $this -> input -> post('NIK'), 
			'Nama'	=> $this -> input -> post('Nama'), 
			'Alamat'	=> $this -> input -> post('Alamat'), 
			'Nomor_KTP'	=> $this -> input -> post('Nomor_KTP'), 
			'Nomor_SIM'	=> $this -> input -> post('Nomor_SIM'),
			'Jenis_Kelamin'	=> $this -> input -> post('Jenis_Kelamin'),
			'Tanggal_Masuk'	=> $this -> input -> post('Tanggal_Masuk'),
			'Tanggal_Keluar'	=> $this -> input -> post('Tanggal_Keluar'),
			'Status'	=> $this -> input -> post('Status'),
			'Pembaruan'	=> $this -> input -> post('Pembaruan'),
			'Saldo_Awal'	=> $this -> input -> post('Saldo_Awal'),
			'Saldo_Akhir'	=> $this -> input -> post('Saldo_Akhir'),
			'Username'	=> $this -> input -> post('Username'),
			'Password'	=> md5($this -> input -> post('Password'))
		);
		$insert = $this -> db -> insert('pegawai', $add_records);
		return $insert;
	}


}//end of Installation Class
