<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_pegawai extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('pegawai');

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
            'Tanggal_Masuk' => date('Y-m-d', strtotime($data["Tanggal_Masuk"])),
            'Tanggal_Keluar' => date('Y-m-d', strtotime($data["Tanggal_Keluar"])),
            'Status' => $data["Status"]
        );
        $this->db->update( 'pegawai', $datalist, array( 'NIK' => $this->input->post( 'recid', true ) ) );
		return $datalist;
    }	

    public function create() {
 		$data = $this->input->post("record", TRUE);
        $datalist = array(
        	'NIK' => $data["NIK"],
            'Nama' => $data["Nama"],
            'Alamat' => $data["Alamat"],
            'Nomor_KTP' => $data["Nomor_KTP"],
            'Nomor_SIM' => $data["Nomor_SIM"],
            'Jenis_Kelamin' => $data["Jenis_Kelamin"],
            'Status' => $data["Status"]
        );
		$this->db->set($datalist);
		
		if ( $data["Tanggal_Masuk"] == ""){
			$this->db->set('Tanggal_Masuk', 'NULL' , FALSE);
		} else {
			$datalist['Tanggal_Masuk'] = date('Y-m-d', strtotime($data["Tanggal_Masuk"]));
		}
		
		if ( $data["Tanggal_Keluar"] == ""){
			$this->db->set('Tanggal_Keluar', 'NULL' , FALSE);
		} else {
			$datalist['Tanggal_Keluar'] = date('Y-m-d', strtotime($data["Tanggal_Keluar"]));
		}
		
		$this -> db -> insert('pegawai', $datalist);
		return $data;
    }	
    
    public function delete( $recid ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $recid = intval( $recid );
        
        $this->db->delete( 'pegawai', array( 'NIK' => $recid ) );
    } //end delete	
    
}// end of class
