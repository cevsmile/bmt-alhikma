<?php

/** Author : Lalu Sefty Junaedi
 *  Contact : 081808785851
 *  Email : warior.cakep@gmail.com
 */
class Mod_user extends CI_Model {

	public function getAll() {
		//get all records from users table
		$query = $this -> db -> get('user');

		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return array();
		}
	} //end getAll
/*	
	public function getByRecid($recid) {
		$recid = intval($recid);

		$query = $this -> db -> where('Id_User', $recid) -> limit(1) -> get('user');

		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return array();
		}
	}
*/
    public function update() {
		$data = $this->input->post("record", TRUE);
        $datalist = array(
			'Username'	=> $this -> input -> post('Username'), 
			'Password'	=> md5($this -> input -> post('Password')), 
			'Level'	=> $this -> input -> post('Level')
        );		
		$this->db->set($datalist);         
		$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
		$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);

        $this->db->update( 'user', $datalist, array( 'Id_User' => $this->input->post( 'recid', true ) ) );
		//return $datalist;
    }	

    public function create() {
		$datalist = array(
			'Username'	=> $this -> input -> post('Username'), 
			'Password'	=> md5($this -> input -> post('Password')), 
			'Level'	=> $this -> input -> post('Level')
		);
		$this->db->set($datalist);         
		$this->db->set('Log_Date', 'CURRENT_DATE()', FALSE);
		$this->db->set('Log_Time', 'CURRENT_TIME()', FALSE);
		$data = $this -> db -> insert('user', $datalist);
		return $data;
    }	
    
    public function delete( $recid ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $recid = intval( $recid );
        
        $this->db->delete( 'user', array( 'Id_User' => $recid ) );
    } //end delete	
    
}// end of class
