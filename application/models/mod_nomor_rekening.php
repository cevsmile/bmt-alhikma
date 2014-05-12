<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_nomor_rekening extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('nomor_rekening');
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
            'Kode_Cabang' => $data["Kode_Cabang"],
            'Id_Nasabah' => $data["Id_Nasabah"],
            'Id_Supplier' => $data["Id_Supplier"],
            'NIK' => $data["NIK"],
            'Id_Daftar_Akun' => $data["Id_Daftar_Akun"]
        );
		$this->db->set($datalist);
		$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
		$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);
        $this->db->update( 'nomor_rekening', $datalist, array( 'Kode_Norek' => $this->input->post( 'recid', true ) ) );
		//return $datalist;
    }	

    public function create() {
    	$data = $this->input->post("record");
		$datalist = array(
			'Kode_Cabang'	=> $this -> input -> post('Kode_Cabang'), 
			'Id_Nasabah'	=> $this -> input -> post('Id_Nasabah'), 
			'Id_Supplier'	=> $this -> input -> post('Id_Supplier'), 
			'NIK'	=> $this -> input -> post('NIK'), 
			'Id_Daftar_Akun'	=> $this -> input -> post('Id_Daftar_Akun')
		);
		$this->db->set($datalist);         
		$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
		$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);
		$data = $this -> db -> insert('nomor_rekening', $datalist);
		return $data;
    }	
    
    public function delete( $recid ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $recid = intval( $recid );
        
        $this->db->delete( 'nomor_rekening', array( 'Kode_Norek' => $recid ) );
    } //end delete	
    
}// end of class
