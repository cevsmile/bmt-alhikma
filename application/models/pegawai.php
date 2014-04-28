<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Pegawai extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('pegawai');

		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll
	
	public function getByRecid($recid) {
		$recid = intval($recid);

		$query = $this -> db -> where('NIK', $recid) -> limit(1) -> get('pegawai');

		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return array();
		}
	}

    public function update() {
        $data = array(
            'Nama' => $this->input->post( 'Nama', true ),
            'Alamat' => $this->input->post( 'Alamat', true ),
            'Nomor_KTP' => $this->input->post( 'Nomor_KTP', true ),
            'Nomor_SIM' => $this->input->post( 'Nomor_SIM', true ),
            'Jenis_Kelamin' => $this->input->post( 'Jenis_Kelamin', true ),
            'Tanggal_Masuk' => $this->input->post( 'Tanggal_Masuk', true ),
            'Tanggal_Keluar' => $this->input->post( 'Tanggal_Keluar', true ),
            'Status' => $this->input->post( 'Status', true ),
            'Pembaruan' => $this->input->post( 'Pembaruan', true ),
            'Saldo_Awal' => $this->input->post( 'Saldo_Awal', true ),
            'Saldo_Akhir' => $this->input->post( 'Saldo_Akhir', true ),
            'Username' => $this->input->post( 'Username', true )
        );
        $this->db->update( 'pegawai', $data, array( 'NIK' => $this->input->post( 'NIK', true ) ) );
    }	
	
	
}// end of class
