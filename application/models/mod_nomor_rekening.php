<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_nomor_rekening extends CI_Model {

	public function get_neraca_saldo() {
		$query = $this -> db -> get('daftar_akun');
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end get_neraca_saldo

	public function cekNorek($norek) {
		$this->db->like('Kode_Norek', $norek);
		$this->db->from('nomor_rekening');
		$query = $this->db->count_all_results();
		return $query;
	}

	public function getQread() {
		//get all records from users table
		$query = $this -> db -> get('det_no_rek');
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll

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
            'Saldo_Awal' => $data["Saldo_Awal"],
            'Saldo_Akhir' => $data["Saldo_Akhir"],
        );
		$this->db->set($datalist);
		$this->db->set('Log_Date', 'NOW()', FALSE);
		$this->db->set('Log_Time', 'NOW()', FALSE);
        $this->db->update( 'nomor_rekening', $datalist, array( 'Kode_Norek' => $this->input->post( 'recid', true ) ) );
    }	

    public function create() {
    	$data = $this->input->post("record", TRUE);
		$datalist = array(
			'Kode_Norek'		=> $data["Kode_Norek"], 
			'Kode_Cabang'		=> $data["Kode_Cabang"], 
			'Id_Daftar_Akun'	=> $data["Id_Daftar_Akun"],
			'Id_Nasabah'		=> empty($data["Id_Nasabah"]) ? NULL : $data["Id_Nasabah"],
			'Id_Supplier'		=> empty($data["Id_Supplier"]) ? NULL : $data["Id_Supplier"],
            'NIK' 				=> empty($data["NIK"]) ? NULL : $data["NIK"],
            'Saldo_Awal' 		=> $data["Saldo_Awal"],
            'Saldo_Akhir' 		=> $data["Saldo_Akhir"],
            'Log_User'			=> $this->session->userdata('Username')
		);
		$this->db->set($datalist);
		$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
		$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);
		$this -> db -> insert('nomor_rekening', $datalist);
		return $data;
    }

/*
     public function create_neraca_saldo($rekening_neraca_saldo, $sum_rekening_neraca_saldo) {

     	//echo "<pre>"; die(print_r($sum_rekening_neraca_saldo, TRUE));

		for ($i = 0; $i < $sum_rekening_neraca_saldo; $i++) {
	    	$datalist = array(
				'Kode_Norek'		=> $rekening_neraca_saldo[$i] -> Id_Daftar_Akun,
	            'Saldo_Awal' 		=> $rekening_neraca_saldo[$i] -> Jumlah_Debit,
	            'Saldo_Akhir' 		=> $rekening_neraca_saldo[$i] -> Jumlah_Kredit,
	            'Log_User'			=> $this->session->userdata('Username')
			);
			$this->db->set($datalist);
			$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
			$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);
			$this -> db -> insert('nomor_rekening', $datalist);
		}
    }
*/    
    public function delete( $recid ) {
    	//echo "<pre>"; die(print_r($recid, TRUE));
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        //$recid = intval( $recid );
        $this->db->delete( 'nomor_rekening', array( 'Kode_Norek' => $recid ) );
    } //end delete	
    
}// end of class
