<?php

class Installation extends CI_Model {

	function first_time_use(){
		$query = $this->db->get('user');
		if ($query->num_rows()==0){
			return true;
		}
	}


	function add_user() {
		$add_records = array(
			'username'	=> $this -> input -> post('username'), 
			'password'	=> md5($this -> input -> post('password')), 
			'level'	=> $this -> input -> post('level')
		);
		$this->db->set($add_records);         
		$this->db->set('log_date', 'CURRENT_DATE()', FALSE);
		$this->db->set('log_time', 'CURRENT_TIME()', FALSE);
		$insert = $this -> db -> insert('user', $add_records);
		return $insert;
	}


}//end of Installation Class
