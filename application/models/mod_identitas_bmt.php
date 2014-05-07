<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_identitas_bmt extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('identitas_bmt');

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
            'Nama_BMT' => $data["Nama_BMT"],
            'Alamat_BMT' => $data["Alamat_BMT"],
            'Status' => $data["Status"],
            'Nomor_Registrasi' => $data["Nomor_Registrasi"],
            'Tgl_Pembukuan' => date('Y-m-d', strtotime($data["Tgl_Pembukuan"]))
        );		
        $this->db->update( 'identitas_bmt', $datalist, array( 'Kode_Cabang' => $this->input->post( 'recid', true ) ) );
		//return $datalist;
    }	

    public function create() {
 		$data = $this->input->post("record");
        $this->db->insert( 'identitas_bmt', $data );
        //return $this->db->insert_id();
        return $data;
    }	
    
    public function delete( $recid ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $recid = intval( $recid );
        
        $this->db->delete( 'identitas_bmt', array( 'Kode_Cabang' => $recid ) );
    } //end delete	
    
}// end of class
