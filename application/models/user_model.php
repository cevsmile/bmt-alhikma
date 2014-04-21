<?php

class User_model extends CI_Model {

	function first_time_use() {
		$query = $this -> db -> get('pegawai');
		if ($query -> num_rows() == 0) {
			return true;
		}
	} // end of first_time_use

} // end of User_Model class
