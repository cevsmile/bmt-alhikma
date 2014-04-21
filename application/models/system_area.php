<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class System_area extends CI_Model {

	function check_user() {
		$this->db->where('Username', $this->input->post('Username'));
		$this->db->where('Password', md5($this->input->post('Password')));
		$query = $this->db->get('pegawai');
		
		if($query->num_rows == 1)
		{
			return true;
		}
	}// end of check user function

}// end of class
