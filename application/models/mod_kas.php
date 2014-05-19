<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_kas extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('kas');
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
			'Id_Daftar_Sandi'	=> $data["Id_Daftar_Sandi"], 
            'Validasi' 			=> $data["Validasi"],
            'Jumlah' 			=> $data["Jumlah"],
            'Log_User'			=> $this->session->userdata('Username')
		);
		$this->db->set($datalist);
		$this->db->set('Log_Date', 'NOW()', FALSE);
		$this->db->set('Log_Time', 'NOW()', FALSE);
        $this->db->update( 'kas', $datalist, array( 'Kode_Norek' => $this->input->post( 'recid', true ) ) );
    }	

    public function create() {
    	$data = $this->input->post("record", TRUE);
		$datalist = array(
			'Kode_Norek'		=> $data["Kode_Norek"], 
			'Id_Daftar_Sandi'	=> $data["Id_Daftar_Sandi"], 
            'Validasi' 			=> $data["Validasi"],
            'Jumlah' 			=> $data["Jumlah"],
            'Log_User'			=> $this->session->userdata('Username')
		);
		$this->db->set($datalist);
		$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
		$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);
		$this -> db -> insert('kas', $datalist);
		return $data;
    }	
    
    public function delete( $recid ) {
    	//echo "<pre>"; die(print_r($recid, TRUE));
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        //$recid = intval( $recid );
        $this->db->delete( 'kas', array( 'Kode_Norek' => $recid ) );
    } //end delete	
    
}// end of class
