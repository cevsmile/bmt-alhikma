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
			'Username'	=> $this -> input -> post('Username'), 
			'Password'	=> md5($this -> input -> post('Password')), 
			'Level'	=> $this -> input -> post('Level')
		);
		$this->db->set($add_records);         
		$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
		$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);
		$data = $this -> db -> insert('user', $add_records);
		return $data;
	}


}//end of Installation Class
