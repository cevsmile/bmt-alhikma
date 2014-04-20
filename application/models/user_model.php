<?php

class User_model extends CI_Model {

	function first_time_use() {
		$query = $this -> db -> get('pegawai');
		if ($query -> num_rows() == 0) {
			return true;
		}
	}
	
	function check_user() {
		$this -> db -> where('Username', $this -> input -> post('Username'));
		$this -> db -> where('Password', md5($this -> input -> post('Password')));
		$query = $this -> db -> get('pegawai');

		if ($query -> num_rows == 1) {
			return true;
		}else {
			return array();
		}
	}

}
