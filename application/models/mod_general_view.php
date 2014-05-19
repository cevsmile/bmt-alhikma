<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_general_view extends CI_Model {


//database query handle by view in database
	public function get_det_rek_nasabah() {
		//get all records from users table
		$query = $this -> db -> get('det_rek_nasabah');

		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll

}// end of class
