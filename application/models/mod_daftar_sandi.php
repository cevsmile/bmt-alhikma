<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_daftar_sandi extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('daftar_sandi');
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
            'Nama_Sandi' => $data["Nama_Sandi"],
            'Akun_DB' => $data["Akun_DB"],
            'Akun_KR' => $data["Akun_KR"]
        );
        $this->db->update( 'daftar_sandi', $datalist, array( 'Kode_Sandi' => $this->input->post( 'recid', true ) ) );
		//return $datalist;
    }	

    public function create() {
 		$data = $this->input->post("record");
        $this->db->insert( 'daftar_sandi', $data );
        //return $this->db->insert_id();
        return $data;
    }	
    
    public function delete( $recid ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $recid = intval( $recid );
        
        $this->db->delete( 'daftar_sandi', array( 'Kode_Sandi' => $recid ) );
    } //end delete	
    
}// end of class
