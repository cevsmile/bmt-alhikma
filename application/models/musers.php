<?php

/**
 *
 */
class Musers extends CI_Model {

	function getAll() {
		$query = $this -> db -> get('users');
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	}

}
