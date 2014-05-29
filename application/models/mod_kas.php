<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_kas extends CI_Model {

	///first load, when kas empty, we will automatically add saldo of kas on daftar akun
	public function get_saldo_kas() {
		$query = $this -> db -> where('Id_Daftar_Akun', '1111') -> limit(1) -> get('daftar_akun');
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll	


	public function getSumKas() {
		//get all records from users table
		$query = $this -> db -> get('sum_kas');
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll


	public function getQread() {
		//get all records from users table
		$query = $this -> db -> get('det_rek');
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll

    public function update() {
		$data = $this->input->post("record", TRUE);
		$datalist = array(
            'Jumlah_Debit' 		=> $data["Jumlah_Debit"],
            'Jumlah_Kredit' 	=> $data["Jumlah_Kredit"],
            'Log_User'			=> $this->session->userdata('Username')
		);
		$this->db->set($datalist);
		$this->db->set('Log_Date', 'NOW()', FALSE);
		$this->db->set('Log_Time', 'NOW()', FALSE);
        $this->db->update( 'kas', $datalist, array( 'Id_Kas' => $this->input->post( 'recid', true ) ) );
    }	


    public function create_saldo_kas($kas) {
 		$datalist = array(
 			'Validasi' 			=> 'kas',
            'Jumlah_Debit' 		=> $kas[0]->Jumlah_Debit,
            'Jumlah_Kredit' 	=> $kas[0]->Jumlah_Kredit,
            'Log_User'			=> $this->session->userdata('Username')
		);
		
		$this->db->set($datalist);
		$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
		$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);
		$this -> db -> insert('kas', $datalist);
    }	

    public function create() {
    	$data = $this->input->post("record", TRUE);
		$datalist = array(
			'Kode_Norek'		=> $data["Kode_Norek"], 
			'Id_Daftar_Sandi'	=> $data["Id_Daftar_Sandi"], 
            'Validasi' 			=> $data["Validasi"],
            'Jumlah_Debit' 		=> $data["Jumlah_Debit"],
            'Jumlah_Kredit' 	=> $data["Jumlah_Kredit"],
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
        $this->db->delete( 'kas', array( 'Id_Kas' => $recid ) );
    } //end delete	
    
}// end of class
