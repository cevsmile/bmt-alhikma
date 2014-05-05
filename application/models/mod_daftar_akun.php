<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_daftar_akun extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('daftar_akun');

		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll
/*	
	public function getByRecid($recid) {
		$recid = intval($recid);

		$query = $this -> db -> where('NIK', $recid) -> limit(1) -> get('pegawai');

		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return array();
		}
	}
*/
    public function update() {
		$data = $this->input->post("record", TRUE);
        $datalist = array(
            'Nama' => $data["Nama"],
            'Alamat' => $data["Alamat"],
            'Nomor_KTP' => $data["Nomor_KTP"],
            'Nomor_SIM' => $data["Nomor_SIM"],
            'Jenis_Kelamin' => $data["Jenis_Kelamin"],
            'Tanggal_Masuk' => $data["Tanggal_Masuk"],
            'Tanggal_Keluar' => $data["Tanggal_Keluar"],
            'Status' => $data["Status"],
            'Pembaruan' => $data["Pembaruan"],
            'Saldo_Awal' => $data["Saldo_Awal"],
            'Saldo_Akhir' => $data["Saldo_Akhir"],
            'Username' => $data["Username"]
        );		
        $this->db->update( 'daftar_akun', $datalist, array( 'NIK' => $this->input->post( 'recid', true ) ) );
		//return $datalist;
    }	

    public function create() {
 		$data = $this->input->post("record");
        $this->db->insert( 'daftar_akun', $data );
        //return $this->db->insert_id();
        return $data;
    }	
    
    public function delete( $recid ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $recid = intval( $recid );
        
        $this->db->delete( 'daftar_akun', array( 'NIK' => $recid ) );
    } //end delete	
    
}// end of class
