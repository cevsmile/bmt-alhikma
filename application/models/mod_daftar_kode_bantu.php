<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_daftar_kode_bantu extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('daftar_kode_bantu');
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
            'Nomor_Urut_Supplier' => $data["Nomor_Urut_Supplier"],
            'Kode_Cabang' => $data["Kode_Cabang"],
            'Kode_Akun' => $data["Kode_Akun"],
            'No_Urut_Nasabah' => $data["No_Urut_Nasabah"],
            'NIK' => $data["NIK"]
        );
        $this->db->update( 'daftar_kode_bantu', $datalist, array( 'Kode_Akun' => $this->input->post( 'recid', true ) ) );
		//return $datalist;
    }	

    public function create() {
 		$data = $this->input->post("record");
        $this->db->insert( 'daftar_kode_bantu', $data );
        //return $this->db->insert_id();
        return $data;
    }	
    
    public function delete( $recid ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $recid = intval( $recid );
        
        $this->db->delete( 'daftar_kode_bantu', array( 'Kode_Akun' => $recid ) );
    } //end delete	
    
}// end of class
