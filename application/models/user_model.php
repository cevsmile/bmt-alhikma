<?php

class User_model extends CI_Model{
	
	function check_user(){
		$this->db->where('Username', $this->input->post('nama'));
		$this->db->where('Password', md5($this->input->post('password')));
		$query = $this->db->get('pegawai');
		
		if($query->num_rows == 1)
		{
			return true;
		}
	}

}
