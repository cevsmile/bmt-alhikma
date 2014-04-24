<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Pegawai extends CI_Model {

	public function getById($NIK) {
		$id = intval($id);

		$query = $this -> db -> where('NIK', $NIK) -> limit(1) -> get('pegawai');

		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return array();
		}
	}

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('pegawai');

		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll

}// end of class
