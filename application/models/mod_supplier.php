<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_supplier extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('supplier');
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
            'NPWP' => $data["NPWP"]
        );
        $this->db->update( 'supplier', $datalist, array( 'Nomor_Urut_Supplier' => $this->input->post( 'recid', true ) ) );
		//return $datalist;
    }	

    public function create() {
 		$data = $this->input->post("record");
        $this->db->insert( 'supplier', $data );
        //return $this->db->insert_id();
        return $data;
    }	
    
    public function delete( $recid ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $recid = intval( $recid );
        
        $this->db->delete( 'supplier', array( 'Nomor_Urut_Supplier' => $recid ) );
    } //end delete	
    
}// end of class
