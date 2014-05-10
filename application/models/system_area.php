<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class System_area extends CI_Model {

	function check_user() {
		$this -> db -> where('username', $this -> input -> post('username'));
		$this -> db -> where('password', md5($this -> input -> post('password')));
		$query = $this -> db -> get('user');

		if ($query -> num_rows == 1) {
			return true;
		}
	}// end of check user function

}// end of class
