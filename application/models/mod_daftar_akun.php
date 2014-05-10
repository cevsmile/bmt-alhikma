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
            'Nama_Akun' => $data["Nama_Akun"],
            'Akun_DK' => $data["Akun_DK"],
            'Akun_NL_LR' => $data["Akun_NL_LR"],
            'Jumlah_Debit' => $data["Jumlah_Debit"],
            'Jumlah_Kredit' => $data["Jumlah_Kredit"]
        );
        $this->db->update( 'daftar_akun', $datalist, array( 'Id_Daftar_Akun' => $this->input->post( 'recid', true ) ) );
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
        
        $this->db->delete( 'daftar_akun', array( 'Id_Daftar_Akun' => $recid ) );
    } //end delete	
    
}// end of class
